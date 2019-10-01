<div class="modal" id="image_modal" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal_grande" role="document">>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="myModalLabel"></h3>
            </div>
            <div class="modal-body">
                <?php if (isset($message)) { ?>
                    <div id="infoMessage" class="alert alert-success" role="alert">
                        <?php echo $message; ?>
                    </div>
                <?php 
                } ?>
                <div class="row">
                    <div class="content">
                        <div id="fileuploader">Upload</div>
                    <!-- <form action="<?= base_url() ?>producto/fileupload" class="dropzone" id="fileupload"></form> -->
                        <!-- <label>Elegir imagenes</label>
                                            <input type="file" class="form-control" name="foto_producto" id="foto_producto" class="form-control input-sm "> -->
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <hr>
                            <div class="text-center">
                                <div class="form-group">
                                    <button class="btn btn-success" type="submit" value="Guardar_producto" id="Guardar_producto">Guardar</button>
                                    <!-- <button id="Guardarymascota" name="GuardarMascota" class="btn btn-info">Guardar y agregar mascota</button> -->
                                    <button id="Cancelar" name="Cancelar" data-dismiss="modal" class="btn btn-warning">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div> 