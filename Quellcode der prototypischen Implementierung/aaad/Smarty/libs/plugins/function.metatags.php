<?php
function smarty_function_metatags($params, &$smarty)
{
    
	$metatags = Metatags::getInstance();
	foreach($params as $key=>$value) {
		switch($key) {
			case 'keyword':
				$metatags->addKeyword($value);
				break;
			case 'title':
				$metatags->setTitle($value);
				break;
			case 'refresh':
				$metatags->setRefresh($value);
				break;				
			case 'description':
				$metatags->setDescription($value);
				break;
		}
		
	}
}



?>
