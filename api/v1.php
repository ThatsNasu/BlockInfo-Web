<?php
	//filters
	$fields = array();
	$requestedOutputFormat;

	if(isset($_GET['format']) && !empty($_GET['format'])) $requestedOutputFormat = $_GET['format'];
	if(isset($_POST['format']) && !empty($_POST['format']) && empty($requestedOutputFormat)) $requestedOutputFormat = $_POST['format'];

	// append requested fields to fields array, no need to check for doublings, since the database would only return
	// the requested fields once.
	if(isset($_GET['fields']) && !empty($_GET['fields'])) {
		foreach(explode(",", $_GET['fields']) as $field) $fields[] = $field;
	}
	if(isset($_POST['fields']) && !empty($_POST['fields'])) {
		foreach(explode(",", $_POST['fields']) as $field) $fields[] = $field;
	}

	if(!isset($url[2])) die('missing parameter (table selector)');
	if(!isset($url[3])) die('missing parameter (block selector)');

	$result = $databaseManager->get($url[2], $url[3], $fields);
	if(array_key_exists('id', $result)) $result['id'] = intval($result['id']);
	if(array_key_exists('stacksize', $result)) $result['stacksize'] = intval($result['stacksize']);
	if(array_key_exists('mineable_tier', $result)) $result['mineable_tier'] = intval($result['mineable_tier']);
	if(array_key_exists('placeable', $result)) $result['placeable'] = boolval($result['placeable']);
	if(array_key_exists('mineable', $result)) $result['mineable'] = boolval($result['mineable']);
	if(array_key_exists('interactable', $result)) $result['interactable'] = boolval($result['interactable']);

	// ?format=xml
	if(isset($requestedOutputFormat) && $requestedOutputFormat == 'xml') {
		$xml = '<?xml version="1.0" encoding="utf-8"?>';
		$xml .= '<'.$url[2].'><'.$url[3].'>';
		foreach(array_keys($result) as $key) {
			$xml .= '<'.$key.'>'.$result[$key].'</'.$key.'>';
		}
		$xml .= '</'.$url[3].'></'.$url[2].'>';
		header('Content-Type: application/xml');
		echo $xml;
		exit;
	}

	// default output
	header('Content-Type: application/json; charset=utf-8');
	echo json_encode($result, JSON_PRETTY_PRINT);
	
?>