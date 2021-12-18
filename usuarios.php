<?php

Class Usuario
{
	private $pdo;
	public $msgErro="";

	public function conectar($nome, $host, $usuario, $senha)
	{
		global $pdo;
		
		try {
			$pdo= new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
		} catch (PDOException $e) {
			$msgErro= $e->getMessage();
		}
		
	}
	public function cadastrar($nome, $sobrenome, $senha, $email, $idade)
	{
		global $pdo;
		/*Verificar se já existe o email*/
		$sql= $pdo->prepare("SELECT chave FROM cadastros WHERE email= :e");
		$sql->bindValue(":e", $email);
		$sql->execute();

		if($sql->rowCount()>0){ /*já cadastrado*/
			return false;
		}
		else{ /*cadastrar*/
			$sql = $pdo->prepare("INSERT INTO cadastros(nome, sobrenome, senha, email, idade) VALUES (:n, :sn, :s, :e, :i)");
			$sql->bindValue(":n", $nome);
			$sql->bindValue(":sn", $sobrenome);
			$sql->bindValue(":s", $senha);
			$sql->bindValue(":e", $email);
			$sql->bindValue(":i", $idade);
			$sql->execute();
			return true;
		}
	}	
	public function logar($email, $senha)
	{
		global $pdo;
		$sql= $pdo->prepare("SELECT chave FROM cadastros WHERE email= :e AND senha= :s");
		$sql->bindValue(":e", $email);
		$sql->bindValue(":s", $senha);
		$sql->execute();

		if($sql->rowCount()>0){  /*Conseguiu logar*/
			$dados= $sql->fetch();
			session_start();
			$_SESSION['chave']= $dados['chave'];
			return true;
		}
		else{
			return false; /*Nao foi possivel logar*/
		}
	}

	public function buscarDados($chave){
		global $pdo;
		$res[0]=array();
		$cmd= $pdo->prepare("SELECT * FROM cadastros WHERE chave=(:c)");
		$cmd->bindValue(":c", $chave);
		$cmd->execute();
		$res= $cmd->fetch(PDO::FETCH_ASSOC);
		return $res;
	}

	public function buscarAcoes($chave){
		global $pdo;
		$res=array();
		$cmd= $pdo->prepare("SELECT * FROM acoes WHERE id_pessoa=(:c)");
		$cmd->bindValue(":c", $chave);
		$cmd->execute();
		$res= $cmd->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}


	public function alterarDados($nome, $sobrenome, $email, $senha, $chave) {
		global $pdo;

		$cmd=$pdo->prepare("UPDATE cadastros SET nome=:n, sobrenome=:sn, email=:e, senha=:s WHERE chave=:c");
		$cmd->bindValue(":n", $nome);
		$cmd->bindValue(":sn", $sobrenome);
		$cmd->bindValue(":s", $senha);
        $cmd->bindValue(":e", $email);
		$cmd->bindValue(":c", $chave);
		$cmd->execute();
	}

    public function deletarAcao($chave){
        global $pdo;

        $cmd=$pdo->prepare("DELETE FROM acoes WHERE chave=:c");
        $cmd->bindValue(":c", $chave);
        $cmd->execute();
    }

    public function adiciona_acao($codigo, $preco, $quantidade, $total, $data_compra ,$chave){
        global $pdo;

        $cmd= $pdo->prepare("INSERT INTO acoes (codigo, preco, quantidade, total, data_compra, id_pessoa) VALUES(:cd, :p, :q, :t, :dt, :c)");
        $cmd->bindValue(":cd", $codigo);
        $cmd->bindValue(":p", $preco);
        $cmd->bindValue(":q", $quantidade);
        $cmd->bindValue(":t", $total);
        $cmd->bindValue(":dt", $data_compra);
        $cmd->bindValue(":c", $chave);
        $cmd->execute();
        header("location: carteira2.php");
    }

    public function listarAcoes($chaveUsuario) {
        global $pdo;
		$cmd = $pdo->prepare("
            SELECT *, (
                SELECT MAX(data_compra) 
                FROM acoes a2 
                WHERE a2.codigo = acoes.codigo 
                AND a2.id_pessoa = acoes.id_pessoa
                GROUP BY codigo
            ) AS data_ultima_compra 
            FROM acoes 
            WHERE id_pessoa=(:c)
        ");
		$cmd->bindValue(":c", $chaveUsuario);
		$cmd->execute();
        $rows = array();
		$rows = $cmd->fetchAll(PDO::FETCH_ASSOC);

        /*
        echo('<pre>');
        var_dump($rows);
        echo('</pre>');
        */

        $acoes = array();

        foreach ($rows as $row) {
            $codigo = $row['codigo'];

            if (!array_key_exists($codigo, $acoes)) {
                $acoes[$codigo] = [
                    'precoQuant' => 0,
                    'quantTotal' => 0,
                ];
            }

            $precoQuant = $row['preco'] * $row['quantidade'];
            
            $acoes[$codigo]['precoQuant'] += $precoQuant;
            $acoes[$codigo]['quantTotal'] += $row['quantidade'];
            $acoes[$codigo]['dataUltimaCompra'] = $row['data_ultima_compra'];
        }

        foreach ($acoes as $codigo => $acao) {
            $precoMedioCompra = $acao['precoQuant'] / $acao['quantTotal'];
            $acoes[$codigo]['precoMedioCompra'] = $precoMedioCompra;
        }

        /*
        echo('<pre>');
        var_dump($acoes);
        echo('</pre>');
        */

		return $acoes;
    }

    public function obterAcao($chave) {
        global $pdo;
		$cmd = $pdo->prepare('SELECT * FROM acoes WHERE chave=(:c)');
		$cmd->bindValue(':c', $chave);
		$cmd->execute();
		$res = $cmd->fetch(PDO::FETCH_ASSOC);

        $acao = [
            'chave' => $res['chave'],
            'id_pessoa' => $res['id_pessoa'],
            'codigo' => $res['codigo'],
            'preco' => $res['preco'],
            'quantidade' => $res['quantidade'],
            'total' => $res['total'],
            'data_compra' => $res['data_compra'],
        ];

        return $acao;
    }

    public function editarAcao($chave, $dados) {
        global $pdo;
        $cmd = $pdo->prepare("UPDATE acoes SET preco = :p, quantidade = :q WHERE chave=:c");
        $cmd->bindValue(":p", $dados['preco']);
        $cmd->bindValue(":q", $dados['quantidade']);
        $cmd->bindValue(":c", $chave);
        $cmd->execute();
    }

}

?>