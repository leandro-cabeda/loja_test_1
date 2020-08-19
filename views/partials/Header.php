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
    <link href="../../dist/css/style.css" rel="stylesheet" media="screen">
</head>

<body>