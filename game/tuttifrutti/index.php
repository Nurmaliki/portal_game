
<?php
	include_once('../Access.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, maximum-scale=1, minimum-scale=1, initial-scale=1, user-scalable=no" />
	<style>
		body {
			padding:0px;
			margin:0px;
		}
		#gameArea {
			position: fixed;
			display: table;
		}
		#imgl2p {
			display: none;
			text-align: center;
			vertical-align: middle;
			width: 100%;
			height: 100%;
		}
		#imgl2p img{
			width: 100%;
		}
		canvas, #bg, #background{
			display: block;
			position:absolute;
			width: 100%;
			height: 100%;
		}
	</style>
	<title>Tutti Frutti</title>
	<meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="apple-touch-icon" href="touch-icon-iphone.png">
    <link rel="apple-touch-icon" sizes="76x76" href="touch-icon-ipad.png">
    <link rel="apple-touch-icon" sizes="120x120" href="touch-icon-iphone-retina.png">
    <link rel="apple-touch-icon" sizes="152x152" href="touch-icon-ipad-retina.png">

	<link rel="stylesheet" type="text/css" href="lib/add2home.css">
	<script type="application/javascript" charset="utf-8" src="lib/add2home.js"></script>
   
	<script type="text/javascript" src="createjs/preloadjsmin.js"></script>
	<script type="text/javascript" src="createjs/easeljsmin.js"></script>
	<script type="text/javascript" src="createjs/tweenjsmin.js"></script>
	<script type="text/javascript" src="createjs/soundjsmin.js"></script>

	<script type="text/javascript" src="Config.js"></script>
	<script type="text/javascript" src="preloader.js"></script>
</head>
<body onload="start()">
<div id="gameArea">
	<div id="imgl2p"><img src="lib/graphics/p2l.jpg"></div>
	<div id="background" style="-moz-user-select: none; -khtml-user-select: none; -webkit-user-select: none; user-select: none;"></div>
	<canvas id="gameField" oncontextmenu="return false;"></canvas>
</div>
</body>
</html>