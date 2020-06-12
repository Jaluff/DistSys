<div class="row">
    <!-- <div class="panel panel-success"> -->
    
        <div class="col-md-6">
            <h3>Productos</h3> 
        </div>
        
        <div class="col-md-1 col-xs-1 text-right">  
            <button class="btn btn-success" onclick="add_producto();"><i class="glyphicon glyphicon-plus"></i> Nuevo producto</button>
        </div>
        
        <div class="col-md-2 col-xs-1 text-right">
            <button class="btn btn-default" onclick="reload_table();"><i class="glyphicon glyphicon-refresh"></i> Actualizar</button>
        </div>

            <form name="frm_tpv" id="tpv" class="form-inline">
                <div class="col-md-3 text-right ">
                    <label for="tpv" class="control-label" >Seleccione TPV: </label>
                
                        <select id="tpv" name="tpv" class="form-control ">
                           <?php foreach ($tpv as $t):?>
                            <option value="<?php echo $t->id_tpv;?>"><?=$t->tpv_nombre?></option>
                            
                            <?php endforeach;?>
                        </select>
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
        <div class="col-md-12 panel  ">
            
            
    
    <table class="table table-bordered table-condensed " cellspacing="0" width="100%" id="productos">
        <thead>
            <tr>
<!--                        <th></th>-->
                <th class="hidden-xs">Codigo</th>
                <th >Producto</th>
                <th class="hidden-xs">Tipo</th>
                <th class="hidden-xs">Marca</th>
                <th>Precio Vta</th>
                <th>Stock Act.</th>
                <th style="min-width: 90px">Action</th>
            </tr>
        </thead>
    </table>
    
</div>
<script type="text/javascript">
    
    table = $('#productos').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "columns": [
//                 {
//                    "className": 'details-control'
//                    , "orderable": false
//                    , "data": 0
//                    , "defaultContent": ''
//                 },
                 {"data": "Codigo", "className": "hidden-xs" },
                 {"data": "Producto", "className": "h5" },
                 {"data": "tipo" , "className": " hidden-xs" },
                 {"data": "marca" , "className": "hidden-xs" },
                 {"data": "precio_venta"},
                 {"data": "Stock_actual", "className": "hidden-xs" },
			     {"data": "Acciones" }

            ],
            
            "order": [], //Initial no order.
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo base_url()?>producto/ajax_list",
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
            ]
    });

$('#tpv').change( function() {
        table.draw();
    } );

function reload_table() {
    table.ajax.reload(null, false); //reload datatable ajax
}
  
</script>

<?php 
    require_once (APPPATH.'views/productos/form_producto.php');
    //require_once (APPPATH.'views/administracion/form_compras.php');
?>

<script type="text/javascript">
    
    $.validate(
        { lang: 'es'}     
    );
    
    // $('#cli_fecha_nacimiento').datepicker({
    //     todayBtn: "linked"
    //     , clearBtn: true
    //     , language: "es"
    //     , orientation: "bottom right"
    //     , autoclose: true
    //     , todayHighlight: true
    //     , format: 'dd-mm-yyyy'
    // }); 

    // $('#fecha_nacimiento').datepicker({
    //     todayBtn: "linked"
    //     , clearBtn: true
    //     , language: "es"
    //     , orientation: "bottom right"
    //     , autoclose: true
    //     , todayHighlight: true
    //     , format: 'dd-mm-yyyy'
    // });
</script>
