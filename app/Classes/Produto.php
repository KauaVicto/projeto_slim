<?php

namespace App\Classes;

use App\Connect\Connection;

class Produto extends Connection {

    private $valor;

    public function __construct($valor)
    {
        $this->valor = $valor;
    }

    public function getProduto($where, $orderBy)
    {
        $sql = "SELECT * FROM produto.produtos WHERE";
    }

}