<?php
function smarty_function_stylesheet($params, &$smarty)
{
    
	
	if(empty($params['file']))
		throw new Exception('[file] parameter missing');
	
	$stylesheets = Stylesheets::getInstance();
	if($params['repository']=='global') {
		$stylesheets->addStylesheet($params['file'], $smarty->_tpl_vars['guiurl'].'/portal/stylesheets');
	} else {
		$stylesheets->addStylesheet($params['file'], $smarty->_tpl_vars['cssurl']);
	}
}



?>
