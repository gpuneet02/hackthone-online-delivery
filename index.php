<?php
/**
 * Created by PhpStorm.
 * User: puneet
 * Date: 1/11/14
 * Time: 4:33 PM
 */
require_once("db/db.php");

?>
<script src="dist/js/jquey.min.js"></script>
<script src="dist/js/bootstrap.js"></script>


<link rel="stylesheet" href="dist/css/bootstrap.css"/>
<link rel="stylesheet" href="dist/css/bootstrap-theme.css"/>

<div class="row">
    <div class="col-md-offset-5 col-md-7"><h2>Place Order</h2></div>
    <div class="col-md-8 col-sm-12 col-md-offset-2">
        <form role="form" action="submit.php" method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
            </div>

            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" class="form-control" id="phone_number" placeholder="Enter Phone Number" name="phone_number">
            </div>
            <div class="form-group">
                <label for="address">Adress</label>
                <textarea class="form-control" id="address" placeholder="Enter Address" name="address"></textarea>
            </div>
            <?php echo getItemsDroopDown()?>
            <input type="hidden" id="longi" name="longi"/>
            <input type="hidden" id="lati" name="lati"/>
            <button type="submit" class="btn btn-success">Place Order</button>
        </form>
    </div>
</div>

<script>
    $(function(){
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    });

    function showPosition(position) {
        var lati = position.coords.latitude;
        var longi = position.coords.longitude;
        $("input#longi").val(longi);
        $("input#lati").val(lati);
    }
</script>

