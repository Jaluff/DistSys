<div class="row">
    <!-- <div class="panel panel-success"> -->

    <div class="col-md-6">
        <h3>Productos</h3>
    </div>

    <div class="col-md-1 col-xs-1 text-right">
        <?php if ($this->ion_auth->is_admin()) { ?>
        <button class="btn btn-success" onclick="add_producto();"><i class="glyphicon glyphicon-plus"></i> Nuevo producto</button>
        <?php 
    } ?>
    </div>

    <div class="col-md-2 col-xs-1 text-right">
        <button class="btn btn-default" onclick="reload_table();"><i class="glyphicon glyphicon-refresh"></i> Actualizar</button>
    </div>

    <!-- <form name="frm_tpv" id="tpv" class="form-inline">
        <div class="col-md-3 text-right ">
            <label for="tpv" class="control-label">Seleccione TPV: </label>

            <select id="tpv" name="tpv" class="form-control ">
                <?php foreach ($tpv as $t) : ?>
                <option value="<?php echo $t->id_tpv; ?>">
                    <?= $t->tpv_nombre ?>
                </option>

                <?php endforeach; ?>
            </select>
        </div>
    </form> -->
</div>

<div class="row">
    <hr class="hr_success">
    <?php echo lang('index_subheading'); ?>
    <?php
    if (isset($message)) { ?>
    <div id="infoMessage" class="alert uk-alert-success" role="alert">
        <?php echo $message; ?>
    </div>
    <?php 
} ?>
    <div class="col-md-12 panel  ">
        <table class="table table-bordered table-condensed " cellspacing="0" width="100%" id="productos">
            <thead>
                <tr>
                    <th class="hidden-xs">Codigo</th>
                    <th>Producto</th>
                    <th class="hidden-xs">Categoria</th>
                    <th class="hidden-xs">Marca</th>
                    <th>Precio compra</th>
                    <th>Precio Vta</th>
                    <th class="imageGallery">Imagen</th>
                    <th style="min-width: 90px">Action</th>
                </tr>
            </thead>
        </table>
    </div>


    <div class="modal fade" id="modal-default">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Codigo de Barras</h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary btn-print-barcode">
                        <span class="glyphicon glyphicon-print"></span>
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="modal-imagen">
        <div class="modal-dialog modal-lg modal_grande " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Imagenes del producto</h4>
                </div>
                <div class="modal-body">
                
                <div id="fileuploader">Upload</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    <script type="text/javascript">
        table = $('#productos').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "columns": [

                {
                    "data": "Codigo",
                    "className": "hidden-xs"
                },
                {
                    "data": "Producto",
                    "className": "h5"
                },
                {
                    "data": "Categoria",
                    "className": " hidden-xs"
                },
                {
                    "data": "marca",
                    "className": "hidden-xs"
                },
                {
                    "data": "precio_compra"
                },
                {
                    "data": "precio_venta",
                    "className": "hidden-xs"
                },
                {
                    "data": "foto_producto[ ]",
                    "className": "imageGallery"
                },
                {
                    "data": "Acciones"
                }

            ],

            "order": [], //Initial no order.
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo base_url() ?>producto/ajax_list",
                "type": "POST",
                "data": function(d) {
                    d.tpv = $('#tpv select').val();
                }
            }, //Set column definition initialisation properties.

            "columnDefs": [{
                "targets": [-1], //last column
                "orderable": false, //set not orderable
            }]
        });

        $('#tpv').change(function() {
            table.dra-w();
        });

        function reload_table() {
            table.ajax.reload(null, false); //reload datatable ajax
        }
    </script>
    <?php 
    require_once(APPPATH . 'views/productos/form_producto.php');
    //require_once (APPPATH.'views/form_compras.php');
    ?>
    <script type="text/javascript">
    $('.imageGallery td').simpleLightbox();
    
    // $('.imageGallery').on('click', function() {

    //     SimpleLightbox.open({
    //         items: ['demo/images/1big.jpg', 'demo/images/2big.jpg', 'demo/images/3big.jpg']
    //     });
    // });


    $(document).on("click",".btn-view-barcode", function(){
        codigo_barra = $(this).val();
        cantidad = $(this).closest("tr").find("td:eq(5)").text();
        html = "<div class='row'>";
        for (var i = 1; i <= Number(cantidad); i++) {
            html += "<div class='col-xs-5'>";
            html += "<svg id='barcode"+i+"'></svg>";
            html += "</div>";
        }
        html += "</div>";
        $("#modal-default .modal-body").html(html);
        for (var i = 1; i <= Number(cantidad); i++) {
            JsBarcode("#barcode"+i, codigo_barra, {
                margin: 10,
              displayValue: true
            });
        }
    });

    $('#modal-imagen').on('hidden.bs.modal', function () {
            location.reload();
        $('.ajax-file-upload-container').removeData();
    });

    $(document).on("click",".btn-view-imagen", function(){
        $("#fileuploader").removeData();
        id_producto = $(this).val();
        $("#fileuploader").uploadFile({
            
            url: '<?= base_url() ?>producto/fileupload/'+ id_producto ,
            fileName:"file",
            dragDrop: true,
            // returnType: "json",
            acceptFiles:"image/*",
            showDownload:true,
            showPreview:true,
            showDelete: true,
            statusBarWidth:400,
            maxFileSize:200*1024,
            previewHeight: "100px",
            previewWidth: "100px",
            onLoad:function(obj)
                {
                    $.ajax({
                            cache: false,
                            url: "<?= base_url() ?>producto/ver_imagenes/" + id_producto ,
                            dataType: "json",
                            success: function(data) 
                            {
                                console.log(data);
                                for(var i=0;i<data.length;i++)
                                { 
                                    obj.createProgress(data[i]["name"],data[i]["path"],data[i]["size"]);
                                }
                            
                            }
                    });
            },
            deleteCallback: function (data, pd) {
                for (var i = 0; i < data.length; i++) {
                    $.post("<?= base_url() ?>producto/borrar_imagenes", {op: "delete",name: data[i]},
                        function (resp,textStatus, jqXHR) {
                            //Show Message	
                            alert("File Deleted");
                        });
                }
                pd.statusbar.hide(); //You choice.

            },
            downloadCallback:function(filename,pd)
                {
                    location.href="<?= base_url() ?>producto/download?filename="+filename;
                }
            
        });
        
    });
    //     id_producto = $(this).val();
    //     // cantidad = $(this).closest("tr").find("td:eq(5)").text();
    //     html = "<div class='row'>";
    //     // html += "<div class='content'>";
    //     html += "<form action='<?= base_url() ?>producto/fileupload/"+ id_producto +"' enctype='multipart/form-data' class='dropzone dz-clickable' id='fileupload'>";
    //     html += '<div class="dz-default dz-message"><h3>Arrastre las imagens aqui o (Haga click)</h3></div></form>';
    //     // html += "</div>";
    //     html += "</div>";
    //     console.log(html);
    //     $("#modal-imagen .modal-body").html(html);
       
    //     Dropzone.autoDiscover = false;
    //     try {
    //         var myDropzone = new Dropzone("#fileupload" , {
    //             paramName: "file", // The name that will be used to transfer the file
    //             maxFilesize: 2, // MB
    //             acceptedFiles: ".jpeg,.jpg,.png,.gif",
    //             addRemoveLinks : true,
    //             dictDefaultMessage :
    //                 '<span class="bigger-150 bolder">Drop files</span> to upload <span class="smaller-80 grey">(or click)</span>'
    //             ,
    //             dictResponseError: 'Error while uploading file!',

    //             //change the previewTemplate to use Bootstrap progress bars

    //         });
    //     } catch(e) {
    //         alert('Dropzone.js does not support older browsers!');
    //     }
    // });
    

    

    $(document).on("click",".btn-print-barcode",function(){
        
        $("#modal-barcode .modal-body").print({
            globalStyles: false,
            mediaPrint: true,
            stylesheet: "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css",
            noPrintSelector: ".no-print",
           
            append: null,
            prepend: null,
            manuallyCopyFormValues: true,
            deferred: $.Deferred(),
            timeout: 750,
            title: "  ",
            doctype: '<!doctype html>'
        });


    });
        $.validate({
            lang: 'es'
        });

        // $('#cli_fecha_nacimiento').datepicker({
        //     todayBtn: "linked"
        //     , clearBtn: true
        //     , language: "es"
        //     , orientation: "bottom right"
        //     , autoclose: true
        //     , todayHighlight: true
        //     , format: 'dd-mm-yyyy'
        // }); 

        // $('#fecha_nacimiento').datepicker({
        //     todayBtn: "linked"
        //     , clearBtn: true
        //     , language: "es"
        //     , orientation: "bottom right"
        //     , autoclose: true
        //     , todayHighlight: true
        //     , format: 'dd-mm-yyyy'
        // });
    </script> 