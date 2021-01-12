


<!DOCTYPE html>
<html>
<?php include "head.php";
include_once('connectdb.php');

error_reporting(0);
$name =  $_POST['name'];
$name_roomtype =  $_POST['name_roomtype'];
$days =  $_POST['days'];
$bed =  $_POST['bed'];
//เด็กอายุ 0 - 3 ปี
$adult =  $_POST['adult'];
//เด็กอายุ 4 - 10 ปี
$older_children =  $_POST['older_children'];

$child =  $_POST['child'];
$Checkin =  $_POST['Checkin'];
$Checkout =  $_POST['Checkout'];
$sum =  $_POST['sum'];
$com =  $_POST['com'];
$commission_value =  $_POST['commission_value'];
$car_num =  $_POST['car_num'];
$boat_num =  $_POST['boat_num'];
$diving_num =  $_POST['diving_num'];
$insurance =  $_REQUEST['insurance'];
$extrabed =  $_REQUEST['extrabed'];
$typser = $_POST["typser"];



?>

<body>
    <!-- 	<div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo"><img src="vendors/images/deskapp-logo.svg" alt=""></div>
			<div class='loader-progress' id="progress_div">
				<div class='bar' id='bar1'></div>
			</div>
			<div class='percent' id='percent1'>0%</div>
			<div class="loading-text">
				Loading...
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
                            BOOKING Khemtis ltinerary Co.,Ltd

                        </h4>
                    </div>
                </div>
            </div>

            <div class="pd-20 card-box mb-30">
                <form action="addbooking.php" enctype="multipart/form-data" method="post" name="form1" id="form1">
                    <div class="row" style="padding-top: 35px;">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>
                                    <h4 class="text-blue h4">ชื่อ </h4>
                                </label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="ระบุชื่อ" required>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>
                                    <h4 class="text-blue h4">เบอร์โทรศัพท์ </h4>
                                </label>
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="ระบุเบอร์โทรศัพท์" maxlength="10" pattern="[0][0-9]{9}" title="ใส่ข้อมูลให้ถูกต้อง" required>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>
                                    <h4 class="text-blue h4">LINE / FACEBOOK</h4>
                                </label>
                                <input type="text" class="form-control" name="line" id="line" placeholder="ระบุเบอร์LINE" required>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>
                                    <h4 class="text-blue h4">ทริปเที่ยว </h4>
                                </label>
                                <select class="custom-select col-12" id="adult" name="adult" required>
                                    <option value=""></option>
                                    <option value="หลีเป๊ะโซนใน">หลีเป๊ะโซนใน</option>
                                    <option value="หลีเป๊ะโซนนอก">หลีเป๊ะโซนนอก</option>
                                    <option value="หลีเป๊ะโซนนอก + โซนใน">หลีเป๊ะโซนใน + โซนนอก</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>
                                    <h4 class="text-blue h4">บริการโดย </h4>
                                </label>
                                <select class="custom-select col-12" id="By" name="By" required>
                                    <option value=""></option>
                                    <option value="เรือไม้ (JOIN)">เรือไม้ (JOIN)</option>
                                    <option value="เรือไม้ (PRIVATE)">เรือไม้ (PRIVATE)</option>
                                </select>

                            </div>
                        </div>
                        <link rel="stylesheet" href="/path/to/dist/css/image-zoom.css" />
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-zoom/1.7.20/jquery.zoom.min.js"></script>
                        <script language="JavaScript">
                            function readURL(input) {
                                if (input.files && input.files[0]) {
                                    console.log(input.files);
                                    var reader = new FileReader();
                                    reader.onload = function(e) {
                                        $('#blah').attr('src', e.target.result);
                                    }
                                    reader.readAsDataURL(input.files[0]);
                                    // $('#blah').show();
                                }
                                // else {
                                //     $('#blah').hide();
                                // }
                            }
                        </script>


                        <style>
                            .zoom {
                                display: inline-block;
                                position: relative;
                            }

                            .zoom img {
                                display: block;
                            }


                            body {
                                font-family: Arial, Helvetica, sans-serif;
                            }

                            #blah {
                                border-radius: 5px;
                                cursor: zoom-in;
                                transition: 0.3s;
                            }

                            #blah:hover {
                                opacity: 0.7;
                            }

                            /* The Modal (background) */
                            .modal {
                                display: none;
                                /* Hidden by default */
                                position: fixed;
                                /* Stay in place */
                                z-index: 1;
                                /* Sit on top */
                                padding-top: 100px;
                                /* Location of the box */
                                left: 0;
                                top: 0;
                                width: 100%;
                                /* Full width */
                                height: 100%;
                                /* Full height */
                                overflow: auto;
                                /* Enable scroll if needed */
                                background-color: rgb(0, 0, 0);
                                /* Fallback color */
                                background-color: rgba(0, 0, 0, 0.9);
                                /* Black w/ opacity */
                            }

                            /* Modal Content (image) */
                            .modal-content {
                                margin: auto;
                                display: block;
                                width: 80%;
                                max-width: 700px;
                            }



                            @-webkit-keyframes zoom {
                                from {
                                    -webkit-transform: scale(0)
                                }

                                to {
                                    -webkit-transform: scale(1)
                                }
                            }

                            @keyframes zoom {
                                from {
                                    transform: scale(0)
                                }

                                to {
                                    transform: scale(1)
                                }
                            }

                            /* The Close Button */
                            .close {
                                position: absolute;
                                top: 80px;
                                right: 35px;
                                color: #f1f1f1;
                                font-size: 40px;
                                font-weight: bold;
                                transition: 0.3s;
                            }

                            .close:hover,
                            .close:focus {
                                color: #bbb;
                                text-decoration: none;
                                cursor: pointer;
                            }

                            #img01:hover,
                            #img01:focus {
                                color: #bbb;
                                text-decoration: none;
                                cursor: zoom-out;
                            }

                            /* 100% Image Width on Smaller Screens */
                            @media only screen and (max-width: 700px) {
                                .modal-content {
                                    width: 100%;
                                }
                            }
                        </style>




                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>
                                    <h4 class="text-blue h4">slip </h4>
                                </label>
                                <!-- <img id="image<a href='https://www.jqueryscript.net/zoom/'>Zoom </a>" src="https://source.unsplash.com/CkW90N_oro8/1200x900" /> -->

                                <img id="blah" src="#" alt="" width="100px" />

                                <div id="myModal" class="modal">
                                    <span class="close">&times;</span>
                                    <img class="modal-content" id="img01">
                                </div>


                                <input type="file" class="form-control" name="file" id="file" placeholder="ระบุ slip" onchange="readURL(this);" required>
                            </div>
                        </div>
                        <!--  <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                     <label><h4 class="text-blue h4">ประกัน </h4></label>
                                    <input type="text" class="form-control" name="insurance" id="insurance" placeholder="ระบุ ประกัน" required="">
                                </div>
                            </div> -->
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>
                                    <h4 class="text-blue h4">สิทธิประโยชน์ที่ได้รับ </h4>
                                </label><textarea id="note" name="note" class="form-control" rows="4" cols="50" placeholder="ระบุหมายเหตุ" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>
                                    <h4 class="text-blue h4">รายละเอียดเเพ็คเกจ </h4>
                                </label><textarea id="details" name="details" class="form-control" rows="4" cols="50"></textarea>
                            </div>
                        </div>
                        <script>
                            // Get the modal
                            var modal = document.getElementById("myModal");

                            // Get the image and insert it inside the modal - use its "alt" text as a caption
                            var img = document.getElementById("blah");
                            var modalImg = document.getElementById("img01");
                            img.onclick = function() {
                                modal.style.display = "block";
                                modalImg.src = this.src;
                                captionText.innerHTML = this.alt;
                            }

                            // Get the <span> element that closes the modal
                            var span = document.getElementsByClassName("close")[0];

                            // When the user clicks on <span> (x), close the modal
                            span.onclick = function() {
                                modal.style.display = "none";
                            }
                            modalImg.onclick = function() {
                                modal.style.display = "none";
                            }
                        </script>

                        <script language="javascript">
                            $(document).ready(function() {
                                let deposit = parseFloat($('#deposit').val());
                                deposit = deposit.toFixed(0)
                                let x1 = deposit.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                                // let v = "" + deposit;
                                // x1 = v;
                                // // console.log(x1);
                                // // x2 = v.length;
                                // var rgx = /(\d+)(\d{3})/;
                                // while (rgx.test(x1)) {
                                //     x1 = x1.replace(rgx, '$1' + ',' + '$2');
                                // }

                                $('#deposit').val(x1);

                                // let sum1 = parseFloat($('#sum').val());
                                // let v2 = "" + sum1;
                                // x2 = v2;
                                // // console.log(x2);
                                // // x2 = v.length;
                                // while (rgx.test(x2)) {
                                //     x2 = x2.replace(rgx, '$1' + ',' + '$2');
                                // }

                                // $('#sum').val(int(x2));
                            });

                            function a() {

                                var int1 = document.getElementById("sum").value;
                                var int2 = document.getElementById("Sales").value;
                                var int3 = document.getElementById("deposit2").value;
                                var n1 = parseFloat(int1);
                                var n2 = parseFloat(int2);
                                var n3 = parseFloat(int3);
                                // console.log(isNaN(int1));
                                if ((isNaN(n1)) || (isNaN(n2))) {
                                    document.getElementById("deposit").setAttribute("style", "color:red;");
                                    var deposit55 = document.getElementById("deposit").value = s;
                                    int1 = int1.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                                    document.getElementById("deposit").value = int1;

                                } else {
                                    if (n2 < 0 || n2 > n3) {
                                        $("#Sales").val('');
                                        int1 = int1.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                                        $("#deposit").val(int1);
                                    } else {
                                        s = n1 - n2
                                        s = s.toFixed(0);
                                        s = s.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                                        document.getElementById("deposit").setAttribute("style", "color:green;");
                                        var deposit55 = document.getElementById("deposit").value = s;
                                        document.getElementById("deposit").value = deposit55;
                                    }
                                }
                            }

                            function b() {
                                var int1 = document.getElementById("sum").value;
                                var int2 = document.getElementById("Sales").value;
                                var int3 = document.getElementById("deposit2").value;
                                var n1 = parseFloat(int1);
                                var n2 = parseFloat(int2);
                                var n3 = parseFloat(int3);
                                if (n1 < n3) {
                                    $('#sum').val(n3);
                                    s = n3 - n2;
                                    s = s.toFixed(0);
                                    s = s.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                                    $('#deposit').val(s);
                                }
                            }
                        </script>



                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>
                                    <h4 class="text-blue h4">จ่ายมัดจำ </h4>
                                </label>
                                <input type="text" class="form-control" name="Sales" id="Sales" value="" onkeyup="a()" required />
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>
                                    <h4 class="text-blue h4">คงเหลือ </h4>
                                </label>
                                <input type="text" class="form-control" name="deposit" id="deposit" value="<?php echo $sum; ?>" readonly />
                                <input type="text" class="form-control" name="deposit" id="deposit2" value="<?php echo $sum; ?>" hidden />
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>
                                    <h4 class="text-blue h4">ราคารวมทั้งหมด </h4>
                                </label>
                                <input type="number" min="<?php echo round($sum); ?>" class="form-control" name="sum" id="sum" value="<?php echo round($sum); ?>" onkeyup="a()" onchange="b()" />
                            </div>
                        </div>


                        <!--    <?php if ($car_num != 0) { ?>
                            <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label><h4 class="text-blue h4"> ผู้บริการรถ</h4></label>
                                        <input type="text" class="form-control" name="Carrier_name" id="Carrier_name" placeholder="ระบุ ผู้บริการ">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label><h4 class="text-blue h4">หมายเหตุ </h4></label>
                                    <input type="text" class="form-control" name="Carrier_name_note" id="Carrier_name_note" placeholder="ระบุ หมายเหตุ">
                                </div>
                            </div>
                        <?php  } else { ?>

                        <?php } ?>
                            
                        <?php if ($boat_num != 0) { ?>
                            

                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                     <label><h4 class="text-blue h4">ผู้บริการเรือ </h4></label>
                                    <input type="text" class="form-control" name="note" id="note" placeholder="ระบุ ผู้บริการ">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                     <label><h4 class="text-blue h4">หมายเหตุ </h4></label>
                                    <input type="text" class="form-control" name="note" id="note" placeholder="ระบุ หมายเหตุ">
                                </div>
                            </div>
                        <?php  } else { ?>

                        <?php } ?> 

                            

                        <?php if ($diving_num != 0) { ?>
                            

                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                     <label><h4 class="text-blue h4">ผู้บริการดำน้ำ </h4></label>
                                    <input type="text" class="form-control" name="note" id="note" placeholder="ระบุ ผู้บริการ">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                     <label><h4 class="text-blue h4">วันที่ดำน้ำ </h4></label>
                                    <input type="text" class="form-control" name="note" id="note" placeholder="ระบุ วันที่ดำน้ำ">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                     <label><h4 class="text-blue h4">หมายเหตุ </h4></label>
                                    <input type="text" class="form-control" name="note" id="note" placeholder="ระบุ หมายเหตุ">
                                </div>
                            </div>
                        <?php  } else { ?>

                        <?php } ?>     -->


                        <?php
                        $sql = "SELECT resort_name FROM tb_resort where $name ='$name'";
                        $query33 = mysqli_query($con, $sql);
                        $results33 = mysqli_fetch_assoc($query33);
                        // echo $results33['resort_name'];
                        ?>




                        <input  type="text" name="typser" value="<?php echo $typser; ?>">
                        <input  type="text" name="room_name" id="room_name" value="<?php echo $name ?>" />
                        <input  type="text" name="days" id="days" value="<?php echo $days; ?> " />
                        <input  type="text" name="name_roomtype" id="name_roomtype" value="<?php echo $name_roomtype ?>" />
                        <input  type="text" name="package" id="package" value="<?php echo $days; ?>" />
                        <input  type="text" name="number_of_rooms" id="number_of_rooms" value="<?php echo $bed ?>" />
                        <input  type="text" name="customers" id="customers" value="<?php echo $adult; ?>" />
                        <input  type="text" name="older_children" id="older_children" value="<?php echo $older_children; ?>" />
                        <input  type="text" name="child" id="child" value="<?php echo $child; ?>" />
                        <input  type="text" name="checkin" id="checkin" value="<?php echo $Checkin; ?>" />
                        <input  type="text" name="checkout" id="checkout" value="<?php echo $Checkout; ?>" />
                        <input  type="text" name="insurance" id="insurance" value="<?php echo $insurance; ?>">

                        <input  type="text" name="car_num" id="car_num" value="<?php echo $car_num; ?>" />
                        <input  type="text" name="boat_num" id="boat_num" value="<?php echo $boat_num; ?>" />
                        <input  type="text" name="diving_num" id="diving_num" value="<?php echo $diving_num; ?>" />
                        <input  type="text" name="commission_value" id="commission_value" value="<?php echo $commission_value; ?>" />
                        <input  type="text" name="com" id="com" value="<?php echo $com; ?>" />
                        <input  type="text" name="extrabed" id="extrabed" value="<?php echo $extrabed; ?>" />






                        <div class="col-md-4 col-sm-12">
                            <input type="text" name="type" id="type" hidden="" value="addresort">
                            <button type="submit" class="btn btn-warning" tabindex="-1">บันทึก</button>
                        </div>


                    </div>
                </form>
            </div>


            <div class="footer-wrap pd-20 mb-20 card-box">Welcome Akira Lipe , Ananya Lipe , Thechic Lipe <a href="https://ananyalipe.com" target="_blank">แบบฟอร์มเช็คราคาห้องพักของแต่ละรีสอร์ท</a></div>
        </div>
    </div>
    <script type="text/javascript">
        $('input').keydown(function(event) {
            // var keycode = (event.keyCode ? event.keyCode : event.which);
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    </script>

    <?php include "footer.php"; ?>
</body>

</html>