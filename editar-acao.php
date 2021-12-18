<?php
	session_start();

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
  
    // Resgata dados do usuário diretamente do banco
    $dados = $u->buscarDados($chave);

    if (isset($_POST['chave'])) {
        $chave_acao = addslashes($_POST['chave']);
        $u->editarAcao($chave_acao, [
            'preco' => addslashes($_POST['preco']),
            'quantidade' => addslashes($_POST['quantidade']),
        ]);

        header('location: carteira2.php');
    }

    if (isset($_GET['chave'])) {
        $codigo = addslashes($_GET['chave']);
        $acao = $u->obterAcao($codigo);
    }

    require_once 'header.php';
?>
	<body>
		<header>
			<div class="usuario">
				<h2 id="cabecalho_carteira">
				    Olá, <?php echo($dados['nome']) ?> !
				</h2>
				<span id="nome_opcao"> Carteira Digital </span>
				<a href="#"><i class="fa fa-user-circle-o perfil" onclick="abrirMenu()"></i></a>
			</div>
		</header>
		<nav id='nav-menu'>
			<a href="#" onclick="fecharMenu()"><span class="material-icons">clear</span> Fechar Menu</a>
			<a href="menu.php"><span class="material-icons">home</span> Menu Principal</a>
			<a href="perfil.php"><span class="material-icons">manage_accounts</span> Alterar Perfil</a>		
			<a href="sair.php"><span class="material-icons">logout</span> Sair</a>
		</nav>
		<main id="">
		    <div class="container-fluid">
			    <div class="row">
				    <div class="col-md-10 col-lg-10 col-xs-10 col-sm-10" id="adiciona_acao">
                        <form method="post" class="fomulario_cadastro_acao" style="text-align:center">
                            <h2 style="font-size:2em; text-align:center">Editar Compra</h2><hr style="width:70%;">
                            <a href="carteira.php" style="height:26px;" class="botao_fechar"><i class="material-icons" style="color:red;">cancel</i></a>
                            <input type="hidden" name="chave" value="<?php echo $acao['chave']; ?>">
                            <input type="text" name="codigo" disabled class="dados_nova_acao" style="opacity:.4;" placeholder="Código da ação" value="<?php echo $acao['codigo'] ?>">
                            <input type="text" name="preco" class="dados_nova_acao" placeholder="Preço pago" value="<?php echo $acao['preco'] ?>">
                            <input type="text" name="quantidade" class="dados_nova_acao frase_quantidade" placeholder="Quantidade comprada" value="<?php echo $acao['quantidade'] ?>">
                            <input type="date" name="data_compra" disabled class="dados_nova_acao" style="opacity:.4;" value="<?php echo $acao['data_compra'] ?>">
                            <br>
                            <input type="submit" name="registrar" class="dados_nova_acao_submit">
                        </form>
                    </div>
                </div>
            </div>
        </main>
		<footer>
			<div class="footer_pag_acao"></div>
		</footer>
	</body>
<?php require_once 'footer.php'; ?>