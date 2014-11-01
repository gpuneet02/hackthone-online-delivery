<?php
/**
 * Created by PhpStorm.
 * User: puneet
 * Date: 1/11/14
 * Time: 6:05 PM
 */
require_once("db/db.php");
if(isset($_POST)) {
    //Array ( [name] => vd [email] => dl@mail.com [phone_number] => 939 [address] => kdw [items] => Array ( [0] => 1 [1] => 2 ) )
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phoneNumber = isset($_POST['phone_number']) ? $_POST['phone_number'] : '';
    $address = $_POST['address'];
    $orderItems = $_POST['items'];
    $longi = $_POST['longi'];
    $lati = $_POST['lati'];

    $isUser = $conn->query('select * from user where email="'.$email.'"');
    $userObject = $isUser->fetch_object();
    if(isset($userObject)) {
        $userId = $userObject->id;
    } else {
        $query1 = "INSERT INTO user (name, email, phone_number, address) VALUES ('".$name."','".$email."', '".$phoneNumber."', '".$address."')";
        if ($conn->query($query1) === TRUE) {
            $userId = $conn->insert_id;
        } else {
            echo "Error: <br>" . $conn->error;
            header( "refresh:3;url=index.php" );
            return;
        }
    }

        $query2 = "INSERT INTO `order` (user_id, longi, lati) VALUES (".$userId.", '".$longi."','".$lati."')";
        if ($conn->query($query2) === TRUE) {
            $orderId= $conn->insert_id;
            $isSuccess = true;
            foreach($orderItems as $item) {
                $query3 = "INSERT INTO order_item (order_id, item_id) VALUES (".$orderId.", ".$item.")";
                if($conn->query($query3) == TRUE) {
                } else {
                    $isSuccess = false;
                    echo "Error: <br>" . $conn->error;
                }
            }
            if($isSuccess) {
                echo "Order Placed Successfully";
                header( "refresh:3;url=index.php" );
            }

        } else {
            echo "Error: <br>" . $conn->error;
        }
}