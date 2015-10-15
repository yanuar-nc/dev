
        
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
                    <li><?php echo $this->Paginator->sort( $var_model . '.id', 'Id' ); ?></li>
                    <li><?php echo $this->Paginator->sort( $var_model . '.content', __( 'Type' ) ); ?></li>
                    <li><?php echo $this->Paginator->sort( $var_model . '.created', __( 'Tanggal' ) ); ?></li>
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

                            $created     = time_ago( $row[ 'created' ] );
                            $status      = $row[ 'status' ];
                            $content     = $row[ 'content' ];
                            $text        = $data[ 'Leader' ][ 'name' ] . " " . $text_notification[ $row[ 'action' ] ] . " " . $text_notification[ $row[ 'content' ] ];
                    ?>

                    <tr class="<?= bootstrap_row_status_type2( $status ) ?>">
                        <td>
                            
                            <?php
                                echo $this->Html->link(
                                    $text,
                                    array(
                                        'controller' => $content,
                                        'action' => $row[ 'redirect' ],
                                        $row[ 'content_id' ]
                                    )
                                );
                            ?>
                            <small><?= $created ?></small>
                        </td>
                    </tr>

                    <?php endforeach; ?>

                </tbody>
            </table>
        
        </div><!--/ .table-responsive -->
        
        <?php echo $this->Element( 'Administrator/pagination' ); ?>
        