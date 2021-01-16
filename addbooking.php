<?php
require 'connectdb.php';
require_once('head.php');
error_reporting(0);
// older_children
// child
$month =  date('m');
$transaction_date =  date('d-m-Y');
$name =  $_POST['name'];
$phone =  $_POST['phone'];
$line =  $_POST['line'];
$room_name =  $_POST['room_name'];
$typser = $_POST['typser'];

$ch1 =  $_POST['older_children'];
$ch2 =  $_POST['child'];
$package =  $_POST['package'];
$number_of_rooms =  $_POST['number_of_rooms'];
// $extrabed =  $_REQUEST['extrabed'];
$customers =  $_POST['customers'];

$checkin =  $_POST['checkin'];
$checkin1 = strtotime($checkin);
$checkin2 = date('Y-m-d', $checkin1);

$checkout =  $_POST['checkout'];
$checkout1 = strtotime($checkout);
$checkout2 = date('Y-m-d', $checkout1);
$Sales =  $_POST['Sales'];
$insurance =  $_POST['insurance'];


$deposit =  $_POST['sum'] - $Sales;

if ($deposit > 0) {
    $report_status = 1;
    $d = "มัดจำ";
} else {
    $report_status = 0;
    $d = "จ่ายเต็ม";
}

$ytsever = date("Y");
$sum =  $_POST['sum'];
$car =  $_POST['car_num'];
$boat =  $_POST['boat_num'];
$diving =  $_POST['diving_num'];

// $payment_status =  $_REQUEST['payment_status'];
// $occupancy_status =  $_REQUEST['occupancy_status'];
// $collection_date =  $_REQUEST['collection_date'];
$com =  $_POST['com'];
$commission_value =  $_POST['commission_value'];
$note =  $_POST['note'];
$details =  $_POST['details'];
$Byyy = $_POST['By'];
$days = $_POST['days'];
$fileName = $_FILES['file']['name'];
if ($_REQUEST['extrabed'] == "") {
    $extrabed =  "";
} else {
    $extrabed =  $_POST['extrabed'];
}
$adult =  $_POST['adult'];


// $Carrier_name_note = $_REQUEST['Carrier_name_note'];
$name_roomtype = $_POST['name_roomtype'];
// $resort_name = $ss['room_name'];
// echo  $name_roomtype;
$upload_dir = "img/slips/";
$uploaded_file = $upload_dir . $fileName;
$imageFileType = strtolower(pathinfo($uploaded_file, PATHINFO_EXTENSION));

// echo $imageFileType;
//insert file information into db table
// echo	$strSQL = "INSERT INTO `tb_report` (`id`, `id_booking`,`month`, `transaction_date`, `name`, `phone`, `room_name`, `package`, `number_of_rooms`,`extrabed`, `customers`,`checkin`,`checkout`,`Sales`,`deposit`,`sum`,`car`,`boat`,`diving`,`payment_status`,`occupancy_status`,`collection_date`,`com,commission_value`,`insurance`,`slip`,`note`) 
//VALUES (NULL, '5','$month',NOW(), '$name', '$phone', '$room_name', '$package', '$number_of_rooms','$extrabed', '$customers','$checkin2 ', '$checkout2' , '$Sales', '$deposit', '$sum', '$car', '$boat', '$diving', '1', '1', NOW(), '$com', '$commission_value' , '$insurance', '$fileName', '$note');";

