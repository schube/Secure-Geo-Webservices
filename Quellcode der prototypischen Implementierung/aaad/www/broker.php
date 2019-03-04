<?php
session_start();


require '../core/init.php';


function writeLog($the_string) {
	if( $fh = @fopen( "../log/logfile.txt", "a+" ) ) {
		fputs( $fh, $the_string, strlen($the_string) );
		fclose( $fh );
	} else {
		throw new Exception("Error writing logfile");
	}
}

$authorized = false;

$server = new OAuthServer();
try
{
	if ($server->verifyIfSigned())
	{
		$authorized = true;
	}
}
catch (OAuthException2 $e)
{
	header('HTTP/1.1 401 Unauthorized');
	header('Content-Type: text/plain');
	echo "OAuth Verification Failed: " . $e->getMessage();
	die;
}

if (!$authorized)
{
	header('HTTP/1.1 401 Unauthorized');
	header('Content-Type: text/plain');
	echo "OAuth Verification Failed.";
	die;
}

// From here on we are authenticated with OAuth.
$userid = $server->getUserId();

writeLog("User: ". $userid. "; Query: ". $_REQUEST['query']."\r\n");

$store  = OAuthStore::instance();

$store->changeUserCredits($userid,-1); //1 EUR pro Request vom Guthaben abziehen
$user = $store->getUserDetails($userid);
if ($user['credit'] < 0 ) {
	header('HTTP/1.1 401 Unauthorized');
	header('Content-Type: text/plain');
	echo "No more credit left.";
	die;

}

$filtered_query = $_REQUEST['query'] . '&filter='.urlencode( $user['read_filter'] );


header('Content-type: text/xml');





?>
<xml>
<response>
<query type="wms"><?= urlencode($filtered_query);?>
</query>
</response>
</xml>