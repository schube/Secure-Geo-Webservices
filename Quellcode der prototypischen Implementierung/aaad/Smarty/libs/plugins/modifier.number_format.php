<?php


function smarty_modifier_number_format($number, $decimals=2, $dec_point=".", $thousands_sep=",")
{
    if($number!='') {
	return number_format($number, $decimals, $dec_point, $thousands_sep);
	} else {
		return '';
	}
}



?>