if (move_uploaded_file($_FILES['file']['tmp_name'], $uploaded_file)) {
    $strSQL = "INSERT INTO `tb_report` (`id`, `id_booking`, `month`, `transaction_date`, `name`, `phone`, `line`, `room_name`, `name_resort`, `package`, `number_of_rooms`, `extrabed`, `customers`, `checkin`, `checkout`, `Sales`, `deposit`, `sum`, `car`, `boat`, `diving`, `payment_status`, `occupancy_status`, `collection_date`, `com`, `commission_value`, `adult`, `insurance`, `slip`,`note`,`details`,`Byyy`,`noid_booking`,`report_status`,ch1,ch2,typ_ser,status_pay)  VALUES (NULL, '','$month',NOW(), '$name', '$phone', '$line', '$room_name','$name_roomtype', '$package', '$number_of_rooms','$extrabed', '$customers','$checkin2 ', '$checkout2' , '$Sales', '$deposit', '$sum', '$car', '$boat', '$diving', '1', '1', NOW(), '$com', '$commission_value' , '$adult', '$insurance', '$fileName','$note','$details','$Byyy','','$report_status','$ch1','$ch2','$typser',1);";
    $objQuery = mysqli_query($con, $strSQL);

    if ($objQuery === TRUE) {
        $yt = date('Y');
        $last = "SELECT * FROM tb_report where transaction_date like '%$yt%' ORDER BY id DESC LIMIT 1";
        $last1 = "SELECT * FROM tb_report where transaction_date like '%$yt%'";
        $re = mysqli_query($con, $last);
        $re2 = mysqli_query($con, $last1);
        $ss = mysqli_fetch_assoc($re);
        $row  = mysqli_num_rows($re2);
        $resort_name = $ss['room_name'];

        $ytsever = substr(date("Y") + 543, -2);

        if ($row <= 0) {
            $num = substr("0000" . 1, -4);
            $text = "" . $num . "-" . $ytsever;
            $reimge = $text . "." . $imageFileType;

            $in = " UPDATE `tb_report` SET `id_booking` = '" . $text . "',slip='$reimge' WHERE `tb_report`.`id` ='" . $ss['id'] . "'";
            $a = mysqli_query($con, $in);
            // move_uploaded_file($_FILES['file']['tmp_name'], $uploaded_file);
            rename('img/slips/' . $fileName, 'img/slips/' . $reimge);
        } else {
            $num = substr("0000" . $row, -4);
            $text = "" . $num . "-" . $ytsever;
            $reimge = $text . "." . $imageFileType;

            $in = " UPDATE `tb_report` SET `id_booking` = '" . $text . "',slip='$reimge' WHERE `tb_report`.`id` ='" . $ss['id'] . "'";
            $a = mysqli_query($con, $in);
            // move_uploaded_file($_FILES['file']['tmp_name'], $uploaded_file);
            rename('img/slips/' . $fileName, 'img/slips/' . $reimge);
        }

        // $syear = "" + $startyear + "-01-01";
        // $startyear = date("Y");
        // $Token = "3CE5IOOxiuntE6OtBxXAMAgkJjgcl01ibxvAQSZBjvp";
        // // $Token = "etxmEbZ2cY5OvNGJtUS5dJcaR1gXVbdmpiJ0tuRCVTY";
        // // $message = "\nเลขที่ " . $text . "\nชื่อลูกค้า :" . $name . " \nโรงเเรมที่จอง: " . $room_name . "\nวันที่เช็คอิน: " . $checkin . "\nวันที่เช็คเอาท์: " . $checkout . "\nสถานะการชำระเงิน " . $d . "\nยอดเงินในการชำระ: " . $Sales . "\nติดต่อ: " . $phone . "\nInvoice: https://thechiclipe.com/form_resort/report5.php?id=" . $ss['id'];
        // $message = "\nเลขที่ "  . $text  . "\nชื่อลูกค้า : " . $name . " \nโรงเเรมที่จอง : " . $room_name . "\nวันที่เช็คอิน : " . $checkin . "\nวันที่เช็คเอาท์ : " . $checkout . "\nสถานะการชำระเงิน : " . $d . "\nยอดเงินในการชำระ : " . number_format($Sales) . "\nติดต่อ : " . $phone . "\nInvoice : http://khemtis.com/booking/report5.php?id=" . $ss['id'];

        // $lineapi = $Token; // ใส่ token key ที่ได้มา
        // $mms = trim($message); // ข้อความที่ต้องการส่ง

        // date_default_timezone_set("Asia/Bangkok");
        // $chOne = curl_init();
        // curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
        // // SSL USE 
        // curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
        // curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
        // //POST 
        // curl_setopt($chOne, CURLOPT_POST, 1);
        // curl_setopt($chOne, CURLOPT_POSTFIELDS, "message=$mms");
        // curl_setopt($chOne, CURLOPT_FOLLOWLOCATION, 1);
        // $headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $lineapi . '',);
        // curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
        // curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
        // $result = curl_exec($chOne);
        // //Check error 
        // if (curl_error($chOne)) {
        //     echo "<script> alert(''error:'" . curl_error($chOne) . "');</script>";
        // } else {
        //     $result_ = json_decode($result, true);
        //     // echo "status : ".$result_['status']; echo "message : ". $result_['message'];
        // }
        // curl_close($chOne);
        // //------------------------------------end LINE----------------------------------------------
        echo "<div><script>
        swal('สำเร็จ!','บันทึกสำเร็จ', 'success')
        .then(() => {
            setTimeout(function(){ 
                window.location.href='report.php'
            }, 1000);
        });</script></div>";
        // $text1 = "" . $num;
    } else {
        echo "<div><script>
        swal('เกิดข้อผิดพลาด!','บันทึกไม่สำเร็จ', 'error')
        .then(() => {
            setTimeout(function(){ 
                 window.location.href='report.php'
            }, 1000);
        });</script></div>";
    }
} else {
    echo "<div><script>
    swal('เกิดข้อผิดพลาด!','บันทึกไม่สำเร็จ', 'error')
    .then(() => {
        setTimeout(function(){ 
             window.location.href='report.php'
        }, 1000);
    });</script></div>";
}

// echo "<div><script>
// swal('เกิดข้อผิดพลาด!','บันทึกไม่สำเร็จ', 'error')
// .then(() => {
//     setTimeout(function(){ 
//         window.location.href='booking.php'
//     }, 1000);
// });</script></div>";





// echo "<script>alert('บันทึกสำเร็จ');window.location.href = 'report.php'</script > ";


//----------------------- LINE-------------------https://thechiclipe.com/form_resort/report5.php?id=1------------------------------\ninvoice: http://tsuslowhostel.com/filePDF/" . $idb . ".pdf"


// echo "<script> window.location.href = 'report.php?resort_name=$resort_name'</script > ";
