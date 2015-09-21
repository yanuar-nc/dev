<?php

    /**
     * app/View/Elements/Administrator/leftpanel.ctp
     * Created by Falmesino Abdul Hamid(falmesino@gmail.com)
     */

?>

<div class="leftpanel">

    <div class="logopanel">
        <h1><span>Otoy</span>CMS</h1>
    </div><!-- logopanel -->

    <div class="leftpanelinner">

        <!-- This is only visible to small devices -->
        <div class="visible-xs hidden-sm hidden-md hidden-lg">   
            <div class="media userlogged">
                <?php echo $this->Html->image( $auth_picture, array( 'class' => 'media-object' ) ); ?>
                <div class="media-body">
                    <h4><?php echo $auth_display_name; ?></h4>
                    <span><?php echo $auth_username; ?></span>
                </div>
            </div><!--/ .media -->
            <h5 class="sidebartitle actitle">Account</h5>
            <ul class="nav nav-pills nav-stacked nav-bracket mb30">
                <li>
                    <?php
                        echo $this->Html->link(
                            '<i class="fa fa-user"></i> ' . __( BTN_PROFILE ),
                            array(
                                'controller' => 'users',
                                'action' => 'profile',
                                $auth_id,
                                'admin' => true
                            ),
                            array(
                                'escape' => false
                            )
                        );
                    ?>
                </li>
                <li><a href="#"><i class="fa fa-cog"></i> <span>Account Settings</span></a></li>
                <li><a href="#"><i class="fa fa-question-circle"></i> <span>Help</span></a></li>
                <li>
                    <?php
                        echo $this->Html->link(
                            '<i class="fa fa-sign-out"></i> ' . __( BTN_LOGOUT ),
                            array(
                                'controller' => 'users',
                                'action' => 'logout',
                                'admin' => false
                            ),
                            array(
                                'escape' => false,
                                'confirm' => __( CONFIRM_LOGOUT )
                            )
                        );
                    ?>
                </li>
            </ul>
        </div>

        <h5 class="sidebartitle"><?php echo __( 'Navigation' ); ?></h5>
        <ul class="nav nav-pills nav-stacked nav-bracket">
            <li <?php echo bootstrap_nav_active( $this->request->controller, 'home' ); ?>>
                <?php 
                    echo $this->Html->link(
                        '<i class="fa fa-dashboard"></i>&nbsp;<span>' . __( 'Dashboard' ) . '</span>',
                        array(
                            'controller' => 'home',
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
            
            <?php $nav_array_contents = array( 'posts', 'post_categories', 'tags' ); ?>
            
            <li class="nav-parent <?php echo bootstrap_nav_active( $var_controller, $nav_array_contents, false, 'nav-active active' ); ?> "><a href="#"><i class="fa fa-file-text"></i> <span><?php echo __( 'Contents' ); ?></span></a>
                <ul class="children" <?php echo bootstrap_nav_active( $var_controller, $nav_array_contents, false, 'style="display: block"' ); ?>>
                    <li <?php echo bootstrap_nav_active( $this->request->controller, 'posts' ); ?>>
                        <?php 
                            echo $this->Html->link(
                                '<i class="fa fa-caret-right"></i>&nbsp;' . __( 'Posts' ),
                                array(
                                    'controller' => 'posts',
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
                    <li <?php echo bootstrap_nav_active( $this->request->controller, 'post_categories' ); ?>>
                        <?php 
                            echo $this->Html->link(
                                '<i class="fa fa-caret-right"></i>&nbsp;' . __( 'Post Categories' ),
                                array(
                                    'controller' => 'post_categories',
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
                    <li <?php echo bootstrap_nav_active( $this->request->controller, 'tags' ); ?>>
                        <?php 
                            echo $this->Html->link(
                                '<i class="fa fa-caret-right"></i>&nbsp;' . __( 'Tag' ),
                                array(
                                    'controller' => 'tags',
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

                    <!--
                    <li <?php echo bootstrap_nav_active( $this->request->controller, 'static_pages' ); ?>>
                        <?php 
                            echo $this->Html->link(
                                '<i class="fa fa-caret-right"></i>&nbsp;' . __( 'Static Pages' ),
                                array(
                                    'controller' => 'static_pages',
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
                    -->
                </ul>
            </li>
            
            <?php $nav_array_widgets = array( 'banners', 'blocks', 'polls' ); ?>
            
            <li class="nav-parent <?php echo bootstrap_nav_active( $var_controller, $nav_array_widgets, false, 'nav-active active' ); ?> "><a href="#"><i class="fa fa-code"></i> <span><?php echo __( 'Widgets' ); ?></span></a>
                <ul class="children" <?php echo bootstrap_nav_active( $var_controller, $nav_array_widgets, false, 'style="display: block"' ); ?>>
                    <li <?php echo bootstrap_nav_active( $this->request->controller, 'banners' ); ?>>
                        <?php 
                            echo $this->Html->link(
                                '<i class="fa fa-caret-right"></i>&nbsp;' . __( 'Banners' ),
                                array(
                                    'controller' => 'banners',
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
                    <li <?php echo bootstrap_nav_active( $this->request->controller, 'blocks' ); ?>>
                        <?php 
                            echo $this->Html->link(
                                '<i class="fa fa-caret-right"></i>&nbsp;' . __( 'Blocks' ),
                                array(
                                    'controller' => 'blocks',
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
                    <li <?php echo bootstrap_nav_active( $this->request->controller, 'polls' ); ?>>
                        <?php 
                            echo $this->Html->link(
                                '<i class="fa fa-caret-right"></i>&nbsp;' . __( 'Polls' ),
                                array(
                                    'controller' => 'polls',
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
            </li>
            
            <?php //$nav_array_props = array( 'properties', 'property_certificates', 'property_categories', 'property_locations', 'property_images' ); ?>
            <!--
            <li class="nav-parent <?php echo bootstrap_nav_active( $var_controller, $nav_array_props, false, 'nav-active active' ); ?> "><a href="#"><i class="fa fa-home"></i> <span><?php echo __( 'Properties' ); ?></span></a>
                <ul class="children" <?php echo bootstrap_nav_active( $var_controller, $nav_array_props, false, 'style="display: block"' ); ?>>
                    <li <?php echo bootstrap_nav_active( $this->request->controller, 'properties' ); ?>>
                        <?php 
                            echo $this->Html->link(
                                '<i class="fa fa-caret-right"></i>&nbsp;' . __( 'Properties' ),
                                array(
                                    'controller' => 'properties',
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
                    <li <?php echo bootstrap_nav_active( $this->request->controller, 'property_categories' ); ?>>
                        <?php 
                            echo $this->Html->link(
                                '<i class="fa fa-caret-right"></i>&nbsp;' . __( 'Property Categories' ),
                                array(
                                    'controller' => 'property_categories',
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
                    <li <?php echo bootstrap_nav_active( $this->request->controller, 'property_certificates' ); ?>>
                        <?php 
                            echo $this->Html->link(
                                '<i class="fa fa-caret-right"></i>&nbsp;' . __( 'Property Certificates' ),
                                array(
                                    'controller' => 'property_certificates',
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
                    <li <?php echo bootstrap_nav_active( $this->request->controller, 'property_locations' ); ?>>
                        <?php 
                            echo $this->Html->link(
                                '<i class="fa fa-caret-right"></i>&nbsp;' . __( 'Property Locations' ),
                                array(
                                    'controller' => 'property_locations',
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
                    <li <?php echo bootstrap_nav_active( $this->request->controller, 'property_images' ); ?>>
                        <?php 
                            echo $this->Html->link(
                                '<i class="fa fa-caret-right"></i>&nbsp;' . __( 'Property Images' ),
                                array(
                                    'controller' => 'property_images',
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
            </li>
            -->
            <li <?php echo bootstrap_nav_active( $this->request->controller, 'messages' ); ?>>
                <?php 
                    echo $this->Html->link(
                        '<i class="fa fa-envelope-o"></i>&nbsp;<span>' . __( 'Message' ) . '</span>',
                        array(
                            'controller' => 'messages',
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
            
            <li <?php echo bootstrap_nav_active( $this->request->controller, 'settings' ); ?>>
                <?php 
                    echo $this->Html->link(
                        '<i class="fa fa-cogs"></i>&nbsp;<span>' . __( 'Settings' ) . '</span>',
                        array(
                            'controller' => 'settings',
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
            <li <?php echo bootstrap_nav_active( $this->request->controller, 'users' ); ?>>
                <?php 
                    echo $this->Html->link(
                        '<i class="fa fa-users"></i>&nbsp;<span>' . __( 'User Accounts' ) . '</span>',
                        array(
                            'controller' => 'users',
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
        <!--
        <div class="infosummary">
            <h5 class="sidebartitle">Information Summary</h5>    
            <ul>
                <li>
                    <div class="datainfo">
                        <span class="text-muted">Daily Traffic</span>
                        <h4>630, 201</h4>
                    </div>
                    <div id="sidebar-chart" class="chart"></div>   
                </li>
                <li>
                    <div class="datainfo">
                        <span class="text-muted">Average Users</span>
                        <h4>1, 332, 801</h4>
                    </div>
                    <div id="sidebar-chart2" class="chart"></div>   
                </li>
                <li>
                    <div class="datainfo">
                        <span class="text-muted">Disk Usage</span>
                        <h4>82.2%</h4>
                    </div>
                    <div id="sidebar-chart3" class="chart"></div>   
                </li>
                <li>
                    <div class="datainfo">
                        <span class="text-muted">CPU Usage</span>
                        <h4>140.05 - 32</h4>
                    </div>
                    <div id="sidebar-chart4" class="chart"></div>   
                </li>
                <li>
                    <div class="datainfo">
                        <span class="text-muted">Memory Usage</span>
                        <h4>32.2%</h4>
                    </div>
                    <div id="sidebar-chart5" class="chart"></div>   
                </li>
            </ul>
        </div><!-- infosummary -->

    </div><!-- leftpanelinner -->
</div><!-- leftpanel -->