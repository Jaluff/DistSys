<div class="row">
    <div class="col-md-4">
        <h3>Mostrar venta </h3>
    </div>

    <div class="col-md-8 text-right">
        <h3>
            <?php  //var_dump($ventas); //exit(); 
            echo "Responsable: " . strtoupper($ventas->usuario); ?>
        </h3>
    </div>
</div>

<div class="row">
    <hr class="hr_success">
    <div class="row col-md-9">
        <form class="form-horizontal" id="form_cliente">
            <div class="panel panel-warning">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <label class="control-label" for="direccion">venta n°:</label>
                                <input type="text" name="numero_venta" id="numero_venta" class="form-control input-sm" value="<?php echo $ventas->id_venta; ?>">
                            </div>
                            <div class="col-md-7">
                            </div>
                            <div class="col-md-3">
                                <label class="  control-label" for="venta_fecha">Fecha:</label>
                                        <input id="venta_fecha" name="venta_fecha" type="text" value="<?php echo $ventas->fecha; ?>" placeholder="" class="form-control input-sm " readonly="readonly">
                            </div>
                            
                            <!-- <div class="col-md-2">
                                <label class="control-label" for="remito">Remito:</label>                                
                                        <input id="remito" name="remito" type="text" placeholder="Remito" class="form-control input-sm" value="<?php //echo $ventas->remito; ?>">
                            </div>
                            <div class="col-md-2">
                                <label class="control-label" for="fact_numero">Factura numero:</label>
                                        <input id="factura_numero" name="factura_numero" type="text" placeholder="Fectura numero" class="form-control input-sm" value="<?php //echo $ventas->factura_numero; ?>">
                            </div>
                            <div class="col-md-2">
                                <label class="control-label" for="fact_numero">Fecha factura.:</label>
                                        <input id="factura_fecha" name="factura_fecha" type="text" placeholder="Factura fecha" class="form-control input-sm">
                            </div> -->
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label" for="venta_cliente">Cliente</label>
                        <input type="text" name="venta_cliente" id="venta_cliente" class="form-control input-sm" value="<?php echo $cliente[0]->cli_nombre; ?>">
                        <input type="hidden" name="id_cliente" id="id_cliente" class="form-control input-sm" value="<?php echo $ventas->cliente; ?>"> 
                        <input type="hidden" name="id_venta" id="id_venta" value="<?php echo $ventas->id_venta; ?>">
                        <input type="hidden" name="tpv" id="tpv" value="<?php echo $ventas->id_tpv; ?>">
                    </div>

                    <div class="col-md-2">
                        <label class="control-label" for="telefono_cliente">Telefono:</label>
                        <input type="text" name="telefono_cliente" id="telefono_cliente" class="form-control input-sm" value="<?php echo $cliente[0]->telefono1; ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="control-label" for="direccion">Direccion:</label>
                        <input type="text" name="direccion" id="direccion" class="form-control input-sm" value="<?php echo $cliente[0]->domicilio1 . " - " . $cliente[0]->localidad1 ; ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="control-label" for="correo_cliente">Correo Electronico:</label>
                        <input type="text" name="correo_cliente" id="correo_cliente" class="form-control input-sm" value="<?php echo $cliente[0]->correo1; ?>">
                    </div>
                    <div class="row">
                    <div class="col-md-12">
                    <div class="col-md-3">
                        <!-- <label class="control-label" for="direccion">Estado de la venta:</label>
                        <select name="venta_estado" id="venta_estado" class="form-control input-sm">
                            <option value="cobrada" <?php echo ($ventas->estado == 'cobrada') ? 'selected' : ''?>>Cobrada</option>
                            <option value="No cobrada" <?php echo ($ventas->estado == 'no cobrada') ? 'selected' : ''?>>No cobrada</option>
                            - <option value="En espera" <?php //($ventas->estado == 'En espera') ? 'Selected' : ''?>>En espera</option> -->
                        <!-- </select>
                        <input type="text" name="venta_estado" id="venta_estado" class="form-control input-sm" value="<?php echo $ventas->estado; ?>"> --> 
                    </div>
                    </div>
                    </div>

                </div>
            </div>
        </form>
