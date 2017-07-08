<!DOCTYPE html>
  <html>
    <head>
      <title>EasyRide</title>
      <link type="text/css" rel="stylesheet" href="css/inicial.css"/>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body class="cyan lighten-3">
      <nav class="nav-extended">
        <div class="nav-wrapper teal accent-4">
          <div><span class="brand-logo center">EasyRide</span></div>
        </div>
      </nav></br>
      <div class="container">
        <div class="row">
          <div class="col s8 offset-s2 center-align">
            <div class="card teal accent-4 white-text">
              <div class="card-image">
                <img src="images/carona2.jpg">
                <span class="card-title">Sistema Destinado a interessados em oferecer e/ou pedir carona.</span>
              </div>

              <div class="card-tabs">
                <ul class="tabs tabs-fixed-width">
                  <li class="tab"><a class="active" href="#pedircarona">Pedir Carona</a></li>
                  <li class="tab"><a href="#oferecercarona">Oferecer Carona</a></li>
                </ul>
              </div>
              <div class="card-content teal accent-4">
                <div id="pedircarona">Test 1</div>
                <div id="oferecercarona">Test 2</div>
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
      </script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
</html>