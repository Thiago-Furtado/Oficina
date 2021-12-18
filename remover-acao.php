<?php
	session_start();

	if(!isset($_SESSION['chave'])){
		header("location: login.php");
		exit;
	}

    // Resgata a chave do usuário
    $chave = (string)$_SESSION['chave'];

    require_once 'usuarios.php';
    $u = new Usuario;			
    $u->conectar('oficina', 'localhost', 'root', '');

    if (isset($_GET['chave'])) {
        $chave_acao = addslashes($_GET['chave']);
        $u->deletarAcao($chave_acao);
        header('location: carteira2.php');
    }
?>