<?php include('breadcrumb-h.php');?>

<body>
	<div id="header">
		<div class="row">
			<div id="logo"></div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="span16">
				<h1><?php echo $title; ?> <small>We can't find that!</small></h1>
				<hr>
				<p>The controller generating this page is found at <code>APPPATH/classes/controller/welcome.php</code>.</p>
				<p>This view is located at <code>APPPATH/views/welcome/404.php</code>.</p>
			</div>
		</div>
		<footer>
			<p class="pull-right">Page rendered in {exec_time}s using {mem_usage}mb of memory.</p>
			<p>
				<a href="http://fuelphp.com">FuelPHP</a> is released under the MIT license.<br>
				<small>Version: <?php echo Fuel::VERSION; ?></small>
			</p>
		</footer>
	</div>
</body>
</html>
