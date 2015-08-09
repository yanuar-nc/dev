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
        <li <?php echo bootstrap_nav_active( $this->request->controller, 'transactions' ); ?>>
            <?php 
                echo $this->Html->link(
                    '<i class="fa fa-shopping-cart"></i>&nbsp;<span>' . __( 'Transaction' ) . '</span>',
                    array(
                        'controller' => 'transactions',
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
        <?php $nav_array_contents = array( 'products', 'product_categories' ); ?>
        <li class="<?php echo bootstrap_nav_active( $var_controller, $nav_array_contents, false, 'active' ); ?> parent">
            <a href=""><i class="fa fa-gift"></i> <span><?php echo __( 'Products' ); ?></span></a>
            <ul class="children" <?php echo bootstrap_nav_active( $var_controller, $nav_array_contents, false, 'style="display: block"' ); ?>>
                <li <?php echo bootstrap_nav_active( $this->request->controller, 'products' ); ?>>
                    <?php 
                        echo $this->Html->link(
                            __( 'Products' ),
                            array(
                                'controller' => 'products',
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
                <li <?php echo bootstrap_nav_active( $this->request->controller, 'product_categories' ); ?>>
                    <?php 
                        echo $this->Html->link(
                            __( 'Product Categories' ),
                            array(
                                'controller' => 'product_categories',
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
                <li <?php echo bootstrap_nav_active( $this->request->controller, 'product_types' ); ?>>
                    <?php 
                        echo $this->Html->link(
                            __( 'Product Types' ),
                            array(
                                'controller' => 'product_types',
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
        <!--
        <li <?php echo bootstrap_nav_active( $this->request->controller, 'categories' ); ?>>
            <?php 
                echo $this->Html->link(
                    '<i class="fa fa-sitemap"></i>&nbsp;<span>' . __( 'Categories' ) . '</span>',
                    array(
                        'controller' => 'categories',
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
        <?php $nav_array_contents = array( 'articles', 'article_categories' ); ?>
        <li class="<?php echo bootstrap_nav_active( $var_controller, $nav_array_contents, false, 'active' ); ?> parent">
            <a href=""><i class="fa fa-rss-square"></i> <span><?php echo __( 'Article' ); ?></span></a>
            <ul class="children" <?php echo bootstrap_nav_active( $var_controller, $nav_array_contents, false, 'style="display: block"' ); ?>>
                <li <?php echo bootstrap_nav_active( $this->request->controller, 'articles' ); ?>>
                    <?php 
                        echo $this->Html->link(
                            __( TEXT_ARTICLE ) . '</span>',
                            array(
                                'controller' => 'articles',
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
                <li <?php echo bootstrap_nav_active( $this->request->controller, 'article_categories' ); ?>>
                    <?php 
                        echo $this->Html->link(
                            __( TEXT_ARTICLE_CATEGORIES ),
                            array(
                                'controller' => 'article_categories',
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

        <?php $nav_array_contents = array( 'medias', 'media_categories' ); ?>
        <li class="<?php echo bootstrap_nav_active( $var_controller, $nav_array_contents, false, 'active' ); ?> parent">
            <a href=""><i class="fa fa-video-camera"></i> <span><?php echo __( 'Digital Media' ); ?></span></a>
            <ul class="children" <?php echo bootstrap_nav_active( $var_controller, $nav_array_contents, false, 'style="display: block"' ); ?>>
                <li <?php echo bootstrap_nav_active( $this->request->controller, 'medias' ); ?>>
                    <?php 
                        echo $this->Html->link(
                            __( 'Digital Media' ),
                            array(
                                'controller' => 'medias',
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
                <li <?php echo bootstrap_nav_active( $this->request->controller, 'media_categories' ); ?>>
                    <?php 
                        echo $this->Html->link(
                            __( 'Digital Media Category' ),
                            array(
                                'controller' => 'media_categories',
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

        <?php $nav_array_contents = array( 'galleries', 'gallery_categories' ); ?>
        <li class="<?php echo bootstrap_nav_active( $var_controller, $nav_array_contents, false, 'active' ); ?> parent">
            <a href=""><i class="fa fa-image"></i> <span><?php echo __( TEXT_GALLERIES ); ?></span></a>
            <ul class="children" <?php echo bootstrap_nav_active( $var_controller, $nav_array_contents, false, 'style="display: block"' ); ?>>
                <li <?php echo bootstrap_nav_active( $this->request->controller, 'galleries' ); ?>>
                    <?php 
                        echo $this->Html->link(
                            __( TEXT_GALLERIES ),
                            array(
                                'controller' => 'galleries',
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
                <li <?php echo bootstrap_nav_active( $this->request->controller, 'gallery_categories' ); ?>>
                    <?php 
                        echo $this->Html->link(
                            __( TEXT_GALLERY_CATEGORIES ),
                            array(
                                'controller' => 'gallery_categories',
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

        <?php $nav_array_contents = array( 'pages' ); ?>
        <li class="<?php echo bootstrap_nav_active( $var_controller, $nav_array_contents, false, 'active' ); ?> parent">
            <a href=""><i class="fa fa-desktop"></i> <span><?php echo __( TEXT_PAGE ); ?></span></a>
            <ul class="children" <?php echo bootstrap_nav_active( $var_controller, $nav_array_contents, false, 'style="display: block"' ); ?>>
                <li>
                    <?php 
                        echo $this->Html->link(
                            __( 'Page' ),
                            array(
                                'controller' => 'pages',
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
                <?php

                foreach( $page_types  as $pages )
                {
                ?>
                <li>
                    <?php 
                        echo $this->Html->link(
                            __( $pages ),
                            array(
                                'controller' => 'pages',
                                'action' => 'index',
                                $pages,
                                'admin' => true
                            ),
                            array(
                                'escape' => false,
                                'class' => ''
                            )
                        ); 
                    ?>
                </li>
                <?php
                }
                ?>
               
            </ul>
        </li>
        <!--
        <li <?php echo bootstrap_nav_active( $this->request->controller, 'pages' ); ?>>
            <?php 
                echo $this->Html->link(
                    '<i class="fa fa-desktop"></i>&nbsp;<span>' . __( TEXT_PAGE ) . '</span>',
                    array(
                        'controller' => 'pages',
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
        <li <?php echo bootstrap_nav_active( $this->request->controller, 'banners' ); ?>>
            <?php 
                echo $this->Html->link(
                    '<i class="glyphicon glyphicon-picture"></i>&nbsp;<span>' . __( 'Banners' ) . '</span>',
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

        <?php $nav_array_contents = array( 'outlets', 'outlet_categories' ); ?>
        <li class="<?php echo bootstrap_nav_active( $var_controller, $nav_array_contents, false, 'active' ); ?> parent">
            <a href=""><i class="fa fa-map-marker"></i> <span><?php echo __( TEXT_OUTLETS ); ?></span></a>
            <ul class="children" <?php echo bootstrap_nav_active( $var_controller, $nav_array_contents, false, 'style="display: block"' ); ?>>
                <li <?php echo bootstrap_nav_active( $this->request->controller, 'outlets' ); ?>>
                    <?php 
                        echo $this->Html->link(
                            __( TEXT_OUTLETS ),
                            array(
                                'controller' => 'outlets',
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
                <li <?php echo bootstrap_nav_active( $this->request->controller, 'outlet_categories' ); ?>>
                    <?php 
                        echo $this->Html->link(
                            __( TEXT_OUTLET_CATEGORIES ),
                            array(
                                'controller' => 'outlet_categories',
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

        <li <?php echo bootstrap_nav_active( $this->request->controller, 'users' ); ?>>
            <?php 
                echo $this->Html->link(
                    '<i class="fa fa-cogs"></i>&nbsp;<span>' . __( TEXT_USER ) . '</span>',
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
        <li <?php echo bootstrap_nav_active( $this->request->controller, 'messages' ); ?>>
            <?php 
                echo $this->Html->link(
                    '<i class="fa fa-envelope-o"></i>&nbsp;<span>' . __( 'Messages' ) . '</span><span class="badge">' . $notif_message . '</span>' . '',
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