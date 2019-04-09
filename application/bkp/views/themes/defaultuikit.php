<html lang="en">
	<head>
		<title><?php echo $title; ?></title>
		<meta name="resource-type" content="document" />
		<meta name="robots" content="all, index, follow"/>
		<meta name="googlebot" content="all, index, follow" />
		<meta content="width=device-width, initial-scale=1" name="viewport">
		<meta charset="utf-8">
	<?php
	/** -- Copy from here -- */
	if(!empty($meta))
	foreach($meta as $name=>$content){
		echo "\n\t\t";
		?><meta name="<?php echo $name; ?>" content="<?php echo $content; ?>" /><?php
			 }
	echo "\n";

	if(!empty($canonical))
	{
		echo "\n\t\t";
		?><link rel="canonical" href="<?php echo $canonical?>" /><?php

	}
	echo "\n\t";

	foreach($css as $file){
	 	echo "\n\t\t";
		?><link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" /><?php
	} echo "\n\t";

	foreach($js as $file){
			echo "\n\t\t";
			?><script src="<?php echo $file; ?>"></script><?php
	} echo "\n\t";

	/** -- to here -- */
?>
    <!-- <link href="<?php echo base_url();?>assets/themes/default/css/uikit.css" rel="stylesheet"> -->
    <link href="<?php echo base_url();?>assets/themes/default/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/themes/default/css/custom_style.css" rel="stylesheet">
    <!-- <link href="<?php echo base_url();?>assets/themes/default/css/components/sticky.min.css" rel="stylesheet">	 -->
	<script src="<?php echo base_url();?>assets/themes/default/js/jquery-1.11.3.min.js"></script>
	<!-- <script src="<?php echo base_url();?>assets/themes/default/js/uikit.js"></script>
	<script src="<?php echo base_url();?>assets/themes/default/js/core/offcanvas.js"></script>
	<script src="<?php echo base_url();?>assets/themes/default/js/core/dropdown.js"></script>
	<script src="<?php echo base_url();?>assets/themes/default/js/components/sticky.js"></script> -->
</head>

