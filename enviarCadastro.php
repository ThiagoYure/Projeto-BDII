<?php

	session_start();
	include_once("conexao.php");

	if($conn != null){
		$nome = $_POST['nome'];
	    $nascimento = $_POST['data'];
	    $username = $_POST['user'];
	    $email = $_POST['email'];
	    $senha = $_POST['senha'];
	    $sexo = $_POST['sexo'];
	    $telefone = $_POST['telefone'];

	    $sql = "INSERT INTO usuario (email, nome, user, sexo, nascimento, telefone, senha)
      	VALUES ('$email', '$nome', '$username', '$sexo', '$nascimento', '$telefone', '$senha')";

     	$result = mysqli_query($conn, $sql);



     	if(!empty($result)){
        	header("Location: index.php");
      	} else {
        	echo "Tchubirabiron";
      	}

	}

?>