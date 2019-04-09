
<div class="container">
  <div class="row" id="mini-charts">
  	<div class="col-md-6 col-sm-4"><h2></h2></div>
  </div>
  
  

  <div class="container">
  <div class="row">
    <div class="col-md-3 col-sm-6">
      <a href="javascript:;" class="dashboard-block white">
        <div class="rotate">
          <i class="glyphicon glyphicon-signal"></i>
        </div>
        <div class="details">
          <span class="title">Total vendidos</span>
          <span class="sub"><?php echo $total_venta->tventa; ?> </span> productos
        </div><!--/details-->
        <i class="glyphicon glyphicon-menu-right  more"></i>
      </a><!--/dashboard-block1-->
    </div>
    <div class="col-md-3 col-sm-6">
      <a href="javascript:;" class="dashboard-block">
        <div class="rotate">
          <i class="glyphicon glyphicon-usd"></i>
        </div>
        <div class="details">
          <span class="title">Total Ventas</span>
          <span class="sub">$<?php echo $total_cobro->tVentas; ?> </span>
        </div><!--/details-->
        <i class="glyphicon glyphicon-menu-right more"></i>
      </a><!--/dashboard-block2-->
    </div>
    <div class="col-md-3 col-sm-6">
      <a href="javascript:;" class="dashboard-block">
        <div class="rotate">
          <i class="glyphicon glyphicon-usd"></i>
        </div>
        <div class="details">
          <span class="title">Cobrado en efectivo</span>
          <span class="sub">$<?php echo $total_cobro->tventas_efectivo; ?></span>
        </div><!--/details-->
        <i class="glyphicon glyphicon-menu-right more"></i>
      </a><!--/dashboard-block3-->
    </div>
    <div class="col-md-3 col-sm-6">
      <a href="javascript:;" class="dashboard-block">
        <div class="rotate">
          <i class="glyphicon glyphicon-usd"></i>
        </div>
        <div class="details">
          <span class="title">Cobrado con tarjeta</span>
          <span class="sub">$<?php echo $total_cobro->tventas_tarjeta; ?></span>
        </div><!--/details-->
        <i class="glyphicon glyphicon-menu-right more"></i>
      </a><!--/dashboard-block4-->
    </div>
  </div><!--/row-->
</div>
<br>
  <div class="container">
      <!-- <div class="tab-pane active" id="summary"> -->
        
          
          	<div class="col-sm-12 margin-top">
          	<h4 class="text-center"> </h4>
              	<div class="row">
		            <div class="col-sm-4 col-xs-6">
		            	<!-- <h4 class="text-center">Ventas por tipo</h4> -->
		            	<div id="ventasPortipo" style="min-width: 250px; height: 300px; max-width: 500px; margin: 0 auto"></div>
			            
		            </div>
		            <div class="col-sm-4 col-xs-6">
		            	<!-- <h4 class="text-center">Ventas por TPV en pesos</h4> -->
		            	<div id="ventasTPVpesos" style="min-width: 250px; height: 300px; max-width: 500px; margin: 0 auto"></div>
			            
			            
		            </div>
            		<div class="col-sm-4 col-xs-6">
            			<div id="metodo_dePago" style="min-width: 250px; height: 300px; max-width: 500px; margin: 0 auto"></div>
            			
		            </div>
        		</div>
         	</div>
    </div>
      <hr class="panel panel-info">
      <br>

        <div class="container">
        <div class="col-sm-6 col-xs-6 ">
			<!-- <h3 class="text-center">Proyeciones de ventas</h3> -->
          	<div id="proyeccion" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
		</div> 
		<div class="col-sm-6 col-xs-6 ">
			<!-- <h3 class="text-center">Proyeciones de ventas</h3> -->
          	
		</div> 

		
</div>

