<?php
	include "simple_html_dom.php";
	$aContext = array(
	    'http' => array(
	        'proxy' => 'tcp://10.3.100.209:8080',
	        'request_fulluri' => true,
	    ),
	);
	$cxContext = stream_context_create($aContext);

	$net_data = file_get_html($_POST['url'],False, $cxContext);

	
	$net_latest = $net_data->find($_POST['sel'],$_POST['index']);
	
	echo htmlentities($net_latest->innertext);
?>
