<?php
include_once('head.php');
include_once("connectdb.php");

error_reporting(0);
$type = $_REQUEST['type'];

if ($type == "addresort") {
	// เพิ่มรีสอร์ท
	$resort_name = $_REQUEST['resort_name'];
	$sqlcheck = "SELECT * FROM tb_resort where resort_name = '$resort_name'";
	$results = mysqli_query($con, $sqlcheck);
	$results11 = mysqli_fetch_assoc($results);
	if ($results11 != null) {
		echo "<div>
		<script>
		swal('เกิดข้อผิดพลาด!!','มีข้อมูลอยู่ในระบบแล้ว','error')
		.then(() => {
			setTimeout(function(){ 
				window.location.href='addresort.php'
			}, 1000);
		});
		</script></div>";
	} else {
		$sql = "INSERT INTO tb_resort (id, resort_name, resort_status) VALUES (NULL,  '$resort_name', '1')";
		if (mysqli_query($con, $sql)) {
			echo "<div><script>
			swal('สำเร็จ!','เพิ่มข้อมูลรีสอร์ทเรียบร้อย', 'success')
			.then(() => {
				setTimeout(function(){ 
					window.location.href='addresort.php'
				}, 1000);
			});</script></div>";
		} else {
			echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
		}
	}
} else if ($type == "addroomtype") {
	// เพิ่มประเภทห้องพัก , ราคาห้องพัก
	// echo "***-**-*--";
	// $name_roomtype = $_REQUEST[ 'name_roomtype' ];
	// $price_roomtype = $_REQUEST[ 'price_roomtype' ];
	// $price_monday = $_REQUEST[ 'price_monday' ];
	// $price_friday = $_REQUEST[ 'price_friday' ];
	// $extrabed = $_REQUEST[ 'extrabed' ];
	$id_resort = $_POST['id_resort'];
	// echo (int)$_POST["hdnCount"];
	// echo $_REQUEST['id_resort'];
	// $high_season1 = $_REQUEST[ 'high_season1' ];
	// $peak_season = $_REQUEST[ 'peak_season' ];
	// $high_season2 = $_REQUEST[ 'high_season2' ];
	// $green_season = $_REQUEST[ 'green_season' ];
	// echo $_POST["name_roomtype1"];

	for ($i = 0; $i <= (int)$_POST["hdnCount"]; $i++) {

		if (isset($_POST["name_roomtype$i"])) {

			if ($_POST["name_roomtype$i"] != "" && $_POST["price_roomtype$i"] != "" && $_POST["extrabed$i"] != "" && $_POST["capacity$i"] != "") {

				$sql = "INSERT INTO `tb_roomtype` (`id`, `name_roomtype`, `price_roomtype`, `price_monday`, `price_friday`, `extrabed`, `high_season1`, `peak_season`, `high_season2`, `green_season`, `id_resort`, `capacity`, `status`) VALUES (NULL, '" . $_POST["name_roomtype$i"] . "', '" . $_POST["price_roomtype$i"] . "', '0', '0', '" . $_POST["extrabed$i"] . "', '0', '0', '0', '0', '" . $id_resort . "', '" . $_POST["capacity$i"] . "', '1');";
				$query = mysqli_query($con, $sql);
				// echo "<script> alert('ได้ทำการเพิ่มประเภทห้องพัก , ราคาห้องพัก เรียบร้อย!!');window.location.href='addroomtype.php';</script>";
				echo "<div><script>
			swal('สำเร็จ!','เพิ่มข้อมูลห้องพักเรียบร้อย', 'success')
			.then(() => {
				setTimeout(function(){ 
					window.location.href='edit.php'
				}, 1000);
			});</script></div>";
			} else {
				// echo "Err";
				// echo "<script> alert('!!เกิดข้อผิดพลาด ไม่มีข้อมูล , ราคาห้องพัก เรียบร้อย!!');window.location.href='addroomtype.php';</script>";
				// 	echo "<div><script>
				// swal('เกิดข้อผิดพลาด!','เพิ่มข้อมูลห้องพักเรียบร้อย', 'success')
				// .then(() => {
				// 	setTimeout(function(){ 
				// 		window.location.href='addroomtype.php'
				// 	}, 1000);
				// });</script></div>";
			}
		}
	}
} else if ($type == "addprice") {
	// echo $_POST['name'];
	// echo $_POST['price'];

	$name = $_POST['name'];
	$price = $_POST['price'];

	$sql = "INSERT INTO tb_car_boat_diving(id,name,price,status) VALUE(null,'$name','$price','1')";
	$query = mysqli_query($con, $sql);
	// echo "<script> alert('ได้ทำการเพิ่มแพจเกจเสริมเรียบร้อย!!');window.location.href='editprice.php';</script>";
} else if ($type == "editprice") {
	$name = $_POST['name'];
	$price = $_POST['price'];
	$id = $_POST['id'];
	$sql = "UPDATE tb_car_boat_diving SET name='$name',price='$price' where id='$id'";
	if (mysqli_query($con, $sql)) {

		// echo "<script> alert('ได้ทำการแก้ไขข้อมูล เรียบร้อย!!');window.location.href='editprice.php';</script>";
		echo "<div>
		<script>
		swal('สำเร็จ!!','อัปเดตข้อมูลเรียบร้อย','success')
		.then(() => {
			setTimeout(function(){ 
				window.location.href='editprice.php'
			}, 1000);
		});
		</script></div>";
	} else {
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
	}
} else if ($type == "edit") {

	// แก้ไขราคาห้องพัก
	$id = $_REQUEST['id'];
	$resort_name = $_REQUEST['resort_name'];
	$price_roomtype = $_REQUEST['price_roomtype'];
	$capacity = $_REQUEST['capacity'];
	$name_roomtype = $_REQUEST['name_roomtype'];
	$extrabed = $_REQUEST['extrabed'];
	// $high_season1 = $_REQUEST[ 'high_season1' ];
	// $peak_season = $_REQUEST[ 'peak_season' ];
	// $high_season2 = $_REQUEST[ 'high_season2' ];
	// $green_season = $_REQUEST[ 'green_season' ];

	$sql = "UPDATE `tb_roomtype` SET `name_roomtype` = '$name_roomtype', `price_roomtype` = '$price_roomtype', `extrabed` = '$extrabed', `capacity` = '$capacity' WHERE `tb_roomtype`.`id` = $id;";

	if (mysqli_query($con, $sql)) {
		// echo "<script> alert('ได้ทำการแก้ไขข้อมูลห้องพัก เรียบร้อย!!');window.location.href='edit.php?id=$resort_name';</script>";
		echo "<div>
		<script>
		swal('สำเร็จ!!','อัปเดตข้อมูลห้องพักเรียบร้อย','success')
		.then(() => {
			setTimeout(function(){ 
				window.location.href='edit.php'
			}, 1000);
		});
		</script></div>";
	} else {
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
	}
} else if ($type == "editresort") {

	// แก้ไขชื่อรีสอร์ท
	$id = $_REQUEST['id'];
	$resort_name = $_REQUEST['resort_name'];
	$sqlcheck = "SELECT * FROM tb_resort where resort_name = '$resort_name'";
	$results = mysqli_query($con, $sqlcheck);
	$results11 = mysqli_fetch_assoc($results);
	if ($results11 != null) {
		echo "<div>
		<script>
		swal('เกิดข้อผิดพลาด!!','มีข้อมูลอยู่ในระบบแล้ว','error')
		.then(() => {
			setTimeout(function(){ 
				window.location.href='addresort.php'
			}, 1000);
		});
		</script></div>";
	} else {
		$sql = "UPDATE `tb_resort` SET `resort_name` = '$resort_name' WHERE `tb_resort`.`id` = $id;";

		if (mysqli_query($con, $sql)) {
			echo "<div><script>
			swal('สำเร็จ!','อัปเดตข้อมูลเรียบร้อย', 'success')
			.then(() => {
				setTimeout(function(){ 
					window.location.href='addresort.php'
				}, 1000);
			});</script></div>";
		} else {
			echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
		}
	}
} else if ($type == "edit_personal") {

	// แก้ไขข้อมูลส่วนตัว
	$UserID = $_REQUEST['UserID'];
	$Password = $_REQUEST['Password'];
	$Name = $_REQUEST['Name'];



	$sql = "UPDATE `adminlog` SET `Password` = '$Password',`Name` = '$Name' WHERE `adminlog`.`UserID` = $UserID;";

	if (mysqli_query($con, $sql)) {
		// echo "<script> alert('ได้ทำการแก้ไขข้อมูลของท่านเรียบร้อย!!');window.location.href='edit_personal.php';</script>";
		echo "<div><script>
			swal('สำเร็จ!','อัปเดตข้อมูลเรียบร้อย', 'success')
			.then(() => {
				setTimeout(function(){ 
					window.location.href='edit_personal.php'
				}, 1000);
			});</script></div>";
	} else {
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
	}
} else if ($type == "addpersonal") {

	// แก้ไขชื่อรีสอร์ท
	$Username = $_REQUEST['Username'];
	$Password = $_REQUEST['Password'];
	$Name = $_REQUEST['Name'];
	$status = $_REQUEST['status'];



	$sql = "INSERT INTO `adminlog` (`UserID`, `Username`, `Password`, `Name`, `LoginStatus`, `status`, `LastUpdate`) VALUES (NULL,  '$Username', '$Password', '$Name', '0', '$status', '2020-10-30 13:16:59');";



	if (mysqli_query($con, $sql)) {
		// echo "<script> alert('ได้ทำการเพิ่มเรียบร้อย!!');window.location.href='personal.php';</script>";
		echo "<div><script>
			swal('สำเร็จ!','ได้ทำการเพิ่มเรียบร้อย', 'success')
			.then(() => {
				setTimeout(function(){ 
					window.location.href='personal.php'
				}, 1000);
			});</script></div>";
	} else {
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
	}
} else if ($type == "deleteresort") {
	// ลบชื่อรีสอร์ท
	$id = $_REQUEST['id'];
	$sql = "SELECT * FROM tb_roomtype WHERE id_resort ='$id'";
	$results = mysqli_query($con, $sql);
	$results11 = mysqli_fetch_array($results);
	$statusdel;
	if ($results11 != null) {
		$statusdel = 1;
		echo json_encode($statusdel);
	} else {
		$statusdel = 0;
		echo json_encode($statusdel);
	}
} elseif ($type == "delresort") {
	$id = $_REQUEST['id'];
	$sql = "DELETE FROM `tb_resort` WHERE `tb_resort`.`id` = '$id'";

	if (mysqli_query($con, $sql)) {

		// echo "<script>window.location.href='addresort.php';</script>";
	} else {
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
	}
} else if ($type == "deletepersonal") {


	$UserID = $_REQUEST['UserID'];


	$sql = "DELETE FROM `adminlog` WHERE `adminlog`.`UserID` = $UserID;";

	if (mysqli_query($con, $sql)) {
		// echo "<script> alert('ได้ทำการลบชื่อผู้ดูเเล เรียบร้อย!!');window.location.href='personal.php';</script>";
		echo json_encode(1);
	} else {
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
	}
} else if ($type == "deletename_roomtypet") {

	// ลบชื่อรีสอร์ท
	$id = $_REQUEST['id'];

	$sql = "SELECT * FROM priceroom WHERE ID_room ='$id'";
	$results = mysqli_query($con, $sql);
	$results11 = mysqli_fetch_array($results);
	$statusdel;
	if ($results11 != null) {
		$statusdel = 1;
		echo json_encode($statusdel);
	} else {
		$statusdel = 0;
		echo json_encode($statusdel);
	}
} else if ($type == "delroomtype") {
	$id = $_REQUEST['id'];

	$sql = "DELETE FROM `tb_roomtype` WHERE `tb_roomtype`.`id` = $id";

	if (mysqli_query($con, $sql)) {
		// echo "<script> alert('ได้ทำการลบประเภทรีสอร์ท เรียบร้อย!!');window.location.href='edit.php?id=$resort_name';</script>";
	} else {
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
	}
} else if ($type == "thechic") {

	// ลบชื่อรีสอร์ท

	$id_booking = $_REQUEST['id_booking'];
	$Sales1 = $_REQUEST['Sales'];
	$deposit1 = $_REQUEST['deposit'];
	$sum = $_REQUEST['sum'];
	$note = $_REQUEST['note'];
	$Sales2 = $Sales1 + $deposit1;
	$deposi2 = $sum - $Sales2;


	//$sql = "UPDATE `tb_report` SET `Sales` = '".$Sales2."', `deposit` = '".$deposi2."' WHERE `tb_report`.`id_booking` = '$id_booking';";
	$sql = "UPDATE `tb_report` SET `report_status` = '2'  WHERE `tb_report`.`id_booking` = '$id_booking'";

	if (mysqli_query($con, $sql)) {


		$last5 = "SELECT * FROM `tb_report` WHERE `id_booking` LIKE '$id_booking' ";
		$re5 = mysqli_query($con, $last5);
		$ss5 = mysqli_fetch_assoc($re5);

		$month = $ss5['month'];
		$name = $ss5['name'];
		$phone = $ss5['phone'];
		$line = $ss5['line'];
		$room_name = $ss5['room_name'];
		$name_resort = $ss5['name_resort'];
		$package = $ss5['package'];
		$number_of_rooms = $ss5['number_of_rooms'];
		$extrabed = $ss5['extrabed'];
		$customers = $ss5['customers'];
		$checkin = $ss5['checkin'];

		$checkout = $ss5['checkout'];
		$deposit = $ss5['deposit'];
		$car = $ss5['car'];
		$boat = $ss5['boat'];
		$diving = $ss5['diving'];
		$com = $ss5['com'];
		$commission_value = $ss5['commission_value'];
		$insurance = $ss5['insurance'];
		$adult = $ss5['adult'];
		$id_booking = $ss5['id_booking'];
		$note = $ss5['note'];
		$Byyy = $ss5['Byyy'];
		$note55 = $ss5['note'] . " " . "$id_booking";
		$ch1 = $ss5['ch1'];
		$ch2 = $ss5['ch2'];
		$typ_ser = $ss5['typ_ser'];
		$status_pay = 2;


		$fileName = $_FILES['file']['name'];
		// $name_roomtype = $ss5['name_roomtype'];

		$upload_dir = "img/slips/";
		$uploaded_file = $upload_dir . $fileName;

		// $Sales2

		if (move_uploaded_file($_FILES['file']['tmp_name'], $uploaded_file)) {


			$strSQL = "INSERT INTO `tb_report` (`id`, `id_booking`, `month`, `transaction_date`, `name`, `phone`, `line`, `room_name`, `name_resort`, `package`, `number_of_rooms`, `extrabed`, `customers`, `checkin`, `checkout`, `Sales`, `deposit`, `sum`, `car`, `boat`, `diving`, `payment_status`, `occupancy_status`, `collection_date`, `com`, `commission_value`, `insurance`, `slip`, `Byyy`, `adult`,`noid_booking`, `note`, `details`, `report_status`,ch1,ch2,typ_ser,status_pay) VALUES (NULL,'', '$month', NOW(), '$name', '$phone', '$line', '$room_name', '$name_resort', '$package', '$number_of_rooms', '$extrabed', '$customers', '$checkin', '$checkout', '$deposit1' , '$deposit2', '$sum', '$car ', '$boat', '$diving', '1', '1', NOW(), '$com', '$commission_value', '$insurance', '$fileName', '$Byyy', '$adult', '$id_booking', '$note', '', '3','$ch1','$ch2','$typ_ser','$status_pay')";


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
				echo $row;
				if ($row <= 0) {
					$num = substr("0000" . 1, -4);
					$text = "" . $num . "-" . $ytsever;
					$in = " UPDATE `tb_report` SET `id_booking` = '" . $text . "' WHERE `tb_report`.`id` ='" . $ss['id'] . "'";
					$a = mysqli_query($con, $in);
				} else {

					$num = substr("0000" . $row, -4);
					$text = "" . $num . "-" . $ytsever;
					$in = " UPDATE `tb_report` SET `id_booking` = '" . $text . "' WHERE `tb_report`.`id` ='" . $ss['id'] . "'";
					$a = mysqli_query($con, $in);
				}

				// echo "<script> alert('ได้ทำการลบประเภทรีสอร์ท เรียบร้อย!!');window.location.href='edit.php?id=$resort_name';</script>";

				//----------------------- LINE-------------------
				$Token = "LLHQCmiOVjOjpwiAAiblUjOONK5kUqEVyObBCNwdTIL";
				// $Token = "etxmEbZ2cY5OvNGJtUS5dJcaR1gXVbdmpiJ0tuRCVTY";
				// $message = "\nเลขที่ " . $text . "\nชื่อลูกค้า :" . $name . " \nโรงเเรมที่จอง: " . $room_name . "\nวันที่เช็คอิน: " . $checkin . "\nวันที่เช็คเอาท์: " . $checkout . "\nยอดคงเหลือ 0\nยอดเงินในการชำระ: " . $deposit1 . "\nยอดสุทธิ: " . $sum;
				$message = "\nเลขที่ " . $text . "\nชื่อลูกค้า : " . $name . " \nโรงเเรมที่จอง : " . $room_name . "\nวันที่เช็คอิน : " . $checkin . "\nวันที่เช็คเอาท์ : " . $checkout . "\nยอดคงเหลือ : 0\nยอดเงินในการชำระ : " . number_format($deposit1) . "\nยอดสุทธิ : " . number_format($sum);



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
				//------------------------------------end LINE----------------------------------------------

				// echo "<script> alert('ได้ทำการจ่ายยอดที่เหลือ เรียบร้อย!!');window.location.href='report.php?';</script>";
				echo "<div><script>
			swal('สำเร็จ!','ได้ทำการจ่ายยอดที่เหลือ เรียบร้อย', 'success')
			.then(() => {
				setTimeout(function(){ 
					window.location.href='report.php'
				}, 1000);
			});</script></div>";
			}
		}

		// echo "<script> alert('ได้ทำการลบประเภทรีสอร์ท เรียบร้อย!!');window.location.href='report.php?';</script>";
	}
} else if ($type == 'cancelbooking') {
	// echo $_GET['id_report'];

	$id_report = $_GET['id_report'];
	$sql = "UPDATE tb_report set report_status = 4 where id = '$id_report'";


	$a = mysqli_query($con, $sql);
	if ($a == true) {
		echo json_encode(2);
	}
	// echo "<div><script>
	// 		swal('สำเร็จ!','ได้ทำการยกเลิกเรียบร้อย', 'success')
	// 		.then(() => {
	// 			setTimeout(function(){ 
	// 				window.location.href='report.php'
	// 			}, 1000);
	// 		});</script></div>";
}


mysqli_close($con);
