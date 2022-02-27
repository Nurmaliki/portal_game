<?php
	include_once('../Access.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, maximum-scale=1, minimum-scale=1, initial-scale=1, user-scalable=no" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="apple-touch-icon" href="assets/touch-icon-iphone.png">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/touch-icon-ipad.png">
    <link rel="apple-touch-icon" sizes="120x120" href="assets/touch-icon-iphone-retina.png">
    <link rel="apple-touch-icon" sizes="152x152" href="assets/touch-icon-ipad-retina.png">
    
    <style>
        body {
            padding:0px;
            margin:0px;
        }
        #gameArea {
            position: fixed;
            display: block;
            left:50%;
            top:50%;
        }
        #imgl2p{
            position: fixed;
            display: none;
            left:50%;
            top:50%;
        }
        canvas{
            cursor: pointer;
            display: block;
            width: 100%;
            height: 100%;
        }
    </style>
    <script src="preloadjs-0.4.1.min.js"></script>
    <script src="easeljs-0.7.1.min.js"></script>
    <script src="soundjs-0.5.2.min.js"></script>

    <script type="text/javascript" src="Config.js"></script>
    <script type="text/javascript" src="game.min.js"></script>
    <link rel="stylesheet" href="add2home.css">
    <script type="application/javascript" src="add2home.js" charset="utf-8"></script>
</head>
<body onload="init();">
<div id="gameArea">
    <canvas id="myCanvas" width="640" height="960" oncontextmenu="return false;"></canvas>
</div>
</body>
</html>