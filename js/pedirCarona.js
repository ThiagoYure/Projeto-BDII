enviar.onclick = function(){
	var geocoder = new google.maps.Geocoder();
	var xhttp = new XMLHttpRequest();
	var origem = document.getElementById("origem").value;
	var destino = document.getElementById("destino").value;
	var data = document.getElementById("data").value;
	var origemGeom;
	var destinoGeom;
	geocoder.geocode({
		address: origem
	}, function (results, status) {
		if (status == google.maps.GeocoderStatus.OK) {

			origemGeom = results[0].geometry.location;
		}else{
			alert("Não foi possível geocodificar...");
		}

	});
	geocoder.geocode({
		address: destino
	}, function (results, status) {
		if (status == google.maps.GeocoderStatus.OK) {

			destinoGeom = results[0].geometry.location;
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("caronas").innerHTML = this.responseText;
				}
			};
			xhttp.open("POST", "buscarCarona.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("destino="+destino+"&origem="+origem+"&destinoGeom="+JSON.stringify(destinoGeom)+"&origemGeom="+JSON.stringify(origemGeom)+"&data="+data);
		}else{
			alert("Não foi possível geocodificar...");
		}

	});
}