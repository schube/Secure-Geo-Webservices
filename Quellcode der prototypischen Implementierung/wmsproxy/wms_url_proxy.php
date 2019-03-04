<?php
include_once './common.php';




if (!isset($_SESSION['OAUTH_ACCESS_TOKEN'])) {
	$_SESSION['wmsquery'] = $_SERVER["QUERY_STRING"];
	
	$consumer = new Zend_Oauth_Consumer($configuration);
	// Guess we need to go get one!

	$token = $consumer->getRequestToken();
	$_SESSION['OAUTH_REQUEST_TOKEN'] = serialize($token);
	$_SESSION['ver']=1;

	// Now redirect user to Twitter site so they can log in and
	// approve our access
	echo '<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> </head><body style="background-color: #FFB6C1;">';
	echo "<h1>Proxydienst zum Schutz von WMS-Diensten</h1>";
	echo "Ich gewähre nur Zugriff auf den WMS-Dienst, wenn dies der AAAD [".URL_LIZENZBROKER."] erlaubt.<br />";
	echo "Sie haben keinen gültigen OAuth Access Token.<br />";
	echo "1.) Ich habe vom AAAD einen 'Unauthorized Request Token' angefordert.<br />";
	echo "2.) Sie müssen diesen Token jetzt über den AAAD authorisieren. Klicken Sie dazu auf den Link und loggen Sie sich beim AAAD ein (falls nicht schon eingeloggt).<br />";
	echo "(Ich könnte Sie auch automatisch weiterleiten, aber dann würden Sie die Prozesse im Hintergrund nicht sehen.)<br />";
	echo '<a href="'.$consumer->getRedirectUrl().'">'.$consumer->getRedirectUrl().'</a>'; ;

} else {




	// Easiest way to use OAuth now that we have an Access Token is to use
	// a preconfigured instance of Zend_Http_Client which automatically
	// signs and encodes all our requests without additional work

	$token = unserialize($_SESSION['OAUTH_ACCESS_TOKEN']);
	

	$client = $token->getHttpClient($configuration);
	$client->setUri('http://www.schubec.com/aaad/www/broker.php');
	$client->setMethod(Zend_Http_Client::POST);
	$client->setParameterPost('query', $_SERVER["QUERY_STRING"]);
	$response = $client->request();


	// Check if the json response refers to our tweet details (assume it
	// means it was successfully posted). API gurus can correct me after.

	if( $response->getStatus() == '200') {
		$data = $response->getBody();

		$xml = simplexml_load_string($data);
		$filtered_query = urldecode((String)$xml->response->query);
		$wmsclient = new Zend_Http_Client();
		$wmsclient->setMethod(Zend_Http_Client::GET);
		$wmsclient->setConfig(array('httpversion'=>'1.0'));
		//echo 'http://maps.opengeo.org/geowebcache/service/wms?' . $filtered_query;die();



		$wmsclient->setUri('http://genesis-fp7.researchstudio.at:80/geoserver/wms?' . ($filtered_query));
		$response = $wmsclient->request();
		

		$headers = split("\n", $response->getHeadersAsString(true) );

		foreach($headers as $header_line) {
			header( $header_line );
		}

		echo $response->getBody();
	} else {
		echo '<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> </head><body style="background-color: #FFB6C1;">';
	echo "<h1>Proxydienst zum Schutz von WMS-Diensten</h1>";	
		echo "AAAD hat Zugriff mit dem Token ". urldecode($token) ." nicht genehmigt. <a href='./clear.php'>Hier klicken um Session zu beenden.</a>";
	}

}

?>