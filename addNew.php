<?php
	$sum=0;

	if(!isset($_POST['recur']))
		$_POST['recur'] = 0;
	else{
		$_POST['recur'] = implode(',', $_POST['recur']);
	}
		
	if(!isset($_POST['date']))
		$_POST['date'] = 0;

	$c = mysql_connect('localhost','root','');

	mysql_select_db('test',$c);
	mysql_query("INSERT INTO dc_remind (`name`,`type`,`date`,`recur`,`category`) VALUES ('{$_POST['name']}',{$_POST['type']},'{$_POST['date']}','{$_POST['recur']}',{$_POST['cat']})");
	mysql_close($c);
	header("Location: index.php?added=1");
?>