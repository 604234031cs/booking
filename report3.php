<?php
session_start();
header('Content-Type: application/pdf; charset=utf-8', true);
header("Content-type: application/pdf");
header('Content-disposition: inline; filename=Report.pdf');
require_once 'tcpdf/tcpdf.php';
include_once('connectdb.php');

$obj_pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$obj_pdf->SetTitle("voucher ห้องพัก");
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
$obj_pdf->SetFont('angsanaupc', '', 13);
$obj_pdf->AddPage();
$tagvs = array('p' => array(0 => array('h' => 0, 'n' => 0), 1 => array('h' => 0, 'n'
=> 0)));
$obj_pdf->setHtmlVSpace($tagvs);
$obj_pdf->SetCellPadding(0.02);
$obj_pdf->setCellHeightRatio(0.98);
$obj_pdf->setCellPaddings($left = '0', $top = '0', $right = '0', $bottom = '0');
$image_file = 'img/' . 'logo.png';
$obj_pdf->Image($image_file, 18, 4, 30, '', 'png', '', 'c', false, 100, '', false, false, 0, false, false, false);




//$connect = mysqli_connect("localhost", "thechic_resort", "Aa123654", "thechic_resort");
// $connect = mysqli_connect("localhost", "root", "", "booking"); 
$sql1 = "SELECT * FROM tb_report   WHERE id ='" . $_GET["id"] . "' ";
$result1 = mysqli_query($con, $sql1);



