<?php
	var_dump($_GET);
	// requirements
	require_once('./backend/Helper.php');
	require_once('./backend/dbaccess.php');
	require_once('./backend/databasemanager.php');
	$databaseManager = new DatabaseManager($server, $database, $user, $pass);

	// loader
	$url = HELPER::getUrl();
	if(sizeof($url) == 0) {
		// no params for url set, so must be calling domain directly, probably intenting to view the normal webpage
		require_once('default/main.php');
		exit;
	}
	if(!file_exists($url[0])) {
		// seems to have some url parameters, but not for api or docs, so must be something on the main page to call (may it be 404 in worst case)
		require_once('default/main.php');
		exit;
	}
	if($url[0] == 'docs') {
		if(sizeof($url) < 2) {
			require_once('docs/main.php');
		} else {
			require_once('docs/'.$url[1].'.php');
		}
		exit;
	}
	if($url[0] == 'api') {
		if(sizeof($url) < 2) {
			require_once('api/main.php');
		} else {
			require_once('api/'.$url[1].'.php');
		}
		exit;
	}

	// remove after debugging
	if($url[0] == 'dummy') {
		require_once('./dummy/main.php');
		exit;
	}

	// if you made it this far, you are literally FUCKED!
	echo 'Critical error occured';
?>
