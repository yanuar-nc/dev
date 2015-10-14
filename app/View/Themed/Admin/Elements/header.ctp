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
                <div class="btn-group btn-group-list">
                    <a href="<?= Router::url( array( 'controller' => 'mail_inboxes', 'action' => 'add' ) ) ?>" style="color: #FFF" class="btn btn-default">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
                
                <div class="btn-group btn-group-list btn-group-notification">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-bell-o"></i>
                      <span class="badge">5</span>
                    </button>
                    <div class="dropdown-menu pull-right">
                        <a href="" class="link-right"><i class="fa fa-search"></i></a>
                        <h5>Notification</h5>
                        <ul class="media-list dropdown-list" id="ListNotification69" ajax-url="<?= Router::url( array( 'controller' => 'notifications', 'action' => 'lists' ), true); ?>">
                            
                        </ul>
                        <div class="dropdown-footer text-center">
                            <a href="" class="link">See All Notifications</a>
                        </div>
                    </div><!-- dropdown-menu -->
                </div>
                <div class="btn-group btn-group-list">
                    <a href="<?= Router::url( array( 'controller' => 'outboxes', 'action' => 'index' ) ) ?>" style="color: #FFF" class="btn btn-default">
                        <i class="fa fa-send"></i>
                        <span class="badge" id="OutboxMessage" url="<?= Router::url( array( 'controller' => 'outbox_leaders', 'action' => 'checkOutboxMessage', $this->request->prefix => false ), true) ?>">0</span>
                    </a>
                </div>


                        
                <!-- Menu Profile -->       
                    <?= $this->Element( 'profile-menu' ); ?>
                <!-- END MENU PROFILE -->
                
            </div><!-- pull-right -->
            
        </div><!-- header-right -->
        
    </div><!-- headerwrapper -->
</header>