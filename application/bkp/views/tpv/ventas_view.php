<div class="row">
    <!-- <div class="panel panel-success"> -->
    
        <div class="col-md-3">
            <h3>Ventas realizadas</h3>
        </div>
        <div class="col-md-2 col-xs-4">
                <button class="btn btn-default" onclick="reload_table();"><i class="glyphicon glyphicon-refresh"></i> Actualizar</button>
        </div>
        <form name="frm_tpv" id="tpv" class="form-inline">
                <div class="col-md-3 ">
                    <label for="tpv" class="control-label" >Seleccione TPV: </label>
                
                        <select id="tpv" name="tpv" class="form-control ">
                           <option value="4">Seleccione</option>
                           <?php foreach ($tpv as $t):?>
                            <option value="<?php echo $t->id_tpv;?>"><?=$t->tpv_nombre?></option>
                            
                            <?php endforeach;?>
                        </select>
                </div>
                <div class="col-md-4 ">
                <div id="event_period">
                    <input type="text" id="fecha_mov"  name="fecha_mov" class="actual_range form-control input-sm" placeholder="Fecha desde"> - 
                    <input type="text" id="fecha_mov_fin" name="fecha_mov_fin" class="actual_range form-control input-sm" placeholder="Fecha hasta">
                </div>
                    <!-- <div class="col-md-4">
                      
                        <input type="text" id="fecha_mov" name="fecha_mov" class="form-control" placeholder="Fecha desde" >
                    </div>
                    <div class="col-md-4">
                      
                        <input type="text" id="fecha_mov_fin" name="fecha_mov_fin" class="form-control" placeholder="Fecha hasta">
                    </div> -->
                </div>
            </form>
        
    
</div>
<div class="row">
    <hr class="hr_success">
    <!-- <p><?php echo lang('index_subheading');?></p> -->
    <!-- </div> -->
    <?php
//    $user = $this->ion_auth->user()->row();
//		echo $user->email;
    if (isset($message)){ ?>
        <div id="infoMessage" class="alert uk-alert-success" role="alert">
            <?php echo $message;?>
        </div>
        <?php } ?>
        
</div>
            
    
    <table class="table table-bordered table-condensed " cellspacing="0" width="100%" id="ventas">
        <thead>
            <tr>
<!--                        <th></th>-->
                
                <th class="hidden-xs">#</th>
                <th>Cliente</th>
                <th>Forma pago</th>
                <th>Tipo</th>
                <th>Fecha</th>
                
                <th>Efectivo</th>
                <th>Tarjeta</th>
                <th>Estado</th>
                <th>Vendedor</th>
                <th style="min-width: 90px">Action</th>
            </tr>
        </thead>
    </table>
    
</div>
<script type="text/javascript">

    var tpv = $('#tpv').val();
    table = $('#ventas').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            dom:    "<'row'<'col-sm-6' B > <'col-sm-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-6'i> <'col-sm-6'p>>",
            buttons: [ 'print'],


            "columns": [
                
                
                 {"data": "id_venta", "className": "hidden-xs" },
                 {"data": "cliente" },
                 {"data": "metodoPago" },
                 {"data": "tipo" },
                 {"data": "fecha" },
                 
                 {"data": "pago_efectivo" },
                 {"data": "pago_tarjeta" },
                  {"data": "estado" },
                   {"data": "usuario" },
			     {"data": "Acciones" }
        ]
            , "order": [], //Initial no order.
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo base_url()?>venta/ajax_list",
                "type": "POST",
                "data": function ( d ) {
                    
                        d.tpv = $('#tpv select').val();  
                        d.fecha = $('#fecha_mov').val(); 
                        d.fecha_fin = $('#fecha_mov_fin').val();  
                    
                    
                }
            }, //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [-1], //last column
                    "orderable": false, //set not orderable
        }
        , ]
    });




    $('#tpv').change( function() {
        table.draw();
    } );

    $('#fecha_mov').change( function() {
        table.draw();
    } );

    function reload_table() {
        table.ajax.reload(null, false); //reload datatable ajax
    }

   
</script>




<?php 
	 // require_once (APPPATH.'views/administracion/form_compras.php');
	
	 // require_once (APPPATH.'views/administracion/form_actualizarStock.php');
?>

<script type="text/javascript">

    /*
     *   funciones para la gestion de productos
     */


    
    $.validate(
        { lang: 'es'}     
    );

    $('#event_period').datepicker({
    inputs: $('.actual_range'),
        todayBtn: "linked"

        , clearBtn: true
        , language: "es"
        , orientation: "bottom right"
        , autoclose: true
        , todayHighlight: true
        , format: 'dd-mm-yyyy'
});
    
    // $('#fecha_mov, #fecha_mov_fin').datepicker({
    //     todayBtn: "linked"

    //     , clearBtn: true
    //     , language: "es"
    //     , orientation: "bottom right"
    //     , autoclose: true
    //     , todayHighlight: true
    //     , format: 'dd-mm-yyyy'
    // }); 

</script>
