<div class="panel panel-success">

	<h3 class="text-center"><?php echo lang('forgot_password_heading');?></h3>

</div>

<div class="row">

<?php  if ($message){ ?>

<div id="infoMessage" class="alert alert-success" role="alert"><?php echo $message;?></div>

<?php } ?>

<?php echo form_open("auth/forgot_password",'class="form"');?>

	<h4 class="row text-center"><?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?></h4>

	<hr>

  	<div class="row">

        <div class="col-md-6 col-md-offset-3">

        	<div class="form-group">

    	  		<label for="identity">

    	  			<?php echo (($type=='email') ? sprintf(lang('forgot_password_email_label'), $identity_label) : sprintf(lang('forgot_password_identity_label'), $identity_label));?>

	  			</label>

	  			<br />

      			<?php echo form_input($identity,'','class="form-control"');?>

      		</div>

      	</div>

  	</div>

    <?php echo form_submit('submit', lang('forgot_password_submit_btn'),'class="btn btn-primary center-block "');?>

<?php echo form_close();?>

</div>
