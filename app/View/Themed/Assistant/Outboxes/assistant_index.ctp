
        
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
                    <li><?php echo $this->Paginator->sort( $var_model . '.perihal', __( 'Perihal' ) ); ?></li>
                    <li><?php echo $this->Paginator->sort( $var_model . '.id', __( 'Tanggal' ) ); ?></li>
                </ul>
                
            </div><!--/ .btn-group -->
            
        </div><!--/ .btn-toolbar -->
        
        <br />
        
        
            <table class="table table-bordered table-hover">

                <thead>

                </thead>

                <tbody>

                    <?php
                        foreach( $datas as $data ):

                            $row    = $data[ $var_model ];
                            $id     = $row[ 'id' ];

                            $created   = date( 'D, d F Y H:i:s', strtotime( $row[ 'created' ] ) );
                            foreach( $data[ 'OutboxLeader' ] as $outbox )
                            {   
                                if( $outbox[ 'leader_id' ] == $auth_data[ 'leader_id' ] )
                                {
                                    $status = $outbox[ 'status' ];
                                    
                                }
                            }
                    ?>

                    <tr class="<?= bootstrap_row_status_type2( $status ) ?>">
                        <td>
                            <h4>
                                <?php
                                    echo $this->Html->link(
                                        __( $row[ 'perihal' ] ),
                                        array(
                                            'controller' => $var_controller,
                                            'action' => 'read',
                                            $id
                                        )
                                    );
                                ?>
                                / 
                                <small>
                                    <?php
                                        echo text_approved( $status ) ;
                                    ?>                                    
                                </small>
                            </h4>
                            <p>Lampiran: <br><small><?= $row[ 'lampiran' ] ?></small></p>
                            <p> Tipe Surat : <small><?= $mail_types[ $row [ 'mail_type' ] ]; ?></small> </p>
                            <o><?php echo $created; ?></o>
                        </td>
                    </tr>

                    <?php endforeach; ?>

                </tbody>
            </table>
        
        <?php echo $this->Element( 'Administrator/pagination' ); ?>
        