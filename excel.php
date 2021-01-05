<?php
header("Content-type: application/vnd.ms-excel");
// header('Content-type: application/csv'); //*** CSV ***//
header("Content-Disposition: attachment; filename=ExcelReport.xls");
?>
<html>

<body>
	<?php
	include_once('connectdb.php');


	$resort_name = $_REQUEST["resort_name"];



	$date_star = $_REQUEST["date_star"];
	$date_end = $_REQUEST["date_end"];



	?>



	<table width="600" border="1">
		<tr>
			<th>
				<div align="center">ID</div>
			</th>
			<th>
				<div align="center">เลขที่ Booking </div>
			</th>
			<th>
				<div align="center">เดือน </div>
			</th>
			<th>
				<div align="center">วันที่ทำรายการ </div>
			</th>
			<th>
				<div align="center">ชื่อลูกค้า </div>
			</th>
			<th>
				<div align="center">เบอร์โทรศัพท์ </div>
			</th>

			<th>
				<div align="center">สถานที่เข้าพัก </div>
			</th>
			<th>
				<div align="center">แพคเกจ </div>
			</th>
			<th>
				<div align="center">จำนวนห้อง </div>
			</th>
			<th>
				<div align="center">เตียงเสริม </div>
			</th>
			<th>
				<div align="center">จำนวนลูกค้า </div>
			</th>
			<th>
				<div align="center">วันที่เช็คอิน </div>
			</th>
			<th>
				<div align="center">วันที่เช็คเอาท์ </div>
			</th>
			<th>
				<div align="center">ยอดขาย </div>
			</th>
			<th>
				<div align="center">มัดจำคงเหลือ </div>
			</th>
			<th>
				<div align="center">ยอดสุทธิ </div>
			</th>
			<th>
				<div align="center">รถ </div>
			</th>
			<th>
				<div align="center">เรือ </div>
			</th>
			<th>
				<div align="center">ดำน้ำ </div>
			</th>
			<th>
				<div align="center">สถานะการชำระเงิน </div>
			</th>
			<th>
				<div align="center">สถานะการเข้าพัก </div>
			</th>
			<th>
				<div align="center">วันที่เก็บเงินมัดจำ </div>
			</th>
			<th>
				<div align="center">ต้นทุน </div>
			</th>
			<th>
				<div align="center">% Com </div>
			</th>
			<th>
				<div align="center">มูลค่าคอมมิชชั่น </div>
			</th>
			<th>
				<div align="center">กำไรขาดทุน </div>
			</th>
			<th>
				<div align="center">หมายเหตุ </div>
			</th>


		</tr>

		<?php
		if ($_REQUEST["resort_name"] == "1") {
			$sql1 = "SELECT * FROM tb_report  WHERE transaction_date >= '$date_star' AND transaction_date <= '$date_end' and noid_booking ='' ";
			// $sql1 = "SELECT tb_report.id, tb_report.id_booking, tb_report.month, tb_report.transaction_date, tb_report.name, tb_report.phone, tb_report.line, tb_report.room_name, tb_report.name_resort,tb_report.package, tb_report.number_of_rooms, tb_report.extrabed, tb_report.customers, tb_report.checkin, tb_report.checkout, 
			// tb_report.Sales, tb_report.deposit, tb_report.sum, tb_report.car, tb_report.boat, tb_report.diving, tb_report.payment_status, tb_report.occupancy_status, tb_report.collection_date, tb_report.com, tb_report.commission_value, tb_report.insurance, tb_report.slip, tb_report.Byyy, tb_report.adult, tb_report.note, tb_report.details, tb_report.noid_booking,
			//  tb_report.report_status, tb_report.ch1, tb_report.ch2, tb_report.typ_ser, tb_report.status_pay,
			// tb_voucher.service_name,tb_voucher.voucher_date, tb_voucher.status
			//  FROM tb_report,tb_voucher
			// WHERE tb_report.id_booking = tb_voucher.id_bookink
			// and tb_report.transaction_date  >= '$date_star' and transaction_date <= '$date_end'";
		} else {
			$sql1 = "SELECT *  FROM tb_report  WHERE transaction_date >= '$date_star' AND transaction_date <= '$date_end' AND room_name = '$resort_name' and noid_booking =''";
			// $sql = "SELECT tb_report.id, tb_report.id_booking, tb_report.month, tb_report.transaction_date, tb_report.name, tb_report.phone, tb_report.line, tb_report.room_name, tb_report.name_resort,tb_report.package, tb_report.number_of_rooms, tb_report.extrabed, tb_report.customers, tb_report.checkin, tb_report.checkout, 
			// tb_report.Sales, tb_report.deposit, tb_report.sum, tb_report.car, tb_report.boat, tb_report.diving, tb_report.payment_status, tb_report.occupancy_status, tb_report.collection_date, tb_report.com, tb_report.commission_value, tb_report.insurance, tb_report.slip, tb_report.Byyy, tb_report.adult, tb_report.note, tb_report.details, tb_report.noid_booking,
			//  tb_report.report_status, tb_report.ch1, tb_report.ch2, tb_report.typ_ser, tb_report.status_pay,
			// tb_voucher.service_name,tb_voucher.voucher_date, tb_voucher.status
			//  FROM tb_report,tb_voucher
			// WHERE tb_report.id_booking = tb_voucher.id_bookink
			// and tb_report.transaction_date  >= '$date_star' and transaction_date <= '$date_end' and tb_report.room_name = '$resort_name'";
		}





		$query1 = mysqli_query($con, $sql1);
		while ($results1 = mysqli_fetch_assoc($query1)) {  ?>



			<tr>
				<td>
					<div align="center"><?php echo $results1["id"]; ?></div>
				</td>
				<td><?php echo $results1["id_booking"]; ?></td>
				<td>
					<?php
					if ($results1["month"] == '12') { ?>
						<p>เดือนธันวาคม</p>
					<?php } else if ($results1["month"] == '1') { ?>
						<p>เดือนมกราคม</p>
					<?php } else if ($results1["month"] == '2') { ?>
						<p>เดือนกุมภาพันธ์</p>
					<?php } else if ($results1["month"] == '3') { ?>
						<p>เดือนมีนาคม</p>
					<?php } else if ($results1["month"] == '4') { ?>
						<p>เดือนเมษายน</p>
					<?php } else if ($results1["month"] == '5') { ?>
						<p>เดือนพฤษาคม</p>
					<?php } else if ($results1["month"] == '6') { ?>
						<p>เดือนมิถุนายน</p>
					<?php } else if ($results1["month"] == '7') { ?>
						<p>เดือนกรกฏาคม</p>
					<?php } else if ($results1["month"] == '8') { ?>
						<p>เดือนสิงหาคม</p>
					<?php } else if ($results1["month"] == '9') { ?>
						<p>เดือนกันยายน</p>
					<?php } else if ($results1["month"] == '10') { ?>
						<p>เดือนตุลาคม</p>
					<?php } else if ($results1["month"] == '11') { ?>
						<p>เดือนพฤศจิกายน</p>
					<?php } ?>
				</td>
				<td><?php echo $results1["transaction_date"]; ?></td>
				<td><?php echo $results1["name"]; ?></td>
				<td><?php echo $results1["phone"]; ?></td>
				<!-- 	<td><?php echo $results1["room_name"]; ?></td> -->
				<td><?php echo $results1["name_resort"]; ?></td>
				<td><?php echo $results1["package"]; ?></td>
				<td><?php echo $results1["number_of_rooms"]; ?></td>
				<td><?php echo $results1["extrabed"]; ?></td>
				<td><?php echo $results1["customers"]; ?></td>
				<td><?php echo $results1["checkin"]; ?></td>
				<td><?php echo $results1["checkout"]; ?></td>
				<td><?php echo $results1["Sales"]; ?></td>
				<td><?php echo $results1["deposit"]; ?></td>
				<td><?php echo $results1["sum"]; ?></td>
				<td><?php

					if ($results1["car"] != 0) {
						$id = $results1["id_booking"];
						$sqlc = "SELECT tb_voucher.service_name 
						FROM tb_voucher,tb_report
						where tb_voucher.id_bookink = tb_report.id_booking
						and  tb_voucher.status = 1
						and tb_report.id_booking='$id'";
						$queryc = mysqli_query($con, $sqlc);
						while ($resultscar = mysqli_fetch_assoc($queryc)) {
							echo $resultscar['service_name'];
						}
					} else {
						echo "<center>-</center>";
					}
					?>

				</td>
				<td><?php
					if ($results1["boat"] != 0) {
						$id = $results1["id_booking"];
						$sqlb = "SELECT tb_voucher.service_name 
						FROM tb_voucher,tb_report
						where tb_voucher.id_bookink =tb_report.id_booking
						and  tb_voucher.status = 2
						and tb_report.id_booking='$id'";
						$queryb = mysqli_query($con, $sqlb);
						while ($resultsboat = mysqli_fetch_assoc($queryb)) {
							echo $resultsboat['service_name'];
						}
					} else {
						echo "<center>-</center>";
					}
					?></td>
				<td>
					<?php
					if ($results1["diving"] != 0) {
						$id = $results1["id_booking"];
						$sqld = "SELECT tb_voucher.service_name 
					FROM tb_voucher,tb_report
					where tb_voucher.id_bookink = tb_report.id_booking
					and  tb_voucher.status = 3
					and tb_report.id_booking='$id'";
						$queryd = mysqli_query($con, $sqld);
						while ($resultsdiving = mysqli_fetch_assoc($queryd)) {
							echo $resultsdiving['service_name'];
						}
					} else {
						echo "<center>-</center>";
					}
					?>
				</td>
				<td>
					<?php
					if ($results1["Sales"] == $results1["sum"]) { ?>
						<b> ชำระเงินเรียบร้อย</b>
					<?php } else { ?>
						<?php if ($results1['report_status'] == 4) { ?>
							<b style="color: red;">จ่ายมัดจำ (ยกเลิก)</b>
						<?php }else{ ?>
							<b style="color: red;">จ่ายมัดจำ</b>
						<?php } ?>
					
					<?php } ?>

				</td>

				<td>

					<?php
					$today = date("Y-m-d ");
					$timestamp1 = strtotime($today);
					$checkin = strtotime($results1["checkin"]);
					if ($checkin <= $timestamp1) { ?>
						<b> เข้าพักแล้ว</b>
					<?php } else { ?>
						<b style="color: red;">ยังไม่เข้าพัก</b>
					<?php } ?>

				</td>
				<td><?php echo $results1["collection_date"]; ?></td>
				<td>----</td>
				<td><?php echo $results1["com"]; ?></td>
				<td><?php echo $results1["commission_value"]; ?></td>
				<td>----</td>

				<td><?php echo $results1["note"]; ?></td>

			</tr>

		<?php  } ?>


	</table>





</body>

</html>