<div class="row">
        <div class="col-md-12">
    <div class="well">
        <form name="form_productos" id="form_productos">
            <table class="table table-responsive table-hover ">
                <thead>
                    <th width="30%">Producto</th>
                    <th>Cant.</th>
                    <th>Costo</th>
                    <th>Stock actual</th>
                    <th>Costo actual</th>
                    <th></th>

                    <th></th>
                </thead>
                <tbody>
                    <td>
                        <input id="sel_producto" name="sel_producto" type="text" placeholder="Producto" class="form-control input-sm">
                    </td>
                    <td>
                        <input id="venta_cant" name="venta_cant" type="text" placeholder="Cant." class="form-control input-sm">
                    </td>
                    <td>
                        <input id="prod_costo" name="prod_costo" type="text" placeholder="Costo" class="form-control input-sm " required>
                    </td>
                    <td>
                        <input id="stock_actual" name="stock_actual" type="text" class="form-control input-sm " readonly="readonly">
                    </td>
                    <td>
                        <input id="producto_costo" name="producto_costo" type="text" class="form-control input-sm " readonly="readonly">
                    </td>
                    <td>
                        <button class="btn btn-info btn-sm" id="add">Agregar</button>
                        <?php  ?>
                    </td>
                </tbody>
            </table>
        </form>
    </div>
