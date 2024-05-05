<?php

use Slim\Factory\AppFactory;

require_once($_SERVER["DOCUMENT_ROOT"]."/slimroute3/vendor/autoload.php");

$app = AppFactory::create();
$app->setBasePath("/slimroute3/public");

require_once($_SERVER["DOCUMENT_ROOT"] . "/slimroute3/src/routes/adminRoutes.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/slimroute3/src/routes/memberRoutes.php");

$app->run();




