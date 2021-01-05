<?php
require 'connectdb.php';

$idr = $_REQUEST['idrm'];
$addpriceroom = $_REQUEST['saveprice'];
for ($j = 0; $j < count($addpriceroom); $j++) {
    $val = $addpriceroom[$j]['price'];
    $dy = $addpriceroom[$j]['dy'];
    $sql = "SELECT * FROM priceroom where ID_room = '$idr' and date_start ='$dy'";
    $query = mysqli_query($con, $sql);
    $rows = mysqli_fetch_assoc($query);

    if ($rows != null) {
        $sql = "UPDATE priceroom set price_room = '$val' where ID_room ='$idr' and date_start ='$dy'";
        $arr = array();
        if ($query = mysqli_query($con, $sql)) {
            $arr = [
                'status' => 200,
                'val' => 'SuccesEdit'
            ];
            // echo json_encode($arr);
        } else {
            $arr = [
                'status' => 404,
                'val' => 'FailEdit'
            ];
            // echo json_encode($arr);
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
            // echo json_encode($arr);
        } else {
            $arr = [
                'status' => 404,
                'val' => 'FailInsert'
            ];
            // echo json_encode($arr);
        }
    }
    echo json_encode(array("status" => $arr));
}
