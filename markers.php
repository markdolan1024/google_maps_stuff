<?php
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
	header('Access-Control-Allow-Headers: Content-Type, x-prototype-version, x-requested-with');

	$mysqli = new mysqli("localhost", "Maps", "googleMaps", "googlemaps");
	$result = '{"success":false}';
	$query = "SELECT * FROM sites";
	$dbresult = $mysqli->query($query);
	$markers = array();

	while($row = $dbresult->fetch_array(MYSQLI_ASSOC)){
		$markers[] = array(
			'id' => $row['id'],
			'name' => $row['name'],
			'lat' => $row['lat'],
			'lng' => $row['lng']
		);
	}

	if($dbresult){
		$result = '{"success":true, "markers":' . json_encode($markers) . '}';
	}else{
		$result = '{"success":false}';
	}

	echo($result);
?>
