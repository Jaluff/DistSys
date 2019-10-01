<div class="panel panel-success">
<h3 class="text-center"><?php echo lang('index_heading');?></h3>
<!-- <p><?php echo lang('index_subheading');?></p> -->
</div>

<?php  if ($message){ ?>

<div id="infoMessage" class="alert uk-alert-success" role="alert"><?php echo $message;?></div>

<?php } ?>

<table class="table table-bordered table-condensed table-responsive" cellspacing="0" width="100%" id="ion_usuarios" >
	<thead>
	<tr>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Usuario</th>
		<th>Email</th>
		<th>Groups</th>
		<th>Status</th>
		<th>Action</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($users as $user):?>
		<tr>
			<td><?php echo $user->first_name;?></td>
			<td><?php echo $user->last_name;?></td>
			<td><?php echo $user->username;?></td>
			<td><?php echo $user->email;?></td>
			<td>
				<?php foreach ($user->groups as $group):?>
					<?php echo anchor("auth/edit_group/".$group->id, $group->name) ;?><br />
                <?php endforeach?>
			</td>
			<td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, 'Active') : anchor("auth/activate/". $user->id, 'Inactive');?></td>
			<td><?php echo anchor("auth/edit_user/".$user->id, 'Edit') ;?></td>
		</tr>
	<?php endforeach;?>
	</tbody>
</table>

<p class="uk-text-center">
	<a href="<?php echo site_url('auth/create_user');?>" class="btn btn-primary">Nuevo usuario</a>
	<a href="<?php echo site_url('auth/create_group');?>" class="btn btn-primary">Nuevo grupo</a>
</p>

<script type="text/javascript">
$(document).ready( function () {
    $('#ion_usuarios').DataTable({
    	"language": {
        "url": "<?php echo base_url()?>assets/themes/default/DataTables/esp_lenguaje.json"
    	}
	});
} );
</script>
