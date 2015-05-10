<?php
    
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
    include 'inventory.php';
    
    $mysqli = new mysqli("oniddb.cws.oregonstate.edu", "santokis-db", $myPassword, "santokis-db");
    
    if($mysqli->connect_errno){
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    
    //delete selected movie
    if(isset($_POST['deleteVideo'])){
        $delete = 'DELETE FROM inventory WHERE id = ' . $_POST["rowID"];
        if($mysqli->query($delete) != TRUE){
            echo "Error deleting video.";
        }
    }
    
    //delete all movies
    if(isset($_POST['deleteAllVideos'])){
        $mysqli->query("TRUNCATE TABLE inventory");
    }
    
    echo "<a href = 'http://web.engr.oregonstate.edu/~santokis/cs290-assignment4-part2/inventory.php'>refresh page</a>";
    
?>