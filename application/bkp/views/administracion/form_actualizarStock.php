<div class="modal" id="actualizarStock_modal" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">
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
                        <form action="#" class="form-horizontal" id="frm_actualizar">
                            <div class="col-md-12">
                                <input type="hidden" value="" name="id_producto" id="id_producto" />

                                <input type="hidden" value="" name="stock_min" id="stock_min" />                                
                                
                            </div>
                           
                        <div class="col-md-12">
                            <!-- Nav tabs -->
                            	<div class="col-md-12">
                            		<div class="col-md-6">
                            			<p class="h4">Enviar desde:</p>
                            			<div class="form-group ">
                                            <label class="col-md-5 control-label" for="sel_tpv_origen">Almacen origen</label>
                                            <div class="col-md-7 ">
                            					<select id="sel_tpv_origen" name="sel_tpv_origen" class="form-control input-sm ">
                                                    <option >Seleccione</option>
                                                   <?php foreach ($tpv as $t):?>
                                                    <?php if($t->id_tpv != 0){ ?>
                                                    <option value="<?php echo $t->id_tpv;?>"><?=$t->tpv_nombre?></option>
                                                    <?php }?>
                                                    <?php endforeach;?>
                                                </select>
                            				</div>
                    					</div>
                					</div>

                            		<div class="col-md-6">
                            			<p class="h4">Enviar hacia:</p>
                            			<div class="form-group ">
                                            <label class="col-md-5 control-label" for="sel_tpv_destino">Almacen destino</label>
                                            <div class="col-md-7 ">
                            					<select id="sel_tpv_destino" name="sel_tpv_destino" class="form-control input-sm ">
                                                    <option >Seleccione</option>
						                           <?php foreach ($tpv as $t):?>
						                            <?php if($t->id_tpv != 0){ ?>
						                            <option value="<?php echo $t->id_tpv;?>"><?=$t->tpv_nombre?></option>
						                            <?php }?>
						                            <?php endforeach;?>
						                        </select>
                            				</div>
                    					</div>
                            		</div>
                            	</div>
                            
                            	<div class="col-md-12">                           
                                    <div class="col-md-6">
                                        <!-- Text input-->
                                        <div class="form-group ">
                                            <label class="col-md-5 control-label " for="p_cant">Cantidad a enviar</label>
                                            <div class="col-md-7 ">
                                                <input id="p_cant" name="p_cant" type="text" placeholder="" class="form-control input-sm ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Text input-->
                                        
                                    </div>
                                    
                                </div>  
                            
                                <div class="col-md-12">                           
                                    <div class="col-md-6">
                                       <div class="form-group ">
                                        
                                            <label class="col-md-5 control-label" for="stock_origen">Stock origen</label>
                                            <div class="col-md-5 ">

                                                <input id="stock_origen" name="stock_origen" type="text" placeholder="" class="form-control input-sm " readonly="readonly">
                                            </div>
                                            <div class="col-md-1 col-xs-12">
                                                <a href="#"  class="btn btn-info arrow-circle-right" onclick="enviar_stock(); " value="enviar_stock" id="enviar_stock">
                                                    <i class="glyphicon glyphicon-menu-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                    <div class="form-group ">
                                            <label class="col-md-5 control-label" for="stock_destino">Stock Destino</label>
                                            <div class="col-md-7 ">
                                                <input id="stock_destino" name="stock_destino" type="text" placeholder="" class="form-control input-sm " readonly="readonly">
                                            </div>
                                        </div>
                                        <!-- <div class="form-group ">
                                            <label class="col-md-5 control-label" for="costo">Stock minimo</label>
                                            <div class="col-md-7 ">
                                                <input id="stock_min" name="stock_min" type="text" placeholder="" class="form-control input-sm " >
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                                
                                    
                                
                            
                        </div>   
                        <!-- Button (Double) -->
                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                            <div class="text-center">
                                <div class="form-group">
                                    <!-- <button  class="btn btn-success" onclick="enviar_stock(); " value="Guardar_stock" id="Guardar_stock">Guardar</button> -->
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
$('#sel_tpv_destino').change(function(){
	var id = $('#id_producto').val();
	var tpv = $('#sel_tpv_destino option:selected').val();
	//console.log(id + '-' + tpv);
	$.ajax({
        url: "<?php echo base_url();?>administracion/compras/get_producto_stock/" + id + '/' + tpv
        , type: "post"
        , dataType: "JSON"
        ,data: {id:id, tpv:tpv}
        , success: function (data) {
//console.log(data);
            /* Precios*/
            //console.log(data);
            $('#stock_destino').val(data.stock_act);
            
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
        
    });
});

$('#sel_tpv_origen').change(function(){
    var id = $('#id_producto').val();
    var tpv = $('#sel_tpv_origen option:selected').val();
    //console.log(id + '-' + tpv);
    $.ajax({
        url: "<?php echo base_url();?>administracion/compras/get_producto_stock/" + id + '/' + tpv
        , type: "post"
        , dataType: "JSON"
        ,data: {id:id, tpv:tpv}
        , success: function (data) {
//console.log(data);
            /* Precios*/
            //console.log(data);
            $('#stock_origen').val(data.stock_act);
            
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
        
    });
});


function movimiento_stock(id , tpv) {
    save_method = 'update';
    $('#frm_actualizar')[0].reset(); // reset form on modals
    //$('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    //Ajax Load data from ajax
    $.ajax({
        url: "<?php echo base_url();?>administracion/compras/ajax_enviar_producto/" + id + '/' + tpv
        , type: "GET"
        , dataType: "JSON"
        , success: function (data) {
//console.log(data);
            /* Precios*/
            $('[name="id_producto"]').val(data.id_producto);
            $('[name="tpv"]').val(data[0].tpv_nombre);
            $('[name="producto"]').val(data.producto);
            var prod = data.producto;
            $('[name="stock_act"]').val(data[1].stock_act);
            $('[name="stock_min"]').val(data[1].stock_min);
            //var id_t = data[0].id_tpv;
            //console.log (id_t);
            //$("select#sel_tpv option[value='"+ id_t +"']").remove();
            $('#actualizarStock_modal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text(prod); // Set title to Bootstrap modal title
        }
        , error: function (jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}


function enviar_stock() {

    var id_prod = $('#id_producto').val() ;
    var prod_cant = $('#p_cant').val();
    var stk_origen = $('#stock_origen').val();
    var stk_destino = $('#stock_destino').val();
    var alm_origen = $('#sel_tpv_origen').val();
    var alm_destino = $('#sel_tpv_destino').val();
    var stk_mini = $('#stock_min').val();
//alert(prod_cant + '-' + stk_origen);
    if (prod_cant < stk_origen){
        
        alert('No hay suficientes productos para enviar...!');
    
    }else{
        
        
        $.ajax({
            url: "<?php echo site_url('administracion/compras/ajax_send_stock');?>"
            , type: "post"
            , data: {idp:id_prod, tpv_origen: alm_origen , tpv_destino: alm_destino, cantidad: prod_cant , stock_origen: stk_origen, stock_destino: stk_destino, stock_minimo: stk_mini}

            , dataType: "JSON"
            , success: function (datos) {
               
                if (datos.status) //if success close modal and reload ajax table
                {
                    alert('Stock actualizado...!');
                    $('#actualizarStock_modal').modal('hide');
                    reload_table();
                }
                
            }
            , error: function (jqXHR, textStatus, errorThrown) {
                alert('Error al actualizar los cambios de stock');
            }


        } );
}
}




</script>
