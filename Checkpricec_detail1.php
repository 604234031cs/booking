<!DOCTYPE html>
<html>

<?php include "head.php"; ?>
<?php
$page = 'index';
session_start();
if ($_SESSION['Username'] == "") {
  echo "<script> alert('Please Login!!');window.location.href='login.php';</script>";
  exit();
} ?>

<?php

include_once('connectdb.php');

error_reporting(level);
$name = $_REQUEST['id'];
$name_roomtype = $_REQUEST['name_roomtype'];
$Checkin = $_REQUEST['Checkin'];
$Checkout = $_REQUEST['Checkout'];

$car = $_REQUEST['car'];
$boat = $_REQUEST['boat'];
$diving = $_REQUEST['diving'];

$insurance = $_REQUEST['insurance'];

$t1 = $_SESSION['tdiving'];
$t2 =  $_SESSION['tboast'];
$t3 = $_SESSION['tcar'];




$car55 = $_REQUEST['car'];
$boat55 = $_REQUEST['boat'];
$diving55 = $_REQUEST['diving'];
$adult = $_REQUEST['adult'];
$older_children = $_REQUEST['older_children'];
$child = $_REQUEST['child'];

$id_tb_resort = $_REQUEST['id_tb_resort'];
$Checkin55 = isset($_POST['Checkin']) ? $_POST['Checkin'] : '';
$Checkout55 = isset($_POST['Checkout']) ? $_POST['Checkout'] : '';
$datetime1 = new DateTime($Checkin55);

$datetime2 = new DateTime($Checkout55);
$interval = $datetime1->diff($datetime2);
// $diff_result = $interval->format('%y ปี %m เดือน  %d วัน');
$diff_result = $interval->format('%d');

$sql = "SELECT * FROM tb_resort WHERE  id = '$name'";
$querydata = mysqli_query($con, $sql);
$resort = mysqli_fetch_assoc($querydata);
// while($resort = mysqli_fetch_assoc($querydata)){
//     $res_name = $resort['resort_name'];
// }





$sql33 = "SELECT * FROM tb_car_boat_diving WHERE name='$t3'";
$query33 = mysqli_query($con, $sql33);
$results33 = mysqli_fetch_assoc($query33);

// while ($results33 = mysqli_fetch_assoc($query33)) {

$car_num1 = $results33["price"];

// }


$sql44 = "SELECT * FROM `tb_car_boat_diving` WHERE `name` = '$t2'";
$query44 = mysqli_query($con, $sql44);
while ($results44 = mysqli_fetch_assoc($query44)) {

  $boat_num1 = $results44["price"];
}


if ($car == "on") {
  $car = "ได้เพิ่มรถ";
  $car_num = $car_num1;
} else {
  $car = "";
  $car_num = "0";
}

if ($boat == "on") {
  $boat = "ได้เพิ่มเรือ";
  $boat_num = $boat_num1;
} else {
  $boat = "";
  $boat_num = "0";
}


if ($diving != "") {
  $diving = "ได้เพิ่มดำน้ำ";


  $diving_num = $_REQUEST['diving'];
} else {
  $diving = "";
  $diving_num = "0";
}

if ($insurance != "") {
  $insurance = "ได้เพิ่มประกัน";
  $insurance_num = '1';
} else {
  $insurance = "";
  $insurance_num = "0";
}




if ($older_children >= "1") {
  if ($name_roomtype == "9" or $name_roomtype == "10") {
    if ($car != "" && $boat != "" && $diving != "") {
      $sum_adult = $car_num + $boat_num + $diving_num;
      $sum = ($car_num + $boat_num + $diving_num);
      $text = "";
    } else {
      $sum_adult = $car_num + $boat_num + $diving_num;
      $sum = $car_num + $boat_num + $diving_num;
      $text = "";
    }
  } else {
    if ($car != "" && $boat != "" && $diving != "") {
      $sum_adult = $car_num + $boat_num + $diving_num;
      $sum = ($car_num + $boat_num + $diving_num) - 1000;
      $text = "(ส่วนลด 1,000 ต่อท่าน)";
    } else {
      $sum_adult = $car_num + $boat_num + $diving_num;
      $sum = $car_num + $boat_num + $diving_num;
      $text = "";
    }
  }
} else {
  $sum_adult = $car_num + $boat_num + $diving_num;
  $sum = $car_num + $boat_num + $diving_num;
  $text = "";
}



?>

