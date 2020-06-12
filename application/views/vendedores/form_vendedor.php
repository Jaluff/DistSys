<div class="modal" id="vendedor_modal" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">
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
                            
                            <form action="#" class="form-horizontal" id="vendedor">
                                <div class="col-md-12">
                                    <input type="hidden" value="" name="id_vendedor" id="id_vendedor" />
                                    <div class="col-md-4">
                                        <!-- Text input-->
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="vendedor_nombre">Nombre</label>
                                            <div class="col-md-8 col-xs-12">
                                                <input id="vendedor_nombre" name="vendedor_nombre" type="text" placeholder="" class="form-control input-sm"> 
                                            </div>
                                        </div>
                                       
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="vendedor_provincia">Provincia</label>
                                            <div class="col-md-8 ">
                                                <select id="vendedor_provincia" name="vendedor_provincia" class="form-control input-sm ">
                                                    
                                                </select>  
                                            </div>
                                        </div>

                                        <!-- Select Basic -->
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="vendedor_localidad">Localidad</label>
                                            <div class="col-md-8 ">
                                                <input id="vendedor_localidad" name="vendedor_localidad" type="text" class="form-control input-sm  ">  
                                                <!-- <select id="vendedor_localidad" name="vendedor_localidad" class="form-control input-sm ">
                                                       
                                                </select>   -->
                                            </div>
                                        </div>

                                        <!-- Text input-->
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="vendedor_domicilio">Direccion</label>
                                            <div class="col-md-8 ">
                                                <input id="vendedor_domicilio" name="vendedor_domicilio" type="text" class="form-control input-sm  "> 
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="vendedor_contacto">Contacto</label>
                                            <div class="col-md-8 ">
                                                <input id="vendedor_contacto" name="vendedor_contacto" type="text" class="form-control input-sm  "> 
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="vendedor_cuit">Cuit</label>
                                            <div class="col-md-8 ">
                                                <input id="vendedor_cuit" name="vendedor_cuit" type="text" placeholder="" class="form-control input-sm">  </div>
                                        </div>
                                        
                                        <!-- Text input-->
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="vendedor_telefono">Telefono</label>
                                            <div class="col-md-8 ">
                                                <input id="vendedor_telefono" name="vendedor_telefono" type="text" class="form-control input-sm  "> 
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="vendedor_movil">Movil</label>
                                            <div class="col-md-8 ">
                                                <input id="vendedor_movil" name="vendedor_movil" type="text" class="form-control input-sm  "> 
                                            </div>
                                        </div>

                                      
                                        
                                        
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="vendedor_correo">E-mail</label>
                                            <div class="col-md-8 ">
                                                <input id="vendedor_correo" name="vendedor_correo" type="text" class="form-control input-sm  "> 
                                            </div>
                                        </div>
                                        <!-- <div class="form-group">
                                            <label class="col-md-4 control-label" for="prov_web">Sitio web</label>
                                            <div class="col-md-8 ">
                                                <input id="prov_web" name="prov_web" type="text" class="form-control input-sm  "> 
                                            </div>
                                        </div> -->
                                        
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="vendedor_estado">Estado</label>
                                            <div class="col-md-8 ">
                                                <select id="vendedor_estado" name="vendedor_estado" class="form-control input-sm">
                                                    <option value="Activo">Activo</option>
                                                    <option value="Inactivo">Inactivo</option>
                                                </select> 
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="vendedor_observaciones">Observaciones</label>
                                            <div class="col-md-12 ">
                                                <textarea id="vendedor_observaciones" name="vendedor_observaciones" class="form-control input-sm  "></textarea> 
                                            </div>
                                        </div>
                                        
                                    </div>
                            
                                
                            <!-- Button (Double) -->
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                <div class="text-center">
                                    <div class="form-group">
                                        <button  class="btn btn-success" onclick="save_vendedor(); " value="Guardar_vendedor" id="Guardar_vendedor">Guardar</button>
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

 
    // $('#vendedor_provincia').on('change',function(){         
    //              //alert ($('#prov_provincia').prop('value'));
    //             $('#vendedor_provincia option:selected').each(function(){
    //             var provincia = $('#vendedor_provincia').prop('value'); 
    //             $.post("<?=base_url()?>vendedor/getDepartamento",{ provinciaId : provincia},
    //                 function(data) {
    //                     console.log(data);
    //                     $('#vendedor_localidad').html(data).selectize(); 
    //             });     
    //         });         
    //     });
        
         




    // $('#vendedor_provincia').on('change',function(){         
    //         //alert ($('#prov_provincia').prop('value'));
    //     $('#vendedor_provincia option:selected').each(function(){
    //     var provincia = $('#vendedor_provincia').prop('value'); 
    //     console.log(provincia);
    //     $.post("<?=base_url()?>vendedor/getDepartamento",{ provinciaId : provincia},
    //         function(data) {    //console.log(data);
    //             $('#vendedor_localidad').html(data);
    //         });     
    //     });         
    // });
