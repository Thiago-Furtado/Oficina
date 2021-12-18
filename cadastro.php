<?php
	require_once 'usuarios.php';
	$u= new Usuario;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">	
	<title>Projeto Oficina</title>
</head>

<body>
	<div class="box-cadastro">
		<section>
			<h1>Cadastro de Usuários</h1>	
			<hr><br><br>

			<form method="post">
				<p class="cadastro-nomes">Nome</p> 
				<input type="text" name="nome" class="campo" maxlength="15" required autofocus><br><br>
				<p class="cadastro-nomes">Sobrenome</p> 
				<input type="text" name="sobrenome" class="campo" maxlength="20" required><br><br>
				<p class="cadastro-nomes">Senha</p>
				<div class="input-container">
					<input type="password" name="senha" maxlength="30" required>
					<i class="material-icons visibility">visibility_off</i>
				</div>				
				<p class="cadastro-nomes">Email</p>
				<input type="email" name="email" class="campo" maxlength="50" required><br><br>
				<p class="cadastro-nomes">Idade</p>
				<input type="date" name="idade" class="campo" required><br><br>

				<input type="submit"name="Salvar">
				<input type="reset" onclick="location.href='cadastro.php'" name="Limpar">
				<input type="button" onclick="location.href='index.php'" value="Voltar">
			</form>
		</section>	
	</div>
<?php
	if(isset($_POST['nome']))
	{
		$nome = addslashes($_POST['nome']);
		$sobrenome = addslashes($_POST['sobrenome']);
		$senha = addslashes($_POST['senha']);
		$email = addslashes($_POST['email']);
		$idade = addslashes($_POST['idade']);

		if(!empty($nome) && !empty($sobrenome) && !empty($senha) && !empty($email) && !empty($idade)){
			$u->conectar("oficina", "localhost", "root", "");
			if($u->msgErro == ""){ /*Esta tudo certo*/
				if($u->cadastrar($nome, $sobrenome, $senha, $email, $idade))
				{
					?>
						<div class=msg-sucesso>
							Cadastrado com sucesso! Volte para realizar o Login!
							<?php 
							usleep(1000000);?>
						</div>
					<?php
					header("location: login.php");
				}
				else{
					?>
					<div class=msg-erro>
						Email já cadastrado!
					</div>
					<?php
				}
			}
			else{
				?>
				<div class=msg-erro>
					<?php echo "Erro: ".$u->msgErro; ?>
				</div>
				
				<?php
			}
		}
		else{
			?>
			<div class=msg-erro>
				Preencha todos os campos!
			</div>
			<?php
		}
	}


?>

	<!-- jQuery (Bootstrap JS plugins depend on it) -->
  	<script src="js/jquery-2.1.4.min.js"></script>
  	<script src="js/bootstrap.min.js"></script>
  	<script src="js/ajax-utils.js"></script>
  	<script src="js/script.js"></script>
</body>
</html>