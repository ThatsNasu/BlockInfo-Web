<!DOCTYPE="html">
<html>
	<head>
		<title>
			<?php
				if(sizeof($url) > 0) {
					echo 'BlockInfo - '.ucfirst($url[sizeof($url)-1]);
				} else {
					echo 'BlockInfo - Your reliable source for minecraft block informations';
					$url[0] = 'Home';
				}
			?>
		</title>
		<link rel="preconnect" href="fonts.gstatic.com">
		<link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" crossorigin>
	</head>
	<?php
		// loading the google analytics snippet
		//require_once('./backend/analytics.html');
	?>

	<!-- Just tempoarily until i start with the overall design and outsource it in a stylesheet !-->
	<style>
		* {
			margin: 0px;
			font-family: Comfortaa;
		}
	</style>

	<body>
		you have not set any url parameters, so feel free to watch this black text indefinitly
	</body>
</html>
