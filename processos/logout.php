<?php

/**
 * Usuário realiza o logout e finaliza a sessão dele
 * limpando todos os dados que tinha na sessão e retorna para
 * o index principal
 */
session_start();

unset($_SESSION['id']);
unset($_SESSION['email']);

session_destroy();

header('Location: ../index.php', true, 301);

exit();
