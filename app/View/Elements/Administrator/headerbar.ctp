<?php

    /**
     * app/View/Elements/Administrator/headerbar.ctp
     * Created by Falmesino Abdul Hamid(falmesino@gmail.com)
     */

?>
<div class="headerbar">

    <a class="menutoggle"><i class="fa fa-bars"></i></a>

    <form class="searchform" action="#" method="post">
        <input type="text" class="form-control" name="keyword" placeholder="Search here..." />
    </form>
      
    <div class="header-right">
        <ul class="headermenu">
            <!--
            <li>
                <div class="btn-group">
                    <button class="btn btn-default dropdown-toggle tp-icon" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-user"></i>
                        <span class="badge">2</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-head pull-right">
                        <h5 class="title">2 Newly Registered Users</h5>
                        <ul class="dropdown-list user-list">
                            <li class="new">
                                <div class="thumb"><a href="#"><img src="images/photos/user1.png" alt="" /></a></div>
                                <div class="desc">
                                    <h5><a href="#">Draniem Daamul (@draniem)</a> <span class="badge badge-success">new</span></h5>
                                </div>
                            </li>
                            <li>
                                <div class="thumb"><a href="#"><img src="images/photos/user5.png" alt="" /></a></div>
                                <div class="desc">
                                    <h5><a href="#">Lane Kitmari (@lane_kitmare)</a></h5>
                                </div>
                            </li>
                            <li class="new"><a href="#">See All Users</a></li>
                        </ul>
                    </div>
                </div>
            </li>

            <li>
                <div class="btn-group">
                    <button class="btn btn-default dropdown-toggle tp-icon" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-envelope"></i>
                        <span class="badge">1</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-head pull-right">
                        <h5 class="title">You Have 1 New Message</h5>
                        <ul class="dropdown-list gen-list">
                            <li class="new">
                                <a href="#">
                                    <span class="thumb"><img src="images/photos/user1.png" alt="" /></span>
                                    <span class="desc">
                                        <span class="name">Draniem Daamul <span class="badge badge-success">new</span></span>
                                        <span class="msg">Lorem ipsum dolor sit amet...</span>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="thumb"><img src="images/photos/user2.png" alt="" /></span>
                                    <span class="desc">
                                        <span class="name">Nusja Nawancali</span>
                                        <span class="msg">Lorem ipsum dolor sit amet...</span>
                                    </span>
                                </a>
                            </li>
                            <li class="new"><a href="#">Read All Messages</a></li>
                        </ul>
                    </div>
                </div>
            </li>

            <li>
                <div class="btn-group">
                    <button class="btn btn-default dropdown-toggle tp-icon" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-globe"></i>
                        <span class="badge">5</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-head pull-right">
                        <h5 class="title">You Have 5 New Notifications</h5>
                        <ul class="dropdown-list gen-list">
                            <li class="new">
                                <a href="#">
                                    <span class="thumb"><img src="images/photos/user4.png" alt="" /></span>
                                    <span class="desc">
                                        <span class="name">Zaham Sindilmaca <span class="badge badge-success">new</span></span>
                                        <span class="msg">is now following you</span>
                                    </span>
                                </a>
                            </li>
                            <li class="new"><a href="#">See All Notifications</a></li>
                        </ul>
                    </div>
                </div>
            </li>

            -->

            <li>
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <?php echo $this->Html->image( $auth_picture, array( 'alt' => '' ) ); ?>
                        <?php echo $auth_display_name; ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                        <li>
                            <?php
                                echo $this->Html->link(
                                    '<i class="glyphicon glyphicon-user"></i> ' . __( BTN_PROFILE ),
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
                        
                        <li><a href="#"><i class="glyphicon glyphicon-cog"></i> Account Settings</a></li>
                        <li><a href="#"><i class="glyphicon glyphicon-question-sign"></i> Help</a></li>
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
            </li>
            <!--
            <li>
                <button id="chatview" class="btn btn-default tp-icon chat-icon">
                    <i class="glyphicon glyphicon-comment"></i>
                </button>
            </li>
            -->
        </ul>
    </div><!-- header-right -->
      
</div><!-- headerbar -->