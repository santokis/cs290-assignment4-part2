<?php
    
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
    include 'inventory.php';
    
    $mysqli = new mysqli("oniddb.cws.oregonstate.edu", "santokis-db", $myPassword, "santokis-db");
    
    if($mysqli->connect_errno){
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    
    $category = "SELECT id, name, category, length, rented FROM inventory";
    $post = $_POST['filterVideo'];

    if($categoryResult = $mysqli->query($category)){
        echo "<table border = 3>";
        echo "<tr>";
        echo "<th>Name</th>";
        echo "<th>Category</th>";
        echo "<th>Length</th>";
        echo "<th>Status</th>";
        echo "</tr>";
        
        // fetch associative array
        while($row = $categoryResult->fetch_assoc()){
            if($row["rented"] == 0){
                $status = "available";
            }
            else if($row["rented"] == 1){
                $status = "checked out";
            }
            
            //filter movies by selected category
            if($post == $row["category"]){
                echo "<tr>";
                echo "<td>" . $row["name"]. "</td>";
                echo "<td>" . $post . "</td>";
                echo "<td>" . $row["length"]. "</td>";
                echo "<td>" . $status . "</td>";
                echo "</tr>";
            }
            
            //filters by all movies
            if($post == "All Movies"){
                echo "<tr>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["category"] . "</td>";
                echo "<td>" . $row["length"] . "</td>";
                echo "<td>" . $status . "</td>";
                echo "</tr>";
            }
        }
        
        echo "</table>";
    }
    
    echo "<a href = 'http://web.engr.oregonstate.edu/~santokis/cs290-assignment4-part2/inventory.php'>refresh page</a>";
    
?>