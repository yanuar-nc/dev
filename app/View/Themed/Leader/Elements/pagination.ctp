<?php

    /**
     * app/View/Elements/Administrator/pagination.ctp
     * Created by Falmesino Abdul Hamid(falmesino@gmail.com)
     */

?>
<div class="text-center">
    
    <!--
    <ul class="pagination pagination-sm">
        <li class="disabled"><a href="#"><i class="fa fa-angle-left"></i></a></li>
        <li class="active"><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li class="disabled"><a href="#"><i class="fa fa-angle-right"></i></a></li>
    </ul>
    -->
    
    <small style="display: block;"><?php echo $this->paginator->counter( array( 'format' => 'Page %page% of %pages%, showing %current% from %count% data(s)' ) ); ?></small>

    <ul class="pagination pagination-sm">
    <?php

    echo $this->Paginator->prev( __( 'Previous' ), array( 'tag' => 'li' ), null, array( 'tag' => 'li','class' => 'disabled','disabledTag' => 'a'));

    echo $this->Paginator->numbers( array( 'separator' => '','currentTag' => 'a', 'currentClass' => 'active', 'tag' => 'li','first' => 1) );

    echo $this->Paginator->next( __( 'Next' ), array( 'tag' => 'li', 'currentClass' => 'disabled' ), null, array( 'tag' => 'li','class' => 'disabled', 'disabledTag' => 'a' ) );
    ?>
    </ul>
    
</div>