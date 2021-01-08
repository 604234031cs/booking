<!DOCTYPE html>
<html>
<?php include "head.php";
include_once('connectdb.php');
session_start();
error_reporting(0);
?>
<?php
$sql11 = "SELECT * FROM `tb_car_boat_diving` WHERE `status` = '1'";
$query11 = mysqli_query($con, $sql11);
$results11 = mysqli_fetch_assoc($query11);
// $diving1 = $results11["price"];
// $tcar = $results11["name"];
$_SESSION['tcar'] = $results11["name"];

$sql22 = "SELECT * FROM `tb_car_boat_diving` WHERE `status` = '2'";
$query22 = mysqli_query($con, $sql22);
$results22 = mysqli_fetch_assoc($query22);
// $diving2 = $results22["price"];
$_SESSION['tboast'] = $results22["name"];


$sql33 = "SELECT * FROM `tb_car_boat_diving` WHERE `status` = '9'";
$query33 = mysqli_query($con, $sql33);
$results33 = mysqli_fetch_assoc($query33);
$diving1 = $results33["price"];
// $tdiving = $results33["name"];

$sql33 = "SELECT * FROM `tb_car_boat_diving` WHERE `status` = '99'";
$query33 = mysqli_query($con, $sql33);
$results33 = mysqli_fetch_assoc($query33);
$diving2 = $results33["price"];
// $tdiving = $results33["name"];


$sql33 = "SELECT * FROM `tb_car_boat_diving` WHERE `status` = '999'";
$query33 = mysqli_query($con, $sql33);
$results33 = mysqli_fetch_assoc($query33);
$diving3 = $results33["price"];
// $tdiving = $results33["name"];




$sql33 = "SELECT * FROM tb_car_boat_diving WHERE status='1'";
$query33 = mysqli_query($con, $sql33);
$results33 = mysqli_fetch_assoc($query33);

// while ($results33 = mysqli_fetch_assoc($query33)) {

$car_num1 = $results33["price"];

// }


$sql44 = "SELECT * FROM `tb_car_boat_diving` WHERE status = '2'";
$query44 = mysqli_query($con, $sql44);
while ($results44 = mysqli_fetch_assoc($query44)) {

  $boat_num1 = $results44["price"];
}
?>


