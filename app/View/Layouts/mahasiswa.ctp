<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?= $title_for_layout; ?></title>

		<?php
		$theme_styles   = array( 'style.default' );

		echo $this->Html->css( $theme_styles, array( 'media' => 'screen' ), array( 'block' => 'css' ) );
        echo $this->fetch( 'css' );
		?>
		<!--
        <link href="css/style.default.css" rel="stylesheet">
        <link href="css/morris.css" rel="stylesheet">
        <link href="css/select2.css" rel="stylesheet" />
		
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
        <?php
        $js = array( 'jquery-1.11.1.min', 
                     'jquery-migrate-1.2.1.min', 
                     'jquery-ui-1.10.3.min',
                     'bootstrap.min',
                     'modernizr.min',
                     'pace.min',
                     'retina.min',
                     'jquery.cookies' );
        echo $this->Html->script( $js );
        echo $this->fetch( 'script' );
        echo $this->Html->script( 'custom' );

        ?>        
    </head>

    <body>
        
    	<?php echo $this->Element( 'Mahasiswa/header' ); ?>
        
        <section>
            <div class="mainwrapper">
                
                <div class="mainpanel">
                    <?php echo $this->Element( 'Mahasiswa/leftpanel' ); ?>
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-home"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li>Dashboard</li>
                                </ul>
                                <h4><?= $module_title ?></h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    
                    <div class="contentpanel">
						<?php 
                        /*
                        $nilai = 'P0019';
                        $panjang = strlen( $nilai );
                        $out =(int) substr($nilai, 1, $panjang);
                        $out++;
                        $new = sprintf("%010s", $out);
                        echo 'P'.$new
                        ;
                        */
						echo $this->Session->flash();
						echo $this->fetch( 'content' ); 
                        // echo $this->element( 'sql_dump' );
						?> 
                    </div><!-- contentpanel -->
                    
                </div><!-- mainpanel -->
            </div><!-- mainwrapper -->
        </section>

        <!--
        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/jquery-migrate-1.2.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/modernizr.min.js"></script>
        <script src="js/pace.min.js"></script>
        <script src="js/retina.min.js"></script>
        <script src="js/jquery.cookies.js"></script>
        
        <script src="js/flot/jquery.flot.min.js"></script>
        <script src="js/flot/jquery.flot.resize.min.js"></script>
        <script src="js/flot/jquery.flot.spline.min.js"></script>
        <script src="js/jquery.sparkline.min.js"></script>
        <script src="js/morris.min.js"></script>
        <script src="js/raphael-2.1.0.min.js"></script>
        <script src="js/bootstrap-wizard.min.js"></script>
        <script src="js/select2.min.js"></script>

        <script src="js/custom.js"></script>
        <script src="js/dashboard.js"></script>
        -->


    </body>
</html>
