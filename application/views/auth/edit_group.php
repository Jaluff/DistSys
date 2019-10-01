<div class="container">
<div class="panel panel-success">

<h3 class="text-center"><?php echo lang('edit_group_heading');?></h3>

</div>


<h4 class="text-center"><?php echo lang('edit_group_subheading');?></4>
<hr>

<?php  if ($message){ ?>

<div id="infoMessage" class="alert alert-danger" role="alert"><?php echo $message;?></div>

<?php } ?>

<div class="row">

<?php echo form_open(current_url());?>

	<div class="col-md-6">
	    <?php echo lang('edit_group_name_label', 'group_name');?> <br />
	    <?php echo form_input($group_name,'','class="form-control"');?>
	</div>

	<div class="col-md-6 form-group">
	    <?php echo lang('edit_group_desc_label', 'description');?> <br />
	    <?php echo form_input($group_description,'','class="form-control"');?>
	</div>

	<div class="row">
	<div class="col-md-12 ">
		<?php echo form_submit('submit', lang('edit_group_submit_btn'),'class="btn btn-primary center-block"');?>
	</div>
	</div>

<?php echo form_close();?>

</div>
</div>
