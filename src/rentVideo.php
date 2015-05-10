<?php
    
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
    include 'inventory.php';
    
    $mysqli = new mysqli("oniddb.cws.oregonstate.edu", "santokis-db", $myPassword, "santokis-db");
    
    if($mysqli->connect_errno){
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    
    //switch movie status
    if(isset($_POST['in'])){
        $in = $_POST['inID'];
        $update = "UPDATE inventory SET rented = '1' WHERE id = $in";
        if($mysqli->query($update) != TRUE){
            echo "Error updating status.";
        }
    }
    else if(isset($_POST['out'])){
        $out = $_POST['outID'];
        $update = "UPDATE inventory SET rented = '0' WHERE id = $out";
        if($mysqli->query($update) != TRUE){
            echo "Error updating status.";
        }
    }
    
    echo "<a href = 'http://web.engr.oregonstate.edu/~santokis/cs290-assignment4-part2/inventory.php'>refresh page</a>";
    
?>