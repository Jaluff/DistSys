<div class="modal" id="producto_modal" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal_grande" role="document">>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="myModalLabel"></h3> </div>
            <div class="modal-body">
                <?php  if (isset($message)){ ?>
                    <div id="infoMessage" class="alert alert-success" role="alert">
                        <?php echo $message;?>
                    </div>
                <?php } ?>
                    <div class="row"> 
                        <form action="#" class="form-horizontal" id="producto">
                            <div class="col-md-12">
                                <input type="hidden" value="" name="id_producto" id="id_producto" />
                                
                            </div>
                           
                        <div class="col-md-12">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#datos_producto" aria-controls="datos_producto" role="tab" data-toggle="tab">Datos del producto</a></li>
                                <li role="presentation" class=""><a href="#datos_precios" aria-controls="datos_precios" role="tab" data-toggle="tab">Precios</a></li>
                                <li role="presentation"><a href="#datos_estimacion" aria-controls="datos_estimacion" role="tab" data-toggle="tab">Estimacion de alimentos</a></li>
                            </ul>
                            <div class="tab-content form-horizontal">
                                


                            <div role="tabpanel" class="tab-pane active" id="datos_producto">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <!-- Text input-->
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="codigo">Codigo</label>
                                            <div class="col-md-7 col-xs-12">
                                                <input id="codigo" name="codigo" type="text" placeholder="Codigo producto" class="form-control input-sm"> <span class="help-block">Ingrese el codigo deseado del producto</span> </div>
                                        </div>
                                    </div>
                                        <!-- Text input-->
                                    <div class="col-md-6">    
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="producto">Producto</label>
                                            <div class="col-md-7 ">
                                                <input id="producto" name="producto" type="text" placeholder="Nombre del producto" class="form-control input-sm"> <span class="help-block">Ingrese el nombre del producto</span> </div>
                                        </div>
                                        
                                    </div>
                                </div>                                 

                                <div class="col-md-12">    
                                    <div class="col-md-6">
                                    <!-- Select Basic -->
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="codigo_barras">Codigo de barras</label>
                                            <div class="col-md-7 ">
                                                <input type="text" id="codigo_barras" name="codigo_barras" class="form-control input-sm" placeholder="Codigo de baras">
                                                <span class="help-block">Codigo de barras del producto</span> </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                    <!-- Select basic-->
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="estado">Estado</label>
                                            <div class="col-md-7 ">
                                                <select id="estado" name="estado" class="form-control input-sm ">
                                                    <option value="Activo">Activo</option>
                                                    <option value="Inactivo">Inactivo</option>
                                                </select> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">       
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="tipo">Tipo</label>
                                            <div class="col-md-7 ">
                                                <select id="tipo" name="tipo" class="form-control input-sm ">
                                                    <?php 
                                                    foreach ($tipo as $value) {?>
                                                        <option value="<?=$value->tipo?>"><?=$value->tipo?></option>
                                                    <?php }?>
                                                </select> 
                                                <span class="help-block">¿De qué tipo de producto se trata?</span> </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <!-- <span class="badge" onclick="add_marca();">
                                                 <i class="glyphicon glyphicon-plus text-center"></i>  
                                            </span> -->

                                            <label class="col-md-4 control-label" for="tipo">Marca</label>
                                            <div class="col-md-7 ">
                                                <select id="marca" name="marca" class="form-control input-sm ">
                                                    <?php 
                                                    
                                                    foreach ($marcas as $value) {?>
                                                        <option value="<?=$value->marca?>"><?=$value->marca?></option>
                                                    <?php }?>
                                                </select> 
                                                <span class="help-block">¿Seleccione la marca del producto</span> </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="col-md-6">
                                    <!-- Text input-->
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="especie">Especie</label>
                                            <div class="col-md-7 ">
                                                <select id="especie" name="especie" class="form-control input-sm ">
                                                    <?php 
                                                    
                                                    foreach ($especie as $value) {?>
                                                        <option value="<?=$value->especie?>"><?=$value->especie?></option>
                                                    <?php }?>
                                                </select> 
                                                <span class="help-block">¿A qué especie se aducua este producto?</span> </div>
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="col-md-12">    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="medida">Tipo medida</label>
                                            <div class="col-md-3 ">
                                                <select id="medida" name="medida" class="form-control input-sm ">
                                                    <?php 
                                                    //var_dump($medida);
                                                    foreach ($medida as $m) {?>
                                                        <option value="<?=$m->medida?>"><?=$m->medida?></option>
                                                    <?php }?>
                                                </select> 

                                            </div>
                                        </div>
                                    
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="cantidad">Cantidad</label>
                                            <div class="col-md-3 ">
                                                <input id="cantidad" name="cantidad" type="text" class="form-control input-sm"> 
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="descripcion">Descripcion</label>
                                        <div class="col-md-9 ">
                                            <input type="text" id="descripcion" name="descripcion"  class="form-control input-sm  "> 
                                            <span class="help-block">Breve descripcion de este producto</span> 
                                        </div>
                                    </div>
                                </div>
                            </div>   



                            </div>

                            <div role="tabpanel" class="tab-pane" id="datos_precios">
                                <div class="col-md-12">                           
                                    <div class="col-md-4">
                                        <!-- Text input-->
                                        <div class="form-group has-error">
                                            <label class="col-md-5 control-label text-danger" for="costo">Precio de costo ($)</label>
                                            <div class="col-md-7 ">
                                                <input id="costo" name="costo" type="text" placeholder="" class="form-control input-sm ">
                                            </div>
                                        </div>
                                    </div>
                                
                                    
                                    
                                
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-md-5 control-label text-warning" for="pv_iva"><u><b>Precio venta ($)</b></u></label>
                                            <div class="col-md-7 ">
                                                <input id="pv_iva" name="pv_iva" type="text" placeholder="" class="form-control input-sm" > 
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group has-success">
                                            <label class="col-md-5 control-label" for="margen_principal">Margen (%)</label>
                                            <div class="col-md-7 ">
                                                <input id="margen_principal" name="margen_principal" type="text" placeholder="" class="form-control input-sm " readonly="readonly">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    
                                <!-- <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group has-success">
                                            <label class="col-md-5 control-label" for="margen_descuento">Con descuento (%)</label>
                                            <div class="col-md-7 ">
                                                <input id="margen_descuento" name="margen_descuento" type="text" placeholder="" class="form-control input-sm"> 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-5 control-label" for="pv_descuento">P.V. descuento ($)</label>
                                            <div class="col-md-7 ">
                                                <input id="pv_descuento" name="pv_descuento" type="text" placeholder="" class="form-control input-sm" readonly> 
                                            </div>
                                        </div>
                                    </div>
                                </div> -->

                                <!-- <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group has-success">
                                            <label class="col-md-5 control-label" for="margen_descuento2">Con descuento 2 (%)</label>
                                            <div class="col-md-7 ">
                                                <input id="margen_descuento2" name="margen_descuento2" type="text" placeholder="" class="form-control input-sm"> 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-5 control-label" for="pv_descuento2">P.V. descuento 2 ($)</label>
                                            <div class="col-md-7 ">
                                                <input id="pv_descuento2" name="pv_descuento2" type="text" placeholder="" class="form-control input-sm" readonly> 
                                            </div>
                                        </div>
                                    </div>
                                </div> -->

                            </div>


                            <div role="tabpanel" class="tab-pane" id="datos_estimacion">
                                <div class="col-md-12"> 
                                    <div class="panel panel-primary">  
                                        La estimación del producto permite calcular la cantidad de días que durará el producto, de ésta forma podrá enviar un recordatorio a sus clientes cuando el producto esté proximo a vencer o a terminar. 
                                    </div>                        
                                    
                                </div>  

                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-5 control-label" for="estimacion_small">Raza pequeña (Gr. x día)</label>
                                            <div class="col-md-7 ">
                                                <input id="estimacion_small" name="estimacion_small" type="text" placeholder="" class="form-control input-sm"> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-5 control-label" for="estimacion_medium">Raza mediana (Gr. x día)</label>
                                            <div class="col-md-7 ">
                                                <input id="estimacion_medium" name="estimacion_medium" type="text" placeholder="" class="form-control input-sm"> 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                </div>

                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-5 control-label" for="estimacion_large">Raza grande (Gr. x día)</label>
                                            <div class="col-md-7 ">
                                                <input id="estimacion_large" name="estimacion_large" type="text" placeholder="" class="form-control input-sm">  </div>
                                        </div>
                                    </div>
                                    
                                    
                                </div>

                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-5 control-label" for="cantidad_dias">Cant. Dias </label>
                                            <div class="col-md-7 ">
                                                <input id="cantidad_dias" name="cantidad_dias" type="text" placeholder="" class="form-control input-sm">  
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                            </div>
                        </div>   
                        <!-- Button (Double) -->
                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                            <div class="text-center">
                                <div class="form-group">
                                    <button  class="btn btn-success" onclick="save_producto(); " value="Guardar_producto" id="Guardar_producto">Guardar</button>
                                    <!-- <button id="Guardarymascota" name="GuardarMascota" class="btn btn-info">Guardar y agregar mascota</button> -->
                                    <button id="Cancelar" name="Cancelar" data-dismiss="modal" class="btn btn-warning">Cancelar</button>
                                </div>
                            </div>
                            </div>
                            </div>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>



