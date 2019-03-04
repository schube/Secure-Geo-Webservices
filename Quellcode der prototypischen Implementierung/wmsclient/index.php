<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>WMS Client</title>


<script type="text/javascript">

function openUrlInIFrame(url) {

iframe = document.getElementById('iframe');

iframe.src = url;

}
//-->
</script>


</head>
<body style="background-color: #98F5FF;">
<h1>WMS Client</h1>
<form>WMS Abfrage per URL: <input type="text"
	value="http://fm-training.info/wmsproxy/wms_url_proxy.php?SERVICE=WMS&LAYERS=tiger-ny&FORMAT=image/png&transparent=true&REQUEST=GetMap&BBOX=-74.03273,40.6987,-73.92765,40.80657&WIDTH=860&HEIGHT=883&STYLES=,&SRS=EPSG:4326&VERSION=1.3.0"
	size="110" id="url" /> <input onClick="openUrlInIFrame(document.getElementById('url').value); return false;" type="button" value="WMS abrufen" />
	<br /><br />
	<input onClick="openUrlInIFrame('http://www.schubec.com/aaad/www/index.php'); return false;" type="button" value="AAAD aufrufen" />
	<input onClick="openUrlInIFrame('./clear_client_session.php'); return false;" type="button" value="Session des WMS Clients beenden" />	
	<input onClick="openUrlInIFrame('http://fm-training.info/wmsproxy/clear.php'); return false;" type="button" value="Session des WMS Proxys beenden" />		
	</form>
	<br />
<iframe src="info.php" id="iframe" width="100%" height="70%" style="background-color: white;"></iframe>



</body>
</html>
