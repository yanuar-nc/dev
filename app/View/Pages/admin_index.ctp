
<div class="panel panel-default">
    
    <div class="panel-heading">
        
        <div class="panel-btns">
            <a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>
        </div><!--/ .ppanel-btns -->
        
        <h4 class="panel-title"><?php echo $module_title; ?></h4>
        
    </div><!--/ .panel-heading -->
    
    <div class="panel-body">
        
        <div class="btn-toolbar">
        
            <div class="btn-group">
            
                <a href="javascript:history.go(-1);" class="btn btn-sm btn-white tooltips" data-toggle="tooltip" data-original-title="<?php echo __( TOOLTIP_PREVIOUS ); ?>">
                    <i class="fa fa-chevron-left"></i> &nbsp; <?php echo __( BTN_PREVIOUS ); ?>
                </a>
            
                <a href="<?php echo $this->here; ?>" class="btn btn-sm btn-white tooltips" data-toggle="tooltip" data-original-title="<?php echo __( TOOLTIP_REFRESH ); ?>">
                    <i class="fa fa-refresh"></i> &nbsp; <?php echo __( BTN_REFRESH ); ?>
                </a>
                
            </div><!--/ .btn-group -->
        
            <div class="btn-group">
            
                <?php 
                    echo $this->Html->link(
                        '<i class="fa fa-plus"></i> &nbsp; ' . __( BTN_ADD_NEW ),
                        array(
                            'controller' => $var_controller,
                            'action' => ACTION_ADD,
                            $type,
                            'admin' => true
                        ),
                        array(
                            'class' => 'btn btn-sm btn-white tooltips',
                            'data-toggle' => 'tooltip',
                            'data-original-title' => __( TOOLTIP_ADD_NEW ),
                            'tabindex' => 1,
                            'escape' => false
                        )
                    ); 
                ?>
                
            </div><!--/ .btn-group -->
            <!--
            <div class="btn-group">
            
                <?php 
                    echo $this->Html->link(
                        '<i class="fa fa-sort"></i> &nbsp; ' . __( BTN_SORT_BY ),
                        array(
                            'controller' => $var_controller,
                            'action' => ACTION_INDEX,
                            'admin' => true
                        ),
                        array(
                            'class' => 'btn btn-sm btn-white tooltips',
                            'data-toggle' => 'tooltip',
                            'data-original-title' => __( TOOLTIP_SORT_BY ),
                            'tabindex' => 1,
                            'escape' => false
                        )
                    ); 
                ?>
                
                <button type="button" class="btn btn-sm btn-white dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                </button>
                
                <ul class="dropdown-menu" role="menu">
                    <li><?php echo $this->Paginator->sort( $var_model . '.id', 'Id' ); ?></li>
                    <li><?php echo $this->Paginator->sort( $var_model . '.title', __( 'Title' ) ); ?></li>
                    <li><?php echo $this->Paginator->sort( $var_model . '.published_date', __( 'Published Date' ) ); ?></li>
                </ul>
                
            </div>
            -->
            <!--/ .btn-group -->
            
        </div><!--/ .btn-toolbar -->
        
        <br />
        
        <div class="table-responsive">
        
            <table class="table table-bordered table-hover">

                <thead>

                    <tr>
                        <th width="10%"></th>
                        <th width="5%"><?php echo $this->Paginator->sort( $var_model . '.id', 'Id' ); ?></th>
                        <th width="40%"><?php echo $this->Paginator->sort( $var_model . '.title', 'Title' ); ?></th>
                        <th width="20%"><?php echo $this->Paginator->sort( $var_model . '.created_date', __( 'Created' ) ); ?></th>
                    </tr>

                </thead>

                <tbody>

                    <?php
                        foreach( $datas as $data ):

                            $row    = $data[ $var_model ];
                            $id     = $row[ 'id' ];

                            $created   = date( 'D, d F Y H:i:s', strtotime( $row[ 'created_date' ] ) );
                    ?>

                    <tr>
                        <th>
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-white dropdown-toggle" data-toggle="dropdown">
                                    <?php echo __( BTN_ACTION ); ?> &nbsp; <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <?php
                                            echo $this->Html->link(
                                                __( BTN_EDIT ),
                                                array(
                                                    'controller' => $var_controller,
                                                    'action' => ACTION_EDIT,
                                                    $id,
                                                    'admin' => true
                                                )
                                            );
                                        ?>
                                    </li>
                                    <li>
                                        <?php
                                            echo $this->Html->link(
                                                __( BTN_DELETE ),
                                                array(
                                                    'controller' => $var_controller,
                                                    'action' => ACTION_DELETE,
                                                    $id,
                                                    'admin' => true
                                                ),
                                                array(
                                                    'confirm' => __( CONFIRM_DELETE )
                                                )
                                            );
                                        ?>
                                    </li>
                                </ul>
                            </div><!--/ .btn-group -->
                        </th>
                        <td><?php echo $id; ?></td>
                        <td>
                            <h4><?php echo $row[ 'title' ] ?> / <small><?= $row[ 'type' ] ?></small></h4>
                            <small>
                                <i class="fa fa-globe"></i> URL: &nbsp; <?= $row[ 'url' ] ?> &nbsp; 
                                <i class="fa fa-user"></i> Posted by: &nbsp; <?= $data[ 'User' ][ 'name' ] ?>
                            </small>
                        </td>
                        <td><?php echo $created; ?></td>
                    </tr>

                    <?php endforeach; ?>

                </tbody>
            </table>
        
        </div><!--/ .table-responsive -->
        
        <?php echo $this->Element( 'Administrator/pagination' ); ?>
        
    </div><!--/ .panel-body -->
    
</div><!--/ .panel -->