<!-- <div class="modal" id="marca_modal" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal_chico" role="document">>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="myModalLabel"></h3> 
            </div>
            <div class="modal-body">
                <?php  if (isset($message)){ ?>
                    <div id="infoMessage" class="alert alert-success" role="alert">
                        <?php echo $message;?>
                    </div>
                <?php } ?>
                    <div class="row"> 
                        <form action="#" class="form-horizontal" id="marcas">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-5 control-label" for="nueva_marca">Nueva marca</label>
                                        <div class="col-md-7 ">
                                            <input id="nueva_marca" name="nueva_marca" type="text" placeholder="" class="form-control input-sm">  
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <table class="table table-bordered table-condensed table-responsive table-stripped">
                                        <thead>
                                            <tr>
                                                <th>Marcas</th>
                                                <th>Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            foreach ($marcas as $value) {?>
                                                <tr>
                                                    <td>
                                                        <?=$value->marca?>
                                                    </td>
                                                    <td>
                                                        eliminiar
                                                    </td>
                                                </tr>
                                            <?php }?>                    
                                        </tbody>
                                    </table>    
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                <hr>
                                    <div class="text-center">
                                        <div class="form-group">
                                            <button  class="btn btn-success" onclick="save_marca(); " value="Guardar_marca" id="Guardar_marca">
                                            Agregar
                                            </button>
                                    
                                            <button id="Cancelar" name="Cancelar" data-dismiss="modal" class="btn btn-warning">Cerrar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>


 -->






