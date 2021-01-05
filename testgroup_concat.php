<?php
require 'connectdb.php';
// $sql = "SELECT tb_roomtype.name_roomtype,tb_roomtype.price_roomtype, 
// GROUP_CONCAT(priceroom.date_start) as date,GROUP_CONCAT(priceroom.price_room) as price,priceroom.ID_room
// FROM tb_roomtype,priceroom
// WHERE tb_roomtype.id = priceroom.ID_room
// and priceroom.date_start like '%2020-12%'
// GROUP by tb_roomtype.id";
$sql = "SELECT tb_roomtype.id,tb_roomtype.name_roomtype,tb_roomtype.price_roomtype,
-- GROUP_CONCAT(CONCAT(priceroom.date_start,',', tb_roomtype.price_roomtype,',', priceroom.price_room)) as gpprice
GROUP_CONCAT(priceroom.date_start) as date,GROUP_CONCAT(priceroom.price_room) as gpprice
,SUBSTR(priceroom.date_start,1,7) as mday    
FROM tb_roomtype 
JOIN priceroom on priceroom.ID_room = tb_roomtype.id
WHERE priceroom.date_start like '%2020-12%'
GROUP BY tb_roomtype.id,tb_roomtype.name_roomtype,
SUBSTR(priceroom.date_start,1,7)";

$query = mysqli_query($con, $sql);
// $results11 = mysqli_fetch_array($query);
$arr = array();
$arr2  = array();
while ($results = mysqli_fetch_assoc($query)) {
    $arr2 = [
        "name_roomtype" => $results['name_roomtype'],
        "price_roomtype" => $results['price_roomtype'],
        "date_start" => explode(',', $results['date']),
        // "price_room" => explode(',', $results['gpprice']),
        "priceDay" =>
        // 'date' => explode(',', $results['date']),
        explode(',', $results['gpprice'])

    ];
    // echo $results['name'] . "<br>";
    // echo $results['nomalprice'] . "<br>";
    // echo json_encode(explode(',', $results['date'])) . "<br>";
    array_push($arr, $arr2);
}
foreach ($arr as $key) {
    echo $key['name_roomtype'] . "=>" . $key['price_roomtype'] . "<br>";
    for ($i = 0; $i < count($key['date_start']); $i++) {
        echo $key['date_start'][$i] . "=>" . $key['priceDay'][$i] . "<br>";
    }
}   
// echo  json_encode($arr); 
// echo json_encode(explode(',',$arr[0]['array']));
