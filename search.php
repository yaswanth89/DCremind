<?php
	
	$t= date('G:i D j M');

	$c = mysql_connect('localhost','root','');
	mysql_select_db('test',$c);
	$l=mysql_query("SELECT * FROM sources");
	mysql_close($c);

	include "simple_html_dom.php";
	$aContext = array(
	    'http' => array(
	        'proxy' => 'tcp://10.3.100.209:8080',
	        'request_fulluri' => true,
	    ),
	);

	$cxContext = stream_context_create($aContext);

	while($link = mysql_fetch_array($l)){
		$net_data = file_get_html($link['link'].urlencode(trim(strtolower($_GET['s']))),False, $cxContext);
		for($i=0;$i<10;$i++){
			try{
				$net_latest[$link['name']][$i] = $net_data->find($link['extract'],$i)->outertext;
			}
			catch(Exception $e){
				//null
			}
		}
	}
?>
<html>
<head>
	<title>DC remind</title>
	<!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
    	table a h2 {
    		font-size: 1em;
    		margin: auto;
    	}
    </style>
</head>
<body>
	<header class="navbar navbar-default navbar-static-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">Dc Remainder</a>
			</div>
			
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-8">
				<ul class="nav navbar-nav">
					<li><a href="page.php">Home</a></li>
					<li><a href="index.php">Add new Subscription</a></li>
					<li><a href="#">Add new source</a></li>
				</ul>
				<div class="col-sm-5">
					<form class="navbar-form navbar-left" role="search" action="search.php" method="GET">
				        <div class="input-group">
						    <input type="text" name="s" placeholder="Search" class="form-control input-sm" value="<?php echo $_GET['s']; ?>">
						    <span class="input-group-btn">
						        <button type="submit" class="btn btn-default" > <span class="glyphicon glyphicon-search"></span> </button>
						    </span>
						</div>
				    </form>
				</div>
				<ul class="nav navbar-nav pull-right">
					<li class="active"><a href="#"><?php echo $t ?></a></li>
				</ul>
			</div>
		</div>
    </header>
	<div class="container">
		<div class="row">
			<?php foreach ($net_latest as $key => $value): ?>
				<div class="col-sm-6">
					<table class="table table-hover table-condensed">
						<tr><th><?php echo $key; ?></th></tr>
						<?php foreach ($value as $title) {
							echo "<tr><td>{$title}</td></tr>";
						} ?>
					</table>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jq.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
    	$(window).load(function() {
    		setTimeout(function(){
    			location.reload();
    		},60000)
    	});
    </script>
</body>
</html>