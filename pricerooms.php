<!DOCTYPE html>
<html>
<?php include "head.php";
include_once('connectdb.php');

if ($_POST['id'] != "") {
    $id = $_POST['id'];
} else {
    $id = "1";
}



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
    <style>
        .slbox {
            background-image: linear-gradient(#ccc, #fff);
            height: 33px;
            padding: 5px !important;
            font-size: 17px;
            border: solid 1px #ccc;
            color: #463f3f;
        }

        .boxdata {
            padding: 2px;
            margin: 3px;
            padding-left: 5px;
            border: solid 1px #ccc;
            width: auto;
            border-radius: 5px;
            text-align: left;
            font-size: 14px;
            background-image: linear-gradient(#e2e2e2, #fff);

        }

        .boxdata :hover {
            padding: 2px;
            margin: 3px;
            padding-left: 5px;
            border: solid 1px #ccc;
            width: auto;
            border-radius: 5px;
            text-align: left;
            font-size: 14px;
            background-image: linear-gradient(#e2e2e2, #e2e2e2);
            cursor: pointer;

        }

        .boxdatat {
            padding: 2px;
            margin: 3px;
            padding-left: 5px;
            border: solid 1px #ccc;
            width: auto;
            border-radius: 5px;
            text-align: left;
            font-size: 14px;
            background-image: linear-gradient(#0b132b, #2e4382);
            color: #fff;
        }


        .tbborder tr td {
            border: solid 1px #ccc !important;
            text-align: center !important;
            font-size: 14px !important;
            padding: 1px !important;
        }

        .hoverrow {
            background-image: linear-gradient(#fff, #fff);
            color: #000 !important;

        }

        .hoverrow:hover {
            background-image: linear-gradient(#0b132b, #2e4382);
            color: #fff !important;
        }

        input[type=text] {
            border: none !important;
        }

        .hbox {
            background-color: #ccc;
            padding: 3px;
            height: 4px;
            width: 100%;
        }

        .inputprice:hover {
            background-color: yellow;
        }
    </style>
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
                            <div class="weight-600 font-30 text-blue">แก้ไขราคาห้องพัก</div>
                        </h4>
                    </div>
                </div>
            </div>


            <div class="card-box mb-30">
                <div class="pd-20">
                    <h3 class="text-blue h3">แก้ไขราคาห้องพัก</h3>
                </div>
                <div class="col-md-4 col-sm-12" style="padding-bottom: 20px;">

                    <div class="form-group">
                        <label>
                            <h4 class="text-blue h4">ที่พัก</h4>
                        </label>
                        <select class="custom-select col-12" id="nameresort" onchange="changroom()">
                            <!-- <option selected="">โปรดเลือกที่พัก...</option> -->
                            <?php
                            $sql1 = "SELECT * FROM `tb_resort` ";
                            $query1 = mysqli_query($con, $sql1);
                            while ($results1 = mysqli_fetch_assoc($query1)) {  ?>
                                <option value="<?php echo $results1["id"]; ?>"><?php echo $results1["resort_name"]; ?></option>
                            <?php  } ?>
                        </select>

                    </div>
                    <!-- <button type="submit" class="btn btn-warning">ค้นหา</button> -->

                </div>

                <div class="pb-20">

                    <div id="main">

                        <input type="hidden" id="maxday" name="maxday">
                        <table style="width:100%!important;border:solid 1px #ccc!important" class="bdno">
                            <tr>
                                <td colspan="2" style="font-size:30px;text-align: center; background-image: linear-gradient(#ccc, #fff);border:solid 1px #dcdcdc;background:#1f2e5c;color:#fff;" id="showtitle"></td>
                            </tr>
                            <tr>
                                <td style="width:100%!important">
                                    <div id="calendar" style="width:100%!important;width:100%;border:solid 1px #ccc">

                                        <select class="slbox" id="ybox" style="width:5%;" onchange="changyear()"></select>
                                        <br>
                                        <input type="hidden" id="monbox">
                                        <!-- <select class="slbox" id="nameresort" style="width:100%;" onchange="changroom()">
                                                <?php foreach ($all_resort as $value) : ?>
                                                    <option value="<?php echo $value['id']; ?>"><?php echo $value['resort_name']; ?></option>
                                                <?php endforeach; ?>
                                            </select> -->

                                        <div id="mbox" style="padding:5px"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:100%!important;" valign="top">

                                    <div id="showpd" style="width:100%;height:400px"></div>

                                </td>
                            </tr>
                        </table>

                        <!-- <style>
                            #dp .scheduler_default_cellparent,
                            .scheduler_default_cell.scheduler_default_cell_business.scheduler_default_cellparent {
                                background: #f3f3f3;
                            }
                        </style>


                        <div style="float:left; width:150px">
                            <div id="nav"></div>
                        </div>
                        <div style="margin-left: 150px">
                            <div id="dp"></div>
                        </div>
                        <div>
                            <a href="#" id="previous">
                                <<< Previous</a> | <a href="#" id="today">Today
                            </a>
                            |
                            <a href="#" id="next"> Next >>> </a>
                        </div>

                        <div id="print"></div>

                        <hr style="border: 1px solid">


                        <form class="form-inline center" action="file_upload.php" method="get">
                            <div class="form-group">
                                <label for="email">เลือกชื่อห้องพัก :</label>
                                <?php
                                $sqlnameroom = "SELECT * FROM tb_roomtype WHERE `id_resort` = '" . $id . "'";
                                $renameroom = mysqli_query($con, $sqlnameroom);
                                ?>
                                <select name="idroom" class="form-control" id="id_room">
                                    <?php while ($snameroom = mysqli_fetch_assoc($renameroom)) {
                                        echo "<option value='" . $snameroom['id'] . "'>" . $snameroom['name_roomtype'] . "</option>";
                                    } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="email">วันที่เริ่มต้น:</label>
                                <input type="date" class="form-control" name="start">
                            </div>
                            <div class="form-group">
                                <label for="pwd">วันที่สิ้นสุด:</label>
                                <input type="date" class="form-control" name="end">
                            </div>
                            <input type="hidden" class="form-control" name="type" value="de">
                            <button type="submit" class="btn btn-info">ลบ</button>
                        </form>

                        <hr style="border: 1px solid"> -->






                    </div>
                </div>





                <div class="footer-wrap pd-20 mb-20 card-box">Welcome Akira Lipe , Ananya Lipe , Thechic Lipe <a href="https://ananyalipe.com" target="_blank">แบบฟอร์มเช็คราคาห้องพักของแต่ละรีสอร์ท</a></div>
            </div>
        </div>
    </div>
    </form>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input type="text" id="idr" hidden>
                    <div class="form-group">
                        <label for="exampleInputEmail1">วันที่</label>
                        <input type="date" id="date1" class="form-control" format="yyyy-mm-dd">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">วันที่</label>
                        <input type="date" id="date2" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">ราคาห้อง</label>
                        <input type="number" id="priceroom" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="delPriceroom()" id="delsel">ลบราค้าห้องพัก</button>

                    <button type="button" class="btn btn-primary" onclick="savepriceroom()" id="savesel">เพิ่ม/แก้ไขราค้าห้องพัก</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>

    </div>
    <div>

        <style>
            ::-webkit-input-placeholder {
                opacity: 0.3;
            }
        </style>
    </div>

    <!-- <div class="modal fade" id="modaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleedi">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input type="text" id="eidr" hidden>
                    <div class="form-group">
                        <label for="exampleInputEmail1">วันที่</label>
                        <input type="date" id="edate1" class="form-control" readonly format="yyyy-mm-dd">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">ราคาห้อง</label>
                        <input type="number" id="epriceroom" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveeditpriceroom()" id="savesel">เพิ่มราค้าห้อง</button>
                </div>
            </div>
        </div>
    </div> -->




    <?php
    $dtsever = date("d");
    $mtsever = date("m");
    $ytsever = date("Y");
    $datecur = $ytsever . "-" . $mtsever . "-" . $dtsever;
    ?>

    <script src="https://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="https://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    <script src="http://jojosati.github.io/bootstrap-datepicker-thai/js/bootstrap-datepicker-thai.js"></script>
    <script src="http://jojosati.github.io/bootstrap-datepicker-thai/js/locales/bootstrap-datepicker.th.js"></script>
    <script id="example_script" type="text/javascript">
        var datecur = '<?php echo $datecur ?>';
        var year = <?php echo $ytsever ?>;
        var mont = <?php echo $mtsever ?>;
        $('#ybox').val(year);
        $('#monbox').val(mont);

        let dayNamesMin = ["จันทร์", "อังคาร", "พุทธ", "พฤหัส", "ศุกร์", "เสาร์", "อาทิต"];
        let monthNames = ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];

        $("#show_inv").empty();
        var y = 0;
        var t = '';
        var t2 = '';
        var getmonth = new Date();

        var tomonth = getmonth.getMonth() + 1;
        // console.log("tomont"+tomonth);
        for (y = year; y <= (year + 5); y++) {

            t += "<option>" + y + "</option>";
        }
        $('#ybox:last').append(t);

        // $.ajax({
        //     url: "resort.php",
        //     type: "GET",
        //     success: function(result) {
        //         var getdata = JSON.parse(result);
        //         getdata.forEach(data => {
        //             t2 += "<option value=" + data['id'] + ">" + data['resort_name'] + "</option>";
        //         });
        //         $('#nameresort:last').append(t2);
        //     }
        // });
        var txtm = "";
        var m = 0;
        var str = "";
        reloadpage(mont, year);
        // console.log($('#nameresort').val());
        function setmont() {
            var txtm = "";
            var m = 0;
            var str = "";
            var mss = $('#monbox').val();
            for (m = 0; m <= 11; m++) {
                str = "" + (m + 1);
                if (str == mss) {
                    txtm += "<div class='col-md-2' ><div class='boxdata' style='background:#1f2e5c;color:#fff;'  onclick='changm(" + str + ")'>" + str.padStart(2, '0') + " : " + monthNames[m] + "</div></div>";
                } else {
                    txtm += "<div class='col-md-2'><div class='boxdata' onclick='changm(" + str + ")'>" + str.padStart(2, '0') + " : " + monthNames[m] + "</div></div>";
                }
                // console.log("M" + m);

            }
            $('#mbox').html("<div class='row'>" + txtm + "</div>");

        }


        function tocal(pr_room) {
            $('#showpd').html('');
            var n2 = $('#monbox').val();
            var n3 = $('#ybox').val();
            var dc = new Date(datecur)
            // console.log(pr_room['roomtyp']);
            var maxpr = pr_room.length;
            // console.log("::=>" + maxpr);
            var run = 0;
            var n1 = getDaysInMonth(n2, n3);
            var b = n1 * 1;
            var ystr = n3 * 1;
            var dayn = 0;
            var txtday = "";
            var txtdayw = "";
            var txtrow = "";
            for (dayn = 1; dayn <= b; dayn++) {
                var txtd = "" + dayn;
                var txtc = "" + ystr + "-" + n2.padStart(2, '0') + "-" + txtd.padStart(2, '0');
                var txtnm = cofwd(txtc);
                // console.log(txtc);
                if (txtnm == 'อาทิต') {
                    txtdayw += "<td style='background-color:red!important;color:#fff!important'>" + txtnm + "</td>";
                } else if (datecur == txtc) {

                    txtdayw += "<td style='background-color:blue!important;color:#fff!important'>" + txtnm + "</td>";
                } else {
                    txtdayw += "<td><b>" + txtnm + "</b></td>";
                }
                txtday += "<td style='background:#1f2e5c;color:#fff;'><b>" + txtd.padStart(2, '0') + "</b></td>";
            }
            var idresort = $('#nameresort').val();

            $.ajax({
                url: "ajaxdata.php?page=pricerooms&id_resort=" + idresort,
                type: "GET",
                success: function(result) {
                    var getdata = JSON.parse(result);
                    // var maxday = 1;
                    var run = 0;
                    // console.log(getdata[0]);
                    // console.log(getdata);
                    for (var rdm = 0; rdm < getdata.length; rdm++) {
                        var idrm = getdata[rdm]['id'];
                        var prt = getdata[rdm]['price_roomtype'];

                        var namerm = getdata[rdm]['name_roomtype'];
                        txtrow += "<tr class='hoverrow' ><td style=' width: 220px!important;text-align:left!important;'>" + getdata[rdm]['name_roomtype'] + "</td>";
                        for (dayn = 1; dayn <= b; dayn++) {
                            run++;
                            var txtd = "" + dayn;
                            var prm = "";
                            var npr = '';
                            var txtcd = n3 + "-" + n2.padStart(2, '0') + "-" + txtd.padStart(2, '0');
                            var dn = new Date(txtcd)
                            // console.log("price->room");
                            // console.log(pr_room);
                            for (let ii = 0; ii < maxpr; ii++) {

                                // console.log(pr_room['priceday'][ii]['date_start'] + "=>"+txtcd );
                                if (pr_room[ii]['date_start'] == txtcd && pr_room[ii]['idroom'] == idrm) {

                                    prm = pr_room[ii]['price_room'];
                                    console.log(prm);
                                }

                            }

                            if (prt == 0) {
                                prt = "";
                            }

                            if (dc <= dn) {
                                txtrow += "<td style=''><input class='inputprice' type='text' placeholder='" + prt + "' style='width:100%;font-size:12px!important;text-align:right!important' oncontextmenu=\"mouseclick(" + run + ",'" + txtcd + "'," + idrm + ",'" + namerm + "'" + ")\" onchange=\"saveauto(" + run + ",'" + txtcd + "'," + idrm + ")\" value='" + prm + "' id='prset" + run + "'></td>";
                            } else {
                                txtrow += "<td ><input class='inputprice' type='text' placeholder='" + prt + "' style='width:100%;font-size:12px!important;text-align:right!important' value='" + prm + "' id='prset" + run + "' readonly></td>";
                            }


                            // maxday++;
                        }
                        txtrow += "</tr>";
                    }
                    // $('#maxday').val(maxday);
                    $('#showpd').html("<table style='width:100%' class='tbborder'><tr><td></td>" + txtdayw + "</tr><tr style='background-image: linear-gradient(#ccc, #fff)'><td style='background:#1f2e5c;color:#fff;'>ห้องพัก</td>" + txtday + "</tr>" + txtrow + "</table><br>");
                }
            });



        }


        function getcellprice() {
            var year = $('#ybox').val();
            var mont = $('#monbox').val();
            var idreosrt = $('#nameresort').val();
            // console.log("id=>" + idreosrt);
            var y1 = "" + year.padStart(2, '0')
            var m1 = "" + mont.padStart(2, '0')
            // console.log("Year:=>"+year+"Mont:=>"+m1);
            $.ajax({
                type: 'POST',
                url: "ajaxdata.php?page=showpriceroom&year=" + y1 + "&mont=" + m1 + "&idresort=" + idreosrt,
                dataType: 'json',
                success: function(data) {
                    pr_room = [];
                    $.each(data, function(index, element) {
                        let text = {
                            'idroom': element.ID_room,
                            'date_start': element.date_start,
                            'price_room': element.price_room,
                        }
                        pr_room.push(text);
                    });
                    console.log(pr_room)
                    tocal(pr_room);
                }

            });
        }


        function changm(m) {
            $('#monbox').val(m);
            reloadpagenew();
        }

        function reloadpagenew() {
            var y = $('#ybox').val();
            var m = $('#monbox').val();
            // console.log(m);
            $('#showtitle').html('ตารางจัดการราคาห้อง <b>' + monthNames[(m - 1)] + ' ปี ' + y + '</b>');
            var b = getDaysInMonth(m, y);
            // if (m != "") {
            //     tocal(b, m, y);
            // } else {
            //     tocal(b, mont, y);
            // }
            getcellprice();
            // tocal(b, m, y);
            setmont();

        }





        function reloadpage(m, y) {
            $('#showtitle').html('ตารางจัดการราคาห้อง <b>' + monthNames[(m - 1)] + ' ปี ' + y + '</b>');
            var b = getDaysInMonth(m, y);
            // if (m != "") {
            //     tocal(b, m, y);
            // } else {
            //     tocal(b, mont, y);
            // }
            getcellprice();
            // tocal(b, m, y);
            setmont();
        }


        function cofwd(day) {

            var d = new Date(day);
            var weekday = new Array(7);
            weekday[0] = "อาทิต";
            weekday[1] = "จันทร์";
            weekday[2] = "อังคาร";
            weekday[3] = "พุทธ";
            weekday[4] = "พฤหัส";
            weekday[5] = "ศุกร์";
            weekday[6] = "เสาร์";
            return weekday[d.getDay()];

        }



        function curdate() {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();
            today = mm + '/' + dd + '/' + yyyy;
            return today;
        }

        function getDaysInMonth(month, year) {
            return new Date(year, month, 0).getDate();

        }

        function changyear() {
            var y2 = $('#ybox').val();
            var m2 = $('#monbox').val();
            var b = getDaysInMonth(m, y);
            reloadpagenew();
            // if (m2 != "") {
            //     reloadpagenew()
            // } else {
            //     reloadpage(mont, y2)
            // }


        }


        function changroom() {

            var y2 = $('#ybox').val();
            var m2 = $('#monbox').val();
            var b = getDaysInMonth(m, y);

            // reloadpagenew();

            // if (m2 != "") {

            reloadpagenew();

            // } else {

            //     reloadpage(mont, y2)
            // }

        }

        function saveauto(run, dy, idr) {
            var vl = $('#prset' + run).val();
            $.ajax({
                type: 'POST',
                url: 'saveroom.php',
                data: {
                    price: vl,
                    dy: dy,
                    idrm: idr
                },
                dataType: 'html',
                success: function(data) {
                    let json = JSON.parse(data);
                    if (json.status == 200) {
                        swal("สำเร็จ!", "เพิ่มข้อมูลเรียบร้อย", "success");
                    } else {
                        swal("สำเร็จ!", "อัปเดตข้อมูลเรียบร้อย", "success");
                    }
                    console.log(data);
                    getcellprice();
                }
            });
        }

        // function del(run, dy, idr, nrm) {
        //     var vl = $('#prset' + run).val();
        //     if (vl != "" && vl != null) {
        //         $('#modaledit').modal('show');
        //         $('.modal-title').html(nrm + " (แก้ไข)");
        //         $('.modal-body #didr').val(idr);
        //         $('.modal-body #ddate1').val(dy);
        //         $('.modal-body #dpriceroom').val(vl);

        //     } else {
        //         swal("!!! ไม่มีข้อมูล");
        //     }

        // }

        // function saveeditpriceroom() {
        //     var idr = $('.modal-body #eidr').val();
        //     var day1 = $('.modal-body #edate1').val();
        // }

        function mouseclick(run, dy, idr, nrm) {
            var vl = $('#prset' + run).val();
            if (vl != "" && vl != null) {
                $('.modal-title').html(nrm)
                $('#exampleModal').modal('show')
                $('.modal-body #idr').val(idr);
                $('.modal-body #date1').val(dy);
                $('.modal-body #date2').val(dy);
                document.getElementById("date2").min = dy;
            } else {
                swal("ข้อควรระวัง!!", "กรุณาเลือกราคาห้องพัก", "info")
            }
            // alert(nrm);

            // $('.modal-body #date2').datepicker({
            //     miDate: datecur
            // });

            $('.modal-body #priceroom').val(vl);
        }

        function savepriceroom() {

            let prarry = [];
            var idr = $('.modal-body #idr').val();

            var day1 = $('.modal-body #date1').val();
            var day2 = $('.modal-body #date2').val();
            var dayf = new Date(day1)

            var d = dayf.getDate();
            // alert(new String(d))
            // alert(day2);
            var proom = $('.modal-body #priceroom').val();

            var date1 = new Date(day1);
            var date2 = new Date(day2);



            var Difference_In_Time = date2.getTime() - date1.getTime();
            var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
            // console.log(Difference_In_Days);

            for (let i = 1; i <= Difference_In_Days; i++) {
                date1.setDate(date1.getDate() + 1)
                var d = date1.getDate();
                var y = date1.getFullYear();
                var m = date1.getMonth() + 1;
                var y1 = "" + y;
                var m1 = "" + m;
                var d1 = "" + d;
                var fdate = y1 + "-" + m1.padStart(2, '0') + "-" + d1.padStart(2, '0');
                let data = {
                    price: proom,
                    dy: fdate,

                }
                prarry.push(data);
            }
            data = {
                price: proom,
                dy: day1,
            }
            prarry.push(data);
            // console.log(prarry);

            // console.log(prarry);
            $.ajax({
                type: 'POST',
                url: "savesel.php",
                data: {
                    idrm: idr,
                    saveprice: prarry
                },
                dataType: 'text',
                success: function(data) {
                    // let josn = JSON.parse();
                    swal("สำเร็จ!", "", "success");
                    $('#exampleModal').modal('hide')
                    getcellprice();
                }
            });
        }


        function delPriceroom() {
            swal({
                    title: "คุณต้องการลบหรือไม่?",
                    text: "เมื่อลบแล้วคุณจะไม่สามารถกู้คืนไฟล์จินตภาพนี้ได้!!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        let prarry = [];
                        var idr = $('.modal-body #idr').val();
                        var day1 = $('.modal-body #date1').val();
                        var day2 = $('.modal-body #date2').val();
                        var dayf = new Date(day1)
                        var d = dayf.getDate();
                        var proom = $('.modal-body #priceroom').val();
                        var date1 = new Date(day1);
                        var date2 = new Date(day2);
                        var Difference_In_Time = date2.getTime() - date1.getTime();
                        var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
                        for (let i = 1; i <= Difference_In_Days; i++) {
                            date1.setDate(date1.getDate() + 1)
                            var d = date1.getDate();
                            var y = date1.getFullYear();
                            var m = date1.getMonth() + 1;
                            var y1 = "" + y;
                            var m1 = "" + m;
                            var d1 = "" + d;
                            var fdate = y1 + "-" + m1.padStart(2, '0') + "-" + d1.padStart(2, '0');
                            let data = {
                                price: proom,
                                dy: fdate,
                            }
                            prarry.push(data);
                        }
                        data = {
                            price: proom,
                            dy: day1,
                        }
                        prarry.push(data);
                        $.ajax({
                            type: 'POST',
                            url: "delpriceroom.php",
                            data: {
                                idrm: idr,
                                saveprice: prarry
                            },
                            dataType: 'html',
                            success: function(data) {

                                swal("สำเร็จ!", "ลบราค้าห้องพักสำเร็จ", "success");

                                $('#exampleModal').modal('hide');
                                getcellprice();
                            }
                        });





                        // swal("Poof! Your imaginary file has been deleted!", {
                        //     icon: "success",
                        // });
                    } else {
                        // swal("Your imaginary file is safe!");
                    }
                })






















            // var txt;
            // var r = confirm("ยืนยันการลบ ");
            // if (r == true) {
            //     
            // } else {

            // }


        }

        $(document).contextmenu(function() {
            return false;
        });
    </script>
    <?php include "footer.php"; ?>
</body>
<!-- <div id="dialog" title="Basic dialog">
    <p>This is the default dialog which is useful for displaying information. The dialog window can be moved, resized and closed with the &apos;x&apos; icon.</p>
</div> -->

</html>


<link type="text/css" rel="stylesheet" href="scheduler/helpers/demo.css?v=2018.4.3442" />
<link type="text/css" rel="stylesheet" href="scheduler/helpers/media/layout.css?v=2018.4.3442" />
<link type="text/css" rel="stylesheet" href="scheduler/helpers/media/elements.css?v=2018.4.3442" />
<!-- <script src="scheduler/helpers/jquery-1.12.2.min.js" type="text/javascript"></script> -->
<script src="scheduler/js/daypilot-all.min.js?v=2018.4.3442" type="text/javascript"></script>
<link type="text/css" rel="stylesheet" href="scheduler/themes/areas.css?v=2018.4.3442" />
<link type="text/css" rel="stylesheet" href="scheduler/themes/month_white.css?v=2018.4.3442" />
<link type="text/css" rel="stylesheet" href="scheduler/themes/month_green.css?v=2018.4.3442" />
<link type="text/css" rel="stylesheet" href="scheduler/themes/month_transparent.css?v=2018.4.3442" />
<link type="text/css" rel="stylesheet" href="scheduler/themes/month_traditional.css?v=2018.4.3442" />
<link type="text/css" rel="stylesheet" href="scheduler/themes/navigator_8.css?v=2018.4.3442" />
<link type="text/css" rel="stylesheet" href="scheduler/themes/navigator_white.css?v=2018.4.3442" />
<link type="text/css" rel="stylesheet" href="scheduler/themes/calendar_transparent.css?v=2018.4.3442" />
<link type="text/css" rel="stylesheet" href="scheduler/themes/calendar_white.css?v=2018.4.3442" />
<link type="text/css" rel="stylesheet" href="scheduler/themes/calendar_green.css?v=2018.4.3442" />
<link type="text/css" rel="stylesheet" href="scheduler/themes/calendar_traditional.css?v=2018.4.3442" />
<link type="text/css" rel="stylesheet" href="scheduler/themes/scheduler_8.css?v=2018.4.3442" />
<link type="text/css" rel="stylesheet" href="scheduler/themes/scheduler_white.css?v=2018.4.3442" />
<link type="text/css" rel="stylesheet" href="scheduler/themes/scheduler_green.css?v=2018.4.3442" />
<link type="text/css" rel="stylesheet" href="scheduler/themes/scheduler_blue.css?v=2018.4.3442" />
<link type="text/css" rel="stylesheet" href="scheduler/themes/scheduler_traditional.css?v=2018.4.3442" />
<link type="text/css" rel="stylesheet" href="scheduler/themes/scheduler_transparent.css?v=2018.4.3442" />


<!-- <script>
    var elements = {
        previous: document.getElementById("previous"),
        today: document.getElementById("today"),
        next: document.getElementById("next")
    };

    elements.previous.addEventListener("click", function(e) {
        e.preventDefault();
        changeDate(dp.startDate.addMonths(-1));
    });
    elements.today.addEventListener("click", function(e) {
        e.preventDefault();
        changeDate(DayPilot.Date.today());
    });
    elements.next.addEventListener("click", function(e) {
        e.preventDefault();
        changeDate(dp.startDate.addMonths(1));
    });


    function changeDate(date) {

        dp.startDate = date.firstDayOfMonth();
        //alert(date.firstDayOfMonth());
        dp.days = dp.startDate.daysInMonth();
        //alert(dp.startDate.daysInMonth());
        dp.resources = [
            <?php
            $sql = "SELECT * FROM tb_roomtype WHERE `id_resort` = '" . $id . "' ";
            $query = mysqli_query($con, $sql);
            while ($results = mysqli_fetch_assoc($query)) {

                echo '{ name: "' . $results["name_roomtype"] . '", id: "' . $results["id"] . '" },';
            }
            ?>

        ]; // provide event data for the new date range
        dp.update();
    }
</script> -->

<!-- <script type="text/javascript">
    var nav = new DayPilot.Navigator("nav");
    nav.showMonths = 1;
    nav.selectMode = "month";
    nav.onTimeRangeSelected = function(args) {
        dp.startDate = args.start;
        dp.days = args.days;
        dp.update();
    };
    nav.init();

    var dp = new DayPilot.Scheduler("dp");

    // view
    dp.startDate = nav.selectionStart;
    dp.cellGroupBy = "Month";
    dp.days = DayPilot.DateUtil.daysDiff(nav.selectionStart, nav.selectionEnd);
    dp.scale = "Day";
    dp.cellWidthSpec = "Auto";
    dp.timeHeaders = [{
            groupBy: "Month",
            format: "MMMM yyyy"
        },
        {
            groupBy: "Day",
            format: "ddd d"
        }
    ];
    dp.contextMenu = new DayPilot.Menu({
        items: [{
                text: "Edit price",
                onClick: function(args) {
                    //dp.events.edit(args.source);

                    var s_pr = (JSON.parse(JSON.stringify(args.source)).text).split("<br>");
                    var pr = prompt("Please enter your price:", s_pr[1]);

                    if (pr == null || pr == "") {

                    } else {
                        var price = pr;
                        var datas = (JSON.stringify(args.source));
                        //-----------------------------------------------edit price -----------------
                        $.ajax({
                            type: "GET",
                            url: "file_upload.php?type=editpriceroom&data=" + datas + "&price=" + price,
                            success: function(result) {
                                location.reload();

                            },
                            error: function(jqXHR, textStatus, err) {
                                //show error message
                                alert('text status ' + textStatus + ', err ' + err);
                            }
                        });
                    }


                }
            },
            {
                text: "Delete",
                onClick: function(args) {

                    var id = (JSON.parse(JSON.stringify(args.source)).id);
                    $.ajax({
                        type: "GET",
                        url: "file_upload.php?type=delpriceroom&id=" + id,
                        success: function(result) {
                            location.reload();

                        },
                        error: function(jqXHR, textStatus, err) {
                            //show error message
                            alert('text status ' + textStatus + ', err ' + err);
                        }
                    });



                }
            },
            {
                text: "-"
            },
            //  {text:"Select", onClick: function(args) { dp.multiselect.add(args.source); } },
        ]
    });

    //dp.treeEnabled = true;
    // dp.treePreventParentUsage = true;






    dp.resources = [
        <?php
        $sql = "SELECT * FROM tb_roomtype WHERE `id_resort` = '" . $id . "'  ";
        $query = mysqli_query($con, $sql);
        while ($results = mysqli_fetch_assoc($query)) {

            echo '{ name: "' . $results["name_roomtype"] . '", id: "' . $results["id"] . '" },';
        }
        ?>

    ];
    // ------------------------ data event ------------
    dp.events.list = [];

    <?php

    $sql_pr = "SELECT * FROM priceroom";
    $query_pr = mysqli_query($con, $sql_pr);
    while ($pr = mysqli_fetch_assoc($query_pr)) {
        // // Checkin.ID_room, Price_room
        // $sql_booking ="SELECT * FROM `booking` ";		
        // 	 $query_booking = mysqli_query($con,$sql_booking);
        // 	 $sqlnumrow = mysqli_num_rows($query_booking);
        // 	 while($results_booking = mysqli_fetch_assoc($query_booking)){
        // 	//Booking

        // 				$sql = ( "SELECT * FROM room where ID_room = ".$pr["ID_room"]);
        //  						$res = mysqli_query( $con, $sql );

        //  						while ( $r = mysqli_fetch_assoc( $res ) ) {	 
        // 					$chechkin = $pr["date_start"];
        // 					$checkout = date( "Y-m-d", strtotime( $chechkin." -1 day") );
        // 			 		$sqln ="SELECT *, SUM(num_room) AS sumroom FROM booking WHERE STATUS <= 2 AND( ( checkin BETWEEN '$chechkin 12:01:00' AND '$checkout 12:00:00' ) OR( checkout BETWEEN '$checkout 12:01:00' AND '$chechkin 12:00:00' ) OR( '$chechkin 12:01:00' BETWEEN checkin AND checkout ) OR( '$chechkin 12:00:00' BETWEEN checkin AND checkout ) ) AND booking.ID_room = ".$pr["ID_room"];


        // 							$sqlcount = mysqli_query($con,$sqln);
        //                                if($resu = mysqli_fetch_array($sqlcount)){
        // 								$sq ="SELECT *, SUM(num_room) AS sumroom1 FROM booking WHERE STATUS <= 2 AND(  checkout BETWEEN '$checkout 12:01:00' AND '$chechkin 12:00:00' ) AND booking.ID_room = ".$pr["ID_room"];
        // 								  $sqlc = mysqli_query($con,$sq);

        // 								  if($rs = mysqli_fetch_array($sqlc)){
        // 									  $rs =$rs['sumroom1'];
        // 									  $balance_r =   $resu['sumroom']-$rs ;
        // 								  }else{
        // 									  $balance_r = $resu['sumroom'] ;
        // 								  }


        // 							}

        // 						$sum = $r['total_room'] - $balance_r;
        // 			}
        // 	'.$sum.'<br>'	}


        echo 'var e = {
					start: "' . $pr["date_start"] . 'T00:00:00",
					end: "' . $pr["date_start"] . 'T00:00:00",
					id: "' . $pr["id_priceroom"] . '",
					resource:"' . $pr["ID_room"] . '",
					text: "' . $pr["price_room"] . '",
					bubbleHtml: "' . $pr["price_room"] . '",
				};
				dp.events.list.push(e);';
    }


    ?>



    dp.eventMovingStartEndEnabled = true;
    dp.eventResizingStartEndEnabled = true;
    dp.timeRangeSelectingStartEndEnabled = true;

    // event moving
    /*dp.onEventMoved = function (args) {
        dp.message("Moved: " + args.e.text());
	   alert(JSON.stringify(args.e));
    };

    dp.onEventMoving = function(args) {
        if (args.e.resource() === "A" && args.resource === "B") {  // don't allow moving from A to B
            args.left.enabled = false;
            args.right.html = "You can't move an event from Room 1 to Room 2";

            args.allowed = false;
        }
        else if (args.resource === "B") {  // must start on a working day, maximum length one day
            while (args.start.getDayOfWeek() === 0 || args.start.getDayOfWeek() === 6) {
                args.start = args.start.addDays(1);
            }
            args.end = args.start.addDays(1);  // fixed duration
            args.left.enabled = false;
            args.right.html = "Events in Room 2 must start on a workday and are limited to 1 day.";
        }

        if (args.resource === "C") {
            var except = args.e.data;
            var events = dp.rows.find(args.resource).events.all();

            var start = args.start;
            var end = args.end;
            var overlaps = events.some(function(item) {
                return item.data !== except && DayPilot.Util.overlaps(item.start(), item.end(), start, end);
            });

            while (overlaps) {
                start = start.addDays(1);
                end = end.addDays(1);

                overlaps = events.some(function(item) {
                    return item.data !== except && DayPilot.Util.overlaps(item.start(), item.end(), start, end);
                });
            }

            if (args.start !== start) {
                args.start = start;
                args.end = end;

                args.left.enabled = false;
                args.right.html = "Start automatically moved to " + args.start.toString("d MMMM, yyyy");
            }

        }

    };*/

    // event resizing
    dp.onEventResized = function(args) {
        dp.message("Resized: " + args.e.text());
    };

    // event creating
    dp.onTimeRangeSelected = function(args) {
        DayPilot.Modal.prompt("New price:", "").then(function(modal) {
            dp.clearSelection();
            var name = modal.result;
            if (!name) return;
            var e = new DayPilot.Event({
                start: args.start,
                end: args.end,
                //id: DayPilot.guid(),
                resource: args.resource,
                text: name
            });
            if (dp.events.add(e)) {
                var datas = JSON.stringify(e);

                //-----------------------------------------------save price -----------------
                $.ajax({
                    type: "GET",
                    url: "file_upload.php?type=addpriceroom&data=" + datas,
                    success: function(result) {

                        alert('Success');
                        location.reload();

                    },
                    error: function(jqXHR, textStatus, err) {
                        //show error message
                        alert('text status ' + textStatus + ', err ' + err);
                    }
                });
            }
            // dp.message("Created");
        });
    };


    dp.onEventMove = function(args) {
        if (args.ctrl) {
            var newEvent = new DayPilot.Event({
                start: args.newStart,
                end: args.newEnd,
                text: "Copy of " + args.e.text(),
                resource: args.newResource,
                id: DayPilot.guid() // generate random id
            });
            dp.events.add(newEvent);

            // notify the server about the action here

            args.preventDefault(); // prevent the default action - moving event to the new location
        }
    };



    dp.onBeforeTimeHeaderRender = function(args) {
        if (args.header.level === 1) {
            var ch = (args.header.html).split(" ");
            if (ch[0] === "Sa" || ch[0] === "Su") {
                args.header.areas = [{
                    top: 0,
                    width: 100,
                    bottom: 0,
                    backColor: "rgba(255, 0, 0, .4)"
                }, ];
            }


        }

    };







    dp.init();



    function barColor(i) {
        var colors = ["#3c78d8", "#6aa84f", "#f1c232", "#cc0000"];
        return colors[i % 4];
    }

    function barBackColor(i) {
        var colors = ["#a4c2f4", "#b6d7a8", "#ffe599", "#ea9999"];
        return colors[i % 4];
    }
</script> -->


</div>
</div>
</div>
</div>
<!-- <script type="text/javascript">
    $(document).ready(function() {


        var url = window.location.href;
        var filename = url.substring(url.lastIndexOf('/') + 1);
        if (filename === "") filename = "index.html";
        $(".menu a[href='" + filename + "']").addClass("selected");

        $(".menu-title").click(function() {
            $(".menu-body").toggle();
            if ($(".menu-body").is(":visible")) {
                scrollTo({
                    top: pageYOffset + 100,
                    behavior: "smooth"
                });
            }
        });
    });
</script> -->