<body>
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
              <div class="weight-600 font-30 text-blue">เช็คราคาห้องพักของแต่ละรีสอร์ท</div>
            </h4>
          </div>
        </div>
      </div>
      <div class="pd-20 card-box mb-30">
        <div class="row" style="padding-top: 35px;">
          <div class="col-md-6 col-sm-12">
            <div class="form-group">
              <label>
                <h4 class="text-blue h4">ที่พัก</h4>
              </label>

              <script>
                $(document).ready(function() {
                  let id = $('#id').val();
                  $.ajax({
                    url: "ajaxdata.php?page=checkprice&&id=" + id,
                    type: "GET",
                    success: function(result) {
                      let ajaxdata = JSON.parse(result);
                      // console.log(ajaxdata);
                      // $("#name_roomtype").empty();
                      for (let i = 0; i < ajaxdata.length; i++) {
                        // console.log(ajaxdata[i]);
                        $("#name_roomtype").append("<option value=" + ajaxdata[i]['id'] + ">" + ajaxdata[i]['name_roomtype'] + "</option>");
                      }
                      // console.log(result);
                    }
                  });
                })

                function autoselect(value) {
                  // console.log(value);
                  $.ajax({
                    url: "ajaxdata.php?page=checkprice&&id=" + value,
                    type: "GET",
                    success: function(result) {
                      let ajaxdata = JSON.parse(result);
                      // console.log(ajaxdata);
                      $("#name_roomtype").empty();
                      let txtrow = "";
                      for (let i = 0; i < ajaxdata.length; i++) {
                        // console.log(ajaxdata[i]);
                        $("#name_roomtype").append("<option value=" + ajaxdata[i]['id'] + ">" + ajaxdata[i]['name_roomtype'] + "</option>");
                      }
                      // console.log(result);
                    }
                  });
                }
              </script>
              <select class="custom-select col-12" id="id" name="id" onchange="autoselect(this.value)">
                <?php
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
              <select class="custom-select col-12" id="name_roomtype" name="name_roomtype" required="">
                <!-- <option>โปรดเลือก</option>
                <?php
                $sql2 = "SELECT * FROM `tb_roomtype` WHERE `id_resort` = '" . $_POST['id'] . "'";
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
                  <label for="type1-start">Starting Date</label>
                  <input class="date-field form-control" id="type1-start" type="text" placeholder="Starting Date" name="Checkin" onchange="autotwodate()">
                </div>
                <script>
                  let diving1 = <?php echo $diving1 ?>;
                  let diving2 = <?php echo $diving2 ?>;
                  let diving3 = <?php echo $diving3 ?>;
                  $(document).ready(function() {
                    let dayNamesMin = ["จันทร์", "อังคาร", "พุทธ", "พฤหัส", "ศุกร์", "เสาร์", "อาทิต"];
                    let monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November	', 'December'];
                    let startday = document.getElementById("type1-start").value
                    var d = new Date(startday);
                    let cDay = "" + d.getDate();
                    let currDay = d.getMonth() + 1 + "/" + cDay.padStart(2, "0") + "/" + d.getFullYear();

                    $('.detail').hide();
                    $('#aftershow').hide();

                    // alert(diving1)
                    // alert(diving2)
                    // alert(diving3)

                    d.setDate(d.getDate() + 2)
                    var year = d.getFullYear();

                    var month = monthNames[d.getMonth()];
                    // console.log(monthNames[month]);
                    var day = d.getDate();
                    var mkDay = new String(day)
                    // console.log(monthNames[d.getMonth()])
                    if (month < 10) {
                      month = "0" + month;
                    }
                    let fulldate = mkDay + " " + month + " " + year;
                    document.getElementById('type1-deadline').value = fulldate;

                    let b = new Date(fulldate);
                    let fDay = "" + b.getDate();
                    let feturDay = b.getMonth() + 1 + "/" + fDay.padStart(2, "0") + "/" + b.getFullYear();

                    // alert(currDay);
                    // alert(feturDay);

                    var date1 = new Date(currDay);

                    var date2 = new Date(feturDay);
                    var Difference_In_Time = date2.getTime() - date1.getTime();
                    var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
                    let txt = "";
                    // alert(Difference_In_Days);
                    if ((Difference_In_Days + 1) <= 3) {
                      txt += "<input type='text' id='statusdiving' name='statusdiving' value='' hidden>";
                      txt += " <div class='custom-control custom-radio mb-5'>";
                      txt += "<input type='radio' id='diving1' name='diving' class='custom-control-input' value='" + diving1 + "'>";
                      txt += "<label class='custom-control-label' for='diving1'>ดำน้ำโซนใน</label>  </div>";
                      txt += "<input type='text' id='statusdiving' name='statusdiving' value='' hidden>";
                      txt += " <div class='custom-control custom-radio mb-5'>";
                      txt += "<input type='radio' id='diving2' name='diving' class='custom-control-input' value='" + diving2 + "'>";
                      txt += "<label class='custom-control-label' for='diving2'>ดำน้ำโซนนอก</label>  </div>";

                      txt += "<input type='text' id='statusdiving' name='statusdiving' value='' hidden>";
                      txt += "<div class='custom-control custom-radio mb-5'>";
                      txt += "<input type='radio' id='diving3' name='diving' class='custom-control-input' value='" + diving3 + "'>";
                      txt += "<label class='custom-control-label' for='diving3'>ดำน้ำโซนใน + โซนนอก</label></div>";
                      txt += "<button type='button' id='clearradio' onclick='clearRadio()' class='btn btn-warning form-control' style='color:#fff'>ยกเลิกดำน้ำ</button>";
                      $(".radio").append(txt);


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

                    }
                  });

                  function clearRadio() {
                    $("#diving1").prop("checked", false);
                    $("#diving2").prop("checked", false);
                    $("#diving3").prop("checked", false);
                  }
                </script>


                <div class="calendar-wrapper" style="border:solid 1px #000">
                  <div class="dual-calendar">
                    <div class="calendar">
                      <div class="calendar-header">
                        <div class="prev-btn">
                          <i class="material-icons">
                          </i>
                        </div>
                        <div class="month-text">
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
                  <label for="type1-deadline">Deadline</label>
                  <input class="date-field form-control" id="type1-deadline" name="Checkout" type="text" placeholder="Deadline" readonly>
                </div>
                <div class="calendar-wrapper" style="border:solid 1px #000">
                  <div class="dual-calendar">
                    <div class="calendar">
                      <div class="calendar-header">
                        <div class="prev-btn">
                          <i class="material-icons">
                          </i>
                        </div>
                        <div class="month-text">
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

          <div class="col-md-2 col-sm-12">
            <div class="form-group">
              <label>
                <h4 class="text-blue h4">ผู้ใหญ่</h4>
              </label>
              <select class="custom-select col-12" id="adult" name="adult">
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
                <option value="12">12</option>
              </select>
            </div>
          </div>
          <div class="col-md-3 col-sm-12">
            <label class="weight-600">
              <h4 class="text-blue h4">ประเภทการดำน้ำ</h4>
            </label>
            <div class="radio">
            </div>
            <div class="checkbox">
            </div>
          </div>
          <div class="col-md-2 col-sm-12">
            <label class="weight-600">
              <h4 class="text-blue h4">เเพ็คเกจเสริม<?php echo $tcar; ?></h4>
            </label>
            <div class="custom-control custom-checkbox mb-12">
              <input type="checkbox" class="custom-control-input" id="customCheckcar" name="car">

              <label class="custom-control-label" for="customCheckcar">รถ</label>
            </div>
            <div class="custom-control custom-checkbox mb-12">
              <input type="checkbox" class="custom-control-input" id="customCheckboat" name="boat">

              <label class="custom-control-label" for="customCheckboat">เรือ</label>
            </div>


            <div class="custom-control custom-checkbox mb-12">
              <input type="checkbox" class="custom-control-input" id="customCheck6" name="insurance" checked disabled>
              <label class="custom-control-label" for="customCheck6">ประกันภัย</label>
            </div>

          </div>
          <div class="col-md-12 col-sm-12">
            <input class="btn btn-primary" type="button" value="ตรวจสอบใหม่" onclick="showDetailPrice()">
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
            let startDay = new Date(thisMonth.index, thisYear, 1).getDay()

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
              // console.log("!!",dateField);
              let fullDate = dateField.value.split(" ");
              // console.log("*/*/*"+fullDate);
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
                // console.log(`Update Date Field called by: ${e.target.tagName}.${e.target.className}`)
              }
              // console.log("##"+fullDate);
              dateField.value = fullDate;
              // console.log("---------------" + dateField.value);
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
                  // console.log(linkedWidget);
                  minDate = linkedDateField.value.split(" ");
                  let monthIndex = getMonthIndex(minDate[1]);
                  minDate[1] = monthIndex;
                  // console.log("****************");

                  // var dateauto =

                  // $('#type1-deadline').val(autodate);
                  // console.log($('#type1-deadline').val());

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
                        // console.log(dateField.id);
                        if (dateField.id == 'type1-deadline') {
                          let c = new Date($('#type1-start').val());
                          let f = new Date(fullDate);
                          let cDay = "" + c.getDate();
                          let fDay = "" + f.getDate();
                          let cMonth = "" + c.getMonth() + 1;
                          let fMonth = "" + f.getMonth() + 1;
                          let feturDay = fMonth.padStart(2, "0") + "/" + fDay.padStart(2, "0") + "/" + f.getFullYear();
                          let currenDay = cMonth.padStart(2, "0") + "/" + cDay.padStart(2, "0") + "/" + c.getFullYear();
                          // console.log(currenDay);
                          var date1 = new Date(currenDay);

                          var date2 = new Date(feturDay);
                          var Difference_In_Time = date2.getTime() - date1.getTime();
                          var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
                          let txt = "";

                          let diving1 = <?php echo $diving1 ?>;
                          let diving2 = <?php echo $diving2 ?>;
                          let diving3 = <?php echo $diving3 ?>;
                          // console.log(Difference_In_Days);

                          if (Difference_In_Days + 1 >= 4) {
                            $('.radio').empty();
                            $('.checkbox').empty();
                            txt += "<div class='custom-control custom-checkbox mb-12'>";
                            txt += "<input type='checkbox' class='custom-control-input' id='divingCheck1' name='car'>";
                            txt += "<label class='custom-control-label' for='divingCheck1'>ดำน้ำโซนใน</label></div>";
                            txt += "<div class='custom-control custom-checkbox mb-12'>";
                            txt += "<input type='checkbox' class='custom-control-input' id='divingCheck2' name='boat'>";
                            txt += " <label class='custom-control-label' for='divingCheck2'>ดำน้ำโซนนอก</label></div>";
                            txt += "<div class='custom-control custom-checkbox mb-12'>";
                            txt += "<input type='checkbox' class='custom-control-input' id='divingCheck3' name='boat'>";
                            txt += " <label class='custom-control-label' for='divingCheck3'>ดำน้ำโซนใน + โซนนอก</label></div>";
                            $('.checkbox').append(txt);
                          } else {
                            $('.radio').empty();
                            $('.checkbox').empty();
                            txt += "<input type='text' id='statusdiving' name='statusdiving' value='' hidden>";
                            txt += " <div class='custom-control custom-radio mb-5'>";
                            txt += "<input type='radio' id='diving1' name='diving' class='custom-control-input' value='" + diving1 + "'>";
                            txt += "<label class='custom-control-label' for='diving1'>ดำน้ำโซนใน</label></div>";
                            txt += "<input type='text' id='statusdiving' name='statusdiving' value='' hidden>";
                            txt += " <div class='custom-control custom-radio mb-5'>";
                            txt += "<input type='radio' id='diving2' name='diving' class='custom-control-input' value='" + diving2 + "'>";
                            txt += "<label class='custom-control-label' for='diving2'>ดำน้ำโซนนอก</label></div>";
                            txt += "<input type='text' id='statusdiving' name='statusdiving' value='' hidden>";
                            txt += "<div class='custom-control custom-radio mb-5'>";
                            txt += "<input type='radio' id='diving3' name='diving' class='custom-control-input' value='" + diving3 + "'>";
                            txt += "<label class='custom-control-label' for='diving3'>ดำน้ำโซนใน + โซนนอก</label></div>";
                            txt += "<button type='button' id='clearradio'onclick='clearRadio()' class='btn btn-warning form-control' style='color:#fff'>ยกเลิกดำน้ำ</button>";
                            $(".radio").append(txt);
                          }
                        }

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
                // console.log("????"+linkedDateField);
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
                // console.log("Prev Button Disabled");
                prevBtn.setAttribute("data-has-listener", "false");
              } else {
                if (prevBtn.getAttribute("data-has-listener") === "false") {
                  prevBtn.addEventListener("click", prevMonth);
                  // console.log("Prev Button Enabled");
                }
                prevBtn.classList.remove("disabled");
                prevBtn.setAttribute("data-has-listener", "true");
              }

              // Remove the click event listener from the next month button if it's the maximum month the user can select.
              if (currYear === maxYear && currMonth.index === maxMonth.index) {
                nextBtn.removeEventListener("click", nextMonth);
                nextBtn.classList.add("disabled");
                // console.log("Listener Removed");
                nextBtn.setAttribute("data-has-listener", "false");
              } else {
                if (nextBtn.getAttribute("data-has-listener") === "false") {
                  nextBtn.addEventListener("click", nextMonth);
                  // console.log("Listener Added");
                }
                nextBtn.classList.remove("disabled");
                nextBtn.setAttribute("data-has-listener", "true");

              }
            }


            function hideCalendar(e, widget) {
              if (e) {
                // console.log(`Hide Calendar called by: ${e.target.tagName}.${e.target.className}`);
              }

              const calendarWrapper = widget.querySelector(".calendar-wrapper");

              widget.setAttribute("data-active", "false");
              calendarWrapper.style.display = null;
            }

            function toggleCalendar(e, widget) {
              // console.log(`Toggle Calendar called by: ${e.target.tagName}.${e.target.className}`);

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
                  // console.log("PASS");
                  // console.log(`!!!!Selected Date: ${selDate} ${selMonth.shortName} ${selYear}`);
                }


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
                // console.log(`Next Widget called by: ${e.target.tagName}.${e.target.className}`)
              }
              // The current widget data
              const dateField = widget.querySelector(".date-field");

              const nextId = widget.getAttribute("data-next");
              const nextWidget = document.querySelector(nextId);
              ///value ช่อง checkout
              const nextDateField = nextWidget.querySelector(".date-field");
              // console.log("ช่อง Checkout " + nextDateField.value);
              //Change the value only if it is empty
              if (nextDateField.value === "") {
                // nextDateField.value = dateField.value;
                // console.log(dateField.value);
              }

              //If the next widget date existing value is smaller than the date value of the current widget, change it to the current widget date value.
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
              // console.log("วัน CheckOUT " + nextDateField.value);
              // // 
              nextWidget.click();
              nextWidget.focus();
              return;
            }

            function changeMonth(e, calendar, direction) {
              if (e) {
                // console.log(`Next Month called by: ${e.target.tagName}.${e.target.className}`);
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
              // console.log("previous");
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
                dateField.value = `${currDate} ${thisMonth.longName} ${thisYear}`;
                dateField.readonly = true;
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
                  // console.log("focusout");
                  // hideCalendar(e, widget);
                }, 0);
              })

              // If the next object that was focused in is a member of the widget, cancel the focusout function.
              widget.addEventListener("focusin", function(e) {
                // console.log("PP");
                // console.log(`${e.target.tagName}.${e.target.className} focus in.`);
                clearTimeout(focusOutFunction);
              })
            })



            let diving_sum_20;
            let diving_sum_15;
            let diving_sum_10;

            let olderChildren20;
            let olderChildren15;
            let olderChildren10;

            let showAllsum20Ault = 0;
            let showAllsum15Ault = 0;
            let showAllsum10Ault = 0;

            let showAllsum20Boy = 0;
            let showAllsum15Boy = 0;
            let showAllsum10Boy = 0;


            let showAllsumCom3Ault = 0;
            let showAllsumCom2Ault = 0;
            let showAllsumCom1Ault = 0;

            let showAllsumCom3Boy = 0;
            let showAllsumCom2Boy = 0;
            let showAllsumCom1Boy = 0;

            let car20;
            let car15;
            let car10;

            let boat20;
            let boat15;
            let boat10;

            let sum20;
            let sum15;
            let sum10;

            let allsum_20;
            let allsum_15;
            let allsum_10;

            let aread;

            let priceCar = '<?php echo $car_num1; ?>';
            priceCar = parseInt(priceCar);
            let priceBoat = '<?php echo $boat_num1; ?>';
            priceBoat = parseInt(priceBoat);


            function checkRadioDiving() {
              let radioDiving1 = $('#diving1').prop("checked");
              let radioDiving2 = $('#diving2').prop("checked");
              let radioDiving3 = $('#diving3').prop("checked");

              if (radioDiving1 == true) {
                $("#tr_diving").show();
                let radiovalue1 = $("#diving1").val();
                radiovalue1 = parseInt(radiovalue1);
                diving_sum_20 = ((radiovalue1 * 20) / 100) + radiovalue1;

                diving_sum_15 = ((radiovalue1 * 15) / 100) + radiovalue1;
                diving_sum_10 = ((radiovalue1 * 10) / 100) + radiovalue1;

                let diving_sums_20 = diving_sum_20.toFixed(2);
                let diving_sums_15 = diving_sum_15.toFixed(2);
                let diving_sums_10 = diving_sum_10.toFixed(2);

                diving_sums_20 = diving_sums_20.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                diving_sums_15 = diving_sums_15.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                diving_sums_10 = diving_sums_10.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                $("#sumdiving_20").html(diving_sums_20);
                $("#sumdiving_15").html(diving_sums_15);
                $("#sumdiving_10").html(diving_sums_10);
              } else if (radioDiving2 == true) {

                $("#tr_diving").show();
                let radiovalue2 = $("#diving2").val();
                radiovalue2 = parseInt(radiovalue2);

                diving_sum_20 = ((radiovalue2 * 20) / 100) + radiovalue2;
                diving_sum_15 = ((radiovalue2 * 15) / 100) + radiovalue2;
                diving_sum_10 = ((radiovalue2 * 10) / 100) + radiovalue2;

                let diving_sums_20 = diving_sum_20.toFixed(2);
                let diving_sums_15 = diving_sum_15.toFixed(2);
                let diving_sums_10 = diving_sum_10.toFixed(2);

                diving_sums_20 = diving_sums_20.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                diving_sums_15 = diving_sums_15.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                diving_sums_10 = diving_sums_10.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');

                $("#sumdiving_20").html(diving_sums_20);
                $("#sumdiving_15").html(diving_sums_15);
                $("#sumdiving_10").html(diving_sums_10);


              } else if (radioDiving3 == true) {
                $("#tr_diving").show();
                let radiovalue3 = $("#diving3").val();
                radiovalue3 = parseInt(radiovalue3);
                diving_sum_20 = ((radiovalue3 * 20) / 100) + radiovalue3;

                diving_sum_15 = ((radiovalue3 * 15) / 100) + radiovalue3;
                diving_sum_10 = ((radiovalue3 * 10) / 100) + radiovalue3;

                let diving_sums_20 = diving_sum_20.toFixed(2);
                let diving_sums_15 = diving_sum_15.toFixed(2);
                let diving_sums_10 = diving_sum_10.toFixed(2);

                diving_sums_20 = diving_sums_20.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                diving_sums_15 = diving_sums_15.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                diving_sums_10 = diving_sums_10.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');

                $("#sumdiving_20").html(diving_sums_20);
                $("#sumdiving_15").html(diving_sums_15);
                $("#sumdiving_10").html(diving_sums_10);
              } else {
                $("#tr_diving").hide();
              }
            }
            let diving = [<?php echo $diving1; ?>, <?php echo $diving2; ?>, <?php echo $diving3; ?>];

            function checkDivingList() {

              let diving_20 = 0;
              let diving_15 = 0;
              let diving_10 = 0;
              let divingCheck1 = $('#divingCheck1').prop("checked");
              let divingCheck2 = $('#divingCheck2').prop("checked");
              let divingCheck3 = $('#divingCheck3').prop("checked");

              for (let i = 1; i <= 3; i++) {
                if ($('#divingCheck' + i).prop("checked") == true) {
                  $("#tr_diving").show();
                  for (let j = 1; j <= 3; j++) {
                    if ($('#divingCheck' + j).prop("checked") == true) {

                      diving_20 += diving[j - 1];
                      diving_15 += diving[j - 1];
                      diving_10 += diving[j - 1];
                    }
                  }
                  break;
                } else {
                  $("#tr_diving").hide();
                }
              }

              diving_sum_20 = (diving_20 * 0.2) + diving_20
              diving_sum_15 = (diving_15 * 0.15) + diving_15
              diving_sum_10 = (diving_10 * 0.1) + diving_10


              let diving_sums_20 = diving_sum_20.toFixed(2);
              let diving_sums_15 = diving_sum_15.toFixed(2);
              let diving_sums_10 = diving_sum_10.toFixed(2);

              diving_sums_20 = diving_sums_20.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
              diving_sums_15 = diving_sums_15.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
              diving_sums_10 = diving_sums_10.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');

              $("#sumdiving_20").html(diving_sums_20);
              $("#sumdiving_15").html(diving_sums_15);
              $("#sumdiving_10").html(diving_sums_10);

            }

            function check_Car_Boat() {

              car20 = ((priceCar * 20) / 100) + priceCar;

              car15 = ((priceCar * 15) / 100) + priceCar;
              car10 = ((priceCar * 10) / 100) + priceCar;
              boat20 = ((priceBoat * 20) / 100) + priceBoat;

              boat15 = ((priceBoat * 15) / 100) + priceBoat;
              boat10 = ((priceBoat * 10) / 100) + priceBoat;

              $("#com1").html(com1);
              let checkCar = $('#customCheckcar').prop("checked");
              let checkBoat = $('#customCheckboat').prop("checked");

              let chekDiving1 = $('#customCheck1').prop("checked");
              let chekDiving2 = $('#customCheck2').prop("checked");
              let chekDiving3 = $('#customCheck3').prop("checked");

              if (checkCar != true) {
                $("#tr_car").hide();
              } else {
                $("#tr_car").show();
                car20 = car20.toFixed(2);
                car15 = car15.toFixed(2);
                car10 = car10.toFixed(2);
                sum_car20 = car20.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                sum_car15 = car15.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                sum_car10 = car10.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                $('#sumcar_20').html(sum_car20);
                $('#sumcar_15').html(sum_car15);
                $('#sumcar_10').html(sum_car10);
              }
              if (checkBoat != true) {
                $("#tr_boat").hide();
              } else {
                $("#tr_boat").show();
                boat20 = boat20.toFixed(2);
                boat15 = boat15.toFixed(2);
                boat10 = boat10.toFixed(2);
                sum_boat20 = boat20.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                sum_boat15 = boat15.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                sum_boat10 = boat10.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                $('#sumboat_20').html(sum_boat20);
                $('#sumboat_15').html(sum_boat15);
                $('#sumboat_10').html(sum_boat10);
              }
            }



            function checkChielden() {
              let com2_3;
              let com2_2;
              let com2_1;
              let num_Older_children = $("#older_children").val();
              // alert(num_Older_children);
              $("#boy").html(num_Older_children + " คน");

              if (num_Older_children != 0) {
                $("#tr_childen").show();

                olderChildren20 = (parseInt(allsum_20) * 70) / 100;
                olderChildren15 = (parseInt(allsum_15) * 70) / 100;
                olderChildren10 = (parseInt(allsum_10) * 70) / 100;


                showAllsum20Boy = olderChildren20 * num_Older_children;
                showAllsum15Boy = olderChildren15 * num_Older_children;
                showAllsum10Boy = olderChildren10 * num_Older_children;

                com2_3 = olderChildren20 * 0.03
                com2_2 = olderChildren15 * 0.02
                com2_1 = olderChildren10 * 0.01

                showAllsumCom3Boy = com2_3 * num_Older_children
                showAllsumCom2Boy = com2_2 * num_Older_children
                showAllsumCom1Boy = com2_1 * num_Older_children

                olderChildren20 = olderChildren20.toFixed(2)
                olderChildren15 = olderChildren15.toFixed(2)
                olderChildren10 = olderChildren10.toFixed(2)

                com2_3 = com2_3.toFixed(2)
                com2_2 = com2_2.toFixed(2)
                com2_1 = com2_1.toFixed(2)


                olderChildren20 = olderChildren20.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                olderChildren15 = olderChildren15.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                olderChildren10 = olderChildren10.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')


                $("#older_ch20").html(olderChildren20);
                $("#older_ch15").html(olderChildren15);
                $("#older_ch10").html(olderChildren10);

                $("#com2_3").html(com2_3);
                $("#com2_2").html(com2_2);
                $("#com2_1").html(com2_1);

              } else {
                $("#tr_childen").hide();
              }

            }

            function checkChild() {
              $("#baby").html($('#child').val() + " คน")
              if ($('#child').val() != 0) {
                $('#low3').show();
              } else {
                $('#low3').hide();
              }

            }

            function sumAult(s20, s15, s10, numadult, Difference_In_Days) {
              // alert("รถ");
              //
              let com3
              let com2
              let com1
              let radioDiving1 = $('#diving1').prop("checked");
              let radioDiving2 = $('#diving2').prop("checked");
              let radioDiving3 = $('#diving3').prop("checked");

              let checkCar = $('#customCheckcar').prop("checked");
              let checkBoat = $('#customCheckboat').prop("checked");

              let radiovalue1 = $("#diving1").val();
              let radiovalue2 = $("#diving2").val();
              let radiovalue3 = $("#diving3").val();

              if (Difference_In_Days + 1 <= 3) {
                // alert("Day 3")
                for (let i = 1; i <= 3; i++) {
                  if ($('#diving' + i).prop("checked") == true) {
                    if (checkCar == true && checkBoat != true) {
                      allsum_20 = parseInt(s20) + parseInt(car20) + parseInt(diving_sum_20)
                      allsum_15 = parseInt(s15) + parseInt(car15) + parseInt(diving_sum_15)
                      allsum_10 = parseInt(s10) + parseInt(car10) + parseInt(diving_sum_10)
                    } else if (checkBoat == true && checkCar != true) {
                      allsum_20 = parseInt(s20) + parseInt(boat20) + parseInt(diving_sum_20)
                      allsum_15 = parseInt(s15) + parseInt(boat15) + parseInt(diving_sum_15)
                      allsum_10 = parseInt(s10) + parseInt(boat10) + parseInt(diving_sum_10)
                    } else if (checkCar != true && checkBoat != true) {
                      allsum_20 = parseInt(s20) + parseInt(diving_sum_20)
                      allsum_15 = parseInt(s15) + parseInt(diving_sum_15)
                      allsum_10 = parseInt(s10) + parseInt(diving_sum_10)
                    } else {
                      allsum_20 = parseInt(s20) + parseInt(car20) + parseInt(diving_sum_20) + parseInt(boat20)
                      allsum_15 = parseInt(s15) + parseInt(car15) + parseInt(diving_sum_15) + parseInt(boat15)
                      allsum_10 = parseInt(s10) + parseInt(car10) + parseInt(diving_sum_10) + parseInt(boat10)
                    }
                  }
                }
                if (radioDiving1 != true && radioDiving2 != true && radioDiving3 != true) {
                  if (checkCar == true && checkBoat != true) {
                    allsum_20 = parseInt(s20) + parseInt(car20)
                    allsum_15 = parseInt(s15) + parseInt(car15)
                    allsum_10 = parseInt(s10) + parseInt(car10)
                  } else if (checkBoat == true && checkCar != true) {
                    allsum_20 = parseInt(s20) + parseInt(boat20)
                    allsum_15 = parseInt(s15) + parseInt(boat15)
                    allsum_10 = parseInt(s10) + parseInt(boat10)
                  } else if (checkCar != true && checkBoat != true) {
                    allsum_20 = parseInt(s20)
                    allsum_15 = parseInt(s15)
                    allsum_10 = parseInt(s10)
                  } else {
                    allsum_20 = parseInt(s20) + parseInt(car20) + parseInt(boat20)
                    allsum_15 = parseInt(s15) + parseInt(car15) + parseInt(boat15)
                    allsum_10 = parseInt(s10) + parseInt(car10) + parseInt(boat10)
                  }
                }

                com3 = allsum_20 * 0.03;
                com2 = allsum_15 * 0.02;
                com1 = allsum_10 * 0.01;
                checkChielden();
                allsum_20 = allsum_20.toFixed(2);
                allsum_15 = allsum_15.toFixed(2);
                allsum_10 = allsum_10.toFixed(2);

                showAllsum20Ault = allsum_20 * numadult
                showAllsum15Ault = allsum_15 * numadult
                showAllsum10Ault = allsum_10 * numadult

                showAllsumCom3Ault = com3 * numadult
                showAllsumCom2Ault = com2 * numadult
                showAllsumCom1Ault = com1 * numadult

                com3 = com3.toFixed(2);
                com2 = com2.toFixed(2);
                com1 = com1.toFixed(2);

                allsum_20 = allsum_20.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                allsum_15 = allsum_15.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                allsum_10 = allsum_10.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')

                $("#sum20").html(allsum_20);
                $("#sum15").html(allsum_15);
                $("#sum10").html(allsum_10);
                $("#com3").html(com3);
                $("#com2").html(com2);
                $("#com1").html(com1);

              } else if (Difference_In_Days + 1 >= 4) {
                if (checkCar == true && checkBoat != true) {
                  allsum_20 = parseInt(s20) + parseInt(car20) + parseInt(diving_sum_20)
                  allsum_15 = parseInt(s15) + parseInt(car15) + parseInt(diving_sum_15)
                  allsum_10 = parseInt(s10) + parseInt(car10) + parseInt(diving_sum_10)
                } else if (checkBoat == true && checkCar != true) {
                  allsum_20 = parseInt(s20) + parseInt(boat20) + parseInt(diving_sum_20)
                  allsum_15 = parseInt(s15) + parseInt(boat15) + parseInt(diving_sum_15)
                  allsum_10 = parseInt(s10) + parseInt(boat10) + parseInt(diving_sum_10)
                } else if (checkCar != true && checkBoat != true) {
                  allsum_20 = parseInt(s20) + parseInt(diving_sum_20)
                  allsum_15 = parseInt(s15) + parseInt(diving_sum_15)
                  allsum_10 = parseInt(s10) + parseInt(diving_sum_10)
                } else {
                  allsum_20 = parseInt(s20) + parseInt(car20) + parseInt(diving_sum_20) + parseInt(boat20)
                  allsum_15 = parseInt(s15) + parseInt(car15) + parseInt(diving_sum_15) + parseInt(boat15)
                  allsum_10 = parseInt(s10) + parseInt(car10) + parseInt(diving_sum_10) + parseInt(boat10)
                }
                com3 = allsum_20 * 0.03;
                com2 = allsum_15 * 0.02;
                com1 = allsum_10 * 0.01;
                checkChielden();
                allsum_20 = allsum_20.toFixed(2);
                allsum_15 = allsum_15.toFixed(2);
                allsum_10 = allsum_10.toFixed(2);

                showAllsum20Ault = allsum_20 * numadult
                showAllsum15Ault = allsum_15 * numadult
                showAllsum10Ault = allsum_10 * numadult

                showAllsumCom3Ault = com3 * numadult
                showAllsumCom2Ault = com2 * numadult
                showAllsumCom1Ault = com1 * numadult

                com3 = com3.toFixed(2);
                com2 = com2.toFixed(2);
                com1 = com1.toFixed(2);

                allsum_20 = allsum_20.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                allsum_15 = allsum_15.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                allsum_10 = allsum_10.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')


                $("#sum20").html(allsum_20);
                $("#sum15").html(allsum_15);
                $("#sum10").html(allsum_10);
                $("#com3").html(com3);
                $("#com2").html(com2);
                $("#com1").html(com1);
              }
            }

            function showDetailPrice() {
              showAllsum20 = 0;
              showAllsum15 = 0;
              showAllsum10 = 0;

              showAllsumCom3 = 0;
              showAllsumCom2 = 0;
              showAllsumCom1 = 0;

              check_Car_Boat();
              checkChild();

              $('.detail').show();
              $('#aftershow').show();
              $('#table20').hide();

              let dateStart = new Date($('#type1-start').val());
              let dateEnd = new Date($('#type1-deadline').val());
              let ds = "" + dateStart.getDate();
              let ms = "" + dateStart.getMonth() + 1;
              let de = "" + dateEnd.getDate();
              let me = "" + dateEnd.getMonth() + 1;

              fullDateStart = dateStart.getFullYear() + "-" + ms.padStart(2, "0") + "-" + ds.padStart(2, "0");
              fullDateEnd = dateEnd.getFullYear() + "-" + me.padStart(2, "0") + "-" + de.padStart(2, "0");
              let id_roomtype = $('#name_roomtype').val();

              var date1 = new Date(fullDateStart);
              let numadult = $('#adult').val();
              var date2 = new Date(fullDateEnd);
              var Difference_In_Time = date2.getTime() - date1.getTime();
              var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);

              if (Difference_In_Days + 1 <= 3) {
                checkRadioDiving();
              } else if (Difference_In_Days + 1 >= 4) {
                checkDivingList();
              }
              aread = Difference_In_Days + 1;
              var area1 = aread + " วัน " + Difference_In_Days + " คืน";

              $("#daylive").html(area1)

              $.ajax({
                type: "POST",
                url: "getprice.php",
                data: {
                  date_start: fullDateStart,
                  id_roomtype: id_roomtype,
                  diffday: Difference_In_Days - 1
                },
                dataType: 'html',
                success: function(data) {
                  let sum_price_room1 = parseInt(data);
                  let sum_price_room;
                  extrabed = "";
                  if (numadult == 1) {
                    sum_price_room = sum_price_room1;
                    extrabed = '0';
                  } else if (numadult % 2 == 0) {
                    sum_price_room = sum_price_room1 * (numadult / 2);
                    extrabed = '0';
                  } else {
                    if (numadult == 3) {
                      sum_price_room = (((sum_price_room1) + (sum_price_room1 / 2)));
                      extrabed = '1';
                    } else if (numadult == 5) {
                      sum_price_room = (((sum_price_room1 * 2) + (sum_price_room1 / 2)));
                      extrabed = '1';
                    } else if (numadult == 7) {
                      sum_price_room = (((sum_price_room1 * 3) + (sum_price_room1 / 2)));
                      extrabed = '1';
                    } else if (numadult == 9) {
                      sum_price_room = (((sum_price_room1 * 4) + (sum_price_room1 / 2)));
                      extrabed = '1';
                    } else if (numadult == 11) {
                      sum_price_room = (((sum_price_room1 * 5) + (sum_price_room1 / 2)));
                      extrabed = '1';
                    }
                  }
                  if (numadult % 2 == 0) {
                    bed = (numadult / 2);
                    $('#numroom').html(bed + ' ห้อง')
                  } else {
                    bed = (numadult - 1) / 2;
                    $('#numroom').html(bed + ' ห้อง เตียงเสริม 1 เตียง  ')
                  }
                  $("#adultnum").html(numadult + " คน");
                  sum20 = (((sum_price_room * 20) / 100) + sum_price_room) / numadult;
                  sum15 = (((sum_price_room * 15) / 100) + sum_price_room) / numadult;
                  sum10 = (((sum_price_room * 10) / 100) + sum_price_room) / numadult;
                  sum20 = sum20.toFixed(2);
                  sum15 = sum15.toFixed(2);
                  sum10 = sum10.toFixed(2);
                  let sum_20 = sum20.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                  let sum_15 = sum15.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                  let sum_10 = sum10.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')

                  sumAult(sum20, sum15, sum10, numadult, Difference_In_Days);

                  $("#adult_20").html(sum_20);
                  $("#adult_15").html(sum_15);
                  $("#adult_10").html(sum_10);
                }
              });
              $("#pricehead").html('ราคาคิดตามเปอร์เซ็นค่าคอม');
            }
          </script>
        </div>
        <br>
        <div class="detail">

          <div class="clearfix mb-20">
            <div class="pull-left">
              <h4 class="text-blue h4" id="pricehead"></h4>
            </div>
          </div>
          <table class="table table-bordered" id="tabledetail">
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
                  <span class="badge badge-primary" id="adult_20">
                  </span>
                </th>
                <th scope="row">-</th>
                <th scope="row">
                  <span class="badge badge-secondary" id="adult_15">
                  </span>
                </th>
                <th scope="row">-</th>
                <th scope="row">
                  <span class="badge badge-success" id="adult_10">
                  </span>
                </th>
                <th scope="row">-</th>
              </tr>
              <tr id="tr_car">
                <th scope="row" style="padding-left: 3%!important;text-align:left!important">ค่ารถไป-กลับ ต่อท่าน</th>
                <th scope="row">
                  <span class="badge badge-primary" id="sumcar_20">
                  </span>
                </th>
                <th scope="row">-</th>
                <th scope="row">
                  <span class="badge badge-secondary" id="sumcar_15">
                  </span>
                </th>
                <th scope="row">-</th>
                <th scope="row">
                  <span class="badge badge-success" id="sumcar_10">
                  </span>
                </th>
                <th scope="row">-</th>
              </tr>

              <tr id="tr_boat">
                <th scope="row" style="padding-left: 3%!important;text-align:left!important">ค่าเรือไป-กลับ ต่อท่าน</th>
                <th scope="row">
                  <span class="badge badge-primary" id="sumboat_20">
                  </span>
                </th>
                <th scope="row">-</th>
                <th scope="row">
                  <span class="badge badge-secondary" id="sumboat_15">
                  </span>
                </th>
                <th scope="row">-</th>
                <th scope="row">
                  <span class="badge badge-success" id="sumboat_10">
                  </span>
                </th>
                <th scope="row">-</th>
              </tr>
              <tr id="tr_diving">
                <th scope="row" style="padding-left: 3%!important;text-align:left!important">ค่าดำน้ำ ต่อท่าน</th>
                <th scope="row">
                  <span class="badge badge-primary" id="sumdiving_20">
                  </span>
                </th>
                <th scope="row">-</th>
                <th scope="row">
                  <span class="badge badge-secondary" id="sumdiving_15"> </span>
                </th>
                <th scope="row">-</th>
                <th scope="row">
                  <span class="badge badge-success" id="sumdiving_10">
                  </span>
                </th>
                <th scope="row">-</th>
              </tr>
              <tr style="color:red">
                <th scope="row" style="padding-left: 3%!important;text-align:left!important;color:red">
                  ราคารวมผู้ใหญ่ต่อท่าน
                <th scope="row">
                  <span class="badge" style="background-color: red;border-radius:5px;color:#fff" id="sum20">
                  </span>
                </th>
                <th scope="row" id="com3"></th>
                <th scope="row">
                  <span class="badge" style="background-color: red;border-radius:5px;color:#fff" id="sum15">
                  </span>
                </th>
                <th scope="row" id="com2"></th>
                <th scope="row">
                  <span class="badge" style="background-color: red;border-radius:5px;color:#fff" id="sum10">
                  </span>
                </th>
                <th scope="row" id="com1"></th>
              </tr>


              <tr style="color:red" id="tr_childen">
                <th scope="row" style="padding-left: 3%!important;text-align:left!important;color:red">
                  ราคารวมเด็ก อายุ 4-10 ปีต่อท่าน
                <th scope="row">
                  <span class="badge" style="background-color: red;border-radius:5px;color:#fff" id="older_ch20">
                  </span>
                </th>
                <th scope="row" id="com2_3"></th>
                <th scope="row">
                  <span class="badge" style="background-color: red;border-radius:5px;color:#fff" id="older_ch15">
                  </span>
                </th>
                <th scope="row" id="com2_2"></th>
                <th scope="row">
                  <span class="badge" style="background-color: red;border-radius:5px;color:#fff" id="older_ch10">
                  </span>
                </th>
                <th scope="row" id="com2_1"></th>
              </tr>

              <tr style="color:red" id="low3">
                <th scope="row" style="padding-left: 3%!important;text-align:left!important;color:red">ราคารวมเด็ก อายุ 0-3 ปีต่อท่าน</th>
                <th scope="row">-</th>
                <th scope="row">-</th>
                <th scope="row">-</th>
                <th scope="row">-</th>
                <th scope="row">-</th>
                <th scope="row">-</th>
              </tr>
              <tr>
                <td style="border-color:#fff!important"></td>
                <td style="border-color:#fff!important"><input type="button" value="เลือก" style="width:100%;color:#000;font-size:20px;padding:3px!important" onClick="menubar('20%')"></td>
                <td style="border-color:#fff!important"></td>
                <td style="border-color:#fff!important"><input type="button" value="เลือก" style="width:100%;color:#000;font-size:20px;padding:3px!important" onClick="menubar('15%')"></td>
                <td style="border-color:#fff!important"></td>
                <td style="border-color:#fff!important"><input type="button" value="เลือก" style="width:100%;color:#000;font-size:20px;padding:3px!important" onClick="menubar('10%')"></td>
                <td style="border-color:#fff!important"></td>
              </tr>
            </tbody>
          </table>
        </div>

        <div id="aftershow">
          <div class="pull-center">
            <h5 class="text-blue h5">รายละเอียดค่าใช้จ่าย จำนวน : <span style="color: red;" id="daylive"></h5></span>
            <h5 class="text-blue h5">จำนวนห้อง : <span style="color: red;" id="numroom">
            </h5></span>
            <h5 class="text-blue h5">

              จำนวนผู้ใหญ่ : <span style="color: red;" id="adultnum"> คน</span>
              <br>จำนวนเด็ก อายุ 4-10 ปี : <span style="color: red;" id="boy"><?php echo $older_children; ?> คน </span>
              <br>จำนวนเด็ก อายุ 0-3 ปี : <span style="color: red;" id="baby"> <?php echo $child; ?> คน </span>
            </h5>

          </div>
        </div>


        <script>
          function menubar(action) {
            let txtdata = "";
            let sumnum;
            let comnum;
            let com = ""
            let sumdiving2 = 0;
            $("#table20").show();
            $('#headcom').html("ราคา " + action)
            let nameresort = $("#id option:selected").text();
            let nameroomtype = $("#name_roomtype option:selected").text();
            let numboy = $("#older_children").val()
            let checkCar = $('#customCheckcar').prop("checked");
            let checkBoat = $('#customCheckboat').prop("checked");
            let numadult = $('#adult').val()
            $('#namreosrt').html(nameresort)
            $('#nameroomtype').html(nameroomtype)
            if (numboy != 0) {
              $('#extrabed').show();
            } else {
              $('#extrabed').hide();
            }

            if (action == "20%") {

              com = "3%"
              let sum_20 = showAllsum20Boy + showAllsum20Ault
              sumnum = sum_20;
              sum_20 = sum_20.toFixed(2);
              sum_20 = sum_20.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')

              let com_3 = showAllsumCom3Ault + showAllsumCom3Boy
              comnum = com_3.toFixed(0);
              com_3 = com_3.toFixed(2);
              com_3 = com_3.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
              if (checkCar == true) {
                let carault = car20 * numadult
                let carboy = (car20 * 0.7) * numboy
                let sumcar = carault + carboy
                sumcar = sumcar.toFixed(2)
                sumcar = sumcar.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                $('#tr_valcar').show();
                $('#valcar').html(sumcar);

              } else {
                $('#tr_valcar').hide();
              }

              if (checkBoat == true) {
                let boatault = boat20 * numadult
                let boatboy = (boat20 * 0.7) * numboy
                let sumboat = boatault + boatboy
                sumboat = sumboat.toFixed(2)
                sumboat = sumboat.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                $('#tr_valboat').show();
                $('#valboat').html(sumboat);

              } else {
                $('#tr_valboat').hide();
              }
              if (aread <= 3) {
                for (let j = 1; j <= 3; j++) {
                  if ($("#diving" + j).prop("checked") == true) {
                    sumdiving2 = diving[j - 1];
                    let divingault = diving_sum_20 * numadult
                    let divingboy = (diving_sum_20 * 0.7) * numboy
                    let sumdiving = divingault + divingboy
                    sumdiving = sumdiving.toFixed(2)
                    sumdiving = sumdiving.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                    $("#valdiving").html(sumdiving);
                    $("#tr_valdiving").show();
                    break;
                  }
                }
                if ($("#diving1").prop("checked") != true && $("#diving2").prop("checked") != true && $("#diving3").prop("checked") != true) {
                  sumdiving2 = "0";
                  $("#tr_valdiving").hide();
                }
              } else if (aread >= 4) {
                for (let j = 1; j <= 3; j++) {
                  if ($('#divingCheck' + j).prop("checked")) {

                    let divingault = diving_sum_20 * numadult
                    let divingboy = (diving_sum_20 * 0.7) * numboy
                    let sumdiving = divingault + divingboy
                    sumdiving = sumdiving.toFixed(2)
                    sumdiving = sumdiving.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                    $("#valdiving").html(sumdiving);
                    $("#tr_valdiving").show();

                    for (let k = 1; k <= 3; k++) {
                      if ($('#divingCheck' + k).prop("checked") == true) {
                        sumdiving2 += diving[k - 1];
                      }
                    }
                    break;
                  } else {
                    $("#tr_valdiving").hide();
                    sumdiving = "0"
                  }

                }

              }


              $("#adultnum2").html($('#adult').val() + " คน");
              $("#boy2").html($("#older_children").val() + " คน");
              $("#baby2").html($('#child').val() + " คน");



              $("#showsum").html(sum_20);
              $("#valcom").html("ค่าคอมรม 3%");
              $("#showsumcom").html(com_3);

            } else if (action == "15%") {
              com = "2%"

              let sum_15 = showAllsum15Boy + showAllsum15Ault
              sumnum = sum_15
              sum_15 = sum_15.toFixed(2);
              sum_15 = sum_15.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')

              let com_2 = showAllsumCom2Ault + showAllsumCom2Boy
              comnum = com_2.toFixed(0);
              com_2 = com_2.toFixed(2);
              com_2 = com_2.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')

              $("#valcom").html("ค่าคอมรม 2%");
              if (checkCar == true) {
                let carault = car15 * numadult
                let carboy = (car15 * 0.7) * numboy
                let sumcar = carault + carboy
                sumcar = sumcar.toFixed(2)
                sumcar = sumcar.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                $('#tr_valcar').show();
                $('#valcar').html(sumcar);
              } else {
                $('#tr_valcar').hide();
              }
              if (checkBoat == true) {
                let boatault = boat15 * numadult
                let boatboy = (boat15 * 0.7) * numboy
                let sumboat = boatault + boatboy
                sumboat = sumboat.toFixed(2)
                sumboat = sumboat.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                $('#tr_valboat').show();
                $('#valboat').html(sumboat);
              } else {
                $('#tr_valboat').hide();
              }

              if (aread <= 3) {
                for (let j = 1; j <= 3; j++) {
                  if ($("#diving" + j).prop("checked") == true) {
                    sumdiving2 = diving[j - 1];
                    let divingault = diving_sum_15 * numadult
                    let divingboy = (diving_sum_15 * 0.7) * numboy
                    let sumdiving = divingault + divingboy
                    sumdiving = sumdiving.toFixed(2)
                    sumdiving = sumdiving.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                    $("#valdiving").html(sumdiving);
                    $("#tr_valdiving").show();
                    break;
                  }
                }
                if ($("#diving1").prop("checked") != true && $("#diving2").prop("checked") != true && $("#diving3").prop("checked") != true) {
                  sumdiving2 = "0";
                  $("#tr_valdiving").hide();
                }
              } else if (aread >= 4) {
                for (let j = 1; j <= 3; j++) {
                  if ($('#divingCheck' + j).prop("checked")) {
                    let divingault = diving_sum_15 * numadult
                    let divingboy = (diving_sum_15 * 0.7) * numboy
                    let sumdiving = divingault + divingboy
                    sumdiving = sumdiving.toFixed(2)
                    sumdiving = sumdiving.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')

                    for (let k = 1; k <= 3; k++) {
                      if ($('#divingCheck' + k).prop("checked") == true) {
                        sumdiving2 += diving[k - 1];
                      }
                    }
                    $("#valdiving").html(sumdiving);
                    $("#tr_valdiving").show();
                    break;
                  } else {
                    $("#tr_valdiving").hide();
                    sumdiving2 = "0"
                  }
                }
              }
              $("#adultnum2").html($('#adult').val() + " คน");
              // alert(num_Older_children);
              $("#boy2").html($("#older_children").val() + " คน");
              $("#baby2").html($('#child').val() + " คน")

              $("#showsum").html(sum_15);
              $("#showsumcom").html(com_2);

            } else if (action == "10%") {

              com = "1%"
              let sum_10 = showAllsum10Boy + showAllsum10Ault
              sumnum = sum_10
              sum_10 = sum_10.toFixed(2);
              sum_10 = sum_10.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')


              let com_1 = showAllsumCom1Ault + showAllsumCom1Boy
              comnum = com_1.toFixed(0);
              com_1 = com_1.toFixed(2);
              com_1 = com_1.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
              if (checkCar == true) {
                let carault = car10 * numadult
                let carboy = (car10 * 0.7) * numboy
                let sumcar = carault + carboy
                sumcar = sumcar.toFixed(2)
                sumcar = sumcar.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                $('#tr_valcar').show();
                $('#valcar').html(sumcar);
              } else {
                $('#tr_valcar').hide();
              }
              if (checkBoat == true) {
                let boatault = boat10 * numadult
                let boatboy = (boat10 * 0.7) * numboy
                let sumboat = boatault + boatboy
                sumboat = sumboat.toFixed(2)
                sumboat = sumboat.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                $('#tr_valboat').show();
                $('#valboat').html(sumboat);
              } else {
                $('#tr_valboat').hide();
              }


              if (aread <= 3) {
                for (let j = 1; j <= 3; j++) {
                  if ($("#diving" + j).prop("checked") == true) {
                    sumdiving2 = diving[j - 1];
                    let divingault = diving_sum_10 * numadult
                    let divingboy = (diving_sum_10 * 0.7) * numboy
                    let sumdiving = divingault + divingboy
                    sumdiving = sumdiving.toFixed(2)
                    sumdiving = sumdiving.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                    $("#valdiving").html(sumdiving);
                    $("#tr_valdiving").show();
                    break;
                  }
                }
                if ($("#diving1").prop("checked") != true && $("#diving2").prop("checked") != true && $("#diving3").prop("checked") != true) {
                  sumdiving2 = "0";
                  $("#tr_valdiving").hide();
                }
              } else if (aread >= 4) {
                for (let j = 1; j <= 3; j++) {
                  if ($('#divingCheck' + j).prop("checked") == true) {
                    let divingault = diving_sum_10 * numadult
                    let divingboy = (diving_sum_10 * 0.7) * numboy
                    let sumdiving = divingault + divingboy
                    sumdiving = sumdiving.toFixed(2)
                    sumdiving = sumdiving.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                    $("#valdiving").html(sumdiving);
                    $("#tr_valdiving").show();

                    for (let k = 1; k <= 3; k++) {
                      if ($('#divingCheck' + k).prop("checked") == true) {
                        sumdiving2 += diving[k - 1];
                      }
                    }
                    break;
                  } else {
                    sumdiving2 = "0"
                    $("#tr_valdiving").hide();
                  }
                }
              }
              $("#adultnum2").html($('#adult').val() + " คน");
              // alert(num_Older_children);
              $("#boy2").html($("#older_children").val() + " คน");
              $("#baby2").html($('#child').val() + " คน")

              $("#showsum").html(sum_10);
              $("#valcom").html("ค่าคอมรม 1%");
              $("#showsumcom").html(com_1);
            }

            let car_num = priceCar
            let boat_num = priceBoat

            if (checkCar == true) {
              txtdata = txtdata + ":c";
            } else {
              car_num = "0";
            }
            if (checkBoat == true) {
              txtdata = txtdata + ":b";
            } else {
              boat_num = "0";
            }

            $("input[id=typser]").val(txtdata);
            $("input[id=name]").val(nameresort);
            $("input[id=name_roomtype]").val(nameroomtype);
            $("input[id=days]").val(aread + " วัน " + (aread - 1) + " คืน");
            $("input[id=bed]").val(bed);
            $("input[id=adult]").val(numadult);
            $("input[id=older_children]").val(numboy);
            $("input[id=child]").val($("#child").val());
            $("input[id=Checkin]").val(fullDateStart);
            $("input[id=Checkout]").val(fullDateEnd);
            $("input[id=sum]").val(sumnum);
            $("input[id=commission_value]").val(comnum);
            $("input[id=car_num]").val(car_num);
            $("input[id=boat_num]").val(boat_num);
            $("input[id=diving_num]").val(sumdiving2);
            $("input[id=com]").val(com);
            $("input[id=extrabed]").val(extrabed);

          }
        </script>

        <div id="table20" style="height: 90%; display: none;">
          <h4 class="text-blue h4" align="center" id="headcom"></h4>
          <table class="table table-bordered">
            <thead align="center">
              <th scope="col">ชื่อรีสอร์ด</th>
              <th scope="col" id="namreosrt"></th>
            </thead>
            <tbody align="center">
              <tr>
                <th scope="row">ประเภทห้องพัก</th>
                <th scope="row" id="nameroomtype">
                </th>
              </tr>
              <tr id="extrabed">
                <th scope="row">เพิ่มเตียงเสริม</th>
                <th scope="row">Extra Bed</th>
              </tr>
              <tr id="tr_valcar">
                <th scope="row">ค่ารถ</th>
                <th scope="row" id="valcar"></th>
              </tr>
              <tr id="tr_valboat">
                <th scope="row">ค่าเรือ</th>
                <th scope="row" id="valboat"></th>
              </tr>
              <tr id="tr_valdiving">
                <th scope="row">ค่าดำน้ำ</th>
                <th scope="row" id="valdiving"></th>
              </tr>
              <tr>

                <th scope="row">
                  จำนวน ผู้ใหญ่
                  <span style="color:red;" id="adultnum2">
                  </span><br>
                  จำนวน เด็ก อายุ 4-10 ปี
                  <span style="color:red;" id="boy2">
                    คน </span><br>
                  จำนวน เด็ก อายุ 0-3 ปี
                  <span style="color:red;" id="baby2">
                    คน</span>
                </th>
                <th scope="row" style="color:red;" id="showsum">
                </th>
              </tr>
              <tr>
                <th scope="row" id="valcom"></th>
                <th scope="row" id="showsumcom">
                </th>
              </tr>
            </tbody>
          </table>

          <form action="booking.php" method="POST">
            <input hidden type="text" name="typser" id="typser" value="" />
            <input hidden type="text" name="name" id="name" value="" />
            <input hidden type="text" name="name_roomtype" id="name_roomtype" value="" />
            <input hidden type="text" name="days" id="days" value="" />
            <input hidden type="text" name="bed" id="bed" value="" />
            <input hidden type="text" name="adult" id="adult" value="" />
            <input hidden type="text" name="older_children" id="older_children" value="" />
            <input hidden type="text" name="child" id="child" value="" />
            <input hidden type="text" name="Checkin" id="Checkin" value="" />
            <input hidden type="text" name="Checkout" id="Checkout" value="" />
            <input hidden type="text" name="sum" id="sum" value="" />
            <input hidden type="text" name="commission_value" id="commission_value" value="" />
            <input hidden type="text" name="car_num" id="car_num" value="" />
            <input hidden type="text" name="boat_num" id="boat_num" value="" />
            <input hidden type="text" name="diving_num" id="diving_num" value="" />
            <input hidden type="text" name="com" id="com" value="" />
            <input hidden type="text" name="insurance" id="insurance" value="1">
            <input hidden type="text" name="extrabed" id="extrabed" value="" />
            <input class="btn btn-primary" type="submit" value="BOOKING" />
          </form>
        </div>


      </div>
      <div class="footer-wrap pd-20 mb-20 card-box">Welcome Akira Lipe , Ananya Lipe , Thechic Lipe <a href="https://ananyalipe.com" target="_blank">แบบฟอร์มเช็คราคาห้องพักของแต่ละรีสอร์ท</a></div>
      <?php include "footer.php"; ?>
</body>

</html>