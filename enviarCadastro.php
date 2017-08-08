<?php

	session_start();
	include_once("conexao.php");

	if($conn != null){
		$nome = $_POST['nome'];
	    $nascimento = $_POST['data'];
	    $username = $_POST['user'];
	    $email = $_POST['email'];
	    $senha = $_POST['senha'];
	    echo $senha;
	    $sexo = $_POST['sexo'];
	    $telefone = $_POST['telefone'];

	    $sql = "INSERT INTO usuario (nome, data, user, email, senha, sexo, telefone)
      	VALUES ('$nome', '$nascimento','$username','$email','$senha','$sexo','$telefone')";

     	$result = mysqli_query($conn, $sql);
     	echo $result;
     	$resultado = mysqli_fetch_assoc($result);
     	echo $resultado;

     	if(!empty($resultado)){
        	echo 'fudeu';
        	header("Location: cadastro.php");
      	} else {
        	header("Location: index.php");
      	} 

	}

?>