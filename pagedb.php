<?php
	include "simple_html_dom.php";

	function latestDcAdd($name){

		$dc_data = file_get_html("http://10.109.1.9/latest/get_latest.php?q=".urlencode(trim(strtolower($name))));

		$latest = $dc_data->find("table span",0);

		return $latest->innertext;
	}

	$t= date('G:i D j M');
	date_default_timezone_set('Asia/Kolkata');
	$w = date('w');
	$d = date('Y-m-d');

	$c = mysql_connect('localhost','root','');

	mysql_select_db('test',$c);
	$r=mysql_query("SELECT * FROM dc_remind WHERE  `recur` REGEXP '{$w}' AND `date`<'{$d}'");
	$l=mysql_query("SELECT * FROM dbsource");
	mysql_close($c);
	$g=0;
	while($links[$g] = mysql_fetch_array($l)){
		$g++;
	}
?>
<html>
<head>
	<title>To Download</title>
	<!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
    	audio{
    		display: none;
    	}
    	.main{
    		width: 593px;
    	}
    </style>

    <script type="text/javascript">
    	window.done = [];
    </script>
</head>
<body>
	<audio id="audio"><source src="jack_sparrow.wav" type="audio/wav"></audio>
	<header class="navbar navbar-default navbar-static-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">Dc Remainder</a>
			</div>

			<div class="collapse navbar-collapse" >
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">Home</a></li>
					<li><a href="index.php">Add new Subscription</a></li>
				</ul>
				<div class="col-sm-5">
					<form class="navbar-form navbar-left" role="search" action="search.php" method="GET">
				        <div class="input-group">
						    <input type="text" name="s" placeholder="Search" class="form-control input-sm">
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
 		<table class="table table-hover table-condensed">
			<thead>
				<th>Name</th>
				<th>Links</th>
				<th>DC Latest on</th>
			</thead>
			<tbody>
				<?php
					$j=1;
					while ($result = mysql_fetch_array($r)) {
						echo "<tr><td>{$result['name']} <br/><button id='stp{$j}' class='btn btn-xs btn-success' onclick=\"start('{$j}')\">Check All</button> <button id='stp{$j}' class='btn btn-xs btn-danger' onclick=\"stop('{$j}')\">Stop</button></td><td class='main'>";
						echo "<button class='btn btn-xs' data-toggle='button' onclick='disp(this);'>Show</button><table class='table table-condensed hidden'><thead><tr><th>Link</th><th></th><th>HDTV</th><th>720p</th></tr></thead>";
						for($k=0;$k<$g;$k++){
							$link=$links[$k];
							if($link['cat']==$result["category"]){
								$i = $link['id'];
								$linka = urlencode(trim(strtolower($result['name'])));
								echo "<tr><td><a target='_blank' href='{$link['link']}{$linka}'>{$link['name']}</a></td>";
								echo "<td><button class='btn btn-info btn-xs ' id='btn{$j}_{$i}' onclick=\"checkStat('{$link['link']}{$linka}','{$j}_{$i}',$(this),'".mysql_escape_string($link['extract'])."',0);\">check</button></td><td id='datahd{$j}_{$i}'></td><td id='data7{$j}_{$i}'></td></tr>";
							}
						}
						echo "</table></td>";

						$la = latestDcAdd($result['name']);

						echo "</td><td>".$la."</td></tr>";
						$j++;
					}
				?>
				<tr><td><button class="btn btn-xs btn-primary" onclick="startAll();">Sart All</button></td></tr>
			</tbody>
		</table>
	</div>
	<script src="js/jq.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">

		function checkStat($url,index,button,ext,rec){
			if (window.done[index.split('_')[0]][0] == true && window.done[index.split('_')[0]][1] == true)
				return;
			button.html('checking...');
			$.post('dbtest.php',{url:$url,sel:ext},function(data){
				var uphd = $("#datahd"+index);
				var up7 = $("#data7"+index);
				
				data=data.replace(/\./gm,' ');

				data = data.split("jingleMaMa");
				
				if(window.done[index.split('_')[0]][1]==false){
					if(up7.html()!=''){
						if(up7.html()!=data[0]){
							document.getElementById('audio').play();
							up7.toggleClass("success");
							up7.parents('.main').toggleClass('success');
							window.done[index.split('_')[0]][0] = true;
						}
					}
					up7.html(data[0]);
				}
				if(window.done[index.split('_')[0]][1]==false){
					if(uphd.html()!=''){
						if(uphd.html()!=data[1]){
							document.getElementById('audio').play();
							uphd.addClass("success");
							uphd.parents('.main').addClass('success');
							window.done[index.split('_')[0]][1] = true;

						}
					}
					uphd.html(data[1]);
				}
				button.html('check');
				setTimeout(function(){checkStat($url,index,button,ext,1)},30000);
			}).fail(function() {
			    button.html('check');
				setTimeout(function(){checkStat($url,index,button,ext,1)},30000);
			});
			return false;
		}
		function stop(id){
			window.done[id][0] = true;
			window.done[id][1] = true;
		}
		function disp(el){
			$(el).next().toggleClass('hidden');
		}
		function start(id) {
			window.done[id]=[];
			window.done[id][0] = false;
			window.done[id][1] = false;
			$("[id^=btn"+id+"_]").click();
		}
		function startAll(){
			for(var i=0; i<<?php echo $j?>;i++){
				window.done[i]=[];
				window.done[i][0] = false;
				window.done[i][1] = false;
			}
			$("[id^=btn]").click();
		}
    </script>
    <!-- HTML to write -->

</body>
</html>