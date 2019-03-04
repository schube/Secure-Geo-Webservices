{include file='inc/header.tpl'}


{$user.username}

Readfilter:<br />
<textarea rows="30" cols="150">
{$user.read_filter|escape:'html'}
</textarea>

<br /><br />

Writefilter:<br />
<textarea rows="30" cols="150">
{$user.write_filter|escape:'html'}
</textarea>

{include file='inc/footer.tpl'}