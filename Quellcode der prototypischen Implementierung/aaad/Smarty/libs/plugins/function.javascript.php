<?php
function smarty_function_javascript($params, &$smarty)
{
    
	
	if(empty($params['file']))
		throw new Exception('[file] parameter missing');
	
	$javascripts = Javascripts::getInstance();
	if($params['repository']=='global') {
		$javascripts->addJavascript($params['file'], $smarty->_tpl_vars['guiurl'].'/portal/javascripts');
	} else {
		$javascripts->addJavascript($params['file'], $smarty->_tpl_vars['javascripturl']);
	}
}



?>
