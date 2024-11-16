<?php

return (object) array(

    // App Data
    'SITE_NAME'     => "Kind Quest",
    'APP_ROOT'      => dirname(dirname(__FILE__)),
    'URL_ROOT'      => 'http://localhost:8000',
    'URL_SUBFOLDER' => '',

    // DB Data
    'DB_HOST' => 'localhost',
    'DB_USER' => 'root',
    'DB_PASS' => '',
    'DB_NAME' => 'kindquest',

    // DB Tables
    // 'DB_USERS_TABLE'      => 'user',
    // 'DB_ITEMS_TABLE'      => 'shirt',
    // 'DB_CARTS_TABLE'      => 'cart',
    // 'DB_CART_ITEMS_TABLE' => 'cart_item',

    // Routes
    'ROUTES' => [
        // ' '               => 'HomeController@index',
         '/'              => 'HomeController@index',
        '/test'          => 'HomeController@test',
        '/about'         => 'AboutController@index',
        '/register'    => 'RegisterController@index',
        '/login'    => 'LoginController@index',
        '/events'    => 'EventController@index',
        '/donatepage' => 'DonationController@index',
        '/donate' => "DonationProcess@donationProcess",
        '/donate/{user_id}' => "DonationController@getUserDonations",
        '/event/create' => "EventCreationController@index",
        '/event/{id}' => 'EventDetailsController@index',
        '/event/join/{event_id}' => "EventDetailsController@join_event",



        '/profile' => 'ProfileController@index',
        '/logout'  => 'ProfileController@logout',

        // '/test/{arg}'    => 'TestController@show',
        // '/login'         => 'LoginController@show',
        // '/shop/{userId}' => 'ShopController@show',
        // '/cart/{userId}' => 'ShopController@showCart',
        // '/user/{userId}' => 'UserController@show',
        // Other routes...
    ],

);
