
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

            </div>
            
            <div class="btn-group">
            
                <?php 
                    echo $this->Html->link(
                        '<i class="fa fa-sort"></i> &nbsp; ' . __( BTN_SORT_BY ),
                        array(
                            'controller' => $var_controller,
                            'action' => ACTION_ADD,
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
                    <li><?php echo $this->Paginator->sort( $var_model . '.perihal', __( 'Perihal' ) ); ?></li>
                    <li><?php echo $this->Paginator->sort( $var_model . '.leader_status', __( 'Status' ) ); ?></li>
                    <li><?php echo $this->Paginator->sort( $var_model . '.received_date', __( 'Received Date' ) ); ?></li>
                </ul>
                
            </div><!--/ .btn-group -->
            
        </div><!--/ .btn-toolbar -->
        
        <br />
        
        <div class="table-responsive">
        
            <table class="table table-bordered table-hover">

                <thead>

                    <tr>
                        <th width="10%"></th>
                        <th width="5%"><?php echo $this->Paginator->sort( $var_model . '.id', 'Id' ); ?></th>
                        <th width="40%"><?php echo $this->Paginator->sort( $var_model . '.perihal', 'Perihal' ); ?></th>
                        <th width="20%"><?php echo $this->Paginator->sort( $var_model . '.created', __( 'Created' ) ); ?></th>
                        <th width="20%"><?php echo $this->Paginator->sort( 'LeaderMail.status', __( 'Status' ) ); ?></th>
                    </tr>

                </thead>

                <tbody>

                    <?php
                        foreach( $datas as $data ):

                            $row    = $data[ $var_model ];
                            $id     = $row[ 'id' ];

                            $created   = date( 'D, d F Y H:i:s', strtotime( $row[ 'created' ] ) );
                    ?>

                    <tr class="">
                        <th>
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-white dropdown-toggle" data-toggle="dropdown">
                                    <?php echo __( BTN_ACTION ); ?> &nbsp; <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <?php
                                            echo $this->Html->link(
                                                __( TEXT_READ ),
                                                array(
                                                    'controller' => $var_controller,
                                                    'action' => ACTION_EDIT,
                                                    $id
                                                )
                                            );
                                        ?>
                                    </li>
                                </ul>
                            </div><!--/ .btn-group -->
                        </th>
                        <td><?php echo $id; ?></td>
                        <td>
                            <h4><?php echo $row[ 'perihal' ] ?> / <small><?= $mail_types[ $row[ 'mail_type' ] ] ?></small></h4>
                            <p>Lampiran: <br><small><?= $row[ 'lampiran' ] ?></small></p>
                            <p> Tipe Surat : <small><?= $mail_types[ $row [ 'mail_type' ] ]; ?></small> </p>
                        </td>
                        <td><?php echo $created; ?></td>
                        <td>
                            <?php
                                foreach( $data[ 'OutboxLeader' ] as $outbox )
                                {   
                                    if( $outbox[ 'leader_id' ] == $auth_data[ 'leader_id' ] )
                                    {
                                        $status = $outbox[ 'status' ];
                                        echo text_approved( $status ) ;
                                    }
                                }
                            ?>
                        </td>
                    </tr>

                    <?php endforeach; ?>

                </tbody>
            </table>
        
        </div><!--/ .table-responsive -->
        
        <?php echo $this->Element( 'Administrator/pagination' ); ?>
        
    </div><!--/ .panel-body -->
    
</div><!--/ .panel -->