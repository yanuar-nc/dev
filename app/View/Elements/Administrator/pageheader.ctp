<?php

    /**
     * app/View/Elements/Administrator/pageheader.ctp
     * Created by Falmesino Abdul Hamid(falmesino@gmail.com)
     */

    $controller_name    = ucwords( str_replace( '_', ' ', $var_controller ) );
    $action_name        = ucwords( str_replace( array( 'admin', '_' ), array( ' ', ' ' ), $var_action ) );

?>

<div class="pageheader">
    
    <h2><?php echo $controller_name; ?> <span><?php echo $action_name; ?></span></h2>
    
    <div class="breadcrumb-wrapper">
        <span class="label"><?php echo __( 'You are here' ); ?>:</span>
        <ol class="breadcrumb">
            <li>
                <?php
                
                    echo $this->Html->link(
                        'Home',
                        array(
                            'controller' => 'home',
                            'action' => ACTION_INDEX,
                            'admin' => true
                        ),
                        array(
                            'escape' => false
                        )
                    );
                
                ?>
            </li>
            <li><?php echo $this->Html->link( $controller_name, array( 'controller' => $var_controller, 'action' => 'index', 'admin' => true ) ); ?></li>
            <li class="active">
                <?php echo $action_name; ?>
            </li>
        </ol>
    </div>
    
</div><!--/ .pageheader -->