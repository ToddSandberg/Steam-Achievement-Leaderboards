<html>
<head>
	<title>Steam Chievos</title>
	<link rel="stylesheet" type="text/css" href="mystyle.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
	<div id="button"><a href = "help.html">Help</a></div>
    <div id="button"><a href = "http://www.toddsandberg.me">Home</a></div>
    <div id="button"><a href = "progress.php">Progress</a></div>
	<div id="title"><a href ="steamchievos.php"><h1>Steam Chievos</h1></a></div>
	<div id="foreground">
		<div id = "texty"><p>Achievement leaderboards for the games you currently own.</p></div> <br>
		<form action="steampi.php" method="get">
			64 Steam ID: 
			<input type="text" name="Steamid"><br>
			Order: <br>
			<input type="radio" name="order" value="mach" checked> Most Achieved<br>
  			<input type="radio" name="order" value="lach"> Least Achieved<br>
			Amount to show (more makes it go slower): 
			<input type="text" name="amount" maxlength="2"><br>
			<div id="sub"><input type="submit" value="Submit"></div>
		</form>
		<script>
			$(document).ready(function(){
				$("body").css("display","none")
				$("body").fadeIn();
			});
			
			$("ul").click(function(){
				$("body").fadeOut();
			});
			$("#sub").click(function(){
				document.getElementById("texty").innerHTML = "<img src=https://cdn.shopify.com/s/files/1/0272/4199/t/12/assets/loading.gif?13599287996331163410>";
			});
		</script>
		<?php
			echo "hello";
			$check = 0;
			if($check==1)
			{
		?>
				<script>
				$("#sub").click(function(){
					document.getElementById("texty").innerHTML = "<p>Achievement leaderboards for the games you currently own.</p>";
				});
				</script>
		<?php
			}
		?>
	</div>
</body>
</html>