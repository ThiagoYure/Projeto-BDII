<!DOCTYPE html>
  <html>
    <head>
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
          <a href="#!name"><span class="white-text name">Me</span></a>
          <a href="#!email"><span class="white-text email">me@gmail.com</span></a>
        </div></li>
        <li><a class="waves-effect" href="configuracoes.php"><i class="material-icons">settings</i>Configurações</a></li>
        <li><a class="waves-effect" href="index.php"><i class="material-icons">power_settings_new</i>Logout</a></li>
      </ul>
      <div class="navbar-fixed">
        <nav>
          <div class="nav-wrapper teal accent-4">
            <a href="#" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons">menu</i></a>
            <a href="inicial.php" class="brand-logo center">EasyRide</a>
          </div>
        </nav>
      </div></br>
      <div class="container">
        <div class="row">
          <div class="col s12 center-align">
            <div class="card teal accent-4 white-text">
              <span class="card-title">Sistema Destinado a interessados em oferecer e/ou pedir carona</span>
              <div class="card-tabs">
                <ul class="tabs tabs-fixed-width">
                  <li class="tab"><a class="active" href="#pedircarona">Pedir Carona</a></li>
                  <li class="tab"><a href="#oferecercarona">Oferecer Carona</a></li>
                </ul>
              </div>
              <div class="card-content teal accent-4">
                <div id="oferecercarona">
                  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                    <div class="row">
                      <div class="col s6 left-align">
                        <div class="row left-align">
                          <div class="col s6">
                            <i class="material-icons">room</i><span> : </span>
                            <a id="btorigem" href="#maplayer" class="waves-effect waves-light btn deep-orange">Origem</a>
                          </div>
                        </div>
                        <div class="row left-align">
                          <div class="col s6">
                            <i class="material-icons">room</i><span> : </span>
                            <a id="btdestino" href="#maplayer" class="waves-effect waves-light btn deep-orange">Destino</a>
                            <a href="#maplayer" class="waves-effect waves-light btn-floating deep-orange"><i class="material-icons">add</i></a>
                          </div>
                        </div>
                        <div class="row left-align">
                          <div class="col s6">
                            <i class="material-icons prefix">today</i>
                            <label for="" class="white-text">Data da Viagem:</label>
                            <input id="data" type="date" class="datepicker">
                          </div>
                        </div>
                        <div class="row left-align">
                          <div class="col s6">
                            <i class="material-icons prefix">schedule</i>
                            <label for="hora" class="white-text">Hora da Viagem</label>
                            <input id="hora" type="date" class="timepicker">
                          </div>
                        </div>
                        <div class="row left-align">
                          <div class="input-field col s6">
                            <i class="material-icons prefix">label_outline</i>
                            <input id="custo" type="number" step="any" min=0 class="validate">
                            <label for="custo" class="white-text">Ajuda de Custo</label>
                          </div>
                        </div>
                      </div>
                      <div class="col s4"><iframe src="https://www.google.com/maps/embed/v1/view?" width="400px" height="400px"></iframe></div>
                    </div>
                    <div class="row">
                      <div class="row center-align">
                        <input class="waves-effect waves-light btn deep-orange" type="submit" value="Confirmar">
                      </div>
                    </div>
                  </form>
                </div>
                <div id="pedircarona">Test 2</div>
              </div>
            </div>
          </div>
        </div>
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
        
      </script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
</html>