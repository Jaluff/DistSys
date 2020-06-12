


    
<div class="login-logo">
   
        <img src="<?php echo base_url(); ?>assets/themes/default/images/Logo.png">
    
</div>
<div class="login-box">
    
<div class="panel panel-success">

<h3 class="text-center"><?php echo lang('login_heading');?></h3>

</div>

<?php if(isset($message)){ ?>
<div id="infoMessage" class="alert alert-success" role="alert"><?php echo $message;?></div>
<?php } ?>

<div class="panel panel-default center-block">

<?php echo form_open("auth/login",'class="form-horizontal "');
$arrayLabel = array('class' => 'col-md-4 control-label' );
$arrayinput = array('class' => 'form-control' );
?>

<h5 class="row text-center"><?php echo lang('login_subheading');?></h5>

  <hr>
  <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?php echo form_label('Usuario','identity',$arrayLabel);?>
                <div class="col-md-7">
                    <?php echo form_input($identity,'',$arrayinput);?>
                </div>
            </div>

            <div class="form-group">
                <?php echo form_label('Contraseña' , 'password' , $arrayLabel);?>
                <div class="col-md-7">
                    <?php echo form_input($password,'',$arrayinput);?>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <?php echo form_label('Recuerdame', 'remember' , $arrayLabel);?>
                <div class="col-md-7">
                    <?php echo form_checkbox('remember', '1' , FALSE , ' id="remember" class="checkbox" ');?>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group text-center">
                <p>
                    <a href="forgot_password">
                        <?php echo lang('login_forgot_password');?>
                    </a>
                </p>
                <?php echo form_submit('submit', lang('login_submit_btn'),'class="btn btn-primary center-block"');?>
            </div>
        </div>
</div>

<?php echo form_close();?>
</div>
</div>