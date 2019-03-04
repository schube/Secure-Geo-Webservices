{include file='inc/header.tpl'}


<h1>Login mit OpenID</h1>

<form method="post">
    
	<input type="hidden" name="openid_action" value="login" />

    <label for="openid_identifier">OpenID:</label><br />
    <input type="text" name="openid_identifier" id="openid_identifier" value="http://schubec.myopenid.com/" size="50" />
    <br /><br />
    
    <input type="submit"  value="Login with OpenID">
</form>
{include file='inc/footer.tpl'}
