<div class="row">

    <div class="col-md-4">
        <h3>Nueva compra</h3>
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
                    <form action="#" class="" id="compra">
                        <div class="col-md-12 ">
                            <div class="form-group">
                                
                                <!-- <div class="col-md-3 col-xs-12 "> -->
                                    <!-- <label class="control-label" for="compra_proveedor">#Compra:</label> -->
                                    <input id="numero_compra" name="numero_compra" type="hidden" placeholder="" class="form-control input-sm" readonly="readonly">
                                <!-- </div> -->

                                
                                <div class="col-md-3 col-xs-12 ">
                                    <label class="control-label" for="id_proveedor  ">Proveedor:</label>
                                    <input id="id_proveedor" name="id_proveedor" type="text" placeholder="" class="form-control input-sm">
                                </div>

                                
                                <div class="col-md-2">
                                    <label class="control-label" for="compra_fecha">Fecha:</label>
                                    <input id="compra_fecha" name="compra_fecha" type="text" value="<?= date('d-m-Y', now()) ?>" placeholder="" class="form-control input-sm" readonly="readonly">
                                </div>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                
                                <div class="col-md-3 ">
                                    <label class="control-label" for="fact_numero">Factura numero:</label>
                                    <input id="factura_numero" name="factura_numero" type="text" placeholder="Fectura numero" class="form-control input-sm">
                                </div>

                                
                                <div class="col-md-3 ">
                                    <label class="control-label" for="fact_numero">Fecha factura.:</label>
                                    <input id="factura_fecha" name="factura_fecha" type="text" placeholder="Factura fecha" class="form-control input-sm">
                                </div>

                                
                                <div class="col-md-2 ">
                                    <label class="control-label" for="fact_numero">Remito:</label>
                                    <input id="remito" name="remito" type="text" placeholder="Remito" class="form-control input-sm">
                                </div>
                            </div>
                        </div>
                </div>
                </form>
            <!-- </div> -->
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

        </div><?php //require_once (APPPATH.'views/comunes/cobro-pago-compras.php'); ?>
    </div>
</div>

<div class="row">
    <div class="col-md-9">
        <div class="well">
            <form name="form_productos" id="form_productos" class="form-horizontal" >
                
                            <div class="form-group">
                            <div class="col-md-5">
                                <label class="control-label" for="sel_producto">Producto</label>
                                <select id="sel_producto" name="sel_producto" placeholder="Producto" class="form-control input-sm"></select>
                            </div>
                        
                            <div class="col-md-1">
                                <label class="control-label" for="sel_producto">Cantidad</label>
                                <input id="compra_cant" name="compra_cant" type="text" placeholder="Cant." class="form-control input-sm">
                            </div>
                            <div class="col-md-2">
                            <label class="control-label" for="sel_producto">Costo</label>
                                <input id="prod_costo" name="prod_costo" type="text" placeholder="Costo" class="form-control input-sm " required>
                            </div>
                            <div class="col-md-1">
                            <label class="control-label" for="sel_producto">Stock act.</label>
                                <input id="stock_actual" name="stock_actual" type="text" class="form-control input-sm " readonly="readonly">
                            </div>
                            <div class="col-md-2">
                                <label class="control-label" for="sel_producto">Costo act.</label>
                                <input id="producto_costo" name="producto_costo" type="text" class="form-control input-sm " readonly="readonly">
                            </div>
                            <div class="col-md-1">
                                
                                <button class="btn btn-info " id="add" disabled>Agregar</button>
                                <!-- <a class="btn btn-md btn-warning" href="javascript:void(0)" title="Edit" onclick="add_producto()"> Agregar </a> -->
                            </div>
                            </div>
                    
            </form>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>

<div class="col-md-12">
    <hr class="hr_success">
</div>


<div class="col-md-9">
    <form id="frm_items" name="frm_items">
        <h3>Detalle</h3>
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
                <button type="button" id="Guardar_compra" name="Guardar_compra" class="btn btn-success">Guardar </button>
                <!-- <button type="button" id="vaciar" name="vaciar" class="btn btn-warning">Vaciar produtos </button> -->
                <button type="button" id="volver" name="volver" class="btn btn-danger" onclick="location.href='<?php echo base_url(); ?>compras/'">Cancelar compra </button>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<?php require_once(APPPATH . 'views/productos/form_producto.php');?>
