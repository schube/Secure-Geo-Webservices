<?php
// include some common code

include_once './common.php';


// Someone's knocking at the door using the Callback URL - if they have
// some GET data, it might mean that someone's just approved OAuth access
// to their account, so we better exchange our current Request Token
// for a newly authorised Access Token. There is an outstanding Request Token
// to exchange, right?

if (!empty($_GET) && isset($_SESSION['OAUTH_REQUEST_TOKEN'])) {
	$consumer = new Zend_Oauth_Consumer($configuration);
    $token = $consumer->getAccessToken($_GET, unserialize($_SESSION['OAUTH_REQUEST_TOKEN']));
    $_SESSION['OAUTH_ACCESS_TOKEN'] = serialize($token);


    // Now that we have an Access Token, we can discard the Request Token
    // Keep on eye on gathering RTs in real life which are never used.

    $_SESSION['OAUTH_REQUEST_TOKEN'] = null;

    

    // With Access Token in hand, let's try accessing the client again
	echo '<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> </head><body style="background-color: #FFB6C1;">';
	echo "<h1>Proxydienst zum Schutz von WMS Diensten</h1>";	
	echo "Vielen Dank! Ich habe den autorisierten Requesttoken erhalten und ihn gegen einen Access-Token eingetausch.<br />";
	echo "Damit kann ich nun Abfragen beim AAAD in Ihrem Namen machen.<br />";
	echo "Sie können nun Ihre ursprüngliche WMS Abfrage durchführen: <br />";
	$query = $_SESSION['wmsquery'];
	echo "<a href='./wms_url_proxy.php?$query'>$query</a>";
    
} else {

    // Mistaken request? Some malfeasant trying something?
    exit('Error: Invalid callback request.');
}