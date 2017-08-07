<!DOCTYPE html>
  <html>
    <head>
      <?php
      session_start();
      if((!isset ($_SESSION['email']) == true) and (!isset ($_SESSION['senha']) == true)){
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        header('location:index.php');
      }
      $userLogado = $_SESSION['email'];
      ?>
      <title>EasyRide</title>
      <meta charset="UTF-8">
      <link type="text/css" rel="stylesheet" href="css/inicial.css"/>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body class="cyan lighten-3">
      <ul id="slide-out" class="side-nav">
        <li><div class="userView">
          <div class="background">
            <img class="responsive-img" src="images/carona.jpg">
          </div>
          <a href="configuracao.php"><span id="email" class="white-text email"></span></a>
        </div></li>
        <li><a class="waves-effect" href="configuracao.php"><i class="material-icons">settings</i>Configurações</a></li>
        <li><a class="waves-effect" href="carona.php"><i class="material-icons">directions_car</i>Caronas</a></li>
        <li><a class="waves-effect" href="index.php"><i class="material-icons">power_settings_new</i>Logout</a></li>
      </ul>
      <div class="navbar-fixed">
        <nav>
          <div class="nav-wrapper teal accent-4">
            <a href="#" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons">menu</i></a>
            <a href="inicial.php" class="brand-logo center">EasyRide</a>
          </div>
        </nav>
      </div></br></br></br>
      <div class="container">
      <form>
        <div class="row">
          <div class="input-field col s6">
           <input id="data" type="date" class="datepicker">
           <label for="data" class="white-text">Data da viagem</label>
          </div>
          <div class="input-field col s6">
           <input id="hora" type="time" class="timepicker">
           <label for="hora" class="white-text">Hora da viagem</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6">
           <input id="origem" type="text" class="validate">
           <label for="origem" class="white-text">Origem</label>
          </div>
          <div class="input-field col s6">
           <input id="destino" type="text" class="validate">
           <label for="destino" class="white-text">Destino</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s4">
           <input id="wayPoint" type="text" class="validate">
           <label for="wayPoint" class="white-text">Ponto de parada</label>
          </div>
          <a id="add" class="btn-floating btn-medium waves-effect waves-light cyan"><i class="material-icons">add</i></a>
        </div>
        <div class="row">
          <div class="input-field col s6">
           <input id="custo" type="number" min="0" step="0.10" class="validate">
           <label for="custo" class="white-text">Ajuda de Custo</label>
          </div>
        </div>
        <div id="map" style="height:400px;width:950px;background-color:white"></div></br></br>
        <div class="row center-align">
          <input id="salvar" class="waves-effect waves-light btn deep-orange" type="button" value="salvar alterações">
        </div>
      </form>
      </div> 
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDd0aCIFSeFdgJlgEb11e7Sc3ieIocsd0c"></script>
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript">
        $( document ).ready(function(){
          $(".button-collapse").sideNav();
        })
        $(document).ready(function(){
          $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 100, // Creates a dropdown of 15 years to control year
            min: new Date(1920, 0, 1),
            max: new Date()
          });
          $('.timepicker').pickatime({
            default: 'now', // Set default time
            fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
            twelvehour: false, // Use AM/PM or 24-hour format
            donetext: 'OK', // text for done-button
            cleartext: 'Clear', // text for clear-button
            canceltext: 'Cancel', // Text for cancel-button
            autoclose: false, // automatic close timepicker
            ampmclickable: true, // make AM PM clickable
            aftershow: function(){} //Function for after opening timepicker  
          });
          $('select').material_select();
        });
        document.getElementById("email").innerHTML = "<?php echo $_SESSION['email'] ?>";
      </script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <script type="text/javascript" src="js/editarCarona.js"></script>
    </body>
</html>