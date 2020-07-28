$( document ).ready(function() {
	$('#reportemain tfoot th').each( function () {
	       var title = $(this).text();
	       $(this).html( '<input type="text" placeholder="Buscar '+title+'" />' );
	   } );
    var table = $('#reportemain').dataTable( {
        "autoWidth": true,
             	           dom: 'Bfrtip',
             	           "paging":   true, 
             	          buttons: [
             	            { extend: 'copyHtml5', footer: true },
             	            { extend: 'excelHtml5', footer: true },
             	            { extend: 'csvHtml5', footer: true },
             	            { extend: 'pdfHtml5', footer: true },
             	            { extend: 'print',
                        customize: function ( win ) {
                            $(win.document.body)
                                .css( 'font-size', '10pt' )
                                .append(
                                   head
                                );
         
                            $(win.document.body).find( 'table' )
                                .addClass( 'compact' )
                                .css( 'font-size', 'inherit' );
                        }}
             	        ],
             	          "footerCallback": function ( row, data, start, end, display ) {
                                var api = this.api(), data;
                     
                                // Remove the formatting to get integer data for summation
                                var intVal = function ( i ) {
                                    return typeof i === 'string' ?
                                        i.replace(/[\$,]/g, '')*1 :
                                        typeof i === 'number' ?
                                            i : 0;
                                };
                     
                                // Total over all pages
                                total = api
                                    .column( 6 ,{"filter": "applied"})
                                    .data()
                                    .reduce( function (a, b) {
                                        return intVal(a) + intVal(b);
                                    }, 0 );
                     
                                // Total over this page
                                pageTotal = api
                                    .column( 6, { page: 'current'} )
                                    .data()
                                    .reduce( function (a, b) {
                                        return intVal(a) + intVal(b);
                                    }, 0 );
                     
                                  var formatted = $.fn.dataTable.render.number( ",", ".", 0, "$" ).display( total );
                                $( api.column( 6 ).footer() ).html(
                                    formatted
                                );
                              
                            }
    } );
    table.columns().every( function () {
           var that = this;
    
           $( 'input', this.footer() ).on( 'keyup change clear', function () {
               if ( that.search() !== this.value ) {
                   that
                       .search( this.value )
                       .draw();
               }
           } );
       } );
});