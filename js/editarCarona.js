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
var pontosDeParadas = [];
var pontosDeParadasGeom = [];
add.onclick = function () {
	for (var i = 0; i < pontosDeParadas.length; i++) {
		if (pontosDeParadas[i].location==document.getElementById('wayPoint').value) {
			alert("Ponto de parada já adcionado anteriormente.");
			return;
		};
	};
	geocoder.geocode({
		address: document.getElementById('wayPoint').value,
	}, function (results, status) {
		if (status == google.maps.GeocoderStatus.OK) {
			pontosDeParadas.push({
				location: document.getElementById('wayPoint').value
			});
			pontosDeParadasGeom.push(results[0].geometry.location);
			calculateAndDisplayRoute(directionsService, directionsDisplay);
		}
	});
	alert("Ponto de parada adcionado!");
	
}
function calculateAndDisplayRoute(directionsService, directionsDisplay) {
	directionsService.route({
		origin: document.getElementById('origem').value,
		destination: document.getElementById('destino').value,
		waypoints: pontosDeParadas,
		unitSystem: google.maps.UnitSystem.METRIC,
		travelMode: google.maps.TravelMode.DRIVING
	}, function(response, status) {
		if (status === 'OK') {
			if (status == google.maps.DirectionsStatus.OK) {
				directionsDisplay.setDirections(response);
				directionsDisplay.setMap(map);
				var rota = response.routes[0];
				var quantidadeLegs = rota.legs.length;
				var totalDistancia = null;
				for (var i = 0; i < quantidadeLegs; i++) {
					totalDistancia = totalDistancia + rota.legs[i].distance.value;
				}
				totalDistancia = totalDistancia / 1000;
				var totalSegundos;
				for (var k = 0; k < quantidadeLegs; k++) {
					totalSegundos = totalSegundos + rota.legs[k].duration.value;
				}
				totalSegundos = totalSegundos/3600;

				displayObject = directionsDisplay;
			}
			directionsDisplay.setDirections(response);
			directionsDisplay.setMap(map);
			var rota = response.routes[0];
			var totalDist;
			for (var i = 0; i < rota.legs.length; i++) {
				totalDist = totalDist + rota.legs[i].distance.value;
			}
			totalDist = totalDist / 1000;
			var tempo;
			for (var j = 0; j < rota.legs.length; j++) {
				tempo = tempo + rota.legs[j].duration.value;
			}
			tempo = tempo/3600;
		} else {
			window.alert('Directions request failed due to ' + status);
		}
	});
}


salvar.onclick = function(){
	var xhttp = new XMLHttpRequest();
	var origem = document.getElementById('origem').value;
	var data = document.getElementById('data').value;
	var custo = document.getElementById('custo').value;
	geocoder.geocode({
		address: document.getElementById('origem').value
	}, function (results, status) {
		if (status == google.maps.GeocoderStatus.OK) {

			window.localStorage.removeItem('latOrigem');
			window.localStorage.removeItem('lngOrigem');
			window.localStorage.setItem('latOrigem', results[0].geometry.location.lat());
			window.localStorage.setItem('lngOrigem', results[0].geometry.location.lng());
			alert('oi')
		}else{
			alert("Não foi possível geocodificar...");
		}

	});
	var latOrigem = window.localStorage.getItem('latOrigem');
	var lngOrigem = window.localStorage.getItem('lngOrigem');
	var destino = document.getElementById('destino').value;
	geocoder.geocode({
		address: document.getElementById('destino').value
	}, function (results, status) {
		if (status == google.maps.GeocoderStatus.OK) {

			window.localStorage.removeItem('latDestino');
			window.localStorage.removeItem('lngDestino');
			window.localStorage.setItem('latDestino', results[0].geometry.location.lat());
			window.localStorage.setItem('lngDestino', results[0].geometry.location.lng());
			alert('oi')
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					alert(this.responseText);
				}
			};
			var latDestino = window.localStorage.getItem('latDestino');
			var lngDestino = window.localStorage.getItem('lngDestino');
			xhttp.open("POST", "salvarCarona.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("origem="+document.getElementById('origem').value+"&destino="+document.getElementById('destino').value+"&data="+data+"&custo"+custo+"&latDestino="+localStorage.getItem('latDestino')+"&lngDestino="+localStorage.getItem('lngDestino')+"&latOrigem="+localStorage.getItem('latOrigem')+"&lngOrigem="+localStorage.getItem('lngOrigem')); 

		}else{
			alert("Não foi possível geocodificar...");
		}

	});
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
	infoWindow.setPosition(pos);
	infoWindow.setContent(browserHasGeolocation ?
		'Error: The Geolocation service failed.' :
		'Error: Your browser doesn\'t support geolocation.');
}

function geocodeAddress(geocoder, address) {
	geocoder.geocode({'address': address}, function(results, status) {
		if (status === 'OK') {
			window.localStorage.removeItem('lat');
            window.localStorage.removeItem('lng');
            window.localStorage.setItem('lat', results[0].geometry.location.lat());
            window.localStorage.setItem('lng', results[0].geometry.location.lng());
		} else {
			alert('Geocode was not successful for the following reason: ' + status);
		}
	});
}