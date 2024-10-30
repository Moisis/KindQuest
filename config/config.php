<?php

return (object) array(

    // App Data
    'SITE_NAME'     => "7amada's Majestic E-Shop",
    'APP_ROOT'      => dirname(dirname(__FILE__)),
    'URL_ROOT'      => 'http://localhost:3000',
    'URL_SUBFOLDER' => '',

    // DB Data
    'DB_HOST' => 'localhost',
    'DB_USER' => 'root',
    'DB_PASS' => '',
    'DB_NAME' => 'eshop',

    // DB Tables
    'DB_USERS_TABLE'      => 'user',
    'DB_ITEMS_TABLE'      => 'shirt',
    'DB_CARTS_TABLE'      => 'cart',
    'DB_CART_ITEMS_TABLE' => 'cart_item',

    // Routes
    'ROUTES' => [
        // ''               => 'HomeController@index',
         '/'              => 'HomeController@index',
        '/test'          => 'HomeController@test',
        // '/test/{arg}'    => 'TestController@show',
        // '/login'         => 'LoginController@show',
        // '/shop/{userId}' => 'ShopController@show',
        // '/cart/{userId}' => 'ShopController@showCart',
        // '/user/{userId}' => 'UserController@show',
        // Other routes...
    ],

);
