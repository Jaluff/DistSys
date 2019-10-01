
<div class="row">
    
        <div class="col-md-4">
            <h3>Mostrar venta </h3> 
        </div>
        
        <div class="col-md-8 text-right">
	        <h3>
	        <?php echo "Vendedor: " . strtoupper($ventas->cobrador);?>
	        </h3>   
        </div>
</div>

<div class="row">
    <hr class="hr_success">
    <div class="row col-md-9">
<?php
// var_dump($cliente);
?>
    <!-- <h3>Datos del cliente:</h3> -->
        <form class="form-horizontal" id="form_cliente">
            <div class="panel panel-success ">
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="col-md-9"></div>
                        <div class="col-md-3 text-right"><h4>Fecha de vta: <?php echo date("d-m-Y", strtotime($ventas->fecha));?></h4></div>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label" for="cliente"><h4>Cliente</h4></label> 
                            <input type="text" 
                                name="cliente_nombre" 
                                id="cliente_nombre" 
                                class="form-control input-sm" 
                                value="<?php echo (isset($cliente->cli_nombre) && $cliente->cli_nombre == 0) ?  $cliente->cli_nombre : 'Consumidor final';?>">
                            
                            <input type="hidden" 
                                name="id_tpv" 
                                id="id_tpv" 
                                class="form-control input-sm" 
                                value="<?php echo $ventas->id_tpv; ?>">
                            
                            <input 
                                type="hidden" 
                                name="id_venta" 
                                id="id_venta"  
                                value="<?php echo $ventas->id_venta;?>">
                    </div>

                    <div class="col-md-2">
                        <label class="control-label" for="cli_direccion"><h4>Direccion</h4></label> 
                            <input 
                                type="text" 
                                name="domicilio1" 
                                id="domicilio1" 
                                class="form-control input-sm" 
                                value="<?php echo (isset($cliente->domicilio1) && $cliente->domicilio1 != '') ?  $cliente->domicilio1 : '';?>">                
                    </div>

                    <div class="col-md-2">
                        <label class="control-label" for="cli_localidad"><h4>Localidad</h4></label> 
                            <input 
                                type="text" 
                                name="cli_localidad" 
                                id="cli_localidad" 
                                class="form-control input-sm" 
                                value="<?php echo (isset($cliente->localidad1) && $cliente->localidad1 != '') ?  $cliente->localidad1 : '';?>">                
                    </div>

                    <div class="col-md-2">
                        <label class="control-label" for="cli_cp"><h4>Cod. Postal</h4></label> 
                            <input 
                                type="text" 
                                name="cli_cp" 
                                id="cli_cp" 
                                class="form-control input-sm" 
                                value="<?php echo (isset($cliente->cp1) && $cliente->cp1 != '') ?  $cliente->cp1 : '';?>">                
                    </div>

                    <div class="col-md-3"></div>

                    <div class="col-md-2">
                        <label class="control-label" for="cli_doc"><h4>Documento</h4></label> 
                            <input 
                                type="text" 
                                name="cli_doc" 
                                id="cli_doc" 
                                class="form-control input-sm" 
                                value="<?php echo (isset($cliente->cli_doc) && $cliente->cli_doc != '') ?  $cliente->cli_doc : '';?>">                
                    </div>
                    
                    <div class="col-md-3">
                        <label class="control-label" for="cli_telefono"><h4>Telefonos</h4></label> 
                            <input 
                                type="text" 
                                name="cli_telefono" 
                                id="cli_telefono" 
                                class="form-control input-sm" 
                                value="<?php echo (isset($cliente->telefono1) && $cliente->telefono1 != '') ?  $cliente->telefono1 : '';?><?php echo (isset($cliente->movil1) && $cliente->movil1 != '') ?  " / ".$cliente->movil1 : '';?>">                
                    </div>

                    <div class="col-md-3">
                        <label class="control-label" for="correo"><h4>Correo electronico</h4></label> 
                            <input 
                                type="text" 
                                name="correo" 
                                id="correo" 
                                class="form-control input-sm" 
                                value="<?php echo (isset($cliente->correo1) && $cliente->correo1 != '') ?  $cliente->correo1 : '';?>">                
                    </div>
                    
                </div>
            </div>
        </form>
     
    <div class="cart_list">
        <!-- <h3>Detalles de productos:</h3> -->
        <table class="table  table-responsive table-bordered table-striped">
        	<thead >
	        	<th>Cantidad</th>
	        	<th>Producto</th>
	        	<th>Precio</th>
	        	<th>Importe</th>
        	</thead>
        	<tbody class="text-center h4">
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
    <!-- <h3>Datos de facturacion</h4> -->
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

        <?php require_once (APPPATH.'views/comunes/cobro-pago.php'); ?>

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
	$('#factura').on('click', function() {
            var cliente = $('#form_cliente').serialize();
            var pago = $('#form_pago').serialize();
            var total_venta = $('#total_importe').val();
            var id_venta = $('#id_venta').val(); 

            mp = $('#metodo_pago').val();

            // alert($("#recibido_efectivo").text());

            if ($("#recibido_efectivo").val() == '' && mp == 'efectivo') {
                alert('No ingreso un importe en efectivo!');
                return false;
            } else
            if ($("#recibido_tarjeta").val() == '' && mp == 'tarjeta') {
                alert('No ingreso un importe de tarjeta!');
                return false;
            } else
            if (($("#recibido_efectivo").val() == '' || $("#recibido_tarjeta").val() == '') && mp == 'efectivoTarjeta') {
                alert('No ingreso algun importe!');

                return false;
            } else
            if (($("#recibido_cheque").val() == '' || $("#recibido_efectivo").val() == '') && mp == 'efectivoCheque') {
                alert('No ingreso algun importe!');
                return false;
            }
            var total_recibido_efectivo = ($("#recibido_efectivo").val() === '') ? 0 : $("#recibido_efectivo").val();
            var total_recibido_tarjeta = ($("#recibido_tarjeta").val() === '') ? 0 : $("#recibido_tarjeta").val();
            var total_recibido_cheque = ($("#recibido_cheque").val() === '') ? 0 : $("#recibido_cheque").val();
            //alert(total_recibido_efectivo + " - " + total_recibido_tarjeta );
            var total_recibido = parseFloat(total_recibido_efectivo) + parseFloat(total_recibido_tarjeta) + parseFloat(total_recibido_cheque);
            var importe_total = $("#total_importe").val();
            var tpv = $('#id_tpv').val();
            console.log(total_recibido + " - " + importe_total + "--");
            if (total_recibido < importe_total) {
                confirm('El importe recibido es menos al total de la venta! VERIFIQUE');
               // return false;
            }
            //alert(cliente + pago);
            var link = "<?php echo base_url(); ?>";
            $.post(link + "tpv/guardar_venta", {
                    cliente: cliente,
                    pago: pago,
                    importe: importe_total,
                    tipo: 'factura',
                    tpv: tpv,
                    idVenta: id_venta
                },
                function(data) {
                    // Interact with returned data
                    if (data == 'true') {
                        var vuelto = (parseFloat(total_recibido_cheque) + (parseFloat(total_recibido_tarjeta) + parseFloat(total_recibido_efectivo)) - parseFloat(importe_total));
                        alert("La venta fue exitosa! SU VUELTO: $" + parseFloat(vuelto));
                        <?php echo $this->cart->destroy(); ?>
                        location.href = link + "venta";
                    } else {
                        alert("Problemas al realizar la venta...");
                    }
                });
            return false; // Stop the browser of loading the page defined in the form "action" parameter.
        });
    
        /*place jQuery actions here*/ 
   $(document).ready(function() {
        var mp = $('#metodo_pago').val().toLowerCase(); 
    	if(mp == 'efectivo'){
            $("#div_tarjeta").hide();
            $("#div_cheque").hide();
            $("#tarjeta").hide();    
        }
        if(mp == 'tarjeta'){
            $("#div_efectivo").hide();
            $("#div_cheque").hide();
        }
        if(mp == 'cheque'){
            $("#div_efectivo").hide();
            $("#div_tarjeta").hide();
        }

        if (mp == 'efectivo-tarjeta'){
            $("#div_efectivo").show();
            $("#div_tarjata").show();
            $("#tarjeta").show();
            $("#div_cheque").hide();
        }

        if ( mp == 'efectivo-cheque'){
            $("#div_efectivo").show();
            $("#div_cheque").show();
            $("#tarjeta").hide();
            // $("#tarjeta").show();
            //$("#tarjeta").prop('disabled', true);
        }

        
        
    });

    $('#metodo_pago').on('change', function(){
        event.preventDefault();
        mp = $('#metodo_pago').val();
        //alert(mp);
        if ( mp == 'tarjeta'  ){
            //alert(mp );
            $("#div_efectivo").hide();
            $("#div_cheque").hide();
            $("#recibido_efectivo").val('');
            $("#div_tarjeta").show();
            $("#tarjeta").show();
            $("#factura").show();
        }
        if ( mp == 'cheque'  ){
            //alert(mp );
            $("#div_efectivo").hide();
            $("#div_tarjeta").hide();
            $('#tarjeta').hide();
            $("#recibido_efectivo").val('');
            $("#div_cheque").show();
            $("#cheque").show();
            $("#factura").show();
        } 
        if ( mp == 'efectivoTarjeta'){
            $("#div_efectivo").show();
            $("#div_tarjeta").show();
            $("#tarjeta").show();
            $("#factura").show();
            $("#div_cheque").hide();
            //$("#descuento").show();
            //$("#tarjeta").prop('disabled', true);
        }
        if ( mp == 'efectivoCheque'){
            $("#div_cheque").show();
            $("#div_tarjeta").hide();
            $("#tarjeta").hide();
            $("#factura").show();
            $("#div_efectivo").show();
            //$("#descuento").show();
            //$("#tarjeta").prop('disabled', true);
        } 
        if (mp == 'efectivo'){
            $("#div_efectivo").show();
            $("#factura").show();
            $("#recibido_tarjeta").val('');
            $("#div_tarjeta").hide();
            $("#div_cheque").hide();
            $("#tarjeta").hide();
            //$("#descuento").show();
        } if (mp == 'ninguno') {
            $("#div_tarjeta").hide();
            $("#div_tarjeta").hide();
            $("#div_cheque").hide();
            $("#tarjeta").hide();
            $("#factura").hide();
            $("#div_efectivo").hide();
        }
    });
</script>