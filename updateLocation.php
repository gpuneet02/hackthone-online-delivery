<?php
/**
 * Created by PhpStorm.
 * User: puneet
 * Date: 1/11/14
 * Time: 7:04 PM
 */

require_once("db/db.php");
if(isset($_POST['key'])) {

    $key = $_POST['key'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    $query1 = 'select * from deliver_person_info where `key`="'.$key.'"';

    $KeyQueryResult = $conn->query($query1);
    //print_r($KeyQueryResult->fetch_assoc());exit;
    $keyObject = $KeyQueryResult->fetch_object();

    if(isset($keyObject)) {
        $updateQuery = "update deliver_person_info set lati = '".$latitude."', longi= '".$longitude."',
        updated_at=".time()." where `key`='".$key."'";
        if ($conn->query($updateQuery) === TRUE) {
            // TODO find nearest order and send (need to add a bit that in order table that acept on not)
            echo json_encode(array('address'=>'myaddress', 'order'=>'myorder', 'latitude'=>'mylatitude', 'longitude'=>'myLongitude'));
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        $insertQuery = "INSERT INTO deliver_person_info (`key`, lati, longi, created_at) VALUES ('".$key."','".$latitude."', '".$longitude."', '".time()."')";
        //echo $insertQuery;exit;
        if ($conn->query($insertQuery) === TRUE) {
            // TODO find nearest order and send (need to add a bit that in order table that acept on not)
            echo json_encode(array('address'=>'myaddress', 'order'=>'myorder', 'latitude'=>'mylatitude', 'longitude'=>'myLongitude'));
        } else {
            echo "Error: <br>" . $conn->error;
        }
    }
} else {
    echo "Request Should be Post";
}