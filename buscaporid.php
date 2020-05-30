<?php
		// Inclusão do arquivo conexao.php ao select_cliente.php
		require_once 'Conexao.php';  
		$con = new Conexao();
		$conexao = $con->conectar();
		$id = $_GET["id"];
		// Se a seleção for possível de realizar
		try {
			// variável que faz a seleção
			$selecao = "SELECT * FROM clientes where cd_cliente='".$id."'";
			// $seleciona_dados recebe $conexao que prepare a operação para selecionar
			$seleciona_dados = $conexao->prepare($selecao);
			// Executa a operação
			$seleciona_dados->execute();
			// Retorna uma matriz contendo todas as linhas do conjunto de resultados
			$linhas = $seleciona_dados->fetchAll(PDO::FETCH_ASSOC);

			echo json_encode($linhas);
		// Se a seleção não for possível de realizar
		} catch (PDOException $falha_selecao) {
			echo "A listagem de dados não foi feita".$falha_selecao->getMessage();
		}
	?>
