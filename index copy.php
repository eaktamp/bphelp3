<?php
session_start();
date_default_timezone_set('asia/bangkok');

$v = date('YmdHis'); // css version Reload

?>
<!DOCTYPE html>
<script type="text/javascript">
	function date_time(id) {
		date = new Date;
		year = date.getFullYear();
		month = date.getMonth();
		months = new Array('มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม');
		d = date.getDate();
		day = date.getDay();
		days = new Array('อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสดี', 'ศุกร์', 'เสาร์');
		h = date.getHours();
		if (h < 10) {
			h = "0" + h;
		}
		m = date.getMinutes();
		if (m < 10) {
			m = "0" + m;
		}
		s = date.getSeconds();
		if (s < 10) {
			s = "0" + s;
		}
		result = 'วัน' + days[day] + ' ที่ ' + d + ' เดือน ' + months[month] + ' พ.ศ. ' + (year + 543) + '  เวลา ' + h + ':' + m + ':' + s + ' น.';
		document.getElementById(id).innerHTML = result;
		setTimeout('date_time("' + id + '");', '1000');
		return true;
	}
</script>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>BP Check</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="assets/materialize/css/materialize.min.css?v=<?php echo $v; ?>" media="screen,projection" />
	<link href="assets/css/bootstrap.css?v=<?php echo $v; ?>" rel="stylesheet" />
	<link href="assets/css/font-awesome.css?v=<?php echo $v; ?>" rel="stylesheet" />
	<link href="assets/js/morris/morris-0.4.3.min.css?v=<?php echo $v; ?>" rel="stylesheet" />
	<link href="assets/css/custom-styles.css?v=<?php echo $v; ?>" rel="stylesheet" />
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
	<link rel="stylesheet" href="assets/js/Lightweight-Chart/cssCharts.css?v=<?php echo $v; ?>">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.js"></script>

	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />




</head>

<body>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<div id="wrapper">
		<nav class="navbar navbar-default top-navbar" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle waves-effect waves-dark" data-toggle="collapse" data-target=".sidebar-collapse">
				</button>
				<a class="navbar-brand waves-effect waves-dark" href=""><i class="large material-icons">device_thermostat</i> <strong>BP Check2</strong>

				</a>

				<div id="sideNav" href="" class="closed"><i class="material-icons dp48">toc</i>
				</div>

				<ul class="nav navbar-right">
					<li>
						<a href="#" class="">
							<span class="dt" id="date_time"></span>
						</a>
					</li>
				</ul>

			</div>
		</nav>
	</div>
	<nav class="navbar-default navbar-side" role="navigation" style="left: -260px;">
		<div class="sidebar-collapse">
			<ul class="nav" id="main-menu">
				<li><a class="active-menu waves-effect waves-dark" href="#"><i class="fa fa-dashboard"></i> เมนู </a></li>
				<li><a href="score.php" target="_blank" class="waves-effect waves-dark"><i class="fa fa-desktop"></i> กำหนดค่า BP </a></li>
				<li><a href="#" class="waves-effect waves-dark"><i class="fa fa-bar-chart-o"></i> ค่ามาตรฐาน </a></li>
				<li><a href="#" class="waves-effect waves-dark"><i class="fa fa-qrcode"></i> เมนู 2 </a></li>
				<li><a href="#" class="waves-effect waves-dark"><i class="fa fa-table"></i> เมนู 3 </a></li>
				<li><a href="#" class="waves-effect waves-dark"><i class="fa fa-edit"></i> เมนู 4 </a></li>
			</ul>
		</div>
	</nav>

	<script type="text/javascript">
		$(document).ready(function() {
			$('.js-example-basic-single').select2();
			setInterval(function() {
				$.post("config/sql_load.php", {
					spclty: '01'
				}, function(data) {
					data = $.parseJSON(data);
					$("#pop_bp").html(data);
				});
			}, 1000);
		});
	</script>

	<div id="page-wrapper" style="margin-left: 0px;">
		<div class="header">
			<h1 class="page-header"></h1>
		</div>2
		<label for="id_label_single">
			Click this to highlight the single select element

			<select class="js-example-basic-single js-states form-control" id="id_label_single">
				<option value="AL1">Alabama</option>
				<option value="WY1">Wyoming</option>
				<option value="WY2">Wyoming</option>
				<option value="WY3">Wyoming</option>
			</select>
		</label>2
		<div id="pop_bp">
		</div>
	</div>
	</div>
	</div>
	<script src="assets/js/jquery-1.10.2.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/materialize/js/materialize.min.js"></script>
	<script src="assets/js/jquery.metisMenu.js"></script>
	<script src="assets/js/morris/raphael-2.1.0.min.js"></script>
	<script src="assets/js/morris/morris.js"></script>
	<script src="assets/js/easypiechart.js"></script>
	<script src="assets/js/easypiechart-data.js"></script>
	<script src="assets/js/Lightweight-Chart/jquery.chart.js"></script>
	<script src="assets/js/custom-scripts.js"></script>
	<script type="text/javascript">
		window.onload = date_time('date_time');
	</script>

</body>

</html>