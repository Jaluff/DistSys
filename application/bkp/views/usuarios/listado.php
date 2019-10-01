
<!-- Modal -->
	<div class="modal" id="mascotas_modal" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">
	    <div class="modal-dialog modal-lg">
	        <div class="modal-content"></div>
	    </div>
	</div>
<!-- /.modal -->
<div class="row">

<!-- <div class="panel panel-success"> -->
	<div class="col-md-12">
		<div class="col-md-5">
			<h3>Listado de clientes</h3>
		</div>
		<div class="col-md-1 pull-right">

		</div>
	</div>
</div>
<div class="row">

<hr class="hr_success">
<!-- <p><?php echo lang('index_subheading');?></p> -->
<!-- </div> -->

<?php  if (isset($message)){ ?>

<div id="infoMessage" class="alert uk-alert-success" role="alert"><?php echo $message;?></div>

<?php } ?>



	<table class="table table-bordered table-condensed table-reponsive" cellspacing="0" width="100%" id="clientes" >
	<div class="text-center">
		<p><a href="#" class="btn btn-info">Nuevo cliente</a></p>
	</div>
		<thead>

		<tr >
			<th></th>
			<th>Codigo</th>
			<th>Nombre</th>
			<th>Telefono</th>
			<th>Movil</th>
			<th class="hidden-xs">Correo electr.</th>
			<th class="hidden-xs">Provincia</th>
			<th class="hidden-xs">Documento</th>
			<th class="hidden">direccion</th>
			<th class="hidden">localidad</th>
			<th class="hidden">provincia</th>
			<th class="hidden">correo</th>
			<th class="hidden">desde</th>
			<th class="hidden">tipo</th>
			<th >mascota id</th>
			<th>Action</th>
		</tr>
		</thead>
		<tbody>
		<?php

	  	foreach ($clientes as $cli):?>
			<tr >
				<td></td>
	      		<td><?php echo $cli->id_cliente;?></td>
				<td><?php echo $cli->cli_nombre;?></td>
				<td><?php echo $cli->cli_telefono;?></td>
				<td><?php echo $cli->cli_movil;?></td>
				<td class="hidden-xs"><?php echo $cli->cli_correo;?></td>
				<td class="hidden-xs"><?php echo $cli->cli_provincia;?></td>
				<td class="hidden-xs"><?php echo $cli->cli_doc;?></td>
				<td class="hidden"><?php echo $cli->cli_direccion;?></td>
				<td class="hidden"><?php echo $cli->cli_localidad;?></td>
				<td class="hidden"><?php echo $cli->cli_provincia;?></td>
				<td class="hidden"><?php echo $cli->cli_correo;?></td>
				<td class="hidden"><?php echo $cli->cli_created_on;?></td>
				<td class="hidden"><?php echo $cli->cli_tipo;?></td>
				<td ><a href="<?=$cli->id?>"><?php echo $cli->mas_nombre;?></a></td>
				<td>

			        <a 	href="<?=base_url()?>clientes/editar_cliente/<?=$cli->id_cliente?>"	class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Editar cliente">
							<span class="glyphicon glyphicon-edit"></span>
					</a>
					<a href="<?=base_url()?>clientes/eliminar_cliente/<?=$cli->id_cliente?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Eliminar cliente">
							<span class="glyphicon glyphicon-remove"></span>
					</a>
					<a href="<?=base_url()?>mascotas/nueva_mascota/<?=$cli->id_cliente?>" class="btn btn-info btn-sm" data-toggle="colla"  data-placement="top" title="Ver o agregar mascotas">
							<span class="glyphicon glyphicon-plus-sign"></span>
					</a>

	      		</td>
			</tr>
		<?php endforeach;?>
		</tbody>
	</table>




</div>


<script type="text/javascript">

function format ( d ) {
    // `d` is the original data object for the row
	console.log(d);
    return '<div class="col-md-7"><table  class=" table-condensed " width="100%">'+
        '<tr>'+
            '<th ><div class="text-right">Direccion:</div></th>'+
        	'<td ><div class="text-left">'+d.direccion+'</div></td>'+
        '</tr>'+
    	'<tr >'+
        	'<th ><div class="text-right">Localidad:</div></th>'+
        	'<td><div class="text-left">'+d.localidad+'</div></td>'+
        '</tr>'+
		'<tr >'+
        	'<th ><div class="text-right">Provincia:</div></th>'+
        	'<td><div class="text-left">'+d.provincia+'</div></td>'+
        '</tr>'+
		'<tr >'+
        	'<th ><div class="text-right">Correo:</div></th>'+
        	'<td><div class="text-left">'+d.correo+'</div></td>'+
        '</tr>'+
		'<tr >'+
        	'<th ><div class="text-right">Cliente desde:</div></th>'+
        	'<td><div class="text-left">'+d.desde+'</div></td>'+
        '</tr>'+
        '<tr >'+
            '<th ><div class="text-right">Tipo de cliente:</div></th>'+
            '<td><div class="text-left">'+d.tipo+'</div></td>'+
        '</tr>'+
    '</table></div>'+
	'<div class="col-md-2 "><a href="<?php echo base_url();?>mascotas/ver/'+ d.codigo +'" class="btn btn-info center-block " >Mascotas</a></div>';
}

$(document).ready( function () {
	$('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
        $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
    });

    var table = $('#clientes').DataTable({
    	"language": { "url": "<?php echo base_url()?>assets/themes/default/dataTables/esp_lenguaje.json" },
		"columns": [
            {
                "className":      'details-control',
                "orderable":      false,
				"data":           null,
                "defaultContent": ''
            },
			{ "data": "codigo" },
            { "data": "nombre" },
            { "data": "telefono" },
            { "data": "movil" },
			{ "data": "correo" },
			{ "data": "provincia" },
			{ "data": "documento" },
			{ "data": "direccion" },
			{ "data": "localidad" },
			{ "data": "provincia" },
			{ "data": "correo" },
			{ "data": "desde" },
			{ "data": "tipo" },
			{ "data": "mascota_id" },
			{ "data": "acciones" },

        ],
		"order": [[1, 'asc']],
		/*"scrollY":        "200px",
	        "scrollCollapse": true,
	        "paging":         true
		}*/


        "order": [[1, 'asc']]
	});




	$(function () {
	  	$('[data-toggle="tooltip"]').tooltip()
  	});

	// Add event listener for opening and closing details
    $('#clientes tbody').on('click', 'td.details-control', function () {


		var tr = $(this).closest('tr');
        var row = table.row( tr );

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );



} );
</script>
