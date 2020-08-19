<?php
include "./partials/Header.php";
?>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#links" aria-controls="links" aria-expanded="false" aria-label="Alterna navegação">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a href="/" class="navbar-brand mr-auto ml-2">
        <i class="fa fa-home"></i> Home
    </a>
    <div class="collapse navbar-collapse" id="links">
        <?php
        if (isset($_SESSION["id"]) != "") {
        ?>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="admin/funcionario/ListaFuncionario.php"><i class="fas fa-list"></i>&nbsp;Lista de Funcionários</a></li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../processos/logout.php"><i class="fa
                        fa-sign-out"></i> Sair</a>
                </li>
            </ul>
        <?php } else { ?>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="Login.php"><i class="fa fa-sign-in"></i> Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Register.php"><i class="fa fa-id-card"></i> Register</a>
                </li>
            </ul>
        <?php } ?>
    </div>
</nav>
<div class="container mt-3 mb-5">
    <div class="row justify-content-center">
        <div class="col-5">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Cadastro de Usuário</h2>
                </div>
                <div class="card-body">
                    <form autocomplete="off">
                        <div class="form-group">
                            <label for="email">E-mail:*</label>
                            <input type="email" class="form-control" autocomplete="off" name="email" placeholder="email@exemplo.com">
                        </div>
                        <div class="form-group">
                            <label for="password">Password:*</label>
                            <input type="password" autocomplete="off" class="form-control" name="password" placeholder="*******">
                        </div>
                        <button type="submit" class="btn btn-block btn-success forms" data-action="register">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include "./partials/Modal.php";
include "./partials/Footer.php";
?>