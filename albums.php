<?php

include 'db.php';

?>

<!DOCTYPE html>

<html>

<head>

<meta charset="utf-8">

<title>Albums</title>

<link rel="stylesheet" type="text/css" href="css/styleSheet.css">

</head>

<body>

<div class="wrapper">
		
	<div class ="mainMenu">
	
		<h1>ALBUMS</h1>
	
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
			
			<form class="searchBarForm" method = "POST">
				<input class = "search" type="text" name ="query" placeholder="Search">
				
			</form>
			<?php
			if(isset($_POST['query']))  	
				{  
				include 'form.php';
				$title=$_POST['query'];  

				SearchAlbum($title);
				}
				else if (!empty($_GET['id']))
				{
					include 'form.php';
					SearchAlbum($_GET['id']);
				}
			
				else 
					
				{
					include 'form.php';
				   SearchAlbum('');
				   
				}
				?>
				
			
			<a href="addCd.php"> Add CD</a>			
		
			<hr>
			
		</div><!-- end of main-->

			<div class="footer">

				<p class="italic">University of Nottingham School of Computer Science</p>
				<p class="italic">Desinged by psyms11 - 4246942</p>
				<p class="italic">&copy; Copyright <strong>2016 by Siddiq.</strong>  All Rights Reserved.</p> 
				
			</div><!-- end of footer -->
			
</div><!-- end of wrapper -->

</body>
</html>
