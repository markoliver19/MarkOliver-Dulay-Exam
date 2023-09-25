<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
<script>
   var idioma=
   {
       "sProcessing":     "sProcessing",
       "sLengthMenu":     "sLengthMenu",
       "sZeroRecords":    "No Records Found",
       "sEmptyTable":     "EmptyTable",
       "sInfo":           "Showing _START_ to _END_  of _TOTAL_ records",
        "sInfoEmpty": "Displaying records from 0 to 0 of a total of 0 records",
       "sInfoFiltered":   "(filtering a total of _MAX_ records)",
       "sInfoPostFix":    "",
       "sSearch":         "Search:",
       "sUrl":            "",
       "sInfoThousands":  ",",
       "sLoadingRecords": "LoadingRecords",
       "oPaginate": {
           "sFirst":    "First",
           "sLast":     "Last",
           "sNext":     "Next",
           "sPrevious": "Previews"
       },
       "oAria": {
           "sSortAscending":  ": Activate to sort the column ascending", "sSortAscending": ": Activate to sort the column descending"
       },
       "buttons": {
           "copyTitle": 'Copied information',
           "copyKeys": 'Use your keyboard or menu to select the copy command',
           "copySuccess": {
               "_": '%d rows copied to clipboard',
               "1": '1 row copied to clipboard'
           },
   
           "pageLength": {
           "_": "Show %d Entries",
           "-1": "Show everything"
           }
       }
   };
   $(document).ready(function() {
   var table = $('#tableresult').DataTable( {
    "scrollY": 200,
   "scrollX": true,
   "paging": true,
   "lengthChange": true,
   "searching": true,
   "ordering": true,
   "info": true,
   "autoWidth": true,
   "language": idioma,
   "lengthMenu": [[20,50, -1],[20,50,"All"]],
   dom: 'Bfrt<"col-md-6 inline"i> <"col-md-6 inline"p>',
   buttons: {
   dom: {
   container: {
       tag: 'div',
       className: 'flexcontent'
   },
   buttonLiner: {
       tag: null
   }
   },
   buttons: [
   {
       extend: 'pageLength',
       titleAttr: 'records to show',
       className: 'selectTable'
   }
   ],
   select: true
   }
   
   });
   } );
   
   
   
</script>