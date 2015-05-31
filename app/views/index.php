<!doctype html>
<html ng-app="clientApp" lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin App</title>

	<!-- CSS -->

	<link rel="stylesheet" href="js/vendor/bootstrap.min.css"> 
	<!-- <link rel="stylesheet" href="js/vendor/font-awesome.min.css">  -->


	<!-- <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">  -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
	

	<style>
		body, html { height:100%;}
		#main {padding-bottom: 50px;}
		body 		{ padding-top:30px; }
		form 		{ padding-bottom:20px; }
		.invoice-bg {padding: 20px; border-radius: 10px; border: 1px solid #EBEBEB; margin-top: 20px;}
		.comment 	{ padding-bottom:20px; }
		.modal-backdrop {width:100%; height:100%;}
		/*.modal-dialog {z-index:9999;}*/
		.nav, .pagination, .carousel, .panel-title a { cursor: pointer; }
		/*.invoice, .project {border-bottom: 1px solid silver; padding-bottom: 20px; margin-bottom: 20px;}*/
		.invoice, .project, .task {border-top: 1px solid silver; padding-top: 20px; margin-bottom:20px;}
		.toggle-switch {border: 1px solid silver; cursor: pointer; display: inline-block; text-align: left; overflow: hidden; line-height: 8px; min-width: 100px; } .toggle-switch.disabled > div > span.knob {background: #AAA; } .toggle-switch span {cursor: pointer; display: inline-block; float: left; height: 100%; line-height: 20px; padding: 4px; text-align: center; width: 33%; white-space: nowrap; box-sizing: border-box; -o-box-sizing: border-box; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; } .toggle-switch > div {position: relative; width: 150%; } .toggle-switch .knob {background: red; border-left: 1px solid #ccc; border-right: 1px solid #ccc; background-color: #f5f5f5; width: 34%; z-index: 100; } .toggle-switch .switch-on {left: 0%; } .toggle-switch .switch-off {left: -50% } .toggle-switch .switch-left, .toggle-switch .switch-right {z-index: 1; } .toggle-switch .switch-left {color: #3c763d; background: #dff0d8; } .toggle-switch .switch-right {color: #a94442; background: #f2dede; } .toggle-switch-animate {transition: left 0.5s; -o-transition: left 0.5s; -moz-transition: left 0.5s; -webkit-transition: left 0.5s; } 
	</style>

	<!-- JS -->
	<!--
	<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.8/angular.min.js"></script> 
	<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.8/angular-route.js"></script>
	-->
	<script src="js/vendor/angular.min.js"></script> 
	<script src="js/vendor/angular-route.js"></script>
	<script src="js/vendor/ui-bootstrap-tpls-0.12.1.js"></script>
	<script src="js/vendor/angular-toggle-switch.min.js"></script>

	<!-- ANGULAR -->
	<!-- all angular resources will be loaded from the /public folder -->
	<script src="js/services/apiService.js"></script>
	<script src="js/filters/filters.js"></script>

	<script src="js/controllers/mainCtrl.js"></script> 
	<script src="js/controllers/clientsCtrl.js"></script>
	<script src="js/controllers/clientCtrl.js"></script>
	<script src="js/controllers/projectsCtrl.js"></script>
	<script src="js/controllers/projectCtrl.js"></script>    
	<script src="js/controllers/invoicesCtrl.js"></script> 
	<script src="js/controllers/invoiceCtrl.js"></script> 
	<script src="js/controllers/settingsCtrl.js"></script>

	<script src="js/app.js"></script> <!-- load our application -->

</head>
<!-- declare our angular app and controller -->
<body ng-controller="clientsController">

<header>
 	<nav class="navbar navbar-default">
 	<div class="container">
 		<div class="navbar-header"><a href="/" class="navbar-brand"></a></div>
	 	<ul class="nav navbar-nav navbar-left">
	 		<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
	 		<li><a href="#clients"><i class="fa fa-users"></i> Clients</a></li>
	 		<li><a href="#projects"><i class="fa fa-pencil "></i> Projects</a></li>
	 		<li><a href="#invoices"><i class="fa fa-book "></i> Invoices</a></li>
	 	</ul>
	 	<ul class="nav navbar-nav navbar-right">
	 		<li><a href="#settings"><i class="fa fa-cog"></i> Settings</a></li>
	 	</ul>
 	</div>
 	</nav>
 </header> 

<div id="main">
	<div class="container">
		<div class="row">
			<div class="ng-view"></div>
		</div>
	</div>
</div>


</body>
</html>
