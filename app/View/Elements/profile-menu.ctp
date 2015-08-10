<div class="btn-group btn-group-option">

                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li>
                            <?php echo $this->Html->link( '<i class="glyphicon glyphicon-user"></i> ' . __ ( 'My Profile' ), 
                                    array( 'controller' => 'users', 
                                           'action' => 'profile', 
                                           $auth_id ), 
                                    array( 'escape' => false ) ); 
                            ?>
                        </li>
                        <li class="divider"></li>
                        <li class="dropdown-header"><?= __( 'Setting' ) ?></li>
                        <li>
                        <?php echo $this->Html->link( __ ( 'Email Format' ), 
                                    array( 'controller' => 'email_formats', 
                                           'action' => 'index', 
                                           'admin' => true,), 
                                    array( 'escape' => false ) ); 
                            ?>
                        </li>
                        <li class="divider"></li>                        
                        <li class="dropdown-header"><?= __( 'Language' ) ?></li>
                        <li>
                        <?php echo $this->Html->link( '<i class="flag-US"></i> ' . __ ( 'English' ), 
                                    array( 'controller' => 'home', 
                                           'action' => 'index',
                                           'language' => 'eng' ), 
                                    array( 'escape' => false ) ); 
                            ?>
                        </li>
                        <li>
                        <?php echo $this->Html->link( '<i class="flag-ID"></i> ' . __ ( 'Indonesian' ), 
                                    array( 'controller' => 'home', 
                                           'action' => 'index', 
                                           'language' => 'ind' ), 
                                    array( 'escape' => false ) ); 
                            ?>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <?php echo $this->Html->link( '<i class="glyphicon glyphicon-log-out"></i> ' . __( 'Sign Out' ), 
                                    array( 'controller' => 'users', 
                                           'action' => 'logout', 
                                           'admin' => false,
                                           'leader' => false,
                                           'unit' => false,
                                           'assistant' => false ), 
                                    array( 'escape' => false ) ); 
                            ?>
                        </li>
                    </ul>
                </div><!-- btn-group -->