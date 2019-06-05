<div class="row">
    <!-- <div class="panel panel-success"> -->
    <div class="col-md-12">
        <div class="col-md-5">
            <h3>Clientes</h3> </div>
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
            <button class="btn btn-success" onclick="add_cliente();"><i class="glyphicon glyphicon-plus"></i> Nuevo cliente</button>
            <button class="btn btn-default" onclick="reload_table();"><i class="glyphicon glyphicon-refresh"></i> Actualizar</button>
            <br />
            <br />
    
    <table class="table table-bordered table-condensed " cellspacing="0" width="100%" id="clientes">
        <thead>
            <tr>
<!--                        <th></th>-->
                <th class="hidden-xs">Codigo</th>
                <th>Nombre</th>
                <th class="hidden-xs">Telefono</th>
                <th class="hidden-xs">Movil</th>
                <!-- <th>Mascota</th> -->
                <th class="hidden-xs">Cuit</th>
                <th class="hidden-xs">Correo</th>
                <th class="hidden-xs">Tipo</th>
                <th class="hidden-xs">Provincia</th>
                <!-- <th class="hidden">Direccion</th>
                <th class="hidden">Localidad</th> -->
                <!-- <th class="hidden-xs">Desde</th> -->
                <th style="min-width: 80px">Action</th>
            </tr>
        </thead>
    </table>
    
</div>
<script type="text/javascript">
    
    table = $('#clientes').DataTable({
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
                {"data": "Nombre" },
                {"data": "Telefono" , "className": "hidden-xs" },
                {"data": "Movil" , "className": "hidden-xs" },
                // {"data": "Mascota[]"},
                {"data": "Cuit", "className": "hidden-xs" },
                {"data": "Correo", "className": "hidden-xs" },
                {"data": "Tipo", "className": "hidden-xs" },
                {"data": "Provincia", "className": "hidden-xs" },
                // {"data": "Desde", "className": "hidden-xs" },
                {"data": "Acciones" }

        ]
            , "order": [], //Initial no order.
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo base_url()?>cliente/ajax_list"
                , "type": "POST"
            }, //Set column definition initialisation properties.
            "columnDefs": [
                {

                    "targets": [-1], //last column
                    "orderable": false, //set not orderable

        }
        , ]
         });
//    function format(d) {
//        // `d` is the original data object for the row
//        console.log(d);
//        return '<div class="col-md-12"><table  class=" table-condensed table table-striped table-hover" width="100%">' +'<tr style="background: #009ba2; color: #fff " ><th colspan="2">Datos relacionados</th></tr>'+ '<tr>' + '<th ><div class="text-right">Direccion:</div></th>' + '<td ><div class="text-left">' + d.Direccion + '</div></td>' + '</tr>' + '<tr >' + '<th ><div class="text-right">Localidad:</div></th>' + '<td><div class="text-left">' + d.Localidad + '</div></td>' + '</tr>' + '<tr >' + '<th ><div class="text-right">Provincia:</div></th>' + '<td><div class="text-left">' + d.Provincia + '</div></td>' + '</tr>' + '<tr >' + '<th ><div class="text-right">Correo:</div></th>' + '<td><div class="text-left">' + d.Correo + '</div></td>' + '</tr>' + '<tr >' + '<th ><div class="text-right">Cliente desde:</div></th>' + '<td><div class="text-left">' + d.Desde + '</div></td>' + '</tr>' + '<tr >' + '<th ><div class="text-right">Tipo de cliente:</div></th>' + '<td><div class="text-left">' + d.Tipo + '</div>' + '</td>' + '</tr>' + '</table> '+'</div>' ;
//    }


//    $('#clientes tbody').on('click', 'td.details-control', function () {
//            var tr = $(this).closest('tr');
//            var row = table.row(tr);
//            if (row.child.isShown()) {
//                // This row is already open - close it
//                row.child.hide();
//                tr.removeClass('shown');
//            }
//            else {
//                // Open this row
//                row.child(format(row.data())).show();
//                tr.addClass('shown');
//            }
//        });

    //$(document).ready(function () {
        
        
//        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
//            $.fn.dataTable.tables({
//                visible: true
//                , api: true
//            }).columns.adjust();
//        });  
        
        
        
//        $(function () {
//            $('[data-toggle="tooltip"]').tooltip()
//        });
//
    
        // Add event listener for opening and closing details    
   // });
function reload_table() {
    table.ajax.reload(null, false); //reload datatable ajax
}
</script>




<?php   
    require_once (APPPATH.'views/usuarios/form_cliente.php');
?>

<script type="text/javascript">

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

    $('#fecha_nacimiento').datepicker({
        todayBtn: "linked"
        , clearBtn: true
        , language: "es"
        , orientation: "bottom right"
        , autoclose: true
        , todayHighlight: true
        , format: 'dd-mm-yyyy'
    });
</script>
