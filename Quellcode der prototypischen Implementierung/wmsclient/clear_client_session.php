<?php
session_start();
if(session_destroy()) {
	$result = "Session erfolgreich beendet.";
} else {
	$result = "Fehler, Session konnte nicht beendet werden.";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>WMS Client</title>
</head>
<body style="background-color: #98F5FF;">
<h1><?= $result; ?></h1>
</body>
</html>
