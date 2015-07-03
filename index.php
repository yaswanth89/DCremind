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
					<li  class="active"><a href="#">Add new Subscription</a></li>
					<li><a href="#">Add new source</a></li>
				</ul>
			</div>
		</div>
    </header>
    <div class="container">
    	
		<form class="form-horizontal" role="form" action="addNew.php" method="POST">
			<div class="form-group">
				<label for="name" class="col-sm-2 control-label">Name</label>
				<div class="col-sm-10">
			    	<input type="text" name="name" id="name" placeholder="name" /><br />
			    </div>
			</div>
			<div class="form-group">
				<label for="cat" class="col-sm-2 control-label">category</label>
				<div class="col-sm-10">
			    	<select name="cat" id="cat">
			    		<option value="0">TV/Docu/Movie</option>
						<option value="1">anime</option>
						<option value="2">book</option>
						<option value="3">game</option>
						<option value="4">music</option>
						<option value="5">sports</option>
						<option value="6">telugu</option>
			    	</select>
			    </div>
			</div>
			<div class="form-group">
				<label for="type" class="col-sm-2 control-label">Type</label>
				<div class="col-sm-10">
			    	<select type="type" name="type" id="type">
						<option value="0">Once</option>
						<option value="1">Recurring</option>
					</select>
			    </div>
			</div>
			<div class="form-group" >
				<label for="date" class="col-sm-2 control-label">Date</label>
				<div class="col-sm-10">
			    	<input type="date" id="date" name="date" />
			    </div>
			</div>
			<div id="recur" class="form-group hidden">
				<div class="col-sm-10 col-sm-offset-2">
					<div class="checkbox">
						<label>
					    	<input type="checkbox" name="recur[]" value="1"/>Monday
						</label>
					</div>
					<div class="checkbox">
						<label>
					    	<input type="checkbox" name="recur[]" value="2"/>Tuesday
						</label>
					</div>
					<div class="checkbox">
						<label>
					    	<input type="checkbox" name="recur[]" value="3"/>Wednesday
						</label>
					</div>
					<div class="checkbox">
						<label>
					    	<input type="checkbox" name="recur[]" value="4"/>Thursday
						</label>
					</div>
					<div class="checkbox">
						<label>
					    	<input type="checkbox" name="recur[]" value="5"/>Friday
						</label>
					</div>
					<div class="checkbox">
						<label>
					    	<input type="checkbox" name="recur[]" value="6"/>Saturday
						</label>
					</div>
					<div class="checkbox">
						<label>
					    	<input type="checkbox" name="recur[]" value="0"/>Sunday
						</label>
					</div>
				</div>
			</div>
			<div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			    	<button type="submit" class="btn btn-default">Add new</button>
			    </div>
		  	</div>
		</form>
		<?php
			if(isset($_GET['added']))
				echo "<div class='alert alert-success'>Entry Added</div>";
		?>
    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jq.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
    	$(document).ready(function(){
    		$("#type").change(function(){
    			$("#once").toggleClass("hidden");
    			$("#recur").toggleClass("hidden");
    		});
    	});
    </script>
</body>
</html>