<body>
  <!--         <div class="pre-loader">
    		<div class="pre-loader-box">
    			<div class="loader-logo"><img src="vendors/images/deskapp-logo.svg" alt=""></div>
    			<div class='loader-progress' id="progress_div">
    				<div class='bar' id='bar1'></div>
    			</div>
    			<div class='percent' id='percent1'>0%</div>
    			<div class="loading-text">
    				กำลังตรวจสอบ...
    			</div>
    		</div>
	   </div> -->
  <?php include "header.php"; ?>

  <div class="main-container">
   
    <div class="pd-ltr-20">
      <div class="card-box pd-20 height-100-p mb-30">
        <div class="row align-items-center">
          <div class="col-md-4">
            <img src="vendors/images/banner-img.png" alt="" />
          </div>
          <div class="col-md-8">
            <h4 class="font-20 weight-500 mb-10 text-capitalize">
              Welcome Akira Lipe , Ananya Lipe , Thechic Lipe 
              <div class="weight-600 font-30 text-blue">รายละเอียดเช็คราคาห้องพักของแต่ละรีสอร์ท</div>
            </h4>
          </div>
        </div>
      </div>



      <?php
      $i = 1;
      $sql = "SELECT * FROM `tb_roomtype` WHERE `id` = '" . $name_roomtype . "'";
      $query = mysqli_query($con, $sql);
      while ($results = mysqli_fetch_assoc($query)) {
        $source = $Checkin;
        $date = new DateTime($source);
        $date_checkin_m = $date->format('m');
        $date_checkin_d = $date->format('D');
        $diff = $diff_result - 1;
        $arrDate = [];
        for ($i = 0; $i <= $diff; $i++) {

          array_push($arrDate,  date("Y-m-d", strtotime("+$i days", strtotime($Checkin))));
          $datedate55 = date("Y-m-d", strtotime("+$diff days", strtotime($Checkin)));
          $sql55 = "SELECT * FROM `priceroom` WHERE `date_start` = '" . $datedate55 . "' AND `ID_room` = '" . $name_roomtype . "'";
          $query55 = mysqli_query($con, $sql55);
          while ($results55 = mysqli_fetch_assoc($query55)) {
            $results55["price_room"];
            $sum_price_room1 += $results55["price_room"];
          }
        }
      
        $sum_price_room;     // ค่าทั้งหมด
        //print_r($arrDate);
        //echo $date_checkin_d;
        //$datedate = date ("Y-m-d", strtotime("+$diff days", strtotime($Checkin)));



        if ($adult == 1) {
          echo $sum_price_room  =  $sum_price_room1;
          $extrabed =  '0';
        } else if ($adult % 2 == 0) {
          $sum_price_room  =  $sum_price_room1 * ($adult / 2);
          $extrabed =  '0';
        } else {
          if ($adult == 3) {
            $sum_price_room  =  ((($sum_price_room1) + ($sum_price_room1 / 2)));
            $extrabed =  '1';
          } else if ($adult == 5) {
            $sum_price_room  =  ((($sum_price_room1 * 2) + ($sum_price_room1 / 2)));
            $extrabed =  '1';
          } else if ($adult == 7) {
            $sum_price_room  =  ((($sum_price_room1 * 3) + ($sum_price_room1 / 2)));
            $extrabed =  '1';
          } else if ($adult == 9) {
            $sum_price_room  =  ((($sum_price_room1 * 4) + ($sum_price_room1 / 2)));
            $extrabed =  '1';
          } else if ($adult == 11) {
            $sum_price_room  =  ((($sum_price_room1 * 5) + ($sum_price_room1 / 2)));
            $extrabed =  '1';
          }
        }


      ?>



        <script>
          function autoselect(value) {
            // console.log(value);
            $.ajax({
              url: "ajaxdata.php?page=checkprice&&id=" + value,
              type: "GET",
              success: function(result) {
                let ajaxdata = JSON.parse(result);
                // console.log(ajaxdata);
                $("#name_roomtype").empty();
                for (let i = 0; i < ajaxdata.length; i++) {
                  // console.log(ajaxdata[i]);
                  $("#name_roomtype").append("<option value=" + ajaxdata[i]['id'] + ">" + ajaxdata[i]['name_roomtype'] + "</option>");
                }
                // console.log(result);
              }
            });
          }
        </script>

        <div class="pd-20 card-box mb-30">
          <form action="Checkpricec_detail1.php" method="post">
            <div class="row" style="padding-top: 35px;padding-bottom: 20px;">
              <div class="col-md-6 col-sm-12">
                <div class="form-group">

                  <label>
                    <h4 class="text-blue h4">ที่พัก <?php echo $sum_price_room; ?></h4>
                  </label>
                  <!-- <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" readonly=""> -->
                  <select class="custom-select col-12" id="id" name="id" onchange="autoselect(this.value)">
                    <?php
                    $sql5 = "SELECT * FROM `tb_resort` WHERE `id` = '" . $_POST['id'] . "'";
                    $query5 = mysqli_query($con, $sql5);
                    $results5 = mysqli_fetch_assoc($query5);
                    echo "<option value='$results5[id]'>$results5[resort_name]</option>";

                    ?>

                    <?php
                    // Fetch Department
                    $sql5 = "SELECT * FROM tb_resort";
                    $query5 = mysqli_query($con, $sql5);
                    while ($results1 = mysqli_fetch_assoc($query5)) : ?>

                      <option value="<?php echo $results1["id"]; ?>"><?php echo $results1["resort_name"]; ?></option>
                    <?php endwhile; ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="form-group">
                  <label>
                    <h4 class="text-blue h4">ประเภทห้องพัก</h4>
                  </label>
                  <input hidden type="text" name="id_tb_resort" value="<?php echo $id_tb_resort; ?>">
                  <!--  <input type="text" name="" class="form-control" readonly="" value="<?php echo $results["name_roomtype"] ?>"> -->
                  <!--  <input hidden name="name_roomtype" class="form-control" readonly="" value="<?php echo $name_roomtype; ?>"> -->
                  <select class="custom-select col-12" id="name_roomtype" name="name_roomtype">
                    <option value="<?php echo $name_roomtype; ?>"><?php echo $results["name_roomtype"] ?></option>
                    <!-- <?php
                          $sql2 = "SELECT * FROM `tb_roomtype` WHERE `id_resort` = '" . $id_tb_resort . "'";
                          $query2 = mysqli_query($con, $sql2);
                          while ($results2 = mysqli_fetch_assoc($query2)) {  ?>
                      <option value="<?php echo $results2["id"]; ?>"><?php echo $results2["name_roomtype"]; ?></option>
                    <?php  } ?> -->

                  </select>

                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="form-group">
                  <label>
                    <h4 class="text-blue h4">Checkin</h4>
                  </label>



                  <div id="id_startCalendar" class="calendar-widget default-today" data-next="#id_deadlineCalendar" date-min="today" tabindex="-1">
                    <div class="input-wrapper">
                      <label for="type1-start"><b>วันที่ Checkin <?php echo $Checkin = $_REQUEST['Checkin']; ?></b></label>

                      <input class="date-field form-control" id="type1-start" type="text" placeholder="Starting Date" name="Checkin" value="<?php echo $Checkin; ?>" readonly>
                    </div>

                    <div class="calendar-wrapper" style="border:solid 1px #000">
                      <div class="dual-calendar">
                        <div class="calendar">
                          <div class="calendar-header">
                            <div class="prev-btn">
                              <i class="material-icons">
                                <</i> </div> <div class="month-text">
                                  <p>September 2018</p>
                            </div>
                          </div>
                          <div class="calendar-body">
                            <div class="date-table">
                              <div class="date-table-header">
                                <div class="day sunday">S</div>
                                <div class="day">M</div>
                                <div class="day">T</div>
                                <div class="day">W</div>
                                <div class="day">T</div>
                                <div class="day">F</div>
                                <div class="day saturday">S</div>
                              </div>
                              <div class="date-table-body">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="calendar plus-one">
                          <div class="calendar-header">
                            <div class="month-text">
                              <p>September</p>
                            </div>

                            <div class="next-btn">
                              <i class="material-icons">></i>
                            </div>
                          </div>
                          <div class="calendar-body">
                            <div class="date-table">
                              <div class="date-table-header">
                                <div class="day sunday">S</div>
                                <div class="day">M</div>
                                <div class="day">T</div>
                                <div class="day">W</div>
                                <div class="day">T</div>
                                <div class="day">F</div>
                                <div class="day saturday">S</div>
                              </div>
                              <div class="date-table-body">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="form-group">
                  <label>
                    <h4 class="text-blue h4">Checkout</h4>
                  </label>

                  <div id="id_deadlineCalendar" class="calendar-widget linked" tabindex="-1" data-link="#id_startCalendar" date-min="link">
                    <div class="input-wrapper">
                      <label for="type1-deadline"><b>วันที่ Checkout <?php echo $Checkout = $_REQUEST['Checkout']; ?></b></label>
                      <input class="date-field form-control" id="type1-deadline" name="Checkout" type="text" placeholder="Deadline" value="<?php echo $Checkout; ?>" readonly>
                    </div>
                    <div class="calendar-wrapper" style="border:solid 1px #000">
                      <div class="dual-calendar">
                        <div class="calendar">
                          <div class="calendar-header">
                            <div class="prev-btn">
                              <i class="material-icons">
                                <</i> </div> <div class="month-text">
                                  <p>September 2018</p>
                            </div>
                          </div>
                          <div class="calendar-body">
                            <div class="date-table">
                              <div class="date-table-header">
                                <div class="day sunday">S</div>
                                <div class="day">M</div>
                                <div class="day">T</div>
                                <div class="day">W</div>
                                <div class="day">T</div>
                                <div class="day">F</div>
                                <div class="day saturday">S</div>
                              </div>
                              <div class="date-table-body">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="calendar plus-one">
                          <div class="calendar-header">
                            <div class="month-text">
                              <p>September</p>
                            </div>

                            <div class="next-btn">
                              <i class="material-icons">></i>
                            </div>
                          </div>
                          <div class="calendar-body">
                            <div class="date-table">
                              <div class="date-table-header">
                                <div class="day sunday">S</div>
                                <div class="day">M</div>
                                <div class="day">T</div>
                                <div class="day">W</div>
                                <div class="day">T</div>
                                <div class="day">F</div>
                                <div class="day saturday">S</div>
                              </div>
                              <div class="date-table-body">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


              <style type="text/css">
                .inputs {
                  height: 200px;
                  width: 500px;

                  display: flex;
                  flex-direction: column;
                  align-items: flex-start;

                  /*   border: 1px solid white; */
                }

                .inputs>* {
                  margin-bottom: 48px;
                }

                .inputs input {
                  font-family: "Nunito";
                  font-size: 90%;
                }

                /* ============================ */
                /* Type 1 */
                /* ============================ */

                  {
                  display: flex;
                  flex-direction: column;
                }

                .fields {
                  display: flex;
                }



                .date-field {
                  cursor: pointer;
                }

                .calendar-widget {
                  position: relative;
                }

                .calendar-widget:focus {
                  outline: none;
                }

                .calendar-wrapper {
                  display: none;
                  position: absolute;
                  top: 100%;
                  left: 0;
                  padding-top: 8px;

                  z-index: 2;
                }

                .dual-calendar {
                  display: flex;
                  /*   height: 300px; */

                  border-radius: 3px;
                  padding: 16px;
                  box-shadow: var(--shadow-2dp);
                  background-color: white;
                }

                .dual-calendar .calendar:first-child {
                  margin-right: 16px;
                }

                .calendar {
                  width: auto;
                }

                .calendar-header {
                  position: relative;
                  height: 40px;
                  display: flex;
                  align-items: center;
                  justify-content: center;
                }

                .month-text {
                  font-family: "Nunito";
                  color: var(--gray-700);
                }

                .prev-btn,
                .next-btn {
                  cursor: pointer;
                  position: absolute;
                  top: 50%;

                  transform: translateY(-50%);
                  z-index: 1;

                  width: 36px;
                  height: 36px;
                  display: flex;
                  align-items: center;
                  justify-content: center;

                  border: none;
                  border-radius: 50px;
                  box-shadow: var(--shadow-2dp);
                  background-color: var(--primary);
                  color: white;

                  transition: background-color 0.2s, box-shadow 0.2s;
                }

                .prev-btn:hover,
                .next-btn:hover {
                  box-shadow: var(--shadow-4dp);
                  background-color: var(--primary-md);
                }

                .prev-btn:active,
                .next-btn:active {
                  box-shadow: var(--shadow-8dp);
                  background-color: var(--primary-lt);
                }

                .prev-btn.disabled,
                .next-btn.disabled {
                  cursor: default;
                  box-shadow: none;
                  background-color: var(--gray-300);
                  color: var(--gray-500);
                }

                .prev-btn *,
                .next-btn * {
                  user-select: none;
                }

                .prev-btn {
                  left: 0;
                }

                .next-btn {
                  right: 0;
                }

                .date-table-header {
                  display: flex;
                  justify-content: space-between;
                  width: 100%;
                  margin-top: 8px;
                }

                .day {
                  user-select: none;
                  display: flex;
                  align-items: center;
                  justify-content: center;

                  width: 40px;
                  height: 40px;

                  font-weight: 700;

                  color: var(--gray-700);
                }

                .day.saturday {
                  color: var(--primary);
                }

                .day.sunday {
                  color: var(--secondary);
                }


                /* Date Styling */
                .date-table-row {
                  display: flex;
                  height: 40px;
                  justify-content: space-between;
                }

                .date {
                  cursor: pointer;
                  position: relative;
                  display: flex;
                  flex-direction: column;
                  align-items: center;

                  width: 40px;
                  height: 40px;
                  transition: color 0.2s;
                }

                /* DO NOT CHANGE THE ORDER */

                .date.sunday {
                  color: var(--secondary);
                }

                .date.today {
                  color: var(--primary);
                }

                .date.selected {
                  color: white;
                }

                .date.disabled {
                  color: var(--gray-300);
                }

                .date.empty {
                  cursor: default;
                  user-select: none;
                }

                .date * {
                  cursor: pointer;
                  user-select: none;
                }

                .date.disabled * {
                  cursor: not-allowed;
                }

                .date .help-text {
                  position: absolute;
                  top: 0;

                  display: none;
                  align-items: flex-start;
                  justify-content: center;

                  width: 100%;
                  height: 15px;
                  font-size: 10px;
                  z-index: 1;
                }

                .date .date-text {
                  display: flex;
                  justify-content: center;
                  align-items: center;

                  width: 100%;
                  height: 100%;

                  font-size: 90%;

                  z-index: 1;
                }

                .date .date-ripple {
                  position: absolute;
                  top: 50%;
                  left: 50%;
                  transform: translate(-50%, -50%) scale(0);

                  width: 40px;
                  height: 100%;
                  background-color: transparent;

                  will-change: transform;

                  transition: transform 0.18s cubic-bezier(0, .75, .5, 1), background-color 0.2s;
                }

                .date .date-ripple.no-transition {
                  transition: none;
                }

                .date.hover .date-ripple {
                  background-color: var(--gray-300);
                  transform: translate(-50%, -50%) scale(1);
                }

                .date.in-range .date-ripple {
                  background-color: var(--primary-lightest);
                  transform: translate(-50%, -50%) scale(1);
                }

                .date.selected .date-ripple {
                  background-color: var(--primary);
                  transform: translate(-50%, -50%) scale(1);
                }

                .badge {
                  width: 60% !important;
                }
              </style>



              <script type="text/javascript">
                // Time variable queries.
                let today = new Date()
                // All the date should be a NUMBER type!!

                // Variable for storing the selected date data.
                let selDate, selMonth, selYear;

                // To store the date today.
                // Variables with "curr" represents the current displayed data.
                let currYear = thisYear = today.getFullYear();
                let currMonth = thisMonth = new Month(today.getMonth());
                let currDate = today.getDate();
                let startDay555 = new Date(thisMonth.index, thisYear, 1).getDay()

                // Element queries
                const calendarWidgets = document.querySelectorAll(".calendar-widget");

                // ==================================================================
                // _________________________ OBJECTS ________________________________
                // ==================================================================
                function Month(index) {
                  const shortNames = ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sept", "Oct", "Nov", "Dec"];
                  const longNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

                  const numberofDays = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

                  if (currYear % 4 === 0) {
                    numberofDays[1] = 29;
                  }

                  index = index > 11 ? 0 : index;
                  index = index < 0 ? 11 : index;

                  this.index = index;
                  this.shortName = shortNames[index];
                  this.longName = longNames[index];
                  this.length = numberofDays[index];
                }

                // =======================================
                // _____________ FUNCTIONS _______________
                // =======================================

                function getMonthIndex(name) {
                  const shortMonthTable = {
                    "jan": 0,
                    "feb": 1,
                    "mar": 2,
                    "apr": 3,
                    "may": 4,
                    "june": 5,
                    "july": 6,
                    "aug": 7,
                    "sept": 8,
                    "oct": 9,
                    "nov": 10,
                    "dec": 11
                  };

                  const longMonthTable = {
                    "january": 0,
                    "february": 1,
                    "march": 2,
                    "april": 3,
                    "may": 4,
                    "june": 5,
                    "july": 6,
                    "august": 7,
                    "september": 8,
                    "october": 9,
                    "november": 10,
                    "december": 11
                  };
                  name = name.toLowerCase();
                  let index = shortMonthTable[name];
                  if (index === undefined) {
                    index = longMonthTable[name];
                  };
                  return index;
                }

                function getStartDay(year, month) {
                  const startDay = new Date(year, month.index, 1).getDay()
                  return startDay
                }

                function getSelDate(year, month) {
                  // console.log(year === selYear);
                  // console.log(month.index === selMonth.index);
                  if (year === selYear && month.index === selMonth.index) {
                    return selDate
                  }
                }

                function getToday(year, month) {
                  if (year === thisYear && month.index === thisMonth.index) {
                    return today.getDate();
                  }
                }

                function updateSelData(e, dateField) {
                  let fullDate = dateField.value.split(" ");
                  let selData = [];
                  if (fullDate !== "") {
                    selDate = Number(fullDate[0]);
                    selMonth = new Month(getMonthIndex(fullDate[1]));
                    selYear = Number(fullDate[2]);
                    selData = [selDate, selMonth, selYear];
                  }

                  return selData;
                }

                function updateDateField(e, fullDate, dateField) {
                  /* Update the date field of the widget
                   * The date arguments should be a formatted date of DD MMMM YYYY
                   */
                  if (e) {
                    console.log(`Update Date Field called by: ${e.target.tagName}.${e.target.className}`)
                  }

                  dateField.value = fullDate;
                  return fullDate;
                }

                // Cell UI Animation

                function clearSelCell(calendar) {
                  // For single calendar, input the div with calendar class as the arguments, for dual calendar, input the div with "dual-calendar" class as arguments.
                  const cells = calendar.querySelectorAll(".date.selected");
                  cells.forEach(cell => {
                    cell.classList.remove("selected");
                  })
                }

                function highlightCellRange(currCell, calendar) {
                  //For dual calendar, input the div with "dual-calendar" class as arguments.
                  clearSelCell(calendar);

                  let currFullDate = currCell.closest(".calendar").querySelector(".month-text p").textContent.split(" ");
                  const currYear = Number(currFullDate[1]);
                  const currMonth = currFullDate[0];
                  const currDate = Number(currCell.querySelector(".date-text").textContent);
                  currFullDate = new Date(`${currDate} ${currMonth} ${currYear}`)
                  const cells = calendar.querySelectorAll(".date");

                  cells.forEach(cell => {
                    let cellFullDate, cellYear, cellMonth, cellDate;

                    if (!(cell.classList.contains("empty") || cell.classList.contains("disabled"))) {
                      cellFullDate = cell.closest(".calendar").querySelector(".month-text p").textContent.split(" ");
                      cellYear = Number(cellFullDate[1]);
                      cellMonth = cellFullDate[0];
                      cellDate = Number(cell.querySelector(".date-text").textContent);
                      cellFullDate = new Date(`${cellDate} ${cellMonth} ${cellYear}`);

                      // console.log(cellFullDate);
                      // console.log(currFullDate);
                      if (cellFullDate < currFullDate) {
                        cell.classList.add("in-range");
                      } else {
                        cell.classList.remove("in-range");
                      }
                    }
                  })
                }

                function drawTable(e, calendar) {
                  // console.log(`Draw Table called by: ${e.target.tagName}.${e.target.className}`);
                  let month = currMonth;
                  let year = currYear;

                  if (calendar.classList.contains("plus-one")) {
                    monthIndex = currMonth.index + 1;
                    month = new Month(monthIndex);
                    if (monthIndex > 11) {
                      year++;
                    }
                  }

                  const widget = calendar.closest(".calendar-widget");

                  // Change Table Month Name
                  const monthText = calendar.querySelector(".month-text p");
                  monthText.textContent = `${month.longName} ${year}`

                  // Defining variables to create the date table
                  let monthDays = month.length;
                  let start = getStartDay(year, month);
                  let count = 1 - start;
                  let currSelDate = getSelDate(year, month);
                  let todayDate = getToday(year, month);
                  let minDate = widget.getAttribute("date-min");
                  if (minDate !== null) {
                    if (minDate === "today") {
                      minDate = [todayDate, month.index, year];
                    } else if (minDate === "link") {
                      const linkedWidget = document.querySelector(widget.getAttribute("data-link"));
                      const linkedDateField = linkedWidget.querySelector(".date-field");
                      minDate = linkedDateField.value.split(" ");
                      let monthIndex = getMonthIndex(minDate[1]);
                      minDate[1] = monthIndex;
                      console.log(`Linked min Date is: ${minDate}`);
                    } else {
                      minDate = minDate.split("-")
                    }

                    if (year === Number(minDate[2]) && month.index === minDate[1]) {
                      minDate = minDate[0]
                    } else {
                      minDate = undefined;
                    }
                  }

                  // console.log(`Min Date is: ${minDate}`)

                  // console.log(`Current Selected Date: ${currSelDate}`)
                  const tableBody = calendar.querySelector(".date-table-body");
                  while (count <= monthDays) {
                    let row = document.createElement("div"); // Create date rows
                    row.setAttribute("class", "date-table-row");

                    let dayCount = 0; // variable to keep track of the day (e.g. Monday, Tuesday, ... Sunday)

                    // Date cell creation
                    for (i = 0; i < 7; i++) {
                      let cell = document.createElement("div");
                      cell.setAttribute("class", "date");

                      if (count < 1) {
                        cell.classList.add("empty");
                      } else if (count > monthDays) {
                        cell.classList.add("empty");
                      } else {
                        let cellRipple = document.createElement("div"); // Ripple effect, not important
                        let helpText = document.createElement("p"); // Originally intended to show the today's date. Removed.
                        let cellText = document.createElement("p"); // The number inside each date cell

                        cellRipple.setAttribute("class", "date-ripple");
                        cellText.setAttribute("class", "date-text");
                        helpText.setAttribute("class", "help-text");

                        cellText.textContent = count; // Output the current date

                        if (count === todayDate) {
                          helpText.textContent = "today";
                          cell.classList.add("today"); // mark today's date
                        }

                        if (count < minDate) {
                          cell.classList.add("disabled");
                        }

                        // Add a sign showing which date is selected.
                        if (count === currSelDate) {
                          cell.classList.add("selected");
                          cellRipple.classList.add("selected");
                        }

                        if (dayCount === 0) {
                          cell.classList.add("sunday");
                        }

                        cell.appendChild(cellRipple);
                        cell.appendChild(helpText);
                        cell.appendChild(cellText);

                        if (!(cell.classList.contains("disabled") || cell.classList.contains("empty"))) {
                          if (widget.classList.contains("linked")) {
                            cell.addEventListener("mouseenter", function() {
                              highlightCellRange(cell, calendar.closest(".dual-calendar"));
                              cell.classList.add("in-range");
                            })
                          } else {
                            cell.addEventListener("mouseenter", function() {
                              cell.classList.add("hover");
                            })
                            cell.addEventListener("mouseleave", function() {
                              cell.classList.remove("hover");
                            })
                          }

                          cell.addEventListener("click", function(e) {
                            e.stopPropagation();

                            clearSelCell(calendar.closest(".dual-calendar"));
                            cell.classList.add("selected"); //change the cell state to active

                            let dateField = widget.querySelector(".date-field");
                            let fullDate = `${cellText.textContent} ${month.longName} ${year} `
                            updateDateField(e, fullDate, dateField);
                            updateSelData(e, dateField);
                            hideCalendar(e, cell.closest(".calendar-widget"));
                            if (widget.hasAttribute("data-next")) {
                              nextCalendarWidget(e, widget);
                            }
                          })
                        }
                      }

                      row.appendChild(cell);
                      count++;
                      dayCount++;
                    }
                    tableBody.appendChild(row);
                  }
                }

                function clearTable(e, calendar) {
                  // if (e){
                  //   console.log(`Clear table called by: ${e.target.tagName}.${e.target.className}`)
                  // }

                  const tableRows = calendar.querySelectorAll(".date-table-row");
                  if (tableRows.length) {
                    tableRows.forEach(row => {
                      row.remove();
                    })
                  }
                }


                function editBtnListener(widget, minData, maxData) {
                  // console.log(`Edit Btn Listener called.`)
                  // Query the minimum and maximum date from the html data-attributes;
                  let minYear, minMonth, maxYear, maxMonth;
                  if (minData) {
                    minYear = minData["minYear"];
                    minMonth = minData["minMonth"];
                  } else if (widget.getAttribute("date-min") === "today") {
                    minYear = thisYear;
                    minMonth = thisMonth;
                  } else if (widget.getAttribute("date-min") === "link") {
                    const linkedWidget = document.querySelector(widget.getAttribute("data-link"));
                    const linkedDateField = linkedWidget.querySelector(".date-field");
                    minData = linkedDateField.value.split(" ");
                    minYear = Number(minData[2]);
                    minMonth = new Month(getMonthIndex(minData[1]));
                  }

                  // console.log(`Current Year: ${currYear}, Minimum Year: ${minYear}`);
                  // console.log(`Current Month: ${currMonth.index}, Minimum Month: ${minMonth.index}`);
                  // console.log(currMonth.index === minMonth.index);


                  if (maxData) {
                    maxYear = maxData["maxYear"];
                    maxMonth = maxData["maxMonth"];
                  } else {
                    maxYear = thisYear + 1;
                    maxMonth = new Month(thisMonth.index - 1);
                  }

                  const prevBtn = widget.querySelector(".prev-btn");
                  const nextBtn = widget.querySelector(".next-btn");
                  // Remove the click event listener from previous month button if it's the minimum month the user can select.
                  if (currYear === minYear && currMonth.index === minMonth.index) {
                    prevBtn.removeEventListener("click", prevMonth);
                    prevBtn.classList.add("disabled");
                    console.log("Prev Button Disabled");
                    prevBtn.setAttribute("data-has-listener", "false");
                  } else {
                    if (prevBtn.getAttribute("data-has-listener") === "false") {
                      prevBtn.addEventListener("click", prevMonth);
                      console.log("Prev Button Enabled");
                    }
                    prevBtn.classList.remove("disabled");
                    prevBtn.setAttribute("data-has-listener", "true");
                  }

                  // Remove the click event listener from the next month button if it's the maximum month the user can select.
                  if (currYear === maxYear && currMonth.index === maxMonth.index) {
                    nextBtn.removeEventListener("click", nextMonth);
                    nextBtn.classList.add("disabled");
                    console.log("Listener Removed");
                    nextBtn.setAttribute("data-has-listener", "false");
                  } else {
                    if (nextBtn.getAttribute("data-has-listener") === "false") {
                      nextBtn.addEventListener("click", nextMonth);
                      console.log("Listener Added");
                    }
                    nextBtn.classList.remove("disabled");
                    nextBtn.setAttribute("data-has-listener", "true");

                  }
                }


                function hideCalendar(e, widget) {
                  if (e) {
                    console.log(`Hide Calendar called by: ${e.target.tagName}.${e.target.className}`);
                  }

                  const calendarWrapper = widget.querySelector(".calendar-wrapper");

                  widget.setAttribute("data-active", "false");
                  calendarWrapper.style.display = null;
                }

                function toggleCalendar(e, widget) {
                  console.log(`Toggle Calendar called by: ${e.target.tagName}.${e.target.className}`);

                  const isActive = widget.getAttribute("data-active") === "true";
                  const dateField = widget.querySelector(".date-field");
                  const calendarWrapper = widget.querySelector(".calendar-wrapper");
                  const calendars = calendarWrapper.querySelectorAll(".calendar");
                  const calendarPadding = Number(window.getComputedStyle(calendars[0]).getPropertyValue("padding-bottom").replace(/px/, ''));
                  const calendarMargin = Number(window.getComputedStyle(calendars[0]).getPropertyValue("margin-top").replace(/px/, ''));

                  let wrapperHeight, calendarHeight;

                  if (isActive) {
                    // console.log("toggle-off");
                    widget.classList.remove("active");
                    widget.setAttribute("data-active", "false");
                    dateField.classList.remove("active");

                    // Collapse the calendar wrapper
                    calendarWrapper.style.display = null;
                  } else {
                    calendarWrapper.style.display = 'flex';

                    // console.log("toggle-on");
                    widget.classList.add("active");
                    widget.setAttribute("data-active", "true");
                    dateField.classList.add("active");

                    if (dateField.value !== "") {
                      updateSelData(e, dateField);
                      currMonth = selMonth;
                      currYear = selYear;
                    }

                    // console.log(`Selected Date: ${selDate} ${selMonth.shortName} ${selYear}`);

                    calendars.forEach(calendar => {
                      clearTable(e, calendar);
                      drawTable(e, calendar);
                    })

                    // Next and Previous Month Buttons Listener
                    const nextBtn = widget.querySelector(".next-btn");
                    const prevBtn = widget.querySelector(".prev-btn");

                    nextBtn.addEventListener("click", nextMonth);
                    prevBtn.addEventListener("click", prevMonth);
                    nextBtn.setAttribute("data-has-listener", "true");
                    prevBtn.setAttribute("data-has-listener", "true");

                    let minData;

                    if (widget.classList.contains("linked")) {
                      const prevWidget = document.querySelector(widget.getAttribute("data-link"));
                      const prevDateField = prevWidget.querySelector(".date-field");
                      const prevFullDate = prevDateField.value.split(" ");
                      const minYear = Number(prevFullDate[2]);
                      const minMonth = new Month(getMonthIndex(prevFullDate[1]));
                      minData = {
                        "minYear": minYear,
                        "minMonth": minMonth
                      }
                    }
                    editBtnListener(widget, minData);
                  }

                  return;
                }

                function nextCalendarWidget(e, widget) {
                  if (e) {
                    console.log(`Next Widget called by: ${e.target.tagName}.${e.target.className}`)
                  }
                  // The current widget data
                  const dateField = widget.querySelector(".date-field");
                  const nextId = widget.getAttribute("data-next");
                  const nextWidget = document.querySelector(nextId);
                  const nextDateField = nextWidget.querySelector(".date-field");
                  if (nextDateField.value === "") {
                    nextDateField.value = dateField.value;

                  }
                  // console.log("!!"+dateField.value);
                  //Change the value only if it is empty
                  let monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November	', 'December'];
                  const currDate = new Date(dateField.value);
                  // console.log("วันนี้" + dateField.value);
                  currDate.setDate(currDate.getDate() + 2);
                  var day = currDate.getDate();
                  var mkDay = new String(day)
                  var year = currDate.getFullYear();
                  var month = monthNames[currDate.getMonth()];

                  // const nextDate = new Date(nextDateField.value);

                  var full2day = mkDay + " " + month + " " + year;
                  // console.log("2 วันถัดมา" + full2day);
                  // // dateField.value = mkDay + " " + month + " " + year;
                  // // nextDateField.value = dateField.value;

                  if (nextDateField.value < dateField.value) {
                    // console.log("LL");
                    // dateField.value = mkDay + " " + month + " " + year;
                    nextDateField.value = full2day;
                    // console.log("nextDate");
                    // console.log("วัน CheckOUT " + nextDateField.value);
                  } else {
                    nextDateField.value = full2day;
                  }






























                  nextWidget.click();
                  nextWidget.focus();
                  return;
                }

                function changeMonth(e, calendar, direction) {
                  if (e) {
                    console.log(`Next Month called by: ${e.target.tagName}.${e.target.className}`);
                  }
                  let calendars;

                  let currMonthIndex;
                  if (direction === "next") {
                    currMonthIndex = currMonth.index + 1;
                    currMonth = new Month(currMonthIndex);
                    currMonthIndex > 11 ? currYear++ : currYear;
                  } else {
                    currMonthIndex = currMonth.index - 1;
                    currMonth = new Month(currMonthIndex);
                    currMonthIndex < 0 ? currYear-- : currYear;
                  }

                  if (calendar.classList.contains("dual-calendar")) {
                    calendars = calendar.querySelectorAll(".calendar");
                    calendars.forEach(calendar => {
                      clearTable(e, calendar);
                      drawTable(e, calendar);
                    })
                  } else {
                    clearTable(e, calendar);
                    drawTable(e, calendar);
                  }

                  editBtnListener(calendar.closest(".calendar-widget"));
                }

                function nextMonth(e) {
                  changeMonth(e, e.target.closest(".dual-calendar"), "next");
                }

                function prevMonth(e) {
                  console.log("previous");
                  changeMonth(e, e.target.closest(".dual-calendar"), "prev");
                }

                // ==================================================================
                // ________________________ LISTENERS _______________________________
                // ==================================================================
                calendarWidgets.forEach(widget => {
                  // If the widget has the "default-today" class, sets its value to today's date.
                  const dateField = widget.querySelector(".date-field");

                  if (widget.classList.contains("default-today")) {
                    dateField.readonly = false;
                    dateField.value = `<?php echo $Checkin; ?>`;
                    dateField.readonly = true;
                    // ${currDate} ${thisMonth.longName} ${thisYear}
                  }

                  const calendarWrapper = widget.querySelector(".calendar-wrapper");
                  const calendars = widget.querySelectorAll(".calendar");

                  // Not sure if OK to use
                  calendarWrapper.addEventListener("click", function(e) {
                    // Stop all the click event from bubbling to the widget.
                    e.stopPropagation();
                  });

                  widget.addEventListener("click", function(e) {
                    toggleCalendar(e, widget)
                  })

                  //Hide on focus out
                  let focusOutFunction;
                  widget.addEventListener("focusout", function(e) {
                    focusOutFunction = setTimeout(function() {
                      console.log("focusout");
                      // hideCalendar(e, widget);
                    }, 0);
                  })

                  // If the next object that was focused in is a member of the widget, cancel the focusout function.
                  widget.addEventListener("focusin", function(e) {
                    console.log(`${e.target.tagName}.${e.target.className} focus in.`);
                    clearTimeout(focusOutFunction);
                  })
                })
              </script>
              <div class="col-md-2 col-sm-12">
                <div class="form-group">
                  <label>
                    <h4 class="text-blue h4">ผู้ใหญ่</h4>
                  </label>
                  <select class="custom-select col-12" id="adult" name="adult">
                    <option value="<?php echo $adult; ?>"><?php echo $adult; ?></option>
                    <!-- <option value="0">0</option> -->
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                  </select>
                </div>
              </div>

              <div class="col-md-2 col-sm-12">
                <div class="form-group">
                  <label>
                    <h4 class="text-blue h4">เด็ก อายุ 4-10 ปี</h4>
                  </label>
                  <select class="custom-select col-12" id="older_children" name="older_children">
                    <?php if ($older_children <= 0) { ?>
                      <option value="0">0</option>
                    <?php } else { ?>
                      <option value="<?php echo $older_children; ?>"><?php echo $older_children; ?></option>
                    <?php } ?>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                  </select>
                </div>
              </div>
              <div class="col-md-2 col-sm-12">
                <div class="form-group">
                  <label>
                    <h4 class="text-blue h4">เด็ก อายุ 0-3 ปี</h4>
                  </label>
                  <select class="custom-select col-12" id="child" name="child">
                    <?php if ($child <= 0) { ?>
                      <option value="0">0</option>
                    <?php } else { ?>
                      <option value="<?php echo $child; ?>"><?php echo $child; ?></option>
                    <?php } ?>

                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="11">12</option>
                  </select>
                </div>
              </div>
              <div class="col-md-2 col-sm-12">
                <label class="weight-600">
                  <h4 class="text-blue h4">ประเภทการดำน้ำ </h4>
                </label>

                <div class="custom-control custom-radio mb-5">

                  <?php
                  $sql111 = "SELECT * FROM `tb_car_boat_diving` WHERE `status` = '9'";
                  $query111 = mysqli_query($con, $sql111);
                  while ($results111 = mysqli_fetch_assoc($query111)) {
                    $diving1 = $results111["price"];
                  } ?>

                  <?php
                  $sql222 = "SELECT * FROM `tb_car_boat_diving` WHERE `status` = '99'";
                  $query222 = mysqli_query($con, $sql222);
                  while ($results222 = mysqli_fetch_assoc($query222)) {
                    $diving2 = $results222["price"];
                  } ?>
                  <?php
                  $sql333 = "SELECT * FROM `tb_car_boat_diving` WHERE `status` = '999'";
                  $query333 = mysqli_query($con, $sql333);
                  while ($results333 = mysqli_fetch_assoc($query333)) {
                    $diving3 = $results333["price"];
                  } ?>



                  <script>
                    $(document).ready(function() {
                      // if ($('input[type=radio]').prop('checked') == false) {
                      //   swal("Radio Click")
                      // } else {
                      //   $("#statusdiving").val(0);
                      // }
                      console.log($("#statusdiving").val());
                      $("#clearradio").click(function() {
                        $("#diving1").prop("checked", false);
                        $("#diving2").prop("checked", false);
                        $("#diving3").prop("checked", false);
                        // console.log("Clear Radio Success")
                        $("#statusdiving").val(null);
                      });

                      $('input[type=radio]').click(function() {
                        if ($('#diving1').prop('checked')) {
                          // swal("D1 Check")
                          $("#statusdiving").val(1);
                          let sd = $("#statusdiving").val();
                          // swal("status:=>" + sd)
                        } else if ($('#diving2').prop('checked')) {
                          $("#statusdiving").val(2);
                          let sd = $("#statusdiving").val();
                          // swal("status:=>" + sd)
                        } else if ($('#diving3').prop('checked')) {
                          $("#statusdiving").val(3);
                          let sd = $("#statusdiving").val();
                          // swal("status:=>" + sd)
                        }
                      })
                    });
                  </script>
                  <input type="text" id='statusdiving' name="statusdiving" value='' hidden>
                  <?php


                  if ($diving_num == $diving1 && $_REQUEST['statusdiving'] == 1) { ?>
                    <div class="custom-control custom-radio mb-5">
                      <input type="radio" id="diving1" name="diving" class="custom-control-input" value="<?php echo $diving1; ?>" checked>
                      <label class="custom-control-label" for="diving1">ดำน้ำโซนใน</label>
                    </div>
                    <div class="custom-control custom-radio mb-5">
                      <input type="radio" id="diving2" name="diving" class="custom-control-input" value="<?php echo $diving2; ?>">
                      <label class="custom-control-label" for="diving2">ดำน้ำโซนนอก</label>
                    </div>
                    <div class="custom-control custom-radio mb-5">
                      <input type="radio" id="diving3" name="diving" class="custom-control-input" value="<?php echo $diving3; ?>">
                      <label class="custom-control-label" for="diving3">ดำน้ำโซนใน + โซนนอก</label>
                    </div>
                    <button type="button" id="clearradio" class="btn btn-warning form-control" style="color:#fff">ยกเลิกดำน้ำ</button>

                  <?php } else if ($diving_num == $diving2 && $_REQUEST['statusdiving'] == 2) { ?>
                    <div class="custom-control custom-radio mb-5">
                      <input type="radio" id="diving1" name="diving" class="custom-control-input" value="<?php echo $diving1; ?>">
                      <label class="custom-control-label" for="diving1">ดำน้ำโซนใน</label>
                    </div>
                    <div class="custom-control custom-radio mb-5">
                      <input type="radio" id="diving2" name="diving" class="custom-control-input" value="<?php echo $diving2; ?>" checked>
                      <label class="custom-control-label" for="diving2">ดำน้ำโซนนอก</label>
                    </div>
                    <div class="custom-control custom-radio mb-5">
                      <input type="radio" id="diving3" name="diving" class="custom-control-input" value="<?php echo $diving3; ?>">
                      <label class="custom-control-label" for="diving3">ดำน้ำโซนใน + โซนนอก</label>
                    </div>
                    <button type="button" id="clearradio" class="btn btn-warning form-control" style="color:#fff">ยกเลิกดำน้ำ</button>

                    <!-- <?php $diving_num; ?> -->
                  <?php } else if ($diving_num == $diving3 && $_REQUEST['statusdiving'] == 3) { ?>

                    <div class="custom-control custom-radio mb-5">
                      <input type="radio" id="diving1" name="diving" class="custom-control-input" value="<?php echo $diving1; ?>">
                      <label class="custom-control-label" for="diving1">ดำน้ำโซนใน</label>
                    </div>
                    <div class="custom-control custom-radio mb-5">
                      <input type="radio" id="diving2" name="diving" class="custom-control-input" value="<?php echo $diving2; ?>">
                      <label class="custom-control-label" for="diving2">ดำน้ำโซนนอก</label>
                    </div>
                    <div class="custom-control custom-radio mb-5">
                      <input type="radio" id="diving3" name="diving" class="custom-control-input" value="<?php echo $diving3; ?>" checked>
                      <label class="custom-control-label" for="diving3">ดำน้ำโซนใน + โซนนอก</label>
                    </div>
                    <button type="button" id="clearradio" class="btn btn-warning form-control" style="color:#fff">ยกเลิกดำน้ำ</button>

                  <?php } else { ?>

                    <div class="custom-control custom-radio mb-5">
                      <input type="radio" id="diving1" name="diving" class="custom-control-input" value="<?php echo $diving1; ?>">
                      <label class="custom-control-label" for="diving1">ดำน้ำโซนใน</label>
                    </div>
                    <div class="custom-control custom-radio mb-5">
                      <input type="radio" id="diving2" name="diving" class="custom-control-input" value="<?php echo $diving2; ?>">
                      <label class="custom-control-label" for="diving2">ดำน้ำโซนนอก</label>

                    </div>
                    <div class="custom-control custom-radio mb-5">
                      <input type="radio" id="diving3" name="diving" class="custom-control-input" value="<?php echo $diving3; ?>">
                      <label class="custom-control-label" for="diving3">ดำน้ำโซนใน + โซนนอก</label>

                    </div>

                    <button type="button" id="clearradio" class="btn btn-warning form-control" style="color:#fff">ยกเลิกดำน้ำ</button>

                  <?php } ?>


                </div>
              </div>

              <div class="col-md-2 col-sm-12">
                <label class="weight-600">
                  <h4 class="text-blue h4">เเพ็คเกจเสริม</h4>
                </label>
                <div class="custom-control custom-checkbox mb-12">
                  <?php
                  if ($car != "") { ?>
                    <input type="checkbox" class="custom-control-input" id="customCheck1" name="car" checked="">
                  <?php } else { ?>
                    <input type="checkbox" class="custom-control-input" id="customCheck1" name="car">
                  <?php } ?>
                  <label class="custom-control-label" for="customCheck1">รถ</label>
                </div>
                <div class="custom-control custom-checkbox mb-12">
                  <?php
                  if ($boat != "") { ?>
                    <input type="checkbox" class="custom-control-input" id="customCheck2" name="boat" checked="">
                  <?php } else { ?>
                    <input type="checkbox" class="custom-control-input" id="customCheck2" name="boat">
                  <?php } ?>
                  <label class="custom-control-label" for="customCheck2">เรือ</label>
                </div>

                <div class="custom-control custom-checkbox mb-12">

                  <input type="checkbox" readonly checked class="custom-control-input" id="customCheck6" name="insurance" checked disabled>

                  <label class="custom-control-label" for="customCheck6">ประกันภัย</label>
                </div>

              </div>
              <div class="col-md-2 col-sm-12">
                <label class="weight-600">
                  <h4 class="text-blue h4">ตรวจสอบใหม่</h4>
                </label>
                <input style="color: #fff;" class="btn btn-primary form-control" type="submit" value="ตรวจสอบใหม่">
              </div>

            </div>
          </form>

          <div class="clearfix mb-20">
            <div class="pull-left">
              <h4 class="text-blue h4">ราคาคิดตามเปอร์เซ็นค่าคอม</h4>
            </div>

          </div>
          <table class="table table-bordered">
            <thead align="center">
              <tr>
                <th scope="col">ประเภท</th>
                <th scope="col" onClick="menubar('table20')">ราคาขาย 20%</th>
                <th style="background-color: #2f736d;color: #fff;" scope="col" onClick="menubar('table20')">ค่าคอม 3%</th>
                <th scope="col" onClick="menubar('table15')">ราคาขาย 15%</th>
                <th style="background-color: #2f736d;color: #fff;" scope="col" onClick="menubar('table15')">ค่าคอม 2%</th>
                <th scope="col" onClick="menubar('table10')">ราคาขาย 10%</th>
                <th style="background-color: #2f736d;color: #fff;" scope="col" onClick="menubar('table10')">ค่าคอม 1%</th>
              </tr>
            </thead>
            <tbody align="center">
              <tr>
                <th scope="row" style="padding-left: 3%!important;text-align:left!important">ผู้ใหญ่</th>
                <th scope="row">
                  <span class="badge badge-primary">
                    <?php
                    $sum_20 = ((($sum_price_room * 20) / 100) + $sum_price_room) / $adult;
                    echo  number_format(($sum_20), 2); ?>
                  </span>
                </th>
                <th scope="row">-</th>
                <th scope="row">
                  <span class="badge badge-secondary">
                  
                    <?php
                    $sum_15 = ((($sum_price_room * 15) / 100) + $sum_price_room) / $adult;
                    echo  number_format(($sum_15), 2); ?>
                  </span>
                </th>
                <th scope="row">-</th>
                <th scope="row">
                  <span class="badge badge-success">
                    <?php
                    $sum_10 = ((($sum_price_room * 10) / 100) + $sum_price_room) / $adult;
                    echo  number_format(($sum_10), 2); ?>
                  </span>
                </th>
                <th scope="row">-</th>


              </tr>
              <?php if ($car != "") { ?>
                <tr>
                  <th scope="row" style="padding-left: 3%!important;text-align:left!important">ค่ารถไป-กลับ ต่อท่าน</th>
                  <th scope="row">
                    <span class="badge badge-primary">
                    <?php 
                      $car_sum_20 = (($car_num * 20) / 100) + $car_num;
                      echo number_format(($car_sum_20), 2); ?>
                    </span>
                  </th>
                  <th scope="row">-</th>
                  <th scope="row">
                    <span class="badge badge-secondary">
                    <?php 
                      $car_sum_15 = (($car_num * 15) / 100) + $car_num;
                      echo number_format(($car_sum_15), 2); ?>
                    </span>
                  </th>
                  <th scope="row">-</th>
                  <th scope="row">
                    <span class="badge badge-success">
                    <?php 
                      $car_sum_10 = (($car_num * 10) / 100) + $car_num;
                      echo number_format(($car_sum_10), 2); ?>
                    </span>
                  </th>
                  <th scope="row">-</th>
                </tr>
              <?php } else {
              } ?>

              <?php if ($boat != "") { ?>
                <tr>
                  <th scope="row" style="padding-left: 3%!important;text-align:left!important">ค่าเรือไป-กลับ ต่อท่าน</th>
                  <th scope="row">
                    <span class="badge badge-primary">
                      <?php 
                        $boat_sum_20 = (($boat_num * 20) / 100) + $boat_num;
                        echo number_format(($boat_sum_20), 2); ?>
                    </span>
                  </th>
                  <th scope="row">-</th>
                  <th scope="row">
                    <span class="badge badge-secondary">
                    <?php 
                        $boat_sum_15 = (($boat_num * 15) / 100) + $boat_num;
                        echo number_format(($boat_sum_15), 2); ?>
                    </span>
                  </th>
                  <th scope="row">-</th>
                  <th scope="row">
                    <span class="badge badge-success">
                    <?php 
                        $boat_sum_10 = (($boat_num * 10) / 100) + $boat_num;
                        echo number_format(($boat_sum_10), 2); ?>
                    </span>
                  </th>
                  <th scope="row">-</th>
                </tr>
              <?php } else {
              } ?>

              <?php if ($diving != "") { ?>
                <tr>


                  <th scope="row" style="padding-left: 3%!important;text-align:left!important">ค่าดำน้ำ ต่อท่าน</th>
                  <th scope="row">
                    <span class="badge badge-primary">
                      <?php 
                        $diving_sum_20 = (($diving_num * 20) / 100) + $diving_num;
                      echo number_format(($diving_sum_20), 2); ?>
                    </span>
                  </th>
                  <th scope="row">-</th>
                  <th scope="row">
                    <span class="badge badge-secondary">
                      <?php 
                        $diving_sum_15 = (($diving_num * 15) / 100) + $diving_num;
                      echo number_format(($diving_sum_15), 2); ?>
                    </span>
                  </th>
                  <th scope="row">-</th>
                  <th scope="row">
                    <span class="badge badge-success">
                      <?php 
                        $diving_sum_10 = (($diving_num * 10) / 100) + $diving_num;
                      echo number_format(($diving_sum_10), 2); ?>
                    </span>
                  </th>
                  <th scope="row">-</th>
                </tr>
              <?php } else {
              } ?>

              <tr style="color:red">
                <th scope="row" style="padding-left: 3%!important;text-align:left!important;color:red">
                  ราคารวมผู้ใหญ่ต่อท่าน
                <th scope="row">
                  <span class="badge" style="background-color: red;border-radius:5px;color:#fff">
                    <?= number_format((($sum_20 + $car_sum_20 + $boat_sum_20 + $diving_sum_20)), 2) ?>
                  </span>
                </th>
                <th scope="row"><?= number_format((($sum_20 + $car_sum_20 + $boat_sum_20 + $diving_sum_20) * 3 / 100), 2) ?></th>
                <th scope="row">
                  <span class="badge" style="background-color: red;border-radius:5px;color:#fff">
                    <?= number_format((($sum_15 + $car_sum_15+ $boat_sum_15 + $diving_sum_15)), 2) ?>
                  </span>
                </th>
                <th scope="row"><?= number_format((($sum_15 + $car_sum_15+ $boat_sum_15 + $diving_sum_15) * 2 / 100), 2) ?></th>
                <th scope="row">
                  <span class="badge" style="background-color: red;border-radius:5px;color:#fff">

                    <?= number_format((($sum_10 + $car_sum_10+ $boat_sum_10 + $diving_sum_10)), 2) ?>
                  </span>
                </th>
                <th scope="row"><?= number_format((($sum_10 + $car_sum_10+ $boat_sum_10 + $diving_sum_10) * 1 / 100), 2) ?></th>
              </tr>

              <?php if ($older_children != "" && $older_children != 0) { ?>
              
                <tr style="color:red">
                <th scope="row" style="padding-left: 3%!important;text-align:left!important;color:red">
                ราคารวมเด็ก อายุ 4-10 ปีต่อท่าน
                <th scope="row">
                  <span class="badge" style="background-color: red;border-radius:5px;color:#fff">
                    <?= number_format((($sum_20 + $car_sum_20 + $boat_sum_20 + $diving_sum_20)*0.7), 2) ?>
                  </span>
                </th>
                <th scope="row"><?= number_format((($sum_20 + $car_sum_20 + $boat_sum_20 + $diving_sum_20) *0.7* 3 / 100), 2) ?></th>
                <th scope="row">
                  <span class="badge" style="background-color: red;border-radius:5px;color:#fff">
                    <?= number_format((($sum_15 + $car_sum_15+ $boat_sum_15 + $diving_sum_15)*0.7), 2) ?>
                  </span>
                </th>
                <th scope="row"><?= number_format((($sum_15 + $car_sum_15+ $boat_sum_15 + $diving_sum_15) *0.7* 2 / 100), 2) ?></th>
                <th scope="row">
                  <span class="badge" style="background-color: red;border-radius:5px;color:#fff">

                    <?= number_format((($sum_10 + $car_sum_10+ $boat_sum_10 + $diving_sum_10)*0.7), 2) ?>
                  </span>
                </th>
                <th scope="row"><?= number_format((($sum_10 + $car_sum_10+ $boat_sum_10 + $diving_sum_10) *0.7* 1 / 100), 2) ?></th>
              </tr>


                <!-- <tr style="color:red" >
                  <th scope="row" style="padding-left: 3%!important;text-align:left!important">ราคารวมเด็ก อายุ 4-10 ปีต่อทาน </th>
                  <th scope="row">
                    <span class="badge badge-primary">
                      <?php

                      $older_children_20 = ((($sum_20) * 70) / 100);
                      echo  number_format(($older_children_20), 2); ?>

                    </span>
                  </th>
                  <th scope="row">-</th>
                  <th scope="row">
                    <span class="badge badge-secondary">
                      <?php
                      $older_children_15 = ((($sum_15) * 70) / 100);
                      echo  number_format(($older_children_15), 2); ?>

                    </span>
                  </th>
                  <th scope="row">-</th>
                  <th scope="row">
                    <span class="badge badge-success">
                      <?php
                      $older_children_10 = ((($sum_10) * 70) / 100);
                      echo  number_format(($older_children_10), 2); ?>

                    </span>
                  </th>
                  <th scope="row">-</th>
                </tr> -->
              <?php } else {
              } ?>
              <?php if ($child != "" && $child != 0) { ?>
                <tr style="color:red">
                  <th scope="row" style="padding-left: 3%!important;text-align:left!important;color:red">ราคารวมเด็ก อายุ 0-3 ปีต่อท่าน</th>
                  <th scope="row"> <span class="badge" style="background-color: red;border-radius:5px;color:#fff">-</span></th>
                  <th scope="row">-</th>
                  <th scope="row"> <span class="badge" style="background-color: red;border-radius:5px;color:#fff">-</span></th>
                  <th scope="row">-</th>
                  <th scope="row"> <span class="badge" style="background-color: red;border-radius:5px;color:#fff">-</span></th>
                  <th scope="row">-</th>
                </tr>

              <?php } else {
              } ?>

              <?php if ($older_children != "" && $older_children != 0) { ?>

                <!-- <tr>
                  <th scope="row" style="padding-left: 3%!important;text-align:left!important">ค่ารถไป-กลับ ต่อท่าน</th>
                  <th scope="row">
                    <span class="badge badge-primary">
                    <?php 
                      $car_sum_20 = (($car_num * 20) / 100) + $car_num;
                      echo number_format(($car_sum_20), 2); ?>
                    </span>
                  </th>
                  <th scope="row">-</th>
                  <th scope="row">
                    <span class="badge badge-secondary">
                    <?php 
                      $car_sum_15 = (($car_num * 15) / 100) + $car_num;
                      echo number_format(($car_sum_15), 2); ?>
                    </span>
                  </th>
                  <th scope="row">-</th>
                  <th scope="row">
                    <span class="badge badge-success">
                    <?php 
                      $car_sum_10 = (($car_num * 10) / 100) + $car_num;
                      echo number_format(($car_sum_10), 2); ?>
                    </span>
                  </th>
                  <th scope="row">-</th>
                </tr> -->
              <?php } else {
              } ?>

              <?php if ($older_children != "" && $older_children != 0) { ?>
                <!-- <tr>
                  <th scope="row" style="padding-left: 3%!important;text-align:left!important">ค่าเรือไป-กลับ ต่อท่าน</th>
                  <th scope="row">
                    <span class="badge badge-primary">
                    <?php 
                        $boat_sum_20 = (($boat_num * 20) / 100) + $boat_num;
                        echo number_format(($boat_sum_20), 2); ?>
                    </span>
                  </th>
                  <th scope="row">-</th>
                  <th scope="row">
                    <span class="badge badge-secondary">
                    <?php 
                        $boat_sum_15 = (($boat_num * 15) / 100) + $boat_num;
                        echo number_format(($boat_sum_15), 2); ?>
                    </span>
                  </th>
                  <th scope="row">-</th>
                  <th scope="row">
                    <span class="badge badge-success">
                    <?php 
                        $boat_sum_10 = (($boat_num * 10) / 100) + $boat_num;
                        echo number_format(($boat_sum_10), 2); ?>
                    </span>
                  </th>
                  <th scope="row">-</th>
                </tr> -->
              <?php } else {
              } ?>

              <?php if ($older_children != "" && $older_children != 0) { ?>
                <!-- <tr>
                  <th scope="row" style="padding-left: 3%!important;text-align:left!important">ค่าดำน้ำ ต่อท่าน</th>
                  <th scope="row">
                    <span class="badge badge-primary">
                    <?php 
                        $diving_sum_20 = (($diving_num * 20) / 100) + $diving_num;
                      echo number_format(($diving_sum_20), 2); ?>
                    </span>
                  </th>
                  <th scope="row">-</th>
                  <th scope="row">
                    <span class="badge badge-secondary">
                    <?php 
                        $diving_sum_15 = (($diving_num * 15) / 100) + $diving_num;
                      echo number_format(($diving_sum_15), 2); ?>
                    </span>
                  </th>
                  <th scope="row">-</th>
                  <th scope="row">
                    <span class="badge badge-success">
                    <?php 
                        $diving_sum_10 = (($diving_num * 10) / 100) + $diving_num;
                      echo number_format(($diving_sum_10), 2); ?>
                    </span>
                  </th>
                  <th scope="row">-</th>
                </tr> -->
              <?php } else {
              } ?>

              <?php if ($older_children != "" && $older_children != 0) { ?>

              <?php } else {
              } ?>

              <!--  <tr>
                                <th scope="row">ราคารวมสำหรับ <br>ผู้ใหญ่ <?php echo $adult; ?> คน <br>เด็ก อายุ 4-10 ปี <?php echo $older_children; ?> คน </th>
                                <th scope="row">
                                    <span class="badge badge-primary">
                                        <?= number_format(($sum_20 * $adult) + ($older_children_20 * $adult), 2) ?>
                                    </span>
                                </th>
                                <th scope="row">
                                    <span class="badge badge-secondary">
                                        <?= number_format((($sum_15 + $older_children_15)), 2) ?>
                                    </span>
                                 </th>
                                <th scope="row">
                                    <span class="badge badge-success">

                                        <?= number_format((($sum_10 + $older_children_10)), 2) ?>
                                    </span>
                                </th>
                            </tr> -->
              <tr>
                <td style="border-color:#fff!important"></td>
                <td style="border-color:#fff!important"><input type="button" value="เลือก" style="width:100%;color:#000;font-size:20px;padding:3px!important" onClick="menubar('table20')"></td>
                <td style="border-color:#fff!important"></td>
                <td style="border-color:#fff!important"><input type="button" value="เลือก" style="width:100%;color:#000;font-size:20px;padding:3px!important" onClick="menubar('table15')"></td>
                <td style="border-color:#fff!important"></td>
                <td style="border-color:#fff!important"><input type="button" value="เลือก" style="width:100%;color:#000;font-size:20px;padding:3px!important" onClick="menubar('table10')"></td>
                <td style="border-color:#fff!important"></td>
              </tr>
            </tbody>
          </table>
          <div>
            <div class="pull-center">
              <h5 class="text-blue h5">รายละเอียดค่าใช้จ่าย  จำนวน :  <span style="color: red;"> <?php echo $diff_result + 1; ?> วัน <?php echo $diff_result; ?> คืน </h5></span>
              <h5 class="text-blue h5">จำนวนห้อง : <span style="color: red;"><?php
                                                
                                                  if ($adult % 2 == 0) {
                                      
                                                    $bed = ($adult / 2);
                                                    echo $bed;
                                                    echo " ห้อง";
                                                  } else {
                                                    $bed = ($adult - 1) / 2;
                                                    echo $bed;
                                                    echo " ห้อง  เตียงเสริม 1 เตียง ";
                                                  }

                                                  ?> </h5></span>
              <h5 class="text-blue h5">
              
                จำนวนผู้ใหญ่ : <span style="color: red;"> <?php echo $adult; ?> คน</span>
                <br>จำนวนเด็ก อายุ 4-10 ปี :  <span style="color: red;"><?php echo $older_children; ?> คน </span>
                <br>จำนวนเด็ก อายุ 0-3 ปี : <span style="color: red;"> <?php echo $child; ?> คน </span>
              </h5>
              
            </div>


            <!--   form  ราคา 20%  -->
            <div id="table20" style="height: 90%; display: none;">
              <h4 class="text-blue h4" align="center">ราคา 20%</h4>
              <table class="table table-bordered">
                <thead align="center">
                  <tr>
                    <th scope="col">ชื่อรีสอร์ด</th>
                    <th scope="col"><?php echo $resort['resort_name']; ?></th>
                  </tr>
                </thead>
                <tbody align="center">
                  <tr>
                    <th scope="row">ประเภทห้องพัก</th>
                    <th scope="row"><?php echo $results["name_roomtype"] ?></th>
                  </tr>

                  <?php if ($older_children != "" && $older_children != 0) { ?>
                    <tr>
                      <th scope="row">เพิ่มเตียงเสริม</th>
                      <th scope="row">Extra Bed</th>
                    </tr>
                  <?php } else {
                  } ?>

                  <?php if ($car != "") { ?>
                    <tr>
                      <th scope="row">ค่ารถ</th>
                      <th scope="row">
                      <?php 
                      $adultcarsum = $car_sum_20 * $adult;
                      $boycar = ($car_sum_20 *0.7)* $older_children;
                      $sumcar_20 = $adultcarsum +  $boycar ;
                      echo number_format(($sumcar_20), 2); 
                      ?>
                      </th>
                    </tr>
                  <?php } else {
                  } ?>

                  <?php if ($boat != "") { ?>
                    <tr>
                      <th scope="row">ค่าเรือ</th>
                      <th scope="row">

                      <?php 
                      $adultboatsum = $boat_sum_20 * $adult;
                      $boyboat = ($boat_sum_20 * 0.7) * $older_children;
                      $sumboat_20 = $adultboatsum +  $boyboat;
                      echo number_format(($sumboat_20), 2); ?>
                      
                      </th>
                    </tr>
                  <?php } else {
                  } ?>

                  <?php if ($diving != "") { ?>
                    <tr>
                      <th scope="row">ค่าดำน้ำ</th>
                      <th scope="row">
                      <?php 
                         $adultdivingsum = $diving_sum_20 * $adult;
                         $boydiving = ($diving_sum_20 *0.7) *  $older_children;
                         $sumdiving_20 = $adultdivingsum +  $boydiving;
                      echo number_format(($sumdiving_20), 2); ?></th>
                    </tr>
                  <?php } else {
                  } ?>

                  <tr>
                    <th scope="row">
                      จำนวน ผู้ใหญ่
                      <span style="color:red;"> <?php echo $adult; ?>
                      คน <br /></span>
                      จำนวน เด็ก อายุ 4-10 ปี
                      <span style="color:red;"><?php echo $older_children; ?>
                      คน <br /></span>
                      จำนวน เด็ก อายุ 0-3 ปี 
                      <span style="color:red;"> <?php echo $child; ?>
                      คน</span>
                    </th>
                    <th scope="row" style="color:red;">
                    <?= number_format((($sum_20 + $car_sum_20 + $boat_sum_20 + $diving_sum_20) * $adult) + ((($sum_20 + $car_sum_20 + $boat_sum_20 + $diving_sum_20)*0.7) * $older_children), 2) ?>
                      <!-- <?= number_format((($sum_20 + $car_sum_20 + $boat_sum_20 + $diving_sum_20) * $adult) + (($older_20) * $older_children), 2) ?> -->
                    </th>
                  </tr>
                  <tr>
                    <th scope="row">ค่าคอมรวม 3%</th>
                    <th scope="row">
                      <?php
                      $a = (($sum_20 + $car_sum_20 + $boat_sum_20 + $diving_sum_20) * $adult) + ((($sum_20 + $car_sum_20 + $boat_sum_20 + $diving_sum_20)*0.7) * $older_children);
                      //  $a =($sum_20*$adult)+($older_children_20*$older_children)+(($sum_adult*($_REQUEST[ 'adult' ])+($_REQUEST[ 'older_children' ]*$sum)))
                      ?>
                      <?= number_format((($a) * 3 / 100), 2) ?>
                    </th>
                  </tr>
                </tbody>
              </table>

              <?php if ($_SESSION["status"] == '2') { ?>

              <?php } else { ?>
                <div class="col-md-12 col-sm-12" style="padding-top: 20px;">
                  <?php
                  $txtdata = "";
                  if ($car != "") {
                    $txtdata = $txtdata . ":c";
                  }
                  if ($boat != "") {
                    $txtdata = $txtdata . ":b";
                  }
                  ?>

                  <form action="booking.php" method="POST">
                    <input hidden type="text" name="typser" id="typser" value="<?php echo $txtdata; ?>" />
                    <input hidden type="text" name="name" id="name" value="<?php echo $name; ?>" />
                    <input hidden type="text" name="name_roomtype" id="name_roomtype" value="<?php echo $results["name_roomtype"] ?>" />
                    <input hidden type="text" name="days" id="days" value="<?php echo $diff_result + 1; ?> วัน <?php echo $diff_result; ?> คืน" />
                    <input hidden type="text" name="bed" id="bed" value="<?php echo $bed ?>" />
                    <input hidden type="text" name="adult" id="adult" value="<?php echo $adult; ?>" />
                    <input hidden type="text" name="older_children" id="older_children" value="<?php echo $older_children; ?>" />
                    <input hidden type="text" name="child" id="child" value="<?php echo $child; ?>" />
                    <input hidden type="text" name="Checkin" id="Checkin" value="<?php echo $Checkin; ?>" />
                    <input hidden type="text" name="Checkout" id="Checkout" value="<?php echo $Checkout; ?>" />
                    <input hidden type="text" name="sum" id="sum" value="<?php echo $a; ?>" />
                    <input hidden type="text" name="commission_value" id="commission_value" value="<?php echo (($a) * 3 / 100); ?>" />

                    <input hidden type="text" name="insurance" id="insurance" value="<?php echo $insurance_num; ?>">
                    <input hidden type="text" name="car_num" id="car_num" value="<?php echo $car_num; ?>" />
                    <input hidden type="text" name="boat_num" id="boat_num" value="<?php echo $boat_num; ?>" />
                    <input hidden type="text" name="diving_num" id="diving_num" value="<?php echo $diving_num; ?>" />
                    <input hidden type="text" name="com" id="com" value=" 3%" />
                    <input hidden type="text" name="extrabed" id="extrabed" value="<?php echo $extrabed; ?>" />



                    <input class="btn btn-primary" type="submit" value="BOOKING" />
                  </form>
                </div>
              <?php } ?>
            </div>






            <div id="table15" style="height: 90%;display: none;">
              <h4 class="text-blue h4" align="center">ราคา 15%</h4>
              <table class="table table-bordered">

                <thead align="center">
                  <tr>
                    <th scope="col">ชื่อรีสอร์ด</th>
                    <th scope="col"><?php echo $resort['resort_name']; ?></th>
                  </tr>
                </thead>
                <tbody align="center">
                  <tr>
                    <th scope="row">ประเภทห้องพัก</th>
                    <th scope="row"><?php echo $results["name_roomtype"] ?></th>

                  </tr>

                  <?php if ($older_children != "" && $older_children != 0) { ?>
                    <tr>
                      <th scope="row">เพิ่มเตียงเสริม</th>
                      <th scope="row">Extra Bed</th>
                    </tr>
                  <?php } else {
                  } ?>


                  <?php if ($car != "") { ?>
                    <tr>
                      <th scope="row">ค่ารถ</th>
                      <th scope="row">
                      
                      <?php
                         $adultcarsum = $car_sum_15 * $adult;
                         $boycar = ($car_sum_15 *0.7)* $older_children;
                         $sumcar_15 = $adultcarsum +  $boycar ;
                        echo number_format(($sumcar_15), 2); 
                      
                      
                      ?>
                      </th>


                    </tr>
                  <?php } else {
                  } ?>

                  <?php if ($boat != "") { ?>
                    <tr>
                      <th scope="row">ค่าเรือ</th>
                      <th scope="row">
                      <?php 
                         $adultdivingsum = $boat_sum_15 * $adult;
                         $boydiving = ($boat_sum_15 *0.7) *  $older_children;
                         $sumdiving_15 = $adultdivingsum +  $boydiving;
                         echo number_format(($sumdiving_15), 2); 
                      ?></th>


                    </tr>
                  <?php } else {
                  } ?>

                  <?php if ($diving != "") { ?>
                    <tr>
                      <th scope="row">ค่าดำน้ำ</th>
                      <th scope="row">
                      <?php 
                       $adultdivingsum = $diving_sum_15 * $adult;
                       $boydiving = ($diving_sum_15 *0.7) *  $older_children;
                       $sumdiving_15 = $adultdivingsum +  $boydiving;
                      echo number_format(($sumdiving_15), 2); 
                      ?>
                      </th>


                    </tr>
                  <?php } else {
                  } ?>



                  <tr>
                    <th scope="row">จำนวน ผู้ใหญ่ <span style="color:red;"><?php echo $adult; ?> คน</span> <br>จำนวน เด็ก อายุ 4-10 ปี <span style="color:red;"><?php echo $older_children; ?> คน </span><br>จำนวน เด็ก อายุ 0-3 ปี  <span style="color:red;"><?php echo $child; ?> คน</span></th>
                    <th scope="row">
                    <span style="color:red;">
                      <?= number_format((($sum_15 + $car_sum_15 + $boat_sum_15 + $diving_sum_15) * $adult) + ((($sum_15+$car_sum_15 + $boat_sum_15 + $diving_sum_15)*0.7) * $older_children), 2) ?>
                    </span>
                      <!-- <?= number_format(($sum_15 * $adult) + ($older_children_15 * $older_children) + (($car_sum_15 + $boat_sum_15 + $diving_sum_15 * ($_REQUEST['adult']) + ($_REQUEST['older_children'] * $sum))), 2) ?> -->
                    </th>


                  </tr>
                  <tr>
                    <th scope="row">รวมค่าคอม 2%</th>
                    <th scope="row">
                      <?php
                      $aa = (($sum_15 + $car_sum_15 + $boat_sum_15 + $diving_sum_15) * $adult) + ((($sum_15 + $car_sum_15+ $boat_sum_15 + $diving_sum_15)*0.7) * $older_children);
                      // $aa = ($sum_15*$adult)+($older_children_15*$older_children)+(($sum_adult*($_REQUEST[ 'adult' ])+($_REQUEST[ 'older_children' ]*$sum)));
                      ?>
                      <?= number_format((($aa) * 2 / 100), 2) ?>
                    </th>


                  </tr>





                </tbody>
              </table>
              <?php if ($_SESSION["status"] == '2') { ?>


              <?php } else { ?>
                <div class="col-md-12 col-sm-12" style="padding-top: 20px;">




                  <form action="booking.php" method="POST">

                    <?php
                    $txtdata = "";
                    if ($car != "") {
                      $txtdata = $txtdata . ":c";
                    }
                    if ($boat != "") {
                      $txtdata = $txtdata . ":b";
                    }

                    ?>

                    <input hidden type="text" name="typser" id="typser" value="<?php echo $txtdata; ?>" />
                    <input hidden type="text" name="name_roomtype" id="name_roomtype" value="<?php echo $results["name_roomtype"] ?>" />
                    <input hidden type="text" name="days" id="days" value="<?php echo $diff_result + 1; ?> วัน <?php echo $diff_result; ?> คืน" />
                    <input hidden type="text" name="bed" id="bed" value="<?php echo $bed ?>" />
                    <input hidden type="text" name="adult" id="adult" value="<?php echo $adult; ?>" />
                    <input hidden type="text" name="older_children" id="older_children" value="<?php echo $older_children; ?>" />
                    <input hidden type="text" name="child" id="child" value="<?php echo $child; ?>" />
                    <input hidden type="text" name="Checkin" id="Checkin" value="<?php echo $Checkin; ?>" />
                    <input hidden type="text" name="Checkout" id="Checkout" value="<?php echo $Checkout; ?>" />
                    <input hidden type="text" name="sum" id="sum" value="<?php echo ($sum_15) + ($sum_adult) * 2; ?>" />
                    <input hidden type="text" name="commission_value" id="commission_value" value="<?php echo (($a) * 2 / 100); ?>" />
                    <input hidden type="text" name="car_num" id="car_num" value="<?php echo $car_num; ?>" />
                    <input hidden type="text" name="boat_num" id="boat_num" value="<?php echo $boat_num; ?>" />
                    <input hidden type="text" name="diving_num" id="diving_num" value="<?php echo $diving_num; ?>" />
                    <input hidden type="text" name="com" id="com" value="2%" />
                    <input hidden type="text" name="insurance" id="insurance" value="<?php echo $insurance_num; ?>">
                    <input hidden type="text" name="extrabed" id="extrabed" value="<?php echo $extrabed; ?>" />
                    <input class="btn btn-primary" type="submit" value="BOOKING" />
                  </form>
                </div>
              <?php } ?>

            </div>
            <div id="table10" style="height: 90%;display: none;">
              <h4 class="text-blue h4" align="center">ราคา 10%</h4>
              <table class="table table-bordered">

                <thead align="center">
                  <tr>
                    <th scope="col">ชื่อรีสอร์ด</th>
                    <th scope="col"><?php echo $resort['resort_name']; ?></th>
                  </tr>
                </thead>
                <tbody align="center">
                  <tr>
                    <th scope="row">ประเภทห้องพัก</th>
                    <th scope="row"><?php echo $results["name_roomtype"] ?></th>

                  </tr>

                  <?php if ($older_children != "" && $older_children != 0) { ?>
                    <tr>
                      <th scope="row">เพิ่มเตียงเสริม</th>
                      <th scope="row">Extra Bed</th>
                    </tr>
                  <?php } else {
                  } ?>


                  <?php if ($car != "") { ?>
                    <tr>
                      <th scope="row">ค่ารถ</th>
                      <th scope="row">
                      <?php 
                      $adultcarsum = $car_sum_10 * $adult;
                      $boycar = ($car_sum_10 *0.7)* $older_children;
                      $sumcar_10 = $adultcarsum +  $boycar ;

                      echo number_format(($sumcar_10), 2); 
                      ?>
                      </th>


                    </tr>
                  <?php } else {
                  } ?>

                  <?php if ($boat != "") { ?>
                    <tr>
                      <th scope="row">ค่าเรือ</th>
                      <th scope="row">
                      <?php 
                        $adultdivingsum = $boat_sum_10 * $adult;
                        $boydiving = ($boat_sum_10 *0.7) *  $older_children;
                        $sumdiving_10 = $adultdivingsum +  $boydiving;
                      echo number_format(($sumdiving_10), 2); 
                      ?>
                      
                      </th>


                    </tr>
                  <?php } else {
                  } ?>

                  <?php if ($diving != "") { ?>
                    <tr>
                      <th scope="row">ค่าดำน้ำ</th>
                      <th scope="row">
                      <?php

                        $adultdivingsum = $diving_sum_10 * $adult;
                        $boydiving = ($diving_sum_10 *0.7) *  $older_children;
                        $sumdiving_10 = $adultdivingsum +  $boydiving;
                       echo number_format(($sumdiving_10), 2); 

                       ?>
                       </th>


                    </tr>
                  <?php } else {
                  } ?>


                  <tr>
                    <th scope="row">จำนวน ผู้ใหญ่ <span style="color:red;"><?php echo $adult; ?> คน </span><br>จำนวน เด็ก อายุ 4-10 ปี <span style="color:red;"><?php echo $older_children; ?> คน</span> <br>จำนวน เด็ก อายุ 0-3 ปี <span style="color:red;"> <?php echo $child; ?> คน</span></th>
                    <th scope="row">
                    <span style="color:red;">
                      <?= number_format((($sum_10 + $car_sum_10 + $boat_sum_10 + $diving_sum_10) * $adult) + ((($sum_10 + $car_sum_10 + $boat_sum_10 + $diving_sum_10)*0.7) * $older_children), 2) ?>
                    </span>
                    </th>


                  </tr>
                  <tr>
                    <th scope="row">รวมค่าคอม 1%</th>
                    <th scope="row">
                      <?php
                      $aaa = (($sum_10 + $car_sum_10 + $boat_sum_10 + $diving_sum_10) * $adult) + ((($sum_10 + $car_sum_10 + $boat_sum_10 + $diving_sum_10)*0.7) * $older_children);

                      ?>
                      <?= number_format((($aaa) / 100), 2) ?>
                    </th>


                  </tr>





                </tbody>
              </table>

              <?php if ($_SESSION["status"] == '2') { ?>


              <?php } else { ?>
                <div class="col-md-12 col-sm-12" style="padding-top: 20px;">
                  <?php
                  $txtdata = "";
                  if ($car != "") {
                    $txtdata = $txtdata . ":c";
                  }
                  if ($boat != "") {
                    $txtdata = $txtdata . ":b";
                  }
                  ?>
                  <form action="booking.php" method="POST">
                    <input hidden type="text" name="typser" id="typser" value="<?php echo $txtdata; ?>" />
                    <input hidden type="text" name="name" id="name" value="<?php echo $name; ?>" />
                    <input hidden type="text" name="name_roomtype" id="name_roomtype" value="<?php echo $results["name_roomtype"] ?>" />
                    <input hidden type="text" name="days" id="days" value="<?php echo $diff_result + 1; ?> วัน <?php echo $diff_result; ?> คืน" />
                    <input hidden type="text" name="bed" id="bed" value="<?php echo $bed ?>" />
                    <input hidden type="text" name="adult" id="adult" value="<?php echo $adult; ?>" />
                    <input hidden type="text" name="older_children" id="older_children" value="<?php echo $older_children; ?>" />
                    <input hidden type="text" name="child" id="child" value="<?php echo $child; ?>" />
                    <input hidden type="text" name="Checkin" id="Checkin" value="<?php echo $Checkin; ?>" />
                    <input hidden type="text" name="Checkout" id="Checkout" value="<?php echo $Checkout; ?>" />
                    <input hidden type="text" name="sum" id="sum" value="<?php echo ($sum_10) + ($sum_adult) * 2; ?>" />
                    <input hidden type="text" name="commission_value" id="commission_value" value="<?php echo (($a) / 100); ?>" />
                    <input hidden type="text" name="car_num" id="car_num" value="<?php echo $car_num; ?>" />
                    <input hidden type="text" name="boat_num" id="boat_num" value="<?php echo $boat_num; ?>" />
                    <input hidden type="text" name="diving_num" id="diving_num" value="<?php echo $diving_num; ?>" />
                    <input hidden type="text" name="com" id="com" value="1%" />
                    <input hidden type="text" name="insurance" id="insurance" value="<?php echo $insurance_num; ?>">
                    <input  type="text" name="extrabed" id="extrabed" value="<?php echo $extrabed; ?>" />
                    <input class="btn btn-primary" type="submit" value="BOOKING" />

                  </form>
                </div>
              <?php } ?>


            </div>




          </div>

        </div>




      <?php }  ?>


      <div class="footer-wrap pd-20 mb-20 card-box">Welcome Akira Lipe , Ananya Lipe , Thechic Lipe <a href="https://ananyalipe.com" target="_blank">แบบฟอร์มเช็คราคาห้องพักของแต่ละรีสอร์ท</a></div>
    </div>
  </div>

  <?php include "footer.php"; ?>



  <script type="text/javascript">
    function menubar(action) {

      if (action == 'table20') {
        $('#table20').show();
        $('#table15').hide();
        $('#table10').hide();

      } else if (action == 'table15') {
        $('#table20').hide();
        $('#table15').show();
        $('#table10').hide();;

      } else if (action == 'table10') {
        $('#table20').hide();
        $('#table15').hide();
        $('#table10').show();

      }
    }
  </script>
</body>

</html>