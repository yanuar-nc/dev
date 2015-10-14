
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
                    <a href="<?= Router::url( array( 'controller' => 'mail_inboxes', 'action' => 'index' ) ) ?>" style="color: #FFF" class="btn btn-default">
                        <i class="fa fa-envelope-o"></i>
                        <span class="badge" id="InboxMessage" url="<?= Router::url( array( 'controller' => 'leader_mails', 'action' => 'checkInboxMessage' ), true) ?>"></span>
                    </a>
                </div>
                <div class="btn-group btn-group-list">
                    <a href="<?= Router::url( array( 'controller' => 'outboxes', 'action' => 'index' ) ) ?>" style="color: #FFF" class="btn btn-default">
                        <i class="fa fa-send"></i>
                        <span class="badge" id="OutboxMessage" url="<?= Router::url( array( 'controller' => 'outbox_leaders', 'action' => 'checkOutboxMessage', $this->request->prefix => false ), true) ?>"></span>
                    </a>
                </div>
                        
                <!-- Menu Profile -->       
                    <?= $this->Element( 'profile-menu' ); ?>
                <!-- END MENU PROFILE -->
                
            </div><!-- pull-right -->
            
        </div><!-- header-right -->
        
    </div><!-- headerwrapper -->
</header>