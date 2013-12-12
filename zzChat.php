<?php
include 'functions.php';

session_start();

if( isntAuth()) 
		header('location:index.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame 
       Remove this if you use the .htaccess -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
	<title>zzChat</title>
	
  <meta name="description" content="">
  <meta name="author" content="Erwan">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">
  
  
  <script type="text/javascript" src="./js/jquery.js"></script>
  <script type="text/javascript" src="./js/zzChat.js"></script>
</head>

<body>
	
	<!-- start #page -->
	<div id="page">
		
		<!-- start #header -->
		<div id="header">
				<?php welcome($_SESSION["login"]); ?>
		</div><!-- #header -->


		<!-- start #block -->
		<div id="block">

			<!-- start #right -->
			<div id="right">

				<!-- start #online -->
				<div id="online">
					<p></p>
				</div>
				<!-- end #online -->

			</div>
			<!-- end #right -->



			<!-- start #container -->
			<div id="container">
				
				
				<!-- start #textArea -->
				<div id="textArea">
				</div>
				<!-- end #textArea -->		
						
				
				<!-- start #msgArea -->
				<div id="msgArea">
					<form id="form_msg" action="" method="post">
						<input type="text" name="msg" id="msg" maxlength="150" autocomplete="off"></input><input id="send" type="submit" value="Envoyer" />
					</form>
				</div>
				<!-- end #msgArea -->
			
			
			</div>
			<!-- end #container -->
			


		</div>
		<!-- end #block -->
		
	</div>
	<!-- end #page -->


</body>
</html>
