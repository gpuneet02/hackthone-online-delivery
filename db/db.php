<?php
/**
 * Created by PhpStorm.
 * User: anshul
 * Date: 1/11/14
 * Time: 4:44 PM
 */

$servername = "localhost";
$username = "root";
$password = "aurus";
$port = 8080;
$dbName = 'deliver';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbName, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



function getItemsDroopDown() {
    global $conn;
    $items = $conn->query('select * from item');
    $result = '<select multiple class="form-control" name="items[]">';
    if ($items->num_rows > 0) {

        // output data of each row
        while($row = $items->fetch_assoc()) {
            //print_r($row['name  ']);exit;
            $result .= '<option value="'.$row['id'].'">'.$row["name"].'</option>';

        }
        $result .= '</select>';
    } else {

    }
    return $result;
}

