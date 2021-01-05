<!DOCTYPE html>
<html>
<?php

include "head.php";
include_once('connectdb.php');

$id_booking =  $_REQUEST['id_booking'];
$resort_name =  $_REQUEST['resort_name'];

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
                            Welcome Akira Lipe , Ananya Lipe , Thechic Lipe
                            <div class="weight-600 font-30 text-blue">ออกใบประกัน</div>
                        </h4>
                    </div>
                </div>
            </div>

            <div class="pd-20 card-box mb-30">





                <script src="vendors/scripts/jquery-latest.js"></script>
                <script type="text/javascript">
                    $(document).ready(function() {

                        var rows = 0;

                        $("#createRows").click(function() {
                            var tr = "<tr id='coltr" + rows + "'>";
                            // tr = tr + "<td><input class='form-control' type='text' name='ids"+rows+"' id='ids"+rows+"' size='5' ></td>";
                            tr = tr + "<td><input class='form-control' type='text' name='name" + rows + "' id='name" + rows + "' size='10' required></td>";
                            tr = tr + "<td><input class='form-control' type='text' name='age" + rows + "' id='age" + rows + "' size='15'  pattern='([0-9]{,})' title='กรุณาใส่ข้อมูลให้ถูกต้อง' required></td>";
                            tr = tr + "<td><button type ='button' class='btn btn-danger' ' onclick='delcol(" + rows + ")'>ลบ</button ></td>";
                            tr = tr + "</tr>";
                            $('#myTable > tbody:last').append(tr);
                            rows = rows + 1;
                            $('#hdnCount').val(rows);

                        });

                        $("#clearRows").click(function() {
                            rows = 0;
                            $('#hdnCount').val(rows);
                            $('#myTable > tbody:last').empty(); // remove all
                            if ($("#id_resort").val() != "" && rows != 0) {
                                document.getElementById("save").disabled = false;
                            } else {
                                document.getElementById("save").disabled = true;
                            }
                            console.log(rows);
                        });

                        $("#id_resort").change(function() {
                            // console.log($('#id_resort').val());
                            var value = $("#id_resort").val();
                            if (value != "" && $('#hdnCount').val() != 0) {
                                document.getElementById("save").disabled = false;
                            } else {
                                document.getElementById("save").disabled = true;
                            }

                        })
                        $("#save").click(function() {
                            if ($("#hdnCount").val() != 0) {
                                document.getElementById("save").disabled = false;
                            } else {
                                document.getElementById("save").disabled = true;
                            }
                        })

                    });


                    function delcol(x) {
                        var str = "#coltr" + x
                        console.log($(str));
                        $(str).remove();
                    }
                </script>

                <center>
                    <form action="save.php" id="frmMain" name="frmMain" method="post">
                        <table class="table" id="myTable">
                            <!-- head table -->
                            <thead>
                                <tr>
                                    <!--  <td width="91"> <div align="center">ลำดับ </div></td> -->
                                    <td width="98">
                                        <div align="center">
                                            <div class="weight-600 font-30 text-blue">ชื่อ-นามสกุล</div>
                                        </div>
                                    </td>
                                    <td width="198">
                                        <div align="center">
                                            <div class="weight-600 font-30 text-blue">อายุ</div>
                                        </div>
                                    </td>
                                    <td width="198">
                                        <div align="center">
                                            <div class="weight-600 font-30 text-blue"></div>
                                        </div>
                                    </td>
                                </tr>
                            </thead>
                            <!-- body dynamic rows -->
                            <tbody></tbody>
                        </table>
                        <br />
                        <input class="btn btn-warning" type="button" id="createRows" value="Add">
                        <!-- <input class="btn btn-danger" type="button" id="deleteRows" value="Del"> -->
                        <input class="btn btn-success" type="button" id="clearRows" value="Clear">
                        <center>
                            <br>

                            <input hidden type="text" id="hdnCount" name="hdnCount">
                            <input hidden type="text" id="id_booking" name="id_booking" value="<?php echo $id_booking ?>">
                            <input hidden type="text" id="resort_name" name="resort_name" value="<?php echo $resort_name ?>">

                            <input class="btn btn-info" type="submit" value="Submit" id='save'>
                    </form>










            </div>



            <div class="footer-wrap pd-20 mb-20 card-box">Welcome Akira Lipe , Ananya Lipe , Thechic Lipe <a href="https://ananyalipe.com" target="_blank">แบบฟอร์มเช็คราคาห้องพักของแต่ละรีสอร์ท</a></div>
        </div>
    </div>

    <?php include "footer.php"; ?>
</body>

</html>