<div class="row">

    <div class="col-md-4">
        <h3>Nueva venta</h3>
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
    <div class="col-md-12">
        <hr class="hr_success">
        <?php if (isset($message)) { ?>
            <div id="infoMessage" class="alert alert-success" role="alert">
                <?php echo $message; ?>
            </div>
        <?php
    } ?>
    </div>
</div>
<div class="row">
    <div class="col-md-9">
        <div class="panel panel-warning">
            <div class="panel-body">
                <!-- <h3 >Datos de la compra</h4> -->
                <!-- <div class="row"> -->
                <!-- <div class="col-md-9"> -->
                <form action="#" class="" id="vta_cliente">
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <input type="hidden" name="cli_estado" id="cli_estado" class="form-control input-sm" value="1">
                            <input type="hidden" name="cli_tipo" id="cli_tipo" class="form-control input-sm" value="No frecuente">
                            <input type="hidden" name="id_cliente" id="id_cliente"  value="">

                            <input type="hidden" name="cli_created_on" id="cli_created_on" class="form-control input-sm" value="<?php echo date('Y-m-d', now()); ?>">

                            <div class="col-md-3">
                                <label class="control-label" for="cliente_nombre">
                                    Cliente
                                </label>
                                <input type="text" name="cli_nombre" id="cli_nombre" class="form-control input-sm" value="">
                            </div>

                            <div class="col-md-2">
                                <label class="control-label" for="cli_direccion">
                                    Direccion
                                </label>
                                <input type="text" name="cli_direccion" id="cli_direccion" class="form-control input-sm" value="">
                            </div>

                            <div class="col-md-2">
                                <label class="control-label" for="cli_localidad">
                                    Localidad
                                </label>
                                <input type="text" name="cli_localidad" id="cli_localidad" class="form-control input-sm" value="">
                            </div>

                            <div class="col-md-2">
                                <label class="control-label" for="cli_cp">
                                    Cod. Postal
                                </label>
                                <input type="text" name="cli_cp" id="cli_cp" class="form-control input-sm" value="">
                            </div>

                            <div class="col-md-3"></div>

                            <div class="col-md-2">
                                <label class="control-label" for="cli_doc">
                                    Documento
                                </label>
                                <input type="text" name="cli_doc" id="cli_doc" class="form-control input-sm" value="">
                            </div>

                            <div class="col-md-3">
                                <label class="control-label" for="direccion">
                                    Telefonos
                                </label>
                                <input type="text" name="cli_telefono" id="cli_telefono" class="form-control input-sm" value="">
                            </div>

                            <div class="col-md-3">
                                <label class="control-label" for="cli_movil">
                                    Celular
                                </label>
                                <input type="text" name="cli_movil" id="cli_movil" class="form-control input-sm" value="">
                            </div>

                            <div class="col-md-3">
                                <label class="control-label" for="correo">
                                    Correo electronico
                                </label>
                                <input type="text" name="cli_correo" id="cli_correo" class="form-control input-sm" value="">
                            </div>
                            <div class="col-md-1 ">
                                <label class="control-label" for="">
                                    <h1></h1>
                                </label>
                                <h2>
                                    <a class="btn btn-info  h2 " onclick="add_cliente();">
                                        <i class="glyphicon glyphicon-plus"></i>
                                    </a>
                                </h2>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- </div> -->
            </div>
        </div>
    </div>

        <div class="col-md-3">
            <div class="panel panel-precio">
                <div class="panel-body">
                    <div class="h2 text-center" style="color: white">Total del pedido</div>
                    <div class="h3  text-center" style="color: white">
                        <div id="importe_total">$0.00</div>
                        <input type="hidden" name="importe_total">
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php //print_r($clientes);?>
    <div class="row" id="prod" style="display:none;">
        <div class="col-md-9">
            <div class="well">
                <form name="form_productos" id="form_productos" class="form-horizontal">

                    <div class="form-group">
                        <div class="col-md-5">
                            <label class="control-label" for="sel_producto">Producto</label>
                            <input id="sel_producto" name="sel_producto" type="text" placeholder="Producto" class="form-control input-sm">
                        </div>

                        <div class="col-md-1">
                            <label class="control-label" for="venta_cantidad">Cantidad</label>
                            <input id="venta_cant" name="venta_cant" type="text" placeholder="Cant." class="form-control input-sm">
                        </div>
                        <!-- <div class="col-md-2">
                            <label class="control-label" for="prod_costo">Venta</label>
                            <input id="prod_costo" name="prod_costo" type="text" placeholder="Costo" class="form-control input-sm " required>
                        </div> -->
                        <div class="col-md-1">
                            <label class="control-label" for="stock_actual">Stock act.</label>
                            <input id="stock_actual" name="stock_actual" type="text" class="form-control input-sm " readonly="readonly">
                        </div>
                        <div class="col-md-2">
                            <label class="control-label" for="prod_precio_venta">Precio Venta</label>
                            <input id="prod_precio_venta" name="prod_precio_venta" type="text" class="form-control input-sm " readonly="readonly">
                        </div>
                        <div class="col-md-1">

                            <button class="btn btn-info " id="add">Agregar</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
    <div class="col-md-12">
        <hr class="hr_success">
    </div>
    </div>


    <div class="col-md-9">
        <form id="frm_items" name="frm_items">
            <!-- <h4>Detalle</h4> -->
            <!-- <div id="cart_content"></div> -->
            <table class="table table-hover" id="items">
                <thead>
                    <th>Codigo</th>
                    <th style='width:10%'>Cantidad</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Importe</th>
                    <th>Acciones</th>
                </thead>
                <tbody>
                </tbody>
            </table>


        </form>

    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="text-center">
                <div class="form-group">
                    <button type="button" id="Guardar_venta" name="Guardar_venta" class="btn btn-success">Guardar </button>
                    <!-- <button type="button" id="vaciar" name="vaciar" class="btn btn-warning">Vaciar produtos </button> -->
                    <button type="button" id="volver" name="volver" class="btn btn-danger" onclick="location.href='<?php echo base_url(); ?>ventas/'">Cancelar venta </button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php require_once(APPPATH . 'views/usuarios/form_cliente.php'); ?>
