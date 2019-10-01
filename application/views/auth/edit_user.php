<div class="panel panel-success">

<h3 class="text-center"><?php echo lang('edit_user_heading');?></h3>

</div>

<?php  if ($message){ ?>

<div id="infoMessage" class="alert alert-danger" role="alert"><?php echo $message;?></div>

<?php } ?>
<div class="row">

    <?php echo form_open(uri_string(), 'class="form-horizontal"');

    $arrayLabel = array('class' => 'col-md-4 control-label' );
    $arrayinput = array('class' => 'form-control' );
    ?>

        <h4 class="row text-center"><?php echo lang('edit_user_subheading');?></h4>
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
                        <div class="col-sm-7"><?php echo form_dropdown('location',$location, $default, 'class="form-control"');?>   
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                </div>
            </div>

        </div>

        <div class="row ">
            <div class="col-md-12">

                <?php if ($this->ion_auth->is_admin()): ?>

                    <h4 class="row"><?php echo lang('edit_user_groups_heading');?></h4>

                    <div class="form-group">

                        <div class="col-md-2 col-md-offset-1 ">

                            <?php foreach ($groups as $group):?>

                                <label class="checkbox">

                                    <?php

                                    $gID=$group['id'];

                                    $checked = null;

                                    $item = null;

                                    foreach($currentGroups as $grp) {

                                        if ($gID == $grp->id) {

                                            $checked= ' checked="checked"';

                                            break;

                                        }

                                    }

                                    ?>

                                    <input type="checkbox" name="groups[]" class="checkbox" value="<?php echo $group['id'];?>"<?php echo $checked;?>>

                                    <?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?>

                                </label>

                            <?php endforeach?>

                        </div>

                    </div>

                <?php endif ?>
            </div>
        </div>
        <?php echo form_hidden('id', $user->id);?>

        <?php echo form_hidden($csrf); ?>

        <div class="row">
            <div class="text-center">
                <div class="form-group">
                    <?php echo form_submit('submit', lang('edit_user_submit_btn'),'class="btn btn-primary center-block "');?>
                </div>
            </div>
        </div>

    <?php echo form_close();?>

</div>
