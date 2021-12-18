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
	<form class="box-login" method="post">
		<h1>Login</h1>
		<input type="text" name="email" placeholder="Email">
		<div class="input-container-login">
			<input type="password" name="senha" placeholder="Senha" maxlength="30" required>
		<i class="material-icons visibility">visibility_off</i>
		</div>
		<input type="submit" placeholder="Enviar">

		<input type="button" onclick="location.href='index.php'" value="Voltar">
	</form>
<?php
if(isset($_POST['email']))
	{
		$senha = addslashes($_POST['senha']);
		$email = addslashes($_POST['email']);

		if(!empty($senha) && !empty($email)){
			$u->conectar("oficina", "localhost", "root", "");
			if($u->msgErro == ""){ /*Esta tudo certo*/
				if($u->logar($email, $senha)){
					header("location: menu.php");
				}
				else{
					?>
					<div class="msg-erro">
						Email e/ou senha incorretos!
					</div>
					<?php
				}
			}
			else{
				?>
				<div class="msg-erro">
					preencha todos os campos!
				</div>
				
				<?php
			}
		}
		else{
			?>
			<div class="msg-erro">
				<?php echo "Erro: ".$u->msgErro; ?>
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