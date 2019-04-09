
<div class="row">
    
        <div class="col-md-4">
            <h3>Mostrar venta </h3> 
        </div>
        
        <div class="col-md-8 text-right">
	        <h3>
	        <?php echo "Cobrador: " . strtoupper($ventas->cobrador);?>
	        </h3>   
        </div>
       
        
   
</div>

<div class="row">
 <hr class="hr_success">
    <div class="row col-md-9">



        <form class="form-horizontal" id="form_cliente">
            <div class="panel panel-success">
                <div class="panel-body">
                    <div class="col-md-5">
                         <label class="control-label" for="cliente">Cliente</label> 
                        <input type="text" name="cliente_nombre" id="cliente_nombre" class="form-control input-sm" value="<?php echo $cliente->cli_nombre;?>">
                         <input type="hidden" name="cliente" id="cliente" class="form-control input-sm" value="<?php echo $cliente->id_cliente;?>">
                          <input type="hidden" name="id_venta" id="id_venta"  value="<?php echo $ventas->id_venta;?>">
                    </div>
        
                    <div class="col-md-2">
                        <label class="control-label" for="doc">Docuento</label> 
                        <input type="text" name="doc" id="doc" class="form-control input-sm" value="<?php echo $cliente->cli_doc;?>">                
                    </div>
                    <div class="col-md-5">
                        <label class="control-label" for="direccion">Direccion</label> 
                        <input type="text" name="direccion" id="direccion" class="form-control input-sm" value="<?php echo $cliente->cli_direccion;?>">                
                    </div>
                    
                </div>
            </div>
        </form>




        
    
    <?php //$this->view($content); ?>
     
    <div class="cart_list">
        <!-- <h3>Your shopping cart</h3> -->
        <table class="table  table-responsive table-bordered table-striped">
        	<thead>
	        	<th>Cantidad</th>
	        	<th>Producto</th>
	        	<th>Precio</th>
	        	<th>Importe</th>
        	</thead>
        	<tbody>
        		<?php 
        		$total = 0;
        		foreach ($detalles as $value) {?>
        			<tr>
	        			<td><?php echo $value->cant_producto;?></td>
	        			<td><?php echo $value->descripcion;?></td>
	        			<td>$<?php echo $value->precio;?></td>
	        			<td>$<?php echo $value->importe;?></td>
        			</tr>
	        			<?php $total += $value->importe; ?>
        		<?php }?>
        		
        	</tbody>
        </table>





    </div>
    
        
    </div>
    


        
      

<div class="row">
    <div class="col-md-3">
        <div class="panel panel-precio">
            <div class="panel-body">
                <div class="h4 text-center" style="color: white">Importe total</div>
                <div class="h1 text-center"  style="color: white"><strong>
                    <?php 
                        echo "$" . $total ;// = "$" . (float)($ventas->pago_efectivo + $ventas->pago_tarjeta) . ".-"; 
                    ?>
                    </strong>
                    <input type="hidden" id="total_importe" value="<?php echo $total; ?>">
                </div>

            </div>

        </div>

        <div class="panel panel-pago ">
            <div class="panel-body ">
                
                <form name="form_pago" id="form_pago" method="post">
                    <div class="form-group">
                        <label for="metodo_pago" ><h4 style="color: white" class="text-center">Forma de pago</h4></label>
                        <?php if ($ventas->estado == 'cobrada'){?>

                        	<input type="text" name="metodo_pago" id="metodo_pago" value="<?php echo strtoupper($ventas->metodoPago);?>"  class="form-control" readonly="readonly">
								<?php //echo ($ventas->estado == 'cobrada') ? 'readonly="readonly"': '' ?>
                        <?php }else{ ?>
                        	<select name="metodo_pago" id="metodo_pago" class="form-control">
	                            <option value='efectivo'>Efectivo</option>
	                            <option value='tarjeta'>Tarjeta</option>
	                            <option value='ambos'>Ambos</option>
	                        </select>
                        <?php }?>
                    </div>

                    <div class="form-group" id="div_efectivo">
                    <label for="recibido_efectivo">Efectivo</label>
                        <div class="input-group" id="div_efectivo">
                            <div class="input-group-addon">$</div>
                            <input type="text" name="recibido_efectivo" id="recibido_efectivo" value="<?php echo $ventas->pago_efectivo;?>"  class="form-control "
								<?php echo ($ventas->estado == 'cobrada') ? 'readonly="readonly"': '' ?>
                            >
                        </div>
                    </div>

                    <div id="div_tarjeta">
                    <div class="form-group">
                        <label for="tarjeta">Tarjeta</label>
                        	<?php if ($ventas->estado == 'cobrada'){?>    
                        	<input type="text" name="tarjeta" id="tarjeta" value="<?php echo strtoupper($ventas->tarjeta);?>"  class="form-control " readonly="readonly">
                        	<?php }else{ ?>
                        		<select name="tarjeta" id="tarjeta" class="form-control " >
		                            <option value="">Seleccione tarjeta</option>
		                            <option value="Visa">Visa</option>
		                            <option value="Mastercard">Mastercard</option>
		                            <option value="Dinners">Dinners</option>
		                            <option value="Nevada">Nevada</option>
		                            <option value="Cabal">Cabal</option>
		                            

		                        </select>
                        	<?php }?>
                    </div>
                    
                    <div class="form-group" >
                        <div class="input-group" >
                            <div class="input-group-addon">$</div>
                            <label for="recibido_tarjeta"></label>
                            <input type="text" name="recibido_tarjeta" id="recibido_tarjeta" value="<?php echo $ventas->pago_tarjeta;?>" class="form-control " 
                            <?php echo ($ventas->estado == 'cobrada') ? 'readonly="readonly"': '' ?>
                            >
                        </div>
                    </div>
                    </div>

                    

                </form>
            </div>

        </div>

        <div class="text-right">
            
            <a href="javascript:window.history.go(-1);" class="btn btn-success ">Volver</a>

            <?php
            if ($ventas->estado == 'cobrada'){
            	echo anchor('#', 'Imprimir', 'class="btn btn-primary " id="factura"');
            }else{
            	echo anchor('#', 'Cobrar', 'class="btn btn-primary " id="factura"');
            }
            ?>
            </div>
    </div>
