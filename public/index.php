<?php
require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/libs/Database.php';
require_once __DIR__ . '/../app/libs/Controller.php';
require_once __DIR__ . '/../app/libs/Router.php';

$router = new Router();
$router->dispatch();