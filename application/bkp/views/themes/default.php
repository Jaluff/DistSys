<html lang="es">

<head>
    <title>
        <?php echo $title; ?>
    </title>
    <meta name="resource-type" content="document" />
    <meta name="robots" content="all, index, follow" />
    <meta name="googlebot" content="all, index, follow" />
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta charset="utf-8">
    
    <!-- Le styles -->
    <!-- <link href="<?php echo base_url(); ?>assets/themes/default/css/paper-dashboard.css" rel="stylesheet"> -->
    <link href="<?php echo base_url(); ?>assets/themes/default/css/bootstrap.css" rel="stylesheet">
   <!--  <link href="<?php echo base_url(); ?>assets/css/themify-icons.css" rel="stylesheet"> -->
    <link href="<?php echo base_url(); ?>assets/themes/default/DataTables/media/css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/themes/default/selectize/selectize.bootstrap3.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/themes/default/DataTables/extensions/Buttons/css/buttons.dataTables.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/themes/default/DataTables/extensions/Buttons/css/buttons.bootstrap.css" rel="stylesheet">
    


    <script src="<?php echo base_url();?>assets/themes/default/js/jquery-3.1.0.min.js"></script>
    <script src="<?php echo base_url();?>assets/themes/default/DataTables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/themes/default/DataTables/media/js/dataTables.bootstrap.js"></script>
    <script src="<?php echo base_url();?>assets/themes/default/js/dropdown.js"></script>
    <script src="<?php echo base_url();?>assets/themes/default/bootstrap-datapicker/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url();?>assets/themes/default/js/collapse.js"></script>
    <script src="<?php echo base_url();?>assets/themes/default/js/transition.js"></script>
    <script src="<?php echo base_url();?>assets/themes/default/js/bootstrap.js"></script>
    <script src="<?php echo base_url();?>assets/themes/default/Form-Validator/form-validator/jquery.form-validator.min.js"></script>
    <script src="<?php echo base_url();?>assets/themes/default/selectize/selectize.js"></script>

    
    <script src="<?php echo base_url();?>assets/themes/default/DataTables/extensions/Buttons/js/dataTables.buttons.js"></script>
    <script src="<?php echo base_url();?>assets/themes/default/DataTables/extensions/Buttons/js/buttons.html5.js"></script>
    <script src="<?php echo base_url();?>assets/themes/default/DataTables/extensions/Buttons/js/buttons.bootstrap.js"></script>

    <script src="<?php echo base_url();?>assets/themes/default/DataTables/extensions/Buttons/js/buttons.print.js"></script>

    <link href="<?php echo base_url(); ?>assets/themes/default/bootstrap-datapicker/css/bootstrap-datepicker3.css" rel="stylesheet">
   
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/themes/default/images/favicon.png" type="image/x-icon" />
    <meta property="og:image" content="<?php echo base_url(); ?>assets/themes/default/images/facebook-thumb.png" />
    <link rel="image_src" href="<?php echo base_url(); ?>assets/themes/default/images/facebook-thumb.png" />

    <?php
    /** -- Copy from here -- */
    if(!empty($meta))
    foreach($meta as $name=>$content){
        echo "\n\t\t";
        ?>
        <meta name="<?php echo $name; ?>" content="<?php echo $content; ?>" />
        <?php
             }
    echo "\n";

    if(!empty($canonical))
    {
        echo "\n\t\t";
        ?>
            <link rel="canonical" href="<?php echo $canonical?>" />
            <?php

    }
    echo "\n\t";

    foreach($css as $file){
        echo "\n\t\t";
        ?>
                <link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" />
                <?php
    } echo "\n\t";


    foreach($js as $file){
            echo "\n\t\t";
            ?>
                    <script src="<?php echo $file; ?>"></script>
                    <?php
    } echo "\n\t";

    /** -- to here -- */
?>

    <style type="text/css">
        ::selection {
            background-color: #E13300;
            color: white;
        }
        
        ::moz-selection {
            background-color: #E13300;
            color: white;
        }
        
        ::webkit-selection {
            background-color: #E13300;
            color: white;
        }
        
        body {
            background-color: #fff;
            /*margin: 10px;*/
            font: 12px/20px normal Helvetica, Arial, sans-serif;
            color: #4F5155;
        }
        
        #body {
            margin: 10px 5px 0 5px;
        }
        /*p.footer{
text-align: right;
font-size: 11px;
border-top: 1px solid #D0D0D0;
line-height: 32px;
padding: 0 10px 0 10px;
margin: 20px 0 0 0;
}*/
        
        #container {
            margin: 10px auto;
            /*border: 1px solid #D0D0D0;*/
            /*-webkit-box-shadow: 0 0 8px #D0D0D0;*/
        }
    </style>
    <link href="<?php echo base_url(); ?>assets/themes/default/css/custom_style.css" rel="stylesheet">
                        <script type="text/javascript"></script>
</head>

<body id="body">
    <div class="float-left"> 
        <a href="">
            <img class="" src="<?php echo base_url(); ?>assets/themes/default/images/Logo.png" width="80" >
        </a> 
    </div>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button> <a class="navbar-brand" href="#"><img class="" src="<?php echo base_url(); ?>assets/themes/default/images/home.png"></a> </div>
            <?php
    if ($this->ion_auth->is_admin()){

    	require_once APPPATH.'views/navs/admin_nav.php';
    	
	}elseif ($this->ion_auth->in_group('Vendedores')){

		require_once APPPATH.'views/navs/vendedor_nav.php';
		
	}elseif ($this->ion_auth->in_group('Delivery')){
        require_once APPPATH.'views/navs/delivery_nav.php';
    }
    ?>
        </div>
        <!-- /.container-fluid -->
    </nav>
    <div class="container" id="container">
        <?php if($this->load->get_section('text_header') != '') { ?>
            <h1><?php echo $this->load->get_section('text_header');?></h1>
            <?php }?>
                <div class="col-md-12">



                    <?php echo $output;?>
                </div>
                <!-- <div class="col-md-3">
			<?php echo $this->load->get_section('sidebar'); ?>
	    </div> --></div>
    <hr/>
    <div class="container container-fluid">
        <footer>
            <div class="row">
                <div class="container text-center"> Copyright &copy; <a target="_blank" href="#">2016 XXX Pet Shop</a> | Diseño: <a target="_blank" href="http://www.interlogic.com.ar">www.interlogic.com.ar</a> </div>
            </div>
        </footer>
    </div>
    <!-- /container -->
</body>

</html>
