<div class="row">
    
        <div class="col-md-4">
            <h3>Stock</h3> 
        </div>
        
        <div class="col-md-8 text-right">

            <form name="frm_tpv" id="tpv" class="form-inline">
                
                    <label for="tpv" class="control-label" >Seleccione TPV: </label>
                
                        <select id="tpv" name="tpv" class="form-control ">
                           <?php foreach ($tpv as $t):?>
                            <option value="<?php echo $t->id_tpv;?>"><?=$t->tpv_nombre?></option>
                            
                            <?php endforeach;?>
                        </select>
                
            </form>
        </div>
       
        
   
</div>
<div class="row">
    <hr class="hr_success">
    <?php
    if (isset($message)){ ?>
        <div id="infoMessage" class="alert uk-alert-success" role="alert">
            <?php echo $message;?>
        </div>
        <?php } ?> 
</div>


<div class="row">
<div class="col-md-12">
  
    <div class="row col-md-9">



        <form class="form-horizontal" id="form_cliente">
            <div class="panel panel-success">
                <div class="panel-body">
                    <div class="col-md-5">
                         <label class="control-label" for="cliente">Cliente</label> 
                        <input type="text" name="cliente" id="cliente" class="form-control input-sm" placeholder="Cliente">
                    </div>
        
                    <div class="col-md-2">
                        <label class="control-label" for="doc">Docuento</label> 
                        <input type="text" name="doc" id="doc" class="form-control input-sm" placeholder="Documento">                
                    </div>
                    <div class="col-md-5">
                        <label class="control-label" for="direccion">Direccion</label> 
                        <input type="text" name="direccion" id="direccion" class="form-control input-sm" placeholder="Direccion">                
                    </div>
                    
                </div>
            </div>
        </form>




        <div class="panel panel-warning">
        <div class="panel-body">
        
            <form id="form_product" type="post" action="<?php echo base_url(); ?>tpv/add_cart_item/">



                <div class="col-md-6">
                    <label class="control-label" for="producto">Producto</label>
                    <input type="text" name="producto" id="producto" class="form-control input-sm" placeholder="Producto">
                </div>
            
                <div class="col-md-1">
                     <label class="control-label" for="stock_act">Stock</label> 
                    <input type="text" name="stock_act" id="stock_act" class="form-control input-sm text-big"  readonly="readonly">                
                </div>
                <div class="col-md-1">
                    <label class="control-label" for="cantidad_producto">Cant</label>
                    <input type="text" name="cantidad_producto" id="cantidad_producto" class="form-control input-sm text-big" >
                </div>
                <div class="col-md-2">
                    <label class="control-label" for="precio_producto">Precio</label> 
                    <input type="text" name="precio_producto" id="precio_producto" class="form-control input-sm text-big"  readonly="readonly">                
                </div>
                <div class="col-md-1">
                    
                    <button type="submit" class="btn btn-warning btn-lg" name="agregar">Agregar</button>
                </div>
            </form>



        </div>
    </div>  
    
    <?php //$this->view($content); ?>
     
    <div class="cart_list">
        <!-- <h3>Your shopping cart</h3> -->
        <div id="cart_content">
            <?php  $this->view('tpv/cart.php');
            //var_dump( $this->cart->contents());?>
        </div>
    </div>
    
        
    </div>
    


        
      


    <div class="col-md-3">
        <div class="panel panel-precio">
            <div class="panel-body">
                <div class="h4 text-center" style="color: white">Total a abonar</div>
                <div class="h1 text-center" id="total" name="total" style="color: white">
                    <?php 
                        echo $this->cart->format_number($this->cart->total()); 
                    ?>
                    <input type="hidden" id="total_importe" value="<?php echo $this->cart->format_number($this->cart->total()); ?>">
                </div>

            </div>

        </div>

        <div class="panel panel-muted ">
            <div class="panel-body ">
                
                <form name="form_pago" id="form_pago" method="post">
                    <div class="form-group">
                        <label for="metodo_pago h4">Forma de pago</label>
                        <select name="metodo_pago" id="metodo_pago" class="form-control">
                            <option value='efectivo'>Efectivo</option>
                            <option value='tarjeta'>Tarjeta</option>
                            <option value='ambos'>Ambos</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <div class="input-group" id="div_efectivo">
                            <div class="input-group-addon">$</div>
                            <label for="recibido_efectivo"></label>
                            <input type="text" name="recibido_efectivo" id="recibido_efectivo" placeholder="Recibido efectivo" class="form-control ">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="tarjeta"></label>    
                        <select name="tarjeta" id="tarjeta" class="form-control " >
                            <option value="">Seleccione tarjeta</option>
                            <option value="Visa">Visa</option>
                            <option value="Mastercard">Mastercard</option>
                            <option value="Dinners">Dinners</option>
                            <option value="Nevada">Nevada</option>
                            <option value="Cabal">Cabal</option>
                            

                        </select>
                    </div>
                    
                    <div class="form-group">
                        <div class="input-group" id="div_tarjeta">
                            <div class="input-group-addon">$</div>
                            <label for="recibido_tarjeta"></label>
                            <input type="text" name="recibido_tarjeta" id="recibido_tarjeta" placeholder="Recibido tarjeta" class="form-control " >
                        </div>
                    </div>

                    

                </form>
            </div>

        </div>

        <div class="text-right">
            <?php 
            echo anchor('#', 'Guardar', 'class="btn btn-success " id="delivery"');
            ?>

            <?php
            echo anchor('#', 'Cobrar', 'class="btn btn-primary " id="mostrador"');
            ?>
            </div>
    </div>
