$(document).ready(function() {
    // datatables 
    var table = $('#example').DataTable({
        
        lengthChange: false,
        buttons: ['copy', 'excel', 'pdf', 'colvis'],
        scrollX: true,
        select: true,
    });

    table.buttons().container()
        .appendTo('#example_wrapper .col-md-6:eq(0)');

});