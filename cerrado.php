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
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
			<h2 id="cabecalho_cerrado">
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
			<a href="cerrado.php" id="nome_opcao_cerrado"><span> Diagrama do Cerrado </span></a>
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
				<div class="col-md-10 col-lg-10 col-xs-10 col-sm-10" id="perguntas_cerrado">
					<a href="#" onclick="abrir_fechar_info()"><i class="fa fa-info-circle" id="botao_info" style="font-size:24px"></i></a>
					<section class="dicas_sites" id="box_info"> 
						<span>Para consultar sobre a empresa, sugerimos os seguintes sites:</span>
						<ol id="lista_info">
							<li><a href="https://fundamentus.com.br/" target="_blank" class="nomes_infos">Fundamentus</a></li>
							<li><a href="https://bancodata.com.br/" target="_blank" class="nomes_infos">Banco Data</a></li>
							<li><a href="https://fundamentei.com/" target="_blank" class="nomes_infos">Fundamentei</a></li>
						</ol>		
					</section>
					<div id="progress-bar"></div>
					<form>
						<div id="questao-1" class="questoes_cerrado">
							<h3 class="nomes_perguntas">1) Possui dívida líquida negativa?</h3>
							<input class="opcoes" id="questao-1-resposta-A" type="radio" name="favelang" value="0">Sim<br>
							<input class="opcoes" id="questao-1-resposta-B" type="radio" name="favelang" value="1">Não<br>
							<div id="submit-1" class="button">Enviar</div>
						<div class="clearfix"></div>
						</div>

						<div id="questao-2" class="questoes_cerrado">
							<h3 class="nomes_perguntas">2) Possui ROE historicamente maior que 5%?</h3>
							<input class="opcoes" id="questao-2-resposta-A" type="radio" name="favelang" value="0">Sim<br>
							<input class="opcoes" id="questao-2-resposta-B" type="radio" name="favelang" value="1">Não<br>
							<div id="submit-2" class="button">Enviar</div>
						<div class="clearfix"></div>
						</div>

						<div id="questao-3" class="questoes_cerrado">
							<h3 class="nomes_perguntas">3) Dívida líquida é menor que o lucro nos últimos 12 meses?</h3>
							<input class="opcoes" id="questao-3-resposta-A" type="radio" name="favelang" value="0">Sim<br>
							<input class="opcoes" id="questao-3-resposta-B" type="radio" name="favelang" value="1">Não<br>
							<div id="submit-3" class="button">Enviar</div>
						<div class="clearfix"></div>
						</div>

						<div id="questao-4" class="questoes_cerrado">
							<h3 class="nomes_perguntas">4) Tem crescimento de receitas superior a 5% nos últimos 5 anos?</h3>
							<input class="opcoes" id="questao-4-resposta-A" type="radio" name="favelang" value="0">Sim<br>
							<input class="opcoes" id="questao-4-resposta-B" type="radio" name="favelang" value="1">Não<br>
							<div id="submit-4" class="button">Enviar</div>
						<div class="clearfix"></div>
						</div>

						<div id="questao-5" class="questoes_cerrado">
							<h3 class="nomes_perguntas">5) Tem histórico de pagamento de dividendos?</h3>
							<input class="opcoes" id="questao-5-resposta-A" type="radio" name="favelang" value="0">Sim<br>
							<input class="opcoes" id="questao-5-resposta-B" type="radio" name="favelang" value="1">Não<br>
							<div id="submit-5" class="button">Enviar</div>
						<div class="clearfix"></div>
						</div>

						<div id="questao-6" class="questoes_cerrado">
							<h3 class="nomes_perguntas">6) Investe amplamente em pesquisa e inovação?</h3>
							<input class="opcoes" id="questao-6-resposta-A" type="radio" name="favelang" value="0">Sim<br>
							<input class="opcoes" id="questao-6-resposta-B" type="radio" name="favelang" value="1">Não<br>
							<div id="submit-6" class="button">Enviar</div>
						<div class="clearfix"></div>
						</div>

						<div id="questao-7" class="questoes_cerrado">
							<h3 class="nomes_perguntas">7) Está negociada a P/VP abaixo de 5%?</h3>
							<input class="opcoes" id="questao-7-resposta-A" type="radio" name="favelang" value="0">Sim<br>
							<input class="opcoes" id="questao-7-resposta-B" type="radio" name="favelang" value="1">Não<br>
							<div id="submit-7" class="button">Enviar</div>

						<div class="clearfix"></div>
						</div>

						<div id="questao-8" class="questoes_cerrado">
							<h3 class="nomes_perguntas">8) Teve lucro operacional no último exercício?</h3>
							<input class="opcoes" id="questao-8-resposta-A" type="radio" name="favelang" value="0">Sim<br>
							<input class="opcoes" id="questao-8-resposta-B" type="radio" name="favelang" value="1">Não<br>
							<div id="submit-8" class="button">Enviar</div>
						<div class="clearfix"></div>
						</div>

						<div id="questao-9" class="questoes_cerrado">
							<h3 class="nomes_perguntas">9) Tem mais de 30 anos de fundação?</h3>
							<input class="opcoes" id="questao-9-resposta-A" type="radio" name="favelang" value="0">Sim<br>
							<input class="opcoes" id="questao-9-resposta-B" type="radio" name="favelang" value="1">Não<br>
							<div id="submit-9" class="button">Enviar</div>
						<div class="clearfix"></div>
						</div>

						<div id="questao-10" class="questoes_cerrado">
							<h3 class="nomes_perguntas">10) É líder nacional ou mundial no seu setor?</h3>
							<input class="opcoes" id="questao-10-resposta-A" type="radio" name="favelang" value="0">Sim<br>
							<input class="opcoes" id="questao-10-resposta-B" type="radio" name="favelang" value="1">Não<br>
							<div id="submit-10" class="button">Enviar</div>
						<div class="clearfix"></div>
						</div>

						<div id="questao-11" class="questoes_cerrado">
							<h3 class="nomes_perguntas">11) O setor em que atua tem mais de 100 anos?</h3>
							<input class="opcoes" id="questao-11-resposta-A" type="radio" name="favelang" value="0">Sim<br>
							<input class="opcoes" id="questao-11-resposta-B" type="radio" name="favelang" value="1">Não<br>
							<div id="submit-11" class="button">Enviar</div>
						<div class="clearfix"></div>
						</div>

						<div id="questao-12" class="questoes_cerrado">
							<h3 class="nomes_perguntas">12) A empresa é Blue Chip?</h3>
							<input class="opcoes" id="questao-12-resposta-A" type="radio" name="favelang" value="0">Sim<br>
							<input class="opcoes" id="questao-12-resposta-B" type="radio" name="favelang" value="1">Não<br>
							<div id="submit-12" class="button">Enviar</div>
						<div class="clearfix"></div>
						</div>

						<div id="questao-13" class="questoes_cerrado">
							<h3 class="nomes_perguntas">13) Tem boa gestão?</h3>
							<input class="opcoes" id="questao-13-resposta-A" type="radio" name="favelang" value="0">Sim<br>
							<input class="opcoes" id="questao-13-resposta-B" type="radio" name="favelang" value="1">Não<br>
							<div id="submit-13" class="button">Enviar</div>
						<div class="clearfix"></div>
						</div>

						<div id="questao-14" class="questoes_cerrado">
							<h3 class="nomes_perguntas">14) É livre de controle estatal?</h3>
							<input class="opcoes" id="questao-14-resposta-A" type="radio" name="favelang" value="0">Sim<br>
							<input class="opcoes" id="questao-14-resposta-B" type="radio" name="favelang" value="1">Não<br>
							<div id="submit-14" class="button">Enviar</div>
						<div class="clearfix"></div>
						</div>

						<div id="questao-15" class="questoes_cerrado">
							<h3 class="nomes_perguntas">15) P/L está abaixo de 30%?</h3>
							<input class="opcoes" id="questao-15-resposta-A" type="radio" name="favelang" value="0">Sim<br>
							<input class="opcoes" id="questao-15-resposta-B" type="radio" name="favelang" value="1">Não<br>
							<div id="submit-15" class="button">Enviar</div>
						<div class="clearfix"></div>
						</div>

						<div id="questao-16" class="questoes_cerrado">
							<h2 id="pontuacao">Sua pontuação foi: <span id="printTotalScore"></span></h2>
							<p id="printScoreInfo"></p>
							<input type="button" id="botao_voltar" name="voltar" value="Voltar" onclick="location.href='cerrado.php'">
						</div>

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