</div>
</div>


<?php //var_dump($productos);?>

<script type="text/javascript">

$(document).ready(function() { 

    $('#tpv').on('change',function () {
        var $select = $('#producto').selectize();
        var selectize = $select[0].selectize;
        selectize.clear();
    });

    $("#div_tarjeta").hide();
    $("#tarjeta").hide();
        /*place jQuery actions here*/ 
    $('#metodo_pago').on('change', function(){
        event.preventDefault();
        mp = $('#metodo_pago').val();
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

    $('#mostrador').on('click', function(){
        var cliente = $('#form_cliente').serialize();
        var pago = $('#form_pago').serialize();
        var total_venta = $('#total_importe').val();

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
        
        var importe_total =  $("#total").text().substring(1) ;
        var tpv = $('#tpv select').val();
       // alert(total_recibido + " " + importe_total);

        if (total_recibido < importe_total) {
            alert('El importe recibido es menos al total de la venta! VERIFIQUE');
            return false;
        }
        //alert(cliente + pago);
        var link = "<?php echo base_url(); ?>";
        $.post(link + "tpv/guardar_compra", { cliente: cliente, pago: pago, importe: importe_total, tipo: 'mostrador', tpv: tpv},
            function(data){ 
                        // Interact with returned data
                if(data == 'true'){
                   var vuelto = (parseFloat(total_recibido_tarjeta) + parseFloat(total_recibido_efectivo)) - parseFloat(importe_total);

                   alert("La venta fue exitosa! SU VUELTO: $" + parseFloat(vuelto));
                   <?php echo $this->cart->destroy();?>
                   location.href=location.href;

                                         
                }else{
                    alert("Problemas al realizar la venta...");
                        }
            });


            return false; // Stop the browser of loading the page defined in the form "action" parameter.
    });

    $('#delivery').on('click', function(){
        var cliente = $('#form_cliente').serialize();
        $("#recibido_tarjeta").val('');
        $("#recibido_efectivo").val('');
        $("#metodo_pago").val('');
        var pago = $('#form_pago').serialize();
        var tpv = $('#tpv select').val();

        
        //alert(cliente + pago);
        var link = "<?php echo base_url(); ?>";
        $.post(link + "tpv/guardar_compra", { cliente: cliente, pago: pago, tipo: 'delivery', tpv: tpv},
            function(data){ 
                        // Interact with returned data
                if(data == 'true'){
                        
                   alert("se guardo la venta");
                   <?php echo $this->cart->destroy();?>
                   location.href=location.href;

                                         
                }else{
                    alert("Product does not exist");
                        }
            });
            return false; // Stop the browser of loading the page defined in the form "action" parameter.
    });
        

    //$("#total").val();
        
    $("#form_product").submit(function() {
         var link = "<?php echo base_url(); ?>"; // Url to your application (including index.php/)
            // Get the product ID and the quantity 
            var id = $(this).find('input[name=producto]').val();
            var qty = parseFloat($(this).find('input[name=cantidad_producto]').val());
            var precio = $(this).find('input[name=precio_producto]').val();
            var stock = parseFloat($(this).find('input[name=stock_act]').val());

            
            

            if(stock < qty || stock ==' '){ 
                alert('No hay stock suficiente de este articulo');
                return false;
            }else{
                //alert(id + qty + price);
                $.post(link + "tpv/add_cart_item", { product_id: id, quantity: qty, price: precio, ajax: '1' },
                    function(data){ 
                        // Interact with returned data
                   if(data == 'true'){
                        
                            $.get(link + "tpv/show_cart", function(cart){ // Get the contents of the url cart/show_cart
                                $("#cart_content").html(cart); // Replace the information in the div #cart_content with the retrieved data
                            });

                                         
                        }else{
                            alert("Product does not exist");
                        }
                 });
                var $select = $('#producto').selectize();
                var selectize = $select[0].selectize;
                selectize.clear();

                var cart_total = $('#total').text();
                //alert(cart_total);
                if (cart_total) { 
                    $('select#tpv').prop('disabled', true);
                }
                return false; // Stop the browser of loading the page defined in the form "action" parameter.
            }


            
        });

   
        
    
    });



var formatName = function(item) {
    return $.trim((item.nombre ));
  };  

$('#cliente').selectize({
  maxItems: 1,
  closeAfterSelect: true,
  valueField: 'id',
  labelField: 'nombre',
  searchField: ['nombre','domicilio'],
  options: [
  <?php
  /* traer datos por json... sino no funciona */ 
  foreach ($clientes as $ent) {
    echo "{id:".$ent->id_cliente.", nombre: '".$ent->cli_nombre."', domicilio: '".$ent->cli_direccion."', documento: '".$ent->cli_doc."'},";
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

    }

  },
  onChange: function(value) {  
               $.ajax({
                    url: "<?php echo base_url();?>cliente/ajax_get_cliente/" + value 
                    , type: "GET"
                    , dataType: "JSON"
                    , success: function (data) {
                        $('#doc').val(data.cli_doc);
                        $('#direccion').val(data.cli_direccion);
                    }
                    , error: function (jqXHR, textStatus, errorThrown) {
                        alert('Error get data from ajax');
                    }
                }); 
  },
  
  create: true,
});

$('#producto').selectize({
  maxItems: 1,
  closeAfterSelect: true,
  valueField: 'id',
  labelField: 'nombre',
  searchField: ['nombre','domicilio'],
  options: [
  <?php
  /* traer datos por json... sino no funciona */ 

  foreach ($productos as $pro) {
    echo "{id:".$pro->id_producto.", nombre: '".$pro->producto." - ".$pro->especie." - " .$pro->cantidad_medida."'},";
  }
  ?>
  ],
  render: {
    option: function(item, escape) {
      var nombre = formatName(item);
      var label = nombre || item.nombre;
      var caption = nombre ? item.nombre : null;
      return '<div>' +
      '<span class=""> ' + escape(label) + '</span> ' + '</div>';

    }

  },
  onChange: function(value) { 
        var tpv_sel = $('select#tpv').val(); 
        
            $.ajax({

                url: "<?php echo base_url();?>producto/ajax_edit/" + value + "/" + tpv_sel
                , type: "GET"
                , dataType: "JSON"
                , success: function (data) {
                    $('#stock_act').val(data.stock_act);
                    $('#precio_producto').val(data.producto_precio_venta);
                }
                , error: function (jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
             
        
  },
  
  create: false,
});

</script>