<header>
    <div class="headerwrapper">
        <div class="header-left">
            <?php echo $this->Html->image( 'logo.png', array( 'class' => 'logo' ) ) ?>
            <div class="pull-right">
                <a href="" class="menu-collapse">
                    <i class="fa fa-bars"></i>
                </a>
            </div>
        </div><!-- header-left -->
        
        <div class="header-right">
            
            <div class="pull-right">
                <?php
                echo $this->Form->create( 'Search', array( 'url' => '/admin/search/index', 'type' => 'get', 'class' => 'form form-search', 'inputDefaults' => array( 'div' => false, 'label' => false ) ) );
                echo $this->Form->input( 'keyword', array( 'class' => 'form-control', 'placeholder' => 'Search', 'type' => 'search' ) );

                echo $this->Form->end();
                ?>
                <div class="btn-group btn-group-list">
                    <a href="<?= Router::url( array( 'controller' => 'messages', 'action' => 'index' ) ) ?>" style="color: #FFF" class="btn btn-default">
                        <i class="fa fa-envelope-o"></i>
                        <span class="badge"></span>
                    </a>
                </div>                
                <div class="btn-group btn-group-list">
                    <a href="<?= Router::url( array( 'controller' => 'mail_inboxes', 'action' => 'add' ) ) ?>" style="color: #FFF" class="btn btn-default">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
                <div class="btn-group btn-group-list">
                    <div class="dropdown-menu pull-right">
                        <h5><?= __( 'Payment Confirmation' ) ?></h5>
                        <ul class="media-list dropdown-list">
                        </ul>
                        <!--
                        <div class="dropdown-footer text-center">
                            <a href="" class="link">See All Messages</a>
                        </div>
                        -->
                    </div><!-- dropdown-menu -->
                    <a href="<?= $this->request->here ?>" style="color: #FFF" class="btn btn-default">
                        <i class="glyphicon glyphicon-refresh"></i>
                        <small><?= __( BTN_REFRESH ) ?></small>
                    </a>


                </div>


                        
                <!-- Menu Profile -->       
                    <?= $this->Element( 'profile-menu' ); ?>
                <!-- END MENU PROFILE -->
                
            </div><!-- pull-right -->
            
        </div><!-- header-right -->
        
    </div><!-- headerwrapper -->
</header>