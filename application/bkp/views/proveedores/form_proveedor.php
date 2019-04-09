<div class="modal" id="proveedor_modal" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">
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
                            
                            <form action="#" class="form-horizontal" id="proveedor">
                                <div class="col-md-12">
                                    <input type="hidden" value="" name="id_proveedor" id="id_proveedor" />
                                    <div class="col-md-4">
                                        <!-- Text input-->
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="prov_nombre">Nombre</label>
                                            <div class="col-md-8 col-xs-12">
                                                <input id="prov_nombre" name="prov_nombre" type="text" placeholder="" class="form-control input-sm"> 
                                            </div>
                                        </div>
                                       
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="prov_provincia">Provincia</label>
                                            <div class="col-md-8 ">
                                                <select id="prov_provincia" name="prov_provincia" class="form-control input-sm ">
                                                    <option value="0">Provincia</option>
                                                    <?php 
                                                    foreach ($provincias as $key => $value) { ?>
                                                        <option value="<?=$value->id?>"><?= $value->nombre?></option>
                                                    <?php }?>
                                                </select>  
                                            </div>
                                        </div>

                                        <!-- Select Basic -->
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="prov_localidad">Localidad</label>
                                            <div class="col-md-8 ">
                                                <!-- <input id="prov_localidad" name="prov_localidad" type="text" class="form-control input-sm  ">   -->
                                                <select id="prov_localidad" name="prov_localidad" class="form-control input-sm ">
                                                       
                                                </select>  
                                            </div>
                                        </div>

                                        <!-- Text input-->
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="prov_direccion">Direccion</label>
                                            <div class="col-md-8 ">
                                                <input id="prov_direccion" name="prov_direccion" type="text" class="form-control input-sm  "> 
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="prov_contacto">Contacto</label>
                                            <div class="col-md-8 ">
                                                <input id="prov_contacto" name="prov_contacto" type="text" class="form-control input-sm  "> 
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="prov_cuit">Cuit</label>
                                            <div class="col-md-8 ">
                                                <input id="prov_cuit" name="prov_cuit" type="text" placeholder="" class="form-control input-sm">  </div>
                                        </div>
                                        
                                        <!-- Text input-->
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="prov_telefono">Telefono</label>
                                            <div class="col-md-8 ">
                                                <input id="prov_telefono" name="prov_telefono" type="text" class="form-control input-sm  "> 
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="prov_movil">Movil</label>
                                            <div class="col-md-8 ">
                                                <input id="prov_movil" name="prov_movil" type="text" class="form-control input-sm  "> 
                                            </div>
                                        </div>

                                      
                                        
                                        
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="prov_correo">E-mail</label>
                                            <div class="col-md-8 ">
                                                <input id="prov_correo" name="prov_correo" type="text" class="form-control input-sm  "> 
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="prov_web">Sitio web</label>
                                            <div class="col-md-8 ">
                                                <input id="prov_web" name="prov_web" type="text" class="form-control input-sm  "> 
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="prov_estado">Estado</label>
                                            <div class="col-md-8 ">
                                                <select id="prov_estado" name="prov_estado" class="form-control input-sm">
                                                    <option value="Activo">Activo</option>
                                                    <option value="Inactivo">Inactivo</option>
                                                </select> 
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="prov_observaciones">Observaciones</label>
                                            <div class="col-md-12 ">
                                                <textarea id="prov_observaciones" name="prov_observaciones" class="form-control input-sm  "></textarea> 
                                            </div>
                                        </div>
                                        
                                    </div>
                            
                                
                            <!-- Button (Double) -->
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                <div class="text-center">
                                    <div class="form-group">
                                        <button  class="btn btn-success" onclick="save_proveedor(); " value="Guardar_proveedor" id="Guardar_proveedor">Guardar</button>
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
   

    $(document).ready(function() { 
        $('#prov_provincia').on('change',function(){         
                 //alert ($('#prov_provincia').prop('value'));
                $('#prov_provincia option:selected').each(function(){
                var provincia = $('#prov_provincia').prop('value'); 
                //console.log(value_select_seleccionado);
                
                $.post("<?=base_url()?>proveedor/getDepartamento",{ provinciaId : provincia},
                    function(data) {
                        $('#prov_localidad').html(data);
                    
                });     
            });         
        });
    });
            
                
        

    

              
                   
    

        /*
         *   funciones para la gestion de clientes
         */
        function add_proveedor() {
            save_method = 'add';
            $('#proveedor')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string
            $('#proveedor_modal').modal('show'); // show bootstrap modal
            $('.modal-title').text('Nuevo proveedor'); // Set Title to Bootstrap modal title
        }

        function editar_proveedor(id) {
            save_method = 'update';
            $('#proveedor')[0].reset(); // reset form on modals
            //$('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string
            //Ajax Load data from ajax

             // alert ($('#prov_provincia').prop('value'));
             //    var provincia = $('#prov_provincia ').prop('value');
             //    console.log(provincia);
                
                     
                   

            $.ajax({
                url: "<?php echo base_url();?>proveedor/ajax_edit/" + id
                , type: "GET"
                , dataType: "JSON"
                , success: function (data) {
                    $('#id_proveedor').val(data.id_proveedor);
                    $('#prov_nombre').val(data.prov_nombre);
                    $('#prov_contacto').val(data.prov_contacto);
                    //$('#prov_localidad').val(data.prov_localidad);
                    $('#prov_cuit').val(data.prov_cuit);
                    //$('#prov_provincia').val(data.prov_provincia);
                    $('#prov_telefono').val(data.prov_telefono);
                    $('#prov_movil').val(data.prov_movil);
                    $('#prov_direccion').val(data.prov_direccion);
                    $('#prov_correo').val(data.prov_correo);
                    $('#prov_web').val(data.prov_web);
                    $('#prov_observaciones').val(data.prov_observaciones);
                    $('#prov_estado').val(data.prov_estado);
                    $('#prov_provincia').val(data.prov_provincia);
                    var provincia = (data.prov_provincia);
                    var dep = (data.prov_localidad);
                    
                    $.post("<?=base_url()?>proveedor/getDepartamento",{ provinciaId : provincia, dep: dep },
                        function(data) {
                            $('#prov_localidad').html(data);
                    });

                    // $('[name="cli_fecha_nacimiento"]').val(getFormattedDate(data.cli_fecha_nac));
                    //$('[name="dob"]').datepicker('update', data.dob);
                    $('#proveedor_modal').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Editar proveedor'); // Set title to Bootstrap modal title
                }
                , error: function (jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        }

        function save_proveedor() {
            $('#Guardar_proveedor').text('guardando...'); //change button text
            $('#Guardar_proveedor').attr('disabled', true); //set button disable
            var url;
            if (save_method == 'add') {
                url = "<?php echo site_url('proveedor/ajax_add');?>";
            }
            else {
                url = "<?php echo site_url('proveedor/ajax_update');?>";
            }
            // ajax adding data to database
            $.ajax({
                url: url
                , type: "POST"
                , data: $('#proveedor').serialize()
                , dataType: "JSON"
                , success: function (datos) {
                    if (datos.status) //if success close modal and reload ajax table
                    {
                        console.log('datos: ' + datos);
                        $('#proveedor_modal').modal('hide');
                        reload_table();
                    }
                    $('#Guardar_proveedor').text('Guardar'); //change button text
                    $('#Guardar_proveedor').attr('disabled', false); //set button enable
                }
                , error: function (jqXHR, textStatus, errorThrown) {
                    alert('Error al guardar los cambios del proveedor');
                    $('#Guardar_proveedor').text('Guardar'); //change button text
                    $('#Guardar_proveedor').attr('disabled', false); //set button enable
                }
            });
        }

        function delete_proveedor(id) {
            if (confirm('Está seguro que desea eliminar este proveedor?')) {
                // ajax delete data to database
                $.ajax({
                    url: "<?php echo site_url('proveedor/ajax_delete')?>/" + id
                    , type: "POST"
                    , dataType: "JSON"
                    , success: function (data) {
                        //if success reload ajax table
                        $('#modal_form').modal('hide');
                        reload_table();
                    }
                    , error: function (jqXHR, textStatus, errorThrown) {
                        alert('Error al elimnar el proveedor');
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
