<?php
session_start();
include("conexao.php");
$waypointsGeom = $_REQUEST['waypointsGeom'];
$jsonWaypointsGeom = json_decode($waypointsGeom);
$waypoints = $_REQUEST['waypoints'];
$jsonWaypoints = json_decode($waypoints);
$origem = $_REQUEST['origem'];
$destino = $_REQUEST['destino'];
$origemGeom=$_REQUEST['origemGeom'];
$destinoGeom=$_REQUEST['destinoGeom'];
$jsonOrigem = json_decode($origemGeom);
$jsonDestino = json_decode($destinoGeom);
$latOrigem = $jsonOrigem->lat;
$lngOrigem = $jsonOrigem->lng; 
$latDestino = $jsonDestino->lat;
$lngDestino = $jsonDestino->lng; 
$distancia = $_REQUEST['distancia'];
$horaChegada = $_REQUEST['tempo'];
$custo = $_REQUEST['ajuda'];
$data = $_REQUEST['data'];
$hora = $_REQUEST['hora'];
$email = $_SESSION['email'];	
if($conn != null){
	$pointDestino = "POINT($latDestino $lngDestino)";
	$pointOrigem = "POINT($latOrigem $lngOrigem)";
	$sql1 = "INSERT INTO carona (origem,destino,origemGeom,destinoGeom,data,distancia,tempo,ajuda,usuario,hora) VALUES ('$origem','$destino',ST_GeomFromText('$pointOrigem'),ST_GeomFromText('$pointDestino'),'$data','$distancia','$horaChegada','$custo','$email','$hora')";
	$result = mysqli_query($conn, $sql1);
	$contCarona = mysqli_affected_rows($conn);
	print $contCarona;
	if (!empty($jsonWaypoints)) {
		$tam = sizeof($jsonWaypoints);
		for($i = 0; $i < $tam; $i++){
			$latWaypoints = $jsonWaypointsGeom[$i]->lat;
			$lngWaypoints = $jsonWaypointsGeom[$i]->lng;
			$waypointP = "POINT($latWaypoints $lngWaypoints)";
			$waypoint = $jsonWaypoints[$i]->location;
			$sql2 = "INSERT INTO pontosdeparada (parada,usuario,paradaGeom,datacarona,horacarona) VALUES ('$waypoint','$email',ST_GeomFromText('$waypointP'),'$data','$hora')";
			$result2 = mysqli_query($conn, $sql2);
			$contWaypoint = mysqli_affected_rows($conn);
		}
	
	}
}
?>