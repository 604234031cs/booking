<?php
require 'connectdb.php';
$val = $_REQUEST['price'];
$dy  = $_REQUEST['dy'];
$idr = $_REQUEST['idrm'];

$sql = "SELECT * FROM priceroom where ID_room ='$idr' and date_start = '$dy'";
$query = mysqli_query($con, $sql);
$resurt = $results = mysqli_fetch_assoc($query);

if ($resurt == true) {
    $sql = "UPDATE priceroom set price_room ='$val' where ID_room ='$idr' and date_start='$dy'";
    if ($query = mysqli_query($con, $sql)) {
        $arr = [
            'status' => 201,
            'val' => 'SuccesEdit'
        ];
        echo json_encode($arr);
    } else {
        $arr = [
            'status' => 404,
            'val' => 'FailEdit'
        ];
        echo json_encode($arr);
    }
} else {
    $sql = "INSERT INTO `priceroom`(`id_priceroom`, `date_start`, `ID_room`, `price_room`) VALUES(null,'$dy','$idr','$val')";
    $arr  = array();
    $query = mysqli_query($con, $sql);
    if ($query === TRUE) {
        $arr = [
            'status' => 200,
            'val' => 'SuccesInsert'
        ];
        echo json_encode($arr);
    } else {
        $arr = [
            'status' => 404,
            'val' => 'Fail'
        ];
        echo json_encode($arr);
    }
}
