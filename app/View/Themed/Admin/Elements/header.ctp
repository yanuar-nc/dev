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
                echo $this->Form->create( 'Search', array( 'url' => '/' . $auth_role . '/search/index', 'type' => 'get', 'class' => 'form form-search', 'inputDefaults' => array( 'div' => false, 'label' => false ) ) );
                echo $this->Form->input( 'keyword', array( 'class' => 'form-control', 'placeholder' => 'Search', 'type' => 'search' ) );

                echo $this->Form->end();
                ?>
                
                <div class="btn-group btn-group-list btn-group-notification">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-bell-o"></i>
                      <span class="badge" id="NotificationCount"></span>
                    </button>
                    <div class="dropdown-menu pull-right">
                        <h5>Notification</h5>
                        <ul class="media-list dropdown-list" id="ListNotification69" ajax-url="<?= Router::url( array( 'controller' => 'notifications', 'action' => 'lists' ), true); ?>">
                            
                        </ul>
                        <div class="dropdown-footer text-center">
                            <?= $this->Html->link( 'Lihat semua pemberitahuan', array( 'controller' => 'notifications', 'action' => 'index' ), array( 'class' => 'link' ) ); ?>
                        </div>
                    </div><!-- dropdown-menu -->
                </div>

                        
                <!-- Menu Profile -->       
                    <?= $this->Element( 'profile-menu' ); ?>
                <!-- END MENU PROFILE -->
                
            </div><!-- pull-right -->
            
        </div><!-- header-right -->
        
    </div><!-- headerwrapper -->
</header>
<div sound-path="<?= $this->request->webroot ?>/sound/iphone notification sound.mp3" id="soundNotification"></div>