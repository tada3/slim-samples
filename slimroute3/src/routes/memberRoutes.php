<?php

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Routing\RouteCollectorProxy;


$app->group("/members", 
    function(RouteCollectorProxy $group) {
        $group->any("/showList", 
            function(ServerRequestInterface $request, ResponseInterface $response, array $args) {
                $content = "SHOW LIST!!!";
                $responseBody = $response->getBody();
                $responseBody->write($content);
                return $response;
            })->setName("showListXXX");
        $group->any("/entry", 
            function(ServerRequestInterface $request, ResponseInterface $response, array $args) {
                $content = "ENTRY!!!";
                $responseBody = $response->getBody();
                $responseBody->write($content);
                return $response;
            });
    });