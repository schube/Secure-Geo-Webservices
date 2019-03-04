{include file='inc/header.tpl'}

<h1>Login mit Benutzername / Passwort</h1>

<form method="post">
    

    <label for="username">Benutzername:</label><br />
    <input type="text" name="username" id="username" value="schube" />
    
    <br /><br />

    <label for="password">Passwort:</label><br />
    <input type="text" name="password" id="password" value="schube" />

    <br /><br />
    
    <input type="submit" value="Login" />
</form>

{include file='inc/footer.tpl'}
