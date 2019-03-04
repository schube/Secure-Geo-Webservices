<?php
// include some common code

include_once './common.php';
		echo '<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> </head><body style="background-color: #FFB6C1;">';
		echo "<h1>Proxydienst zum Schutz von WMS Diensten</h1>";	


// Clear the Access Token to force the OAuth protocol to rerun

$_SESSION['OAUTH_ACCESS_TOKEN'] = null;


echo "Session cleared";