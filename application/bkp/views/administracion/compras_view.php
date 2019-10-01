<div class="row">
    <!-- <div class="panel panel-success"> -->
    <!-- <div class="col-md-12"> -->
        <div class="col-md-7">
            <h3>Stock</h3> 
        </div>
        <div class="col-md-2 col-xs-12 text-right ">
                <button class="btn btn-default" onclick="reload_table();"><i class="glyphicon glyphicon-refresh"></i> Actualizar</button>
        </div>
        <div class="col-md-3 col-xs-12 text-right">
        <form name="frm_tpv" id="tpv" class="form-inline">
            
                <label for="tpv" class="control-label" >Seleccione TPV: </label>
            
                    <select id="tpv" name="tpv" class="form-control ">
                       <option value="4">Seleccione</option>
                       <?php foreach ($tpv as $t):?>
                        <option value="<?php echo $t->id_tpv;?>"><?=$t->tpv_nombre?></option>
                        
                        <?php endforeach;?>
                    </select>
            
        </form>
        </div>
    <!-- </div>  -->
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
                
                <th class="hidden-xs">Codigo</th>
                <th>Producto</th>
                <th>Categoria</th>
                <th>Marca</th>
                
                <th class="hidden-xs">Stock minimo</th>
                <th>Stock actual</th>
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
            "columns": [
                
                
                 {"data": "Codigo", "className": "hidden-xs" },
                 {"data": "Producto" , "className": "h5"},
                 {"data": "tipo" },
                 {"data": "marca" },
                 
                 {"data": "Stock_minimo" , "className": "hidden-xs" },
                 {"data": "Stock_actual" },
			     {"data": "Acciones" }
        ]
            , "order": [], //Initial no order.
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo base_url()?>administracion/compras/ajax_list",
                "type": "POST",
                "data": function ( d ) {
                    
                        d.tpv = $('#tpv select').val();    
                    
                    
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

    function reload_table() {
        table.ajax.reload(null, false); //reload datatable ajax
    }

   
</script>




<?php 
	 require_once (APPPATH.'views/administracion/form_compras.php');
	
	 require_once (APPPATH.'views/administracion/form_actualizarStock.php');
?>

<script type="text/javascript">

    /*
     *   funciones para la gestion de productos
     */


    
    $.validate(
        { lang: 'es'}     
    );
    
    $('#cli_fecha_nacimiento').datepicker({
        todayBtn: "linked"
        , clearBtn: true
        , language: "es"
        , orientation: "bottom right"
        , autoclose: true
        , todayHighlight: true
        , format: 'dd-mm-yyyy'
    }); 

</script>
