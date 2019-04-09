<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
        <!-- <li><a href="<?=base_url()?>">DASHBOARD</a></li> -->
        <li class="dropdown show-on-hover"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">CLIENTES <span class="caret"></span></a>
            <ul class="dropdown-menu">
                
                <li><a href="<?=base_url()?>cliente">Consultar</a></li>
               
            </ul>
        </li>
        <li class="dropdown show-on-hover"> 
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">            PRODUCTOS <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                
                <li><a href="<?=base_url()?>producto">Consultar</a></li>
                
            </ul>
        </li>
        
        <li class="dropdown show-on-hover"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">TPV <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="<?=base_url()?>venta">Ventas</a></li>
                <li><a href="<?=base_url()?>tpv">Realizar venta</a></li>           
                <!-- <li><a href="#">Apertura de caja</a></li>
                <li><a href="#">Cierre de caja</a></li> -->
                
            </ul>
        </li>
        
        
    </ul>
    
    <ul class="nav navbar-nav navbar-right">
        <li class="dropdown show-on-hover"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> MI CUENTA <span class="caret"></span></a>
            <ul id="login-dp" class="dropdown-menu">
                <li>
                    <div class="row">
                        <div class="col-md-12">
                            <?php if($this->session->userdata('identity')){ ?>
                                <div class="well well-sm" <h4>Bienvenido:</h4>
                                    <?php

                  $user = $this->ion_auth->user()->row();

                  echo $user->first_name . ", " ;

                  echo $user->last_name;

                ?>
                                        <div class="h5">Privilegios:
                                            <?php echo ($this->ion_auth->group('Vendedores')) ? 'Vendedor' : 'Administrativo' ; ?>
                                        </div>
                                        <div class="h5">Empresa:
                                            <?=$user->company;?>
                                        </div>
                                        <div class="h5">Fecha de alta:
                                            <?php echo date('d-m-Y', $user->created_on);?>
                                        </div> <a href="<?=base_url()?>/auth/logout" class="btn btn-danger center-block">Cerrar sesión</a>
                                        <?php }?>
                                </div>
                        </div>
                    </div>
                </li>
            </ul>
        </li>
    </ul>
</div>


