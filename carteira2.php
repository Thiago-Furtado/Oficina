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
		<main id=content>
		    <div class="container-fluid">

                <!-- INICIO: Tabela Resumida -->
                <div class="row">
				    <div class="col-md-10 col-lg-10 col-xs-10 col-sm-10" id="carteira2">
                        <p style="text-align:center; font-size:2em; margin-top:5px">Tabela Resumida</p>
                        <table class="tabela-carteira">
						    <tr class="titulo"> 
							    <td class="nomes_titulos">Ação</td>
							    <td class="nomes_titulos">Preço</td>
						    	<td class="nomes_titulos">Quantidade</td>
						    	<td class="nomes_titulos">Total</td>
    						    <td class="nomes_titulos">Data de Compra</td>
		    				</tr>

			    		    <?php 
				    		    $acoes_lista = $u->listarAcoes($chave);

	    					    if (count($acoes_lista) > 0) {
                                    foreach ($acoes_lista as $codigo => $item) {
                            ?>
                            <tr class="acao">
                                <td class="acao_coluna" style="text-transform:uppercase;"><?php echo $codigo; ?></td>
                                <td class="acao_coluna"><?php echo number_format((float)$item['precoMedioCompra'], 2, '.', ''); ?></td>
                                <td class="acao_coluna"><?php echo $item['quantTotal']; ?></td>
                                <td class="acao_coluna"><?php echo $item['precoQuant']; ?></td>
                                <td class="acao_coluna"><?php echo $item['dataUltimaCompra']; ?></td>
                            </tr>
                            <?php
                                    }
                                }
                            ?>

					    </table>
                    </div>
                </div>
                <!-- FIM: Tabela Resumida -->

			    <div class="row">
				    <div class="col-md-10 col-lg-10 col-xs-10 col-sm-10" id="carteira" style=" overflow: scroll;">
                    <p style="text-align:center; font-size:2em; margin-top:5px">Tabela de Históricos</p>
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

	    					if (count($acoes) > 0) {
		    					for($i=0;$i<count($acoes);$i++){
                                    
				        			echo "<tr class='acao'>";
    								foreach ($acoes[$i] as $k => $v) {
	    								if($k != "chave" && $k != "id_pessoa"){
		    								if($k=="preco" || $k=="total"){
			    								echo "<td class='acao_coluna'>$ ".$v."</td>";
				    						}
					    					else{
						    					echo "<td class='acao_coluna' style='text-transform:uppercase;'>".$v."</td>";
							    			}
										
								    	}
    								}
	    				?>
								<td class="acao_botao" style="text-align:center">
									<a href="javascript:void(0)" style="display: inline-block;" onclick="abrir_fechar_edit(event, this)">
                                        <i class="material-icons">arrow_back_ios</i>
									</a>
                                    <a href="editar-acao.php?chave=<?php echo $acoes[$i]['chave']; ?>" class="revelar-item block_sumiu1" style="overflow: hidden; display: inline-block; width: 0; height:26px;">
			    						<i class="material-icons">edit</i>
									</a>
									<a href="remover-acao.php?chave=<?php echo $acoes[$i]['chave']; ?>" class="revelar-item block_sumiu2" style="overflow: hidden; display: inline-block; width: 0; height:26px;">
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
        </main>
		<footer>
			<div class="footer_pag_menu"></div>
		</footer>
	</body>
<?php require_once 'footer.php'; ?>