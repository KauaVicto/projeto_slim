<?php

namespace App\Classes;

use App\Connect\Connection;

class Contas extends Connection
{

    private $valor;

    public function __construct()
    {
        parent::__construct();
    }

    public function getContas($where = '')
    {
        if (!empty($where)) {
            $whereTxt = "WHERE {$where}";
        } else {
            $whereTxt = '';
        }


        $sql = "SELECT * FROM public.contas_criadas {$whereTxt} ORDER BY id ASC";
        $result = $this->con->query($sql);
        $arrayResult = $result->fetchAll(\PDO::FETCH_ASSOC);

        return $arrayResult;
    }

    public function inserirConta($dados)
    {

        // as colunas nos bancos dados
        $campos = array_keys($dados);
        $camposTxt = implode(', ', $campos);

        // colunas no banco de dados com : para realizar o prepare
        $camposBind = array_map(function ($e) {
            return ':' . $e;
        }, $campos);
        $camposBindTxt = implode(', ', $camposBind);

        // consulta
        $sql = "INSERT INTO public.contas_criadas ({$camposTxt}) VALUES ({$camposBindTxt}) RETURNING id;";

        // preparando os dados
        $stmt = $this->con->prepare($sql);
        foreach ($dados as $key => $dado) {
            $stmt->bindValue(':' . $key, $dado);
        }

        // executando e retornando
        $stmt->execute();
        $result = $stmt->fetch();

        return $result['id'];
    }

    public function atualizarConta($dados, $condicao)
    {
        // as colunas nos bancos dados
        $campos = array_keys($dados);

        // colunas no banco de dados com : para realizar o prepare
        $camposBind = array_map(function ($e) {
            return $e . '= :' . $e;
        }, $campos);
        $camposBindTxt = implode(', ', $camposBind);

        // consulta
        $sql = "UPDATE public.contas_criadas SET {$camposBindTxt} WHERE {$condicao} RETURNING ID";

        // preparando os dados
        $stmt = $this->con->prepare($sql);
        foreach ($dados as $key => $dado) {
            $stmt->bindValue(':' . $key, $dado);
        }

        // executando e retornando
        $stmt->execute();
        $result = $stmt->fetch();


        return $result['id'];
    }
}
