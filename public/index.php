<?php
require_once '../config/config.php';
require_once '../core/Router.php';
require_once '../core/Database.php';

$configs = require '../config/config.php';

// Populate the database with some data
// require_once '../core/db-populate.php';
//require_once '../core/create_tables.php';

session_start(); // Start the session
$router = new Router();
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$router->route($url);
?>
