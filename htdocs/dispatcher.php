<?php

require_once 'inc/bootstrap.php';
require_once "Monkey/monkey.php";

use Monkey\FrontController as FrontController;
use Monkey\Server          as Server;
use Monkey\Stage           as Stage;

$server = new Server($_SERVER);

if ($server->getName() === "localhost") {
    $stage = new Stage(Stage::DEVELOPMENT);
} else {
    $stage = new Stage(Stage::PRODUCTION);
}

FrontController::createDefault(WS_ROOT_DIRECTORY, "conf/app.json", $stage)->run();