<script>


//$("#margen_principal").on("keyup", calcular_precio);
$("#costo").on("keyup", calcular_precio);
$("#pv_iva").on("keyup", calcular_precio);
//$("#impuesto").on("keyup", calcular_precio);
//$("#margen_descuento").on("keyup", calcular_precio);
//$("#margen_descuento2").on("keyup", calcular_precio);

function calcular_precio(){
    var valor = 0;
   
    var costo = parseFloat( $('#costo').val());
    var venta = parseFloat( $('#pv_iva').val());


    //var porcentaje = parseFloat( $('#margen_principal').val());
    //var iva = parseFloat( $('#impuesto').val());
    

        margen =   [( venta - costo) / venta ] * 100  ;
        //con_iva = [ margen / (100 - iva ) ] * 100 ;
        
      
        // console.log (margen  + '-----' + con_iva);
    
        
    // if(!isNaN(margen && margen > 0)){
    //     $("#pv_principal").val(margen.toFixed(2));
    // }

    if(!isNaN(costo && costo > 0)){
        $('#margen_principal').val(margen.toFixed(2));
    }
    
}




    /*
     *   funciones para la gestion de productos
     */
function add_producto() {
    save_method = 'add';
    $('#producto')[0].reset(); // reset form on modals
    //$('.form-group').removeClass('has-error'); // clear error class

            $('[name="stock_actual"]').prop('readonly', false);
    
    $('.help-block').empty(); // clear error string
    $('#producto_modal').modal('show'); // show bootstrap modal
    $('.modal-title').text('Nuevo producto'); // Set Title to Bootstrap modal title
}

// function add_marca() {
//     save_method = 'add';
//     $('#marcas')[0].reset(); // reset form on modals
//     //$('.form-group').removeClass('has-error'); // clear error class
//     $('.help-block').empty(); // clear error string
//     $('#marca_modal').modal('show'); // show bootstrap modal
//     $('.modal-title').text('Administrar marcas'); // Set Title to Bootstrap modal title
// }

