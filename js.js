getshowdata();
var datecur = '2020-12-16';
var year = 2020;
var mont = 12;

$('#ybox').val(year);
$('#monbox').val(mont);


var arroom = [];
let dayNamesMin = ["จันทร์", "อังคาร", "พุทธ์", "พฤหัส", "ศุกร์", "เสาร์", "อาทิต"];
let monthNames = ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];
$("#show_inv").empty();
var y = 0;
var t = '';
for (y = year; y <= (year + 5); y++) {
  t += "<option>" + y + "</option>";
}
$('#ybox:last').append(t);



function setselectmont() {
  var txtm = "";
  var m = 0;
  var str = "";
  var mss = $('#monbox').val();
  for (m = 0; m <= 11; m++) {
    str = "" + (m + 1);
    var ccs = "boxdata";
    if (str == mss) {
      ccs = "boxdatat";
    }
    txtm += "<div class='col-md-2'><div class='" + ccs + "' onclick='changm(" + str + ")'>" + str.padStart(2, '0') + " : " + monthNames[m] + "</div></div>";
  }
  $('#mbox').html("<div class='row'>" + txtm + "</div>");
}



function tocal(pr_room) {
  $('#showpd').html('');
  var n2 = $('#monbox').val();
  var n3 = $('#ybox').val();
  var maxpr = pr_room.length;
  var run = 0;
  $('#showtitle').html('ตารางจัดการราคาห้อง <b>' + monthNames[(n2 - 1)] + ' ปี ' + y + '</b>');
  var n1 = getDaysInMonth(n2, n3);

  var b = n1 * 1;
  var ystr = n3 * 1;
  var dayn = 0;
  var txtday = "";
  var txtdayw = "";
  var txtrow = "";
  for (dayn = 1; dayn <= b; dayn++) {
    var txtd = "" + dayn;
    var txtc = "" + ystr + "-" + n2 + "-" + dayn;
    var txtnm = cofwd(txtc);
    if (txtnm == 'อาทิต') {
      txtdayw += "<td style='background-color:red!important;color:#fff!important;font-size:11px!important'>" + txtnm + "</td>";
    } else if (datecur == txtc) {
      txtdayw += "<td style='background-color:blue!important;color:#fff!important;font-size:11px!important'>" + txtnm + "</td>";
    } else {
      txtdayw += "<td style='font-size:11px!important'><b>" + txtnm + "</b></td>";
    }
    txtday += "<td style='font-size:11px!important'><b>" + txtd.padStart(2, '0') + "</b></td>";
  }

  for (var rdm = 1; rdm <= arroom.length; rdm++) {
    var idrm = arroom[rdm - 1]['idroom'];
    txtrow += "<tr class='hoverrow'><td style=' width: 200px!important;text-align:left!important;font-size:12px!important;'>&nbsp;" + arroom[rdm - 1]['roomnm'] + "</td>";
    for (dayn = 1; dayn <= b; dayn++) {
      run++;
      var txtd = "" + dayn;
      var prm = "";
      var txtcd = n3 + "-" + n2.padStart(2, '0') + "-" + txtd.padStart(2, '0');
      for (let ii = 0; ii < maxpr; ii++) {

        if (pr_room[ii]['date_start'] == txtcd && pr_room[ii]['ID_room'] == idrm) {

          prm = pr_room[ii]['price_room'];

        }
      }
      txtrow += "<td><input type='text' style='width:100%;font-size:12px!important;text-align:right!important' onchange=\"saveauto(" + run + ",'" + txtcd + "'," + idrm + ")\" value='" + prm + "' id='prset" + run + "'></td>";
    }

    txtrow += "</tr>";
  }

  $('#showpd').html("<table style='width:100%;color:#888!important' class='tbborder'><tr style='background-image: linear-gradient(#ccc, #fff)'><td></td>" + txtdayw + "</tr><tr style='color:#fff;background-color:#1f2e5c!important'><td><b>ห้องพัก</b></td>" + txtday + "</tr>" + txtrow + "</table>");
}

function getpricall() {
  var year = $('#ybox').val();
  var mont = $('#monbox').val();
  $.ajax({
    type: 'POST',
    url: 'https://www.khemtis.com/booking/roompr.php',
    data: {
      year: year,
      mont: mont
    },
    dataType: 'json',
    success: function (data) {
      pr_room = [];
      $.each(data, function (index, element) {
        let text = {
          'idroom': element.ID_room,
          'date_start': element.date_start,
          'price_room': element.price_room,
        }
        pr_room.push(text);
      });
      //console.log(pr_room[1]['date_start']);
      tocal(pr_room);
    }
  });

}

function getshowdata() {
  var slsroom = $('#slsroom').val();
  $.ajax({
    type: 'POST',
    url: 'https://www.khemtis.com/booking/roomti.php',
    data: {
      get_param: slsroom
    },
    dataType: 'json',
    success: function (data) {
      arroom = [];
      $.each(data, function (index, element) {
        let text = {
          'idroom': element.id,
          'roomnm': element.name_roomtype,
        }

        arroom.push(text);
      });


    }
  });
}





function saveauto(run, dy, idr) {
  var vl = $('#prset' + run).val();
  //alert(vl);
  //alert(dy);
  //alert(idr);
  $.ajax({
    type: 'POST',
    url: 'saveroom.php',
    data: {
      price: vl,
      dy: dy,
      idrm: idr
    },
    dataType: 'html',
    success: function (data) {
      //alert(data);
      getpricall();
    }
  });
}




function changy() {
  reloadpagenew();
}

function changm(m) {
  $('#monbox').val(m);
  getshowdata();
}

function reloadpagenew() {
  getpricall();
}

/*
function  reloadpage(m,y){
  $('#monbox').val(m);
  $('#showtitle').html('ตารางจัดการราคาห้อง <b>'+monthNames[(m-1)]+' ปี '+y+'</b>');
    var b = getDaysInMonth(m,y);
    tocal(b,m,y);
}
*/

function cofwd(day) {
  var d = new Date(day);
  var weekday = new Array(7);
  weekday[0] = "อาทิต";
  weekday[1] = "จันทร์";
  weekday[2] = "อังคาร";
  weekday[3] = "พุทธ์";
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