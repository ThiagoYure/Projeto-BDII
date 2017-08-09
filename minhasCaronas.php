<!DOCTYPE html>
  <html>
    <head>
      <?php
        session_start();
        include('conexao.php');
        if((!isset ($_SESSION['email']) == true) and (!isset ($_SESSION['senha']) == true)){
          unset($_SESSION['login']);
          unset($_SESSION['senha']);
          header('location:index.php');
        };
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
          <a href="configuracao.php"><span id="email" class="white-text email">me@gmail.com</span></a>
        </div></li>
        <li><a class="waves-effect" href="configuracao.php"><i class="material-icons">settings</i>Configurações</a></li>
        <li><a class="waves-effect" href="minhasCaronas.php"><i class="material-icons">directions_car</i>Caronas</a></li>
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
      <div class="container teal accent-4">
        <h4 class="white-text center">Minhas Caronas</h4>
        <ul id="caronas" class="collection"> 
        <?php
          if ($conn!=null) {
          # code...
            $sql = "SELECT origem,destino,data,distancia,tempo,hora,ajuda FROM carona WHERE usuario = '$userLogado'";
            $result = mysqli_query($conn,$sql);
            if($result === FALSE) { 
              die(mysqli_error($conn));
            };
            while ($resultado = mysqli_fetch_assoc($result)) {
              $data = $resultado['data'];
              $hora = $resultado['hora'];
              $destino = $resultado['destino'];
              $origem = $resultado['origem'];
              $ajuda = $resultado['ajuda'];
              $sql1 = "SELECT parada FROM pontosdeparada WHERE datacarona = '$data' and horacarona = '$hora' and usuario = '$userLogado'";
              $passagens = array();
              $result1 = mysqli_query($conn,$sql1);
              if($result1 === FALSE) { 
                die(mysqli_error($conn));
              };
              while($resultado1 = mysqli_fetch_assoc($result1)){
                $passagens[] = $resultado1['parada'];
              }
              $jsonPassagens = json_encode($passagens);
              print("<li class='collection-item light-blue accent-4 white-text'><a href='atualizarCarona.php?data=$data&hora=$hora' class='white-text'>
                Origem: ".$resultado['origem']."</br>
                Destino: ".$resultado['destino']."</br>
                Data da Carona: ".$resultado['data']."</br>
                Hora da Carona: ".$resultado['hora']."</br>
                Distancia da Carona: ".$resultado['distancia']."</br>
                Tempo de duração: ".$resultado['tempo']."</br>
                Ajuda de custo: ".$resultado['ajuda']."</br>
              </a></li>") ; 
            }

          } 
        ?>
        </ul>
      </div>
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
            max: new Date(2023,0,1)
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
    </body>
</html>