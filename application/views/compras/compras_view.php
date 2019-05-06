<div class="row">
    <!-- <div class="panel panel-success"> -->
    
        <div class="col-md-2">
            <h3>Compras realizadas</h3>
        </div>
        <div class="col-md-3 col-xs-4">
                <button class="btn btn-default" onclick="reload_table();"><i class="glyphicon glyphicon-refresh"></i> Actualizar</button>
         
            <?php if ($this->ion_auth->is_admin()) { ?>
                <a 	href="<?=base_url()?>compras/nueva"	class="btn btn-success " data-toggle="tooltip" data-placement="top" title="Nueva compra">Nueva compra
							
					</a>
            <?php }?>
        </div>
        <div class="col-md-6">
        <form name="frm_tpv" id="tpv" class="form-inline">
                <div class="col-md-5 ">
                    <label for="tpv" class="control-label" >Seleccione TPV: </label>
                
                        <select id="tpv" name="tpv" class="form-control ">
                           <option value="4">Seleccione</option>
                           <?php foreach ($tpv as $t):?>
                            <option value="<?php echo $t->id_tpv;?>"><?=$t->tpv_nombre?></option>
                            
                            <?php endforeach;?>
                        </select>
                </div>
                <div class="col-md-7 ">
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
            
    
    <table class="table table-bordered table-condensed " cellspacing="0" width="100%" id="compras">
        <thead>
            <tr>
<!--                        <th></th>-->
                
                <th class="hidden-xs">#id</th>
                <th>compra numero</th>
                <th>Proveedor</th>
                <th>Estado</th>
                <!-- <th>Pedido n°</th> -->
                <th class="hidden-xs">Fecha</th>
                <th>Importe</th>
                <th>Imp. rec.</th>
                <th>Saldo</th>
                <th>Responsable</th>
                <th style="min-width: 90px">Action</th>
            </tr>
        </thead>
    </table>
    
</div>
<script type="text/javascript">
    var tpv = $('#tpv').val();
    table = $('#compras').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "createdRow": function ( row, data, index ) {
                //console.log(data['estado']);
                if( data['estado'] === 'Pedido') {
                    $('td', row).eq(3).html('<h5><div class="label label-warning ">' + data['estado'] + '</div></h4>');
                }
                if( data['estado'] === 'Arribada') {
                    $('td', row).eq(3).html('<h5><div class="label label-info  ">' + data['estado'] + '</div></h4>');
                }
                if( data['estado'] === 'Aprobada') {
                    $('td', row).eq(3).html('<h5><div class="label label-success  ">' + data['estado'] + '</div></h4>');
                }
            },
            "columns": [
                {"data": "id_compra", "className": "hidden-xs" },
                {"data": "numero_compra" },
                {"data": "proveedor" },
                {"data": "estado" },
                // {"data": "numero_compra"},
                {"data": "compra_created_on", "className": "hidden-xs" },
                {"data": "importe" },
                {"data": "importe_recibido" },
                {"data": "saldo" },
                {"data": "usuario" },
                {"data": "Acciones" }
        ]
            , "order": [], //Initial no order.
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo base_url()?>compras/ajax_list",
                "type": "POST",
                "data": function ( d ) {
                    d.tpv = $('#tpv select').val();  
                    d.fecha = $('#fecha_mov').val(); 
                    d.fecha_fin = $('#fecha_mov_fin').val();  
                }
            }, //Set column definition initialisation properties.
            "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
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
	 //require_once (APPPATH.'views/form_compras.php');
	
	 require_once (APPPATH.'views/stock/form_actualizarStock.php');
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

</script>
