<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
require_once('tcpdf/tcpdf.php');
header("Content-type: application/pdf");  
$obj_pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$obj_pdf->SetTitle("ใบประกัน");
$obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
$obj_pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('angsanaupc');
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
define('MYPDF_MARGIN_LEFT', 5);
define('MYPDF_MARGIN_TOP', 8);
define('MYPDF_MARGIN_RIGHT', 5);
define('MYPDF_MARGIN_FOOTER', 35);
$obj_pdf->SetMargins(MYPDF_MARGIN_LEFT, MYPDF_MARGIN_TOP, MYPDF_MARGIN_RIGHT);
//$obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
$obj_pdf->setPrintHeader(false);
$obj_pdf->setPrintFooter(false);
$obj_pdf->SetAutoPageBreak(TRUE, 10);
$obj_pdf->SetFont('angsanaupc', '', 15);
$obj_pdf->AddPage();

$image_file = K_PATH_IMAGES . 'viriyah-logo.png';
$obj_pdf->Image($image_file, 18, 4, 100, '', 'png', '', 'c', false, 400, '', false, false, 0, false, false, false);



$date = date("Y-m-d");



// $date = "12-12-2020";

$connect = '';
$connect = mysqli_connect("localhost", "root", "", "booking");   //("localhost", "istadium_01", "Aa123654", "istadium_01");
$sql1 = "SELECT * FROM tb_report   WHERE id_booking ='" . $_GET["id_booking"] . "'";

$result1 = mysqli_query($connect, $sql1);
// $row2 = mysqli_fetch_assoc($result1);


while ($row1 = mysqli_fetch_assoc($result1)) {
  $noid_booking = $row1['noid_booking'];
  $id_booking = $row1['id_booking'];
  $day = substr($row1['package'], 0, 1);
  $content = '
    <table class="first" cellpadding="4" cellspacing="1">
    <tr>
        <td width="30%" > </td>
        <td width="40%"> </td> 
        <td width="30%" align="center">
            <b style="font-size: 1.3em;">วันที่ ' . $date . '</b><br>
        </td>
    </tr>
    </table>
  <table><tr><td></td></tr></table>
  
    <table class="first" cellpadding="4" cellspacing="4">
    <tr>
        <td  width="19%" ><b style="font-size: 1em;">ชื่อผู้ถือกรรมธรรม์</b></td>
        <td  width="30%" align="center;">บริษัท เข็มทิศ ไอทินเนอระรี จำกัด</td>
        <td  width="16%" ><b style="font-size: 1em;">เลขกรรมธรรม์</b></td>
        <td  width="30%" align="center">04519-20181/POL/000005-557</td> 
    </tr>
     <tr>
        <td  width="19%" ><b style="font-size: 1em;">จำนวนนักท่องเที่ยว</b></td>
        <td  width="3.5%" align="center">' . $row1['customers'] . '</td>
        <td  width="6.5%" ><b style="font-size: 1em;">คน</b></td>
        <td  width="15%" align="center"><b style="font-size: 1em;">จำนวนมัคคุเทศก์</b></td>  
        <td  width="10%" align="center">0</td>  
        <td  width="4%" align="center"><b style="font-size: 1em;">คน</b></td>  
        <td  width="10%" align="center"><b style="font-size: 1em;">รวม</b></td>  
        <td  width="10%" align="center">0</td>  
        <td  width="10%" align="center"><b style="font-size: 1em;">คน</b></td>  
    </tr>
    <tr>
      <td  width="30%" ><b style="font-size: 1em;">วันคุ้มครองตามโปรแกรมทัวร์ จำนวน</b></td>
      <td  width="5%" align="center">' . $day . '</td>
      <td  width="10.5%" ><b style="font-size: 1em;">วัน   วันที่เริ่ม</b></td>
      <td  width="21%" align="center">' . $row1['checkin'] . ' เวลา 08.30 น.</td>
      <td  width="10%" align="center"><b style="font-size: 1em;">วันที่สิ้นสุด</b></td>
      <td  width="21%" align="center">' . $row1['checkout'] . ' เวลา 17.30 น.</td>
    </tr>
</table>
    ';
}
if ($noid_booking != null && $noid_booking != "") {
  $idb = $noid_booking;
} else {
  $idb = $id_booking;
}

$sql1 = "SELECT * FROM tb_voucher   WHERE id_bookink ='$idb' AND status ='9'";
$result2 = mysqli_query($connect, $sql1);

$content1 = ' <style>

.tdd tr th{
  border: 1px solid black;
  border-collapse: collapse;
  margin-left: auto; 
  margin-right: auto;
}

</style>

<table style="margin:0px!important;width:100%!important;" class="tdd" align="center">
  <tr >
      <th style="width:25%;">ลำดับ</th>
      <th style="width:50%;">ชื่อ - สกุล</th> 
      <th style="width:25%;">อายุ</th>
    </tr>';

$i = 0;
while ($row1 = mysqli_fetch_assoc($result2)) {
  // echo $i;
  // $id_booking = $row1['id_bookink'];
  $i++;
  $content1 .= '
  
    <tr >
      <th style="width:25%;">' . $i . '</th>
      <th style="width:50%;" >' . $row1['service_name'] . '</th> 
      <th style="width:25%;">' . $row1['note'] . '</th>
    </tr>  
   ';
}

if ($i < 10) {
  for ($j = $i + 1; $j <= 10; $j++) {
    $content1 .= '
                <tr>
                  <th style="width:25%;"></th>
                  <th style="width:50%;"></th>
                  <th style="width:25%;"></th>
                </tr>';
  }
}
$content1 .= ' </table>';
//$content1 .= fetch_data();  


$obj_pdf->writeHTML($content);
$obj_pdf->writeHTML($content1);
// $name = 'Invoice-' . $id_booking . '.pdf';
$obj_pdf->Output("PP", 'I');
