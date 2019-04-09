<div class="panel panel-success">

    <h3 class="text-center"><?php echo lang('create_user_heading');?></h3>

</div>

<?php  if ($message){ ?>

    <div id="infoMessage" class="alert alert-danger" role="alert"><?php echo $message;?></div>

    <?php } ?>

    <div class="row">

        <?php echo form_open("auth/create_user", 'class="form-horizontal"');
        $arrayLabel = array('class' => 'col-md-4 control-label' );
        $arrayinput = array('class' => 'form-control' );
        ?>

        <h4 class="row text-center"><?php echo lang('create_user_subheading');?></h4>

        <hr>

        <div class="col-md-6">
            <div class="form-group">
                <?php echo form_label('Nombre', 'first_name' , $arrayLabel);?>
                <div class="col-md-7">
                    <?php echo form_input($first_name,'', $arrayinput);?>
                    <span class="help-block">Ingrese su nombre</span>
                </div>
            </div>

        </div>

        <div class="col-md-6">
            <div class="form-group">
                <?php echo form_label('Apellido', 'last_name', $arrayLabel);?>
                <div class="col-md-7">
                    <?php echo form_input($last_name,'', $arrayinput);?>
                    <span class="help-block">Ingrese su apellido</span>
                </div>
            </div>


        </div>




        <div class="col-md-6">
            <div class="form-group">
                <?php echo form_label('Empresa', 'company', $arrayLabel);?>
                <div class="col-md-7">
                    <?php echo form_input($company,'',$arrayinput);?>
                    <span class="help-block">Ingrese su empresa</span>
                </div>
            </div>
            <div class="form-group">
                <?php echo form_label('Correo electronico', 'email', $arrayLabel);?>
                <div class="col-md-7">
                    <?php echo form_input($email,'',$arrayinput);?>
                    <span class="help-block">Ingrese su correo electronico</span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
             <?php

        if($identity_column!=='email') { ?>
            <!-- echo '<p>';
            echo lang('create_user_identity_label', 'identity');
            echo '<br />';
            echo form_error('identity');
            echo form_input($identity,'',$arrayinput);
            echo '</p>'; -->
        
            <div class="form-group">
                <?php echo form_label('Usuario', 'identity', $arrayLabel);?>
                <div class="col-md-7">
                    <?php echo form_input($identity,'',$arrayinput);?>
                    <span class="help-block">Ingrese su nombre de usuario</span>
                </div>
            </div>
            

        <?php 
        }

        ?>

            

            <div class="form-group">
                <?php echo form_label('Telefono', 'phone', $arrayLabel);?>
                <div class="col-md-7">
                    <?php echo form_input($phone,'',$arrayinput);?>
                    <span class="help-block">Ingrese su correo electronico</span>
                </div>
            </div>
        </div>

        <div class="row ">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo form_label('Contraseña', 'password' , $arrayLabel);?>
                        <div class="col-md-7">
                            <?php echo form_input($password, '' , $arrayinput);?>
                            <span class="help-block">Ingrese su contraseña</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo form_label('Confirma la contraseña', 'password_confirm' , $arrayLabel);?>
                        <div class="col-md-7">
                            <?php echo form_input($password_confirm, '' , $arrayinput);?>
                            <span class="help-block">Confirme su contraseña</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo form_label('TPV', 'location', array('class' => 'col-sm-4 control-label'));?> 
                        <div class="col-sm-7"><?php echo form_dropdown('location',$location, $location[0], 'class="form-control"');?>   
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                </div>
            </div>

        </div>

        <div class="row">
            <div class="text-center">
                <div class="form-group">
                    <?php echo form_submit('submit', 'Crear usuario','class="btn btn-primary center-block"');?>
                </div>
            </div>
        </div>
        
        <?php echo form_close();?>

    </div>
