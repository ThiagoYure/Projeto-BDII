<!DOCTYPE html>
<html>
<head>
	<link type="text/css" rel="stylesheet" href="css/index.css"/>
	<!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
	<!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>Login-EasyRide</title>
	<meta charset="UTF-8">
</head>
<body class="cyan lighten-3">
	<div class="container center-align">
        	<img class="small" src="images/EasyRide.png" height="300px">
    </div>
    <div class="container">
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
        <div class="row">
          <div class="input-field col s6 offset-s3">
          	<i class="material-icons prefix">email</i>
            <input id="email" type="email" class="validate">
            <label for="email" class="white-text">Email</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6 offset-s3">
          	<i class="material-icons prefix">https</i>
            <input id="password" type="password" class="validate">
            <label for="password" class="white-text">Senha</label>
          </div>
        </div>
        <div class="row center-align">
          <input class="waves-effect waves-light btn deep-orange" type="submit" value="Entrar">
        </div>
      </form>
      <div class="row center-align">
      	<span class="dark-text">Não possui conta?</span>
      	<a class="waves-effect waves-orange btn-flat-small white-text" href="cadastro.php">Cadastrar</a>
      </div>
    </div>
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>