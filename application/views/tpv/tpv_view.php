<div class="row">

    <div class="col-md-4">
        <h3>Stock</h3>
    </div>

    <div class="col-md-8 text-right">

        <form name="frm_tpv" id="tpv" class="form-inline">

            <label for="tpv" class="control-label">Seleccione TPV: </label>

            <select id="tpv" name="tpv" class="form-control ">

                <?php foreach ($tpv as $t) : ?>
                <option value="<?php echo $t->id_tpv; ?>" <?php 
                                                            echo (isset($tpv_active->id_tpv) && $tpv_active->id_tpv  == $t->id_tpv) ? 'selected=selected' : ''; ?>>
                    <?= $t->tpv_nombre ?>
                </option>

                <?php endforeach; ?>
            </select>

        </form>
    </div>
</div>

<div class="row">
    <hr class="hr_success">
    <?php
    if (isset($message)) { ?>
    <div id="infoMessage" class="alert uk-alert-success" role="alert">
        <?php echo $message; ?>
    </div>
    <?php 
} ?>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="row col-md-9">
            <form class="form-horizontal" id="form_cliente">
                <div class="panel panel-success ">
                    <div class="panel-body">
                        <!-- <div class="col-md-12">
                        <div class="col-md-9"></div>
                        <div class="col-md-3 text-right"><h4>Fecha de vta: <?php echo date("d-m-Y", strtotime($ventas->fecha)); ?></h4></div>
                    </div> -->
                        <input type="hidden" name="cli_estado" id="cli_estado" class="form-control input-sm" value="1">
                        <input type="hidden" name="cli_tipo" id="cli_tipo" class="form-control input-sm" value="No frecuente">

                        <input type="hidden" name="cli_created_on" id="cli_created_on" class="form-control input-sm" value="<?php echo date('Y-m-d', now()); ?>">

                        <div class="col-md-3">
                            <label class="control-label" for="cliente_nombre">
                                <h4>Cliente</h4>
                            </label>
                            <input type="text" name="cli_nombre" id="cli_nombre" class="form-control input-sm" value="">
                        </div>

                        <div class="col-md-2">
                            <label class="control-label" for="cli_direccion">
                                <h4>Direccion</h4>
                            </label>
                            <input type="text" name="cli_direccion" id="cli_direccion" class="form-control input-sm" value="">
                        </div>

                        <div class="col-md-2">
                            <label class="control-label" for="cli_localidad">
                                <h4>Localidad</h4>
                            </label>
                            <input type="text" name="cli_localidad" id="cli_localidad" class="form-control input-sm" value="">
                        </div>

                        <div class="col-md-2">
                            <label class="control-label" for="cli_cp">
                                <h4>Cod. Postal</h4>
                            </label>
                            <input type="text" name="cli_cp" id="cli_cp" class="form-control input-sm" value="">
                        </div>

                        <div class="col-md-3"></div>

                        <div class="col-md-2">
                            <label class="control-label" for="cli_doc">
                                <h4>Documento</h4>
                            </label>
                            <input type="text" name="cli_doc" id="cli_doc" class="form-control input-sm" value="">
                        </div>

                        <div class="col-md-3">
                            <label class="control-label" for="direccion">
                                <h4>Telefonos</h4>
                            </label>
                            <input type="text" name="cli_telefono" id="cli_telefono" class="form-control input-sm" value="">
                        </div>

                        <div class="col-md-3">
                            <label class="control-label" for="cli_movil">
                                <h4>Celular</h4>
                            </label>
                            <input type="text" name="cli_movil" id="cli_movil" class="form-control input-sm" value="">
                        </div>

                        <div class="col-md-3">
                            <label class="control-label" for="correo">
                                <h4>Correo electronico</h4>
                            </label>
                            <input type="text" name="cli_correo" id="cli_correo" class="form-control input-sm" value="">
                        </div>
                        <div class="col-md-1 ">
                            <label class="control-label" for="">
                                <h1></h1>
                            </label>
                            <h2>
                                <a class="btn btn-info btn-lg h2 " onclick="add_cliente();">
                                    <i class="glyphicon glyphicon-plus"></i>
                                </a>
                            </h2>
                        </div>
                    </div>
                </div>
            </form>



            <div class="panel panel-warning">
                <div class="panel-body">
                    <form id="form_product" type="post" action="<?php echo base_url(); ?>tpv/add_cart_item/">
                        <div class="col-md-6">
                            <label class="control-label" for="producto">Producto</label>
                            <input type="text" name="producto" id="producto" class="form-control input-sm" placeholder="Producto">
                        </div>

                        <div class="col-md-1">
                            <label class="control-label" for="stock_act">Stock</label>
                            <input type="text" name="stock_act" id="stock_act" class="form-control input-sm text-big" readonly="readonly">
                        </div>
                        <div class="col-md-1">
                            <label class="control-label" for="cantidad_producto">Cant</label>
                            <input type="text" name="cantidad_producto" id="cantidad_producto" class="form-control input-sm text-big">
                        </div>
                        <div class="col-md-2">
                            <label class="control-label" for="precio_producto">Precio</label>
                            <input type="text" name="precio_producto" id="precio_producto" class="form-control input-sm text-big" readonly="readonly">
                        </div>
                        <div class="col-md-1">

                            <button type="submit" class="btn btn-warning " name="agregar">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="cart_list">
                <!-- <h3>Your shopping cart</h3> -->
                <div id="cart_content">
                    <?php $this->view('tpv/cart.php');
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-precio">
                    <div class="panel-body">
                        <div class="h4 text-center" style="color: white">Importe total</div>
                        <div class="h1 text-center" style="color: white" id="total"></div>
                        <input type="hidden" name="total_importe" class="form-control" id="total_importe" value="">
                    </div>

                </div>
            </div>
            <!-- <div class="panel panel-pago ">
                <div class="panel-body ">

                    <form name="form_pago" id="form_pago" method="post">
                        <div class="form-group">
                            <label for="metodo_pago">
                                <h4 style="color: white" class="text-center">Forma de pago</h4>
                            </label>
                            <select name="metodo_pago" id="metodo_pago" class="form-control">
                                <option value='ninguno'>Ninguno</option>
                                <option value='efectivo'>Efectivo</option>
                                <option value='tarjeta'>Tarjeta</option>
                                <option value='cheque'>Cheque</option>
                                <option value='efectivoCheque'>Efectivo y cheque</option>
                                <option value='efectivoTarjeta'>Efectivo y tarjeta</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <div class="input-group" id="div_efectivo" style="display:none">
                                <div class="input-group-addon">$</div>
                                <label for="recibido_efectivo"></label>
                                <input type="text" name="recibido_efectivo" id="recibido_efectivo" placeholder="Recibido efectivo" class="form-control ">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="tarjeta"></label>
                            <select name="tarjeta" id="tarjeta" class="form-control " style="display:none">
                                <option value="">Seleccione tarjeta</option>
                                <option value="Visa">Visa</option>
                                <option value="Mastercard">Mastercard</option>
                                <option value="Dinners">Dinners</option>
                                <option value="Nevada">Nevada</option>
                                <option value="Cabal">Cabal</option>


                            </select>
                        </div>

                        <div class="form-group">
                            <div class="input-group" id="div_tarjeta" style="display:none">
                                <div class="input-group-addon">$</div>
                                <label for="recibido_tarjeta"></label>
                                <input type="text" name="recibido_tarjeta" id="recibido_tarjeta" placeholder="Recibido tarjeta" class="form-control ">
                            </div>
                        </div>

                        <div class="form-group">
                            <div id="div_cheque" style="display:none">
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <label for="recibido_cheque"></label>
                                    <input type="text" name="recibido_cheque" id="recibido_cheque" placeholder="Recibido cheque" class="form-control ">
                                </div>
                                <label for="cheque_numero">Cheque Numero:</label>
                                <input type="text" name="cheque_numero" id="cheque_numero" value="" class="form-control">
                                <label for="cheque_banco">Banco:</label>
                                <input type="text" name="cheque_banco" id="cheque_banco" value="" class="form-control ">
                                <label for="cheque_cuenta">Cuenta:</label>
                                <input type="text" name="cheque_cuenta" id="cheque_cuenta" value="" class="form-control ">
                            </div>
                        </div>
                    </form>
                </div>
            </div> -->
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="form-group text-center h3">
                <?php echo anchor('#', 'Enviar', 'class="btn btn-success btn-lg" id="pedido"'); ?>
                <a href="javascript:window.history.go(-1);" class="btn btn-warning btn-lg">Volver</a>
                <?php  ?>
            </div>
        </div>
    </div>

