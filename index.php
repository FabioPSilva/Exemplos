<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title> Listar clientes </title>
	<link rel="stylesheet" href="/WEB/css/css.css"> 
</head>
<body>
	<?php
		// Inclusão do arquivo conexao.php ao select_cliente.php
		require_once 'Conexao.php';  
		$con = new Conexao();
		$conexao = $con->conectar();
		// Se a seleção for possível de realizar
		try {
			// variável que faz a seleção
			$selecao = "SELECT * FROM clientes";
			// $seleciona_dados recebe $conexao que prepare a operação para selecionar
			$seleciona_dados = $conexao->prepare($selecao);
			// Executa a operação
			$seleciona_dados->execute();
			// Retorna uma matriz contendo todas as linhas do conjunto de resultados
			$linhas = $seleciona_dados->fetchAll(PDO::FETCH_ASSOC);
		// Se a seleção não for possível de realizar
		} catch (PDOException $falha_selecao) {
			echo "A listagem de dados não foi feita".$falha_selecao->getMessage();
		}
	?>
	<p> Procurar cliente: <input id="nome"/> </p>
	<table id="lista" border="1">
		<tr> <td> ID cliente: <td> Nome: <td> CPF: <td> Telefone: 
		<td> Email: <td> Cidade: <td> Bairro: <td> Rua: <td > Número: </tr>
		<?php 
			// Loop para exibir as linhas criando uma tabela
			foreach ($linhas as $exibir_colunas){
				echo '<tr>';
		 		echo '<td>'.$exibir_colunas['cd_cliente'].'</td>';
		 		echo '<td>'.$exibir_colunas['nome'].'</td>';
		 		echo '<td>'.$exibir_colunas['cpf'].'</td>';
		 		echo '<td>'.$exibir_colunas['telefone'].'</td>';
		 		echo '<td>'.$exibir_colunas['email'].'</td>';
		 		echo '<td>'.$exibir_colunas['cidade'].'</td>';
		 		echo '<td>'.$exibir_colunas['bairro'].'</td>';
		 		echo '<td>'.$exibir_colunas['rua'].'</td>';
		 		echo '<td>'.$exibir_colunas['numero'].'</td>';
		 		echo '</tr>'; echo '</p>';
			}
		?>
	</table>

	<br>

	<table>
		<tr>
			<td>ID:</td>
			<td><input type="text" name="id" id="id"> <input type="button" value="Buscar" onclick="buscaDados()"></td>
		</tr>
		<tr>
			<td>Nome:</td>
			<td><input type="text" id="nomecli"></td>
		</tr>
		<tr>
			<td>CPF:</td>
			<td><input type="text" id="cpfcli"></td>
		</tr>
		<tr>
			<td>Telefone:</td>
			<td><input type="text" id="telefonecli"></td>
		</tr>
		<tr>
			<td>Email:</td>
			<td><input type="text" id="emailcli"></td>
		</tr>
		<tr>
			<td>Cidade:</td>
			<td><input type="text" id="cidadecli"></td>
		</tr>
		<tr>
			<td>Bairro:</td>
			<td><input type="text" id="bairrocli"></td>
		</tr>
		<tr>
			<td>Rua:</td>
			<td><input type="text" id="ruacli"></td>
		</tr>
		<tr>
			<td>Numero:</td>
			<td><input type="text" id="numerocli"></td>
		</tr>
	<table>
	<script>
		var filtro = document.getElementById('nome');
		var tabela = document.getElementById('lista');
		filtro.onkeyup = function() {
    		var nomeFiltro = filtro.value.toLowerCase();
    		for (var i = 1; i < tabela.rows.length; i++) {
        		var conteudoCelula = tabela.rows[i].cells[1].innerText
        		var corresponde = conteudoCelula.toLowerCase().indexOf(nomeFiltro) >= 0;
        		tabela.rows[i].style.display = corresponde ? '' : 'none';
    		}
    	}

    	buscaDados = function()
    	{
    		//Armazena o id
    		var id = document.querySelector("#id").value;
    		//Instancia a classe XMLHttpReques
    		ajax = new XMLHttpRequest();
    		//Especifica o Method e a url que será chamada (dessa forma, não funciona com POST)
    		ajax.open("GET","buscaporid.php?id="+id,true);

    		//Executa na resposta do ajax
    		ajax.onreadystatechange = function()
    		{
    			//Se completar a requisição
	    		if(ajax.readyState == 4)
	        	{
	        		//Se retorno OK
		            if(ajax.status == 200)
		            {
		            	//Converte a String retornada, para JSON no JS
		                var retornoJson = JSON.parse(ajax.responseText);
		                //Preenche os campos com o retorno
		                document.querySelector("#nomecli").value = retornoJson[0].nome;
		                document.querySelector("#cpfcli").value = retornoJson[0].cpf;
		                document.querySelector("#telefonecli").value = retornoJson[0].telefone;
		                document.querySelector("#emailcli").value = retornoJson[0].email;
		                document.querySelector("#cidadecli").value = retornoJson[0].cidade;
		                document.querySelector("#bairrocli").value = retornoJson[0].bairro;
		                document.querySelector("#ruacli").value = retornoJson[0].rua;
		                document.querySelector("#numerocli").value = retornoJson[0].numero;
		            }
	        	}
    		}
    		//Envia a solicitação
    		ajax.send();
    	}
	</script> 
</body>
</html>
