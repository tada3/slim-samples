<?php

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;



$app->post("/helloPost",
    function(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        print("Hello World with POST Method!");
        return $response;
    });

$app->post("/showParams",
function(ServerRequestInterface $request, ResponseInterface $response, array $arts): ResponseInterface {
    $postParams = $request->getParsedBody();
    $name = $postParams["name"];
    $age = $postParams["age"];
    print("Submitted paramters: name: $name, age: $age");

    $queryParams = $request->getQueryParams();
    $xxx = var_export(is_null($queryParams), true);
    print("\n is_null: $xxx");
    $count = count($queryParams);
    print("\n count: $count");


    $xxx = var_export(is_null($_GET), true);
    print("\n is_null: $xxx");
    $count = count($_GET);
    print("\n count: $count");

    //$hoge = $queryParams["hoge"];
    //print("\n hoge: $hoge");
    
    return $response;
});

$app->get("/writeBody",
    function(ServerRequestInterface $request, ResponseInterface $response, array $arts): ResponseInterface {
        $content = "Put a string in the body.";
        $responseBody = $response->getBody();
        $responseBody->write($content);
        return $response;
});

$app->any("/helloAny",
function(ServerRequestInterface $request, ResponseInterface $response, array $arts): ResponseInterface {
    $method = $request->getMethod();
    $content = "Anyway $method " . " method de Hello World!";
    $responseBody = $response->getBody();
    $responseBody->write($content);
    return $response;
});


$app->map(["POST", "GET"], "/helloMap",
    function(ServerRequestInterface $request, ResponseInterface $response, array $arts): ResponseInterface {
        $content = "POST or GET de Hello World!";
        $responseBody = $response->getBody();
        $responseBody->write($content);
        return $response;
    });


$app->get("/showDetail/{id}",
    function(ServerRequestInterface $req, ResponseInterface $res, array $args) : ResponseInterface{ 
        $id = $args['id'];
        $content = "ID is " .  $id;
        $resBody = $res->getBody();
        $resBody->write($content);
        return $res;
    });


$app->get("/showList/{categoryId}[/{tagId}[/{listSize}]]",
    function(ServerRequestInterface $req, ResponseInterface $res, array $args) : ResponseInterface{ 
        $categoryId = $args['categoryId'];
        $tagId = isset($args['tagId']) ? $args['tagId'] : 'NO_TAG';
        $listSize = $args['listSize'] ?? "NO_SIZE";
        $hoge = isset($args['hoge']) ? $args['hoge'] : "NO_HOGE";
        $content = "cat: $categoryId, tag: $tagId, size: $listSize, hoge: $hoge";
        //$content = "cat: $categoryId, tag: $tagId";
        $resBody = $res->getBody();
        $resBody->write($content);
        return $res;
    });

$app->redirect("/google", "https://www.google.com/");

$app->redirect("/hey", "/slimroute3/public/helloAny", 301);

$app->get("/redirectOrNot/{flg}",
    function(ServerRequestInterface $req, ResponseInterface $res, array $args) : ResponseInterface{ 
        $flg = $args['flg'];
        if ($flg == 0) {
            $res = $res->withHeader('LOCATION', 'https://www.google.com/');
            $res = $res->withStatus(302);
        } else {
            $content = "No redirect!";  
            $resBody = $res->getBody();
            $resBody->write($content);
        }
        return $res;
    });