<body>
	<div class="container container-center ">
		<div class="panel margin-small-bottom">
			<div class="float-left">
				<a href="">
					<img class="uk-border-rounded" src="<?php echo base_url(); ?>assets/themes/default/images/Logo.png">
				</a>
			</div>

			<div class="uk-navbar-flip">
				<!-- <div class="uk-margin-top">
					<a href="http://www.facebook.com/CuyoDigital#!/pages/Cuyo-Digital/299099030138126" target="_blanc" class="uk-icon-medium uk-icon-hover  uk-icon-facebook-official uk-margin-bottom"></a>
				</div> -->
				<!-- <div class="uk-navbar-content">
					<form class="uk-search" data-uk-search="{source:'my-results.json'}">
					    <input class="uk-search-field uk-form-small" type="search" placeholder="Buscar" >
						    This is the dropdown, which is injected through JavaScript
					    <div class="uk-dropdown uk-dropdown-search">
					        <ul class="uk-nav uk-nav-search">...</ul>
					    </div>
					</form>
				</div> -->
			</div>
		</div>


		<nav class="uk-navbar uk-margin-bottom " data-uk-sticky>

	            <ul class="uk-navbar-nav uk-hidden-small ">
	                <li class="uk-parent" data-uk-dropdown="" aria-haspopup="true" aria-expanded="false">
	                	<a href="">CLIENTES <span class="uk-icon-caret-down uk-icon-justify"></span> </a>
	                	<div class="uk-dropdown uk-dropdown-navbar uk-dropdown-bottom" style="top: 40px; left: 0px;">
	                        <ul class="uk-nav uk-nav-navbar">
	                            <li class="uk-nav-divider"></li>
	                            <li><a href="#">Nuevo cliente</a></li>
	                            <li><a href="#">Modificar cliente</a></li>
	                            <li><a href="#">Listar</a></li>
	                            <li><a href="#">Consultar</a></li>
	                            <li class="uk-nav-divider"></li>
	                            <li><a href="#">Estadisticas</a></li>
	                        </ul>
	                    </div>
                	</li>

	                <li class="uk-parent" data-uk-dropdown="" aria-haspopup="true" aria-expanded="false">
	                	<a href="">PRODUCTOS <span class="uk-icon-caret-down uk-icon-justify"></span></a>
	                	<div class="uk-dropdown uk-dropdown-navbar uk-dropdown-bottom" style="top: 40px; left: 0px;">
	                        <ul class="uk-nav uk-nav-navbar">
	                            <li><a href="#">Nuevo producto</a></li>
	                            <li><a href="#">Modificar producto</a></li>
	                            <li><a href="#">Listar</a></li>
	                            <li><a href="#">Consultar</a></li>
	                            <li class="uk-nav-divider"></li>
	                            <li><a href="#">Importar productos</a></li>
	                            <li><a href="#">Estadisticas</a></li>
	                            <li><a href="#">Configuración</a></li>
	                        </ul>
	                    </div>
                	</li>

	                <li><a href="">COMPRAS</a></li>
	                <li><a href="">VENTAS</a></li>
	                <li><a href="">INFORMES</a></li>
	                <li><a href="">CAJA</a></li>
	                <li><a href="">ESTADISTICAS</a></li>
	                <li><a href="">CONFIGURACION</a></li>
	                <li><a href="">USUARIOS</a></li>

	            </ul>

            	<div class="uk-navbar-flip">
        			<ul class="uk-navbar-nav">
	            		<li>
	            		<div id="fb-root"></div>
	            		<div class="fb-like" data-href="http://www.facebook.com/pages/Cuyo-Digital/299099030138126" data-send="false" style="line-height: 35px;padding: 15px; z-index:1111;" data-layout="button_count" data-width="450" data-show-faces="false"></div>
	        			</li>
			        </ul>
				</div>
            	<a href="#offcanvas" class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas></a>
            	<div class="uk-navbar-brand uk-navbar-center uk-visible-small"></div>
        </nav>


    <!-- <div class="uk-container uk-container-center"> -->
    	<?php if($this->load->get_section('text_header') != '') { ?>

    		<h1><?php echo $this->load->get_section('text_header');?></h1>

    	<?php }?>

    		<div class="uk-grid uk-grid-small ">

    			<?php if($this->load->get_section('sidebar') != '') { ?>

	    			<div class="uk-width-large-1-5">

						<div class="uk-panel uk-panel-box uk-panel-box-secondary">

							<div class="uk-panel-teaser">

                                <span class="uk-text-contrast uk-text-large uk-text-center">hola</span>

                            </div>

						<?php echo $this->load->get_section('sidebar'); ?>

						</div>

					</div>

				<?php }?>
    			<!-- <div class="uk-width-large-4-5"> -->
			    	<?php echo $output;?>
	    		<!-- </div> -->

			</div>

    <!-- </div> -->

</div>
    <footer>
    	<!-- <div class="uk-container uk-container-center"> -->
	    <div class="uk-panel uk-panel-box uk-margin-top" style="background-color: #fff; border-top: 1px solid #999" >
	      	<div class="row uk-text-center">
		        <div class="span6 b10">
					Copyright &copy; <a target="_blank" href="https://plus.google.com/u/0/107789497808468736690?rel=author">John Skoumbourdis</a> | <a target="_blank" href="http://www.web-and-development.com">www.web-and-development.com</a>
		        </div>
	        </div>
        </div>
       <!--  </div> -->
    </footer>




	<div id="offcanvas" class="uk-offcanvas">
	    <div class="uk-offcanvas-bar">
	        <ul class="uk-nav uk-nav-offcanvas">
	            <li class="uk-active">
	                <a href="layouts_frontpage.html">Frontpage</a>
	            </li>
	            <li>
	                <a href="layouts_portfolio.html">Portfolio</a>
	            </li>
	            <li>
	                <a href="layouts_blog.html">Blog</a>
	            </li>
	            <li>
	                <a href="layouts_documentation.html">Documentation</a>
	            </li>
	            <li>
	                <a href="layouts_contact.html">Contact</a>
	            </li>
	            <li>
	                <a href="layouts_login.html">Login</a>
	            </li>
	        </ul>
	    </div>
	</div>
</body>
</html>
