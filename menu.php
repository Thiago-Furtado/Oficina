<?php
	session_start();
	if(!isset($_SESSION['chave'])){
		header("location: login.php");
		exit;
	}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Lora:wght@700&display=swap" rel="stylesheet">
	<title>Projeto Oficina</title>
</head>
<body>
	<header>
		<div class="usuario">
			<h2 id="cabecalho">
			<?php
				require_once 'usuarios.php';
				$u= new Usuario;			
				$u->conectar("oficina", "localhost", "root", "");			
				$chave = $_SESSION['chave'];
				$nome=$u->buscarDados("$chave");
				echo 'Olá ';
				echo($nome["nome"]);
				echo' !';
			   	
			?>
			</h2>
			<a href="#"><i class="fa fa-user-circle-o perfil" onclick="abrirMenu()"></i></a>
		</div>
	</header>
	<nav id='nav-menu'>
		<a href="#" onclick="fecharMenu()"><span class="material-icons">clear</span> Fechar Menu</a>
		<a href="menu.php"><span class="material-icons">home</span> Menu Principal</a>
		<a href="perfil.php"><span class="material-icons">manage_accounts</span> Alterar Perfil</a>		
		<a href="sair.php"><span class="material-icons">logout</span> Sair</a>
	</nav>
	<main id=content>
		<div class="container-fluid">
			<div class="row">
				<a href="carteira2.php">
					<div class="col-md-3 col-lg-3 col-xs-3 box-menu text-left boxes">
						<div><h3>Carteira Digital<h3><br><i class="fa fa-money icons"></i>
							<p class="text-center conteudo">
								Cadastre-os na casteira digital e fique sempre por dentro!
							</p>
						</div>
					</div> 
				</a>
				<a href="cerrado.php">
					<div class="col-md-3 col-lg-3 col-xs-3 box-menu text-left boxes">
						<div><h3>Diagrama do Cerrado</h3><br><i class="fa fa-area-chart icons"></i>
							<p class="text-center conteudo">
								Diagrama do Cerrado é um assistente muito eficiente que calcula a porcentagem que um ativo deve ter em sua carteira.
							</p>
						</div>
					</div>
				</a>
				<a href="#">
					<div class="col-md-3 col-lg-3 col-xs-3 box-menu text-left boxes">
						<div>
							<h3>Escolha de ações</h3><br>
							<i class="fa fa-question icons"></i>
							<p class="text-center conteudo">
								Tem dúvidas sobre qual ação comprar? Tenha sua dúvida sanada no comparador!
							</p>
						</div>
					</div>
				</a>
			</div>
		</div>
	</main>
		<footer>
			<div class="footer_pag_menu"></div>
		</footer>
</body>

  	<script src="js/jquery-2.1.4.min.js"></script>
  	<script src="js/bootstrap.min.js"></script>
  	<script src="js/ajax-utils.js"></script>
  	<script src="js/script.js"></script>

</html>