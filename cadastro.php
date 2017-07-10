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
	<title>Cadastro-EasyRide</title>
	<meta charset="UTF-8">
</head>
<body class="cyan lighten-3">
	<div class="container center-align">
        	<img class="small" src="images/EasyRide.png" height="300px">
    </div>
    <div class="container">
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
        <div class="row">
          <div class="input-field col s6">
            <input id="name" type="text" class="validate">
            <label for="name" class="white-text">Nome</label>
          </div>
          <div class="input-field col s6">
           <input type="date" class="datepicker">
           <label for="birthdate" class="white-text">Data de nascimento</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6">
            <input id="email" type="email" class="validate">
            <label for="email" class="white-text">Email</label>
          </div>
          <div class="input-field col s6">
            <input id="password" type="password" class="validate">
            <label for="password" class="white-text">Password</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6">
            <select>
              <option value="" disabled selected>Escolha seu sexo</option>
              <option value="1">Masculino</option>
              <option value="2">Feminino</option>
            </select>
            <label class="white-text">Sexo</label>
          </div>
          <div class="input-field col s6">
            <input id="telefone" type="tel" class="validate">
            <label for="telefone" class="white-text">Telefone</label>
          </div>
        </div>
        <div class="row center-align">
          <input class="waves-effect waves-light btn deep-orange" type="submit" value="Cadastrar">
        </div>
      </form>
    </div>
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 100, // Creates a dropdown of 15 years to control year
            min: new Date(1920, 0, 1),
            max: new Date()
          });
      $('select').material_select();
    });
  </script>
  <script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>