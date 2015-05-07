<?php
    
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
    include 'loginInfo.php';
    
    $mysqli = new mysqli("oniddb.cws.oregonstate.edu", "santokis-db", $myPassword, "santokis-db");
    $query = "SELECT id, name, category, length, rented FROM inventory";
    
    if($mysqli->connect_errno){
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    
    if($result = $mysqli->query($query)){
        echo "<table border = 3>";
        echo "<tr>";
        echo "<th>Name</th>";
        echo "<th>Category</th>";
        echo "<th>Length</th>";
        echo "<th>Status</th>";
        echo "</tr>";
        
        /* fetch associative array */
        while($row = $result->fetch_assoc()){
            if($row["rented"] == 0){
                $status = "checked out";
            }
            else if($row["rented"] == 1){
                $status = "available";
            }
            
            echo "<tr>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["category"] . "</td>";
            echo "<td>" . $row["length"] . "</td>";
            echo "<td>" . $status . "</td>";
            echo "</tr>";
            echo "</form>";
        }
        
        echo "</table>";
    
    }
    
    /* close connection */
    //$mysqli->close();
    
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset = "UTF-8">
    <title>Blokbuster Video</title>
</head>
<body>
    <form action = "addVideo.php" method = "POST"><br>
    Name: <input type = "text" name = "name">
    Category: <input type = "text" name = "category">
    Length: <input type = "text" name = "length">
    <input type = "submit" value = "ADD VIDEO">
</body>
</html>