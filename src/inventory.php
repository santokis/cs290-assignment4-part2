<?php
    
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
    include 'loginInfo.php';
    
    $mysqli = new mysqli("oniddb.cws.oregonstate.edu", "santokis-db", $myPassword, "santokis-db");
    
    if($mysqli->connect_errno){
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    
    //Delete videos
    
    $query = "SELECT id, name, category, length, rented FROM inventory";
    
    if($queryResult = $mysqli->query($query)){
        echo "<table border = 3>";
        echo "<tr>";
        echo "<th>Name</th>";
        echo "<th>Category</th>";
        echo "<th>Length</th>";
        echo "<th>Status</th>";
        echo "</tr>";
        
        // fetch associative array
        while($queryRow = $queryResult->fetch_assoc()){
            echo "<tr>";
            echo "<td>" . $queryRow["name"] . "</td>";
            echo "<td>" . $queryRow["category"] . "</td>";
            echo "<td>" . $queryRow["length"] . "</td>";
            if($queryRow["rented"] == 0){
                $status = "available";
                echo "<td>" . $status . "</td>";
                echo "<form action = 'rentVideo.php' method = 'POST'>";
                echo "<input type = 'hidden' name = 'inID' value = '".$queryRow['id']."'/>";
                echo "<td><input type = 'submit' name = 'in' value = 'check-in/check-out'/></td></form>";
            }
            if($queryRow["rented"] == 1){
                $status = "checked out";
                echo "<td>" . $status . "</td>";
                echo "<form action = 'rentVideo.php' method = 'POST'>";
                echo "<input type = 'hidden' name = 'outID' value = '".$queryRow['id']."'/>";
                echo "<td><input type = 'submit' name = 'out' value = 'check-in/check-out'/></td></form>";
            }
            echo "<form action = 'deleteVideo.php' method = 'POST'>";
            echo "<input type = 'hidden' name = 'rowID' value = '".$queryRow['id']."'/>";
            echo "<td><input type = 'submit' name = 'deleteVideo' value = 'Delete'/></td></tr></form>";
            
        }
        
        echo "</table>";
    
    }
    
    echo "<form action = 'deleteVideo.php' method = 'POST'>";
    echo "<button type = 'submit' name = 'deleteAllVideos' value = " . $queryRow["id"] . ">Delete All Videos</button>";
    echo "</form>";
    
    //Filter categories

    $filter = "SELECT DISTINCT category FROM inventory";
    $filterResult = mysqli_query($mysqli, $filter);
    
    if($filterResult->num_rows > 0){
        echo "<form action = 'filterVideo.php' method = 'POST'>";
        echo "<select name = 'filterVideo'>";
        while($filterRow = $filterResult->fetch_assoc()){
            foreach($filterResult as $filterRow){
                //Filter must not be NULL
                if(strlen($filterRow['category']) > 0){
                    echo "<option>" . $filterRow['category'] . "</option>";
                }
            }
            echo "<option>All Movies</option>";
            echo "</select>";
            echo "<input type = 'submit' value = 'Filter'/>";
            echo "</form>";
        }
    }
    
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
    <input type = "submit" value = "Add Video">
    </form>
</body>
</html>