<div class="row">
    <!-- <div class="panel panel-success"> -->
    <!-- <div class="col-md-12"> -->
        <div class="col-md-7">
            <h3>Stock</h3> 
        </div>
        <div class="col-md-2 col-xs-12 text-right ">
                <button class="btn btn-default" onclick="reload_table();"><i class="glyphicon glyphicon-refresh"></i> Actualizar</button>
        </div>
        <div class="col-md-3 col-xs-12 text-right">
        <form name="frm_tpv" id="tpv" class="form-inline">
            
                <label for="tpv" class="control-label" >Seleccione TPV: </label>
            
                    <select id="tpv" name="tpv" class="form-control ">
                       <!-- <option >Seleccione</option> -->
                       <?php foreach ($tpv as $t):?>
                        <option value="<?php echo $t->id_tpv;?>"><?=$t->tpv_nombre?></option>
                        
                        <?php endforeach;?>
                    </select>
            
        </form>
        </div>
    <!-- </div>  -->
</div>
<div class="row">
    <hr class="hr_success">
    <!-- <p><?php echo lang('index_subheading');?></p> -->
    <!-- </div> -->
    <?php
//    $user = $this->ion_auth->user()->row();
//		echo $user->email;
    if (isset($message)){ ?>
        <div id="infoMessage" class="alert uk-alert-success" role="alert">
            <?php echo $message;?>
        </div>
        <?php } ?>
        
        </div>
            
    
    <table class="table table-bordered table-condensed table-hover " cellspacing="0" width="100%" id="stock">
        <thead>
            <tr>
<!--                        <th></th>-->
                
                <th class="hidden-xs">Codigo</th>
                <th>Producto</th>
                <th>Categoria</th>
                <th>Marca</th>
                
                <th class="hidden-xs">Stock minimo</th>
                <th >Stock actual</th>
                <th style="min-width: 90px">Action</th>
            </tr>
        </thead>
    </table>
    
</div>
<script type="text/javascript">
    var tpv = $('#tpv select').val();
    
    tables = $('#stock').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "createdRow": function ( row, data, index ) {
                //console.log(data['Stock_actual']);
                if( parseInt(data['Stock_actual']) < parseInt(data['Stock_minimo'] )) {
                    $('td', row).eq(5).addClass('mark orange-light');
                }if ( parseInt(data['Stock_actual']) == parseInt(data['Stock_minimo'] )) {
                    $('td', row).eq(5).addClass('orange-light');
                }if(parseInt(data['Stock_actual']) > parseInt(data['Stock_minimo'])){
                    $('td', row).eq(5).addClass('blue-text');
                }
            },
            "columns": [
                
                
                {"data": "Codigo", "className": "hidden-xs" },
                {"data": "Producto" },
                {"data": "tipo" },
                {"data": "marca" },
                {"data": "Stock_minimo" , "className": "hidden-xs" },
                {"data": "Stock_actual" },
			    {"data": "Acciones" }
        ]
            , "order": [], //Initial no order.
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo base_url()?>stock/ajax_list",
                "type": "POST",
                "data": function ( d ) {
                    
                        d.tpv = $('#tpv select').val();
                        // if (d.stock_act < d.stock_min){
                        //     d.stock_act.addClass('text-danger');
                        // }    
                    
                    
                }
            }, //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [-1], //last column
                    "orderable": false, //set not orderable
        }
        , ]
    });

    
    $('#tpv select').change( function() {
        var filter_value = $(this).val();
       
        tables.draw();
    } );

    function reload_table() {
        tables.ajax.reload(null, false);
        
        //reload datatable ajax
    }

  
</script>




<?php 
    require_once (APPPATH.'views/stock/form_modificaStock.php');
	require_once (APPPATH.'views/stock/form_actualizarStock.php');
?>

