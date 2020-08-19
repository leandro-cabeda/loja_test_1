<?php

/**
 * Recupera os arquivos para poder
 * realizar o processo e embaixo realizar
 * as chamadas pela  acao vinda da requisição devido ao crud de funcionário
 */
require_once('../../model/funcionario/ClassFuncionario.php');
require_once('../../function/function.php');

$func = new Funcionario();

$acao = "";
$id = "";

if (isset($_REQUEST['acao'])) {
    $acao = $_REQUEST['acao'];
}

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
}

if ($acao == "add" || $acao == "update") {
    $verify = verifyFields($_REQUEST);

    if ($verify['erro']) {
        echo json_encode($verify);
        exit();
    }
}


switch ($acao) {
    case '':
        echo $func->listaFuncionarios();
        break;
    case 'add':
        echo $func->addFuncionario($_REQUEST);
        break;
    case 'update':
        echo $func->updateFuncionario($_REQUEST);
        break;
    case 'get':
        echo $func->getFuncionario($id);
        break;
    case 'del':
        echo $func->delFuncionario($id);
        break;
}
