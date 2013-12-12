<?php
	include 'init.php';
	include 'language.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- General Metas -->
	<meta charset="utf-8">
	<title><?php echo $index_title ?></title>
	<meta name="description" content="">
	<meta name="author" content="Erwan">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/base.css">
	<link rel="stylesheet" href="css/layout.css">

	<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
	<link rel="shortcut icon" href="/favicon.ico">
	<link rel="apple-touch-icon" href="/apple-touch-icon.png">
</head>

<body>
	

		<?php
			/* Display warning messages	*/
			if($error) echo '	<div class="notice">
									<a href="" class="close">close</a>
									<p class="warn">' . $errorMSG . '</p>
								</div>';
		?>

		<!-- start #block -->
		<div class="block">
			
				
				<!-- start #connect -->
				<div class="connect">
					
						<form action="index.php" method="post">
							<h2><?php echo $index_title ?></h2>
							
								<p class="flags">
									<a href="?lang=fr"><img src="./img/fr.jpg" width="16" height="11" alt="Français"></a>
									<a href="?lang=en"><img src="./img/en.jpg" width="16" height="11" alt="English"></a>
									<a href="?lang=sp"><img src="./img/sp.jpg" width="16" height="11" alt="Español"></a>
										
								</p>
								
								<!-- Display the login if the cookie is set -->
								<?php
									echo	'<p>
												<input type="text" name="login" placeholder="login" 
												value="' . $login . '">
											</p>'
								?>

							<label>
								<input type="checkbox" name="remember" checked/>
								<span><?php echo $index_remember ?></span>
							</label>
							
							<input type="submit" name="connect" value="">
						</form>
						
				</div>
				<!-- end #connect -->
				
				
		</div>
		<!-- end #block -->
		
</body>
</html>
