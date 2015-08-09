<?php


    if( isset( $data ) ):

        $row            = $data[ $var_model ];

        $picture_dir    = '/files/' . strtolower( $var_model ) . '/picture/' . $row[ 'picture_dir' ] . '/';
        $picture        = $picture_dir . '' . $row[ 'picture' ];
        $thumbs         = $picture_dir . 'thumb_' . $row[ 'picture' ];

        /*
        $url_facebook   = $row[ 'url_facebook' ];
        $url_twitter    = $row[ 'url_twitter' ];
        $url_youtube    = $row[ 'url_youtube' ];
        $url_linkedin   = $row[ 'url_linkedin' ];
        $url_pinterest  = $row[ 'url_pinterest' ];
        $url_instagram  = $row[ 'url_instagram' ];
        */
        $created = date( 'd F Y h:i:s', strtotime( $row[ 'created' ] ) );
        $birthdate = date( 'd F Y', strtotime( $row[ 'birthday_date' ] ) );
        $username =  $row[ 'name'];
?>

<div class="row">
    <div class="col-sm-4 col-md-3">
        <div class="text-center">
            <?php echo $this->Html->image( $thumbs, array( 'class' => 'img-circle img-offline img-responsive img-profile' ) ) ?>
            <h4 class="profile-name mb5"><?= $row[ 'name' ] ?></h4>
        
            <div class="mb20"></div>
        
            <div class="btn-group">
                <?php echo $this->Html->link( __( 'Edit your profile !' ), array( 'action' => 'edit', $auth_id ), array( 'class' => 'btn btn-primary btn-bordered', 'escape' => false ) ); ?>
            </div>
        </div><!-- text-center -->
        
        <br />
      
        <h5 class="md-title">About</h5>
        <p class="mb30">
        <?php echo __( 'Account name is' ) ?> <i><?= $username ?></i>, <?= __( 'was born on' ) ?> <i><?= $birthdate ?></i> <?= __( 'and registered on ' ) ?> <i><?= $created ?></i>. <br>
        </p>
      
        <h5 class="md-title">Personal Phone</h5>
        <ol class="list-unstyled social-list">
            <li><?= $row[ 'phone1' ] ?></li>
            <li><?= $row[ 'phone2' ] ?></li>
            <!--
            <li><i class="fa fa-twitter"></i> <a href="http://facebook.com/<?= $url_twitter ?>"><?= $url_twitter ?></a></li>
            <li><i class="fa fa-facebook"></i> <a href="http://twiter.com/<?= $url_facebook ?>"><?= $url_facebook ?></a></li>
            <li><i class="fa fa-youtube"></i> <a href="http://youtube.com/<?= $url_youtube ?>"><?= $url_youtube ?></a></li>
            <li><i class="fa fa-linkedin"></i> <a href="http://linkedin.com/<?= $url_linkedin ?>"><?= $url_linkedin ?></a></li>
            <li><i class="fa fa-instagram"></i> <a href="http://instagram.com/<?= $url_instagram ?>"><?= $url_instagram ?></a></li>
            -->
        </ul>
      
        <div class="mb30"></div>
      
        
        <address>
            <?php
            $i = 0;
            foreach( $data[ 'UserAddress' ] as $address )
            {
                $city = $address[ 'City' ][ 'name' ];
                $prov = ucwords( strtolower( $address[ 'Province' ][ 'name' ] ) );
            ?>
                <div class="clearfix">
                    <h5 class="md-title">( <?= ++$i ?> ) Address</h5>
                    <?= $address[ 'address' ].', ' . $city . ', ' . $prov ?>
                    <br>
                    <abbr title="Phone">P:</abbr> <?= $address[ 'phone' ] ?>
                </div>
            <?php
            }
            ?>

        </address>
      
    </div><!-- col-sm-4 col-md-3 -->

    <div class="col-sm-8 col-md-9">         

        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-line">
            <li class="active"><a href="#one" data-toggle="tab"><strong><?= __( 'Products' ) ?></strong></a></li>
            <li><a href="#two" data-toggle="tab"><strong><?= __( 'Articles' ) ?></strong></a></li>
            <li><a href="#three" data-toggle="tab"><strong><?= __( 'Pages' ) ?></strong></a></li>
        </ul>    
        <div class="tab-content nopadding noborder">
            <div class="tab-pane active" id="one">
                <div class="activity-list">  
                    <div class="media">
                        <div class="media-body">
                            <?php
                            foreach ( $data[ 'Product' ] as $row ) {
                               
                                $created = date( 'd M Y g:i a', strtotime( $row[ 'created_date' ] ) );



                            ?>
                            <div class="media">
                                <div class="media-body">
                                    <strong><?= $row[ 'name' ] ?></strong> / <small> <?= $row[ 'ProductCategory' ][ 'name' ] ?> </small><br />
                                    <small class="text-muted"><small><i> <?= $created ?></i></small></small>
                                </div>
                            </div><!-- media -->
                            <?php
                            }
                            ?>                            
                        </div>
                    </div><!-- media -->
          
                </div>
            </div>
            <div class="tab-pane" id="two">
                <div class="activity-list">
                    <?php
                    foreach ( $data[ 'Article' ] as $row ) {
                       
                        $created = date( 'd M Y g:i a', strtotime( $row[ 'created_date' ] ) );



                    ?>
                    <div class="media">
                        <div class="media-body">
                            <strong><?= $row[ 'title' ] ?></strong><br />
                            <small class="text-muted"><i> <?= $created ?></i></small>
                        </div>
                    </div><!-- media -->
                    <?php
                    }
                    ?> 
                </div>
            </div>            
            <div class="tab-pane" id="three">
                <div class="activity-list">
                    <?php
                    foreach ( $data[ 'Page' ] as $row ) {
                       
                        $created = date( 'd M Y g:i a', strtotime( $row[ 'created_date' ] ) );



                    ?>
                    <div class="media">
                        <div class="media-body">
                            <strong><?= $row[ 'title' ] ?></strong><br />
                            <small class="text-muted"><i> <?= $created ?></i></small>
                        </div>
                    </div><!-- media -->
                    <?php
                    }
                    ?> 
                </div>
            </div>   
        </div>
    </div>
</div>
<?php endif; ?>