<script>
    $('#add').on('click', function() {

        var id = $('#sel_producto').val();
        var cantidad = $('#compra_cant').val();
        var precio = $('#prod_costo').val();
        var link = '<?= base_url() ?>compras/';
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
                    html += "<td><input type='text' name='cantidad[]' value='" + datos.cantidad + "' class='cantidades form-control input-sm'></td>";
                    html += "<td><input type='hidden' name='nombre[]' value='" + datos.nombre + "' class='nombre'><p class='h5'>" + datos.nombre + "</p></td>";
                    html += "<td><input type='hidden' name='precio[]' value='" + datos.precio + "' class='precio'><p class='h5'>" + parseFloat(datos.precio).toFixed(2) + "</p></td>";
                    html += "<td><input type='hidden' name='importe[]' value='" + datos.sub_total + "' class='importe'><p class='h5'>" + parseFloat(datos.sub_total).toFixed(2) + "</p></td>";
                    html += "<input type='hidden' name='id_producto[]' value='" + datos.id_producto + "' class='id_producto'>";
                    html += "<td><button type='button' class='btn btn-danger btn-remove-producto'><span class='glyphicon glyphicon-trash'></span></button></td>";
                    html += "</tr>";
                    $('#items tbody').append(html);
                    clear_selectize_prod();
                    $('#prod_costo').val('');
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
        var link = '<?= base_url() ?>compras/';
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


    $('#Guardar_compra').on('click', function() {
        var compra = $('#compra').serialize();
        var proveedor = $('#id_proveedor').val();
       
        if(proveedor == ''){
            alert('Debe elegir un proveedor');
            return false;
        }
        var items = $('#frm_items').serialize();
        var tpv = $('select#tpv').val();
        var pago = $('#form_pago').serialize();
        var importe_total = $('input[name=importe_total]').val();

        var link = "<?php echo base_url(); ?>compras/";
        $.post(link + "guardar_compra", {
                compra: compra,
                estado: 'Pedido',
                tpv: tpv,
                detalles: items,
                pago: pago,
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
        //
        var id_prod = $('#sel_producto').prop('value');
        $.post("<?= base_url() ?>compras/get_producto_precio", {
                id: id_prod
            },
            function(data) {
                var json = $.parseJSON(data);
                if (json != null) {
                    $('#producto_costo').val(json.producto_costo);
                } else {
                    $('#producto_costo').val('0.00');
                }
                $.post("<?= base_url() ?>compras/get_producto_stock", {
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
    


    var formatName = function(item) {
        return $.trim((item.nombre));
    };
    var formatProducto = function(item) {
        return $.trim((item.producto));
    };

    var xhr;
    var select_proveedor, $select_proveedor;
    var select_producto, $select_producto;

    $select_proveedor = $('#id_proveedor').selectize({
        maxItems: 1,
        valueField: 'id',
        labelField: 'nombre',
        searchField: ['nombre', 'contacto'],
        options: [
            <?php
         
            if ($proveedores) {
                foreach ($proveedores as $prov) {

                    echo "{id:" . $prov->id_proveedor . ", nombre: '" . $prov->prov_nombre . "', contacto: '" . $prov->prov_contacto . "'},";
                }
            } else {
                echo "{id: 0, nombre: 'Sin proveedor', contacto: 'Sin proveedor'},";
            }
            ?>
        ],
        // render: {
        //     option: function(item, escape) {
        //         var nombre = formatName(item);
        //         var label = nombre || item.contacto;
        //         var caption = nombre ? item.contacto : null;
        //         return '<div>' + 'Nombre: <span class=""> ' + escape(label) + '</span> ' + (caption ? ' <span>(' + escape(caption) + ') </span>' : '') + '</div>';
        //     }
        // },
        onChange: function(value) {
         
            if (!value.length) return;
            // select_producto.selectize.disable();
            select_producto.disable();
            select_producto.clearOptions();
            select_producto.load(function(callback) {
                xhr && xhr.abort();
                xhr = $.ajax({
                    url: '<?php echo base_url(); ?>compras/get_producto_json/' + value ,
                    success: function(results) {
                        console.log(value);
                        if(value > 0 ){
                        select_producto.enable();
                        
                        callback(results);
                        }else{
                            alert("Ingrese un proveedor para seleccionar productos!")
                        }
                    },
                    error: function() {
                        callback();
                    }
                })
            });
        }
        // ,create: false,
    });


    $select_producto = $('#sel_producto').selectize({
        // maxItems: 1,
        // valueField: 'producto',
        // labelField: 'producto',
        // searchField: ['producto'],
        valueField: 'id_producto',
        labelField: 'producto',
        searchField: ['producto','stock_act'],
        // options: [
        //     <?php
        //     if (isset($productos)) {
        //         foreach ($productos as $prod) {
        //             echo "{id:" . $prod->id_producto . ", producto: '" . $prod->producto . " - " . $prod->cantidad_medida . $prod->medida . "'},";
        //         }
        //     } else {
        //         echo "Ningun producto";
        //     }
        //     ?>
        // ],
        render: {
            option: function(item, escape) {
                var producto = formatProducto(item);
                var label = producto || item.stock_act;
                var caption = producto ? item.stock_act : null;
                return '<div>' + '<span class="text-left"> ' + escape(label) + '</span> ' + (caption ? ' <span class="text-success h5">(Stock: ' + escape(caption) + ') </span>' : ' <span class="text-danger h5">(Stock: 0) </span>') + '</div>';
            }
        },
        onChange: function(value) {
            $('#add').prop('disabled', false);
        }
        //     var tpv_sel = $('select#tpv').val();
        //     if (value) {
        //         $.ajax({

        //             url: "<?php //echo base_url(); ?>producto/ajax_edit/" + value,
        //             type: "GET",
        //             dataType: "JSON",
        //             success: function(data) {
        //                 //console.log(data);
        //                 //$('#stock_act').val(data.stock_act);
        //                 $('#producto_costo').val(data.producto_costo);
        //             },
        //             error: function(jqXHR, textStatus, errorThrown) {
        //                 alert('Error get data from ajax');
        //             }
        //         });
        //     }
        // },
        //create: false,
    });


    function clear_selectize_prod() {    
        // var prod = $('#sel_producto').selectize();
        select_producto.refreshItems();
        // var control = prod[0].selectize;
        select_producto.clear(true);
    }

    select_proveedor  = $select_proveedor[0].selectize;
	select_producto = $select_producto[0].selectize;
	select_producto.disable();

    function getFormattedDate(d) {
        //console.log(d);
        var d = new Date(d);
        d = ('0' + (d.getDate() + 1)).slice(-2) + "-" + ('0' + (d.getMonth() + 1)).slice(-2) + "-" + d.getFullYear(); //d.getHours()).slice(-2) + ":" + ('0' + d.getMinutes()).slice(-2) + ":" + ('0' + d.getSeconds()).slice(-2);
        return d;
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