<div class="row">
    <!-- <div class="panel panel-success"> -->

    <div class="col-md-3">
        <h3>Cuentas Corrientes</h3>
    </div>
    <div class="col-md-2 col-xs-4">
        <button class="btn btn-default" onclick="reload_table();"><i class="glyphicon glyphicon-refresh"></i> Actualizar</button>
    </div>
    <form name="frm_tpv" id="tpv" class="form-inline">
        <div class="col-md-3 ">
            <!-- <label for="tpv" class="control-label">Seleccione TPV: </label>

            <select id="tpv" name="tpv" class="form-control ">
                <option value="4">Seleccione</option>
                <?php foreach ($tpv as $t) : ?>
                <option value="<?php echo $t->id_tpv; ?>"><?= $t->tpv_nombre ?></option>

                <?php endforeach; ?>
            </select> -->
        </div>
        <div class="col-md-4 ">
            <div id="event_period">
                <input type="text" id="fecha_mov" name="fecha_mov" class="actual_range form-control input-sm" placeholder="Fecha desde"> -
                <input type="text" id="fecha_mov_fin" name="fecha_mov_fin" class="actual_range form-control input-sm" placeholder="Fecha hasta">
            </div>
        </div>
    </form>
    </div>

<div class="row">
    <hr class="hr_success">
    <!-- <p><?php echo lang('index_subheading'); ?></p> -->
    <!-- </div> -->
    <?php
 //    $user = $this->ion_auth->user()->row();
    //		echo $user->email;
    if (isset($message)) { ?>
    <div id="infoMessage" class="alert uk-alert-success" role="alert">
        <?php echo $message; ?>
    </div>
    <?php 
} ?>

</div>


    <table class="table table-bordered table-condensed " cellspacing="0" width="100%" id="cuentas">
        <thead>
            <tr>
                <!--                        <th></th>-->
                <th class="hidden-xs">id</th>
                <th>Documento</th>
                <th>Entidad</th>
                <th>Importe</th>
                <th>Saldo</th>
                <th>Fecha</th>
                <th style="min-width: 90px">Action</th>
            </tr>
        </thead>
    </table>
</div>

<?php //require_once(APPPATH . 'views/categorias/form_categoria.php'); ?>
<script type="text/javascript">
    table = $('#cuentas').DataTable({
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "createdRow": function ( row, data, index ) {
                console.log(data['importe']);
                if( data['importe'] < 0) {
                    $(row).addClass('text-danger');
                    // $('td', row).eq(3).html('<span class="text-danger"> ' + data['importe'] + '</span>');
                }
                // if( data['importe'] === '1') {
                //     $('td', row).eq(2).html('<h4><div class="label label-info  ">Activa</div></h4>');
                // }
            },
        "columns": [{
                "data": "id",
                "className": "hidden-xs"
            },
            {
                "data": "documento_asociado"
            },
            {
                "data": "entidad"
            },
            {
                "data": "importe"
            },
            {
                "data": "saldo"
            },
            {
                "data": "created_on"
            },
            {
                "data": "Acciones"
            }
        ],
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo base_url() ?>cuentas/ajax_list",
            "type": "POST"
        }, //Set column definition initialisation properties.
        "columnDefs": [{

            "targets": [-1], //last column
            "orderable": false, //set not orderable

        }]
    });

    function reload_table() {
        table.ajax.reload(null, false); //reload datatable ajax
    }
</script>

<script type="text/javascript">
    $.validate({
        lang: 'es'
    });
</script> 