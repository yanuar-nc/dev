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
             
        <li <?php echo bootstrap_nav_active( $this->request->controller, 'emails' ); ?>>
            <?php 
                echo $this->Html->link(
                    '<i class="fa fa-envelope-o"></i>&nbsp;<span>' . __( 'Subscribers Email' ) . '</span>',
                    array(
                        'controller' => 'emails',
                        'action' => 'index',
                        'admin' => true
                    ),
                    array(
                        'escape' => false,
                        'class' => ''
                    )
                ); 
            ?>
        </li>                                     

    </ul>
    
</div><!-- leftpanel -->