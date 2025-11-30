import argparse
import os
import sys
import math
from concurrent.futures import ThreadPoolExecutor, as_completed

try:
    from PIL import Image, ImageFile
except Exception as e:
    print("Pillow requis: pip install pillow")
    sys.exit(1)

ImageFile.LOAD_TRUNCATED_IMAGES = True

def process(path, quality, max_w, max_h, lossless_png, strip_metadata):
    try:
        ext = os.path.splitext(path)[1].lower()
        orig = os.path.getsize(path)
        img = Image.open(path)
        if ext in (".jpg", ".jpeg"):
            if strip_metadata:
                img.info.pop('exif', None)
                img.info.pop('icc_profile', None)
            img = img.convert("RGB")
            w, h = img.size
            sx = max_w / float(w)
            sy = max_h / float(h)
            sc = min(sx, sy)
            if sc > 1:
                sc = 1
            nw = int(math.floor(w * sc))
            nh = int(math.floor(h * sc))
            if (nw, nh) != (w, h):
                img = img.resize((nw, nh), Image.LANCZOS)
            tmp = path + ".tmp"
            img.save(tmp, format="JPEG", quality=quality, optimize=True, progressive=True, subsampling=2)
        elif ext == ".png":
            tmp = path + ".tmp"
            if lossless_png:
                if strip_metadata:
                    for k in list(img.info.keys()):
                        img.info.pop(k, None)
                img.save(tmp, format="PNG", optimize=True)
            else:
                q = img.convert("P", palette=Image.ADAPTIVE, colors=256)
                q.save(tmp, format="PNG", optimize=True)
        else:
            return 0
        new = os.path.getsize(tmp)
        if new > 0 and new < orig:
            os.replace(tmp, path)
            return orig - new
        else:
            os.remove(tmp)
            return 0
    except Exception:
        return 0

def main():
    p = argparse.ArgumentParser()
    p.add_argument("--root", required=True)
    p.add_argument("--quality", type=int, default=80)
    p.add_argument("--max-width", type=int, default=1200)
    p.add_argument("--max-height", type=int, default=1200)
    p.add_argument("--lossless-png", action="store_true")
    p.add_argument("--strip-metadata", action="store_true")
    p.add_argument("--ext", default="jpg,jpeg,png")
    p.add_argument("--file")
    p.add_argument("--workers", type=int, default=max(2, (os.cpu_count() or 2)))
    p.add_argument("--limit", type=int, default=0)
    args = p.parse_args()

    exts = set(["." + e.strip().lower() for e in args.ext.split(",") if e.strip()])
    files = []
    if args.file:
        if os.path.splitext(args.file)[1].lower() in exts and os.path.isfile(args.file):
            files = [args.file]
    else:
        for r, d, fns in os.walk(args.root):
            for fn in fns:
                if os.path.splitext(fn)[1].lower() in exts:
                    files.append(os.path.join(r, fn))
    if args.limit and args.limit > 0:
        files = files[:args.limit]
    total = len(files)
    if total == 0:
        print("Aucun fichier")
        return

    saved = 0
    done = 0
    with ThreadPoolExecutor(max_workers=args.workers) as ex:
        futs = [ex.submit(process, f, args.quality, args.max_width, args.max_height, args.lossless_png, args.strip_metadata) for f in files]
        for fut in as_completed(futs):
            saved += fut.result()
            done += 1
            if done % 100 == 0 or done == total:
                pct = int((done / float(total)) * 100)
                print(f"Progress: {pct}% ({done}/{total}) saved: {round(saved/1_000_000,2)} MB")
    print(f"Processed: {total} file(s), saved: {round(saved/1_000_000,2)} MB")

if __name__ == "__main__":
    main()
