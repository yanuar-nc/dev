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

		echo $this->Html->css( $theme_styles, null, array( 'block' => 'css' ) );
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
        <style type="text/css" media="print">
            @media print{
                tbody {
                 font-size: 12px!important;

                }
                .panel-default {
                    border: none!important;
                }
                .table-total td{
                    font-size: 14px!important;
                }
            }
        </style>
    </head>

    <body>
        
                <div class="container">
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
						echo $this->fetch( 'content' ) 
						?> 
                    </div><!-- contentpanel -->
                </div>


    </body>
</html>
