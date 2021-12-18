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

    if (isset($_POST['codigo'])) {
        $codigo = addslashes($_POST['codigo']);
        $preco = addslashes($_POST['preco']);
        $quantidade = addslashes($_POST['quantidade']);
        $total = addslashes($_POST['preco'] * $_POST['quantidade']);
        $data_compra = addslashes($_POST['data_compra']);

        // Reliza adição no banco
        $u->adiciona_acao($codigo, $preco, $quantidade, $total, $data_compra ,$chave);
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
                        <h2 style="font-size:2em; text-align:center">Cadastrar Compra</h2><hr style="width:70%;">
                        <?php require_once 'form-acao.php'; ?>
                    </div>
                </div>
            </div>
        </main>
		<footer>
			<div class="footer_pag_acao"></div>
		</footer>
	</body>
<?php require_once 'footer.php'; ?>