<script>
    $('#add').on('click', function() {

        var id = $('#sel_producto').val();
        var cantidad = $('#venta_cant').val();
        var precio = $('#prod_precio_venta').val();
        var link = '<?= base_url() ?>ventas/';
        $.post(link + "add_item", { //add_cart_item
                product_id: id,
                quantity: cantidad,
                price: precio,
                ajax: '1'
            },

            function(data) {
                datos = $.parseJSON(data);
                // alert(datos);
                if (datos.id_producto) {

                    html = "<tr>";
                    html += "<td><input type='hidden' name='codigo[]' value='" + datos.codigo + "' class='codigo'><p class='h5'>" + datos.codigo + "</p></td>";
                    html += "<td><input type='hidden' name='cantidad[]' value='" + datos.cantidad + "' class='cantidad'><p class='h5'>" + datos.cantidad + "</p></td>";
                    html += "<td><input type='hidden' name='nombre[]' value='" + datos.nombre + "' class='nombre'><p class='h5'>" + datos.nombre + "</p></td>";
                    html += "<td><input type='hidden' name='precio[]' value='" + datos.precio + "' class='precio'><p class='h5'>" + parseFloat(datos.precio).toFixed(2) + "</p></td>";
                    html += "<td><input type='hidden' name='importe[]' value='" + datos.sub_total + "' class='importe'><p class='h5'>" + parseFloat(datos.sub_total).toFixed(2) + "</p></td>";
                    html += "<input type='hidden' name='id_producto[]' value='" + datos.id_producto + "' class='id_producto'>";
                    html += "<td><button type='button' class='btn btn-danger btn-remove-producto'><span class='glyphicon glyphicon-trash'></span></button></td>";
                    html += "</tr>";
                    $('#items tbody').append(html);
                    clear_selectize_prod();
                    $('#prod_precio_venta').val('');
                    $('#compra_cant').val('');
                    calcula_total();
                    //con cart library 
                    /*$.get(link + "show_cart", function(cart) { // Get the contents of the url cart/show_cart
                        $("#cart_content").html(cart); // Replace the information in the div #cart_content with the retrieved data
                    });*/

                } else {
                    alert("Hubo un problema verifique!");
                }
            });
        return false;
    });

    $(document).on('click', '.btn-remove-producto', function() {
        $(this).closest("tr").remove();
        calcula_total();
    });

    $(document).on('keyup', '#items input.cantidades', function() {
        cantidad = $(this).val();
        precio = $(this).closest("tr").find("td:eq(3)").text();
        importe = cantidad * precio;
        importe = parseFloat(importe).toFixed(2);
        console.log('c' + cantidad + 'p' + precio);

        $(this).closest("tr").find("td:eq(4)").children("p").text(importe);
        $(this).closest("tr").find("td:eq(4)").children("input").val(importe);
        calcula_total();
    });

    $(document).on('keyup', '#items input.precio', function() {
        cantidad = $(this).val();
        precio = $(this).closest("tr").find("td:eq(1)").children("input").val();
        importe = cantidad * precio;
        importe = parseFloat(importe).toFixed(2);
        console.log('c' + cantidad + 'p' + precio + 'i: ' + importe);

        $(this).closest("tr").find("td:eq(4)").children("p").text("$" + importe);
        $(this).closest("tr").find("td:eq(4)").children("input").val(importe);
        calcula_total();
    });

    $('#vaciar').on('click', function() {
        var link = '<?= base_url() ?>ventas/';
        $.post(link + "empty_cart",
            function(data) {
                //alert (data);
                // if (data == true) {
                //redirect(link);
                // $.get(link + "show_cart", function(cart) { // Get the contents of the url cart/show_cart
                //     $("#cart_content").html(cart); // Replace the information in the div #cart_content with the retrieved data
                // });
                //} else {
                //   alert("La compra no se pudo eliminar.");
                // }
            });
        return false;
    });

    function calcula_total() {
        total = 0;
        $('#items tbody tr').each(function() {
            total = total + Number($(this).find("td:eq(4)").text());
            $("input[name=importe_total").val(total);
            $('#importe_total').text("$" + total);
        })
    }


    $('#Guardar_venta').on('click', function() {
        var cliente = $('#vta_cliente').serialize();
        var cli = $('#cli_nombre').val();
        if (cli == ''){
            alert("Debe seleccionar un cliente...!");
            return false;
        }
        var items = $('#frm_items').serialize();
        var tpv = $('select#tpv').val();
        // var pago = $('#form_pago').serialize();
        var importe_total = $('input[name=importe_total]').val();

        var link = "<?php echo base_url(); ?>ventas/";
        $.post(link + "guardar_venta", {
                cliente: cliente,
                tipo: 'pedido',
                tpv: tpv,
                detalles: items,
                // pago: pago,
                total: importe_total
            },
            function(data) {
                if (data == 'true') {
                    alert("Operacion realizada con exito!");
                    <?php
                    ?>
                    location.href = link;
                } else {
                    alert("Hubo algun problema , verifique");
                }
            });
        return false; // Stop the browser of loading the page defined in the form "action" parameter.
    });

    $('#sel_producto').on('change', function() {
        var id_prod = $('#sel_producto').prop('value');
        $.post("<?= base_url() ?>ventas/get_producto_precio", {
                id: id_prod
            },
            function(data) {
                var json = $.parseJSON(data);
                if (json != null) {
                    $('#prod_precio_venta').val(json.producto_precio_venta);
                } else {
                    $('#prod_precio_venta').val('');
                }
                $.post("<?= base_url() ?>ventas/get_producto_stock", {
                        id: id_prod
                    },
                    function(data) {
                        var json = $.parseJSON(data);

                        if (json != null) {
                            $('#stock_actual').val(json.stock_act);
                        } else {
                            $('#stock_actual').val("Sin stock");
                        }
                    });
            });

    });


    // function eliminar_producto(id) {
    //     var rowid = id;
    //     //alert (rowid);
    //     var link = '<?= base_url() ?>compras/';
    //     $.post(link + "delete_item_cart", {
    //             id: rowid,
    //             ajax: '1'
    //         },
    //         function(data) {
    //             if (data == 'true') {
    //                 $.get(link + "show_cart", function(cart) { // Get the contents of the url cart/show_cart
    //                     $("#cart_content").html(cart); // Replace the information in the div #cart_content with the 
    //                 });
    //             } else {
    //                 alert("El producto no se pude eliminar.");
    //             }
    //         });
    //     return false;
    // };


    /**
     *   Fin funciones de clientes
     */
    function getFormattedDate(d) {
        //console.log(d);
        var d = new Date(d);
        d = ('0' + (d.getDate() + 1)).slice(-2) + "-" + ('0' + (d.getMonth() + 1)).slice(-2) + "-" + d.getFullYear(); //d.getHours()).slice(-2) + ":" + ('0' + d.getMinutes()).slice(-2) + ":" + ('0' + d.getSeconds()).slice(-2);
        return d;
    }


    var formatName = function(item) {
        return $.trim(item.nombre);
    };
    var formatProducto = function(item) {
        return $.trim(item.producto);
    };

    var select = $('#cli_nombre').selectize({
        
        maxItems: 1,
        closeAfterSelect: true,
        valueField: 'id',
        labelField: 'nombre',
        searchField: ['nombre', 'domicilio'],
        options: [
            <?php
            /* traer datos por json... sino no funciona */
            foreach ($clientes as $ent) {
                echo "{id:" . $ent->id_cliente . ", nombre: '" . addslashes($ent->cli_nombre) . "', domicilio: '" . addslashes($ent->cli_direccion) . "', documento: '" . $ent->cli_doc . "'},";
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
                    $( "#prod").show();
                    $('#id_cliente').val(data.id_cliente);
                    $('#cli_doc').val(data.cli_cuit);
                    $('#cli_direccion').val(data.cli_direccion);
                    $('#cli_telefono').val(data.cli_telefono);
                    $('#cli_correo').val(data.cli_correo);
                    $('#cli_cp').val(data.cli_cp);
                    $('#cli_localidad').val(data.cli_localidad);
                    $('#cli_movil').val(data.cli_movil);

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        },
        create: false,
    });
    
   

    var prod = $('#sel_producto').selectize({
        maxItems: 1,
        valueField: 'id',
        labelField: 'producto',
        searchField: ['producto', 'stock_act'],
        options: [
            <?php
            /* traer datos por json... sino no funciona */
            //  var_dump($productos);
            if (isset($productos)) {
                foreach ($productos as $prod) {
                    // echo $prod->stock_act;
                    echo "{id:" . $prod->id_producto . ",  producto: '" . addslashes($prod->producto) . " - " . addslashes($prod->cantidad_medida) . $prod->medida . " '},";
                }
            } else {
                echo "{ producto: 'Ningun producto'},";
            }
            ?>
        ],
        render: {
            option: function(item, escape) {
                var producto = formatProducto(item);
                console.log(producto);
                var label = producto || item.stock_act;
                var caption =  item.stock_act;
               
                return '<div>' + '<span class="text-left"> ' + escape(label) + '</span> ' + (caption ? ' <span class="text-success h5">(Stock: ' + caption + ') </span>' : ' ') + '</div>';
            }
        },
        onChange: function(value) {
           
            var tpv_sel = $('select#tpv').val();
            
            if (value) {
                $.ajax({

                    url: "<?php echo base_url(); ?>producto/ajax_edit/" + value,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        console.log(data);
                        $('#stock_act').val(data.stock_act);
                        $('#prod_precio_venta').val(data.producto_precio_venta);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error get data from ajax');
                    }
                });
            }
        },
        create: false,
    });

    function clear_selectize_prod() {
        var prod = $('#sel_producto').selectize();
        var control = prod[0].selectize;
        control.clear();
    }

    $('#factura_fecha').datepicker({
        todayBtn: "linked",
        clearBtn: true,
        language: "es",
        orientation: "bottom right",
        autoclose: true,
        todayHighlight: true,
        format: 'dd-mm-yyyy'
    });
</script>