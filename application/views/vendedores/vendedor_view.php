<div class="row">
    <!-- <div class="panel panel-success"> -->
    <div class="col-md-12">
        <div class="col-md-5">
            <h3>Vendedores</h3> </div>
        <div class="col-md-1 pull-right"> </div>
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
            <button class="btn btn-success" onclick="add_vendedor();"><i class="glyphicon glyphicon-plus"></i> Nuevo vendedor</button>
            <button class="btn btn-default" onclick="reload_table();"><i class="glyphicon glyphicon-refresh"></i> Actualizar</button>
            <br />
            <br />
    
    <table class="table table-bordered table-condensed " cellspacing="0" width="100%" id="vendedores">
                <thead>
                    <tr>
<!--                        <th></th>-->
                        <th class="hidden-xs">id</th>
                        <th>Nombre</th>
                        <th>Provincia</th>
                        <th class="hidden-xs">Telefono</th>
                        <th class="hidden-xs">Movil</th>
                        <th class="hidden-xs">Documento</th>
                        <th class="hidden-xs">Correo</th>
                        <th class="hidden-xs">Estado</th>
                        <!--<th class="hidden">Web</th>
                        <th class="hidden">Direccion</th>
                        <th class="hidden">Localidad</th>
                        <th class="hidden">Provincia</th>
                        <th class="hidden">Desde</th> -->
                        <th style="min-width: 90px">Action</th>
                    </tr>
                </thead>
            </table>
    
</div>

<?php require_once (APPPATH.'views/vendedores/form_vendedor.php'); ?>
<script type="text/javascript">
    
table = $('#vendedores').DataTable({
    "processing": true, //Feature control the processing indicator.
    "serverSide": true, //Feature control DataTables' server-side processing mode.
    "columns": [
        {"data": "id_vendedor", "className": "hidden-xs" },
        {"data": "vendedor_nombre" },
        {"data": "vendedor_provincia" },
        {"data": "vendedor_telefono" , "className": "hidden-xs" },
        {"data": "vendedor_movil" , "className": "hidden-xs" },
        {"data": "vendedor_documento", "className": "hidden-xs" },
        {"data": "vendedor_correo" },
        {"data": "vendedor_estado" },
        {"data": "Acciones" }
    ]
    , "order": [], //Initial no order.
    // Load data for the table's content from an Ajax source
    "ajax": {
        "url": "<?php echo base_url()?>vendedor/ajax_list"
        , "type": "POST"
    }, //Set column definition initialisation properties.
    "columnDefs": [
        {

            "targets": [-1], //last column
            "orderable": false, //set not orderable

        }
    ]
});

function reload_table() {
    table.ajax.reload(null, false); //reload datatable ajax
}
   
</script>

<script type="text/javascript">    
    $.validate(
        { lang: 'es'}     
    ); 

</script>