function editar_producto(id) {
    save_method = 'update';
    $('#producto')[0].reset(); // reset form on modals
    //$('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    //Ajax Load data from ajax
    $.ajax({
        url: "<?php echo base_url();?>producto/ajax_edit/" + id
        , type: "GET"
        , dataType: "JSON"
        , success: function (data) {
            /* Producto */
            $('[name="id_producto"]').val(data.id_producto);
            $('[name="producto"]').val(data.producto);
            $('[name="codigo"]').val(data.codigo);
            $('[name="codigo_barras"]').val(data.codigo_barras);
            $('[name="tipo"]').val(data.tipo);
            $('[name="marca"]').val(data.marca);
            $('[name="especie"]').val(data.especie);
            $('[name="descripcion"]').val(data.descripcion);
            $('[name="stock_minimo"]').val(data.stock_minimo);
            $('[name="stock_actual"]').val(data.stock_actual);
            if(save_method ){
            $('[name="stock_actual"]').prop('readonly', true);
            }
            $('[name="estado"]').val(data.estado);
            $('[name="medida"]').val(data.medida);
            $('[name="cantidad"]').val(data.cantidad_medida);

            /* Precios*/

            $('[name="costo"]').val(data.producto_costo);
            $('[name="pv_principal"]').val(data.producto_con_margen);
            //$('[name="pv_descuento"]').val(data.producto_venta_dos);
            //$('[name="pv_descuento2"]').val(data.producto_venta_tres);
            $('[name="margen_principal"]').val(data.producto_margen);
            $('[name="impuesto"]').val(data.impuestos);
            $('[name="pv_iva"]').val(data.producto_precio_venta);


            /* Estimacion */
            $('[name="estimacion_small"]').val(data.estimacion_small);
            $('[name="estimacion_medium"]').val(data.estimacion_medium);
            $('[name="estimacion_large"]').val(data.estimacion_large);
            $('[name="cantidad_dias"]').val(data.estimacion_dias);

            $('#producto_modal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Editar producto'); // Set title to Bootstrap modal title
        }
        , error: function (jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}

function save_producto() {
    $('#Guardar_producto').text('guardando...'); //change button text
    $('#Guardar_producto').attr('disabled', true); //set button disable
    var url;
    if (save_method == 'add') {
        url = "<?php echo site_url('producto/ajax_add');?>";
    }
    else {
        url = "<?php echo site_url('producto/ajax_update');?>";
    }
    // ajax adding data to database
    $.ajax({
        url: url
        , type: "POST"
        , data: $('#producto').serialize()
        , dataType: "JSON"
        , success: function (datos) {
            if (datos.status) //if success close modal and reload ajax table
            {
                console.log('datos: ' + datos);
                $('#producto_modal').modal('hide');
                reload_table();
            }
            $('#Guardar_producto').text('Guardar'); //change button text
            $('#Guardar_producto').attr('disabled', false); //set button enable
        }
        , error: function (jqXHR, textStatus, errorThrown) {
            alert('Error al guardar los cambios del producto');
            $('#Guardar_producto').text('Guardar'); //change button text
            $('#Guardar_producto').attr('disabled', false); //set button enable
        }
    });
}


// function save_marca() {
//     $('#Guardar_marca').text('guardando...'); //change button text
//     $('#Guardar_marca').attr('disabled', true); //set button disable
//     var url;
//     if (save_method == 'add') {
//         url = "<?php echo site_url('marca/ajax_add');?>";
//     }
//     else {
//         url = "<?php echo site_url('marca/ajax_update');?>";
//     }
//     console.log($('#nueva_marca').val());
//     // ajax adding data to database
//     $.ajax({
//         url: url
//         , type: "POST"
//         , data: $('#marcas').serialize()
//         , dataType: "JSON"
//         , success: function (datos) {
//             if (datos.status) //if success close modal and reload ajax table
//             {
//                 console.log('datos: ' + datos);
//                 $('#marca_modal').modal('hide');
//                 alert('Nueva marca guardada con exito!');
//                 //reload_table();
//             }
//             $('#Guardar_marca').text('Guardar'); //change button text
//             $('#Guardar_marca').attr('disabled', false); //set button enable
//         }
//         , error: function (jqXHR, textStatus, errorThrown) {
//             alert('Error al guardar los cambios en marca');
//             $('#Guardar_marca').text('Guardar'); //change button text
//             $('#Guardar_marca').attr('disabled', false); //set button enable
//         }
//     });
// }

function delete_producto(id) {
    if (confirm('Esta seguro que desea eliminiar este producto?')) {
        // ajax delete data to database
        $.ajax({
            url: "<?php echo site_url('producto/ajax_delete')?>/" + id
            , type: "POST"
            , dataType: "JSON"
            , success: function (data) {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
            }
            , error: function (jqXHR, textStatus, errorThrown) {
                alert('Error eliminando el producto');
            }
        });
    }
}
/**
 *   Fin funciones de clientes
 */
function getFormattedDate(d) {
    console.log(d);
    var d = new Date(d);
    d = ('0' + (d.getDate() + 1)).slice(-2) + "-" + ('0' + (d.getMonth() + 1)).slice(-2) + "-" + d.getFullYear(); //d.getHours()).slice(-2) + ":" + ('0' + d.getMinutes()).slice(-2) + ":" + ('0' + d.getSeconds()).slice(-2);
    return d;
}
</script>
