<html lang="en">

<head>
    <title>
        <?php echo $title; ?>
    </title>
    <meta name="resource-type" content="document" />
    <meta name="robots" content="all, index, follow" />
    <meta name="googlebot" content="all, index, follow" />
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta charset="utf-8">
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
                        <!-- Le styles -->
                        <link href="<?php echo base_url(); ?>assets/themes/default/css/bootstrap.css" rel="stylesheet">
                        <link href="<?php echo base_url(); ?>assets/themes/default/css/custom_style.css" rel="stylesheet">
                        <link href="<?php echo base_url(); ?>assets/themes/default/dataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet">
                        <script src="<?php echo base_url();?>assets/themes/default/js/dropdown.js"></script>
                        <script src="<?php echo base_url();?>assets/themes/default/js/jquery-1.11.3.min.js"></script>
                        <script src="<?php echo base_url();?>assets/themes/default/js/collapse.js"></script>
                        <script src="<?php echo base_url();?>assets/themes/default/js/transition.js"></script>
                        <script src="<?php echo base_url();?>assets/themes/default/js/bootstrap.js"></script>
                        <script src="<?php echo base_url();?>assets/themes/default/dataTables/media/js/jquery.dataTables.min.js"></script>
                        <script src="<?php echo base_url();?>assets/themes/default/dataTables/media/js/dataTables.bootstrap.js"></script>
                        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
                        <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
                        <!-- Le fav and touch icons -->
                        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/themes/default/images/favicon.png" type="image/x-icon" />
                        <meta property="og:image" content="<?php echo base_url(); ?>assets/themes/default/images/facebook-thumb.png" />
                        <link rel="image_src" href="<?php echo base_url(); ?>assets/themes/default/images/facebook-thumb.png" />
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
                                margin: 10px;
                                font: 12px/20px normal Helvetica, Arial, sans-serif;
                                color: #4F5155;
                            }
                            
                            #body {
                                margin: 10px 15px 0 15px;
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
    <div class="container" id="container">
        <?php echo $output;?>
    </div>
    <hr/>
    <div class="container container-fluid">
        <footer>
            <div class="row">
                <div class="container text-center"> Copyright &copy; <a target="_blank" href="https://plus.google.com/u/0/107789497808468736690?rel=author">John Skoumbourdis</a> | <a target="_blank" href="http://www.web-and-development.com">www.web-and-development.com</a> </div>
            </div>
        </footer>
    </div>
    <!-- /container -->
</body>

</html>