<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;
use App\Classes\Contas;

return function (App $app) {

    $app->get('/contas', function (ServerRequestInterface $request, ResponseInterface $response) {

        $objContas = new Contas();

        $params = $request->getQueryParams();


        $where = [];
        foreach ($params as $key => $p) {
            if (is_string($p)) {
                $where[] = "$key = '$p'";
            } else {
                $where[] = "$key = $p";
            }
        }

        $contas = $objContas->getContas(implode(' AND ', $where));

        $response->getBody()->write(json_encode($contas ?? []));

        return $response->withStatus(200)->withHeader('content-type', 'application/json');
    });

    $app->post('/cadastrar', function (ServerRequestInterface $request, ResponseInterface $response) {

        $objContas = new Contas();

        $dados = $request->getParsedBody();

        $contas = $objContas->inserirConta($dados);

        $response->getBody()->write(json_encode($contas ?? []));

        return $response->withStatus(200)->withHeader('content-type', 'application/json');
    });

    $app->put('/alterar/{id}', function (ServerRequestInterface $request, ResponseInterface $response, $args) {

        $objContas = new Contas();

        $dados = $request->getParsedBody();

        $contas = $objContas->atualizarConta($dados, "id = {$args['id']}");

        $response->getBody()->write(json_encode($contas ?? []));

        return $response->withStatus(200)->withHeader('content-type', 'application/json');
    });

    
};
