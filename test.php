<?php
	include "simple_html_dom.php";
	
	
	$net_data = file_get_html("http://in.bookmyshow.com/buytickets/baahubali-the-beginning-telugu-hyderabad/movie-hyd-ET00016239-MT/20150710",False);

	$con="";

	foreach ($net_data->find(".cinhead span.bold") as $tr) {
		$con .= " ".$tr->plaintext;
	};
	if(preg_match("/pvr/i", $con) == 1)
		echo "book";
    else
      	echo "not yet";
?>
