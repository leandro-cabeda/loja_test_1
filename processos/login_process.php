<?php

/**
 * Recupera os arquivos para poder
 * realizar o processo e embaixo realizar
 * as chamadas pela  acao vinda da requisição devido ao usuário
 */
require_once('../database/DB.php');
require_once('../function/function.php');

$conect = new Conecta();
$db = $conect->getDb();


if (isset($_REQUEST["acao"])) {
    $acao = $_REQUEST["acao"];
}

switch ($acao) {
    case "login":
        echo loginUsuario($_REQUEST, $db);
        break;
    case "register":
        echo registerUsuario($_REQUEST, $db);
        break;
}
