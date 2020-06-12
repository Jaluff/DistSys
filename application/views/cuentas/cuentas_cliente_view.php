<div class="row">
    <!-- <div class="panel panel-success"> -->

    <div class="col-md-2">
        <h3>Cuentas Corrientes</h3>
    </div>
    <div class="col-md-2 col-xs-4">
        <button class="btn btn-default" onclick="reload_table();"><i class="glyphicon glyphicon-refresh"></i> Actualizar</button>
    </div>
    <form name="frm_tpv" id="tpv" class="form-inline">
        <div class="col-md-4 ">
            <label for="cliente" class="control-label">Seleccione cliente: </label>
            <select id="cliente" name="cliente" class="form-control " witdh="100%">
                <!-- <option value="4">Seleccione</option> -->
                <?php foreach ($clientes as $p) : ?>
                <option value="<?php echo $p->id_cliente; ?>"><?= $p->cli_nombre ?></option>
                <?php endforeach; ?>
            </select>
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
                <th>Importe recibido</th>
                <th>Saldo</th>
                <th>Tipo</th>
                <th>Fecha</th>
                <th style="min-width: 90px">Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th colspan="5" style="text-align:right">Total:</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </tfoot>
    </table>
</div>

<?php //require_once(APPPATH . 'views/categorias/form_categoria.php'); ?>
<script type="text/javascript">
    table = $('#cuentas').DataTable({
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "createdRow": function ( row, data, index ) {
                // console.log(data['importe']);
                if( data['importe'] < 0) {
                    $(row).addClass('text-danger');
                    // $('td', row).eq(3).html('<span class="text-danger"> ' + data['importe'] + '</span>');
                }
                // if( data['importe'] === '1') {
                //     $('td', row).eq(2).html('<h4><div class="label label-info  ">Activa</div></h4>');
                // }
            },
        "columns": [{
                data: "id",
                className: "hidden-xs"
            },
            {
                data: "documento_asociado"
            },
            {
                data: "entidad"
            },
            {
                data: "importe"
            },
            {
                data: "importe_recibido"
            },
            {
                data: "saldo",
                "render": function (data, type, row){
                    return (data >= 0) ? '<span class="text-success">' + data + '</span>' : '<span class="text-danger">' + data + '</span>';
                }
                
            },
            {
                data: "tipo",
                "render": function (data, type, row){
                    // console.log(data);
                    return (data == 'Venta') ? '<p class="label label-success">' + data + '</p>' : '<p class="label label-info">' + data + '</p>';
                }
                
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
            url: "<?php echo base_url() ?>cuentas_clientes/ajax_list",
            type: "POST",
            data: function ( d ) {
                    d.cliente = $('#cliente').val();  
                    d.fecha = $('#fecha_mov').val(); 
                    d.fecha_fin = $('#fecha_mov_fin').val();  
                }
        }, //Set column definition initialisation properties.
        "columnDefs": [{

            "targets": [-1], //last column
            "orderable": false, //set not orderable

        }],
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
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            var clase = (total >= 0) ? 'text-success' : 'text-danger';
            
            // Update footer
            $( api.column( 5 ).footer() ).html(
                '<span class="' + clase + '">( $'+ total +' total)</span>'
            );
        }
    });

    $('#cliente').change( function() {
            table.draw();
        } );

    $('#fecha_mov, #fecha_mov_fin').change( function() {
        table.draw();
    } );

    function reload_table() {
        table.ajax.reload(null, false); //reload datatable ajax
    }
</script>

<script type="text/javascript">
    $.validate({
        lang: 'es'
    });

   

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