<!DOCTYPE="html">
<html>
	<head>
		<title>
			<?php
				$url = HELPER::getUrl();
				if(sizeof($url) > 0) {
					echo 'BlockInfo - '.$url[sizeof($url)-1];
				} else {
					echo 'BlockInfo - Your reliable source for minecraft block informations';
					$url[0] = 'Home';
				}
			?>
		</title>
		<link rel="preconnect" href="fonts.gstatic.com">
		<link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" crossorigin>
		<link rel="stylesheet" href="./default/style/index.css">
	</head>
	<?php
		// loading the google analytics snippet
		//require_once('./backend/analytics.html');
	?>

	<body>
		<header>
			<span>BlockInfo</span>
		</header>
		<nav>
			<?php
				require_once('./default/frames/Navigation.php');
			?>
		</nav>
		<div class="content">
			<?php
				$pathbuilder = './default/pages';
				foreach($url as $value) {
					$pathbuilder .= '/'.$value;
				}
				if(file_exists($pathbuilder.'.php')) {
					require_once($pathbuilder.'.php');
				} elseif(file_exists($pathbuilder.'.html')) {
					require_once($pathbuilder.'.html');
				} else {
					require_once('./pages/404.html');
				}
			?>
		</div>
		<footer>
			<?php
				require_once('./default/frames/Footer.php');
			?>
		</footer>
	</body>
</html>
