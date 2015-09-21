<?php

    /**
     * app/Config/Dictionaries/default.php
     * Created by Falmesino Abdul Hamid(falmesino@gmail.com)
     * Default Language for XCMS(English)
     */

    /* Notifications */
    define( 'MSG_DATA_SAVE_SUCCESS',        'Data has been saved successfuly' );
    define( 'MSG_DATA_SAVE_FAILED',         'Failed to save data' );
    define( 'MSG_DATA_EDIT_SUCCESS',        'Data has been updated successfuly' );
    define( 'MSG_DATA_EDIT_FAILED',         'Failed to update data' );
    define( 'MSG_DATA_UPDATE_SUCCESS',      MSG_DATA_EDIT_SUCCESS ); // Alias
    define( 'MSG_DATA_UPDATE_FAILED',       MSG_DATA_EDIT_FAILED ); // Alias
    define( 'MSG_DATA_DELETE_SUCCESS',      'Data has been deleted successfuly' );
    define( 'MSG_DATA_DELETE_FAILED',       'Failed to delete data' );
    define( 'MSG_DATA_STILL_USED',          'This data is still used' );
    define( 'MSG_DATA_PART_OF_SYSTEM',      'This data is a part of the system' );
    define( 'MSG_DATA_INPUT_UNCOMPLETE',    'Data you\'ve inputted is still uncomplete' );
    define( 'MSG_DATA_INPUT_INVALID',       'Data you\'ve inputted is invalid' );
    define( 'MSG_DATA_NOT_FOUND',           'Data not found' );
    define( 'MSG_MISSING_PARAMETER',        'Missing parameter(s)' );
    define( 'MSG_PASSWORD_MISMATCH',        'Passwords not match' );
    define( 'MSG_PASSWORD_WRONG',           'Password incorrect' );
    define( 'MSG_SLUG_EXISTS',              'Identifier like that is already exists' );
    define( 'MSG_MUST_LOGIN',               'You must login to access this page' );
    /* Confirmations */
    define( 'CONFIRM_DELETE',               'Delete this data?' );
    define( 'CONFIRM_LOGOUT',               'End your session?' );

    /* Buttons */
    define( 'BTN_PREVIOUS',                 'Previous' );
    define( 'BTN_REFRESH',                  'Refresh' );
    define( 'BTN_ADD_NEW',                  'Add New Item' );
    define( 'BTN_SORT_BY',                  'Sort By' );
    define( 'BTN_ADD',                      BTN_ADD_NEW ); // Alias
    define( 'BTN_SAVE',                     'Save' );
    define( 'BTN_EDIT',                     'Update' );
    define( 'BTN_UPDATE',                   BTN_EDIT ); // Alias
    define( 'BTN_DELETE',                   'Delete' );
    define( 'BTN_VIEW',                     'View' );
    define( 'BTN_ENABLE',                   'Enable' );
    define( 'BTN_DISABLE',                  'Disable' );
    define( 'BTN_ACTION',                   'Actions' );
    define( 'BTN_SEARCH',                   'Search' );
    define( 'BTN_LOGOUT',                   'Sign Out' );
    define( 'BTN_LOGIN',                    'Sign In' );
    define( 'BTN_MOVEUP',                   'Move Up' );
    define( 'BTN_MOVEDOWN',                 'Move Down' );
    define( 'BTN_PROFILE',                  'Profile' );
    define( 'BTN_MARK_AS_READ',             'Mark as Read' );
    define( 'BTN_MARK_AS_UNREAD',           'Mark as Unread' );
    define( 'BTN_REPAIR',                   'Repair Structure' );
    define( 'BTN_REMOVE',                   'Remove' );
    define( 'BTN_SIGNIN',                   'Sign In' );
    define( 'BTN_SIGNOUT',                  'Sign Out' );
    define( 'BTN_CANCEL',                   'Cancel' );
    /* Tooltips */
    define( 'TOOLTIP_PREVIOUS',             'Previous page' );
    define( 'TOOLTIP_REFRESH',              'Refresh current page' );
    define( 'TOOLTIP_ADD_NEW',              'Add new item' );
    define( 'TOOLTIP_SORT_BY',              'Sort by, click to reset' );
    define( 'TOOLTIP_ADD',                  TOOLTIP_ADD_NEW ); // Alias
    define( 'TOOLTIP_EDIT',                 'Update this data' );
    define( 'TOOLTIP_UPDATE',               TOOLTIP_EDIT ); // Alias
    define( 'TOOLTIP_DELETE',               'Delete this data' );
    define( 'TOOLTIP_ENABLE',               'Enable this data' );
    define( 'TOOLTIP_DISABLE',              'Disable this data' );
    define( 'TOOLTIP_MARK_AS_READ',         'Mark this data as read' );
    define( 'TOOLTIP_MARK_AS_UNREAD',       'Mark this data as unread' );
    define( 'TOOLTIP_REPAIR',               'Repair structure' );

    /* Text */
    define( 'TEXT_ENABLED',                 'Enabled' );
    define( 'TEXT_DISABLED',                'Disabled' );
    define( 'TEXT_ADD',                     'Add' );
    define( 'TEXT_UPDATE',                  'Update' );
    define( 'TEXT_EDIT',                    'Edit' ); // Alias
    define( 'TEXT_READ',                    'Read' );
    define( 'TEXT_UNREAD',                  'Unread' );
    define( 'TEXT_DONE',                    'Done' );
    define( 'TEXT_NOT_DONE',                'Not Done' );
    define( 'TEXT_APPROVED',                'Approved' );
    define( 'TEXT_NOT_APPROVED',            'Not Approved' );

    define( 'TEXT_WELCOME', 'Welcome to administrator page' );
    define( 'TEXT_ARTICLE', 'Articles');
    define( 'TEXT_PRODUCT', 'Products');
    define( 'TEXT_USER',    'User' );
    define( 'TEXT_PAGE',    'Pages' );
    define( 'TEXT_GALLERY', 'Gallery' );
    define( 'TEXT_OUTLET',  'Outlet' );
    define( 'TEXT_ARTICLE_CATEGORIES', 'Article Categories' );
    define( 'TEXT_GALLERY_CATEGORIES', 'Gallery Categories' );
    define( 'TEXT_GALLERIES',          'Galleries' );
    define( 'TEXT_OUTLET_CATEGORIES',  'Outlet Categories' );
    define( 'TEXT_OUTLETS',            'Outlets' );

    /* Other */
    define( 'CHOOSE_OPTIONS',       'Choose Options' );
    define( 'TEXT_COUNTING',        'Counting...' );
    define( 'MY_ACCOUNT',           'My Account');
    define( 'CREATED_DATE',         'Created' );
    define( 'TRANSACTION',          'Transaction' );
    define( 'PERSONAL',             'Personal' );
    define( 'FULL_NAME',            'Full Name' );
    define( 'LATEST_PROMO',         'Latest Promo' );
    define( 'LATEST_NEWS',          'Latest News' );
    define( 'WELCOME',              'Welcome' );
    define( 'MY_CART',              'My Cart' );
    define( 'SEARCH',               'Search' );
    define( 'HOME',                 'Home' );
    define( 'PROFILE',              'Profile' );
    define( 'PRODUCTS',             'Products' );
    define( 'CONTACT',              'Contact' );
    define( 'ADD_TO_CART',          'Add To Cart' );
    define( 'MENS',                 'Mens' );
    define( 'WOMENS',               'Womens' );
    define( 'DETAIL_PRODUCT',       'Detail Product' );
    define( 'PROMO_SAVE',           'Saving' );
    define( 'ABOUT',                'About Us' );
    define( 'FAQ',                  'FAQ' );
    define( 'TERMS',                'Terms' );
    define( 'CONDITIONS',           'Conditions' );
    define( 'PRIVACY_POLICY',       'Privacy Policy' );
    define( 'CAREER',               'Career' );
    define( 'SITEMAP',              'Sitemap');
    define( 'EVENT',                'Event');
    define( 'PROMO',                'Promo');
    define( 'OUTLETS',              'Outlets');
    define( 'AGO',                  'ago' );
    define( 'HEALTH_INFO',          'Health Info' );
    define( 'QUANTITY',             'Quantity' );
    define( 'PEOPLE_ALSO_BOUGHT',   'People also bought' );
    define( 'PRICE',                'Price' );
    define( 'ITEM',                 'Item' );
    define( 'SAVE',                 'Save' );
    define( 'CANCEL_ORDER',         'Cancel Order' );
    define( 'SEND_TO',              'Send To' );
    define( 'ADD_ADDRESS',          'Add Address' );
    define( 'SAVE_ADDRESS',         'Save Address' );
    define( 'RECIPIENT',            'Recipient' );
    define( 'INVOICE',              'Invoice' );
    define( 'DATE',                 'Date' );
    define( 'SENT_TO',              'Sent To' );
    define( 'USER_ACCOUNT',         'User Account' );
    define( 'BANK_NAME',            'Bank Name' );

    define( 'MSG_EMPTY_CHECKOUT',  'You have not ordered the product, please order the product first' );
?>