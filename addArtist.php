<?php

include 'db.php';





?>

<!DOCTYPE html>

<html>

<head>

<meta charset="utf-8">

<title>Add Artist</title>

<link rel="stylesheet" type="text/css" href="css/styleSheet.css">
<script src="js/validation.js" type="text/javascript"></script>
</head>

<body>

<div class="wrapper">
		
	<div class ="mainMenu">
	
		<h1>Add Artist</h1>
	
	</div>
	
		<div class="menu content">
			<ul class="men">
				<li><a class="menList" href="index.php"> Home		</a></li>
				<li><a class="menList" href="artists.php"> Artists 	</a></li>
				<li><a class="menList" href="albums.php"> Albums	</a></li>
				<li><a class="menList" href="tracks.php"> Tracks	</a></li>
			</ul>
		<hr>
		</div><!-- end of menu -->
		
		<div class="main">
			<?php
						

			
					if(!empty($_GET['id']))
					{	
						session_start();
						$n = $_GET['id'];
						
						
						$_SESSION['sessionVar'] = $n;
						
						
						displayArtForm($n);
					}
					else
					{
						echo 	"<form  action=\"insertArtist.php\" method=\"POST\" >
								<strong>Name: </strong><input type=\"text\" name =\"addArtist\" >
								<br><br>
								<input  type=\"submit\" name=\"save\" value=\"Save\">
								<input  type=\"submit\" name=\"delete\" value=\"Delete\">
								</form>";
					}
					
					function displayArtForm($n)
					{
						include 'db.php';
						$sql = "SELECT artName FROM artist WHERE artID = ?";
						
						$stmt = $conn->prepare($sql);
						$stmt->bind_param('s', $n);
						$result = $stmt->execute();
						$stmt->bind_result($artName);
						$stmt->fetch();
						
					
					
					
			 echo "<form  action=\"insertArtist.php\" method=\"POST\" >"?>
				<strong>Name: </strong><input  type="text" name ="addArtist" value= "<?php echo htmlentities($artName);?>">
				<?php
			echo "	<br><br>
				<input  type=\"submit\" name=\"saveUpdate\" value=\"Save\">
				<input  type=\"submit\" name=\"delete\" value=\"Delete\">
				<br><br>
				
				
			</form>";
			
					}							
			?>
		
		<a href="artists.php">&#x2190 Back to Artist Index</a>
			<hr>
			
		</div><!-- end of main-->

			<div class="footer">

				<p class="italic">University of Nottingham School of Computer Science</p>
				<p class="italic">Desinged by psyms11 - 4246942</p>
				<p class="italic">&copy; <strong>2016 by Siddiq.</strong>  All Rights Reserved.</p> 
				
			</div><!-- end of footer -->
			
</div><!-- end of wrapper -->

</body>
</html>

