<?php
require 'connectdb.php';
$page = $_GET['page'];
if ($page == "checkprice") {

    $id =  $_GET['id'];

    $sql = "SELECT * FROM tb_roomtype where id_resort = '$id'";
    $query = mysqli_query($con, $sql);
    $arr = array();
    while ($results11 = mysqli_fetch_array($query)) {
        array_push($arr, $results11);
    }
    echo json_encode($arr);

    // echo json_encode('ok');
} else if ($page == "edit") {
    $id = $_GET['name'];

    $sql = "SELECT * FROM tb_resort INNER JOIN tb_roomtype ON tb_resort.id=tb_roomtype.id_resort WHERE tb_resort.resort_name = '$id'";
    $query = mysqli_query($con, $sql);
    $arr = array();
    while ($results = mysqli_fetch_array($query)) {
        array_push($arr, $results);
    }
    echo json_encode($arr);
} else if ($page == "pricerooms") {
    $id = $_GET['id_resort'];
    $sql = "SELECT * FROM tb_roomtype where id_resort = '$id'";
    $query = mysqli_query($con, $sql);
    // $results11 = mysqli_fetch_assoc($query);
    $arr = array();
    while ($results = mysqli_fetch_assoc($query)) {
        array_push($arr, $results);
    }
    echo json_encode($arr);
} else if ($page == "showpriceroom") {


    $y = $_GET['year'];
    $m = $_GET['mont'];
    $id = $_GET['idresort'];
    $f = $y . '-' . $m;
    $sql = "SELECT ID_room,date_start,price_room FROM `priceroom` WHERE date_start LIKE '%$f%' ";
    // // $sql =  "SELECT tb_roomtype.name_roomtype,tb_roomtype.price_roomtype,
    // // priceroom.date_start,priceroom.price_room,priceroom.ID_room
    // // FROM tb_roomtype
    // // LEFT JOIN priceroom ON tb_roomtype.id = priceroom.ID_room
    // // and priceroom.date_start like '%$f%'
    // // Group by tb_roomtype.id";
    $query = mysqli_query($con, $sql);
    // $results11 = mysqli_fetch_array($query);
    $arr = array();
    while ($results = mysqli_fetch_assoc($query)) {
        array_push($arr, $results);
    }
    echo json_encode($arr);
}
