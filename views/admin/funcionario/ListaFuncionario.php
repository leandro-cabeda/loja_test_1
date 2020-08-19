<?php
header('Access-Control-Allow-Origin: *');
date_default_timezone_set('America/Sao_Paulo');
putenv("NLS_LANG=American_America.UTF8");

if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>API</title>
    <script src="https://kit.fontawesome.com/02b6181161.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" media="screen">
    <link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap4.css" rel="stylesheet" media="screen">
    <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet" media="screen">
    <link href="../../../dist/css/style.css" rel="stylesheet" media="screen">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#links" aria-controls="links" aria-expanded="false" aria-label="Alterna navegação">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a href="/" class="navbar-brand mr-auto ml-2">
            <i class="fa fa-home"></i> Home
        </a>
        <div class="collapse navbar-collapse" id="links">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="ListaFuncionario.php"><i class="fas fa-list"></i>&nbsp;Lista de Funcionários</a></li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../../../processos/logout.php"><i class="fa
                        fa-sign-out"></i> Sair</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid mt-3 mb-5 container-table">
        <h1 class="text-center color-text mb-2">Lista de Funcionários</h1>
        <div class="row mb-2 m-0">
            <div class="col-3 pl-5">
                <button type="button" class="btn btn-success" id="addFuncionario" name="button">
                    <i class="fas fa-plus-square"> Adicionar</i>
                </button>
            </div>
        </div>
        <div class="row m-0">
            <div class="col-12 pl-5">
                <table id="listaFuncionario" class="table table-bordered table-responsive-md text-center color-text" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nome</th>
                            <th>Cargo</th>
                            <th>Data Nascimento</th>
                            <th>Data Admissão</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_func" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form id="form" autocomplete="off">
                        <input type="hidden" name="id" value="">
                        <div class="form-group offset-3">
                            <label class="control-label label-alinhamento">Nome Completo:*</label>
                            <input name="nome" class="form-control w-66" type="text">
                        </div>
                        <div class="form-group offset-3">
                            <label class="control-label label-alinhamento">Cargo:*</label>
                            <select class="form-control form-control-sm w-66" name="cargo">
                                <option value="" selected>Selecionar Cargo</option>
                                <option value="Desenvolvedor">Desenvolvedor</option>
                                <option value="Gestor">Gestor</option>
                                <option value="Auxiliar">Auxiliar</option>
                            </select>
                        </div>
                        <div class="form-group offset-3">
                            <label class="control-label label-alinhamento">Data Nascimento:*</label>
                            <input name="data_nasc" class="form-control w-66 data" type="date">
                        </div>
                        <div class="form-group offset-3">
                            <label class="control-label label-alinhamento">Data Admissão:*</label>
                            <input name="data_adm" class="form-control w-66 data" type="date">
                        </div>
                        <div class="text-center form-group">
                            <button type="submit" class="btn btn-success w-50">Salvar</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <?php
    include "../../partials/Modal.php";
    ?>
    <nav class="bg-dark navbar navbar-dark mt-3 navbar-expand-md">
        <div class="container">
            <div class="row justify-content-center w-100">
                <div class="col-md-6 col-12">
                    <h2 class="text-center color-text mt-2">Informações do responsável do site</h2>
                    <ul class="list-group mt-3">
                        <li class="list-group-item">© Copyright 2020 Copyright.com.br - All Rights Reserved - Legal</li>
                        <li class="list-group-item"><i class="fa fa-at"></i> E-mail: leandro.cabeda@hotmail.com</li>
                        <li class="list-group-item">Cidade/Estado: Passo Fundo/RS</li>
                        <li class="list-group-item">Fale direto com responsável pelo WhatsApp >>
                            &nbsp;<a href="https://wa.me/5554999337135?text=Olá%20Leandro" target="_blank"><i style="font-size: 30px;" class="fa fa-whatsapp"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 offset-md-2 col-12">
                    <h2 class="text-center color-text mt-2">Siga-me</h2>
                    <div class="list-group text-center mt-3">
                        <a href="https://www.facebook.com/leandro.cabeda" target="_blank" class="list-group-item list-group-item-action">
                            <i class="fa fa-facebook"></i> Facebook
                        </a>
                        <a href="https://www.linkedin.com/in/leandro-cabeda-rigo-b82b2678" target="_blank" class="list-group-item list-group-item-action">
                            <i class="fa fa-linkedin"></i> Linkedin
                        </a>
                        <a href="https://github.com/leandro-cabeda" target="_blank" class="list-group-item list-group-item-action">
                            <i class="fa fa-github"> GitHub</i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

</body>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap4.js"></script>
<script src="../../../dist/js/script.js"></script>

</html>