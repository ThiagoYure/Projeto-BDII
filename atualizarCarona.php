<!DOCTYPE html>
  <html>
    <head>
      <?php
      include 'conexao.php';
      session_start();
      if((!isset ($_SESSION['email']) == true) and (!isset ($_SESSION['senha']) == true)){
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        header('location:index.php');
      }
      $userLogado = $_SESSION['email'];
      if ($conn) {
        $data = $_GET['data'];
        $hora = $_GET['hora'];
        $sql = "SELECT origem,destino,data,distancia,tempo,hora,ajuda FROM carona WHERE usuario = '$userLogado' and data = '$data' and hora = '$hora'";
        $result = mysqli_query($conn,$sql);
        if($result === FALSE) { 
          die(mysqli_error($conn));
        };
        $resultado = mysqli_fetch_assoc($result);
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
        $passagensJson = json_encode($passagens);
      };
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
          <a id="delete" class="btn-floating btn-medium waves-effect waves-light red"><i class="material-icons">close</i></a>
        </div>
        <div class="row">
          <div class="input-field col s6">
           <input id="custo" type="number" min="0" step="0.10" class="validate">
           <label for="custo" class="white-text">Ajuda de Custo</label>
          </div>
        </div>
        <div id="map" style="height:400px;width:950px;background-color:white"></div></br></br>
        <div class="row center-align">
          <input id="salvar" class="waves-effect waves-light btn deep-orange" type="button" value="salvar">
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
        document.getElementById("data").value = "<?php echo $_GET['data']?>";
        document.getElementById("hora").value = "<?php echo $_GET['hora']?>";
        document.getElementById("origem").value = "<?php echo $origem?>";
        document.getElementById("destino").value = "<?php echo $destino?>";
        document.getElementById("custo").value = "<?php echo $ajuda?>";
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var onChangeHandler = function() {
          calculateAndDisplayRoute(directionsService, directionsDisplay);
        };
        document.getElementById('origem').addEventListener('change', onChangeHandler);
        document.getElementById('destino').addEventListener('change', onChangeHandler);
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 14
        });
        directionsDisplay.setMap(map);
        var infoWindow = new google.maps.InfoWindow({map: map});
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            infoWindow.setPosition(pos);
            infoWindow.setContent('Location found.');
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
        var geocoder = new google.maps.Geocoder();
        var waypoints = [];
        var waypointsGeom = [];
        var dataChegada;
        var horaChegada;
        add.onclick = function () {
          for (var i = 0; i < waypoints.length; i++) {
            if (waypoints[i]==document.getElementById('wayPoint').value) {
              alert("Ponto de parada já adcionado anteriormente.");
              return;
            };
          };
          geocoder.geocode({
            address: document.getElementById('wayPoint').value,
          }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
              waypoints.push({location: document.getElementById("wayPoint").value});
              waypointsGeom.push(results[0].geometry.location);
              if (document.getElementById("origem").value != ""|document.getElementById("destino").value != "") {
                calculateAndDisplayRoute(directionsService, directionsDisplay);
              }else{
                alert("Origem ou destino não foi especificado ainda...");
              }
              alert("Ponto adcionado");

            }
          });

        }
        var distancia;
        var tempo;
        function calculateAndDisplayRoute(directionsService, directionsDisplay) {
          alert(waypoints[0])
          directionsService.route({
            origin: document.getElementById('origem').value,
            destination: document.getElementById('destino').value,
            waypoints: waypoints,
            unitSystem: google.maps.UnitSystem.METRIC,
            travelMode: google.maps.TravelMode.DRIVING
          }, function(response, status) {
            if (status === 'OK') {
              directionsDisplay.setDirections(response);
              directionsDisplay.setMap(map);
              var rota = response.routes[0];
              distanciaTotal = 0;
              for (var i = 0; i < rota.legs.length; i++) {
                distanciaTotal = distanciaTotal + rota.legs[i].distance.value;
              };
              tempoTotal = 0;
              for (var j = 0; j < rota.legs.length; j++) {
                tempoTotal = tempoTotal + rota.legs[j].duration.value;
              };
              distancia = distanciaTotal/1000;
              var hora = tempoTotal/3600;
              var min = (tempoTotal%3600)/60;
              tempo = hora.toFixed(0)+"h : "+min.toFixed(0)+"min";


            } else {
              if (document.getElementById("origem").value == "" ||document.getElementById("destino").value == "") {
                alert("Falta o destino ou a origem...");
              }else
              if(status == google.maps.DirectionsStatus.ZERO_RESULTS){
                alert("Não há rota para essas especificações...");
                alert("Recarregue a página e tente outra rota...");
              }else{
                window.alert('Directions request failed due to ' + status); 
              }
            }
          });
        };


salvar.onclick = function(){
  var xhttp = new XMLHttpRequest();
  var origem = document.getElementById('origem').value;
  var data = document.getElementById('data').value;
  var custo = document.getElementById('custo').value;
  var origemGeom;
  geocoder.geocode({
    address: document.getElementById('origem').value
  }, function (results, status) {
    if (status == google.maps.GeocoderStatus.OK) {

      origemGeom = results[0].geometry.location;
      alert('oi')
    }else{
      alert("Não foi possível geocodificar...");
    }

  });
  var destino = document.getElementById('destino').value;
  var destinoGeom;
  geocoder.geocode({
    address: document.getElementById('destino').value
  }, function (results, status) {
    if (status == google.maps.GeocoderStatus.OK) {

      destinoGeom = results[0].geometry.location;
      alert('oi')
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          alert(this.responseText);
        }
      };
      xhttp.open("POST", "salvarCarona.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("destino="+document.getElementById("destino").value+"&origem="+document.getElementById("origem").value+"&destinoGeom="+JSON.stringify(destinoGeom)+"&origemGeom="+JSON.stringify(origemGeom)+"&waypoints="+JSON.stringify(waypoints)+"&waypointsGeom="+JSON.stringify(waypointsGeom)+"&ajuda="+document.getElementById("custo").value+"&data="+document.getElementById("data").value+"&hora="+document.getElementById("hora").value+"&distancia="+distancia+"&tempo="+tempo); 

    }else{
      alert("Não foi possível geocodificar...");
    }

  });
};

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(browserHasGeolocation ?
    'Error: The Geolocation service failed.' :
    'Error: Your browser doesn\'t support geolocation.');
};

document.getElementById("delete").onclick = function (){
  if (waypoints.length == 0) {
    alert("Nenhum ponto foi adcionado ainda...");
  }else{
    waypoints.pop();
    waypointsGeom.pop();
    calculateAndDisplayRoute(directionsService, directionsDisplay);
    alert("Ponto de parada removido com sucesso...");
  }
};

      </script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <script type="text/javascript" src="js/atualizarCarona.js"></script>
    </body>
</html>