{include file='inc/header.tpl'}


<h1>Zugriff verweigert</h1>

Sie sind nicht eingeloggt. Wie möchten Sie sich nun einloggen?

<ul>
	<li><a href="./logon_user_pw.php?goto={$goto|urlencode}">Mit Benutzername und Passwort einloggen</a></li>
	<li><a href="./logon_openid.php?goto={$goto|urlencode}">Mit OpenID einloggen</a></li>

</ul>


{include file='inc/footer.tpl'}
