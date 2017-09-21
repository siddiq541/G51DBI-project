<?php

include 'db.php';

	
?>


<!DOCTYPE html>

<html>

<head>

<meta charset="utf-8">

<title>Home</title>

<link rel="stylesheet" type="text/css" href="css/styleSheet.css">

</head>

<body>

<div class="wrapper">
		
	<div class ="mainMenu">
	
		<h1>HOME</h1>
	
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
			
			<h2>Database Metrics</h2>
			
			<ul class="subList">
				<li> Number of Artists:	<?php include 'insertArtist.php'; countArt();?>
				
				</a></li>
				<li> Number of CDs:	<?php   countCd();?>	</a></li>
				<li> Number of Tracks:<?php CountTrack();?>	</a></li>
			</ul>
		
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

