<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
        <li><a href="<?=base_url()?>">DASHBOARD</a></li>
        <li class="dropdown show-on-hover"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">CLIENTES <span class="caret"></span></a>
            <ul class="dropdown-menu">
                
                <li><a href="<?=base_url()?>cliente">Consultar</a></li>
              
                <!-- <li role="separator" class="divider"></li>
                <li><a href="#">Estadisticas</a></li>
                <li><a href="#">Informes</a></li> -->
            </ul>
        </li>
        <li class="dropdown show-on-hover"> 
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">            PRODUCTOS <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
               
                <li><a href="<?=base_url()?>producto">Consultar</a></li>
                
                <li role="separator" class="divider"></li>
                <!-- <li><a href="#">Importar productos</a></li>
                <li><a href="#">Estadisticas</a></li> -->
                <li><a href="#">Informes</a></li>
                
            </ul>
        </li>
        <li class="dropdown show-on-hover"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ADMINISTRACION<span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="<?=base_url();?>administracion/compras">Stock</a></li>
               
                <li><a href="<?=base_url()?>proveedor">Proveedores</a></li>
            
                <li><a href="<?=base_url()?>administracion/stock">Movimientos de Stock</a></li>
                
                
            </ul>
        </li>
        
        <li class="dropdown show-on-hover"> 
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">TPV 
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li><a href="<?=base_url()?>venta">Ventas</a></li>
                <li><a href="<?=base_url()?>tpv">Realizar venta</a></li>           
                <!-- <li><a href="#">Apertura de caja</a></li>
                <li><a href="#">Cierre de caja</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Sucursales o TPV</a></li>
                <li><a href="#">Estadisticas</a></li> -->
            </ul>
        </li>
        <!-- <li class="dropdown show-on-hover"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">MARKETING<span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="#">Aniversarios</a></li>
                <li><a href="#">Avisos a clientes</a></li>
                <li><a href="#">Configuracion de correo</a></li>
                <li><a href="#">Consultas</a></li>
            </ul>
        </li> -->
        <!-- <li class="dropdown show-on-hover"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">CONFIGURACION <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="#">Empresa</a></li>
                <li><a href="<?=base_url();?>auth">Usuarios</a></li>
                <li><a href="#">Productos</a></li>
                <li><a href="#">General</a></li>
            </ul>
        </li> -->
        
    </ul>
    <!-- <form class="navbar-form navbar-left">

        <div class="form-group">

          <input type="text" class="form-control" placeholder="Search">

        </div>

        <button type="submit" class="btn btn-default">Submit</button>

      </form> -->
    <!-- <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul> -->
    <ul class="nav navbar-nav navbar-right">    
        <li class="dropdown show-on-hover"> 
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <span class="glyphicon glyphicon-user"></span> MI CUENTA 
                <span class="caret"></span>
            </a>
            <ul id="login-dp" class="dropdown-menu">
                <li>
                    <div class="row">
                        <div class="col-md-12">
                            <?php if($this->session->userdata('identity')){ ?>
                                <div class="well well-sm"> <h4>Bienvenido:</h4>
                                    <?php

							 		$user = $this->ion_auth->user()->row();

							 		echo $user->first_name . ", " ;

							 		echo $user->last_name;

							 	?>
                                        <div class="h5">Privilegios:
                                            <?php echo ($this->ion_auth->is_admin()) ? 'Administrador' : 'Usuario' ; ?>
                                        </div>
                                        <div class="h5">Empresa:
                                            <?=$user->company;?>
                                        </div>
                                        <div class="h5">Fecha de alta:
                                            <?php echo date('d-m-Y', $user->created_on);?>
                                        </div> 
                                            <a href="<?=base_url()?>/auth/logout" class="btn btn-danger center-block">
                                                Cerrar sesión
                                            </a>
                                        <?php }?>
                                </div>
                        </div>
                    </div>
                </li>
            </ul>
        </li>
    </ul>
</div>

<!-- /.navbar-collapse -->
