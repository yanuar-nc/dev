jQuery(document).ready(function() {
   
   "use strict";
   
   // Tooltip
   jQuery('.tooltips').tooltip({ container: 'body'});
   
   // Popover
   jQuery('.popovers').popover();
   
   // Show panel buttons when hovering panel heading
   jQuery('.panel-heading').hover(function() {
      jQuery(this).find('.panel-btns').fadeIn('fast');
   }, function() {
      jQuery(this).find('.panel-btns').fadeOut('fast');
   });
   
   // Close Panel
   jQuery('.panel .panel-close').click(function() {
      jQuery(this).closest('.panel').fadeOut(200);
      return false;
   });
   
    // Minimize Panel
    jQuery('.panel .panel-minimize').click(function(){
        var t = jQuery(this);
        var p = t.closest('.panel');
        if(!jQuery(this).hasClass('maximize')) {
            p.find('.panel-body, .panel-footer').slideUp(200);
            t.addClass('maximize');
            t.find('i').removeClass('fa-minus').addClass('fa-plus');
            jQuery(this).attr('data-original-title','Maximize Panel').tooltip();
        } else {
            p.find('.panel-body, .panel-footer').slideDown(200);
            t.removeClass('maximize');
            t.find('i').removeClass('fa-plus').addClass('fa-minus');
            jQuery(this).attr('data-original-title','Minimize Panel').tooltip();
        }
        return false;
    });
   
    jQuery('.leftpanel .nav .parent > a').click(function() {
      
        var coll = jQuery(this).parents('.collapsed').length;
      
        if (!coll) {
            jQuery('.leftpanel .nav .parent-focus').each(function() {
                jQuery(this).find('.children').slideUp('fast');
                jQuery(this).removeClass('parent-focus');
            });
         
            var child = jQuery(this).parent().find('.children');
            if(!child.is(':visible')) {
                child.slideDown('fast');
                if(!child.parent().hasClass('active')) child.parent().addClass('parent-focus');
            } else {
                child.slideUp('fast');
                child.parent().removeClass('parent-focus');
            }
        }
        return false;
    });
   
   
    // Menu Toggle
    jQuery('.menu-collapse').click(function() {
        if (!$('body').hasClass('hidden-left')) {
            if ($('.headerwrapper').hasClass('collapsed')) {
                $('.headerwrapper, .mainwrapper').removeClass('collapsed');
            } else {
                $('.headerwrapper, .mainwrapper').addClass('collapsed');
                $('.children').hide(); // hide sub-menu if leave open
            }
        } else {
            if (!$('body').hasClass('show-left')) {
                $('body').addClass('show-left');
            } else {
                $('body').removeClass('show-left');
            }
        }
        return false;
    });
   
    // Add class nav-hover to mene. Useful for viewing sub-menu
    jQuery('.leftpanel .nav li').hover(function(){
        $(this).addClass('nav-hover');
    }, function(){
        $(this).removeClass('nav-hover');
    });
   
    // For Media Queries
    jQuery(window).resize(function() {
        hideMenu();
    });
   
   hideMenu(); // for loading/refreshing the page
    function hideMenu() {

        if($('.header-right').css('position') == 'relative') {
            $('body').addClass('hidden-left');
            $('.headerwrapper, .mainwrapper').removeClass('collapsed');
        } else {
            $('body').removeClass('hidden-left');
        }

        // Seach form move to left
        if ($(window).width() <= 360) {
            if ($('.leftpanel .form-search').length == 0) {
                $('.form-search').insertAfter($('.profile-left'));
            }
        } else {
            if ($('.header-right .form-search').length == 0) {
                $('.form-search').insertBefore($('.btn-group-notification'));
            }
        }
    }
   
    collapsedMenu(); // for loading/refreshing the page
    function collapsedMenu() {

        if($('.logo').css('position') == 'relative') {
            $('.headerwrapper, .mainwrapper').addClass('collapsed');
        } else {
            $('.headerwrapper, .mainwrapper').removeClass('collapsed');
        }
    }

    jQuery( '#ajaxLoader').hide( 1000);

    function checkMember( string, url, target) {

    }

    jQuery( '#TransactionMemberId' ).keydown( function( event ){

        if ( event.which == 13 ){
            var string = jQuery( this ).val();
            var url    = jQuery( this ).attr( 'ajaxUrl' ) + '/' + string;
            var loader = jQuery( '#ajaxLoader' );
            var target = jQuery( '#memberOutput' );
            jQuery.ajax({

                type: 'GET',
                url: url,
                dataType: 'html',
                beforeSend: function() {
                    jQuery( loader ).fadeIn();
                },
                success: function( res ) {
                    jQuery( target ).html( res );
                    jQuery( loader ).fadeOut();
                }
            });

            $(this).val(string.replace(/^(.)|\s(.)/g, function($1){ return $1.toUpperCase( ); }));
            return false;
        }
    });

    jQuery( '#BorrowLimit' ).change( function(){

        var string = jQuery( this ).val();
        var TransactionId = jQuery( '#TransactionId' ).val();

        var url    = jQuery( this ).attr( 'ajaxUrl' ) + '/' +  TransactionId + '/' + string;
        var target = jQuery( '#borrowOutput' );

        jQuery.ajax({

            type: 'GET',
            url: url,
            dataType: 'html',
            success: function( res ) {
                jQuery( target ).html( res );
            }
        });
        //alert( string );
        return false;
    });

    jQuery( '#BookId2' ).keydown( function( event ) { 

        if ( event.which == 13 ) {
            alert("a");
            return false;
        }        
    });
    /*
    jQuery( '#BookId1' ).keydown( function( event ) ) {

        if ( event.which == 13 ) {

            var string = jQuery( this ).val();
            var url    = jQuery( '#urlBookController' ).val() + '/' + string;
            var loader = jQuery( '#ajaxLoader' );
            var target = jQuery( '#outputMember' );
            jQuery.ajax({

                type: 'GET',
                url: url,
                dataType: 'html',
                beforeSend: function() {
                    jQuery( loader ).fadeIn();
                },
                success: function( res ) {
                    jQuery( target ).html( res );
                    jQuery( loader ).fadeOut();
                }
            });

            $(this).val(string.replace(/^(.)|\s(.)/g, function($1){ return $1.toUpperCase( ); }));
            return false;

        }
    }
    */

    var condition0 = 0;
    var condition1 = 0;
    var condition2 = 0;

    jQuery( '.radio-condition' ).click( function(){

        var radio  = jQuery( this );
        var penalty  = radio.offsetParent().parent().parent().find( 'input.penalty_value' ).val();
        var value  = parseInt( radio.attr( 'fuck' ) ) + parseInt( penalty );
        var condition = radio.attr( 'condition' );
        var currency = parseFloat(value, 10).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.").toString();
        var output   = currency.substring( 0, currency.length - 3 );
        //alert( value );
        radio.offsetParent().parent().parent().find( 'span.penalty' ).text( 'Rp. ' + output );
        radio.offsetParent().parent().parent().find( 'input.penalty_data' ).val( value );

        switch ( condition ) {
            case '0':
                condition0 = value;
            break;
            case '1':
                condition1 = value;
            break;
            case '2':
                condition2 = value;
            break;
        }

        // MENGHITUNG SUB TOTAL //

        var subTotal         = parseInt( jQuery( '#subTotal' ).text().split('.').join("") );
        var subTotalValue    = parseInt( parseInt(condition0) + parseInt( condition1 ) + parseInt( condition2 ) );
        var subTotalCurrency = parseFloat(subTotalValue, 10).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.").toString();
        var subTotalOutput   = subTotalCurrency.substring( 0, subTotalCurrency.length - 3 );

        jQuery( '#subTotal' ).text( subTotalOutput );
        // ------- END ------- //

        // MENGHITUNG TOTAL //

        var penalty = parseInt( jQuery( '#penalty' ).text().split('.').join("") )
        var total = jQuery( '#total' );
        var totalValue = subTotalValue + penalty;
        var totalCurrency = parseFloat(totalValue, 10).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.").toString();
        var totalOutput = totalCurrency.substring( 0, totalCurrency.length - 3 );
        total.text( totalOutput );
        // ----- END ----- //
    });
    //var total = jQuery( '#total' ).text().replace( 'Rp. ', '' );
    //alert( total );
    jQuery( '.tr-cancel' ).click( function(){
        //alert('sad');
        var cancel  = jQuery( this );
        cancel.parent().parent().remove();
        return false;
    });

    var count = 0;
    jQuery( '#add-more-precondition' ).click(function(){

        var id = jQuery( '#ID' ).val();
        $( '#insert-preconditions').append('<input name="data[SubjectsPrecondition][' + (count) + '][precondition_id]" class="form-control mb15" required="required" id="subjectsPrecondition' + count + 'PreconditionId"><input name="data[SubjectsPrecondition][' + (count) + '][subject_id]" class="form-control" required="required" id="SubjectsPrecondition' + count + 'SubjectId" value="' + id + '" type="hidden">');
        count++;

        return false;
    });

    jQuery( '.delete-precondition' ).click( function() {

        var button = jQuery( this );
        var url    = button.attr( 'href' );

        jQuery.ajax({

            type: 'get',
            url: url,
            success: function(){
                button.parent().fadeOut(1000);
            }
        });

        //alert( url );
        return false;
    });

    jQuery( '#mahasiswa-list-questionnaires-subjects' ).change( function(){

        var subject_id  = jQuery( this ).val();
        var tutorage_id = jQuery( '#TutorageId' ).val();
        var npm         = jQuery( this ).attr( 'npm' );
        var ajaxUrl     = jQuery( this ).attr( 'ajaxUrl' );
        var url         = ajaxUrl + '/' + tutorage_id + '/' + subject_id;
        //var loader = jQuery( '#ajaxLoader' );
        var target = jQuery( '#TeacherOutput' );
        jQuery.ajax({

            type: 'GET',
            url: url,
            dataType: 'html',
            /*
            beforeSend: function() {
                jQuery( loader ).fadeIn();
            },
            */
            success: function( res ) {
                //jQuery( target ).html( res );
                target.val( res );
                //jQuery( loader ).fadeOut();
            }
        });

        /*
        $(this).val(string.replace(/^(.)|\s(.)/g, function($1){ return $1.toUpperCase( ); }));
        return false;

        alert( jQuery( this ).val() );
        */

        return false;
    });
    
    jQuery( '#addArticleImage' ).click(function(){

        var ajaxUrl     = jQuery( this ).attr( 'ajaxUrl' );
        var count       = parseInt( jQuery( this ).attr( 'count' ) );
        var target      = jQuery( '#outputArticleImage' );
        var url         = ajaxUrl + '/' + count;
        
        jQuery.ajax({
            type: 'GET',
            url: url,
            dataType: 'html',
            success: function( data )
            {
                target.append( data );
            }
        });
        count = count + 1;
        jQuery( this ).attr( 'count', count );
        return false;
    });

    jQuery( '.removeArticleImage' ).click(function(){

        if ( confirm("Are you sure want to delete ?") )
        {
            var target   = jQuery( this ).parents( '.targetRemove' );
            var ajaxUrl  = jQuery( this ).attr( 'ajaxUrl' );
            var id       = parseInt( jQuery( this ).attr( 'id' ) );
            var url      = ajaxUrl + '/' + id;

            jQuery.ajax({
                type: 'GET',
                url: url,
                dataType: 'html',
                success: function( data )
                {
                    target.hide( 1000, function(){
                        target.remove();
                    });
                }
            });
        }
        return false;

    });    
    //function textCurrency()
    // var count = 0;
    jQuery( '#addProductImage' ).click(function(){

        var ajaxUrl     = jQuery( this ).attr( 'ajaxUrl' );
        var count       = parseInt( jQuery( this ).attr( 'count' ) );
        var target      = jQuery( '#outputProductImage' );
        var url         = ajaxUrl + '/' + count;
        
        jQuery.ajax({
            type: 'GET',
            url: url,
            dataType: 'html',
            success: function( data )
            {
                target.append( data );
            }
        });
        count = count + 1;
        jQuery( this ).attr( 'count', count );
        return false;
    });

    jQuery( '#addGalleryImage' ).click(function(){

        var ajaxUrl     = jQuery( this ).attr( 'ajaxUrl' );
        var count       = parseInt( jQuery( this ).attr( 'count' ) );
        var target      = jQuery( '#outputGalleryImage' );
        var url         = ajaxUrl + '/' + count;
        
        jQuery.ajax({
            type: 'GET',
            url: url,
            dataType: 'html',
            success: function( data )
            {
                target.append( data );
            }
        });
        count = count + 1;
        jQuery( this ).attr( 'count', count );
        return false;
    });

    // var count = 0;
    jQuery( '#addProductPrice' ).click(function(){

        var ajaxUrl     = jQuery( this ).attr( 'ajaxUrl' );
        var count       = parseInt( jQuery( this ).attr( 'count' ) );
        var target      = jQuery( '#outputProductPrice' );
        var url         = ajaxUrl + '/' + count;

        jQuery.ajax({
            type: 'GET',
            url: url,
            dataType: 'html',
            success: function( data )
            {
                target.append( data );
            }
        });
        count = count + 1;
        jQuery( this ).attr( 'count', count );
        return false;
    });

    // var count = 0;
    jQuery( '.removeProductImage' ).click(function(){

        if ( confirm("Are you sure want to delete ?") )
        {
            var target   = jQuery( this ).parents( '.targetRemove' );
            var ajaxUrl  = jQuery( this ).attr( 'ajaxUrl' );
            var id       = parseInt( jQuery( this ).attr( 'id' ) );
            var url      = ajaxUrl + '/' + id;

            jQuery.ajax({
                type: 'GET',
                url: url,
                dataType: 'html',
                success: function( data )
                {
                    target.hide( 1000, function(){
                        target.remove();
                    });
                }
            });
        }
        return false;

    });

    jQuery( '.removeProductPrice' ).click(function(){

        if ( confirm("Are you sure want to delete ?") )
        {
            var target   = jQuery( this ).parents( '.targetRemove' );
            var ajaxUrl  = jQuery( this ).attr( 'ajaxUrl' );
            var id       = parseInt( jQuery( this ).attr( 'id' ) );
            var url      = ajaxUrl + '/' + id;

            jQuery.ajax({
                type: 'GET',
                url: url,
                dataType: 'html',
                success: function( data )
                {
                    target.hide( 1000, function(){
                        target.remove();
                    });
                }
            });
        }
        return false;

    });

    //jQuery('.wysiwyg').wysihtml5({color: true,html:true});
    
    jQuery('.ckeditor').ckeditor({
        language: 'en'
    });    
    $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
        // Avoid following the href location when clicking
        event.preventDefault(); 
        // Avoid having the menu to close when clicking
        event.stopPropagation(); 
        // If a menu is already open we close it
        $('ul.dropdown-menu [data-toggle=dropdown]').parent().removeClass('open');
        // opening the one you clicked on
        $(this).parent().addClass('open');

        var menu = $(this).parent().find("ul");
        var menupos = $(menu).offset();

        if (menupos.left + menu.width() > $(window).width()) {
            var newpos = -$(menu).width();
            menu.css({ left: newpos });    
        } else {
            var newpos = $(this).parent().width();
            menu.css({ left: newpos });
        }

    });
    
    $( "input[type=number]" ).keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
        
    });

});