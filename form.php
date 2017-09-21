 <?php  

/*****************************************/
/*										  /
/*				Search Artist			  /
/*										  /
/*****************************************/ 
	
   function SearchArtist($artist)
   {
	   include 'db.php';
	   
	   if ($artist== '')
	   {
			$sql = "SELECT * FROM artist ORDER BY artID ASC";
			$stmt = $conn->prepare($sql);
	   }
	   else
	   {
			$sql="SELECT * FROM artist WHERE  artName LIKE ?"; 
			$stmt = $conn->prepare($sql);
			$artist = "%".$artist."%";
			$stmt->bind_param('s', $artist);
			
	   }
	   
	   $stmt->execute();
	   $stmt->bind_result($artID, $artName);
	   $result = $stmt->fetch();
	   
	   
	   if (!$result)
	   {
		   echo "<p> No results found</p>"; 
		   
	   }
	   else
	   {
		   ?><table class= "display">
			<tr>
			<th>Artist ID</th>
			<th>Artist Title</th>
			<th></th>
			</tr>
			<?php
				
			
				$stmt->execute();
				while ($stmt->fetch()) {
			?>
			<tr>
				<td><?php echo   htmlentities($artID)  ;?></td>
				<td><?php echo htmlentities($artName); ?></td>	
				<td><a href="addArtist.php?&id=<?php echo   htmlentities($artID);?>">Edit</a> . <a href="albums.php?&id=<?php echo htmlentities ($artID);?>">Albums</a>
			</tr>
			<?php
				}
			
			
			?></table><?php
	   }
   }
   
 
/*****************************************/
/*										  /
/*				Search Album			  /
/*										  /
/*****************************************/ 
   
   
	function SearchAlbum($title)
	{
		include 'db.php';
	   
		if ($title== '')
		{
			
			$sql = "SELECT cdID, artist.artName, title, price, genre, no_of_tracks FROM cd JOIN artist WHERE cd.artID = artist.artID ORDER BY cdID ASC";
			$stmt = $conn->prepare($sql);
		}
		else if (is_numeric($title))
		{
			$id = $title;	
			$sql="SELECT cdID, artist.artName, title, price, genre, no_of_tracks FROM artist JOIN cd WHERE cd.artID = artist.artID AND artist.artID = ?";
			
			$stmt = $conn->prepare($sql);
			$stmt->bind_param('i', $id);
		
			
		}
		else
		{
			$sql="SELECT cdID, artist.artName, title, price, genre, no_of_tracks FROM artist JOIN cd WHERE cd.artID = artist.artID AND title LIKE ?"; 
			$stmt = $conn->prepare($sql);
			$title = "%".$title."%";
			$stmt->bind_param('s', $title);
			
		}
	   
		$stmt->execute();
		$stmt->bind_result($cdID, $artName, $title, $price, $genre, $no_of_tracks);
		$result = $stmt->fetch();
		
	   
		if (!$result)
		{
			echo "<p> No results found</p>"; 
		   
		}
		else
		{
		   ?>
		   <table class= "display">
				<tr>
					<th>Cd ID</td>
					<th>Artist</td>
					<th>Title</td>
					<th>Price</td>
					<th>Genre</td>
					<th>Tracks</td>
					<th></td>
				</tr>
			<?php
				
			
				$stmt->execute();
				while ($stmt->fetch()) {
			?>
			<tr>
					<td><?php echo htmlentities($cdID);?></td>
					<td><?php echo htmlentities($artName);?></td>
					<td><?php echo htmlentities($title); ?></td>	
					<td><?php echo htmlentities($price); ?></td>
					<td><?php echo htmlentities($genre);?></td>
					<td><?php echo htmlentities($no_of_tracks); ?></td>
					<td><a href="addCd.php?&id=<?php echo htmlentities($cdID);?>">Edit</a> . <a href="tracks.php?&id= <?php echo htmlentities ($cdID);?>">Tracks</a>
				</tr>
			<?php
				}
			
			
			?></table><?php
		}
	}
   
   
   
/*****************************************/
/*										  /
/*				Search Track			  /
/*										  /
/*****************************************/ 
   
   
	function SearchTrack($track)
	{
		include 'db.php';
	   
		if ($track== '')
		{
			$sql = "SELECT cd.cdID, trcID, artist.artName, cd.title, trcTitle, running_time FROM tracks JOIN cd ON cd.cdID = tracks.cdID JOIN artist ON artist.artID = cd.artID ORDER BY trcID ASC";
			$stmt = $conn->prepare($sql);
		}
		else if (is_numeric($track))
		{
			$sql="SELECT cd.cdID, trcID, artist.artName, title, trcTitle, running_time FROM tracks JOIN cd ON tracks.cdID = cd.cdID JOIN artist ON artist.artID = cd.artID AND cd.cdID =? ORDER BY trcID ASC "; 
			$stmt = $conn->prepare($sql);
			$stmt->bind_param('i', $track);
		}
		else
		{
			$sql="SELECT cd.cdID, trcID, artist.artName, cd.title, trcTitle, running_time FROM tracks JOIN cd ON cd.cdID = tracks.cdID JOIN artist ON artist.artID = cd.artID AND trcTitle LIKE ? ORDER BY trcID ASC"; 
			$stmt = $conn->prepare($sql);
			$track = "%".$track."%";
			$stmt->bind_param('s', $track);
			
		}
	   
		$stmt->execute();
		$stmt->bind_result($cdID, $trcID, $artName, $title, $trcTitle, $running_time);
		$result = $stmt->fetch();
	   
	   
		if (!$result)
		{
		   echo "<p> No results found</p>"; 
		   
		}
		else
		{
		   ?>
		   <table class= "display">
				<tr>
					<th>Track ID</th>
					<th>Artist</th>
					<th>CD</th>
					<th>Title</th>
					<th>Duration</th>
					<th></th>
					
				</tr>
			<?php
				
			
				$stmt->execute();
				while ($stmt->fetch()) {
			?>
				<tr>
					<td><?php echo htmlentities($trcID);?></td>
					<td><?php echo htmlentities($artName);?></td>
					<td><?php echo htmlentities($title);?></td>
					<td><?php echo htmlentities($trcTitle); ?></td>	
					<td><?php echo htmlentities($running_time); ?></td>
					<td><a href="addTrack.php?&id=<?php echo   htmlentities($trcID);?>">Edit</a>
				</tr>
			<?php
				}
			
			
			?></table><?php
		}
	}
   
  
?>