// });



        /*
         *   funciones para la gestion de clientes
         */
function add_vendedor() {
    save_method = 'add';
    $('#vendedor')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#vendedor_modal').modal('show'); // show bootstrap modal
    $('.modal-title').text('Nuevo vendedor'); // Set Title to Bootstrap modal title
}

function editar_vendedor(id) {
    save_method = 'update';
    $('#vendedor')[0].reset(); // reset form on modals
    //$('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $.ajax({
        url: "<?php echo base_url();?>vendedor/ajax_edit/" + id
        , type: "GET"
        , dataType: "JSON"
        , success: function (data) {
            $('#id_vendedor').val(data.datos.id_vendedor);
            $('#vendedor_nombre').val(data.datos.vendedor_nombre);
            $('#vendedor_contacto').val(data.datos.vendedor_contacto);
            $('#vendedor_cuit').val(data.datos.vendedor_documento);
            $('#vendedor_telefono').val(data.datos.vendedor_telefono);
            $('#vendedor_movil').val(data.datos.vendedor_movil);
            $('#vendedor_domicilio').val(data.datos.vendedor_domicilio);
            $('#vendedor_localidad').val(data.datos.vendedor_localidad)
            $('#vendedor_correo').val(data.datos.vendedor_correo);
            $('#vendedor_observaciones').val(data.datos.vendedor_observaciones);
            $('#vendedor_estado').val(data.datos.vendedor_estado);
            //  console.log(data.datos);
            for( var j  in data.provincias){   //console.log(data.provincias[j].id_provincia + '==' + data.datos.vendedor_id_provincia);
                if(typeof(data.provincias[j].id_provincia) != 'undefined' && data.provincias[j].id_provincia != null){
                    if(data.datos.vendedor_id_provincia !== data.provincias[j].id_provincia ){
                        $("#vendedor_provincia").append("<option value='"+data.provincias[j].id_provincia+"'>"+data.provincias[j].nombre+"</option>"); 
                    }else{
                        $("#vendedor_provincia").append("<option value='"+data.provincias[j].id_provincia+"' selected='selected'>"+data.provincias[j].nombre+"</option>"); 
                    }
                }
            }
            // var provincia = (data.datos.vendedor_id_provincia);
            // var dep = (data.datos.vendedor_localidad);
            
            // $.post("<?=base_url()?>vendedor/getDepartamento",{ provinciaId : provincia, dep: dep },
            //     function(data) {
            //         $('#vendedor_localidad').html(data);
            // });
            $('#vendedor_modal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Editar vendedor'); // Set title to Bootstrap modal title
        }
        , error: function (jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}

function save_vendedor() {
    $('#Guardar_vendedor').text('guardando...'); //change button text
    $('#Guardar_vendedor').attr('disabled', true); //set button disable
    var url;
    if (save_method == 'add') {
        url = "<?php echo site_url('vendedor/ajax_add');?>";
    }
    else {
        url = "<?php echo site_url('vendedor/ajax_update');?>";
    }
    // ajax adding data to database
    $.ajax({
        url: url
        , type: "POST"
        , data: $('#vendedor').serialize()
        , dataType: "JSON"
        , success: function (datos) {
            if (datos.status) //if success close modal and reload ajax table
            {
                console.log('datos: ' + datos);
                $('#vendedor_modal').modal('hide');
                reload_table();
            }
            $('#Guardar_vendedor').text('Guardar'); //change button text
            $('#Guardar_vendedor').attr('disabled', false); //set button enable
        }
        , error: function (jqXHR, textStatus, errorThrown) {
            alert('Error al guardar los cambios del vendedor');
            $('#Guardar_vendedor').text('Guardar'); //change button text
            $('#Guardar_vendedor').attr('disabled', false); //set button enable
        }
    });
}

function delete_vendedor(id) {
    if (confirm('Está seguro que desea eliminar este vendedor?')) {
        // ajax delete data to database
        $.ajax({
            url: "<?php echo site_url('vendedor/ajax_delete')?>/" + id
            , type: "POST"
            , dataType: "JSON"
            , success: function (data) {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
            }
            , error: function (jqXHR, textStatus, errorThrown) {
                alert('Error al elimnar el vendedor');
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
