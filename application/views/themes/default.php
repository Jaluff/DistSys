<html lang="es">

<head>
    <title>
        <?php echo $title; ?>
    </title>
    <meta name="resource-type" content="document" />
    <meta name="robots" content="all, index, follow" />
    <meta name="googlebot" content="all, index, follow" />
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <!-- <meta charset="utf-8"> -->
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

    <!-- Le styles -->
    <!-- <link href="<?php echo base_url(); ?>assets/themes/default/css/paper-dashboard.css" rel="stylesheet"> -->
    <link href="<?php echo base_url(); ?>assets/themes/default/css/bootstrap.css" rel="stylesheet">
    <!--  <link href="<?php echo base_url(); ?>assets/css/themify-icons.css" rel="stylesheet"> -->
    <link href="<?php echo base_url(); ?>assets/themes/default/DataTables/media/css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/themes/default/selectize/selectize.bootstrap3.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/themes/default/DataTables/extensions/Buttons/css/buttons.bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/themes/default/DataTables/extensions/Buttons/css/buttons.dataTables.css" rel="stylesheet">


    <script src="<?php echo base_url(); ?>assets/themes/default/js/jquery-3.1.0.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/themes/default/DataTables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/themes/default/DataTables/media/js/dataTables.bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>assets/themes/default/js/dropdown.js"></script>
    <script src="<?php echo base_url(); ?>assets/themes/default/bootstrap-datapicker/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url(); ?>assets/themes/default/js/collapse.js"></script>
    <script src="<?php echo base_url(); ?>assets/themes/default/js/transition.js"></script>
    <script src="<?php echo base_url(); ?>assets/themes/default/js/bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>assets/themes/default/Form-Validator/form-validator/jquery.form-validator.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/themes/default/selectize/selectize.js"></script>



    <script src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/themes/default/DataTables/extensions/Buttons/js/buttons.html5.js"></script>
    <script src="<?php echo base_url(); ?>assets/themes/default/DataTables/extensions/Buttons/js/buttons.bootstrap.js"></script>

    <script src="<?php echo base_url(); ?>assets/themes/default/DataTables/extensions/Buttons/js/buttons.print.js"></script>
    <script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/pdfmake.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>

    <script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/vfs_fonts.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/themes/default/jsbarcode/JsBarcode.all.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/themes/default/jquery-print/jquery.print.js"></script>

    <link href="http://hayageek.github.io/jQuery-Upload-File/4.0.11/uploadfile.css" rel="stylesheet">
    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
    <script src="http://hayageek.github.io/jQuery-Upload-File/4.0.11/jquery.uploadfile.min.js"></script>

    <link href="<?php echo base_url(); ?>assets/themes/default/bootstrap-datapicker/css/bootstrap-datepicker3.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/themes/default/simpleLightbox/simpleLightbox.min.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>assets/themes/default/simpleLightbox/simpleLightbox.min.js"></script>
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/themes/default/images/favicon.png" type="image/x-icon" />
    <meta property="og:image" content="<?php echo base_url(); ?>assets/themes/default/images/facebook-thumb.png" />
    <link rel="image_src" href="<?php echo base_url(); ?>assets/themes/default/images/facebook-thumb.png" />
    <link href="<?php echo base_url(); ?>assets/themes/default/css/custom_style.css" rel="stylesheet">
    <?php
    /** -- Copy from here -- */
    if (!empty($meta))
        foreach ($meta as $name => $content) {
            echo "\n\t\t";
            ?>
        <meta name="<?php echo $name; ?>" content="<?php echo $content; ?>" />
    <?php
}
echo "\n";

if (!empty($canonical)) {
    echo "\n\t\t";
    ?>
        <link rel="canonical" href="<?php echo $canonical ?>" />
    <?php

}
echo "\n\t";

foreach ($css as $file) {
    echo "\n\t\t";
    ?>
        <link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" />
    <?php
}
echo "\n\t";


foreach ($js as $file) {
    echo "\n\t\t";
    ?>
        <script src="<?php echo $file; ?>"></script>
    <?php
}
echo "\n\t";

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

    <script type="text/javascript"></script>
</head>

<body id="body">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                <a href="">
                    <img class="text-left" src="<?php echo base_url(); ?>assets/themes/default/images/Logo.png" width="150">
                </a>
            </div>
            <div class="col-md-6 text-right">
                <span class="float-right h4"><?php date_default_timezone_set('America/Argentina/Buenos_Aires');
                                                //echo date("F j, Y, g:i a");
                                                ?>

                </span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            
                <nav class="navbar navbar-default">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> 
                            <span class="sr-only">Toggle navigation</span> 
                            <span class="icon-bar"></span> 
                            <span class="icon-bar"></span> 
                            <span class="icon-bar"></span> 
                        </button> 
                        <a class="navbar-brand" href="#">
                            <img class="" src="<?php echo base_url(); ?>assets/themes/default/images/home.png">
                        </a> 
                    </div>
                    <?php
                    if ($this->ion_auth->is_admin()) {
                        require_once APPPATH . 'views/navs/admin_nav.php';
                    } elseif ($this->ion_auth->in_group('Vendedores')) {

                        //require_once APPPATH.'views/navs/vendedor_nav.php';

                    } elseif ($this->ion_auth->in_group('Vendedor')) {
                        //require_once APPPATH.'views/navs/delivery_nav.php';
                    }
                    ?>
                </nav>
            
        </div>
    </div>

    <div class="container-fluid" id="container">
        <?php if ($this->load->get_section('text_header') != '') { ?>
            <h1><?php echo $this->load->get_section('text_header'); ?></h1>
        <?php } ?>
        <div class="col-md-12">
            <?php echo $output; ?>
        </div>
        <!-- <div class="col-md-3">
			<?php echo $this->load->get_section('sidebar'); ?>
	    </div> -->
    </div>
    <hr />
    <div class="container container-fluid">
        <footer>
            <div class="row">
                <div class="container text-center"> Copyright &copy; <a target="_blank" href="#">2019 distribuidora</a> | Diseño: <a target="_blank" href="http://www.interlogic.com.ar">www.interlogic.com.ar</a> </div>
            </div>
        </footer>
    </div>
    <!-- /container -->
    </div>
            <!-- /.container-fluid -->
</body>

</html>