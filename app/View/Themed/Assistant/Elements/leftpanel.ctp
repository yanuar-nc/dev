<div class="leftpanel">
    <div class="media profile-left">
        <?php
            echo $this->Html->link( $this->Html->image( $auth_picture, array( 'class' => 'img-circle' ) ),
                array(
                    'controller' => 'users',
                    'action' => 'profile',
                    $auth_id
                ),
                array( 'class' => 'pull-left profile-thumb', 'escape' => false )
            );
        ?>
        <div class="media-body">
            <h4 class="media-heading"><?= $auth_display_name; ?></h4>
            <small class="text-muted"><?= $auth_role; ?></small>
        </div>
    </div><!-- media -->
    
    <h5 class="leftpanel-title">Navigation</h5>
    <ul class="nav nav-pills nav-stacked">
        <li <?php echo bootstrap_nav_active( $this->request->controller, 'home' ); ?>>
            <?php 
                echo $this->Html->link(
                    '<i class="fa fa-dashboard"></i>&nbsp;<span>' . __( 'Dashboard' ) . '</span>',
                    array(
                        'controller' => 'home',
                        'action' => 'index'
                    ),
                    array(
                        'escape' => false,
                        'class' => ''
                    )
                ); 
            ?>
        </li>
        <?php $nav_array_contents = array( 'mail_inboxes', 'outboxes' ); ?>
        <li class="<?php echo bootstrap_nav_active( $var_controller, $nav_array_contents, false, 'active' ); ?> parent">
            <a href=""><i class="fa fa-envelope-o"></i> <span><?php echo __( 'Agendaris' ); ?></span></a>
            <ul class="children" <?php echo bootstrap_nav_active( $var_controller, $nav_array_contents, false, 'style="display: block"' ); ?>>
                <li <?php echo bootstrap_nav_active( $this->request->controller, 'mail_inboxes' ); ?>>
                    <?php 
                        echo $this->Html->link(
                            __( 'Surat Masuk' ),
                            array(
                                'controller' => 'mail_inboxes',
                                'action' => 'index',
                            ),
                            array(
                                'escape' => false,
                                'class' => ''
                            )
                        ); 
                    ?>
                </li> 
                <li <?php echo bootstrap_nav_active( $this->request->controller, 'outboxes' ); ?>>
                    <?php 
                        echo $this->Html->link(
                            __( 'Surat Keluar' ),
                            array(
                                'controller' => 'outboxes',
                                'action' => 'index',
                            ),
                            array(
                                'escape' => false,
                                'class' => ''
                            )
                        ); 
                    ?>
                </li>
            </ul>
        </li>             
    </ul>
    
</div><!-- leftpanel -->