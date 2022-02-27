<?php
	include_once('../Access.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, maximum-scale=1, minimum-scale=1, initial-scale=1, user-scalable=no"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="apple-touch-icon" href="assets/touch-icon-iphone.png">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/touch-icon-ipad.png">
    <link rel="apple-touch-icon" sizes="120x120" href="assets/touch-icon-iphone-retina.png">
    <link rel="apple-touch-icon" sizes="152x152" href="assets/touch-icon-ipad-retina.png">

    <title>Fruit Chef</title>
    <style>
        body {
            padding:0px;
            margin:0px;
        }
        #gameArea {
            display: block;
            position: fixed;
            padding:0px;
            margin:0px;
            left: 50%;
            -moz-user-select: none;
            -khtml-user-select: none;
            -webkit-user-select: none;
            user-select: none;
        }
        #imgl2p{
            display: none;
            position : absolute;
            left:50%;
            top:50%;
            z-index: 5;
        }
        #canvas_game {
            position: absolute;
            top: 0px;
            left: 0px;
            z-index: 1;
        }
        #canvas_life {
            position: absolute;
            top: 0px;
            left: 50%;
            margin-left: -96px;
            z-index: 3;
        }
        #canvas_special {
            position: absolute;
            top: 0px;
            left: 50%;
            margin-left: -396px;
            z-index: 3;
        }
        #canvas_score {
            position: absolute;
            top: 0px;
            left: 100%;
            margin-left: -228px;
            z-index: 2;
        }
        #canvas_cout {
            position: absolute;
            top: 0px;
            left: 0px;
            margin-left: 0px;
            z-index: 2;
        }
    </style>

    <script src="easeljs-0.7.1.min.js"></script>
    <script src="preloadjs-0.4.0.min.js"></script>
    <script src="soundjs-0.5.2.min.js"></script>    
    <link rel="stylesheet" href="add2home.css">
    <script charset="UTF-8" src="fc-min.js"></script>
</head>
<body onload="init_game();" style="background-color:#04464a">
    <div id="fb-root"></div>
        <div id="gameArea">
            <canvas id="canvas_game" width="792" height="920" oncontextmenu="return false;"></canvas>
            <canvas id="canvas_special" width="792" height="128" oncontextmenu="return false;"></canvas>
            <canvas id="canvas_life" width="186" height="82" oncontextmenu="return false;"></canvas>
            <canvas id="canvas_score" width="224" height="74" oncontextmenu="return false;"></canvas>
            <canvas id="canvas_cout" width="328" height="104" oncontextmenu="return false;"></canvas>
        </div>
    </body>
</html>