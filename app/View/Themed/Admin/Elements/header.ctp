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
                        <ul class="media-list dropdown-list">
                            <?php
                            foreach( $notifications as $data ):

                                $row    = $data[ 'Notification' ];
                                $leader = $data[ 'Leader' ];
                                $from   = $leader[ 'name' ];
                                $text   = $text_notification[ $row[ 'action' ] ] . " " . $text_notification[ $row[ 'content' ] ];
                                $redirect = Router::url( array( 'controller' => $row[ 'content' ], 'action' => $row[ 'redirect' ], $row[ 'content_id' ] ), true );
                            ?>  
                            <a href="<?= $redirect ?>">
                                <li class="media">
                                    <div class="media-body">
                                      <strong><?= $from ?></strong> <?= $text ?> anda
                                      <small class="date"><i class="fa fa-calendar"></i> <?= time_ago( $row[ 'created' ] ) ?></small>
                                    </div>
                                </li>
                            </a>
                            <?php
                            endforeach;
                            ?>
                            <li class="media">
                                <img class="img-circle pull-left noti-thumb" src="images/photos/user2.png" alt="">
                                <div class="media-body">
                                  <strong>Weno Carasbong</strong> shared a photo of you in your <strong>Mobile Uploads</strong> album.
                                  <small class="date"><i class="fa fa-calendar"></i> July 04, 2014</small>
                                </div>
                            </li>
                            <li class="media">
                                <img class="img-circle pull-left noti-thumb" src="images/photos/user3.png" alt="">
                                <div class="media-body">
                                  <strong>Venro Leonga</strong> likes a photo of you
                                  <small class="date"><i class="fa fa-thumbs-up"></i> July 03, 2014</small>
                                </div>
                            </li>
                            <li class="media">
                                <img class="img-circle pull-left noti-thumb" src="images/photos/user4.png" alt="">
                                <div class="media-body">
                                  <strong>Nanterey Reslaba</strong> shared a photo of you in your <strong>Mobile Uploads</strong> album.
                                  <small class="date"><i class="fa fa-calendar"></i> July 03, 2014</small>
                                </div>
                            </li>
                            <li class="media">
                                <img class="img-circle pull-left noti-thumb" src="images/photos/user1.png" alt="">
                                <div class="media-body">
                                  <strong>Nusja Nawancali</strong> shared a photo of you in your <strong>Mobile Uploads</strong> album.
                                  <small class="date"><i class="fa fa-calendar"></i> July 02, 2014</small>
                                </div>
                            </li>
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