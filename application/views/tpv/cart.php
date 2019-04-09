<?php if(!$this->cart->contents()):
    echo '';
else:
?>
 
<?php 
$attributes = array('class' => 'form', 'id' => 'form_compra');
$action = base_url() . "tpv/update_cart";
echo form_open($action, $attributes); ?>
<table class="table table-condenced table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr class="active">
            <th width="20%">Cantidad</th>
            <th width="30%">Descripcion</th>
            <th width="15%">Precio</th>
            <th width="15%">Descuento</th>
            <th width="20%">Importe</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php 
//var_dump($this->cart->contents());
        foreach($this->cart->contents() as $items): ?>
         
        <?php echo form_hidden('rowid[]', $items['rowid']); ?>

        <tr <?php if($i&1){ echo 'class="alt"'; }?>>
            <td  >
                <div class="col-md-7 col-xs-12">
                	<?php echo form_input(array('name' => 'qty[]', 'id' => 'qty[]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5', 'class' => 'form-control input-sm cantidad')); ?>
                </div>
            </td>
            <td>
            	<div class="col-md-12 col-xs-12">
            		<?php echo $items['name']; ?>
            	</div>
            </td>
            <td>
            	<div class="col-md-12 col-xs-12">
            		<?php echo form_input(array('name'=>'precio[]', 'id'=>'precio[]', 'value'=>$this->cart->format_number($items['price']), 'size' => '5', 'class' => 'form-control input-sm precio')) ; ?>
            	</div>
            </td>
            <td>
                <div class="col-md-12 col-xs-12">   
                    <?php echo form_input(array('name'=>'descuento[]', 'id'=>'descuento[]', 'value'=>$items['discount'], 'size' => '3', 'class' => 'form-control input-sm precio text-left')) ; ?>
                </div>
            </td>
            <td>
            	<div class="col-md-12 col-xs-12">
            		$<?php echo number_format($items['subtotal'], 2, '.',''); ?>
            	</div>
            </td>
        </tr>
         
        <?php $i++; ?>
        <?php endforeach; ?>
         
        <!-- <tr>
            <td</td>
            <td></td>
            <td><strong>Total</strong></td>
            <td>&euro;<?php echo $this->cart->format_number($this->cart->total()); ?></td>
        </tr> -->
    </tbody>
</table>
 <?php echo form_hidden('ajax', '1'); ?>
<p class='text-right'>
	<!-- <button type="submit" class="btn btn-warning "  >Actualizar</button>  -->
	
	<?php //echo form_submit('', 'Update your Cart'); 
	echo anchor('tpv/empty_cart', 'Anular compra', 'class="btn btn-danger"');
	// echo anchor('tpv/empty_cart', 'Guardar compra', 'class="btn btn-success"');
	// echo anchor('tpv/empty_cart', 'Registrar compra', 'class="btn btn-primary"');

	?></p>

<?php 
echo form_close(); 
endif;
?>

<script type="text/javascript">
$(document).ready(function() { 
	$('#total').text('$<?php echo number_format($this->cart->total(), 2 , '.',''); ?>');  
    $('#total_importe').val('$<?php echo number_format($this->cart->total(), 2 , '.',''); ?>');
	
});


$(".cantidad").on('change',function(){
            var link = "<?php echo base_url(); ?>";
            dataString = $("#form_compra").serialize();
            
            $.ajax({
                type: "POST",
                //cache: false,
                url: '<?= base_url() ?>' + "tpv/update_cart",
                data: dataString,
                //cache: false,
                success: function(msg){
                    // reload the (updated) cart
                    $.get(link + "tpv/show_cart", function(cart){ // Get the contents of the url cart/show_cart  
                    $("#cart_content").html(cart); // Replace the cart
                    
                    });
                }
                
            });
            return false;            
        });

$(".precio").on('change',function(){

            var link = "<?php echo base_url(); ?>";
            //var newprecio =  event.target.defaultValue;
            
            dataString = $("#form_compra").serialize();
           //alert(dataString);
            $.ajax({
                type: "POST",
                //cache: false,
                url: '<?= base_url() ?>' + "tpv/update_cart",
                data: dataString,
                //cache: false,
                success: function(msg){
                    // reload the (updated) cart
                    $.get(link + "tpv/show_cart", function(cart){ // Get the contents of the url cart/show_cart  
                    $("#cart_content").html(cart); // Replace the cart
                   $(".precio").val('0');
                    });

        

                }
                
            });
            return false;            
        });


</script>