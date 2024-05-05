<?php

use Slim\Factory\AppFactory;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

require_once($_SERVER["DOCUMENT_ROOT"]."/secondslim/vendor/autoload.php");
//require_once("../vendor/autoload.php");

$app = AppFactory::create();

$app->get("/secondslim/public/hello",
    function(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        print("Hello World!!\n");
        print($_SERVER["DOCUMENT_ROOT"]."/secondslim/vendor/autoload.php");
        return $response;
    }

);

$app->run();

