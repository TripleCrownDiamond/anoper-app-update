Param(
  [string]$ImagesRoot = (Join-Path (Split-Path -Parent $MyInvocation.MyCommand.Path) '..\cardcreate\datas\files'),
  [int]$Quality = 80,
  [int]$MaxWidth = 1200,
  [int]$MaxHeight = 1200
)

$ErrorActionPreference = 'Stop'
Add-Type -AssemblyName System.Drawing

function Compress-Jpeg([string]$Path, [int]$Quality, [int]$MaxWidth, [int]$MaxHeight) {
  try {
    $img = [System.Drawing.Image]::FromFile($Path)
    $w = $img.Width; $h = $img.Height
    $scaleX = $MaxWidth / [double]$w
    $scaleY = $MaxHeight / [double]$h
    $scale = [Math]::Min($scaleX, $scaleY)
    if ($scale -gt 1) { $scale = 1 }
    $newW = [int][Math]::Floor($w * $scale)
    $newH = [int][Math]::Floor($h * $scale)
    $bmp = New-Object System.Drawing.Bitmap($newW, $newH)
    $g = [System.Drawing.Graphics]::FromImage($bmp)
    $g.CompositingQuality = [System.Drawing.Drawing2D.CompositingQuality]::HighQuality
    $g.SmoothingMode = [System.Drawing.Drawing2D.SmoothingMode]::HighQuality
    $g.InterpolationMode = [System.Drawing.Drawing2D.InterpolationMode]::HighQualityBicubic
    $g.PixelOffsetMode = [System.Drawing.Drawing2D.PixelOffsetMode]::HighQuality
    $g.DrawImage($img, 0, 0, $newW, $newH)
    $codec = [System.Drawing.Imaging.ImageCodecInfo]::GetImageEncoders() | Where-Object { $_.MimeType -eq 'image/jpeg' }
    $encParams = New-Object System.Drawing.Imaging.EncoderParameters(2)
    $encParams.Param[0] = New-Object System.Drawing.Imaging.EncoderParameter([System.Drawing.Imaging.Encoder]::Quality, [long]$Quality)
    $encParams.Param[1] = New-Object System.Drawing.Imaging.EncoderParameter([System.Drawing.Imaging.Encoder]::ScanMethod, [long][System.Drawing.Imaging.EncoderValue]::ScanMethodInterlaced)
    $tmp = [System.IO.Path]::GetTempFileName()
    $bmp.Save($tmp, $codec, $encParams)
    $orig = (Get-Item -LiteralPath $Path).Length
    $new  = (Get-Item -LiteralPath $tmp).Length
    if ($new -lt $orig -and $new -gt 0) {
      Move-Item -Force -LiteralPath $tmp -Destination $Path
      $g.Dispose(); $bmp.Dispose(); $img.Dispose()
      return ($orig - $new)
    } else {
      Remove-Item -Force -LiteralPath $tmp
      $g.Dispose(); $bmp.Dispose(); $img.Dispose()
      return 0
    }
  } catch { return 0 }
}

$bytesSaved = 0
$files = Get-ChildItem -LiteralPath $ImagesRoot -Recurse -File -Include *.jpg,*.jpeg
$total = $files.Count
$processed = 0
for ($i = 0; $i -lt $total; $i++) {
  $f = $files[$i]
  $bytesSaved += Compress-Jpeg $f.FullName $Quality $MaxWidth $MaxHeight
  $processed++
  if (($processed % 100) -eq 0) {
    $pct = [int](($processed / [double]$total) * 100)
    Write-Host ("Progress: {0}% ({1}/{2}) saved: {3} MB" -f $pct, $processed, $total, [math]::Round($bytesSaved/1MB,2))
  }
}

Write-Host ("Processed: {0} JPEG(s), saved: {1} MB" -f $processed, [math]::Round($bytesSaved/1MB,2))
