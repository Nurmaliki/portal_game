<div style="
	padding: 30px;
	background-color: rgba(0,0,0, 0.9);
	position: fixed;
	top: 0;left: 0;right: 0;bottom: 0;
	z-index: 9999;
	overflow-y: scroll;
	-webkit-overflow-y: scroll;
	-moz-overflow-y: scroll;
">
	<div style="
		position: fixed;
		top: 0;
		padding: 20px;
		/*box-shadow: 0px 0px 1px rgba(150,150,150,0.2);*/
		background-color: rgba(0,0,0,0.2);
		color: rgb(250,250,250);
		left: 0;
		right: 0;
		display: flex;
	">
	<div style="flex: 1;text-align: left;">RapidDebuger</div>
	<div>	

		<span><?php echo $class . "/" . $method ; ?></span>
	</div>
	</div>
	<div style="height: 60px;"></div>
	<div style="font-family: monospace;font-weight: normal;font-size: 13px;text-align: left;color: rgb(250,250,250);">
		<?php
			if (is_array($message)) {
				if ($class == "RapidDataModel") {
					echo "<pre style='color:rgb(200,200,200);font-size:13px;'>";
					print_r($message);		
					echo "</pre>";
				}else{
					foreach ($message as $key => $value) {	
						$value = str_replace("'", " ", $value);
						echo "<label style='border-bottom:1px solid rgb(230,230,230);margin-left:10px;font-weight:bolder;'>$key</label>";
						echo "<br>";
						echo "<input disabled='true' style='width:98%;margin:10px;padding:10px;margin-top:0;background-color:rgb(0,0,0);border:1px solid rgb(30,30,30);border-radius:5px;;color:rgb(150,150,150);' type='text' value='$value'>";
					}
				}
			}else{
				echo $message;
			}
		?>
	</div>
	<div style="
		position: fixed;
		bottom: 0;
		right: 0;
		background-color: rgb(220,220,220);
		box-shadow: 0px 2px 4px rgba(30,30,30,0.5);
		padding: 10px;
		font-size: 13px;
		border-radius: 3px;
	">
		<span style="font-weight: bolder;">Openrapid</span> by Royan Zain
	</div>
</div>