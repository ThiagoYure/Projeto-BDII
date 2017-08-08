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
}


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
}