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

?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name='viewport' content='width=device-width, initial-scale=1'>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
		<main id=content>
		    <div class="container-fluid">
			    <div class="row">
				    <div class="col-md-10 col-lg-10 col-xs-10 col-sm-10" id="carteira" style=" overflow: scroll;">
					    <table class="tabela-carteira" id="tabela_carteira">
						    <tr class="titulo"> 
							    <td class="nomes_titulos">Ação</td>
							    <td class="nomes_titulos">Preço</td>
						    	<td class="nomes_titulos">Quantidade</td>
						    	<td class="nomes_titulos">Total</td>
    						    <td class="nomes_titulos">Data de Compra</td>
	    						<td colspan="2" style="text-align:center"><a href="adicionar-acao.php"><i class="material-icons" id="add_acao" style="font-size:36px">add</i></a></td>
		    				</tr>
			    		<?php 
				    		$acoes=$u->buscarAcoes("$chave");

	    					if(count($acoes)>0){
		    					for($i=0;$i<count($acoes);$i++){
                                    
				        			echo "<tr class='acao'>";
    								foreach ($acoes[$i] as $k => $v) {
	    								if($k != "chave" && $k != "id_pessoa"){
		    								if($k=="preco" || $k=="total"){
			    								echo "<td class='acao_coluna'>$ ".$v."</td>";
				    						}
					    					else{
						    					echo "<td class='acao_coluna'>".$v."</td>";
							    			}
										
								    	}
    								}
	    				?>
								<td class="acao_botao" style="text-align:center">
									<a href="javascript:void(0)" style="display: inline-block;" onclick="abrir_fechar_edit(event, this)">
                                        <i class="material-icons">arrow_back_ios</i>
									</a>
                                    <a href="#" class="revelar-item block_sumiu1" style="overflow: hidden; display: inline-block; width: 0; height:26px;">
			    						<i class="material-icons">edit</i>
									</a>
									<a href="#" class="revelar-item block_sumiu2" style="overflow: hidden; display: inline-block; width: 0; height:26px;">
                                    <i class="material-icons">delete</i>
									</a>
								</td>
						<?php 

						    	}
    						}
    					?>
					    </table>
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