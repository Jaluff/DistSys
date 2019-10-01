<div class="row">
    <!-- <div class="panel panel-success"> -->

    <div class="col-md-6 col-xs-12">
        <h4>Productos - Modificacar precios</h4>
    </div>
    <div class="col-md-6">
        

        <div class="col-md-2 col-xs-6 pull-right ">
            <button class="btn btn-default" onclick="reload_table();"><i class="glyphicon glyphicon-refresh"></i> Actualizar</button>
        </div>
    </div>
</div>

<div class="row">
    <hr class="hr_success">
</div>

<div class="row">
    <div class="col-md-12">
        <div class="col-md-6 col-md-offset-4">
            <form class="form-inline" name="cambia_precio">
                <!-- <div class="form-group">
                    <label for="importe_precio"></label>
                    <input type="text" name="importe_precio" id="importe_precio" class="form-control input-sm" placeholder="Importe">
                </div> -->
                <div class="form-group">
                    <label for="porcentaje_precio"></label>
                    <input type="text" name="porcentaje_precio" id="porcentaje_precio" class="form-control input-sm" placeholder="Porcentaje">
                </div>
                <button id="mPrecios" class="btn btn-info btn-md" onclick="calcula_valor();"><i class="glyphicon glyphicon-plus "></i> Calcular Precios</button>
                <button id="mPrecios" class="btn btn-success btn-md" onclick="guardar_precios();"><i class="glyphicon glyphicon-ok"></i> Aprobar Cambios</button>
            </form>


        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 panel  ">
        <form id="frm_precios">
        <table class="table table-bordered table-condensed table-hover " cellspacing="0" width="100%" id="productos">
            <thead>
                <tr>
                    <th><input type="checkbox" style="margin-left: 17px;"  id="select-all" /></th>
                    <th>id</th>
                    <th>Codigo</th>
                    <th>Producto</th>
                    <th>Proveedor</th>
                    <th>Categoria</th>
                    <th>Marca</th>
                    <th>Precio compra</th>
                    <th>Precio Vta</th>
                    <th>%</th>
                    <th>Nvo %</th>
                    <th>Nvo precio</th>
                    <!-- <th style="min-width: 90px">Action</th> -->
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td></th>
                    <td></th>
                    <td></th>
                    <td></th>
                    <th ></th>
                    <th ></th>
                    <td></th>
                    <td> </th>
                    <td> </th>
                    <td></th>
                    <td></th>
                    <td> </th>
                    <!-- <th style="min-width: 90px">Action</th> -->
                </tr>
            </tfoot>
        </table>
        </form>
    </div>
</div>

<?php //require_once(APPPATH . 'views/productos/form_producto.php'); ?>

