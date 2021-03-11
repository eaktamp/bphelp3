<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BP Check</title> 
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="assets/materialize/css/materialize.min.css" media="screen,projection" />
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="assets/js/Lightweight-Chart/cssCharts.css"> 
</head>

<body>
	<?php require_once "./function/autoload_fun.php";?>
	
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle waves-effect waves-dark" data-toggle="collapse" data-target=".sidebar-collapse">
                </button>
                <a class="navbar-brand waves-effect waves-dark" href=""><i class="large material-icons">device_thermostat</i> <strong>BP Check</strong></a>
				
		<div id="sideNav" href=""><i class="material-icons dp48">toc</i></div>
            </div>  
        </nav>
	   <!--/. NAV TOP  -->
	   <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li><a class="active-menu waves-effect waves-dark" href="#"><i class="fa fa-dashboard"></i> เมนู</a></li>
                    <li><a href="#" class="waves-effect waves-dark"><i class="fa fa-desktop"></i> เมนู 1</a></li>
					<li><a href="#" class="waves-effect waves-dark"><i class="fa fa-bar-chart-o"></i> เมนู 1</a></li>
                    <li><a href="#" class="waves-effect waves-dark"><i class="fa fa-qrcode"></i> เมนู 1</a></li>
                    <li><a href="#" class="waves-effect waves-dark"><i class="fa fa-table"></i> เมนู 1</a></li>
                    <li><a href="#" class="waves-effect waves-dark"><i class="fa fa-edit"></i> เมนู 1 </a></li>
                </ul>
            </div>
        </nav>
        <!-- /. NAV SIDE  -->
		<div id="page-wrapper">
		  <div class="header"> 
               <h1 class="page-header"></h1> 					
		</div>
            <div id="page-inner">
			<div class="dashboard-cards"> 
                <div class="row">
				<?php 	
				  	$obj = new searchBp();
					 $sql =  $obj->selectAllbp();
					while ($row = pg_fetch_array($sql)) { 
				?>
				
                    <div class="col-xs-12 col-sm-6 col-md-3">
						<div class="card horizontal cardIcon waves-effect waves-dark">
						<div class="card-image red">
						<i class="material-icons dp48">supervisor_account</i>
						</div>
						<div class="card-stacked red">
						<div class="card-content">
						<h3>HN <?php echo $row["hn"];?></h3> 
						</div>
						<div class="card-action">
						<strong><?php echo $row["bps"];?> / <?php echo $row["bpd"];?> </strong>
						</div>
						</div>
						</div>
                    </div>

				<?php }?>
                    <div class="col-xs-12 col-sm-6 col-md-3">
						<div class="card horizontal cardIcon waves-effect waves-dark">
						<div class="card-image orange">
						<i class="material-icons dp48">supervisor_account</i>
						</div>
						<div class="card-stacked orange">
						<div class="card-content">
						<h3>36,540</h3> 
						</div>
						<div class="card-action">
						<strong>SALES</strong>
						</div>
						</div>
						</div> 
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
							<div class="card horizontal cardIcon waves-effect waves-dark">
						<div class="card-image blue">
						<i class="material-icons dp48">supervisor_account</i>
						</div>
						<div class="card-stacked blue">
						<div class="card-content">
						<h3>24,225</h3> 
						</div>
						<div class="card-action">
						<strong>PRODUCTS</strong>
						</div>
						</div>
						</div> 	 
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
					
					<div class="card horizontal cardIcon waves-effect waves-dark">
						<div class="card-image green">
						<i class="material-icons dp48">supervisor_account</i>
						</div>
						<div class="card-stacked green">
						<div class="card-content">
						<h3>88,658</h3> 
						</div>
						<div class="card-action">
						<strong>VISITS</strong>
						</div>
						</div>
						</div>  
                    </div>
                </div>
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
</body>
</html>