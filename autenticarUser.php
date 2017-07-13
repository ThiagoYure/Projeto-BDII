<?php
  session_start();
  include_once("conexao.php");

    if((!empty($_POST['email'])) && (!empty($_POST['senha']))){
      $email = $_POST['email'];
      $senha = $_POST['senha'];
      //$senhaC = md5($senha);

      $sql = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'";
      $result = mysqli_query($conn, $sql);
      $resultado = mysqli_fetch_assoc($result);

      if(empty($resultado)){
        $_SESSION['loginErro'] = "Usuario ou senha invalido";
        echo "<script>alert('Email ou senha inválidos!')</script>";
        //header("Location: index.php");
      } else {
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        header("Location: inicial.php");
      } 

    } else {
      $_SESSION['loginErro'] = "Usuario ou senha invalido";
      header("Location: index.php");
    }
?>