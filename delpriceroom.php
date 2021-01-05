<?php
require 'connectdb.php';

$idr = $_REQUEST['idrm'];
$addpriceroom = $_REQUEST['saveprice'];

for ($j = 0; $j < count($addpriceroom); $j++) {
    $val = $addpriceroom[$j]['price'];
    $dy = $addpriceroom[$j]['dy'];
    $sql = "DELETE FROM priceroom where ID_room ='$idr' and date_start ='$dy'";
    $arr  = array();
    if (mysqli_query($con, $sql)) {
        $arr = [
            'status' => 200,
            'val' => 'SuccesDel'
        ];
        echo json_encode($arr);
    } else {
        $arr = [
            'status' => 404,
            'val' => 'FailDel'
        ];
        echo json_encode($arr);
    }
}
