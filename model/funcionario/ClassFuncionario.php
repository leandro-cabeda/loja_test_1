<?php

/**
 * Recupera o arquivo do banco
 * para realizar as inserções, atualizações e deletações.
 * 
 * Embaixo definido também a classe do funcionário e suas 
 * funcionalidades
 */
require_once('../../database/DB.php');

class Funcionario
{
    private $sql;
    private $res;
    private $db;

    public function __construct()
    {
        $this->db = new Conecta();
        $this->db = $this->db->getDb();
    }

    /**
     * Lista todos os funcionários contido no banco
     * de dados e retorna
     */
    public function listaFuncionarios()
    {
        $this->sql = 'select * from funcionarios';
        $this->res = $this->db->query($this->sql);
        $data = array("data" => array());
        while ($row = $this->res->fetch_assoc()) {
            $id = $row['id'];
            $botoes = "<button class='btn btn-primary actionBtn'  data-id='$id' data-action='get'><i class='fas fa-edit'></i></button>&nbsp;";
            $botoes .= "<button class='btn btn-danger actionBtn' data-id='$id' data-action='del'><i class='fas fa-trash-alt'></i></button>";
            $linha = [];
            $linha[] = $id;
            $linha[] = $row['nome'];
            $linha[] = $row['cargo'];
            $linha[] = implode('/', array_reverse(explode('-', $row['data_nasc'])));
            $linha[] = implode('/', array_reverse(explode('-', $row['data_adm'])));
            $linha[] = $botoes;
            $data['data'][] = $linha;
        }

        return json_encode($data);
    }

    /**
     * Adiciona um novo funcionário realizando a verificação pelo
     * nome  se caso já não contém um funcionário cadastrado e retorna
     * se deu ok ou erro.
     */
    public function addFuncionario($data)
    {
        $dataJson = array();

        if (!$this->verificaNomeDuplicado($data['nome'])) {

            $this->sql = 'insert into funcionarios (nome,cargo,data_nasc,data_adm)';
            $this->sql .= " values ('" . $data['nome'] . "','" . $data['cargo'] . "'";
            $this->sql .= ",'" . $data['data_nasc'] . "','" . $data['data_adm'] . "')";
            $this->res = $this->db->query($this->sql);

            if (!$this->res) {
                $dataJson['erro'] = true;
                $dataJson['msg'] = "Erro ao adicionar o funcionário no banco de dados!!";
                return json_encode($dataJson);
            } else {
                $dataJson['erro'] = false;
                $dataJson['msg'] = "Adicionado funcionário com sucesso no banco de dados!!!";
                return json_encode($dataJson);
            }
        } else {
            $dataJson['erro'] = true;
            $dataJson['msg'] = "Erro ! Este funcionário já está cadastrado no banco!";
            return json_encode($dataJson);
        }
    }

    /**
     * Atualiza o funcionário especifico pelo id
     * e verifica se deu ok ou erro.
     */
    public function updateFuncionario($data)
    {
        $dataJson = array();

        $this->sql = "update funcionarios set nome= '" . $data['nome'] . "'";
        $this->sql .= ", cargo='" . $data['cargo'] . "', data_nasc='" . $data['data_nasc'] . "'";
        $this->sql .= ", data_adm='" . $data['data_adm'] . "'";
        $this->sql .= " where id=" . $data['id'];
        $this->res = $this->db->query($this->sql);

        if (!$this->res) {
            $dataJson['erro'] = true;
            $dataJson['msg'] = "Erro ao atualizar o funcionário no banco de dados!!";
            return json_encode($dataJson);
        } else {
            $dataJson['erro'] = false;
            $dataJson['msg'] = "Atualizado funcionário com sucesso no banco de dados!!!";
            return json_encode($dataJson);
        }
    }

    /**
     * Recupera o funcionário especifico pelo id
     * e verifica se deu ok ou erro.
     */
    public function getFuncionario($id)
    {
        $this->sql = "select * from funcionarios where id=" . $id;

        $this->res = $this->db->query($this->sql);
        $dataJson = array();
        if (!$this->res) {
            $dataJson['erro'] = true;
            $dataJson['msg'] = "Erro ! funcionário não encontrado do id:" . $id . " !";
            return json_encode($dataJson);
        } else {
            while ($row = $this->res->fetch_assoc()) {
                $dataJson['id'] = $row['id'];
                $dataJson['nome'] = $row['nome'];
                $dataJson['cargo'] = $row['cargo'];
                $dataJson['data_nasc'] = $row['data_nasc'];
                $dataJson['data_adm'] =  $row['data_adm'];
            }
            return json_encode($dataJson);
        }
    }

    /**
     * Deleta o funcionário especifico pelo id
     * e verifica se deu ok ou erro.
     */
    public function delFuncionario($id)
    {
        $dataJson = array();
        $this->sql = "delete from funcionarios where id=$id";
        $this->res = $this->db->query($this->sql);

        if (!$this->res) {
            $dataJson['erro'] = true;
            $dataJson['msg'] = "Erro ao deletar funcionário do id: " . $id . " !";
            return json_encode($dataJson);
        } else {

            $dataJson['erro'] = false;
            $dataJson['msg'] = "Deletado funcionário com sucesso do id: " . $id . " !";
            return json_encode($dataJson);
        }
    }


    /**
     * Realiza uma verificação pelo nome de funcionário
     * para ver se existe algum registro já com nome especificado.
     */
    private function verificaNomeDuplicado($nome)
    {
        $this->sql = "select * from funcionarios where upper(nome)=upper('$nome')";
        $this->res = $this->db->query($this->sql);

        if ($this->res->num_rows > 0) {
            return true;
        }
        return false;
    }
}
