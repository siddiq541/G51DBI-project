<?php

include 'db.php';





?>

<!DOCTYPE html>

<html>

<head>

<meta charset="utf-8">

<title>Add Track</title>

<link rel="stylesheet" type="text/css" href="css/styleSheet.css">
<script src="js/validation.js" type="text/javascript"></script>
</head>

<body>

<div class="wrapper">
		
	<div class ="mainMenu">
	
		<h1>Add Track</h1>
	
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
						
						
						$_SESSION['trcID'] = $n;
						
						
						displayTrcForm($n);
					}
					else
					{
						echo
							"<form class=\"\" action=\"insertArtist.php\" method=\"POST\">
						
								<tr>
									<td><strong>Title: </strong></td>
									<td><input  type=\"text\" name =\"addTitle\" ></td>
								</tr>";
		?>				<tr>
						<td><strong>Album: </strong></td>
						<td><select name ="selectCdTitle" >
							
						<?php
					
						$sql = "SELECT title FROM cd ORDER BY title ASC";
						$stmt = $conn->prepare($sql);
						$stmt->execute();
						$stmt->bind_result($title);
						while ($stmt->fetch()) {
						?>
						
							<option value="<?php echo htmlentities($title); ?>"><?php echo htmlentities($title); ?></option>
						
					<?php
						}
					?>	</select></td>	
						</tr>
					<?php
					echo "
					
					<tr>	
						<td><strong>Duration: </strong></td>
						<td><input  type=\"text\" name =\"addDuration\"</td>
					</tr>
					<tr>
						<td><input  type=\"submit\" name=\"saveTrc\" value=\"Save\"></td>
						<td><input  type=\"submit\" name=\"deleteTrc\" value=\"Delete\"></td>
					</tr>
					
					
				</form>
				</table>";
					}?>	
				
				<?php 
				function checkCdName($n)
				{
					include 'db.php';
					$sql ="SELECT title FROM cd JOIN tracks WHERE cd.cdID = tracks.cdID AND trcID = ?";
					$stmt= $conn->prepare($sql);
					$stmt->bind_param('i', $n);
					$stmt ->execute();
					$stmt->bind_result($checkCdName);
					$stmt->fetch();
					
					return $checkCdName;
				}
				
			
			?>
				
				<?php
					
					function displayTrcForm($n)
					{
					
						include 'db.php';
					
						$sql = "SELECT trcTitle, running_time FROM tracks WHERE trcID = ?";
						
						$stmt = $conn->prepare($sql);
						$stmt->bind_param('s', $n);
						$result = $stmt->execute();
						$stmt->bind_result($trcTitle, $running_time);
						$stmt->fetch();					
						
					
				
				?>
				<form class="" action="insertArtist.php" method="POST">
					<tr>
						<td><strong>Title: </strong></td>
						<td><input  type="text" name ="addTitle" value= "<?php echo htmlentities($trcTitle);?>"></td>
					</tr>
					<tr>
									<td><strong>Album: </strong></td>
									<td><select name ="selectCdTitle" >
					
						
						<?php
						include 'db.php';
						$sql = "SELECT title FROM cd ORDER BY title ASC";
						$stmt = $conn->prepare($sql);
						$stmt->execute();
						$stmt->bind_result($title);
						$checkCdName=checkCdName($n);
						while ($stmt->fetch())
							{
						?>
						
					<option <?php if ($title== $checkCdName) echo "selected ";?>value="<?php echo htmlentities($title); ?>"><?php echo htmlentities($title);} ?></option>
						
							
							
					
						</select></td>
					
					</tr>
					<tr>
						<td><strong>Duration: </strong></td>
						<td><input  type="text" name ="addDuration" value= "<?php echo htmlentities($running_time);?>"></td>
					</tr>
					
					<tr>
						<td><input type="submit" name="saveTrcUpdate" value="Save"></td>
						<td><input type="submit" name="deleteTrc" value="Delete"></td>
					</tr>
					
					
					
				</form>
			</table>
				<?php }?>
				
			<a href="tracks.php">&#x2190 Back to Tracks Index</a>
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

