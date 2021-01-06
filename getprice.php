<?php
include_once('connectdb.php');
error_reporting(0);
$date_start = $_REQUEST['date_start'];
$id_roomtype = $_REQUEST['id_roomtype'];
$diffday = $_REQUEST['diffday'];
for ($i = 0; $i <= $diffday; $i++) {

    $datedate55 = date("Y-m-d", strtotime("+$diffday days", strtotime($date_start)));
    $sql55 = "SELECT * FROM `priceroom` WHERE `date_start` = '" . $datedate55 . "' AND `ID_room` = '" . $id_roomtype . "'";
    $query55 = mysqli_query($con, $sql55);
    $sum_price_room1;
    while ($results55 = mysqli_fetch_assoc($query55)) {
        // $results55["price_room"];
        $sum_price_room1 += $results55["price_room"];
    }
}
echo json_encode($sum_price_room1);