</div>
</div>


<?php
//var_dump($ventas);
//var_dump($detalles);

?>

<script type="text/javascript">
	$('#factura').on('click', function(){
        var cliente = $('#form_cliente').serialize();
        //alert(cliente);
        var pago = $('#form_pago').serialize();
        var total_venta = $('#total_importe').val();
        var idVenta = $('#id_venta').val();

        mp = $('#metodo_pago').val();

       // alert($("#recibido_efectivo").text());

        if ($("#recibido_efectivo").val() == '' && mp == 'efectivo' ){
            alert('No ingreso un importe en efectivo!'  );
            
            return false;
        }else
        if ($("#recibido_tarjeta").val() == '' && mp == 'tarjeta' ){
            alert('No ingreso un importe de tarjeta!');
            
            return false;
        }else
        if (($("#recibido_efectivo").val() == '' || $("#recibido_tarjeta").val() == '') && mp == 'ambos' ){
            alert('No ingreso algun importe!');
            
            return false;
        }

        var total_recibido_efectivo = ($("#recibido_efectivo").val() === '' ) ? 0 : $("#recibido_efectivo").val();
        var total_recibido_tarjeta =  ($("#recibido_tarjeta").val() === '' ) ? 0 : $("#recibido_tarjeta").val();
       //alert(total_recibido_efectivo + " - " + total_recibido_tarjeta );
        var total_recibido = parseFloat(total_recibido_efectivo) + parseFloat(total_recibido_tarjeta);
        
        var importe_total =  total_venta ;
        var tpv = $('#tpv select').val();
       // alert(total_recibido + " " + importe_total);

        if (total_recibido < importe_total) {
            alert('El importe recibido es menos al total de la venta! VERIFIQUE');
            return false;
        }
        //alert(cliente + pago);
        var link = "<?php echo base_url(); ?>";
        $.post(link + "tpv/cobrar_compra", {  pago: pago,importe: importe_total,  tipo: 'pedido', idVenta: idVenta},
            function(data){ 
                        // Interact with returned data
                if(data == 'true'){
                   var vuelto = (parseFloat(total_recibido_tarjeta) + parseFloat(total_recibido_efectivo)) - parseFloat(importe_total);

                   alert("El cobro fue realizado con exito!" + "SU VUELTO ES: $" + vuelto);
                   
                   location.href=location.href;

                                         
                }else{
                    alert("Problemas al realizar el cobro...");
                        }
            });


            return false; // Stop the browser of loading the page defined in the form "action" parameter.
    });


    
        /*place jQuery actions here*/ 
   $(document).ready(function() { 
    	if($('#metodo_pago').val() == 'EFECTIVO' || $('#metodo_pago').val() == 'efectivo'){
    	$("#div_tarjeta").hide();
    	$("#tarjeta").hide();    
        }
        if($('#metodo_pago').val() == 'TARJETA'){
        	$("#div_efectivo").hide();
        }
        $('#metodo_pago').on('change',function () {
        mp = $('#metodo_pago').val().toLowerCase();
        //alert(mp);
        if ( mp == 'tarjeta'  ){
            //alert(mp );
            $("#div_efectivo").hide();
            $("#recibido_efectivo").val('');
            $("#div_tarjeta").show();
            $("#tarjeta").show();
        
        } if ( mp == 'ambos'){
            $("#div_efectivo").show();
            $("#div_tarjeta").show();
            $("#tarjeta").show();
            //$("#tarjeta").prop('disabled', true);
        } if (mp == 'efectivo'){
            $("#div_efectivo").show();
            $("#recibido_tarjeta").val('');
            $("#div_tarjeta").hide();
            $("#tarjeta").hide();
        }
    	});
    });
</script>