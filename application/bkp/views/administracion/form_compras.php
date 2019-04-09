<div class="modal" id="compra_modal" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal_grande" role="document">>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="myModalLabel">Movimientos de stock</h3> </div>
            <div class="modal-body">
                <?php  if (isset($message)){ ?>
                    <div id="infoMessage" class="alert alert-success" role="alert">
                        <?php echo $message;?>
                    </div>
                <?php } ?>
                    <div class="row"> 
                        <form action="#" class="form-horizontal" id="frm_compras">
                            <div class="col-md-12">
                                <input type="hidden" value="" name="id_producto" id="id_producto" />
                                <input type="hidden" value="" name="tpv" id="tpv" />
                                
                            </div>
                           
                        <div class="col-md-12">
                            <!-- Nav tabs -->
                            
                            
                            	<div class="col-md-12"> 
                                <div class="h4">Cantidades</div>
                                <hr>                          
                                    <div class="col-md-6">
                                        <!-- Text input-->
                                        <div class="form-group ">
                                            <label class="col-md-5 control-label " for="cant">Cantidad comprada</label>
                                            <div class="col-md-7 ">
                                                <input id="cant" name="cant" type="text" placeholder="" class="form-control input-sm ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Text input-->
                                        <div class="form-group ">
                                            <label class="col-md-5 control-label" for="stock_act">Stock actual</label>
                                            <div class="col-md-7 ">
                                                <input id="stock_act" name="stock_act" type="text" placeholder="" class="form-control input-sm " readonly="readonly">
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>  
                            
                                <div class="col-md-12">                           
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label class="col-md-5 control-label" for="stock_obs">Observacion</label>
                                            <div class="col-md-7 ">
                                                <input id="stock_obs" name="stock_obs" type="text" placeholder="" class="form-control input-sm " >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label class="col-md-5 control-label" for="stock_min">Stock minimo</label>
                                            <div class="col-md-7 ">
                                                <input id="stock_min" name="stock_min" type="text" placeholder="" class="form-control input-sm " >
                                            </div>
                                        </div>
                                    </div>
                                </div>  

                                
                                <div class="col-md-12">                           
                                
                                <div class="h4">Costos y precios</div>
                                <hr>
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
                                
                                <div class="col-md-12">
                                    <p class="h6 text-center">Nota: los valores y margenes de los productos seran unicos para todas las sucursales, cambiar solo si se desean actualizar los mismos</p>
                                </div>
                                
                                
                            
                        </div>   
                        <!-- Button (Double) -->
                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                            <div class="text-center">
                                <div class="form-group">
                                    <button  class="btn btn-success" onclick="save_compra(); " value="Guardar_compra" id="Guardar_compra">Guardar</button>
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










<script>


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



function editar_compra(id , tpv) {
    save_method = 'update';
    $('#frm_compras')[0].reset(); // reset form on modals
    //$('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    //Ajax Load data from ajax
    $.ajax({
        url: "<?php echo base_url();?>administracion/compras/ajax_edit/" + id + '/' + tpv
        , type: "GET"
        , dataType: "JSON"
        , success: function (data) {
//console.log(data);
            /* Precios*/
            $('[name="id_producto"]').val(data.id_producto);
            $('[name="tpv"]').val(tpv);
            $('[name="producto"]').val(data.producto);
            $('[name="costo"]').val(data.producto_costo);
            $('[name="pv_principal"]').val(data.producto_con_margen);
            $('[name="margen_principal"]').val(data.producto_margen);
            $('[name="impuesto"]').val(data.impuestos);
            $('[name="stock_obs"]').val(data.observacion);
            $('[name="pv_iva"]').val(data.producto_precio_venta);
            $('[name="stock_act"]').val(data[0].stock_act);
            $('[name="stock_min"]').val(data[0].stock_min);
            $('#compra_modal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text($('[name="producto"]').val()); // Set title to Bootstrap modal title
        }
        , error: function (jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}

function save_compra() {
    $('#Guardar_compra').text('guardando...'); //change button text
    $('#Guardar_compra').attr('disabled', true); //set button disable
    
    var url = "<?php echo site_url('compras/ajax_update_stock');?>";
    
    // ajax adding data to database
    $.ajax({
        url: url
        , type: "POST"
        , data: $('#frm_compras').serialize()
        , dataType: "JSON"
        , success: function (datos) {
            if (datos.status) //if success close modal and reload ajax table
            {
                //console.log('datos: ' + datos);

                $('#compra_modal').modal('hide');
                reload_table();
            }
            $('#Guardar_compra').text('Guardar'); //change button text
            $('#Guardar_compra').attr('disabled', false); //set button enable
        }
        , error: function (jqXHR, textStatus, errorThrown) {
            alert('Error al guardar los cambios de la compra');
            $('#Guardar_compra').text('Guardar'); //change button text
            $('#Guardar_compra').attr('disabled', false); //set button enable
        }
    });
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
