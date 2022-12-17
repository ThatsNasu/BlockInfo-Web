<?php
	$requestedFields = (isset($_GET['fields']) && $_GET['fields'] != NULL) ? explode(",", $_GET['fields']) : NULL;
	$result = $databaseManager->get($url[2], $url[3], $requestedFields);
	if(array_key_exists('id', $result)) $result['id'] = intval($result['id']);
	if(array_key_exists('stacksize', $result)) $result['stacksize'] = intval($result['stacksize']);
	if(array_key_exists('mineable_tier', $result)) $result['mineable_tier'] = intval($result['mineable_tier']);
	if(array_key_exists('placeable', $result)) $result['placeable'] = boolval($result['placeable']);
	if(array_key_exists('mineable', $result)) $result['mineable'] = boolval($result['mineable']);
	if(array_key_exists('interactable', $result)) $result['interactable'] = boolval($result['interactable']);

	// ?format=xml
	if(isset($_GET['format']) && !empty($_GET['format']) && $_GET['format'] == 'xml') {
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