<hr class="panel panel-info"><br> 
	<div class="container">
		<div class="col-sm-6 col-xs-6">
			<h4 class="text-center">Productos mas vendidos</h4>     

				<table class="table table-condensed table-responsive table-hover table-bordered" width="100%">
				    
				    <thead>
				        <tr class="h5" >                                  
				            <th class="text-center">Codigo</th>
				            <th class="text-center">Producto</th>
				            <!-- <th class="text-center">Marca</th> -->
							<th class="text-center">Tipo</th>				            
							<th class="text-center">Cantidad</th>				            
				        </tr>
				     </thead>
				     <tbody class="text-center">
				     	<?php foreach ($mas_vendidos as $value) {?>
					        <tr>
					            <td><?php echo $value->codigo;?></td>
					            <td><?php echo $value->nombre;?></td>
					            <!-- <td><?php echo $value->marca;?></td> -->
					            <td><?php echo $value->tipo;?></td>
					            <td class="text-primary"><strong><?php echo $value->cantidad;?></strong></td>
					        </tr>
						<?php }?> 				        
				    </tbody>
				</table>
		</div>
		<div class="col-sm-6 col-xs-6 ">
			<h4 class="text-center">Productos con mayor margen</h4>     

				<table class="table table-condensed table-responsive table-hover table-bordered" width="100%">
				    
				    <thead>
				        <tr class="h5" >                                  
				            <th class="text-center">Producto</th>
				            <th class="text-center">Tipo</th>
				            <th class="text-center">Costo</th> 
							<th class="text-center">Venta</th>				            
							<th class="text-center">Margen</th>				            
				        </tr>
				     </thead>
				     <tbody class="text-center">
				     	<?php foreach ($mayorMargen as $value) {?>
					        <tr>
					            <td><?php echo $value->nombre;?></td>
					            <td><?php echo $value->tipo;?></td>
					            <td><?php echo $value->pc;?></td>
					            <td><?php echo $value->pv;?></td>
					            <td class="text-primary"><strong><?php echo $value->pm;?></strong></td>
					        </tr>
						<?php }?> 				        
				    </tbody>
				</table>
          	
		</div> 
	</div>
			
 <?php foreach ($proyeccion_compras as $value) {?>
        
            <?php //echo date('Y, n, j', strtotime('$value->fecha - 1 month')). "<br>";?>

        <?php }?> 


<!-- javascript -->
<script type="text/javascript">
$.getScript('//code.highcharts.com/highcharts.js',function(){
	// Build the chart
    Highcharts.chart('ventasPortipo', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Ventas por tipo'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false,
                    format: '{point.percentage:.1f} %',
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'porcentaje',
            colorByPoint: true,
            data: [ {
                name: 'Mostrador',
                y: <?php echo $ventas_totMostrador->cantidad; ?>,
                sliced: false,
                selected: false
            }, {
                name: 'Delivery',
                y: <?php echo $ventas_totDelivery->cantidad; ?>
            }]
        }]
    });



    Highcharts.chart('ventasTPVpesos', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Ventas por TPV'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false,
                    format: '{point.percentage:.1f} %',
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'porcentaje',
            colorByPoint: true,
            data: [
            <?php foreach ($ventas_totTPV as  $value) {?>
             {
                name: '<?php echo strtoupper($value->tpv_nombre); ?>',
                y: <?php echo $value->tVentas;?>,
                sliced: false,
                selected: false
            }, 
            <?php }?>
            ]
        }]
    });


    Highcharts.chart('metodo_dePago', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Ventas por TPV'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false,
                    format: '{point.percentage:.1f} %',
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'porcentaje',
            colorByPoint: true,
            data: [
            <?php foreach ($ventas_metodo as  $value) {?>
             {
                name: '<?php echo strtoupper($value->metodoPago); ?>',
                y: <?php echo $value->metodo;?>,
                sliced: false,
                selected: false
            }, 
            <?php }?>
            ]
        }]
    });


    Highcharts.chart('proyeccion', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 'Proyecciones de ventas'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        
        type: 'datetime',
        dateTimeLabelFormats: { // don't display the dummy year
            month: '%e. %b',
            //year: '%b'
        },
        title: {
            text: 'Fecha'
        }
    },
    yAxis: {
        title: {
            text: 'Cantidad'
        },
        min: 0
    },
    tooltip: {
        headerFormat: '',
       //pointFormat: '{point.x:%e. %b}: {point.y:.2f} m'
    },

    plotOptions: {
        spline: {
            marker: {
                enabled: true
            }
        }
    },

    series: [{
        name: 'Ventas',
        // Define the data points. All series have a dummy year
        // of 1970/71 in order to be compared on the same x axis. Note
        // that in JavaScript, months start at 0 for January, 1 for February etc.
        data: [
        <?php foreach ($proyeccion_ventas as $value) {?>
        
            [Date.UTC(<?php echo  date('Y, n, j', strtotime($value->fecha));?>), <?php echo $value->cantidad?>],

        <?php }?>    
        ],
    }, {
        name: 'Compras',
        data: [
            <?php foreach ($proyeccion_compras as $value) {?>
        
            [Date.UTC(<?php echo date('Y, n, j', strtotime($value->fecha));?>), <?php echo $value->cantidad?>],

        <?php }?>  
        ]
    }]
});




});

</script>