</div>


<?php require_once(APPPATH . 'views/usuarios/form_cliente.php'); ?>

<script type="text/javascript">
    $(document).ready(function() {

        $('#tpv').on('change', function() {
            var $select = $('#producto').selectize();
            var selectize = $select[0].selectize;
            selectize.clear();
        });

        $("#div_tarjeta").hide();
        $("#div_tarjeta").hide();
        $("#tarjeta").hide();
        $("#factura").hide();
        $("#div_efectivo").hide();
        $("#div_cheque").hide();
        $("#tarjeta").hide();
        /*place jQuery actions here*/
        $('#metodo_pago').on('change', function() {
            event.preventDefault();
            mp = $('#metodo_pago').val();
            //alert(mp);
            if (mp == 'tarjeta') {
                //alert(mp );
                $("#div_efectivo").hide();
                $("#div_cheque").hide();
                $("#recibido_efectivo").val('');
                $("#div_tarjeta").show();
                $("#tarjeta").show();
                $("#factura").show();
            }
            if (mp == 'cheque') {
                //alert(mp );
                $("#div_efectivo").hide();
                $("#div_tarjeta").hide();
                $('#tarjeta').hide();
                $("#recibido_efectivo").val('');
                $("#div_cheque").show();
                $("#cheque").show();
                $("#factura").show();
            }
            if (mp == 'efectivoTarjeta') {
                $("#div_efectivo").show();
                $("#div_tarjeta").show();
                $("#tarjeta").show();
                $("#factura").show();
                $("#div_cheque").hide();
                //$("#descuento").show();
                //$("#tarjeta").prop('disabled', true);
            }
            if (mp == 'efectivoCheque') {
                $("#div_cheque").show();
                $("#div_tarjeta").hide();
                $("#tarjeta").hide();
                $("#factura").show();
                $("#div_efectivo").show();
                //$("#descuento").show();
                //$("#tarjeta").prop('disabled', true);
            }
            if (mp == 'efectivo') {
                $("#div_efectivo").show();
                $("#factura").show();
                $("#recibido_tarjeta").val('');
                $("#div_tarjeta").hide();
                $("#div_cheque").hide();
                $("#tarjeta").hide();
                //$("#descuento").show();
            }
            if (mp == 'ninguno') {
                $("#div_tarjeta").hide();
                $("#div_tarjeta").hide();
                $("#div_cheque").hide();
                $("#tarjeta").hide();
                $("#factura").hide();
                $("#div_efectivo").hide();
            }
        });

        // $('#factura').on('click', function() {
        //     var cliente = $('#form_cliente').serialize();
        //     var pago = $('#form_pago').serialize();
        //     var total_venta = $('#total_importe').val();

        //     mp = $('#metodo_pago').val();

        //     // alert($("#recibido_efectivo").text());

        //     if ($("#recibido_efectivo").val() == '' && mp == 'efectivo') {
        //         alert('No ingreso un importe en efectivo!');
        //         return false;
        //     } else
        //     if ($("#recibido_tarjeta").val() == '' && mp == 'tarjeta') {
        //         alert('No ingreso un importe de tarjeta!');
        //         return false;
        //     } else
        //     if (($("#recibido_efectivo").val() == '' || $("#recibido_tarjeta").val() == '') && mp == 'efectivoTarjeta') {
        //         alert('No ingreso algun importe!');

        //         return false;
        //     } else
        //     if (($("#recibido_cheque").val() == '' || $("#recibido_efectivo").val() == '') && mp == 'efectivoCheque') {
        //         alert('No ingreso algun importe!');
        //         return false;
        //     }
        //     var total_recibido_efectivo = ($("#recibido_efectivo").val() === '') ? 0 : $("#recibido_efectivo").val();
        //     var total_recibido_tarjeta = ($("#recibido_tarjeta").val() === '') ? 0 : $("#recibido_tarjeta").val();
        //     var total_recibido_cheque = ($("#recibido_cheque").val() === '') ? 0 : $("#recibido_cheque").val();
        //     //alert(total_recibido_efectivo + " - " + total_recibido_tarjeta );
        //     var total_recibido = parseFloat(total_recibido_efectivo) + parseFloat(total_recibido_tarjeta) + parseFloat(total_recibido_cheque);
        //     var importe_total = $("#total").text().substring(1);
        //     var tpv = $('#tpv select').val();
        //     console.log(total_recibido + " " + importe_total);
        //     if (total_recibido < importe_total) {
        //         confirm('El importe recibido es menos al total de la venta! VERIFIQUE');
        //         return false;
        //     }
        //     //alert(cliente + pago);
        //     var link = "<?php echo base_url(); ?>";
        //     $.post(link + "tpv/guardar_compra", {
        //             cliente: cliente,
        //             pago: pago,
        //             importe: importe_total,
        //             tipo: 'factura',
        //             tpv: tpv
        //         },
        //         function(data) {
        //             // Interact with returned data
        //             if (data == 'true') {
        //                 var vuelto = (parseFloat(total_recibido_cheque) + (parseFloat(total_recibido_tarjeta) + parseFloat(total_recibido_efectivo)) - parseFloat(importe_total));
        //                 alert("La venta fue exitosa! SU VUELTO: $" + parseFloat(vuelto));
        //                 <?php echo $this->cart->destroy(); ?>
        //                 location.href = location.href;
        //             } else {
        //                 alert("Problemas al realizar la venta...");
        //             }
        //         });
        //     return false; // Stop the browser of loading the page defined in the form "action" parameter.
        // });

        $('#pedido').on('click', function() {
            var cliente = $('#form_cliente').serialize();
            //alert(cliente); return;
            $("#recibido_tarjeta").val('');
            $("#recibido_efectivo").val('');
            $("#recibido_cheque").val('');
            $("#metodo_pago").val('');
            var pago = $('#form_pago').serialize();
            var tpv = $('#tpv select').val();

            //alert(cliente + pago);
            var link = "<?php echo base_url(); ?>";
            $.post(link + "tpv/guardar_compra", {
                    cliente: cliente,
                    pago: pago,
                    tipo: 'pedido',
                    tpv: tpv
                },
                function(data) {
                    // Interact with returned data
                    if (data == 'true') {
                        alert("Operacion realizada con exito!");
                        <?php  ?>
                        location.href = link + "venta";
                    } else {
                        alert("Hubo algun problema , verifique");
                    }
                });
            return false; // Stop the browser of loading the page defined in the form "action" parameter.
        });


        //$("#total").val();

        $("#form_product").submit(function() {
            var link = "<?php echo base_url(); ?>"; // Url to your application (including index.php/)
            // Get the product ID and the quantity 
            var id = $(this).find('input[name=producto]').val();
            var qty = parseFloat($(this).find('input[name=cantidad_producto]').val());
            var precio = $(this).find('input[name=precio_producto]').val();
            var stock = parseFloat($(this).find('input[name=stock_act]').val());
            if (stock < qty || stock == ' ') {
                alert('No hay stock suficiente de este articulo');
                return false;
            } else {
                //alert(id + qty + price);
                $.post(link + "tpv/add_cart_item", {
                        product_id: id,
                        quantity: qty,
                        price: precio,
                        ajax: '1'
                    },
                    function(data) {
                        // Interact with returned data
                        if (data == 'true') {

                            $.get(link + "tpv/show_cart", function(cart) { // Get the contents of the url cart/show_cart
                                $("#cart_content").html(cart); // Replace the information in the div #cart_content with the retrieved data
                                $(".precio_producto").val('0');
                                $("#cantidad_producto").val('0');
                            });
                        } else {
                            alert("Hubo un problema , verifique");
                        }
                    });
                var $select = $('#producto').selectize();
                var selectize = $select[0].selectize;
                selectize.clear();
                var cart_total = $('#total_importe').val();
                //alert(cart_total);
                if (cart_total) {
                    $('select#tpv').prop('disabled', true);
                }
                return false; // Stop the browser of loading the page defined in the form "action" parameter.
            }
        });
    });

    var formatName = function(item) {
        return $.trim((item.nombre));
    };

    var $select = $('#cli_nombre').selectize({
        maxItems: 1,
        closeAfterSelect: true,
        valueField: 'id',
        labelField: 'nombre',
        searchField: ['nombre', 'domicilio'],
        options: [
            <?php
  /* traer datos por json... sino no funciona */
            foreach ($clientes as $ent) {
                echo "{id:" . $ent->id_cliente . ", nombre: '" . $ent->cli_nombre . "', domicilio: '" . $ent->cli_direccion . "', documento: '" . $ent->cli_doc . "'},";
            }
            ?>
        ],
        render: {
            option: function(item, escape) {
                var nombre = formatName(item);
                var label = nombre || item.nombre;
                var caption = nombre ? item.nombre : null;

                return '<div>' +
                    'Nombre: <span class=""> ' + escape(label) + '</span> ' + '</div>';
            },
        },
        onChange: function(value) {
            $.ajax({
                url: "<?php echo base_url(); ?>cliente/ajax_get_cliente/" + value,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    console.log(data);
                    $('#cli_doc').val(data.cli_doc);
                    $('#cli_direccion').val(data.domicilio1);
                    $('#cli_telefono').val(data.telefono1);
                    $('#cli_correo').val(data.correo1);
                    $('#cli_cp').val(data.cp1);
                    $('#cli_localidad').val(data.localidad1);
                    $('#cli_movil').val(data.movil1);

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        },
        create: true,
    });
    // var control = $select[0].selectize;
    // control.setValue([186]);
    $('#producto').selectize({
        maxItems: 1,
        closeAfterSelect: true,
        valueField: 'id',
        labelField: 'nombre',
        searchField: ['nombre', 'domicilio'],
        options: [
            <?php
  /* traer datos por json... sino no funciona */
            foreach ($productos as $pro) {
                echo "{id:" . $pro->id_producto . ", nombre: '" . $pro->producto . " - " . $pro->cantidad_medida . "" . $pro->medida . "'},";
            }
            ?>
        ],
        render: {
            option: function(item, escape) {
                var nombre = formatName(item);
                var label = nombre || item.nombre;
                var caption = nombre ? item.nombre : null;
                return '<div>' +
                    '<span class=""> ' + escape(label) + '</span> ' + '</div>';

            }

        },
        onChange: function(value) {
            var tpv_sel = $('select#tpv').val();

            $.ajax({

                url: "<?php echo base_url(); ?>producto/ajax_edit/" + value + "/" + tpv_sel,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#stock_act').val(data.stock_act);
                    $('#precio_producto').val(data.producto_precio_venta);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        },
        create: false,
    });

    $.validate({
        lang: 'es'
    });

    $('#cli_fecha_nacimiento').datepicker({
        todayBtn: "linked",
        clearBtn: true,
        language: "es",
        orientation: "bottom right",
        autoclose: true,
        todayHighlight: true,
        format: 'dd-mm-yyyy'
    });

    $('#fecha_nacimiento').datepicker({
        todayBtn: "linked",
        clearBtn: true,
        language: "es",
        orientation: "bottom right",
        autoclose: true,
        todayHighlight: true,
        format: 'dd-mm-yyyy'
    });
</script> 