$content = '';
while ($row1 = mysqli_fetch_array($result1)) {
  $sumcustomers = $row1['sum'] / $row1['customers'];
  $id_booking = $row1['id_booking'];

  if ($row1['extrabed'] == '0') {
    $bed = "";
  }
  if ($row1['noid_booking'] != null && $row1['noid_booking'] != "") {
    $sql2 = "  SELECT * FROM `tb_voucher` WHERE `id_bookink` = '" . $row1['noid_booking'] . "' AND `status` LIKE '3'";
  } else {
    $sql2 = "  SELECT * FROM `tb_voucher` WHERE `id_bookink` = '" . $row1['id_booking'] . "' AND `status` LIKE '3'";
  }


  $result2 = mysqli_query($con, $sql2);

  while ($row2 = mysqli_fetch_array($result2)) {

    $content .= '
       <table style="padding:0px!important;margin:0px!important;width:100%" cellspacing="0" cellpadding="0">
       <tr>
         <td style="padding:0px!important;margin:0px!important;width:25%" rowspan="5">&nbsp;</td>
         <td style="padding:0px!important;margin:0px!important;width:45%;font-size:1.2em;"><b style="font-size: 1.2em;color:black">Khemtis Itinerary Co.,Ltd.</b></td>
         <td style="padding:0px!important;margin:0px!important;width:30%" rowspan="5">
     <table style="width:100%">
          <tr>
             <td width="100%" align="center">
                 <b style="font-size: 1.5em;color:black">BOOKING</b><br>
                 <b style="font-size: 1.5em;color:red;">CONFIRMATION</b><br>
                
               </td>
             </tr>
         </table>
         </td>
       </tr>
       <tr><td style="padding:0px!important;margin:0px!important;height:5px!important">1168 หมูที่  2 ตำบลปากน้ำ อำเภอละงู จังหวัดสตลู 91110</td></tr>
       <tr><td style="padding:0px!important;margin:0px!important">Office : 061-6207959, 061-6207923</td></tr>
       <tr><td style="padding:0px!important;margin:0px!important">E- mail : sale@khemtis.com, Website : www.khemtis.com</td></tr>
       <tr><td style="padding:0px!important;margin:0px!important">ใบอนุญาติประกอบธุรกิจนำเทียว : <b style="font-size: 1.2em;color:black">42/00299</b></td></tr>
     </table>
    
     <table class="first" cellpadding="2" cellspacing="0"  width="100%">
     <tr>
     <td colspan=4><table class="first"  width="100%" cellpadding="0" cellspacing="3"><tr><td style="height:1px;width:100%;border-bottom: 3px solid #99c5d6">&nbsp;</td></tr></table></td></tr>
       
    </table>
     
     
       ';


    $content .= '
     <table cellpadding="0" cellspacing="0.1" ><tr><td ></td></tr></table>
     <table class="first" cellpadding="5" cellspacing="0" width="100%" style="margin-top:1px!important">
     <tr>
     <td width="25%" style="padding:0px;margin:0px"><p style="font-size: 1em;color:black;padding:0px;margin:0px">เอกสารการจอง : <br>Booking of :</b></td>
     <td   width="25%" style="padding:0px;margin:0px" align="center"><b style="font-size: 1.2em;color:red">' . $_GET["type"] . '</b></td>
     <td width="25%" style="background-color: #DCDCDC;padding:0px;margin:0px"><p style="font-size: 1em;color:black">ชื่อผู้ให้บริการ : <br>Agent :</p></td>
        <td width="25%" style="background-color: #DCDCDC;padding:0px;margin:0px" ><table  style="border:solid 1px #fff;padding:3px;"><tr><td><b style="font-size: 1.2em;color:black">' . $row2['service_name'] . '</b></td></tr></table></td>  
    </tr>
     <tr>
     <td width="25%" ><p style="font-size: 1em;color:black">วันที่จอง : <br>Booking Date :</p></td>
        <td width="25%" align="center"><b style="font-size: 1.2em;">' . $row1['transaction_date'] . '</b></td>
        <td  width="25%" style="background-color: #DCDCDC" ><p style="font-size: 1em;color:black">ประเภทห้องพัก : <br>Room Type  :</p></td>
        <td width="25%" style="background-color: #DCDCDC"><table  style="border:solid 1px #fff;padding:3px;"><tr><td><b style="font-size: 1.2em;color:black">' . $row1['name_resort'] . '</b></td></tr></table></td> 
    </tr>
    <tr>
    <td width="25%" ><p style="font-size: 1em;color:black">เลขที่เอกสาร : <br>Booking ID  :</p></td>
    <td width="25%"  align="center" ><b style="font-size: 1.2em;">' . $row1['id_booking'] . '</b></td>
    <td width="25%" style="background-color: #DCDCDC" ><p style="font-size: 1em;color:black">จำนวนห้อง : <br>Number of Room  :</p></td>
    <td width="25%" style="background-color: #DCDCDC" ><table  style="border:solid 1px #fff;padding:3px;"><tr><td><b style="font-size: 1.2em;color:black">' . $row1['number_of_rooms'] . '</b></td></tr></table></td>
    </tr>

    <tr>
    <td width="25%" ><p style="font-size: 1em;color:black">ชื่อลูกค้า : <br>Client  :</p>    </td>
    <td width="25%" align="center"><b style="font-size: 1.2em;">' . $row1['name'] . '</b></td>
    <td width="25%" style="background-color: #DCDCDC" ><p style="font-size: 1em;color:black">จำนวนวัน : <br>Number of Package  :</p></td>
    <td width="25%" style="background-color: #DCDCDC" ><table  style="border:solid 1px #fff;padding:3px;"><tr><td><b style="font-size: 1.2em;color:black">' . $row1['package'] . '</b></td></tr></table></td>

        
    </tr>
    <tr>
    <td width="25%" ><p style="font-size: 1em;color:black">เบอร์โทร : <br> Phone Number   :</p></td>
    <td width="25%" align="center"><b style="font-size: 1.2em;">' . $row1['phone'] . '</b></td>
    <td width="25%" style="background-color: #DCDCDC" ><p style="font-size: 1em;color:black">เตียงเสริม  : <br>Number of Extra Beds  :</p></td>
    <td width="25%" style="background-color: #DCDCDC" ><table  style="border:solid 1px #fff;padding:3px;"><tr><td><b style="font-size: 1.2em;color:black">' . $row1['extrabed'] . '</b></td></tr></table></td>
 
    </tr>
    <tr>
    <td width="25%" ><p style="font-size: 1em;color:black">จำนวนลูกค้า : <br> Number of Clien  :</p></td>
    <td width="25%" align="center"><b style="font-size: 1.2em;">' . $row1['customers'] . '</b></td>
    <td width="25%" style="background-color: #DCDCDC" ><p style="font-size: 1em;color:black">ผู้ใหญ่  : <br>Number of Adults  :</p></td>
    <td width="25%" style="background-color: #DCDCDC" ><table  style="border:solid 1px #fff;padding:3px;"><tr><td><b style="font-size: 1.2em;color:black">' . $row1['customers'] . '</b></td></tr></table></td>
    </tr>
 
    <tr>
    <td width="25%" ><p style="font-size: 1em;color:black">วันที่เขาพัก : <br> Arrival :</p></td>
    <td width="25%" align="center"><b style="font-size: 1.2em;">' . $row1['checkin'] . '</b></td>
    <td width="25%" style="background-color: #DCDCDC" ><p style="font-size: 1em;color:black">เด็ก : <br>Number of Children :</p></td>
    <td width="25%" style="background-color: #DCDCDC" ><table  style="border:solid 1px #fff;padding:3px;"><tr><td><b style="font-size: 1.2em;color:black">' . $row1['ch1'] . '</b></td></tr></table></td>
    </tr>
    <tr>
    <td width="25%"><p style="font-size: 1em;color:black">วันที่เช็ดเอาท : <br> Departure  :</p></td>
    <td width="25%" align="center"><b style="font-size: 1.2em;">' . $row1['checkout'] . '</b></td>
    <td width="25%" style="background-color: #DCDCDC" ><p style="font-size: 1em;color:black">อายุของเด็ก  : <br>Age of Children  :</p></td>
    <td width="25%" style="background-color: #DCDCDC" ><table  style="border:solid 1px #fff;padding:3px;"><tr><td><b style="font-size: 1.2em;color:black">' . $row1['ch2'] . '</b></td></tr></table></td>
    </tr>
    <table cellpadding="0" cellspacing="0.1" width="100%"><tr><td ></td></tr></table>
    <table class="first" cellpadding="4" cellspacing="0" width="100%"><tr><td>
    <table cellpadding="2" cellspacing="0" width="100%">

    <tr style="background-color: #DCDCDC">
        <td width="25%" ><b style="font-size: 1em;color:black">สิทธิประโยนชที่ไดรับ:</b></td>
        <td width="75%" ><b style="font-size: 1.2em;color:black">' . $row1['note'] . '</b></td>
    </tr> 
    </table>
    </td></tr></table>
        
       
    </table>

  ';

    $content .= '

<br>
<br>
<br>
<br>
<br>
<br>
<br>

    <table width="100%" align="center" >
        <tbody align="center">
            <tr align="center">
                <td align="center" width="50%" style="font-size: 15px; align-items: center;"> </td>
                <td align="center" width="50%" style="font-size: 15px; align-items: center;">' . $_SESSION["Name"] . '</td>
            </tr>
            <tr align="center">
                <td align="center" width="50%" style="font-size: 15px; align-items: center;"></td>
                <td align="center" width="50%" style="font-size: 15px; align-items: center;">Tel : 061-6207959</td>
            </tr>
            
        </tbody>
    </table>

  ';
  }
}
//$content .= fetch_data();  

while (ob_get_level()) {
  ob_end_clean();
}

$name = 'Invoice-' . $id_booking . '.pdf';
$obj_pdf->writeHTML($content);
$obj_pdf->Output($name, 'I');
