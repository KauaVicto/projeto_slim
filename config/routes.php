<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;
use App\Classes\Produto;

return function (App $app) {

    $app->get('/produtos', function (ServerRequestInterface $request, ResponseInterface $response, $args) {

        $p1 = new Produto(102);
        echo '<pre>';
        var_dump($p1);
        exit;

        
        $response->getBody()->write(json_encode($array ?? []));

        return $response->withStatus(200)->withHeader('content-type', 'application/json');
    });
};
