<?php

/*****************************************/
/*										  /
/*				Add Artist				  /										  
/*										  /
/*****************************************/



function addArtist()
{
include 'db.php';

$artName = $_POST['addArtist'];


$sql = "INSERT INTO artist (artName) VALUES (?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $artName);
$result = $stmt->execute();
if (!$result) echo "failed to insert record";


}

if(isset($_POST['save']))
{
	addArtist();
	header ("Location: artists.php");
	 
} 

/*****************************************/
/*										  /
/*				update Artist			  /										  
/*										  /
/*****************************************/

function updateArtist()
{
include 'db.php';



$artName = $_POST['addArtist'];

session_start();
$artID =$_SESSION['sessionVar'];
$sql = "UPDATE artist SET artName= ? WHERE artID=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('si', $artName, $artID);
$result = $stmt->execute();


if (!$result) echo "failed to update record";


}

if(isset($_POST['saveUpdate']))
{
	updateArtist();
	header ("Location: artists.php");
	 
} 





/*****************************************/
/*										  /
/*				Delete Artist			  /										  
/*										  /
/*****************************************/


function delArtist()
{
include 'db.php';

$artName = $_POST['addArtist'];

$sql = "DELETE FROM artist WHERE artName =?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $artName);
$result = $stmt->execute();



}

if(isset($_POST['delete']))
{
	delArtist();
	header ("Location: artists.php");
	 
} 

/*****************************************/
/*										  /
/*				Add CD					  /
/*										  /
/*****************************************/
function fetchArtID($art)
	{
		include 'db.php';
		
		$sql = "SELECT artID FROM artist WHERE artName =?";
		
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('s', $art);
		$stmt->execute();
		$stmt->bind_result($artID);
		$stmt->fetch();
		
		return $artID;
		
	}

function addCD()
{
include 'db.php';

$artName = $_POST['selectArtist'];
$title = $_POST['addCdTitle'];
$price = $_POST['addPrice'];
$genre = $_POST['addGenre'];
$no_of_tracks = $_POST['addTracks'];

$artID = fetchArtID($artName);


$sql = "INSERT INTO cd ( artID, title, price, genre, no_of_tracks) VALUES (?,?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('isdsi', $artID, $title, $price, $genre, $no_of_tracks);
$result = $stmt->execute();
if (!$result)
	{
	
	echo "failed to insert record";
	
	
	}
	

}

if(isset($_POST['saveCD']))
{
	addCD();
	header ("Location: albums.php");

} 


/*****************************************/
/*										  /
/*				update CD				  /										  
/*										  /
/*****************************************/

function updateCD()
{
include 'db.php';



$artName = $_POST['selectArtist'];
$title = $_POST['addCdTitle'];
$price = $_POST['addPrice'];
$genre = $_POST['addGenre'];
$no_of_tracks = $_POST['addTracks'];

$artID = fetchArtID($artName);



session_start();
$cdID =$_SESSION['cdID'];

$sql = "UPDATE cd SET artID= ?, title= ?, price= ?, genre= ?, no_of_tracks=? WHERE cdID=?";

$stmt = $conn->prepare($sql);
$stmt->bind_param('isdsii', $artID, $title, $price, $genre, $no_of_tracks, $cdID);
$result = $stmt->execute();


if (!$result) echo "failed to update record";


}

if(isset($_POST['saveCDUpdate']))
{
	updateCD();
	
	header ("Location: albums.php");
	 
}

/*****************************************/
/*										  /
/*				Delete CD				  /
/*										  /
/*****************************************/


function delCD()
{
include 'db.php';


$artID = $_POST['addArtID'];
$title = $_POST['addCdTitle'];
$price = $_POST['addPrice'];
$genre = $_POST['addGenre'];
$no_of_tracks = $_POST['addTracks'];

$sql = "DELETE FROM cd WHERE  title ='$title'";
$stmt = $conn->prepare($sql);
$stmt->bind_param('isdsi', $artID, $title, $price, $genre, $no_of_tracks);
$result = $stmt->execute();


}

if(isset($_POST['deleteCD']))
{
	delCD();
	header ("Location: albums.php");
	 
} 


/*****************************************/
/*										  /
/*				Add Tracks				  /
/*										  /
/*****************************************/


function fetchCdID($title)
	{
		include 'db.php';
		
		$sql = "SELECT cdID FROM cd WHERE title =?";
		
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('s', $title);
		$stmt->execute();
		$stmt->bind_result($cdID);
		$stmt->fetch();
		
		return $cdID;
		
	}


function addtrack()
{
include 'db.php';

$trcTitle = $_POST['addTitle'];
$title = $_POST['selectCdTitle'];
$running_time = $_POST['addDuration'];

$cdID = fetchCdID($title);

$sql = "INSERT INTO tracks (cdID, trcTitle, running_time) VALUES ( ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('isi', $cdID, $trcTitle, $running_time);
$result = $stmt->execute();

if (!$result) echo "failed to insert record";


}

if(isset($_POST['saveTrc']))
{
	addTrack();
	header ("Location: tracks.php");
	
} 



/*****************************************/
/*										  /
/*				update Tracks			  /										  
/*										  /
/*****************************************/

function updateTracks()
{
include 'db.php';


$trcTitle = $_POST['addTitle'];
$title = $_POST['selectCdTitle'];
$running_time = $_POST['addDuration'];

$cdID = fetchCdID($title);
echo $cdID;


session_start();
$trcID =$_SESSION['trcID'];

$sql = "UPDATE tracks SET  cdID = ?, trcTitle= ?, running_time= ? WHERE trcID=?";

$stmt = $conn->prepare($sql);
$stmt->bind_param('isii', $cdID, $trcTitle, $running_time, $trcID);
$result = $stmt->execute();


if (!$result) echo "failed to update record";


}

if(isset($_POST['saveTrcUpdate']))
{
	updateTracks();
	
	header ("Location: tracks.php");
	 
}



/*****************************************/
/*										  /
/*				Delete Tracks			  /
/*										  /
/*****************************************/


function delTrack()
{
include 'db.php';


$trcTitle = $_POST['addTitle'];
$running_time = $_POST['addDuration'];



$sql = "DELETE FROM tracks WHERE trctitle = '$trcTitle' ";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ssss', $trcID, $CdID, $trcTitle, $running_time);
$result = $stmt->execute();



}

if(isset($_POST['deleteTrc']))
{
	delTrack();
	header ("Location: tracks.php");
	
} 


/*****************************************/
/*										  /
/*				Count Artist			  /
/*										  /
/*****************************************/

function countArt()
{
	
include 'db.php';


$query = $conn->prepare("SELECT * FROM artist");
$query->execute();
$query->store_result();	
$rows = $query->num_rows;
echo $rows;
}
/*****************************************/
/*										  /
/*				Count CD				  /
/*										  /
/*****************************************/

function countCd()
{
	
include 'db.php';


$query = $conn->prepare("SELECT * FROM cd");
$query->execute();
$query->store_result();	
$rows = $query->num_rows;
echo $rows;
}

/*****************************************/
/*										  /
/*				Count Tracks			  /
/*										  /
/*****************************************/

function countTrack()
{
	
include 'db.php';


$query = $conn->prepare("SELECT * FROM tracks");
$query->execute();
$query->store_result();	
$rows = $query->num_rows;
echo $rows;
}


?>
