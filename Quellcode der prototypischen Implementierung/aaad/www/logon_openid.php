<?php

/**
 * oauth-php: Example OAuth server
 *
 * Simple logon for consumer registration at this server.
 *
 * @author Arjan Scherpenisse <arjan@scherpenisse.net>
 *
 *
 * The MIT License
 *
 * Copyright (c) 2007-2008 Mediamatic Lab
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

require_once '../core/init.php';




function getUserId($openid) {
	$store = OAuthStore::instance();
	$result = $store->getUserIdByOpenid($openid);

	if($result==false) {
		return false;
	} else {
		return $result['user_id'];
	}
}


$status = "";
$auth = Zend_Auth::getInstance();
//print_r($_REQUEST);
if (( isset($_POST['openid_action']) && $_POST['openid_action'] == "login" && !empty($_POST['openid_identifier'])) || isset($_GET['openid_mode']) || isset($_POST['openid_mode'])) {



	$extension=new Zend_OpenId_Extension_Sreg(array(
    'nickname'=>true,
    'email'=>true,
    'fullname'=>false), null, 1.1);
	$result = $auth->authenticate(	new Zend_Auth_Adapter_OpenId(@$_POST['openid_identifier'], null, null, null, $extension));
	//print_r($result);
	if ($result->isValid()) {

		$status = "Sie sind per OpenID angemeldet als "
		. $auth->getIdentity()
		. "<br>\n";


		$data = $extension->getProperties();
		foreach($data as $k=>$v) {
			$status.= "$k => $v <br />";
		}

		$status.= "<br />Prüfung, ob Sie auch als lokaler User angelegt sind.<br />";

		$user_id = getUserId($auth->getIdentity());
		if ( $user_id > 0 )
		{
			$_SESSION['authorized'] = true;
			$_SESSION['user_id'] = $user_id;

		if (!empty($_SESSION['goto']))
		{
			$goto = $_SESSION['goto'];
			unset($_SESSION['goto']);
			$status.= 'Sie sind nun eingeloggt und können den unautorisierten Zugriffstoken autorisieren, indem Sie auf diesen Link klicken:<br /> <a href="'.$goto.'">'.$goto.'</a><br /><br />';
			
		}
			





			$status.= "Logon succesfull.<br />";


		} else {
			$status.= "OpenID User nicht in lokaler DB vorhanden! <b>Damit der User verwendet werden kann, muss dieser erst lokal registriert werden.</b><br />";
		}

		$smarty = session_smarty();
		$smarty->assign('content',$status );
		$smarty->display('template.tpl');



		echo "<a href='./index.php'>Startseite</a>";

	} else {
		$auth->clearIdentity();
		foreach ($result->getMessages() as $message) {
			$status .= "$message<br>\n";
		}
		echo $status;
		echo "<a href='./index.php'>Startseite</a>";
	}
} else if ($auth->hasIdentity()) {
	echo "Bereits angemeldet als: ".$auth->getIdentity()."<br />";
	echo "<a href='./index.php'>Startseite</a>";

} else {
	$smarty = session_smarty();
	$smarty->display('logon_openid.tpl');


}


?>