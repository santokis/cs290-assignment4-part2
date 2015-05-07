<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
    include 'inventory.php';
    
    $name = $_POST['name'];
    $category = $_POST['category'];
    $length = $_POST['length'];
    
    /* Error handling */
    if(strlen($name) == 0){
        echo 'A movie name is required.';
        die();
    }
    
    if(!is_numeric($length)){
        echo 'Length must be numeric.';
        die();
    }
    
    /* Non-prepared statement
    if (!$mysqli->query("DROP TABLE IF EXISTS inventory") || !$mysqli->query("CREATE TABLE inventory(id INT PRIMARY KEY AUTO_INCREMENT, name VARCHAR(255) UNIQUE NOT NULL, category VARCHAR(255), length INT UNSIGNED, rented BOOL DEFAULT NULL)")) {
        echo "Table creation failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    */
    
    /* Prepared statement, stage 1: prepare */
    if (!($stmt = $mysqli->prepare("INSERT INTO inventory(id, name, category, length, rented) VALUES (?, ?, ?, ?, ?)"))) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    
    /* Prepared statement, stage 2: bind and execute */
    if (!$stmt->bind_param("issib", $id, $name, $category, $length, $rented)) {
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    
    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    
    $stmt->close();
?>