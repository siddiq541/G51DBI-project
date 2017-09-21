<?php

include 'db.php';





?>

<!DOCTYPE html>

<html>

<head>

<meta charset="utf-8">

<title>Add CD</title>

<link rel="stylesheet" type="text/css" href="css/styleSheet.css">
<script src="js/validation.js" type="text/javascript"></script>
</head>

<body>

<div class="wrapper">
		
	<div class ="mainMenu">
	
		<h1>Add CD</h1>
	
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
			echo "<table class=\"display\">";
			 
					
					if(!empty($_GET['id']))
					{	
						session_start();
						$n = $_GET['id'];
						
						
						$_SESSION['cdID'] = $n;
						
						
						displayCDForm($n);
					}
					else
					{
						echo
							"<form class=\"\" action=\"insertArtist.php\" method=\"POST\">
						
								<tr>
									<td><strong>Title: </strong></td>
									<td><input  type=\"text\" name =\"addCdTitle\" ></td>
								</tr>";
		?>
								
								<tr>
									<td><strong>Artist: </strong></td>
									<td><select name ="selectArtist" >
						
						
						<?php
						$sql = "SELECT artName FROM artist ORDER BY artName ASC";
						$stmt = $conn->prepare($sql);
						$stmt->execute();
						$stmt->bind_result($artName);
						
						
						while ($stmt->fetch()) {
						?>
						
							<option  value="<?php echo htmlentities($artName); ?>"><?php echo htmlentities($artName); ?></option>
						
					<?php
						}
					
					?>	</select></td>
					
					</tr>	
					<?php
					echo "	<td><strong>Genre: </strong></td>
						<td><input  type=\"text\" name =\"addGenre\" ></td>
					<tr>
					
						<td><strong>Price: </strong></td>
						<td><input  type=\"text\" name =\"addPrice\" ></td>
					</tr>
					
					<tr>	
						<td><strong>Tracks: </strong></td>
						<td><input  type=\"text\" name =\"addTracks\"</td>
					</tr>
					<tr>
						<td><input  type=\"submit\" name=\"saveCD\" value=\"Save\"></td>
						<td><input  type=\"submit\" name=\"deleteCD\" value=\"Delete\"></td>
					</tr>
					
					
				</form>
				</table>";
					}?>
				
				<?php 
				function checkArtName($n)
				{
					include 'db.php';
					$sql ="SELECT DISTINCT artName FROM artist JOIN CD WHERE cd.artID = artist.artID AND cdID = ?";
					$stmt= $conn->prepare($sql);
					$stmt->bind_param('i', $n);
					$stmt ->execute();
					$stmt->bind_result($checkArtName);
					$stmt->fetch();
					
					return $checkArtName;
				}
				
			
			?>
				<?php
				
				
				function displayCDForm($n)
				{
					include 'db.php';
					
						
					
						$sql = "SELECT title, genre, price, no_of_tracks FROM cd WHERE cdID = ?";
						
						$stmt = $conn->prepare($sql);
						$stmt->bind_param('i', $n);
						$result = $stmt->execute();
						$stmt->bind_result($title, $genre, $price, $no_of_tracks);
						$stmt->fetch();
				
				
				?>
				<table class="display">
				
					<form class="" action="insertArtist.php" method="POST">
						
								<tr>
									<td><strong>Title: </strong></td>
									<td><input  type="text" name ="addCdTitle" value= "<?php  echo htmlentities($title);?>"  ></td>
								</tr>
								
								
						 		<tr>
									<td><strong>Artist: </strong></td>
									<td><select name ="selectArtist" >
					
						
						<?php
						include 'db.php';
						$sql = "SELECT artName FROM artist ORDER BY artName ASC";
						$stmt = $conn->prepare($sql);
						$stmt->execute();
						$stmt->bind_result($artName);
						$checkArtName = checkArtName($n);
						echo $checkArtName;
						
						while ($stmt->fetch())
							{
						?>
						
							<option <?php if ($artName== $checkArtName) echo "selected ";?> value="<?php echo htmlentities($artName); ?>"><?php echo htmlentities($artName); }?></option>
						
					
					
					
						</select></td>
					
					</tr>
					
					<td><strong>Genre: </strong></td>
						<td><input  type="text" name ="addGenre" value= "<?php echo htmlentities($genre);?>">
						</td>
						<tr>
					
						<td><strong>Price: </strong></td>
						<td><input  type="text" name ="addPrice" value= "<?php echo htmlentities($price);?>">
						</td>
					</tr>
					
					<tr>	
						<td><strong>Tracks: </strong></td>
				<td><input  type="text" name ="addTracks" value= "<?php echo htmlentities($no_of_tracks);?>">
						</td>
					</tr>
					<tr>
						<td><input  type="submit" name="saveCDUpdate" value="Save"></td>
						<td><input  type="submit" name="deleteCD" value="Delete"></td>
					</tr>
					
					
				</form>
				
				
				
			</table>
			<?php }?>
			
			
		<a href="albums.php">&#x2190 Back to CD Index</a>
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
