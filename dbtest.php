<?php
	include "simple_html_dom.php";
	$aContext = array(
	    'http' => array(
	        'proxy' => 'tcp://10.3.100.211:8080',
	        'request_fulluri' => true,
	    ),
	);
	$cxContext = stream_context_create($aContext);

	$net_data = file_get_html($_POST['url'],False, $cxContext);

	$ch=0;
	foreach ($net_data->find($_POST['sel']) as $tr) {
		$con = $tr->plaintext;
		if(strpos($con,'720p') !== false){
			if(!isset($l720p)){
				$l720p = $con;
			}
		}
		elseif(!isset($lhd)){
			$lhd = $con;
		}
		else
			if(isset($l720p))
				break;
	};
	echo $l720p;
	echo "jingleMaMa";
	echo $lhd
?>
