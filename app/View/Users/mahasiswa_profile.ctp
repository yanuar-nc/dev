<?php


    if( isset( $data ) ):

        $row            = $data[ $var_model ];

        $picture_dir    = '/files/' . strtolower( $var_model ) . '/picture/' . $row[ 'picture_dir' ] . '/';
        $picture        = $picture_dir . '' . $row[ 'picture' ];
        $thumbs         = $picture_dir . 'thumb_' . $row[ 'picture' ];

        $url_facebook   = $row[ 'url_facebook' ];
        $url_twitter    = $row[ 'url_twitter' ];
        $url_youtube    = $row[ 'url_youtube' ];
        $url_linkedin   = $row[ 'url_linkedin' ];
        $url_pinterest  = $row[ 'url_pinterest' ];
        $url_instagram  = $row[ 'url_instagram' ];

        $created = date( 'd F Y h:i:s', strtotime( $row[ 'created' ] ) );
        $birthdate = date( 'd F Y', strtotime( $row[ 'birthdate' ] ) );
        $username =  $row[ 'username'];
?>

<div class="row">
    <div class="col-sm-4 col-md-3">
        <div class="text-center">
            <?php echo $this->Html->image( $thumbs, array( 'class' => 'img-circle img-offline img-responsive img-profile' ) ) ?>
            <h4 class="profile-name mb5"><?= $row[ 'display_name' ] ?></h4>
            <div><i class="fa fa-map-marker"></i> <?= $row[ 'city' ] ?>, <?= $row[ 'postal_code' ] ?></div>
            <div><i class="fa fa-briefcase"></i> <?= $row[ 'role' ] ?> at <a href="">Perpustakaan Depsos RI</a></div>
        
            <div class="mb20"></div>
        
            <div class="btn-group">
                <button class="btn btn-primary btn-bordered">Ubah Profil</button>
            </div>
        </div><!-- text-center -->
        
        <br />
      
        <h5 class="md-title">About</h5>
        <p class="mb30">
        Nama akun <i><?= $username ?></i>, lahir pada tanggal <i><?= $birthdate ?></i> dan telah terdaftar pada tanggal <i><?= $created ?></i>. <br>
        Bio: <i><?= $row[ 'bio' ] ?></i>
        </p>
      
        <h5 class="md-title">Connect</h5>
        <ul class="list-unstyled social-list">
            <li><i class="fa fa-twitter"></i> <a href="http://facebook.com/<?= $url_twitter ?>"><?= $url_twitter ?></a></li>
            <li><i class="fa fa-facebook"></i> <a href="http://twiter.com/<?= $url_facebook ?>"><?= $url_facebook ?></a></li>
            <li><i class="fa fa-youtube"></i> <a href="http://youtube.com/<?= $url_youtube ?>"><?= $url_youtube ?></a></li>
            <li><i class="fa fa-linkedin"></i> <a href="http://linkedin.com/<?= $url_linkedin ?>"><?= $url_linkedin ?></a></li>
            <li><i class="fa fa-instagram"></i> <a href="http://instagram.com/<?= $url_instagram ?>"><?= $url_instagram ?></a></li>
        </ul>
      
        <div class="mb30"></div>
      
        <h5 class="md-title">Address</h5>
        <address>
            <?= $row[ 'address' ] ?>
            <abbr title="Phone">P:</abbr> <?= $row[ 'phone' ] ?>
        </address>
      
    </div><!-- col-sm-4 col-md-3 -->

    <div class="col-sm-8 col-md-9">         

        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-line">
            <li class="active"><a href="#transaction" data-toggle="tab"><strong>Transaksi Peminjaman</strong></a></li>
            <li><a href="#transaction-return" data-toggle="tab"><strong>Transaksi Pengembalian</strong></a></li>
        </ul>    
        <div class="tab-content nopadding noborder">
            <div class="tab-pane active" id="transaction">
                <div class="activity-list">  
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object img-circle" src="images/photos/user1.png" alt="" />
                        </a>
                        <div class="media-body">
                            <?php
                            foreach ( $data[ 'Transaction' ] as $transaction ) {
                               
                                $row = $transaction; 
                                $member = $transaction[ 'Member' ];
                                $created = date( 'd M Y g:i a', strtotime( $row[ 'created' ] ) );



                            ?>
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object img-circle" src="images/photos/user1.png" alt="" />
                                </a>
                                <div class="media-body">
                                    No. Transaksi : <strong><?= $row[ 'id' ] ?></strong>. <br />
                                    <small class="text-muted">Kepada: <?= $member[ 'name' ] ?> | <?= $created ?></small>
                                    <ul class="uploadphoto-list">
                                        <?php
                                        foreach ( $transaction[ 'Book' ] as $book ) {
                                            $picture_dir    = '/files/book/picture/' . $book[ 'picture_dir' ] . '/';
                                            $picture        = $picture_dir . '' . $book[ 'picture' ];
                                            $thumbs         = $picture_dir . 'thumb_' . $book[ 'picture' ];                                        
                                        ?>
                                        <li>
                                        <a href="" data-rel="prettyPhoto">
                                            <?php echo $this->Html->image( $thumbs, array( 'class' => 'thumbnail img-responsive' ) ) ?>
                                        </a>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>                                                 
                                </div>
                            </div><!-- media -->
                            <?php
                            }
                            ?>                            
                        </div>
                    </div><!-- media -->
          
                </div>
            </div>
            <div class="tab-pane" id="transaction-return">
                <div class="activity-list">
                    <?php
                    foreach ( $data[ 'TransactionReturn' ] as $transaction ) {
                       
                        $row = $transaction; 
                        $book = $transaction[ 'Book' ];
                        $created = date( 'd M Y g:i a', strtotime( $row[ 'created' ] ) );

                        $picture_dir    = '/files/book/picture/' . $book[ 'picture_dir' ] . '/';
                        $picture        = $picture_dir . '' . $book[ 'picture' ];
                        $thumbs         = $picture_dir . 'thumb_' . $book[ 'picture' ];

                    ?>
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object img-circle" src="images/photos/user1.png" alt="" />
                        </a>
                        <div class="media-body">
                            No. Transaksi : <strong><?= $row[ 'transaction_id' ] ?></strong>. <br />
                            <small class="text-muted"><?= $created ?></small>
                            <div class="media blog-media">
                                <a class="pull-left" href="#">
                                    <?php echo $this->Html->image( $thumbs, array( 'class' => 'media-object thumbnail' ) ) ?>
                                </a>
                                <div class="media-body">
                                    <h4 class="media-title"><a href=><?= $book[ 'judul' ] ?></a></h4>
                                    <p>
                                    ISBN: <?= $book[ 'isbn' ] ?> | Kategori: <?= $book[ 'BookCategory' ][ 'name' ] ?> | Pengarang: <?= $book[ 'Author' ][ 'name' ] ?> | Penerbit: <?= $book[ 'Publisher' ][ 'name' ]?>
                                    <br>
                                    <?= $book[ 'deskripsi' ] ?>
                                    </p>
                                </div>
                              </div><!-- media -->                             
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