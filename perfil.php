<?php
	session_start();

    // Verifica login
	if(!isset($_SESSION['chave'])){
		header("location: login.php");
		exit;
	}

    // Resgata a chave do usuário
    $chave = (string)$_SESSION['chave'];

    // Inclui e inicializa a classe usuários
    // Necessário para atualizar o usuário e resgatar os dados
    require_once 'usuarios.php';
    $u = new Usuario;			
    $u->conectar('oficina', 'localhost', 'root', '');

    // Verifica se está enviando formulário
    // Deve ser feito no topo da página, para assim a página se recarregar com os dados já atualizados
    if (isset($_POST['email'])) {
        $nome = addslashes($_POST['nome']);
        $sobrenome = addslashes($_POST['sobrenome']);
        $senha = addslashes($_POST['senha']);
        $email = addslashes($_POST['email']);

        // Reliza alteração no banco
        $u->alterarDados($nome, $sobrenome, $email, $senha, $chave);
    }

    // Resgata dados do usuário diretamente do banco
    $dados = $u->buscarDados($chave);
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
			<h2 id="cabecalho_perfil">
			<?php
				require_once 'usuarios.php';
				$u= new Usuario;			
				$u->conectar("oficina", "localhost", "root", "");			
				$chave = $_SESSION['chave'];
				$nome1=$u->buscarDados("$chave");
				echo 'Olá ';
				echo($nome1["nome"]);
				echo' !';
		   	
		  	?>
			</h2>
			<h2 id="nome_perfil"> Perfil </h2>
			<a href="#"><i class="fa fa-user-circle-o perfil" onclick="abrirMenu_perfil()"></i></a>
		</div>
	</header>
	<nav id='nav-menu'>
		<a href="#" onclick="fecharMenu_perfil()"><span class="material-icons">clear</span> Fechar Menu</a>
		<a href="menu.php"><span class="material-icons">home</span> Menu Principal</a>
		<a href="perfil.php"><span class="material-icons">manage_accounts</span> Alterar Perfil</a>		
		<a href="sair.php"><span class="material-icons">logout</span> Sair</a>
	</nav>
	<main id=content>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-10 col-lg-10 col-xs-10 col-sm-10" id="perfil">
					<div id="sua_conta">
						<i class="fa fa-user-o pull-left" style="font-size:24px"></i><h3> Sua Conta</h3>
						<p id="sub_informacoes">Altere sua informações pessoais.</p>
					</div>

					<form method="post">
						<div id="email">
							<p> Email </p>
							<input type="text" name="email" value="<?php echo($nome1['email']) ?>" id="email_place">
						</div>

						<div id="nome_sobrenome">
							<span class="nome_sobrenome_span"> Nome </span> <span class="nome_sobrenome_span"> Sobrenome </span>
							<input type="text" name="nome" value="<?php echo($nome1['nome']) ?>" class="botao_nome_sobrenome"> 

							<input type="text" name="sobrenome" value="<?php echo($nome1['sobrenome']) ?>" class="botao_nome_sobrenome"> 
						</div>

						<div class="senha">
							<p>Senha</p>
							<input type="password" name="senha" maxlength="30" value="<?php echo($nome1['senha']) ?>"
							class="botao_senha"><i class="material-icons visibility" id="senha_visao">visibility_off</i>

							<p class="dica_senha">Dica de segurança! Evite senhas curtas ou muito simples.</p><hr>
						</div>

						<input type="submit" value="Alterar os dados" id="botao_alterar">
					</form>		
				</div>
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