<?php
include "./views/partials/Header.php";
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
        if (isset($_SESSION["id"])) {
        ?>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="views/admin/funcionario/ListaFuncionario.php"><i class="fas fa-list"></i>&nbsp;Lista de Funcionários</a></li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="processos/logout.php"><i class="fa
                        fa-sign-out"></i> Sair</a>
                </li>
            </ul>
        <?php } else { ?>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="views/Login.php"><i class="fa fa-sign-in"></i> Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="views/Register.php"><i class="fa fa-id-card"></i> Register</a>
                </li>
            </ul>
        <?php } ?>
    </div>
</nav>

<div class="container mt-3 mb-5">
    <div class="row justify-content-center">
        <div class="col-7">
            <div class="jumbotron">
                <h1 class="display-4">Bem-Vindo ao Site</h1>
                <?php
                if (isset($_SESSION['id'])) {
                ?>
                    <p>Email usuário logado:
                        <?php echo $_SESSION['email'] ?>
                    </p>
                <?php
                }
                ?>
                <p class="lead">Este é um site de gerenciamento de funcionários </p>
                <hr class="my-4">
                <p>É um site para registrar usuário para acessar o sistema e poder cadastrar funcionários.
                </p>
            </div>
        </div>
    </div>
</div>
<?php
include "./views/partials/Footer.php";
?>