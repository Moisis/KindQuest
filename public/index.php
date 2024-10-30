<?php
require_once '../config/config.php';
require_once '../core/Router.php';
require_once '../core/Database.php';
require_once '../app/controllers/HomeController.php';

// Populate the database with some data
require_once '../core/db-populate.php';

$configs = require '../config/config.php';

$router = new Router();
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$router->route($url);
?>