<script type="text/javascript">

    /*
     *   funciones para la gestion de productos
     */
    $('#sel_tpv_destino').change(function(){
	var id = $('#id_producto').val();
	var tpv = $('#sel_tpv_destino option:selected').val();
	//console.log(id + '-' + tpv);
	$.ajax({
        url: "<?php echo base_url();?>stock/get_producto_stock/" + id + '/' + tpv
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
        url: "<?php echo base_url();?>stock/get_producto_stock/" + id + '/' + tpv
        , type: "post"
        , dataType: "JSON"
        ,data: {id:id, tpv:tpv}
        , success: function (dato) {
// console.log(data);
            /* Precios*/
        //console.log(dato);
            
            // stock = data.stock_act;
            $('#stock_origen').val(dato.stock_act);
            
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
        
    });
});

$('#sel_tpv_modifica').change(function(){
    var id = $('#id_producto').val();
    var tpv = $('#sel_tpv_modifica option:selected').val();
    //console.log(id + '-' + tpv);
    $.ajax({
        url: "<?php echo base_url();?>stock/get_producto_stock/" + id + '/' + tpv
        , type: "post"
        , dataType: "JSON"
        , data: {id:id, tpv:tpv}
        , success: function (dato) {
// console.log(data);
            /* Precios*/
        //console.log(dato);
            
            // stock = data.stock_act;
            $('#stock_origen_modifica').val(dato.stock_act);
            
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
        
    });
});

/** 
 * movimito stock 
 * 
 */
function movimiento_stock(id , tpv) {
    save_method = 'update';
    $('#frm_actualizar')[0].reset(); // reset form on modals
    //$('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    //Ajax Load data from ajax
    $.ajax({
        url: "<?php echo base_url();?>stock/ajax_enviar_producto/" 
        , type: "post"
        , data: {id: id, tpv: tpv}
        , dataType: "JSON"
        , success: function (data) {
console.log(data);
            /* Precios*/
            $('[name="id_producto"]').val(data[0].id_producto);
            // $('[name="tpv"]').val(data[1].tpv_nombre);
            $('[name="producto"]').val(data[0].producto);
            var prod = data[0].producto;
            $('[name="stock_act"]').val(data[2].stock_act);
            $('[name="stock_min"]').val(data[2].stock_min);
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
    event.preventDefault();
    var id_prod = $('#id_producto').val() ;
    var prod_cant = $('#cantidad').val();
    var stk_origen = $('#stock_origen').val();
    var stk_destino = $('#stock_destino').val();
    var alm_origen = $('#sel_tpv_origen').val();
    var alm_destino = $('#sel_tpv_destino').val();
    var stk_mini = $('#stock_min').val();
//alert(prod_cant + '>' + stk_origen);
    if (parseInt(prod_cant) > parseInt(stk_origen)){
        
        alert('No hay suficientes productos para enviar...!');
    
    }else{
        
        
        $.ajax({
            url: "<?php echo site_url('stock/ajax_send_stock');?>"
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

/** modificar stock */

function modifica_stock(id , tpv) {
    if(id =='' || tpv ==''){
        return false;
    }
    //alert(id + '-' + tpv + '--' );
    //save_method = 'update';
    $('#frm_modificar')[0].reset(); // reset form on modals
    //$('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    //Ajax Load data from ajax
    $.ajax({
        url: "<?php echo base_url();?>stock/ajax_enviar_producto"
        , type: "post"
        , dataType: "JSON"
        , data: {id: id, tpv: tpv}
        , success: function (data) {
            console.log(data);
            /* Precios*/
            $('[name="id_producto"]').val(data[0].id_producto);
            $('[name="tpv_modifica"]').val(data[1].tpv_nombre);
            $('[name="id_tpv"]').val(data[1].id_tpv);
            $('[name="producto"]').val(data[0].producto);
            var prod = data[0].producto;
            $('[name="stock_act"]').val(data[2].stock_act);
            $('[name="stock_min"]').val(data[2].stock_min);
            $('#modificarStock_modal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text(prod); // Set title to Bootstrap modal title
        }
        , error: function (jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}


function modificar_stock() {
    event.preventDefault();
    var id_producto     = $('#id_producto').val() ;
    var prod_cantidad   = $('#p_cant').val();
    var stk_actual      = $('#stock_act').val();
    var alm_origen      = $('#id_tpv').val();
    var stk_minimo      = $('#stock_min').val();
    //$('#tpv select').val(alm_origen);
    
    if (prod_cantidad == '' || prod_cantidad == null ){
        if (stk_actual != '' && stk_actual != null){
            prod_cantidad = stk_actual;
        }else {
            alert('Debe especificar una cantidad en "Nuevo stock...!"');
            return false ;
        } 
    }
    
    $.ajax({
        url: "<?php echo site_url('stock/ajax_modifica_stock');?>"
        , type: "post"
        , data: {idp:id_producto, tpv: alm_origen , cantidad: prod_cantidad , stock: stk_actual,  stock_minimo: stk_minimo}
        , dataType: "JSON"
        , success: function (datos) {
            
            if (datos.status) //if success close modal and reload ajax table
            {
                alert('Stock actualizado...!');
                $('#modificarStock_modal').modal('hide');
                reload_table();
            }
        }
        , error: function (jqXHR, textStatus, errorThrown) {
            alert('Error al actualizar los cambios de stock');
        }
    });
    return false;
}

    
    $.validate(
        { lang: 'es'}     
    );
    
    $('#cli_fecha_nacimiento').datepicker({
        todayBtn: "linked"
        , clearBtn: true
        , language: "es"
        , orientation: "bottom right"
        , autoclose: true
        , todayHighlight: true
        , format: 'dd-mm-yyyy'
    }); 

</script>
