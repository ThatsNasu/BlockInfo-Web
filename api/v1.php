<?php
	//filters
	$fields = array();
	$requestedOutputFormat;

	if(isset($_GET['format']) && !empty($_GET['format'])) $requestedOutputFormat = $_GET['format'];
	if(isset($_POST['format']) && !empty($_POST['format']) && empty($requestedOutputFormat)) $requestedOutputFormat = $_POST['format'];

	// append requested fields to fields array, no need to check for doublings, since the database would only return
	// the requested fields once.
	if(isset($_GET['fields']) && !empty($_GET['fields'])) array_push($fields, explode(",", $_GET['fields']));
	if(isset($_POST['fields']) && !empty($_POST['fields'])) array_push($fields, explode(",", $_POST['fields']));

	if(!isset($url[3])) $url[3] = "*";
	
	$result = $databaseManager->get($url[2], $url[3], $fields);
	var_dump($result);
	echo '<br /><br />';

	foreach($result as $block) {
		if(array_key_exists('id', $block)) $block['id'] = intval($block['id']);
		if(array_key_exists('stacksize', $block)) $block['stacksize'] = intval($block['stacksize']);
		if(array_key_exists('mineable_tier', $block)) $block['mineable_tier'] = intval($block['mineable_tier']);
		if(array_key_exists('placeable', $block)) $block['placeable'] = boolval($block['placeable']);
		if(array_key_exists('mineable', $block)) $block['mineable'] = boolval($block['mineable']);
		if(array_key_exists('interactable', $block)) $block['interactable'] = boolval($block['interactable']);
	}
	var_dump($result);

	// ?format=xml
	if((isset($_GET['format']) && !empty($_GET['format']) && $_GET['format'] == 'xml') || (isset($_POST['format']) && !empty($_POST['format']) && $_POST['format'] == 'xml')) {
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
	//header('Content-Type: application/json; charset=utf-8');
	echo json_encode($result, JSON_PRETTY_PRINT);
	
?>