<script type="text/javascript">
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#productos tfoot th ').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
    // Apply the search
    table.columns('.filter').every( function () {
        var that = this;
 
        $( 'input', this.footer('.filter') ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
});
// initComplete: function () {
        //     this.api().columns([4,5,6]).every( function () {
        //         var column = this;
        //         var select = $('<select><option value=""></option></select>')
        //             .appendTo( $(column.footer()).empty() )
        //             .on( 'change', function () {
        //               $('#productos').DataTable().draw();
        //             } );
 
        //         column.data().unique().sort().each( function ( d, j ) {
        //             select.append( '<option value="'+d+'">'+d+'</option>' )
        //         } );
        //     } );
        // },

    table = $('#productos').DataTable({
        // initComplete: function () {
        //     this.api().columns([4,5,6]).every( function () {
        //         var column = this;
        //         var select = $('<select><option value=""></option></select>')
        //             .appendTo( $(column.footer()).empty() )
        //             .on( 'change', function () {
        //               $('#productos').DataTable().draw();
        //             } );
 
        //         column.data().unique().sort().each( function ( d, j ) {
        //             select.append( '<option value="'+d+'">'+d+'</option>' )
        //         } );
        //     } );
        // },
        // "dom": 'blrtip',
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        // "ordering": true,
        "searchable": true, 
        "columns": [
            {
                "name": "sel", "data": "sel",
                "className": "hidden-xs"
            },
            {
                "name": "id", "data": "id",
                "className": "hidden-xs"
            },
            {
                "name": "Codigo","data": "Codigo",
                "className": "hidden-xs"
            },
            {
                "name": "Producto","data": "Producto",
            },
            {
                "name": "proveedor","data": "proveedor",
                "className": "hidden-xs filter"
            },

            {
                "name": "Categoria","data": "Categoria",
                "className": " hidden-xs filter"
            },
            {
                "name": "marca","data": "marca",
                "className": "hidden-xs "
            },
            {
                "name": "precio_compra","data": "precio_compra"
            },
            {
                "name": "precio_venta","data": "precio_venta",
                "className": "hidden-xs"
            },
            {
                "name": "precio_porcentaje","data": "precio_porcentaje",
            },
            {
                "name": "porcentaje_nuevo","data": "porcentaje_nuevo",
            },
            {
                "name": "precio_nuevo","data": "precio_nuevo",
            }
            // {
            //     "data": "Acciones"
            // }
        ],
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo base_url() ?>producto/ajax_precios",
            "type": "POST",
            "data": function(d) {
                d.tpv = $('#tpv select').val();
            }
        }, //Set column definition initialisation properties.
        "columnDefs": [{
            "targets": [0, -1], //last column
            "orderable": false, //set not orderable
        }]
    });

    // $('#mPrecios').click(function() {
    //     event.preventDefault();
    //     var data = Array();
    //     $("input[type=checkbox]:checked").each(function(){
    //         data.push($(this).val());
    //     });
    //     calcula_valor(data);
    //     // var data = table.$('input').serialize();
    //     alert(
    //         "The following data would have been submitted to the server: \n\n" +
    //         // data.substr( 0, 120 )+'...'
    //         data
    //     );
    //     return false;
    // });

    // Listen for click on toggle checkbox
    $('#select-all').click(function(event) {   
        if(this.checked) {
            // Iterate each checkbox
            $(':checkbox').each(function() {
                valor =($(this).closest("tr").find("td:eq(7) input").val());
                console.log(valor);
                if(valor > 0){
                    this.checked = true;
                }                        
            });
        } else {
            $(':checkbox').each(function() {
                this.checked = false;                       
            });
        }
    });

    // $('#importe_precio').click(function() {   
    //     $('#porcentaje_precio').val('');
    // });

    $('#porcentaje_precio').click(function() {   
        // $('#importe_precio').val('');
    });

    function calcula_valor(){
        event.preventDefault();
        var checkedValue = null;
        var result = null; 
        var precio_venta = 0;
        var inputElements = document.getElementsByClassName('id_prod');
        for(var i=0; inputElements[i]; ++i){
            if(inputElements[i].checked){
                // valori = $('#importe_precio').val();
                valorp = $('#porcentaje_precio').val();
                
                checkedValue = inputElements[i].value;
                precio_compra = $('#compra_' + checkedValue).val();
                if (valorp > 0 ){
                    result = (precio_compra / (1-(valorp/100))).toFixed(2);
                }
                // }else if(valori > 0){
                //     result = valori;
                //     valorp = (precio_compra / )
                // }
                // PVP = PC / (1-(MB/100))

                $('#idPrecio_' + checkedValue).val(result);
                $('#idPorcentaje_' + checkedValue).val(valorp);
                // alert( parseFloat($('#venta_' + checkedValue).text()));
                // alert(result);
                // break;
            }
        }
    }

    function reload_table() {
        table.ajax.reload(null, false); //reload datatable ajax
    }

    function cambiar_precios(id) {
        costo = $('#compra_'+id).val();
        
        margen = $('#idPorcentaje_'+id).val();
        result = (costo / (1-(margen/100))).toFixed(2);
        venta = $('#idPrecio_'+id).val(result);
        // console.log(result);
    }

    function guardar_precios(){
        event.preventDefault();
        var precios = $('#frm_precios').serialize();
        var link = "<?php echo base_url(); ?>producto/";
        $.post(link + "ajax_update_precios", {
                precios: precios,
            },
            
            function(data) {
                console.log(data);
                if (data == 'true') {
                    alert("Operacion realizada con exito!");
                    reload_table();
                    // location.href = link;
                } else {
                    alert("Hubo algun problema , verifique");
                }
            }
            );
        return false; // Stop the browser of loading the page defined in the form "action" parameter.
    }


    $.validate({
        lang: 'es'
    });
</script>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Codigo de Barras</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary btn-print-barcode">
                    <span class="glyphicon glyphicon-print"></span>
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->