</div>
</div>

        <div class="cart_list">
            <!-- <h3>Your shopping cart</h3> -->
            <form name="frm_items" id="frm_items">
            <table class="table  table-responsive table-bordered table-striped" id="tbl_items">
                <thead>
                    <th>Codigo</th>
                    <th>Cantidad</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Importe</th>
                    <th></th>
                </thead>
                <tbody>
                    <?php 
                    $total = 0;
                    foreach ($detalles as $value) { ?>
                    <tr>
                        <td>
                            <input type='hidden' name='codigo[]' value='<?php echo $value->codigo; ?>' class='codigo'><p class='h5'><?php echo $value->codigo;?></p>
                            <input type='hidden' name='id_producto[]' value='<?php echo $value->id_producto; ?>' class='id_producto'>
                        </td>
                        <td>
                            <input type='text' name='cantidad[]' value='<?php echo $value->cant_producto; ?>' class='cantidades form-control input-sm'>
                        </td>
                        <td>
                            <input type='hidden' name='nombre[]' value='<?php echo $value->producto . " - " . $value->cantidad_medida . $value->medida; ?>' class='nombre'><p class='h5'><?php echo $value->producto . " - " . $value->cantidad_medida . $value->medida; ?></p>
                        </td>
                        <td>
                            <input type='text' name='precio[]' value='<?php echo $value->precio; ?>' class='precio form-control input-sm'>
                        </td>
                        <td>
                            <input type='hidden' name='importe[]' value='<?php echo $value->importe; ?>' class='importe'><p class='h5'>$<?php echo $value->importe; ?></p>
                        </td>
                        <td>
                            <button type='button' class='btn btn-danger btn-remove-producto'><span class='glyphicon glyphicon-trash'></span></button>
                        </td>
                        
                    </tr>
                    <?php $total += $value->importe; ?>
                    <?php 
                } ?>

                </tbody>
            </table>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-precio">
                <div class="panel-body">
                    <div class="h4 text-center" style="color: white">Importe total</div>
                    <div class="h1 text-center" style="color: white" id="importe_total"><strong>
                            <?php 
                            echo "$" . $total; // = "$" . (float)($ventas->pago_efectivo + $ventas->pago_tarjeta) . ".-"; 
                            ?>
                        </strong>
                        
                    </div>
                    <input type="hidden" name="importe_total"  value="<?php echo $total; ?>">
                </div>

            </div><?php require_once (APPPATH.'views/comunes/cobro-pago.php'); ?>
        </div>
    </div>
                
    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="text-center">
                <a href="javascript:window.history.go(-1);" class="btn btn-info ">Imprimir</a>
                
                <!-- <button type="butoon" id="aprobar" name="aprobar" class="btn btn-success ">Aprobar</button> -->
                <?php if( $ventas->tipo != 'Venta') { ?>
                    <button type="button" id="guardar" name="guardar" class="btn btn-success" value="Pedido">Guardar</button>
                    <button type="button" id="finalizar" name="finalizar" value="Venta" class="btn btn-success">Finalizar</button>
                <?php }?>
                <a href="javascript:window.history.go(-1);" class="btn btn-warning ">Volver</a>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        var estadoventa = $('#venta_estado').val(); 
            // alert (estadoventa);
        if(estadoventa == 'Arribada'){
            $("#arribar").prop('disabled', true);
            $("#arribar").hide();
        }
        if(estadoventa == 'Aprobada'){
            $("#aprobar").hide();
            $("#arribar").hide();
            $("#guardar").hide();
            $('.btn-remove-producto').hide();
        }
        if(estadoventa == 'En espera'){
            $("#aprobar").hide();
            $("#finalizar").show();
        }   
    });

    $('#venta_estado').on('change', function(){
        var estadoventa = $('#venta_estado').val(); 
        if(estadoventa == 'Arribada'){
            // $("#arribar").prop('disabled', true);
            // $("#aprobar").show();
            $("#finalizar").show();
        }
        if(estadoventa == 'Aprobada'){
            $("#aprobar").hide();
            $("#arribar").hide();
        }
        if(estadoventa == 'En espera'){
            $("#aprobar").hide();
            $("#arribar").show();
        }   
    });

    $('#add').on('click', function() {

        var id = $('#sel_producto').val();
        var cantidad = $('#venta_cant').val();
        var precio = $('#prod_costo').val();
        var link = '<?= base_url() ?>ventas/';
        $.post(link + "add_item", {  //add_cart_item
                product_id: id,
                quantity: cantidad,
                price: precio,
                ajax: '1'
            },
            function(data) {
                datos = $.parseJSON(data);
                //alert(datos);
        if (datos.id_producto) {
            html = "<tr>";
            html += "<td><input type='hidden' name='codigo[]' value='" + datos.codigo + "' class='codigo'><p class='h5'>" + datos.codigo +"</p></td>";
            html += "<td><input type='text' name='cantidad[]' value='" + datos.cantidad + "' class='cantidades form-control input-sm'></td>";
            html += "<td><input type='hidden' name='nombre[]' value='" + datos.nombre + "' class='nombre'><p class='h5'>" + datos.nombre + "</p></td>";
            html += "<td><input type='text' name='precio[]' value='" + parseFloat(datos.precio).toFixed(2) + "' class='precio form-control input-sm'></td>";
            html += "<td><input type='hidden' name='importe[]' value='" + datos.sub_total + "' class='importe'><p class='h5'>" + parseFloat(datos.sub_total).toFixed(2) + "</p></td>";
            html += "<input type='hidden' name='id_producto[]' value='" + datos.id_producto + "' class='id_producto'> "+ datos.id_producto;
            html += "<td><button type='button' class='btn btn-danger btn-remove-producto'><span class='glyphicon glyphicon-trash'></span></button></td>";
            html += "</tr>";
            $('#tbl_items tbody').append(html);
            clear_selectize_prod();
            $('#prod_costo').val('');
            $('#venta_cant').val('');
            calcula_total();
        } else {
            alert("Hubo un problema verifique!");
        }
        });
        return false;
    });

    // $('#finalizar').on('click', function() {
    //     var estado = 'Aprobada';
    //     var idventa = $('#id_venta').val();
    //     var link = '<?= base_url() ?>ventas/';
    //     $.post(link + "actualizar_estado", {estado: estado, id: idventa},
    //         function(data) {
    //             if (data) {
    //                 alert('venta actualizada');
    //                 location.href = link ;
    //             } else {
    //                alert("La venta no se pudo actualizar.");
    //              }
    //         });
    //     return false;
    // });

    $('#guardar, #finalizar').on('click', function() {
        //calcula_total();
        // var estado = $('#venta_estado').val();//'Aprobada';
        var estado = $(this).val();//$('#compra_estado').val();//'Aprobada';
        if(estado == 'Venta'){
            var confirmar = confirm("Seguro desea finalizar la venta?")
            if (!confirmar){
                return false;
            }
        }
        var idVenta = $('#id_venta').val();
        var tpv = $('#tpv').val();
        var total_importe = $("input[name=importe_total").val();
        //var pago = $('#form_pago').serialize();
        var items = $('#frm_items').serialize();
        var cliente = $('#form_cliente').serialize();
        
        var link = '<?= base_url() ?>ventas/';
        $.post(link + "guardar_venta", { id: idVenta , cliente: cliente,  detalles: items , total: total_importe ,  tpv: tpv, tipo: estado},
            function(data) {
                if (data) {
                    alert('venta actualizada');
                    location.href = link ;
                } else {
                   alert("La venta no se pudo actualizar.");
                 }
            });
        calcula_total();
        return false;
    });

    $(document).on('click', '.btn-remove-producto', function() {
        $(this).closest("tr").remove();
        calcula_total();
    });

    $(document).on('keyup', '#frm_items input.cantidades', function() {
        cantidad = $(this).val();
        precio   = $(this).closest("tr").find("td:eq(3)").children("input").val();
        importe  = cantidad * precio;
        importe = parseFloat(importe).toFixed(2);
        $(this).closest("tr").find("td:eq(4)").children("p").text("$" + importe);
        $(this).closest("tr").find("td:eq(4)").children("input").val(importe);
        calcula_total();
    });

    $(document).on('keyup', '#frm_items input.precio', function() {
        cantidad = $(this).val();
        precio   = $(this).closest("tr").find("td:eq(1)").children("input").val();
        importe  = cantidad * precio;
        importe = parseFloat(importe).toFixed(2);
        $(this).closest("tr").find("td:eq(4)").children("p").text("$"+importe);
        $(this).closest("tr").find("td:eq(4)").children("input").val(importe);
        calcula_total();
    });
    
    function calcula_total(){
        total = 0;
        $('#tbl_items tbody tr').each(function(){
            total = total + Number($(this).find("td:eq(4)").children("input").val());
        });   
        $("input[name=importe_total").val(total);
        $('#importe_total').text("$" + total);
        
    }  

    $('#sel_producto').on('change', function() {
        var id_prod = $('#sel_producto').prop('value');
        $.post("<?= base_url() ?>ventas/get_producto_precio", {
                id: id_prod
            },
            function(data) {
                var json = $.parseJSON(data);
                if(json != null){
                    $('#producto_costo').val(json.producto_costo);
                }else{
                    $('#producto_costo').val('');
                }
                $.post("<?= base_url() ?>ventas/get_producto_stock", {
                        id: id_prod
                    },
                    function(data) {
                        var json = $.parseJSON(data);
                        
                        if(json != null ){
                            $('#stock_actual').val(json.stock_act);    
                        }else{
                            $('#stock_actual').val("Sin stock");
                        }
                    });
            });

    });

    var formatProducto = function(item) {
        return $.trim((item.producto));
    };

    var prod = $('#sel_producto').selectize({
        maxItems: 1,
        valueField: 'id',
        labelField: 'producto',
        searchField: ['producto', 'stock'],
        options: [
            <?php
            if (isset($productos)) {
                foreach ($productos as $prod) {
                    //echo $prov->id_proveedor;
                    echo "{id:" . $prod->id_producto . ", producto: '" . addslashes($prod->producto) . " - " . $prod->cantidad_medida . $prod->medida . "'},";
                }
            } else {
                echo "Ningun producto";
            }
            ?>
        ],
        render: {
            option: function(item, escape) {
                var producto = formatProducto(item);
                var label = producto || item.stock;
                var caption = producto ? item.stock : null;
                return '<div>' + '<span class=""> ' + escape(label) + '</span> ' + (caption ? ' <span>( Stock: ' + escape(caption) + ') </span>' : '') + '</div>';
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
                        //console.log(data);
                        //$('#stock_act').val(data.stock_act);
                        $('#producto_costo').val(data.producto_costo);
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
</script> 