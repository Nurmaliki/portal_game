<?php
	include_once('../Access.php');
?>
<!DOCTYPE html>
<html>

<head>

	<title>Slot Machine</title>

	<meta http-equiv="Content-Type" content="text/html, charset=utf-8" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-touch-fullscreen" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />

	
	<script type="text/javascript">
		
		
		var START_COINS = 1000;
		var MAX_BET = 3;
		var MIN_COEF = 1;
		var MAX_COEF = 5;
		
		var CWR = 0.25;
		
		/*
		Possible modes (only for mobile devices):
			full - all sounds
			results - only results sounds
			disabled - no sounds
		*/
		var SOUNDS_MODE = "results";
	</script>
	<script type="text/javascript" src="game.js"></script>
</head>

<body style="margin: 0px; padding: 0px;">
	
	<div id="main_container"></div>
	
	<!--
	<div align="center">
		<div><b>Slot Machine</b></div>
		
		<table border="1">
			<tr>
				<td id="result1">4x <img src="images/1/fruits/1.png" align="absmiddle" /> 500</td>
				<td id="result4">4x <img src="images/1/fruits/4.png" align="absmiddle" /> 70</td>
				<td id="result7">4x <img src="images/1/fruits/7.png" align="absmiddle" /> 20</td>
			</tr>
			<tr>
				<td id="result2">4x <img src="images/1/fruits/2.png" align="absmiddle" /> 300</td>
				<td id="result5">4x <img src="images/1/fruits/5.png" align="absmiddle" /> 50</td>
				<td id="result8">4x <img src="images/1/fruits/8.png" align="absmiddle" /> 10</td>
			</tr>
			<tr>
				<td id="result3">4x <img src="images/1/fruits/3.png" align="absmiddle" /> 100</td>
				<td id="result6">4x <img src="images/1/fruits/6.png" align="absmiddle" /> 25</td>
				<td id="result9">4x <img src="images/1/fruits/9.png" align="absmiddle" /> 5</td>
			</tr>
		</table>
		<hr>
		<div id="result_text">&nbsp;</div>
		<hr>
		<table>
			<tr>
				<td align="center">
					<button onclick="changeCoef(1)">+</button><br>
					<div id="coef">1</div>
					<button onclick="changeCoef(-1)">-</button>
				</td>
				
				<td>
					<table border="1">
						<tr>
							<td id="slot_back0"><img src="" id="slot0" /></td>
							<td id="slot_back1"><img src="" id="slot1" /></td>
							<td id="slot_back2"><img src="" id="slot2" /></td>
							<td id="slot_back3"><img src="" id="slot3" /></td>
						</tr>
						
						<tr>
							<td><button id="hold0" onclick="hold(0)">HOLD</button></td>
							<td><button id="hold1" onclick="hold(1)">HOLD</button></td>
							<td><button id="hold2" onclick="hold(2)">HOLD</button></td>
							<td><button id="hold3" onclick="hold(3)">HOLD</button></td>
						</tr>
					</table>
				</td>
				
				<td align="center">
					<button onclick="pay(5)">5</button>
					<button onclick="pay(10)">10</button>
					<button onclick="pay(25)">25</button>
					<br>
					<button onclick="pay(100)">100</button>
					<button onclick="pay(200)">200</button>
					<br>
					
					<table>
					<tr><td><b>Credits: </b></td><td><span id="credits">0</span></td></tr>
					<tr><td><b>Winner played: </b></td><td><span id="wplayed">0</span><br></td></tr>
					<tr><td><b>Coins played: </b></td><td><span id="cplayed">0</span><br></td></tr>
					</table>
				</td>
			</tr>
		</table>
		
		<table><tr>
			<td align="left">
				<button onclick="cashOut()">Cash Out</button>
				<b>Current balance</b>:
				<span id="balance">0</span>
			</td>
			<td align="right">
				<button onclick="betOne()">Bet One</button>
				<button onclick="playMax()">Play Max</button>
				<button onclick="spinReels()">Spin Reels</button>
			</td>
		</tr></table>
	</div>
	
	<div id="wheel" style="display: none; position: absolute; left: 0px; top: 0px; width: 100%; height: 100%; background: #aaa;" align="center">
		<b>WHEEL</b>
		<div id="wheel_result">???</div>
		<button onclick="turnWheel()">TURN!</button>
	</div>
	
	-->
	
</body>

</html>