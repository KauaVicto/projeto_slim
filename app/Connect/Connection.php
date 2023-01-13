<?php

namespace App\Connect;

use PDOException;

class Connection
{

    protected $con;

    public function __construct()
    {
        try {

            $this->con = new \PDO("pgsql:host=localhost;port=5432;dbname=postgres", "postgres", "221122");
        } catch (PDOException $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e;
        }

    }

}
