
<?php
	include_once('../Access.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Farm Pets</title>
        <meta name="viewport" content="width=device-width, maximum-scale=1, minimum-scale=1, initial-scale=1, user-scalable=no" />
        <meta name="apple-mobile-web-app-capable" content="yes">
        <link rel="apple-touch-icon" href="assets/icon-iphone.png">
        <link rel="apple-touch-icon" sizes="76x76" href="assets/icon-ipad.png">
        <link rel="apple-touch-icon" sizes="120x120" href="assets/icon-iphone-retina.png">
        <link rel="apple-touch-icon" sizes="152x152" href="assets/icon-ipad-retina.png">

        <style>
            body {
                padding:0px;
                margin:0px;
            }
            #game_area {
                position: fixed;
                display: block;
                left:50%;
                top:50%;
            }
            #img_rotate{
                position: fixed;
                display: none;
                left:50%;
                top:50%;
            }
            canvas{
                cursor: pointer;
                width: 100%;
                height: 100%;
            }
        </style>

        <script src="preloadjs-0.4.1.min.js"></script>
        <script src="easeljs-0.7.1.min.js"></script>
        <script src="soundjs-0.5.2.min.js"></script>
        <script src="preloader.min.js"></script>
        <link rel="stylesheet" href="add2home.css">
    </head>
    <body onload="init();">
        <div id="game_area">
            <canvas id="my_canvas" width="640" height="960" oncontextmenu="return false;"></canvas>
        </div>
    </body>
</html>