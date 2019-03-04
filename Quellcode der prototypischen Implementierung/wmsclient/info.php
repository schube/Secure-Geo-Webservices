<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>WMS Client</title>
</head>
<body>
<h1>Willkommen</h1>

In dieser Demo sehen Sie:
<ul>
	<li>Zugriff auf einen WMS Service. Dieser wird Ihre Anfrage zunächst ablehnen, da er einen gültigen OAuth Token erwartet, den Sie (noch) nicht vorweisen können.</li>
	<li>Der WMS Dienst bzw. der davorgeschaltene transparente Proxy wird einen unautorisierten OAuth Zugriffstoken für Sie erzeugen.</li>
	<li>Weiterleitung zu einem Authentifzierungs, Autorisierungs- und Abrechnungsdienst (AAAD), wo Sie den unautorisierten OAuth Zugriffstoken autoriesieren müssen. Dazu können Sie sich per Username/Passwort oder OpenID beim AAAD authentifizieren.</li>
	<li>Erneuter Zugriff auf den WMS-Dienst, wobei der Zugriff aufgrund des OAuth Tokens nun erlaubt wird.</li>
	<li>Ihre WMS-Anfrage wird dabei im Hintergrund lt. Ihren Zugriffsrechten gefiltert.</li>
	<li>Jeder Zugriff wird gezählt damit eine Grundlage für die Abrechnung entsteht.</li>	
</ul>

Die Komponenten mit den jeweiligen Farbcodes zur besseren Unterscheidung:
<ul>
<li style="background-color: #98F5FF;">Endbenutzer bzw. WMS-Client</li>
<li style="background-color: #FFB6C1;">WMS-Dienst bzw. der transparente Proxy</li>
<li style="background-color: #FEF5CA;">Authentifzierungs, Autorisierungs- und Abrechnungsdienst</li>
<li>ggf. OpenID Provider (Layout/Design/Farbe individuell je nach Provider)</li>
</ul>


</body>
</html>
