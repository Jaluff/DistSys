<?php if (!$this->cart->contents()) :
    echo 'Ud. no ha ingresado ninguna compra todavia!';
else :
    ?>
<?php 
$attributes = array('class' => '', 'id' => 'form_items');
echo form_open('#', $attributes); ?>
<div class="col-md-8">
    <table width="100%" class="table table-condensed table-hover">
        <thead>
            <tr>
                <th>Cantidad</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Importe</th>
                <th class="text-center">Accciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->cart->contents() as $items) : ?>
            <?php echo form_hidden('rowid[]', $items['rowid']); ?>
            <tr>
                <td>
                    <div class="col-md-4 col-xs-12">
                        <?php echo form_input(array('name' => 'qty[]', 'id' => 'qty[]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5', 'class' => 'form-control input-sm cantidad')); ?>
                    </div>
                </td>
                <td>
                    <div class="col-md-6 col-xs-12">
                        <?php echo $items['name']; ?>
                    </div>
                </td>
                <td>
                    <div class="col-md-8 col-xs-12">
                        <?php echo form_input(array('name' => 'precio[]', 'id' => 'precio[]', 'value' => $this->cart->format_number($items['price']), 'size' => '3', 'class' => 'form-control input-sm precio')); ?>
                    </div>
                </td>
                <td>
                    $
                    <?php echo $this->cart->format_number($items['subtotal']); ?>
                </td>
                <td class="text-center">
                    <button type="button" id="del" onclick="eliminar_producto('<?php echo $items['rowid']; ?>');" class="btn btn-danger btn-xs" value="<?php echo $items['rowid']; ?>">Eliminar</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="col-md-4">
    <div class="well">
        <div class="h2">Total</div>
        <div class="h4">
            <?php echo $this->cart->format_number($this->cart->total()); ?>
            <input type="hidden" name="total_compra" id="total_compra" value="<?php echo $this->cart->format_number($this->cart->total()); ?>">
        </div>
    </div>
</div>

<?php echo form_hidden('ajax', '1'); ?>


<?php 
echo form_close();
endif;
?>


<script type="text/javascript">

    $(".cantidad").on('change', function() {
        var link = "<?php echo base_url(); ?>";
        dataString = $("#form_items").serialize();

        $.ajax({
            type: "POST",
            //cache: false,
            url: '<?= base_url() ?>' + "compras/update_cart",
            data: dataString,
            cache: false,
            success: function(msg) {
                // reload the (updated) cart
                $.get(link + "compras/show_cart", function(cart) { // Get the contents of the url cart/show_cart  
                    $("#cart_content").html(cart); // Replace the cart
                });
            }
        });
        return false;
    });

    $(".precio").on('change', function() {
        var link = "<?php echo base_url(); ?>";
        //var newprecio =  event.target.defaultValue;
        dataString = $("#form_items").serialize();
        //alert(dataString);
        $.ajax({
            type: "POST",
            //cache: false,
            url: '<?= base_url() ?>' + "compras/update_cart",
            data: dataString,
            //cache: false,
            success: function(msg) {
                // reload the (updated) cart
                $.get(link + "compras/show_cart", function(cart) { // Get the contents of the url cart/show_cart  
                    $("#cart_content").html(cart); // Replace the cart
                    // $(".precio").val('0');
                });
            }
        });
        return false;
    });


    //$('#del').on('click',function(){
    
    
</script> 