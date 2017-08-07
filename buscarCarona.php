<?php
include("conexao.php");
session_start();
if ($conn) {
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
	$data = $_REQUEST['data'];
	$email = $_SESSION['email'];
	$pointDestino = "POINT($latDestino $lngDestino)";
	$pointOrigem = "POINT($latOrigem $lngOrigem)";
	$sql = "SELECT C.usuario,C.data,C.hora
			FROM carona C,pontosdeparada P
			WHERE C.data=P.datacarona AND C.hora=P.horacarona AND C.usuario=P.usuario
			AND C.data = '$data' AND ((ST_Distance(ST_GeomFromText('$pointOrigem'),C.origemgeom)*40075/360<=20
			OR ST_Distance(ST_GeomFromText('$pointOrigem'),P.paradaGeom)*40075/360<=20
			)) AND((ST_Distance(ST_GeomFromText('$pointDestino'),C.destinoGeom)*40075/360<=20
			OR ST_Distance(ST_GeomFromText('$pointDestino'),P.paradaGeom)*40075/360<=20
			))";
	$result = mysqli_query($conn,$sql);
	if($result === FALSE) { 
		die(mysqli_error($conn));
	}
	while ($resultado = mysqli_fetch_assoc($result)) {
		# code...
		$emailUsuario = $resultado['usuario'];
		$sql1 = "SELECT telefone, email, nome FROM usuario WHERE email = '$emailUsuario'";
		$result1 = mysqli_query($conn,$sql1);
		$resultado1 = mysqli_fetch_assoc($result1);
		print("<li class='collection-item light-blue accent-4 white-text'>
			Usuario: ".$resultado1['nome']."</br>
			Email: ".$resultado1['email']."</br>
			Telefone: ".$resultado1['telefone']."</br>
			Data da Carona: ".$resultado['data']."</br>
			Hora da Carona: ".$resultado['hora']."</br>
		</li>")	;	
	}

}else{
	print "Não foi possivel se conectar ao banco de dados...";
}
?>