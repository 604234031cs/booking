<?php
require_once('connectdb.php');
date_default_timezone_set("Asia/Bangkok");
$dtsever = date("d");
$mtsever = date("m");
$ytsever = date("Y");
$datecur = "" . $ytsever . "-" . "" . $mtsever . "-" . "" . $dtsever;
$date = strtotime($datecur);
$d = date("Y-m-d", strtotime("+15 day", strtotime($datecur))); // เพิ่มขึ้นทีละ 1 วัน
$sql = "SELECT * FROM tb_report where noid_booking = '' and report_status = 1 and checkin ='$d'";
$query = mysqli_query($con, $sql);
$num_rows = mysqli_num_rows($query);
// echo $num_rows;
$i = 1;
if ($num_rows > 0) {
    // $message = "คงค้างค่าชำระมัดจำ : " . $num_rows . "  " . "รายการ<br>";
    $message = "คงค้างค่าชำระมัดจำ : " . $num_rows . "  " . "รายการ\n";
    while ($row = mysqli_fetch_assoc($query)) {
        $balance = $row["sum"] - $row["Sales"];
        $message .= "รายการที่ " . $i;
        $dc = date("d F Y", strtotime($row['checkin']));
        $do = date("d F Y", strtotime($row['checkout']));
        $message .= "\nเลขที่ " . $row['id_booking'] . "\nชื่อลูกค้า : " . $row['name'] . " \nโรงเเรมที่จอง : " . $row['room_name'] . "\nวันที่เช็คอิน : " . $dc . "\nวันที่เช็คเอาท์ : " . $do . "\nยอดเงินในการชำระ : " . number_format($row['deposit']) . "\nยอดคงเหลือ : " . number_format($balance) . "\nยอดสุทธิ : " . number_format($row['sum']);
        $message .= "\n-------------------------------\n";
        // $message .= "<br>เลขที่ " . $row['id_booking'] . "<br>ชื่อลูกค้า : " . $row['name'] . " <br>โรงเเรมที่จอง : " . $row['room_name'] . "<br>วันที่เช็คอิน : " . $row['checkin'] . "<br>วันที่เช็คเอาท์ : " . $row['checkout'] . "<br>ยอดเงินในการชำระ : " . number_format($row['deposit']) . "<br>ยอดคงเหลือ : " . number_format($balance) . "<br>ยอดสุทธิ : " . number_format($row['sum']);
        // $message .= "<br>-------------------------------<br>";
        // echo $quryl['id'] . "<br>";
        $i++;
    }
//     // echo $message . "<br>" . $d;
$Token = "LLHQCmiOVjOjpwiAAiblUjOONK5kUqEVyObBCNwdTIL";
// $message = "\nเลขที่ " . $text . "\nชื่อลูกค้า :" . $name . " \nโรงเเรมที่จอง: " . $room_name . "\nวันที่เช็คอิน: " . $checkin . "\nวันที่เช็คเอาท์: " . $checkout . "\nสถานะการชำระเงิน " . $d . "\nยอดเงินในการชำระ: " . $Sales . "\nติดต่อ: " . $phone . "\nInvoice: https://thechiclipe.com/form_resort/report5.php?id=" . $ss['id'];
// $message = "\nเลขที่ " . $text . "\nชื่อลูกค้า :" . $name . " \nโรงเเรมที่จอง: " . $room_name . "\nวันที่เช็คอิน: " . $checkin . "\nวันที่เช็คเอาท์: " . $checkout . "\nสถานะการชำระเงิน " . $d . "\nยอดเงินในการชำระ: " . $Sales . "\nติดต่อ: " . $phone . "\nInvoice: http://localhost/booking/report5.php?id=" . $ss['id'];

$lineapi = $Token; // ใส่ token key ที่ได้มา
$mms = trim($message); // ข้อความที่ต้องการส่ง

date_default_timezone_set("Asia/Bangkok");
$chOne = curl_init();
curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
// SSL USE 
curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
//POST 
curl_setopt($chOne, CURLOPT_POST, 1);
curl_setopt($chOne, CURLOPT_POSTFIELDS, "message=$mms");
curl_setopt($chOne, CURLOPT_FOLLOWLOCATION, 1);
$headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $lineapi . '',);
curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($chOne);
//Check error 
if (curl_error($chOne)) {
    echo "<script> alert(''error:'" . curl_error($chOne) . "');</script>";
} else {
    $result_ = json_decode($result, true);
    // echo "status : ".$result_['status']; echo "message : ". $result_['message'];
}
curl_close($chOne);
    echo  $message;
}
