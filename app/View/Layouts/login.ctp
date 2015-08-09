<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Administrator</title>

        <?php echo $this->Html->css( 'style.default' ) ?>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="signin">
        
        
        <section>
            
            <div class="panel panel-signin">
                <div class="panel-body">
                    <div class="logo text-center">
                        <?php echo $this->Html->image( 'logo-alt.png' ); ?>
                    </div>
                    <br />
                    <h4 class="text-center mb5">Do you have account ?</h4>
                    <p class="text-center">Sign in to your account</p>
                    
                    <div class="mb30"></div>
                    
                    <?php echo $this->Session->flash(); ?>
                    
                    <?php echo $this->Form->create( $var_model, array( 'action' => 'login', 'class' => 'form-horizontal', 
                        'inputDefaults' => 
                            array( 
                                'div' => false, 
                                'label' => false,
                                'error'  => array( 
                                    'attributes' => array(
                                        'class' => 'alert alert-danger alert-block'
                                    )
                                )
                            ) 
                        ) 
                    ); ?>  

                        <div class="input-group mb15">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <?php echo $this->Form->input( 'username', array( 'required', 'tabindex' => 1, 'class' => 'form-control', 'placeholder' => __( 'Username' ) ) ); ?>
                        </div><!-- input-group -->
                        <div class="input-group mb15">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <?php echo $this->Form->input( 'password', array( 'required', 'tabindex' => 2, 'maxlength' => 16, 'class' => 'form-control pword', 'placeholder' => __( 'Password' ) ) ); ?>
                        </div><!-- input-group -->
                        
                        <div class="clearfix">
                            <div class="pull-left">
                                <div class="ckbox ckbox-primary mt10">
                                    <input type="checkbox" id="rememberMe" value="1">
                                    <label for="rememberMe">Remember Me</label>
                                </div>
                            </div>
                            <div class="pull-right">
                                <?php echo $this->Form->button( __( BTN_LOGIN . ' <i class="fa fa-angle-right ml5"></i>' ), array( 'class' => 'btn btn-success', 'div' => false, 'escape' => false ) ); ?>
                            </div>
                        </div>                      
                    <?php echo $this->Form->end() ?> 
                </div><!-- panel-body -->
                <div class="panel-footer">
                    <center><small><?= TEXT_WELCOME ?></small></center>
                </div><!-- panel-footer -->
            </div><!-- panel -->
            
        </section>

        <?php 
        $theme_scripts  = array( 'jquery-1.11.1.min', 
                                 'jquery-migrate-1.2.1.min', 
                                 'bootstrap.min', 
                                 'modernizr.min',
                                 'pace.min',  
                                 'retina.min',
                                 'jquery.cookies', 
                                 'custom',

                            );

        echo $this->Html->script( $theme_scripts ); 
        ?>

    </body>
</html>
