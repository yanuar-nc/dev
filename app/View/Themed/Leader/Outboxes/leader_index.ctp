
    
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
                    <li><?php echo $this->Paginator->sort( $var_model . '.created', 'Tanggal' ); ?></li>
                </ul>
                
            </div><!--/ .btn-group -->
            
        </div><!--/ .btn-toolbar -->
        
        <br />
        
            <table class="table table-bordered table-hover">

                <tbody>

                    <?php
                        foreach( $datas as $data ):

                            $row    = $data[ $var_model ];
                            $id     = $row[ 'id' ];

                            $created   = date( 'D, d F Y', strtotime( $row[ 'created' ] ) );
                            $status    = $row[ 'leader_status' ];
                    ?> 

                    <tr class="<?= bootstrap_row_status_type2( $status ) ?>">
                        <td>
                            <h4>
                                <?php
                                    echo $this->Html->link(
                                        $row[ 'perihal' ],
                                        array(
                                            'controller' => $var_controller,
                                            'action' => 'read',
                                            $id
                                        )
                                    );
                                ?> / 
                                <small><?= $mail_types[ $row[ 'mail_type' ] ] ?></small>
                            </h4>
                            <p>Lampiran: <small><?= $row[ 'lampiran' ] ?></small></p>
                            <p>Status: <small>(<?= text_approved( $status ) ?>)</small></p>
                            <small>
                                <i class="fa fa-calendar"> &nbsp; <?= $created ?></i>
                            </small>
                        </td>
                    </tr>

                    <?php endforeach; ?>

                </tbody>
            </table>
        
        <?php echo $this->Element( 'Administrator/pagination' ); ?>
        
    </div><!--/ .panel-body -->
    