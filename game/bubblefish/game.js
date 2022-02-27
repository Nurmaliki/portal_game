var stage;
var world;
var GET;
var LANDSCAPE_MODE = true;
var bitmaps;
var width = 480;
var height = 320;
var fps = 50;
var gameState = 0;
var STATE_GAME = 1;
var STATE_MENU = 2;
var STATE_SELECT_LEVEL = 3;
var STATE_GAME_LOGO = 4;
var STATE_ABOUT = 5;
var STATE_SPLASH = 6;
var STATE_GAME_OVER = 7;
var STATE_VICTORY = 8;
var STATE_DESCRIPTION = 9;
var STATE_BEST_SCORES = 10;
var field;
var pause = false;
var animationPlaying = false;
var screenWidthCoef;
var screenHeightCoef;

var arrow;
var cX;
var currentLevel;

window.onload = function () {
	GET = Utils.parseGet();
	Utils.addMobileListeners(LANDSCAPE_MODE);
	Utils.mobileCorrectPixelRatio();
	Utils.addFitLayoutListeners();
	//ADManager.init();
	setTimeout(startLoad, 600);
}

function startLoad() {
	var resolution = Utils.getMobileScreenResolution(LANDSCAPE_MODE);
	if (GET["debug"] == 1) resolution = Utils.getScaleScreenResolution(1, LANDSCAPE_MODE);
	Utils.globalScale = resolution.scale;
	
	// Определение коэфициента ширины для нестандартных экранов
	var ratioCoefs = [1.5, 1.6, 1.66, 1.7, 1.78, 1.33, 1.52];
	var ratioWidth = [1, 1.0666, 1.106, 1.133, 1.187, 0.9667,1.016, /*1.0666*/];
	var ratioHeight = [1, 1, 1, 1, 1, 1.2, 1/*1.05*/];

	if(window.innerWidth > window.innerHeight) var coef = window.innerWidth/window.innerHeight;
	else var coef = window.innerHeight/window.innerWidth;
		
	var min = 100000, minPos = -1, diff;
	for(var i=0; i<ratioCoefs.length-1; i++) {
		diff = Math.abs(coef - ratioCoefs[i]);
		if(diff < min)
		{
			min = diff;
			minPos = i;
		}
	}

	if (window.innerHeight == 768) {
		minPos = 5;
	}
	else if (window.innerHeight == 672)
	{
		minPos = 6;
	}	
	
	screenWidthCoef = ratioWidth[minPos];
	screenHeightCoef = ratioHeight[minPos];
	screenWidthRatioPos = (minPos == 6) ? 0: minPos;
	resolution.width = Math.round(resolution.width*screenWidthCoef);	
	resolution.height = Math.round(resolution.height*screenHeightCoef);	
	
	Utils.createLayout(document.getElementById("main_container"), resolution);
	Utils.addEventListener("fitlayout", function() {
		if (stage) {
			stage.drawScene(document.getElementById("screen"));
			buildBackground();
		}
	});
	Utils.addEventListener("lockscreen", function()	{ if (stage && stage.started) stage.stop(); });
	Utils.addEventListener("unlockscreen", function() { if (stage && !stage.started) stage.start(); });
	
	Utils.mobileHideAddressBar();
	
	if (GET["debug"] != 1) Utils.checkOrientation(LANDSCAPE_MODE);

	mixer = new AudioMixer("music", 1);
	
	var preloader = new ImagesPreloader();
	var data = [];
	var path = Utils.imagesRoot + "/" + Utils.globalScale + "/";
	
	data.push({name: "bubble", src: path + "bubble.png"});
	data.push({name: "gun", src: path + "gun.png"});
	data.push({name: "gun2", src: path + "gun2.png"});
	data.push({name: 'arrow', src: path + 'arrow.png'});	
	data.push({name: 'arrow_small', src: path + 'arrow_small.png'});	
	data.push({name: 'b1', src: path + 'b1.png'});	
	data.push({name: 'b2', src: path + 'b2.png'});	
	data.push({name: 'b3', src: path + 'b3.png'});	
	data.push({name: 'b4', src: path + 'b4.png'});	
	data.push({name: 'b5', src: path + 'b5.png'});	
	data.push({name: 'b6', src: path + 'b6.png'});	
	data.push({name: 'b7', src: path + 'b7.png'});	
	data.push({name: 'b8', src: path + 'b8.png'});		
	data.push({name: 'b9', src: path + 'b9.png'});	
	data.push({name: 'b10', src: path + 'b10.png'});	
	data.push({name: 'b11', src: path + 'b11.png'});	
	data.push({name: 'b12', src: path + 'b12.png'});	
	data.push({name: 'b13', src: path + 'b13.png'});	
	data.push({name: 'b14', src: path + 'b14.png'});	
	data.push({name: 'b15', src: path + 'b15.png'});		
	
	data.push({name: 'boss1', src: path + 'boss1.png'});
	data.push({name: 'boss2', src: path + 'boss2.png'});
	data.push({name: 'boss3', src: path + 'boss3.png'});
	data.push({name: 'boss4', src: path + 'boss4.png'});
	data.push({name: 'boss5', src: path + 'boss5.png'});
	data.push({name: 'boss6', src: path + 'boss6.png'});
	data.push({name: 'boss7', src: path + 'boss7.png'});
	data.push({name: 'boss8', src: path + 'boss8.png'});
	
	data.push({name: 'small1', src: path + 'small1.png'});
	data.push({name: 'small2', src: path + 'small2.png'});
	data.push({name: 'small3', src: path + 'small3.png'});
	data.push({name: 'small4', src: path + 'small4.png'});
	data.push({name: 'small5', src: path + 'small5.png'});
	data.push({name: 'small6', src: path + 'small6.png'});
	data.push({name: 'small7', src: path + 'small7.png'});
	data.push({name: 'small8', src: path + 'small8.png'});
	
	data.push({name: 'orange_numbers', src: path + 'orange_numbers.png'});
	data.push({name: 'white_numbers', src: path + 'white_numbers.png'});
	data.push({name: 'score_numbers', src: path + 'score_numbers.png'});
	
	data.push({name: 'x', src: path + 'x.png'});
	data.push({name: 'percent', src: path + 'percent.png'});
	data.push({name: 'dots', src: path + 'dots.png'});
	data.push({name: 'equals', src: path + 'equals.png'});
	data.push({name: 'coma', src: path + 'coma.png'});
	
	data.push({name: 'minus100', src: path + 'minus100.png'});
	
	data.push({name: 'Bomb', src: path + 'Bomb.png'});	
	data.push({name: 'Clock', src: path + 'Clock.png'});	
	data.push({name: 'Missile', src: path + 'Missile.png'});	
	data.push({name: 'Rocket', src: path + 'Rocket.png'});
	data.push({name: 'explosion', src: path + 'explosion.png'});
	data.push({name: 'explosion_big', src: path + 'explosion_big.png'});
	data.push({name: 'font1', src: path + 'font1.png'});
	data.push({name: 'plus', src: path + 'plus.png'});
	data.push({name: 'play', src: path + 'play.png'});
	data.push({name: 'play_win', src: path + 'play_win.png'});
	data.push({name: 'about_btn', src: path + 'about_btn.png'});
	data.push({name: 'pause_btn', src: path + 'pause_btn.png'});
	data.push({name: 'sound_pause', src: path + 'sound_pause.png'});
	data.push({name: 'about', src: path + 'about.jpg'});
	data.push({name: 'sound', src: path + 'sound.png'});
	data.push({name: 'back', src: path + 'back.png'});
	data.push({name: 'back_s', src: path + 'back_s.png'});
	data.push({name: 'frwd', src: path + 'frwd.png'});
	data.push({name: 'corner', src: path + 'corner.png'});
	data.push({name: 'line_left', src: path + 'line_left.png'});
	data.push({name: 'line_right', src: path + 'line_right.png'});
	data.push({name: 'waterLevel', src: path + 'waterLevel.png'});
	data.push({name: 'conveyor_layer', src: path + 'conveyor_layer.png'});
	data.push({name: 'waterTop', src: path + 'waterTop.png'});
	data.push({name: 'lock', src: path + 'lock.png'});
	data.push({name: 'lock_s', src: path + 'lock_s.png'});
	data.push({name: 'star', src: path + 'star.png'});
	data.push({name: 'star_empty', src: path + 'star_empty.png'});
	data.push({name: 'back_btn', src: path + 'back_btn.png'});
	data.push({name: 'lvl_select', src: path + 'lvl_select.png'});
	data.push({name: 'replay', src: path + 'replay.png'});
	data.push({name: 'cart', src: path + 'cart.png'});
	data.push({name: 'best_scores', src: path + 'best_scores.png'});
	data.push({name: 'sl_icon1', src: path + 'sl_icon1.png'});
	data.push({name: 'sl_icon2', src: path + 'sl_icon2.png'});
	data.push({name: 'sl_icon3', src: path + 'sl_icon3.png'});
	data.push({name: 'sl_icon4', src: path + 'sl_icon4.png'});
	data.push({name: 'fishbone', src: path + 'fishbone.png'});
	
	data.push({name: 'BubbleFish_Menu', src: path + "ratios/" + screenWidthRatioPos + '/BubbleFish-Menu.jpg'});	
	data.push({name: 'Bubble-Fish-Levels-1', src: path + "ratios/" + screenWidthRatioPos + '/Bubble-Fish-Levels-1.png'});	
	data.push({name: 'Bubble-Fish-Levels-2', src: path + "ratios/" + screenWidthRatioPos + '/Bubble-Fish-Levels-2.png'});	
	data.push({name: 'Bubble-Fish-Levels-3', src: path + "ratios/" + screenWidthRatioPos + '/Bubble-Fish-Levels-3.png'});	
	data.push({name: 'Bubble-Fish-Levels-4', src: path + "ratios/" + screenWidthRatioPos + '/Bubble-Fish-Levels-4.png'});	
	data.push({name: 'pause_back', src: path + "ratios/" + screenWidthRatioPos + '/Bubble-Fish-Pause.png'});	
	data.push({name: 'levelCleared', src: path + "ratios/" + screenWidthRatioPos + '/Bubble-Fish-LevelCleared.png'});	
	data.push({name: 'gameOver', src: path + "ratios/" + screenWidthRatioPos + '/Bubble-Fish-GameOver.png'});	
	data.push({name: 'gameBack', src: path + "ratios/" + screenWidthRatioPos + '/BubbleFish.jpg'});	
	data.push({name: 'shop', src: path + "ratios/" + screenWidthRatioPos + '/shop.jpg'});	
	data.push({name: 'Description-1', src: path + "ratios/" + screenWidthRatioPos + '/Description-1.jpg'});	
	data.push({name: 'Description-2', src: path + "ratios/" + screenWidthRatioPos + '/Description-2.jpg'});	
	data.push({name: 'Best-score', src: path + "ratios/" + screenWidthRatioPos + '/Best-score.jpg'});	
	
	/*ADManager.show("loader");
	TweensoftLoader.create(loadImagesEnd, false);
	preloader.load(data, TweensoftLoader.loadComplete, TweensoftLoader.showLoadProgress);*/
	preloader.load(data, loadImagesEnd, Utils.showLoadProgress);
}

function loadImagesEnd(data) {
	document.getElementById('progress_container').style.display = 'none';
	document.getElementById('screen_container').style.display = 'block';
	document.getElementById('screen_background_container').style.display = 'block';
	
	bitmaps = data;
	
	//ADManager.show("splash");
	if(GET["debug"] != 1) {
		showSplash();
	}
	
}

function showSplash() {
	gameState = STATE_SPLASH;
	createScene();
}

function getStageWidth() {return Math.floor(480 * screenWidthCoef);}
function getStageHeight() {return Math.floor(320 * screenHeightCoef);}
function getStageCenter() {return getStageWidth()/2;}
function getStageHeightCenter() {return getStageHeight()/2;}

function createScene() {	
	createStage();

	if (gameState == STATE_SPLASH) {
		setBackColor("#fee002");
		
		mc = new Sprite(bitmaps.splash_back, 480, getStageHeight());
		mc.x = getStageCenter(); mc.y = getStageHeightCenter();
		mc.static = true;
		stage.addChild(mc);
		
		stage.setTimeout(function(){
			gameState = STATE_MENU;
			createScene();
		}, 10);
	}

	if (gameState == STATE_GAME) {
		setBackColor("#311F75");
		field = new GameField();
		field.init();	
		//ADManager.show("game");		
	}

	if (gameState == STATE_GAME_LOGO) {
		setBackColor("#4DDEFF");
		showGameLogo();
	}
	
	if (gameState == STATE_MENU) {
		setBackColor("#04BEF4");
		showMenu();
		//ADManager.show("menu");
	}
	
	if (gameState == STATE_SELECT_LEVEL) {
		setBackColor("#FF61C4");
		showLevelSelect(1);
	}
	
	if (gameState == STATE_ABOUT) {
		setBackColor("#fee002");

		mc = new Sprite(bitmaps.about, 480, getStageHeight());
		mc.x = getStageCenter(); mc.y = getStageHeightCenter();
		mc.static = true;
		mc.onclick = function() {
			gameState = STATE_MENU;
			createScene();		
		}
		stage.addChild(mc);		
	}
	
	if (gameState == STATE_GAME_OVER) {
		setBackColor("#1CC9FF");
		showGameOver();
	}	
	
	if (gameState == STATE_VICTORY) {
		setBackColor("#1CC9FF");
		showWinScreen();
	}	
	
	if (gameState == STATE_BEST_SCORES) {
		showBestScores();
	}
	
	buildBackground();
	stage.start();	
}

function createStage() {
	if (stage) {
		stage.destroy();
		stage.stop();
	}
	stage = new Stage('screen', Math.round(480*screenWidthCoef), Math.round(320*screenHeightCoef));
	stage.delay = 1000/fps;
	stage.showFPS = false;
	stage.onposttick = mainLoop;
	stage.pixelMouseDownEvent = true;
}

function showBestScores() {
	var background = new Sprite(bitmaps['Best-score'], getStageWidth(), getStageHeight());
	background.x = getStageCenter();
	background.y = getStageHeightCenter();
	background.static = true;
	stage.addChild(background);		
	
	var back = new Sprite(bitmaps.back_btn, 73, 73);
	back.setPosition(40, getStageHeight() - 40);
	back.onmouseup = function() {
		gameState = STATE_MENU;
		createScene();		
		return false;
	}
	stage.addChild(back);	
	
	showNumbers(Utils.getCookie('maxLevelUnlocked'), getStageCenter() + 90, 
		getStageHeightCenter() + 47);
		
	showNumbers(Utils.getCookie('total_score'), getStageCenter() + 120, 
		getStageHeightCenter() + 85);

}

function debugFunc() {
	
	var arr = field.levelArray;
	
	console.log(arr);
	
	for (var i = 0; i < arr.length; i++) {
		for (var j = 0; j < arr[i].length; j++) {
			
			if (arr[i][j] != 0) {
				var obj = getLocation(j,i);
				var spr = new Sprite(null, 36, 33);
				spr.setPosition(obj.x, obj.y);
				spr.fillColor = '#FFFFFF';
				stage.addChild(spr);
			
			}
		}
	}
}

function getElementByLocation(x,y) {
	for (var i = 0, j = stage.objects.length; i < j; i++) {
		var obj = stage.objects[i];
		if (obj.m_x == x && obj.m_y == y) return obj;
	}
}

function showDescription(n) {
	var background = new Sprite(bitmaps['Description-' + n], getStageWidth(), getStageHeight());
	background.x = getStageCenter();
	background.y = getStageHeightCenter();
	background.onmouseup = function() {
		if (n == 1) {
			createScene();
			showDescription(2);
		} else {
			gameState = STATE_SELECT_LEVEL;
			createScene();
		}
		return false;
	}	
	stage.addChild(background);	
	
	if (n > 1) {
		var back = new Sprite(bitmaps.back, 50, 49);
		back.setPosition(30, getStageHeight() - 30);
		back.onmouseup = function() {
			createScene();
			showDescription(1);			
			return false;
		}
		stage.addChild(back);	
	}
	
	var frwd = new Sprite(bitmaps.frwd, 50, 49);
	frwd.setPosition(getStageWidth() - 30, getStageHeight() - 30);
	frwd.onmouseup = function() {
		if (n == 1) {
			createScene();
			showDescription(2);
		} else {
			gameState = STATE_SELECT_LEVEL;
			createScene();
		}
		return false;
	}
	stage.addChild(frwd);
}

function showMenu() {
	var background = new Sprite(bitmaps.BubbleFish_Menu, getStageWidth(), getStageHeight());
	background.x = getStageCenter();
	background.y = getStageHeightCenter();
	background.static = true;
	stage.addChild(background);
	
	var playButton = new Sprite(bitmaps.play, 115, 114);
	playButton.x = getStageCenter();
	playButton.y = getStageHeightCenter() + 85;
	playButton.static = true;
	playButton.onmouseup = function() {
		gameState = STATE_DESCRIPTION;
		createScene();
		showDescription(1);
		return false;
	}
	stage.addChild(playButton);	
	
	var moreButton = new Sprite(bitmaps.more_games, 63, 62);
	moreButton.x = getStageCenter() - 110;
	moreButton.y = playButton.y + 40;
	moreButton.onclick = showMoreGames;
	moreButton.static = true;
	stage.addChild(moreButton);	

	var aboutButton = new Sprite(bitmaps.about_btn, 63, 63);
	aboutButton.x = getStageCenter() + 140;
	aboutButton.y = getStageHeight() - 70;
	aboutButton.static = true;
	aboutButton.onclick = function() {
		gameState = STATE_ABOUT;
		createScene();
	}
	stage.addChild(aboutButton);	
	
	var bestScores = new Sprite(bitmaps.best_scores, 63, 63);
	bestScores.x = getStageCenter() + 210;
	bestScores.y = getStageHeight() - 70;
	bestScores.static = true;
	bestScores.onclick = function() {
		gameState = STATE_BEST_SCORES;
		createScene();
	}
	stage.addChild(bestScores);
	
	// Добавляем звук и иконку звука
	if (Utils.getCookie('soundOn') != 1) {
		mixer.play('main_theme', true, false, 0);
	}
	addSoundIcon();
}

function showLevelSelect(n) {
	var background = new Sprite(bitmaps["Bubble-Fish-Levels-" + n], 
		getStageWidth(), getStageHeight());
	background.x = getStageCenter();
	background.y = getStageHeightCenter();
	background.static = true;
	stage.addChild(background);

	if (Utils.getCookie('maxLevelUnlocked') == undefined) {
		Utils.setCookie('maxLevelUnlocked', 1);
	}
	
	var j;
	for (var i = 15 * (n - 1); i < (15 * n); i++) {
		if ((i >= 0 && i < 5) || (i >= 15 && i <= 19) 
			|| (i >= 30 && i <= 34) || (i >= 45 && i <= 49)) {
			if (i < 5) j = getXLevelPosition(i);
			if (i >= 15 && i <= 19) j = getXLevelPosition(i - 15);
			if (i >= 30 && i <= 34) j = getXLevelPosition(i - 30);
			if (i >= 45 && i <= 49) j = getXLevelPosition(i - 45);
			addTextAndSprite(j, getStageHeightCenter() - 75, i, n);
		} else
		if ((i >= 5 && i < 10) || (i > 19 && i <= 24) 
			|| (i > 34 && i <= 39) || (i >= 49 && i <= 54)) {
			if (i < 10) j = getXLevelPosition(i);
			if (i > 19 && i <= 24) j = getXLevelPosition(i - 15);
			if (i > 34 && i <= 39) j = getXLevelPosition(i - 30);
			if (i >= 49 && i <= 54) j = getXLevelPosition(i - 45);
			addTextAndSprite(j, getStageHeightCenter() + 15, i, n);
		} else
		if ((i >= 10 && i <= 15) || (i > 24 && i <= 29) 
			|| (i > 39 && i <= 44) || (i > 54 && i <= 59)) {
			if (i < 15) j = getXLevelPosition(i);
			if (i > 24 && i <= 29) j = getXLevelPosition(i - 15);
			if (i > 39 && i <= 44) j = getXLevelPosition(i - 30);
			if (i > 54 && i <= 59) j = getXLevelPosition(i - 45);
			addTextAndSprite(j, getStageHeightCenter() + 102, i, n);
		}
	}
		
	var back_menu = new Sprite(bitmaps.back, 50, 49);
	back_menu.x = 30;
	back_menu.y = 30;
	back_menu.static = true;
	back_menu.onclick = function() {
		if (n == 1) {
			gameState = STATE_MENU;
			createScene();			
		} else if (n == 2) {
			createStage();
			setBackColor("#FF61C4");
			showLevelSelect(1);
			buildBackground();
			stage.start();	
		} else if (n == 3) {
			createStage();
			setBackColor("#17CBFF");
			showLevelSelect(2);
			buildBackground();
			stage.start();	
		} else if (n == 4) {
			createStage();
			setBackColor("#60CC33");
			showLevelSelect(3);
			buildBackground();
			stage.start();	
		}
	}
	stage.addChild(back_menu);
	
	if (n != 4) {
		var next = new Sprite(bitmaps.frwd, 50, 49);
		next.x = getStageWidth() - 30;
		next.y = 30;
		next.static = true;
		next.onclick = function() {
			if (n == 1) {
				createStage();
				setBackColor("#17CBFF");
				showLevelSelect(2);
				buildBackground();
				stage.start();	
			} else if (n == 2) {
				createStage();
				setBackColor("#60CC33");
				showLevelSelect(3);
				buildBackground();
				stage.start();	
			} else if (n == 3) {
				createStage();
				setBackColor("#FF7C34");
				showLevelSelect(4);
				buildBackground();
				stage.start();	
			}
		}
		stage.addChild(next);
	}
	
	var total_score;
	if (Utils.getCookie("total_score") == undefined) {
		Utils.setCookie("total_score", 0);
		total_score = 0;
	} else {
		total_score = Utils.getCookie("total_score");
	}
	
	showNumbers(total_score, getStageCenter() + 140, getStageHeightCenter() - 138);
}

// Установка номера и обработки выбора уровней
function addTextAndSprite(x, y, i, n) {
	var l_u = Utils.getCookie('maxLevelUnlocked');

	var x_param, y_param;
	switch (n) {
		case 1:
			x_param = 53;
			y_param = 53;
			break;		
			
		case 2:
			x_param = 51;
			y_param = 47;
			break;		
		
		case 3:
			x_param = 42;
			y_param = 52;
			break;		
		
		case 4:
			x_param = 39;
			y_param = 55;
			break;
			
		default:
			console.log('unknown parameter');
			break;
	}
	
	var image = new Sprite(bitmaps['sl_icon' + n], x_param, y_param);
	image.x = (n > 1) ? x - 20 + 3: x - 20;
	image.y = y;
	image.index = i + 1;	
	image.static = true;
	if (image.index <= l_u) {
		image.onmouseup = function(e) {
			currentLevel = e.target.index;
			gameState = STATE_GAME;
			createScene();
			return false;
		}
	} else {
		image.opacity = 0.5;
	}
	stage.addChild(image);
	
	// Установка знаков открытия уровней
	if (l_u < image.index) {
		var lock = new Sprite(bitmaps.lock, 16, 19);
		lock.x = x + 3;
		lock.y = y - 25;
		lock.static = true;
		stage.addChild(lock);	
	}
	
	// Установка "звездочек уровню"
	var stars = Utils.getCookie('starsOn_' + image.index);
	stars = (stars == undefined) ? 0: stars;
	
	var star1 = (stars > 0) ? new Sprite(bitmaps.star, 18, 18) :
		new Sprite(bitmaps.star_empty, 18, 18);
	star1.setPosition(x - 40, y + 35);
	star1.static = true;
	stage.addChild(star1);

	var star2 = (stars > 1) ? new Sprite(bitmaps.star, 18, 18) :
		new Sprite(bitmaps.star_empty, 18, 18);
	star2.setPosition(x - 20, y + 35);
	star2.static = true;
	stage.addChild(star2);
	
	var star3 = (stars > 2) ? new Sprite(bitmaps.star, 18, 18) :
		new Sprite(bitmaps.star_empty, 18, 18);
	star3.setPosition(x, y + 35);
	star3.static = true;
	stage.addChild(star3);
	
}

function getXLevelPosition(i) {
	var n = [
		17,114,210,307,407,
		17,114,210,307,407,
		17,114,210,307,407,
		17,114,210,307,407,
		17,114,210,307,407,
		17,114,210,307,407,
		17,114,210,307,407,
		17,114,210,307,407,
		17,114,210,307,407,
	];
	return n[i] + getStageCenter() - 190;
}

function addSoundIcon(x,y) {
	var sound = new Sprite(bitmaps.sound, 57, 46, 2);
	sound.x = (x == undefined) ? 30: x;
	sound.y = (y == undefined) ? getStageHeightCenter() + 45: y;
	if (Utils.getCookie('soundOn') == 1) sound.gotoAndStop(1);
	else sound.gotoAndStop(0);
	sound.state = 1;
	sound.onclick = function() {
		if (Utils.getCookie('soundOn') == 1) {
			sound.gotoAndStop(0);
			mixer.play('main_theme', true, false, 0);
			Utils.setCookie('soundOn', 0);
		} else {
			sound.gotoAndStop(1);
			mixer.stop(0);
			Utils.setCookie('soundOn', 1);
		}
	}
	stage.addChild(sound);
	return sound;
}

function hitTestRound(obj1, obj2) {
	if (obj1.isFish) {	
		var i = ((getDistance(obj1, obj2)) <= 18) ? true: false;
		return i;
	} 	
	if (obj1.isSmall) {	
		var i = ((getDistance(obj1, obj2)) <= 24) ? true: false;
		return i;
	} else if (obj1.isBoss) {
		var i = ((getDistance(obj1, obj2)) <= 40) ? true: false;
		return i;
	}
}

function processLevelTime() {
	if (field.timer == 60) {
		field.timer = 0;
		field.roundTime -= 1;
		field.showTime();
		if (field.roundTime < 0) {
			gameState = STATE_GAME_OVER;
			createScene();
			return;
		}
		else if (field.roundTime < levelsTime[currentLevel - 1]){

			// Изменение уровня воды
			var w = field.waterLevel;
			var s = field.shift;
			w.height -= s;
			w.offset.top += s;
			w.y += s/2;	

			field.waterTop.y += s;		
		}
	} else {
		field.timer++;
	}
}

function mainLoop() {
	if (gameState != STATE_GAME) return;
	if (pause) return false;
	
	// Отображение времени
	processLevelTime();
		
	if (!field.bubbleLaunched) return;
	
	// Проверка на столкновение с другими рыбками
	for (var i = 0, j = stage.objects.length; i < j; i++) {
		var obj = stage.objects[i];
		if (!obj.isFish && !obj.isBoss) continue;
		
		// Получение "будущих" точек спрайта
		var x_shift = field.nextBubble.x - field.oldLocation.x;
		var y_shift = field.nextBubble.y - field.oldLocation.y;
		var futurePoint = {x: field.nextBubble.x + /*1.5*/2 * x_shift, 
			y: field.nextBubble.y + /*1.5*/2 * y_shift};
		
		// Проверка расстояния между снарядом и другими рыбками
		if (hitTestRound(obj, futurePoint)) {
			
			// Удар по боссу
			if (obj.isBoss && obj.type == field.nextBubble.type) {
				processHitBoss(obj);
				field.processNextBubble();
				return;
			}
			
			switch(field.nextBubble.type) {
				case 'Missile':
					detonateMissile(obj);
					break;

				case 'Bomb':
					detonateBomb(obj);
					break;

				case 'Rocket':
					detonateRocket(obj);
					break;

				default:
					field.moveToClosestFish(obj);
			}
			return;
		}
	}
	
	// Проверка на столкновение со стенками
	processWallHit();
	
	// Удаление текущего снаряда, если он выходит "за рамки"
	if (field.nextBubble.x > 800 || field.nextBubble.x < -100 
		|| field.nextBubble.y > 500 || field.nextBubble.y < -50) {
			field.processNextBubble();
	}
	
	// Запись "старого" расположения
	field.oldLocation.x = field.nextBubble.x;	
	field.oldLocation.y = field.nextBubble.y;	
}

function showSceletton(x,y) {
	var s = new Sprite(bitmaps.fishbone, 31, 25);
	s.setPosition(x, y);
	stage.addChild(s);
	
	var t = stage.setTimeout(function() {
		s.destroy = true;
	}, fps - 10);
}

function processWallHit() {
	for (var i = 0, j = field.wallsArray.length; i < j; i++) {
		if (!stage.hitTest(field.nextBubble, field.wallsArray[i])) continue;
		var bub = field.nextBubble;
		
		bub.removeTweens();
		
		/* Уничтожение при столкновении бонуса или
		попадании в нижнюю стенку */
		if (bub.isBonus || field.wallsArray[i].isDown) {
			addExplosion(bub.x, bub.y);
			showScoreLoose(bub.x, bub.y);
			showSceletton(bub.x, bub.y);
			field.processNextBubble();

			if (field.levelScore - 100 >= 0) {
				setScore(-100);
			} else {
				field.levelScore = 0;
			}
			field.showScore();
			
			return;
		}
		
		if (field.wallsArray[i].type == 'vertical') {
		
			// Получение углов для треугольника
			var l1 = bub.r_angle,
				l2 = 90,
				l3 = 180 - l1 - l2;
			
			// Вычисление стороны треугольника
			var c = getStageWidth();
			
			// Нахождение еще одной стороны
			var b = c * Math.sin(l1 * Math.PI/180)/Math.sin(l3 * Math.PI/180);
			
			// Получение точки движения по высоте
			var y_point = (bub.y > field.oldLocation.y) ? 
				bub.y + b: bub.y - b;

			// Направление движения вправо/влево
			var x_point = (bub.x > getStageCenter()) ? 0: getStageWidth() - 30/*- 35*/;

			bub.x_point = x_point;
			
			// Нахождение третьей стороны для получения скорости
			var a = c * Math.sin(l2 * Math.PI/180)/Math.sin(l3 * Math.PI/180);
			var speed = a / 10;
			
			// Движение к следующей стенке
			bub.moveTo(x_point, y_point, speed, speed, 
				function() {
			}, null);
			
		} else {

			var l1 = bub.r_angle,
				l2 = 90,
				l3 = 180 - l1 - l2;
			
			var c = (bub.x > field.oldLocation.x) ? getStageWidth() - bub.x:
				bub.x;
			
			var b = c * Math.sin(l1 * Math.PI/180)/Math.sin(l3 * Math.PI/180);
			
			var y_point = (bub.y < getStageHeightCenter()) ?
				bub.y + b : bub.y - b;

			var x_point = (bub.x > getStageCenter()) ? 0: getStageWidth();

			var a = c * Math.sin(l2 * Math.PI/180)/Math.sin(l3 * Math.PI/180);			
			var speed = a / 10;
			
			bub.moveTo(bub.x_point, y_point, speed, speed,
				function() {
			}, null);
		}
	}
}

function showScoreLoose(x, y) {
	var spr = new Sprite(bitmaps.minus100, 31, 12);
	spr.setPosition(x, y);
	stage.addChild(spr);
	
	spr.moveTo(x, y - 40, 20, 20, function(){spr.destroy = true;}, null);
	
	var interval = stage.setInterval(function() {
		spr.opacity -= 0.1;
		if (spr.opacity <= 0) {
			stage.clearInterval(interval);
		}
	}, 2);
}

function processHitBoss(obj) {
	obj.hp -= 1;

	// Убрать босса
	if (obj.hp <= 0) {
		obj.destroy = true;
		
		addExplosion(obj.x, obj.y, 'big', function() {buildBackground()});		
		
		var n = (obj.isSmall) ? 250: 500;
		setScore(n);
		field.showScore();
		
		var arr = field.levelArray,
			str = (obj.isSmall) ? 'small' + obj.type: 'boss' + obj.type;
		
		// Очистить массив от босса
		for (var i = 0, j = arr.length; i < j; i++) {
			for (k = 0, l = arr[i].length; k < l; k++) {
				if (arr[i][k] == str) arr[i][k] = 0;
			}
		}
	} else {
		addExplosion(obj.x, obj.y, 'small');	
	}
}

function processHitBossByBonus(obj) {
	if (obj.isHit) return;
	obj.isHit = true;
	processHitBoss(obj);
	stage.setTimeout(function(){delete obj.isHit}, 20);
}

// Очистка элемента в массиве "рыбок"
function clearElementInArray(obj) {

	var arr = field.levelArray;
	
	// Очистка для босса
	if (obj.isBoss) {
		processHitBossByBonus(obj);
		checkIfEndOfLevel();
		return;
	}
		
	// Очистка, если элемент в ячейке - простое число
	if (typeof (arr[obj.m_y][obj.m_x]) == 'number') {
		arr[obj.m_y][obj.m_x] = 0;
	} 
	
	// Очистка для трехмерного массива
	else if (arr[obj.m_y][obj.m_x] instanceof Array){

		arr[obj.m_y][obj.m_x].shift();

		var loc = getLocation(obj.m_x, obj.m_y);

		var n = field.colorArray.length;
		
		var rand = field.colorArray[Math.floor(Math.random() * n)];

		var post = function() {
			
			if (arr[obj.m_y][obj.m_x].length == 1) {
				arr[obj.m_y][obj.m_x] = rand;
			}
		}
		
		var fish = showAnimation(rand, loc.x, loc.y, post, null, true);
		fish.x = loc.x;
		fish.y = loc.y;
		
		fish.m_x = obj.m_x;
		fish.m_y = obj.m_y;
		
		fish.type = rand;	
		fish.isFish = true;		
	}

	// Очистка массива цветов от несуществующих
	field.colorToCheck = obj.type;
	
	checkIfEndOfLevel();
}

function checkIfEndOfLevel() {
	var count = 0;
	for (var i = 0, j = stage.objects.length; i < j; i++) {
		if (stage.objects[i].isFish || stage.objects[i].isBoss) {
			if (!stage.objects[i].destroy) count++;
		}
	}
	if (count == 0) {
		stage.setTimeout(function(){
			gameState = STATE_VICTORY;
			createScene();
		},50);
	}
}

function showWinScreen() {
	field.locked = false;
	
	var stars = 0;
	var waterPercent = 
		Math.ceil(field.roundTime * 100 / levelsTime[currentLevel - 1]);

	// Установка победных очей
	setScore(waterPercent * 10);
	
	if (waterPercent >= 25) {
		stars++;
	}
	if (waterPercent >= 50) {
		stars++;
	}	
	if (waterPercent >= 75) {
		stars++;
	}
	
	pause = true;

	var background = new Sprite(bitmaps.levelCleared, 
		getStageWidth(), getStageHeight());
	background.setPosition(getStageCenter(), getStageHeightCenter());
	background.static = true;
	stage.addChild(background);	

	// Если две звезды - открыть следующий левел
	if (stars >= 2 && currentLevel != 60) {
		Utils.setCookie('maxLevelUnlocked', currentLevel + 1);
		var play = new Sprite(bitmaps.play_win, 73, 72);
		play.setPosition(getStageWidth() - 45, getStageHeight() - 40);
		play.onmouseup = function() {
			if (currentLevel < 60) currentLevel++;
			gameState = STATE_GAME;
			createScene();
			return false;
		}
		stage.addChild(play);
	} 
	
	var replay = new Sprite(bitmaps.replay, 73, 73);
	replay.setPosition(getStageCenter(), getStageHeight() - 40);
	replay.static = true;
	replay.onmouseup = function() {
		gameState = STATE_GAME;
		createScene();
		return false;
	}
	stage.addChild(replay);	

	var back = new Sprite(bitmaps.back_btn, 73, 73);
	back.setPosition(45, getStageHeight() - 40);
	back.static = true;
	back.onmouseup = function() {
		gameState = STATE_SELECT_LEVEL;
		createScene();
		return false;
	}
	stage.addChild(back);
	
	// Отображение уровня
	showNumbers(currentLevel, getStageCenter() + 70, 
		getStageHeightCenter() - 55);

	/*// Отображение бонусов за время	
	showNumbers(Math.floor(field.roundTime / 60), getStageCenter() - 85, 
		getStageHeightCenter() - 17);

	var dots = new Sprite(bitmaps.dots, 6, 15);
	dots.setPosition(getStageCenter() - 80, getStageHeightCenter() - 17);
	dots.static = true;
	stage.addChild(dots);

	var seconds = (field.roundTime % 60 < 10) ? 0 + '' + 
		field.roundTime % 60: field.roundTime % 60;
	showNumbers(seconds, getStageCenter() - 50, 
		getStageHeightCenter() - 17);
	
	var x1 = new Sprite(bitmaps.x, 19, 26);
	x1.setPosition(getStageCenter() - 15, getStageHeightCenter() - 17);
	x1.static = true;
	stage.addChild(x1);
	
	showNumbers(100, getStageCenter() + 30, 
		getStageHeightCenter() - 17);	
		
	var equals1 = new Sprite(bitmaps.equals, 16, 17);
	equals1.setPosition(getStageCenter() + 60, getStageHeightCenter() - 17);
	equals1.static = true;
	stage.addChild(equals1);*/

	showNumbers(field.levelScore, getStageCenter() + 80, 
		getStageHeightCenter() - 17);	
	
	/*// Отображение бонусов за уровень воды	
	showNumbers(waterPercent, getStageCenter() + 47, 
		getStageHeightCenter() + 20);	

	var percent = new Sprite(bitmaps.percent, 13, 25);
	percent.setPosition(getStageCenter() + 70, getStageHeightCenter() + 20);
	percent.static = true;
	stage.addChild(percent);	
	
	var x = new Sprite(bitmaps.x, 19, 26);
	x.setPosition(getStageCenter() + 90, getStageHeightCenter() + 20);
	x.static = true;
	stage.addChild(x);
	
	showNumbers(10, getStageCenter() + 125, 
		getStageHeightCenter() + 20);	
		
	var equals = new Sprite(bitmaps.equals, 16, 17);
	equals.setPosition(getStageCenter() + 145, getStageHeightCenter() + 20);
	equals.static = true;
	stage.addChild(equals);*/
		
	showNumbers(waterPercent * 10, getStageCenter() + 80, 
		getStageHeightCenter() + 20);
	
	// Отображение общего счета
	showNumbers(Utils.getCookie('total_score'), getStageCenter() + 120, 
		getStageHeightCenter() + 55);
	

	// Запись лучшего результата звёзд
	if (Utils.getCookie('starsOn_' + currentLevel) < stars) {
		Utils.setCookie('starsOn_' + currentLevel, stars);
	}
	
	var star1 = (stars > 0) ? new Sprite(bitmaps.star, 18, 18) :
		new Sprite(bitmaps.star_empty, 18, 18);
	star1.setPosition(getStageCenter() - 110, getStageHeightCenter() - 55);
	star1.static = true;
	stage.addChild(star1);

	var star2 = (stars > 1) ? new Sprite(bitmaps.star, 18, 18) :
		new Sprite(bitmaps.star_empty, 18, 18);
	star2.setPosition(getStageCenter() - 90, getStageHeightCenter() - 55);
	star2.static = true;
	stage.addChild(star2);
	
	var star3 = (stars > 2) ? new Sprite(bitmaps.star, 18, 18) :
		new Sprite(bitmaps.star_empty, 18, 18);
	star3.setPosition(getStageCenter() - 70, getStageHeightCenter() - 55);
	star3.static = true;
	stage.addChild(star3);	

	buildBackground();		
}

function detonateRocket(target) {
	var y = target.m_y,
	x = target.m_x,
	direction = (target.x < getStageCenter()) ? 0: 1,
	arr = field.levelArray;

	field.nextBubble.removeTweens();

	clearElementInArray(target);
	clearDiagonal(target);

	// Стирание диагональных линий
	function clearDiagonal(target) {
		for (var i = 0, k = stage.objects.length; i < k; i++) {
			var obj = stage.objects[i];

			if (obj.uid == target.uid) continue;

			if (!obj.isFish && !obj.isBoss) continue;

			var dist = (obj.isBoss) ? 70: 30;

			if (direction == 0) {
				if (getDistance(obj, target) < dist && 
					obj.x < target.x && obj.y < target.y) {
					clearElementInArray(obj);
					clearDiagonal(obj);
				}
			} else {
				if (getDistance(obj, target) < dist && 
					obj.x > target.x && obj.y < target.y) {
						clearElementInArray(obj);
						clearDiagonal(obj);
				}
			}
		}
	}

	// Ka-BOOM! (Синхронизация массива с рыбками на экране)
	for (var i = 0, k = stage.objects.length; i < k; i++) {
		var obj = stage.objects[i];
		if (obj.isFish && arr[obj.m_y][obj.m_x] == 0) {
			obj.destroy = true;
			addExplosion(obj.x, obj.y);
		}
	}

	field.processNextBubble();
	buildBackground();
}

function detonateMissile(target) {
	var type = target.type;
		
	field.nextBubble.removeTweens();

	for (var i = 0, k = stage.objects.length; i < k; i++) {
		var obj = stage.objects[i];
		if (obj.isFish || obj.isBoss) {
			if (obj.type == type) {
				obj.destroy = true;
				addExplosion(obj.x, obj.y);
				clearElementInArray(obj);
			}
		}
	}
	
	field.processNextBubble();
	buildBackground();
}

function getObjByLocation(obj) {
	for (var i = 0, j = stage.objects.length; i < j; i++) {
		var o = stage.objects[i];
		if (o.isBoss && o.type == obj.val) {
			return o;
		}
	}
}

function detonateBomb(target) {
	field.nextBubble.removeTweens();

	var arrToDelete = [];
	arrToDelete.push(target);
	
	// Поиск области поражения
	for (var i = 0, j = stage.objects.length; i < j; i++) {
		var obj = stage.objects[i];

		if (!obj.isFish && !obj.isBoss) continue;
		var dist = (obj.isBoss) ? 70: 30;


		if (getDistance(obj, target) > dist) continue;
		arrToDelete.push(obj);
	}
		
	// Ka-BOOM!
	for (var i = 0, j = arrToDelete.length; i < j; i++) {
		var obj = arrToDelete[i];
		clearElementInArray(obj);
		
		if (obj.isFish) {
			obj.destroy = true;
			addExplosion(obj.x, obj.y);
		}
	}	

	field.processNextBubble();
	buildBackground();
}

function addExplosion(x, y, size, func) {
	var w, h, bitmap;
	switch (size) {
		case 'big':
			w = 310;
			h = 310;
			bitmap = 'explosion_big';
			break;
		
		default:
			w = 79;
			h = 79;
			bitmap = 'explosion';
			break;
	}
	mc = new Sprite(bitmaps[bitmap], w, h, 12);
	mc.x = x;
	mc.y = y;
	mc.animDelay = 2;
	mc.onenterframe = function(e) { 
		if(e.target.currentFrame == 11) {
			e.target.destroy = true; 
			if (func) func();
		}
	}
	stage.addChild(mc);
}

function buildBackground() {
    if (stage) stage.drawScene(document.getElementById("screen_background"), true);
}

var GameField = function() {
	var self = this,
		angle;
	
	this.fishArray = [];
	this.levelArray = [];
	this.lineToShootArray = [];
	this.timeTextArray = [];
	this.scoreTextArray = [];
	this.colorArray = [];
	this.levelScore = 0;
	this.scale = 
		document.getElementById("main_container").offsetWidth/getStageWidth();
	
	this.init = function() {
		pause = false;
		self.locked = false;
		set_cX();
		
		// Установка цветов птичек на уровне
		self.fillColorArray();
		
		showNumbers(currentLevel, getStageCenter() - 28, 15);
		
		// Загрузка преднастроенного уровня
		loadLevelSettings();

		var background = 
			new Sprite(bitmaps.gameBack, getStageWidth(), getStageHeight());
		background.x = 160 + cX;
		background.y = getStageHeightCenter();
		background.static = true;
		
		self.fillBackground();
		
		// Движение "стрелочки"
		background.onmousemove = self.moveOnBackground;
		
		// "Выстрел"
		background.onmouseup = self.shootBubble;
		
		stage.setZIndex(background, -100);
		stage.addChild(background);

		// Установка времени уровня
		self.roundTime = levelsTime[currentLevel - 1];
		self.timer = 0;
		self.showTime();
		
		// Отображение счета
		self.showScore();
		
		// Добавление "стен" на уровне
		self.addWalls();
		
		// Добавление "пушки"
		self.addGun();
		
		// Установка первого снаряда
		self.genNextType();

		// Заполнение конвеера
		self.fillShootArray();
		
		// Добавление бонусов
		self.addBonus();
	}
	
	this.fillBackground = function() {
		var pause_btn = new Sprite(bitmaps.pause_btn, 37, 36);
		pause_btn.setPosition(20, 23);
		//pause_btn.static = true;
		pause_btn.onmouseup = function() {
			if (!pause) {
				setBackColor("#FBED24");
				pause = true;
				stopAnimation();
				showPauseBack();
				return false;
			} 
		}
		stage.addChild(pause_btn);

		var cart = new Sprite(bitmaps.cart, 37, 36);
		cart.setPosition(20, 62);
		cart.static = true;
		cart.onmouseup = function() {
			if (!pause) {
				pause = true;
				stopAnimation();
				setBackColor("#1ACAFF");
				showShop();
				return false;
			} 
		}
		stage.addChild(cart);
		
		var corner = new Sprite(bitmaps.corner, 182, 282);
		corner.x = getStageWidth() - 90;
		corner.y = 141;
		corner.static = true;
		stage.addChild(corner);
		
		// Добавление уровня воды
		var waterLevel = new Sprite(bitmaps.waterLevel, 28, 205);
		waterLevel.x = getStageWidth() - 19;
		waterLevel.y = 168 + 115;
		
		// Смещение центра по высоте  
		waterLevel.anchor.y = 112;
		self.waterLevel = waterLevel;
		stage.addChild(waterLevel);		
		
		// Небольшое смещение для корректировки вида уровня воды
		waterLevel.height -= 6;
		waterLevel.offset.top += 6;
		waterLevel.y += 3;		
		
		/* Процентное соотношение текущего 
		времени относительного начального */
		var time_percent = (levelsTime[currentLevel - 1] - 1) * 100 
			/ levelsTime[currentLevel - 1];
		
		// Получение новой высоты
		var current_water_height = 205 * time_percent / 100;
		
		// Получение смещения с корректировкой
		self.shift = Math.ceil(205 - current_water_height) - 1;
		
		// Полоска уровня воды
		var waterTop = new Sprite(bitmaps.waterTop, 28, 7);
		waterTop.x = waterLevel.x;
		waterTop.y = waterLevel.y - 2 * waterLevel.anchor.y + 12;		
		stage.addChild(waterTop);
		
		self.waterTop = waterTop;
	}
	
	this.fillColorArray = function() {
		self.colorArray = levelsFishConfig[currentLevel - 1].slice();
	}
	
	this.addBonus = function() {
		var missile = new Sprite(bitmaps.Missile, 21, 30);
		missile.x = arrow.x + 78;
		missile.y = arrow.y + 13;
		missile.static = true;
		missile.type = 'Missile';
		if (Utils.getCookie('missile_n') > 0) {
			missile.opacity = 1;
			missile.quantity = showNumbers(Utils.getCookie('missile_n'),
				missile.x + 20, missile.y + 10, 'small');
		} else {
			missile.opacity = 0.5;
		}
		missile.onmouseup = function(e) {
			if (Utils.getCookie('missile_n') > 0) {
				self.swapBonus(e);
				
				var n = Utils.getCookie('missile_n');
				n--;
				Utils.setCookie('missile_n', n);
				
				missile.quantity.destroy = true;
								
				if (n < 1) {
					e.target.opacity = 0.5;
					buildBackground();
				} else {
					missile.quantity = showNumbers(n, missile.x + 20, 
						missile.y + 10, 'small');
				}
			}
			return false;
		};
		stage.addChild(missile);
		
		var bomb = new Sprite(bitmaps.Bomb, 29, 39);
		bomb.x = arrow.x + 126;
		bomb.y = arrow.y + 12;
		bomb.type = 'Bomb';
		bomb.static = true;
		if (Utils.getCookie('bomb_n') > 0) {
			bomb.opacity = 1;
			bomb.quantity = showNumbers(Utils.getCookie('bomb_n'),
				bomb.x + 20, bomb.y + 10, 'small');
		} else {
			bomb.opacity = 0.5;
		}
		bomb.onmouseup = function(e) {
			if (Utils.getCookie('bomb_n') > 0) {
				self.swapBonus(e);
				
				var n = Utils.getCookie('bomb_n');
				n--;
				Utils.setCookie('bomb_n', n);
				
				bomb.quantity.destroy = true;
								
				if (n < 1) {
					e.target.opacity = 0.5;
					buildBackground();
				} else {
					bomb.quantity = showNumbers(n, bomb.x + 20, 
						bomb.y + 10, 'small');
				}
			}
			return false;
		};
		stage.addChild(bomb);

		var rocket = new Sprite(bitmaps.Rocket, 20, 29);
		rocket.x = arrow.x + 174;
		rocket.y = arrow.y + 13;
		rocket.type = 'Rocket';
		rocket.static = true;
		if (Utils.getCookie('rocket_n') > 0) {
			rocket.opacity = 1;
			rocket.quantity = showNumbers(Utils.getCookie('rocket_n'),
				rocket.x + 20, rocket.y + 10, 'small');
		} else {
			rocket.opacity = 0.5;
		}
		rocket.onmouseup = function(e) {
			if (Utils.getCookie('rocket_n') > 0) {
				self.swapBonus(e);
				
				var n = Utils.getCookie('rocket_n');
				n--;
				Utils.setCookie('rocket_n', n);
				
				rocket.quantity.destroy = true;
								
				if (n < 1) {
					e.target.opacity = 0.5;
						buildBackground();
				} else {
					rocket.quantity = showNumbers(n, rocket.x + 20, 
						rocket.y + 10, 'small');
				}
			}
			return false;
		};
		stage.addChild(rocket);

		var clock = new Sprite(bitmaps.Clock, 26, 33);
		clock.x = arrow.x + 222;
		clock.y = arrow.y + 13;
		clock.type = 'Clock';
		clock.static = true;
		if (Utils.getCookie('time_n') > 0) {
			clock.opacity = 1;
			clock.quantity = showNumbers(Utils.getCookie('time_n'),
				clock.x + 20, clock.y + 10, 'small');
		} else {
			clock.opacity = 0.5;
		}
		clock.onmouseup = function(e) {
			if (Utils.getCookie('time_n') > 0) {
				
				increaseRoundTime(30);
				
				var n = Utils.getCookie('time_n');
				n--;
				Utils.setCookie('time_n', n);
				
				clock.quantity.destroy = true;
							
				if (n < 1) {
					e.target.opacity = 0.5;
					buildBackground();
				} else {
					clock.quantity = showNumbers(n, clock.x + 20, 
						clock.y + 10, 'small');
				}
			}
			return false;
		}
		stage.addChild(clock);
		
		self.bonusFeatures = [];
		self.bonusFeatures[0] = missile;
		self.bonusFeatures[1] = bomb;
		self.bonusFeatures[2] = rocket;
		self.bonusFeatures[3] = clock;
	}
	
	// Установка бонуса
	this.swapBonus = function(e) {
		if (self.locked || self.bubbleLaunched) return;
		self.locked = true;
		self.storedItem = self.nextBubble.type;
		self.nextBubble.destroy = true;
		
		// Создание бонуса в виде снаряда
		var bonus = new Sprite(bitmaps[e.target.type], 
			e.target.width, e.target.height);
		bonus.x = arrow.x;
		bonus.y = arrow.y;
		bonus.type = e.target.type;
		bonus.isBonus = true;
		self.nextBubble = bonus;
		
		bonus.onmouseup = function(e) {
			
			// Удаление спрайта бонуса
			e.target.destroy = true;

			// Восстановление предыдущей "рыбки"
			var n = self.storedItem;
			var fish = new Sprite(bitmaps['b' + n], 36, 33);
			fish.x = arrow.x;
			fish.y = arrow.y;
			fish.type = self.storedItem;
			self.nextBubble = fish;
			stage.addChild(fish);	

			// Восстановление бонуса
			var type = e.target.type;
			if (type == 'Bomb') incBonus('bomb_n', 1, 1);
			else if (type == 'Rocket') incBonus('rocket_n', 2, 1);
			else if (type == 'Missile') incBonus('missile_n', 0, 1);
			buildBackground();
			
			return false;
		};
		stage.addChild(bonus);	
		
		// Запрета выстрела после выбора бонуса
		stage.setTimeout(function(){self.locked = false;}, 10);
		
		return false;
	}
	
	this.fillShootArray = function() {
		var n = self.colorArray.length;
		for (var i = 0; i < 7; i++) {
			var rand = self.colorArray[Math.floor(Math.random() * n)];
			
			var fish = new Sprite(bitmaps['b' + rand], 36, 33);
			fish.x = arrow.x - 70 - 27 * i;
			fish.y = arrow.y + 21;
			fish.type = rand;
			stage.addChild(fish);
			stage.setZIndex(fish, 100);
			self.lineToShootArray.push(fish);
		}
	}
	
	this.addGun = function() {
		var line_left = new Sprite(bitmaps.line_left, 261, 31);
		line_left.x = getStageCenter() - 130;
		line_left.y = getStageHeight() - 15;
		line_left.static = true;
		line_left.onmouseup = function() {
			return false;
		}
		stage.addChild(line_left);				

		var line_right = new Sprite(bitmaps.line_right, 261, 31);
		line_right.x = getStageCenter() + 130;
		line_right.y = getStageHeight() - 15;
		line_right.static = true;
		line_right.onmouseup = function() {
			return false;
		}
		stage.addChild(line_right);

		if (currentLevel > 10) {
			var conveyor_layer = new Sprite(bitmaps.conveyor_layer, 245, 28);
			conveyor_layer.x = line_left.x - 8;
			conveyor_layer.y = line_left.y + 1;
			conveyor_layer.static = true;
			stage.addChild(conveyor_layer);	

			stage.setZIndex(conveyor_layer, 500);
		}
		
		var crab = new Sprite(bitmaps.gun2, 119, 38);
		crab.x = getStageWidth()/2;
		crab.y = getStageHeight() - 18;
		crab.static = true;
		stage.addChild(crab);
		
		var gun = new Sprite(bitmaps.gun, 39, 39);
		gun.x = crab.x;
		gun.y = crab.y - 15;
		gun.static = true;
		stage.addChild(gun);
		
		arrow = new Sprite(bitmaps.arrow_small, 22, 450);
		arrow.x = gun.x;
		arrow.y = gun.y;
		stage.addChild(arrow);
		stage.setZIndex(arrow, -10);
	}
	
	this.shootBubble = function() {
		if (self.locked || self.bubbleLaunched || pause) return;
		
		// Без начального угла для touch экранов
		if (!angle) return;
		
		self.locked = true;
		self.bubbleLaunched = true;
	
		var bub = self.nextBubble;

		// Направление движения к стенке
		var l1 = 90 - Math.abs(angle),
			l2 = 90,
			l3 = 180 - l1 - l2;
		
		var c = getStageWidth() - arrow.x;
		
		var b = c * Math.sin(l1 * Math.PI/180)/Math.sin(l3 * Math.PI/180);

		var a = c * Math.sin(l2 * Math.PI/180)/Math.sin(l3 * Math.PI/180);
		var speed = a / 10;
		
		// -33 за высоту указателя
		var y_point = getStageHeight() - b - 33;
				
		// -35 за смещение правой стены, 10 для визуальной корректировки полёта
		var x_point = (angle > 0) ? getStageWidth() - 30 + 10: 0;
		
		bub.r_angle = l1;
		bub.x_point = x_point;

		// Установка скорости в зависимости от направления 
		var moveTime = (y_point > 0) ? 25: 50;
		
		if (y_point == -Infinity) {
			moveTime = 1400;
			y_point = -14000;
		} else if (y_point < -500) {
			moveTime = Math.abs(y_point)/10;
		}
		
		// Если бонус (missile || rocket) то повернуть в направлении движения
		if (bub.type == 'Missile' || bub.type == 'Rocket') {
			bub.rotateTo(arrow.rotation);
		}
		
		// Метка для обработки паузы
		bub.isMovingBubble = true;
		
		bub.moveTo(x_point, y_point, speed/*moveTime*/, speed/*50*/, 
			function() {}, null);
	}
	
	this.genNextType = function() {
		var n = self.colorArray.length;
		var rand = self.colorArray[Math.floor(Math.random() * n)];

		var next = new Sprite(bitmaps['b' + rand], 36, 33);
		next.setPosition(arrow.x, arrow.y);
		
		next.type = rand;
		self.nextBubble = next;
		
		// Запись координат до отрисовки
		self.oldLocation = {x: next.x, y: next.y};
		
		stage.addChild(next);
		
		self.colorToCheck = next.type;
	}
	
	this.moveNextBubble = function() {
		if (gameState != STATE_GAME) return;
		
		self.locked = true;
		
		var arr = self.lineToShootArray;
		arr[0].moveTo(arrow.x, arrow.y, 5, 5, 
			function() {
				
				// Установка рыбки статичной после прилипания
				if (!self.nextBubble.destroy && self.nextBubble.isFish) {
					self.nextBubble.static = true;
					buildBackground();
				}
			
				self.nextBubble = arr[0];
				stage.setZIndex(self.nextBubble, 510);
				arr.shift();
		}, null);
		for (var i = 1, j = arr.length; i < j; i++) {
			arr[i].moveTo(arr[i].x + 27, arr[i].y, 5, 5, 
				function() {
				}, null);			
		}
		stage.setTimeout(function(){					
			var n = self.colorArray.length;
			var rand = self.colorArray[Math.floor(Math.random() * n)];

			var fish = new Sprite(bitmaps['b' + rand], 36, 33);
			fish.x = arr[arr.length - 1].x - 27;
			fish.y = arrow.y + 21;
			fish.type = rand;
			stage.addChild(fish);
			stage.setZIndex(fish, 100);
			self.lineToShootArray.push(fish);
			
			self.processRemoveColor(self.colorToCheck);	
			
		}, 10);
	}
	
	this.moveOnBackground = function(e) {
		if (pause) return;
		var x1 = getStageCenter() + Math.floor(e.x);
		var y1 = getStageHeightCenter() + Math.floor(e.y);

		var x2 = arrow.x;
		var y2 = arrow.y;

		var dy = y1 - y2;

		var dx = x1 - x2;
		angle = Math.atan2(dy,dx);
		angle = Math.floor(Utils.radian2grad(angle) + 90); // угол поворота

		// Фиксация угла поворота
		angle = (angle == -45) ? angle = -46: angle;
		angle = (angle == 43) ? angle = 44: angle;
		angle = (angle > 240) ? -80: angle;
		angle = (angle > 80) ? 80: angle;
		angle = (angle < -80) ? -80: angle;
		angle = (angle == 0) ? -1: angle;
		
		arrow.rotateTo(angle * Math.PI/180, 0, 0, null,null);
	}
	
	this.moveToClosestFish = function(obj_dest) {
		
		if (!self.bubbleLaunched) return;
		
		// Проверка места возле босса
		if (obj_dest.isBoss) {
			obj_dest = self.checkBossNeighbors(obj_dest);
		}
		
		// Проверка возможности установки в соседних клеточках
		var obj = self.checkNeighbors(obj_dest);
		
		if (!obj) return;
		
		self.bubbleLaunched = false;
		
		self.nextBubble.removeTweens();
		self.nextBubble.x = obj.x;
		self.nextBubble.y = obj.y;
		self.nextBubble.isFish = true;
		self.nextBubble.m_x = obj.m_x;
		self.nextBubble.m_y = obj.m_y;
	
		// Поиск цепочки
		self.findChains(post);
		
		// Создание следующего "снаряда"
		function post() {
			self.moveNextBubble();	
		}
	}
	
	this.findChains = function(post) {
		var chain_length = 0;
		var arrToDelete = [];
		var arr = self.levelArray;
		var type = self.nextBubble.type;
		var x = self.nextBubble.m_x;
		var y = self.nextBubble.m_y;
		
		self.nextBubble.checked = true;
		arrToDelete.push(self.nextBubble);
				
		searchChain(self.nextBubble);
		
		// Снятие меток
		unmark();
		
		function searchChain(searchObj) {
			for (var i = 0, j = stage.objects.length; i < j; i++) {
				var obj = stage.objects[i];
				
				if (obj.checked || 
					getDistance(obj, searchObj) > 30) continue;

				if (obj.type == type && !obj.isBoss) {
					chain_length++;
					obj.checked = true;
					arrToDelete.push(obj);
					searchChain(obj);
				}
			}
		}
		
		function unmark() {
			for (var i = 0, j = stage.objects.length; i < j; i++) {
				stage.objects[i].checked = false;
			}
		}
				
		function deleteChain(arr) {
			for (var i = 0, j = arr.length; i < j; i++) {
			
				// Увеличение счета
				setScore(50);
				self.showScore();
				
				increaseRoundTime(1);
				
				var obj = arr[i];
				obj.destroy = true;
				addExplosion(obj.x, obj.y);
				clearElementInArray(obj);
			}	
			buildBackground();			
		}
		
		// Удаление, если длина цепочки в 3 элемента
		if (chain_length > 1) {
			stage.setTimeout(function() {
				deleteChain(arrToDelete);
				if (post) post();
			}, 20);
		} else {
			if (post) post();
		}
	}
	
	this.processNextBubble = function() {
		
		checkIfEndOfLevel();
		
		field.nextBubble.destroy = true;
		field.moveNextBubble();
		field.bubbleLaunched = false;
	}
	
	this.processRemoveColor = function(type) {
		if (gameState != STATE_GAME) return;
		
		if (self.colorArray.length == 1) {
			self.locked = false;
			return;
		}
		
		var count = 0;
		
		for (var i = 0, j = stage.objects.length; i < j; i++) {
			var obj = stage.objects[i];
			if (obj.type != type || obj.destroy) continue;
			if (obj.isFish || obj.isBoss) count++;
		}
		
		if (count == 0) {
			for (var k = 0, l = self.colorArray.length; k < l; k++) {
				if (self.colorArray[k] == type) {
					self.colorArray.splice(k, 1);
					self.checkConveyor(type);
					break;
				}
			}
			
			if (self.nextBubble.type == type) {
				var nb = self.nextBubble;
				nb.destroy = true;
				var n = self.colorArray.length;
				
				var rand = self.colorArray[Math.floor(Math.random() * n)];

				var post = function() {
					self.locked = false;
				};
				
				var fish = showAnimation(rand, nb.x, nb.y, post);	
				fish.x = nb.x;
				fish.y = nb.y;
				fish.type = rand;
				self.nextBubble = fish;

			} else {
				stage.setTimeout(function(){self.locked = false;},fps);
			}
		} else {
			self.locked = false;
		}
	}
	
	this.checkConveyor = function(type) {
		for (var i = 0, j = self.lineToShootArray.length; i < j; i++) {
			if (self.lineToShootArray[i].type == type) {
				self.changeConveyorElem(i);
			}
		}
	}

	this.changeConveyorElem = function(i) {
		var obj = self.lineToShootArray[i],
	
		num = i,

		n = self.colorArray.length,
		
		rand = self.colorArray[Math.floor(Math.random() * n)],
		
		post = function() {
			self.lineToShootArray[num] = fish;
		};

		obj.destroy = true;
		
		var fish = showAnimation(rand, obj.x, obj.y, post, 300);
		fish.x = obj.x;
		fish.y = obj.y;
		fish.type = rand;		
	}
	
	this.checkNeighbors = function(target) {
		var dist = Number.POSITIVE_INFINITY,
			newDist,
			obj,
			arr = rotateArray(self.levelArray),
			x = target.m_x,
			y = target.m_y;

		checkFree(x, y - 1);
		checkFree(x - 1, y);
		checkFree(x + 1, y);
		checkFree(x, y + 1);

		function checkFree(k,l) {
			if (arr[k] != undefined	&& arr[k][l] != undefined
				&& arr[k][l] == 0) {		
					var temp_obj = getLocation(k, l);
					newDist = getDistance(temp_obj, self.oldLocation);
					if (newDist < dist) {
						dist = newDist;
						obj = temp_obj;
					}
			}
		}
		
		// Проверка для ряда, сдвинутого вправо
		if (((y + 1) % 2) == 0) {
			checkFree(x + 1, y - 1);
			checkFree(x + 1, y + 1);
		} else if (((y + 1) % 2) != 0) {
			checkFree(x - 1, y - 1);
			checkFree(x - 1, y + 1);
		}
		
		if (!obj) {
			obj = target;
		}
		
		self.levelArray[obj.m_y][obj.m_x] = self.nextBubble.type;
		
		if (obj.m_y >= 11) {
			gameState = STATE_GAME_OVER;
			createScene();
			return;
		}
		
		return obj;
	}
	
	this.checkBossNeighbors = function(target) {
		var tar_arr = [],
			x = target.m_x,
			y = target.m_y,
			l = Number.POSITIVE_INFINITY,
			dest = target;

		// Ячейки для большого босса
		if (!target.isSmall) {
			tar_arr.push(getLocation(x, y - 1));
			tar_arr.push(getLocation(x - 1, y));
			tar_arr.push(getLocation(x + 1, y));
			tar_arr.push(getLocation(x, y + 1));		

			if (((y + 1) % 2) == 0) {
				tar_arr.push(getLocation(x + 1, y - 1));
				tar_arr.push(getLocation(x + 1, y + 1));
			} else if (((y + 1) % 2) != 0) {
				tar_arr.push(getLocation(x - 1, y - 1));
				tar_arr.push(getLocation(x - 1, y + 1));
			}
		
		} 
		// Ячейки для маленького
		else {
			tar_arr.push(getLocation(x, y + 1));	
			
			if (((y + 1) % 2) == 0) {
				tar_arr.push(getLocation(x + 1, y + 1));
			} else if (((y + 1) % 2) != 0) {
				tar_arr.push(getLocation(x - 1, y + 1));
			}
		}

		var x_shift = field.nextBubble.x - field.oldLocation.x;
		var y_shift = field.nextBubble.y - field.oldLocation.y;
		var checkPoint = {x: field.nextBubble.x - 1.4 * x_shift, 
			y: field.nextBubble.y - 1.4 * y_shift};
		
		for (var i = 0, j = tar_arr.length; i < j; i++) {
			var d = getDistance(checkPoint, tar_arr[i]);
			if (d < l) {
				l = d;
				dest = tar_arr[i];
			}
		}
		
		return dest;
	}
	
	this.addWalls = function() {
		self.wallsArray = [];
		
		// Вертикальные стены
		var w1 = new Sprite(null, 10, getStageHeight());
		w1.x = 0;
		w1.y = getStageHeight()/2;
		w1.type = 'vertical';
		w1.static = true;
		stage.addChild(w1);
		
		var w2 = new Sprite(null, 10, getStageHeight());
		w2.x = getStageWidth() - 30/*- 35*/;
		w2.y = getStageHeight()/2;
		w2.type = 'vertical';
		w2.static = true;
		stage.addChild(w2);
		
		// Горизонтальные стены 
		var w3 = new Sprite(null, getStageWidth(), 10);
		w3.x = getStageCenter();
		w3.y = 0;
		w3.type = 'horizontal';
		w3.static = true;
		stage.addChild(w3);
		
		var w4 = new Sprite(null, getStageWidth(), 10);
		w4.x = getStageCenter();
		w4.y = getStageHeight();
		w4.isDown = true;
		w4.type = 'horizontal';
		w4.static = true;
		stage.addChild(w4);			
		
		self.wallsArray.push(w1);
		self.wallsArray.push(w2);
		self.wallsArray.push(w3);
		self.wallsArray.push(w4);
	}
	
	this.showScore = function() {
		self.clearScore();
		var x = (pause == true) ? getStageWidth() - 55: getStageWidth() - 110;
		var y = (pause == true) ? getStageHeightCenter() - 137: 10;
		var setting = (pause == true) ? 'score': 'score_game';
		var score_type = (pause == true) ? Utils.getCookie('total_score')
			: self.levelScore;
		showNumbers(score_type, x, y, setting);
	}
	
	this.clearScore = function() {
		if (self.scoreTextArray.length > 0) {
			for (var i = 0, j = self.scoreTextArray.length; i < j; i++) {
				self.scoreTextArray[i].destroy = true;
			}
			self.scoreTextArray = [];
		}
	}	

	this.showTime = function() {
		self.clearTime();
		showNumbers(self.roundTime, getStageWidth() - 6 - 18, 30, 'time');
	}
	
	this.clearTime = function() {
		if (self.timeTextArray.length > 0) {
			for (var i = 0, j = self.timeTextArray.length; i < j; i++) {
				self.timeTextArray[i].destroy = true;
			}
			
			self.timeTextArray = [];
		}
	}
}

Array.prototype.has = function(a) {
	for (var i = 0, j = this.length; i < j; i++) {
		if (this[i] == a) return true;
	}	
	return false;
}

function increaseRoundTime(n) {
	field.roundTime += n;
	field.showTime();

	// Установка уровней воды
	var s = n * field.shift;
	
	var w = field.waterLevel;
	
	// Установка верхней границы
	s = (w.height + s > 205) ? 205 - w.height: s;
	
	w.height += s;
	
	w.offset.top -= s;
	w.y -= s/2;	

	field.waterTop.y -= s;		
}

function setScore(n) {
	field.levelScore += n;
	Utils.setCookie('total_score', 
		parseInt(Utils.getCookie('total_score')) + n);
}

function incBonus(b_name, i, opacity) {
	var b = (Utils.getCookie(b_name) == undefined) ? 0: 
		Utils.getCookie(b_name);
	Utils.setCookie(b_name, ++b);
	var bonus = field.bonusFeatures[i];
	bonus.opacity = 1;
	if (bonus.quantity) bonus.quantity.destroy = true;
	bonus.quantity = showNumbers(Utils.getCookie(b_name), 
		bonus.x + 20, bonus.y + 10, 'small');	
	bonus.quantity.opacity = (opacity) ? opacity: 0;	
}

function buyItem(item) {
	var total = Utils.getCookie("total_score");
	switch (item) {
		case 'bomb':
			Utils.setCookie("total_score", total - bomb_price);
			incBonus('bomb_n', 1);
			break;
		
		case 'rocket':
			Utils.setCookie("total_score", total - rocket_price);
			incBonus('rocket_n', 2);
			break;
		
		case 'missile':
			Utils.setCookie("total_score", total - missile_price);
			incBonus('missile_n', 0);
			break;
		
		case 'time':
			Utils.setCookie("total_score", total - time_price);
			incBonus('time_n', 3);
			break;		
		
		/*case 'aim':
			Utils.setCookie("total_score", total - 30000);
			
			arrow.destroy = true;
			var arr = new Sprite(bitmaps.arrow, 22, 531);
			arr.setPosition(arrow.x, arrow.y);
			stage.addChild(arr);
			stage.setZIndex(arr, -10);
			arrow = arr;
		
			break;*/
		
		default:
			console.log('unexpected item');
			break;
	}
	field.showScore();
}

function showShop() {
	var shopBack = new Sprite(bitmaps.shop, getStageWidth(), getStageHeight());
	shopBack.setPosition(getStageCenter(), getStageHeightCenter());
	stage.addChild(shopBack);	
	
	field.showScore();
	
	var arr = levelsBonusConfig[currentLevel - 1];
	
	if (!arr.has(1)) {
		var lock1 = new Sprite(bitmaps.lock_s, 27, 31);
		lock1.setPosition(getStageCenter() - 155, getStageHeightCenter() - 20);
		stage.addChild(lock1);
	}
	
	var cart1 = new Sprite(null, 90, 80);
	cart1.setPosition(getStageCenter() - 177, getStageHeightCenter());
	cart1.onclick = function() {
		if (!lock1 && Utils.getCookie('total_score') >= bomb_price) buyItem('bomb');
		if (showShop.bonus_quantity1) showShop.bonus_quantity1.destroy = true;
		showShop.bonus_quantity1 = showNumbers(
			Utils.getCookie('bomb_n'), back.x + 80, back.y + 5, 'small');
		showBuyAnimation(cart1);
	}
	stage.addChild(cart1);	
	
	var numArr1 = showNumbers(bomb_price, cart1.x, cart1.y + 55, true);
	
	if (!arr.has(2)) {
		var lock2 = new Sprite(bitmaps.lock_s, 27, 31);
		lock2.setPosition(getStageCenter() - 31, getStageHeightCenter() - 20);
		stage.addChild(lock2);
	}
	
	var cart2 = new Sprite(null, 90, 80);
	cart2.setPosition(getStageCenter() - 55, getStageHeightCenter());
	cart2.onclick = function() {
		if (!lock2 && Utils.getCookie('total_score') >= rocket_price) buyItem('rocket');
		if (showShop.bonus_quantity2) showShop.bonus_quantity2.destroy = true;
		showShop.bonus_quantity2 = showNumbers(
			Utils.getCookie('rocket_n'), back.x + 122, back.y + 5, 'small');
		showBuyAnimation(cart2);
	}
	stage.addChild(cart2);	

	var numArr2 = showNumbers(rocket_price, cart2.x, cart2.y + 55, true);
	
	if (!arr.has(3)) {
		var lock3 = new Sprite(bitmaps.lock_s, 27, 31);
		lock3.setPosition(getStageCenter() + 88, getStageHeightCenter() - 20);
		stage.addChild(lock3);
	}
	
	var cart3 = new Sprite(null, 90, 80);
	cart3.setPosition(getStageCenter() + 67, getStageHeightCenter());
	cart3.onclick = function() {
		if (!lock3 && Utils.getCookie('total_score') >= missile_price) buyItem('missile');
		if (showShop.bonus_quantity0) showShop.bonus_quantity0.destroy = true;
		showShop.bonus_quantity0 = showNumbers(
			Utils.getCookie('missile_n'), back.x + 165, back.y + 5, 'small');
		showBuyAnimation(cart3);
	}
	stage.addChild(cart3);	

	var numArr3 = showNumbers(missile_price, cart3.x, cart3.y + 55, true);
	
	if (!arr.has(4)) {
		var lock4 = new Sprite(bitmaps.lock_s, 27, 31);
		lock4.setPosition(getStageCenter() + 208, getStageHeightCenter() - 20);
		stage.addChild(lock4);
	}
	
	var cart4 = new Sprite(null, 90, 80);
	cart4.setPosition(getStageCenter() + 187, getStageHeightCenter());
	cart4.onclick = function() {
		if (!lock4 && Utils.getCookie('total_score') >= time_price) buyItem('time');
		if (showShop.bonus_quantity3) showShop.bonus_quantity3.destroy = true;
		showShop.bonus_quantity3 = showNumbers(
			Utils.getCookie('time_n'), back.x + 205, back.y + 5, 'small');
		showBuyAnimation(cart4);
	}
	stage.addChild(cart4);	

	var numArr4 = showNumbers(time_price, cart4.x, cart4.y + 55, true);
	
	/*if (!arr.has(5)) {
		var lock5 = new Sprite(bitmaps.lock_s, 27, 31);
		lock5.setPosition(getStageCenter() + 192, getStageHeightCenter() + 50);
		stage.addChild(lock5);
	}
	
	var cart5 = new Sprite(bitmaps.cart, 36, 37);
	cart5.setPosition(getStageCenter() + 193, getStageHeightCenter() + 85);
	cart5.onclick = function() {
		if (!lock5 && Utils.getCookie('total_score') >= 30000) buyItem('aim');
		showBuyAnimation(cart5);
	}
	stage.addChild(cart5);*/
	
	var back = new Sprite(bitmaps.back_s, 61, 61);
	back.setPosition(getStageCenter() - 210, getStageHeightCenter() - 130);
	back.onmouseup = function() {
		pause = false;
		
		playAnimation();
		
		cart1.destroy = cart2.destroy = cart3.destroy = cart4.destroy = 
			/*cart5.destroy = */back.destroy = true;
		
		if (lock1) lock1.destroy = true;
		if (lock2) lock2.destroy = true;
		if (lock3) lock3.destroy = true;
		if (lock4) lock4.destroy = true;
		//if (lock5) lock5.destroy = true;
		
		if (showShop.bonus_quantity1) showShop.bonus_quantity1.destroy = true;
		if (showShop.bonus_quantity2) showShop.bonus_quantity2.destroy = true;
		if (showShop.bonus_quantity3) showShop.bonus_quantity3.destroy = true;
		if (showShop.bonus_quantity0) showShop.bonus_quantity0.destroy = true;
		
		numArr1.forEach(function(element){element.destroy = true;});
		numArr2.forEach(function(element){element.destroy = true;});
		numArr3.forEach(function(element){element.destroy = true;});
		numArr4.forEach(function(element){element.destroy = true;});
		
		shopBack.destroy = true;
		
		field.showScore();
		
		for (var i = 0; i < 4; i++) {
			var obj = field.bonusFeatures[i];
			if (obj.quantity && obj.quantity.opacity == 0) 
				obj.quantity.opacity = 1;
		}
		
		setBackColor("#311F75");
		buildBackground();
		return false;
	}
	stage.addChild(back);
	
	showShop.back = back;
	
	if (Utils.getCookie('bomb_n') > 0) {
		showShop.bonus_quantity1 = showNumbers(Utils.getCookie('bomb_n'), 
			back.x + 80, back.y + 5, 'small');
	}
	if (Utils.getCookie('rocket_n') > 0) {
		showShop.bonus_quantity2 = showNumbers(Utils.getCookie('rocket_n'), 
			back.x + 122, back.y + 5, 'small');
	}
	if (Utils.getCookie('missile_n') > 0) {
		showShop.bonus_quantity0 = showNumbers(Utils.getCookie('missile_n'), 
			back.x + 165, back.y + 5, 'small');
	}
	if (Utils.getCookie('time_n') > 0) {
		showShop.bonus_quantity3 = showNumbers(Utils.getCookie('time_n'), 
			back.x + 205, back.y + 5, 'small');
	}
}

function showBuyAnimation(spr) {
	spr.scaleX = 0.1;
	spr.scaleY = 0.1;
	
	// Анимация размеров
	// Увеличение
	var interval1 = stage.setInterval(function() {
		spr.scaleX += 0.1;
		spr.scaleY += 0.1;
		if (spr.scaleX >= 1) {
			stage.clearInterval(interval1);
			
			// Уменьшение
			var interval2 = stage.setInterval(function() {
				spr.scaleX -= 0.1;
				spr.scaleY -= 0.1;
				if (spr.scaleX <= 0.7) {
					stage.clearInterval(interval2);
					
					// Снова увелиичение
					var interval3 = stage.setInterval(function() {
						spr.scaleX += 0.1;
						spr.scaleY += 0.1;
						if (spr.scaleX >= 1) {
							spr.scaleX = 1;
							spr.scaleY = 1;
							stage.clearInterval(interval3);
						}
					}, 3);
				}
			}, 3);
	
		}
	}, 3);
	
}

// Остановка анимаций
function stopAnimation() {
	for (var i = 0, j = stage.tweens.length; i < j; i++) {
		if (stage.tweens[i].playing 
			&& stage.tweens[i].obj.isMovingBubble) {
			stage.tweens[i].marked = true;
			stage.tweens[i].pause();
		}
	}
}

// Запуск анимаций
function playAnimation() {
	for (var i = 0, j = stage.tweens.length; i < j; i++) {
		if (stage.tweens[i].marked) {						
			stage.tweens[i].marked = false;
			stage.tweens[i].play();
		}
	}	
}

function showGameOver() {
	field.locked = false;
	pause = true;
	
	var background = new Sprite(bitmaps.gameOver, 
		getStageWidth(), getStageHeight());
	background.setPosition(getStageCenter(), getStageHeightCenter());
	background.static = true;
	stage.addChild(background);
	
	showNumbers(currentLevel, getStageCenter() + 70, 
		getStageHeightCenter() - 35);
	
	showNumbers(field.levelScore, getStageCenter() + 90, 
		getStageHeightCenter() + 37);
		
	var replay = new Sprite(bitmaps.replay, 73, 73);
	replay.setPosition(getStageCenter() + 150, getStageHeightCenter() + 95);
	replay.static = true;
	replay.onmouseup = function() {
		gameState = STATE_GAME;
		createScene();
		return false;
	}	
	stage.addChild(replay);	
	
	var back = new Sprite(bitmaps.back_btn, 73, 73);
	back.setPosition(getStageCenter() - 130, getStageHeightCenter() + 95);
	back.static = true;
	back.onmouseup = function() {
		gameState = STATE_SELECT_LEVEL;
		createScene();
		return false;
	}
	stage.addChild(back);
	
	buildBackground();	
}

function showPauseBack() {
	var background = new Sprite(bitmaps.pause_back, 
		getStageWidth(), getStageHeight());
	background.setPosition(getStageCenter(), getStageHeightCenter());
	stage.addChild(background);	

	var lvl_select = new Sprite(bitmaps.lvl_select, 73, 73);
	lvl_select.setPosition(getStageCenter(), getStageHeightCenter() + 10);
	lvl_select.onmouseup = function() {
		gameState = STATE_SELECT_LEVEL;
		createScene();
		return false;
	}
	stage.addChild(lvl_select);	
	
	var replay = new Sprite(bitmaps.replay, 73, 73);
	replay.setPosition(getStageCenter() + 100, getStageHeightCenter() + 10);
	replay.onmouseup = function() {
		gameState = STATE_GAME;
		createScene();
		return false;
	}	
	stage.addChild(replay);	
	
	var sound = new Sprite(bitmaps.sound_pause, 68, 58, 2);
	sound.setPosition(40, 40);
	if (Utils.getCookie('soundOn') == 1) sound.gotoAndStop(1);
	else sound.gotoAndStop(0);
	sound.state = 1;
	sound.onmouseup = function() {
		if (Utils.getCookie('soundOn') == 1) {
			sound.gotoAndStop(0);
			mixer.play('main_theme', true, false, 0);
			Utils.setCookie('soundOn', 0);
		} else {
			sound.gotoAndStop(1);
			mixer.stop(0);
			Utils.setCookie('soundOn', 1);
		}	
	}
	stage.addChild(sound);
	
	var back = new Sprite(bitmaps.back_btn, 73, 73);
	back.setPosition(getStageCenter() - 100, getStageHeightCenter() + 10);
	back.onmouseup = function() {
		pause = false;

		playAnimation();
		
		sound.destroy = true;
		replay.destroy = true;
		lvl_select.destroy = true;
		background.destroy = true;
		back.destroy = true;
		setBackColor("#311F75");
		return false;
	}
	stage.addChild(back);
}

function showNumbers(text, x, y, n) {
	var font, w, h, arr = [];
		
	switch(n) {
		case 'time':
			font = bitmaps.orange_numbers;
			w = 16;
			h = 34;			
			break;
		
		case 'score_game':
			font = bitmaps.score_numbers;
			w = 17;
			h = 18.7;	
			break;			
		
		case 'small':
			font = bitmaps.white_numbers;
			w = 11;
			h = 12;
			break;
		
		default:
			font = bitmaps.font1;
			w = 17;
			h = 30;
			break;
	}
	
	text += "";
	
	// Для цетровки текста
	x += w * text.length / 2;
	
	for (var i = text.length; i > 0 ; i--) {
		mc = new Sprite(font, w, h, 10);
		mc.gotoAndStop(text.substr(text.length - i, 1));
		mc.x = x - i * w;
		mc.y = y;
		if (!n) mc.static = true;
		
		// Запятая
		if (i < text.length && i % 3 == 0 && n != 'small') {
			var coma = new Sprite(bitmaps.coma, 6, 9);
			coma.setPosition(mc.x - 9, mc.y + 11);
			if (!n) coma.static = true;
			arr.push(coma);
			stage.addChild(coma);
		}
		
		stage.addChild(mc);
		
		arr.push(mc);
		
		if (n == 'score_game' || n == 'score') {
			field.scoreTextArray.push(mc);
			if (coma) field.scoreTextArray.push(coma);
		}
		if (n == 'time') {
			field.timeTextArray.push(mc);
			if (coma) field.timeTextArray.push(coma);
		}
	}
	
	if (arr.length == 1) return mc;
	else return arr;
}

function getLocation(i,j) {
	var x = 15/*20*/ + i * field.dx_shift/*25*/;
	var y = 25 + j * 23;
	if ((j + 1)%2 == 0) x += 10;
	return {x: x, y: y, m_x: i, m_y: j};
}

function getDistance(obj1, obj2) {
	return Math.sqrt((obj2.x - obj1.x) * (obj2.x - obj1.x) 
		+ (obj2.y - obj1.y) * (obj2.y - obj1.y));
}

function setBackColor(color) {
	document.getElementById("screen_background_container").style.background = color;
	document.body.style.background = color;
}

function set_cX() {
	cX = (getStageWidth() - 320)/2;
	return;
}

function loadLevelSettings() {
	field.levelArray = [];
	
	levels[currentLevel - 1].forEach(function(subArray) {
		field.levelArray.push(subArray.concat());
	});
		
	var c = (getStageWidth() - 30/*сдвиг стенки*/ - 20/*от правой стенки*/)/20;

	var d = c;
	field.dx_shift = d;
	
	// Массив для боссов
	var refillArray = [];
	
	for (var i = 0; i < field.levelArray.length; i++) {
		for (var j = 0; j < field.levelArray[i].length; j++) {
			var val = field.levelArray[i][j];
			if (val == 0) continue;
			
			// Загрузка большого босса
			if (typeof val == 'string' && val.indexOf('boss') != -1) {
				var n = val.substring(val.length - 1);
				var boss = new Sprite(bitmaps['boss' + n], 81, 81);
				boss.x = 15/*20*/ + j * d/*25*/;
				boss.y = 25 + i * 23;
				boss.static = true;
				
				if ((i + 1) % 2 == 0) boss.x += 10;
				
				boss.isBoss = true;
				boss.type = n;

				boss.m_x = j;
				boss.m_y = i;
				
				boss.hp = bossHP[currentLevel - 1];
				
				stage.addChild(boss);
				
				// Заполнение ячеек в матрице для босса
				refillArray.push({x: j, y: i, n: n});
				
				continue;
			}			
			
			// Загрузка маленького босса
			if (typeof val == 'string' && val.indexOf('small') != -1) {
				var n = val.substring(val.length - 1);
				var small = new Sprite(bitmaps['small' + n], 48, 42);
				small.x = 15/*20*/ + j * d/*25*/;
				small.y = 25 + i * 23 + 12/*для корректировки*/;
				small.static = true;
				
				if ((i + 1) % 2 == 0) small.x += 10;
				
				small.isBoss = true;
				small.isSmall = true;
				small.type = n;

				small.m_x = j;
				small.m_y = i;
				
				small.hp = bossHP[currentLevel - 1];
				
				stage.addChild(small);
				
				// Заполнение ячеек в матрице для босса
				refillArray.push({x: j, y: i, n: n, isSmall: true});
				
				continue;
			}
			
			// Загрузка обычных рыбок
			var n = field.colorArray.length;
			var rand = field.colorArray[Math.floor(Math.random() * n)];
			
			// Установка параметров для рыбки/звездочки
			var fish = new Sprite(bitmaps['b' + rand], 36, 33);

			fish.x = 15/*20*/ + j * d/*25*/;
			fish.y = 25 + i * 23;
			fish.static = true;
			
			// Сдвиг каждого второго ряда вправо
			if ((i + 1) % 2 == 0) fish.x += 10;
			
			fish.m_x = j;
			fish.m_y = i;
			
			fish.type = rand;
			
			fish.isFish = true;
			stage.addChild(fish);	
			
			// Создание массива для многомерного ряда
			if (levelsRow[currentLevel - 1] != 0) {
				field.levelArray[i][j] = 
					new Array(levelsRow[currentLevel - 1] + 1);				
			} 
		}
	}	
	
	// Заполнение ячеек в матрице для босса
	for (var k = 0; k < refillArray.length; k++) {
		fillBossCells(refillArray[k]);
	}
}

function fillBossCells(obj) {
	var x = obj.x,
		y = obj.y,
		n = obj.n,
		arr = field.levelArray,
		str = (obj.isSmall) ? 'small' + n: 'boss' + n;
	if (!obj.isSmall) {
		arr[y - 1][x] = str;
		arr[y][x - 1] = str;
		arr[y][x + 1] = str;
		arr[y + 1][x] = str;
		
		// Проверка для ряда, сдвинутого вправо
		if (((y + 1) % 2) == 0) {
			arr[y - 1][x + 1] = str;
			arr[y + 1][x + 1] = str;
		} else if (((y + 1) % 2) != 0) {
			arr[y - 1][x - 1] = str;
			arr[y + 1][x - 1] = str;
		}
	} else {
		arr[y + 1][x] = str;
		
		// Проверка для ряда, сдвинутого вправо
		if (((y + 1) % 2) == 0) {
			arr[y + 1][x + 1] = str;
		} else if (((y + 1) % 2) != 0) {
			arr[y + 1][x - 1] = str;
		}
	}
}

function rotateArray(inputArr) {
	var newArr = [];
	for (var i = 0, j = inputArr.length; i < j; i++) {
		for (var k = 0, l = inputArr[i].length; k < l; k++) {
			if (newArr[k] == undefined) newArr[k] = [];
			newArr[k].push(inputArr[i][k]);
		}
	}
	return newArr;
}

function showMoreGames() {
	window.open(MORE_GAMES_URL);
}

function showAnimation(n, x, y, func, zIndex, static) {
	
	var anim = new Sprite(bitmaps['b' + n], 36, 33);
	anim.setPosition(x, y);
	anim.scaleX = 0.1;
	anim.scaleY = 0.1;

	stage.addChild(anim);

	if (zIndex) {
		stage.setZIndex(anim, zIndex);
	}
	
	// Анимация размеров
	// Увеличение
	var interval1 = stage.setInterval(function() {
		anim.scaleX += 0.1;
		anim.scaleY += 0.1;
		if (anim.scaleX >= 1) {
			stage.clearInterval(interval1);
			
			// Уменьшение
			var interval2 = stage.setInterval(function() {
				anim.scaleX -= 0.1;
				anim.scaleY -= 0.1;
				if (anim.scaleX <= 0.7) {
					stage.clearInterval(interval2);
					
					// Снова увелиичение
					var interval3 = stage.setInterval(function() {
						anim.scaleX += 0.1;
						anim.scaleY += 0.1;
						if (anim.scaleX >= 1) {
							anim.scaleX = 1;
							anim.scaleY = 1;
							stage.clearInterval(interval3);
							if (static) {
								anim.static = true;
								buildBackground();
							}
							if (func) func();
						}
					}, 3);
				}
			}, 3);
	
		}
	}, 3);
	
	return anim;
}
var CRENDER_DEBUG=false;function ImagesPreloader()
{var self=this;this.curItem=-1;this.loadedImages={};this.data=null;this.endCallback=null;this.processCallback=null;this.load=function(data,endCallback,processCallback)
{this.data=data;this.endCallback=endCallback;this.processCallback=processCallback;for(var i=0;i<this.data.length;i++)
{var item=this.data[i];var img=new Image();img.src=item.src;this.loadedImages[item.name]=img;}
wait();};function wait()
{var itemsLoaded=0;var itemsTotal=0;for(var key in self.loadedImages)
{if(self.loadedImages[key].complete)itemsLoaded++;itemsTotal++;}
if(itemsLoaded>=itemsTotal)
{if(self.endCallback)self.endCallback(self.loadedImages);return;}
else
{if(self.processCallback)self.processCallback(Math.floor(itemsLoaded/itemsTotal*100));setTimeout(wait,50);}}}
var Utils={touchScreen:("ontouchstart"in window),globalScale:1,setCookie:function(name,value)
{window.localStorage.setItem(name,value);},getCookie:function(name)
{return window.localStorage.getItem(name);},bindEvent:function(el,eventName,eventHandler)
{if(el.addEventListener)
{el.addEventListener(eventName,eventHandler,false);}
else if(el.attachEvent)
{el.attachEvent('on'+eventName,eventHandler);}},getObjectLeft:function(element)
{var result=element.offsetLeft;if(element.offsetParent)result+=Utils.getObjectLeft(element.offsetParent);return result;},getObjectTop:function(element)
{var result=element.offsetTop;if(element.offsetParent)result+=Utils.getObjectTop(element.offsetParent);return result;},parseGet:function()
{var get={};var s=new String(window.location);var p=s.indexOf("?");var tmp,params;if(p!=-1)
{s=s.substr(p+1,s.length);params=s.split("&");for(var i=0;i<params.length;i++)
{tmp=params[i].split("=");get[tmp[0]]=tmp[1];}}
return get;},globalPixelScale:1,getMouseCoord:function(event,object)
{var e=event||window.event;if(e.touches)e=e.touches[0];if(!e)return{x:0,y:0};var x=0;var y=0;var mouseX=0;var mouseY=0;if(object)
{x=Utils.getObjectLeft(object);y=Utils.getObjectTop(object);}
if(e.pageX||e.pageY)
{mouseX=e.pageX;mouseY=e.pageY;}
else if(e.clientX||e.clientY)
{mouseX=e.clientX+(document.documentElement.scrollLeft||document.body.scrollLeft)-document.documentElement.clientLeft;mouseY=e.clientY+(document.documentElement.scrollTop||document.body.scrollTop)-document.documentElement.clientTop;}
var retX=(mouseX-x);var retY=(mouseY-y);return{x:retX,y:retY};},extend:function(Child,Parent)
{var F=function(){};F.prototype=Parent.prototype;Child.prototype=new F();Child.prototype.constructor=Child;Child.superclass=Parent.prototype;},removeFromArray:function(arr,item)
{var tmp=[];for(var i=0;i<arr.length;i++)
{if(arr[i]!=item)tmp.push(arr[i]);}
return tmp;},showLoadProgress:function(val)
{var scl=Utils.globalScale;var s='Loading: '+val+'%';s+='<br><br>';s+='<div style="display: block; background: #000; width: '+(val*scl*2)+'px; height: '+(10*scl)+'px;">&nbsp;</div>';document.getElementById('progress').innerHTML=s;},hideAddressBarLock:false,mobileHideAddressBar:function()
{if(Utils.hideAddressBarLock)return;window.scrollTo(0,1);},mobileCheckIphone4:function()
{if(window.devicePixelRatio)
{if(navigator.userAgent.indexOf('iPhone')!=-1&&window.devicePixelRatio==2)return true;}
return false;},mobileCheckBrokenGalaxyPhones:function()
{if(window.devicePixelRatio)
{if(navigator.userAgent.indexOf('GT-I9300')!=-1||navigator.userAgent.indexOf('GT-I8190')!=-1||navigator.userAgent.indexOf('Android 4.')!=-1)return true;}
return false;},checkSpilgamesEnvironment:function()
{return(typeof ExternalAPI!="undefined"&&ExternalAPI.type=="Spilgames"&&ExternalAPI.check());},mobileCorrectPixelRatio:function()
{var meta=document.createElement('meta');meta.name="viewport";var content="target-densitydpi=device-dpi, user-scalable=0";if(Utils.checkSpilgamesEnvironment())
{if(window.devicePixelRatio>1)content+=", initial-scale=0.5, maximum-scale=0.5, minimum-scale=0.5";else content+=", initial-scale=1, maximum-scale=1, minimum-scale=1";}
else
{if(Utils.mobileCheckIphone4())content+=", initial-scale=0.5, maximum-scale=0.5, minimum-scale=0.5";else content+=", initial-scale=1, maximum-scale=1, minimum-scale=1";}
meta.content=content;document.getElementsByTagName('head')[0].appendChild(meta);},getMobileScreenResolution:function(landscape)
{var scale=1;var w=0;var h=0;var scales=[{scale:1,width:320,height:480},{scale:1.5,width:480,height:720},{scale:2,width:640,height:960}];var container={width:0,height:0};var prop="";if(Utils.touchScreen)
{container.width=Math.min(window.innerWidth,window.innerHeight);container.height=Math.max(window.innerWidth,window.innerHeight);prop="height";}
else
{container.width=window.innerWidth;container.height=window.innerHeight;prop="height";}
var min=Number.MAX_VALUE;for(var i=0;i<scales.length;i++)
{var diff=Math.abs(container[prop]-scales[i][prop]);if(min>diff)
{min=diff;scale=scales[i].scale;}}
return Utils.getScaleScreenResolution(scale,landscape);},getScaleScreenResolution:function(scale,landscape)
{var w,h;w=Math.round(320*scale);h=Math.round(480*scale);if(landscape)
{var tmp=w;w=h;h=tmp;}
return{width:w,height:h,scale:scale};},imagesRoot:'images',createLayout:function(container,resolution)
{var scl=Utils.globalScale;var height=window.innerHeight;if("orientation"in window)height=2048;else document.body.style.overflow="hidden";var s="";s+='<div id="progress_container" align="center" style="width: 100%; height: '+height+'px; display: block; width: 100%; position: absolute; left: 0px; top: 0px;">';s+='<table cellspacing="0" cellpadding="0"><tr><td id="progress" align="center" valign="middle" style="width: '+resolution.width+'px; height: '+resolution.height+'px; color: #000; background: #fff; font-weight: bold; font-family: Verdana; font-size: '+(12*scl)+'px; vertical-align: middle;"></td></tr></table>';s+='</div>';s+='<div id="screen_background_container" align="center" style="width: 100%; height: '+height+'px; position: absolute; left: 0px; top: 0px; display: none; z-index: 2;">'
s+='<div id="screen_background_wrapper" style="width: '+resolution.width+'px; height: '+resolution.height+'px; overflow: hidden; position: relative;">';s+='<canvas id="screen_background" width="'+resolution.width+'" height="'+resolution.height+'"></canvas>';s+='</div>';s+='</div>';s+='<div id="screen_container" align="center" style="width: 100%; height: '+height+'px; position: absolute; left: 0px; top: 0px; display: none; z-index: 3;">';s+='<div id="screen_wrapper" style="width: '+resolution.width+'px; height: '+resolution.height+'px; overflow: hidden; position: relative;">';s+='<canvas id="screen" style="position: absolute; left: 0px; top: 0px; z-index: 1000000;" width="'+resolution.width+'" height="'+resolution.height+'">You browser does not support this application :(</canvas>';s+='</div>';s+='</div>';container.innerHTML=s;var p=document.createElement("div");p.setAttribute("id","p2l_container");p.setAttribute("align","center");var w=resolution.width;p.setAttribute("style","width: 100%; height: "+height+"px; position: absolute; left: 0px; top: 0px; display: none; z-index: 1000; background: #fff;");p.innerHTML='<img id="p2l" src="'+Utils.imagesRoot+'/p2l.jpg" style="padding-top: '+((w-240)/2)+'px" />';document.body.appendChild(p);},preventEvent:function(e)
{e.preventDefault();e.stopPropagation();e.cancelBubble=true;e.returnValue=false;return false;},addMobileListeners:function(landscape)
{Utils.bindEvent(document.body,"touchstart",Utils.preventEvent);Utils.bindEvent(window,"scroll",function(e)
{setTimeout(Utils.mobileHideAddressBar,300);});setInterval("Utils.checkOrientation("+(landscape?"true":"false")+")",500);setTimeout(Utils.mobileHideAddressBar,500);},storeOrient:null,checkOrientation:function(landscape)
{if(!Utils.touchScreen)return;if(!document.getElementById('screen_container'))return;var getParams=Utils.parseGet();if(getParams.nocheckorient==1)return;var orient=false;if(window==window.parent)
{orient=(window.innerWidth>window.innerHeight);}
else
{var longSide=Math.max(screen.width,screen.height);var shortSide=Math.min(screen.width,screen.height);var lc=Math.abs(window.innerWidth-longSide);var sc=Math.abs(window.innerWidth-shortSide);orient=(lc<sc);}
if(Utils.storeOrient===orient)return;Utils.storeOrient=orient;var ok=(orient==landscape);if(!ok)
{Utils.dispatchEvent("lockscreen");document.getElementById('p2l_container').style.display='block';document.getElementById('screen_background_container').style.display='none';document.getElementById('screen_container').style.display='none';}
else
{Utils.dispatchEvent("unlockscreen");document.getElementById('p2l_container').style.display='none';document.getElementById('screen_background_container').style.display='block';document.getElementById('screen_container').style.display='block';}
if(Utils.checkSpilgamesEnvironment())document.getElementById('p2l_container').style.display='none';setTimeout(Utils.mobileHideAddressBar,50);setTimeout(Utils.fitLayoutToScreen,100);},fitLayoutTimer:null,addFitLayoutListeners:function()
{Utils.fitLayoutTimer=setInterval(Utils.fitLayoutToScreen,500);},removeFitLayoutListeners:function()
{clearInterval(Utils.fitLayoutTimer);},fitLayoutLock:false,fitLayoutCorrectHeight:0,fitLayoutToScreen:function(container)
{if(Utils.fitLayoutLock)return;var p,s,width,height;if(typeof container!="object"||!container.width)
{width=window.innerWidth;height=window.innerHeight;if(Utils.checkSpilgamesEnvironment())height-=25;height+=Utils.fitLayoutCorrectHeight;container={width:width,height:height};}
s=document.getElementById("screen");if(!s)return;if(!s.initWidth)
{s.initWidth=s.width;s.initHeight=s.height;}
width=s.initWidth;height=s.initHeight;var scale=1;var scaleX=container.width/width;var scaleY=container.height/height;scale=(scaleX<scaleY?scaleX:scaleY);Utils.globalPixelScale=scale;width=Math.floor(width*scale);height=Math.floor(height*scale);if(s.lastWidth==width&&s.lastHeight==height)return;s.lastWidth=width;s.lastHeight=height;Utils.resizeElement("screen",width,height);Utils.resizeElement("screen_background",width,height);s=document.getElementById("progress");if(s)
{s.style.width=(~~width)+"px";s.style.height=(~~height)+"px";}
s=document.getElementById("screen_wrapper");if(s)
{s.style.width=(~~width)+"px";s.style.height=(~~height)+"px";}
s=document.getElementById("screen_background_wrapper");if(s)
{s.style.width=(~~width)+"px";s.style.height=(~~height)+"px";}
s=document.getElementById("p2l_container");if(s)
{s.style.width=(~~window.innerWidth)+"px";s.style.height="2048px";}
Utils.dispatchEvent("fitlayout");setTimeout(Utils.mobileHideAddressBar,50);},resizeElement:function(id,width,height)
{var s=document.getElementById(id);if(!s)return;s.setAttribute("width",width);s.setAttribute("height",height);},drawIphoneLimiter:function(stage,landscape)
{if(landscape)stage.drawRectangle(240,295,480,54,"#f00",true,0.5,true);else stage.drawRectangle(160,448,320,64,"#f00",true,0.5,true);},drawGrid:function(stage,landscape,col)
{if(typeof landscape=='undefined')landscape=false;var dx=10;var dy=10;if(typeof col=='undefined')col='#FFF';var w=1/Utils.globalScale/Utils.globalPixelScale;var s={w:(landscape?480:320),h:(landscape?320:480)}
for(var x=dx;x<s.w;x+=dx)
{var o=0.1+0.1*(((x-dx)/dx)%10);stage.drawLine(x,0,x,s.h,w,col,o);}
for(var y=dy;y<s.h;y+=dy)
{var o=0.1+0.1*(((y-dy)/dy)%10);stage.drawLine(0,y,s.w,y,w,col,o);}},drawScaleFix:function(stage,landscape)
{if(Utils.globalScale==0.75)
{if(landscape)stage.drawRectangle(507,160,54,320,"#000",true,1,true);else stage.drawRectangle(160,507,320,54,"#000",true,1,true);}
if(Utils.globalScale==1.5)
{if(landscape)stage.drawRectangle(510,160,60,320,"#000",true,1,true);else stage.drawRectangle(160,510,320,60,"#000",true,1,true);}},grad2radian:function(val)
{return val/(180/Math.PI);},radian2grad:function(val)
{return val*(180/Math.PI);},eventsListeners:[],onlockscreen:null,onunlockscreen:null,onfitlayout:null,addEventListener:function(type,callback)
{EventsManager.addEvent(Utils,type,callback);},removeEventListener:function(type,callback)
{EventsManager.removeEvent(Utils,type,callback);},dispatchEvent:function(type,params)
{return EventsManager.dispatchEvent(Utils,type,params);}}
var EventsManager={addEvent:function(obj,type,callback)
{if(!obj.eventsListeners)return;for(var i=0;i<obj.eventsListeners.length;i++)
{if(obj.eventsListeners[i].type===type&&obj.eventsListeners[i].callback===callback)return;}
obj.eventsListeners.push({type:type,callback:callback});},removeEvent:function(obj,type,callback)
{if(!obj.eventsListeners)return;for(var i=0;i<obj.eventsListeners.length;i++)
{if(obj.eventsListeners[i].type===type&&obj.eventsListeners[i].callback===callback)
{obj.eventsListeners=Utils.removeFromArray(obj.eventsListeners,obj.eventsListeners[i]);return;}}},dispatchEvent:function(obj,type,params)
{if(!obj.eventsListeners)return;var ret;if(typeof obj["on"+type]=="function")
{ret=obj["on"+type](params);if(ret===false)return false;}
for(var i=0;i<obj.eventsListeners.length;i++)
{if(obj.eventsListeners[i].type===type)
{ret=obj.eventsListeners[i].callback(params);if(ret===false)return false;}}}}
var ANCHOR_ALIGN_LEFT=-1;var ANCHOR_ALIGN_CENTER=0;var ANCHOR_ALIGN_RIGHT=1;var ANCHOR_VALIGN_TOP=-1;var ANCHOR_VALIGN_MIDDLE=0;var ANCHOR_VALIGN_BOTTOM=1;function Sprite(img,w,h,f,l)
{this.uid=0;this.stage=null;this.x=0;this.y=0;this.width=w;this.height=h;this.offset={left:0,top:0};this.anchor={x:0,y:0}
this.scaleX=1;this.scaleY=1;this.rotation=0;this.zIndex=0;this.visible=true;this.opacity=1;this['static']=false;this.ignoreViewport=false;this.animated=true;this.currentFrame=0;this.totalFrames=Math.max(1,~~f);if(this.totalFrames<=1)this.animated=false;this.currentLayer=0;this.totalLayers=Math.max(1,~~l);this.bitmap=img;this.mask=null;this.fillColor=false;this.destroy=false;this.animStep=0;this.animDelay=1;this.drawAlways=false;this.dragged=false;this.dragX=0;this.dragY=0;this.getX=function()
{return Math.round(this.x*Utils.globalScale);};this.getY=function()
{return Math.round(this.y*Utils.globalScale);};this.getWidth=function()
{return this.width*Math.abs(this.scaleX)*Utils.globalScale;};this.getHeight=function()
{return this.height*Math.abs(this.scaleY)*Utils.globalScale;};this.startDrag=function(x,y)
{this.dragged=true;this.dragX=x;this.dragY=y;}
this.stopDrag=function()
{this.dragged=false;this.dragX=0;this.dragY=0;}
this.play=function()
{this.animated=true;};this.stop=function()
{this.animated=false;};this.gotoAndStop=function(frame)
{this.currentFrame=frame;this.stop();};this.gotoAndPlay=function(frame)
{this.currentFrame=frame;this.play();};this.removeTweens=function()
{if(!this.stage)return;this.stage.clearObjectTweens(this);};this.addTween=function(prop,end,duration,ease,onfinish,onchange)
{if(!this.stage)return;var val=this[prop];if(isNaN(val))return;var t=stage.createTween(this,prop,val,end,duration,ease);t.onchange=onchange;t.onfinish=onfinish;return t;};this.moveTo=function(x,y,duration,ease,onfinish,onchange)
{duration=~~duration;if(duration<=0)
{this.setPosition(x,y);}
else
{var t1=this.addTween('x',x,duration,ease,onfinish,onchange);if(t1)t1.play();var t2=this.addTween('y',y,duration,ease,(t1?null:onfinish),(t1?null:onchange));if(t2)t2.play();}
return this;}
this.moveBy=function(x,y,duration,ease,onfinish,onchange)
{return this.moveTo(this.x+x,this.y+y,duration,ease,onfinish,onchange);}
this.fadeTo=function(opacity,duration,ease,onfinish,onchange)
{duration=~~duration;if(duration<=0)
{this.opacity=opacity;}
else
{var t=this.addTween('opacity',opacity,duration,ease,onfinish,onchange);if(t)t.play();}
return this;}
this.fadeBy=function(opacity,duration,ease,onfinish,onchange)
{var val=Math.max(0,Math.min(1,this.opacity+opacity));return this.fadeTo(val,duration,ease,onfinish,onchange);}
this.rotateTo=function(rotation,duration,ease,onfinish,onchange)
{duration=~~duration;if(duration<=0)
{this.rotation=rotation;}
else
{var t=this.addTween('rotation',rotation,duration,ease,onfinish,onchange);if(t)t.play();}
return this;}
this.rotateBy=function(rotation,duration,ease,onfinish,onchange)
{return this.rotateTo(this.rotation+rotation,duration,ease,onfinish,onchange);}
this.scaleTo=function(scale,duration,ease,onfinish,onchange)
{duration=~~duration;if(duration<=0)
{this.scaleX=this.scaleY=scale;}
else
{var t1=this.addTween('scaleX',scale,duration,ease,onfinish,onchange);if(t1)t1.play();var t2=this.addTween('scaleY',scale,duration,ease,(t1?null:onfinish),(t1?null:onchange));if(t2)t2.play();}
return this;}
this.nextFrame=function()
{this.dispatchEvent("enterframe",{target:this});if(!this.history.created)this.updateHistory();if(!this.animated)return;this.animStep++;if(this.animStep>=this.animDelay)
{this.currentFrame++;this.animStep=0;}
if(this.currentFrame>=this.totalFrames)this.currentFrame=0;};this.updateHistory=function()
{this.history.x=this.getX();this.history.y=this.getY();this.history.rotation=this.rotation;this.history.frame=this.currentFrame;var rect=new Rectangle(this.history.x,this.history.y,this.getWidth(),this.getHeight(),this.rotation);rect.AABB[0].x-=1;rect.AABB[0].y-=1;rect.AABB[1].x+=1;rect.AABB[1].y+=1;this.history.AABB=rect.AABB;this.history.created=true;this.history.changed=false;};this.history={created:false,drawed:false,changed:false,x:0,y:0,rotation:0,frame:0,AABB:[]};this.eventsWhenInvisible=false;this.onmouseover=null;this.onmouseout=null;this.onmousedown=null;this.onmouseup=null;this.onclick=null;this.oncontextmenu=null;this.onmousemove=null;this.onenterframe=null;this.onrender=null;this.onadd=null;this.onremove=null;this.onbox2dsync=null;this.mouseOn=false;this.getPosition=function()
{return{x:this.x+0,y:this.y+0}}
this.setPosition=function(x,y)
{if((typeof y=='undefined')&&(typeof x['x']!='undefined')&&(typeof x['y']!='undefined'))
{return this.setPosition(x.x,x.y);}
this.x=parseFloat(x);this.y=parseFloat(y);}
this.getAnchor=function()
{return new Vector(this.anchor.x,this.anchor.y);}
this.setAnchor=function(x,y)
{if((typeof y=='undefined')&&(typeof x['x']!='undefined')&&(typeof x['y']!='undefined'))
{return this.setAnchor(x.x,x.y);}
this.anchor.x=parseFloat(x);this.anchor.y=parseFloat(y);}
this.alignAnchor=function(h,v)
{h=parseInt(h);if(isNaN(h))h=ANCHOR_ALIGN_CENTER;if(h<0)h=ANCHOR_ALIGN_LEFT;if(h>0)h=ANCHOR_ALIGN_RIGHT;v=parseInt(v);if(isNaN(v))v=ANCHOR_VALIGN_MIDDLE;if(v<0)v=ANCHOR_VALIGN_TOP;if(v>0)v=ANCHOR_VALIGN_BOTTOM;var anchor=new Vector(this.width*h/2,this.height*v/2).add(this.getPosition());this.setAnchor(anchor.x,anchor.y);return this.getAnchor();}
this.getAbsoluteAnchor=function()
{return new Vector(this.x,this.y);}
this.getRelativeCenter=function()
{var a=this.getAnchor();var c=new Vector(-this.anchor.x*this.scaleX,-this.anchor.y*this.scaleY);c.rotate(-this.rotation);return c;}
this.getAbsoluteCenter=function()
{return this.getRelativeCenter().add(this.getPosition());}
this.getCenter=function()
{return this.getAbsoluteCenter();}
this.getDrawRectangle=function()
{var c=this.getCenter(),r=new Rectangle(0,0,this.width*Math.abs(this.scaleX),this.height*Math.abs(this.scaleY),this.rotation);r.move(c.x,c.y);return r;}
this.getAABBRectangle=function()
{var r=this.getDrawRectangle(),w=r.AABB[1].x-r.AABB[0].x,h=r.AABB[1].y-r.AABB[0].y;return new Rectangle(r.AABB[0].x+(w/2),r.AABB[0].y+(h/2),w,h,0);}
this.localToGlobal=function(x,y)
{var p=((typeof x=='object')&&(typeof x['x']!='undefined')&&(typeof x['y']!='undefined'))?new Vector(x.x+0,x.y+0):new Vector(x,y);p.rotate(this.rotation).add(this.getPosition());return p;}
this.globalToLocal=function(x,y)
{var p=((typeof x=='object')&&(typeof x['x']!='undefined')&&(typeof x['y']!='undefined'))?new Vector(x.x+0,x.y+0):new Vector(x,y);p.subtract(this.getPosition()).rotate(-this.rotation);return p;}
this.allowDebugDrawing=true;this.debugDraw=function()
{if(!this.visible)return;if(!this.allowDebugDrawing)return;var a=this.getPosition(),c=this.getCenter(),r=this.getDrawRectangle(),aabb=this.getAABBRectangle();stage.drawCircle(a.x,a.y,1,1,'rgba(255,0,0,0.9)');stage.drawCircle(c.x,c.y,1,1,'rgba(0,255,0,0.9)');stage.drawLine(a.x,a.y,c.x,c.y,1,'rgba(255,255,255,0.5)');stage.drawPolygon(r.vertices,0.5,'rgba(255,0,255,0.5)',1);stage.drawLine(aabb.vertices[0].x,aabb.vertices[0].y,aabb.vertices[2].x,aabb.vertices[2].y,0.1,'rgba(255,255,255,0.5)');stage.drawLine(aabb.vertices[2].x,aabb.vertices[0].y,aabb.vertices[0].x,aabb.vertices[2].y,0.1,'rgba(255,255,255,0.5)');stage.drawPolygon(aabb.vertices,0.5,'rgba(255,255,255,0.5)');}
this.setZIndex=function(z)
{this.zIndex=~~z;if(!this.stage)return;this.stage.setZIndex(this,~~z);}
this.eventsListeners=[];this.addEventListener=function(type,callback)
{EventsManager.addEvent(this,type,callback);}
this.removeEventListener=function(type,callback)
{EventsManager.removeEvent(this,type,callback);}
this.dispatchEvent=function(type,params)
{return EventsManager.dispatchEvent(this,type,params);}
this.hitTestPoint=function(x,y,checkPixel,checkDragged,debug)
{if(!this.stage)
return false;return this.stage.hitTestPointObject(this,x,y,checkPixel,checkDragged,debug);}}
function Tween(obj,prop,start,end,duration,callback)
{var self=this;if(typeof obj!='object')obj=null;if(obj)
{if(typeof obj[prop]=='undefined')throw new Error('Trying to tween undefined property "'+prop+'"');if(isNaN(obj[prop]))throw new Error('Tweened value can not be '+(typeof obj[prop]));}
else
{if(isNaN(prop))throw new Error('Tweened value can not be '+(typeof prop));}
if(typeof callback!='function')callback=Easing.linear.easeIn;this.obj=obj;this.prop=prop;this.onchange=null;this.onfinish=null;this.start=start;this.end=end;this.duration=~~duration;this.callback=callback;this.playing=false;this._pos=-1;this.play=function()
{self.playing=true;self.tick();}
this.pause=function()
{self.playing=false;}
this.rewind=function()
{self._pos=-1;}
this.forward=function()
{self._pos=this.duration;}
this.stop=function()
{self.pause();self.rewind();}
this.updateValue=function(val)
{if(self.obj)
{self.obj[self.prop]=val;}
else
{self.prop=val;}}
this.tick=function()
{if(!self.playing)return false;self._pos++;if(self._pos<0)return false;if(self._pos>self.duration)return self.finish();var func=self.callback;var val=func(self._pos,self.start,self.end-self.start,self.duration);this.updateValue(val);self.dispatchEvent("change",{target:self,value:val});return false;}
this.finish=function()
{self.stop();self.updateValue(self.end);return self.dispatchEvent("finish",{target:self,value:self.end});}
this.eventsListeners=[];this.addEventListener=function(type,callback)
{EventsManager.addEvent(this,type,callback);}
this.removeEventListener=function(type,callback)
{EventsManager.removeEvent(this,type,callback);}
this.dispatchEvent=function(type,params)
{return EventsManager.dispatchEvent(this,type,params);}}
var Easing={back:{easeIn:function(t,b,c,d)
{var s=1.70158;return c*(t/=d)*t*((s+1)*t-s)+b;},easeOut:function(t,b,c,d)
{var s=1.70158;return c*((t=t/d-1)*t*((s+1)*t+s)+1)+b;},easeInOut:function(t,b,c,d)
{var s=1.70158;if((t/=d/2)<1)return c/2*(t*t*(((s*=(1.525))+1)*t-s))+b;return c/2*((t-=2)*t*(((s*=(1.525))+1)*t+s)+2)+b;}},bounce:{easeIn:function(t,b,c,d)
{return c-Easing.bounce.easeOut(d-t,0,c,d)+b;},easeOut:function(t,b,c,d)
{if((t/=d)<(1/2.75))return c*(7.5625*t*t)+b;else if(t<(2/2.75))return c*(7.5625*(t-=(1.5/2.75))*t+0.75)+b;else if(t<(2.5/2.75))return c*(7.5625*(t-=(2.25/2.75))*t+0.9375)+b;else return c*(7.5625*(t-=(2.625/2.75))*t+0.984375)+b;},easeInOut:function(t,b,c,d)
{if(t<d/2)return Easing.bounce.easeIn(t*2,0,c,d)*0.5+b;else return Easing.bounce.easeOut(t*2-d,0,c,d)*0.5+c*0.5+b;}},circular:{easeIn:function(t,b,c,d)
{return-c*(Math.sqrt(1-(t/=d)*t)-1)+b;},easeOut:function(t,b,c,d)
{return c*Math.sqrt(1-(t=t/d-1)*t)+b;},easeInOut:function(t,b,c,d)
{if((t/=d/2)<1)return-c/2*(Math.sqrt(1-t*t)-1)+b;return c/2*(Math.sqrt(1-(t-=2)*t)+1)+b;}},cubic:{easeIn:function(t,b,c,d)
{return c*(t/=d)*t*t+b;},easeOut:function(t,b,c,d)
{return c*((t=t/d-1)*t*t+1)+b;},easeInOut:function(t,b,c,d)
{if((t/=d/2)<1)return c/2*t*t*t+b;return c/2*((t-=2)*t*t+2)+b;}},exponential:{easeIn:function(t,b,c,d)
{return t==0?b:c*Math.pow(2,10*(t/d-1))+b;},easeOut:function(t,b,c,d)
{return t==d?b+c:c*(-Math.pow(2,-10*t/d)+1)+b;},easeInOut:function(t,b,c,d)
{if(t==0)return b;if(t==d)return b+c;if((t/=d/2)<1)return c/2*Math.pow(2,10*(t-1))+b;return c/2*(-Math.pow(2,-10*--t)+2)+b;}},linear:{easeIn:function(t,b,c,d)
{return c*t/d+b;},easeOut:function(t,b,c,d)
{return c*t/d+b;},easeInOut:function(t,b,c,d)
{return c*t/d+b;}},quadratic:{easeIn:function(t,b,c,d)
{return c*(t/=d)*t+b;},easeOut:function(t,b,c,d)
{return-c*(t/=d)*(t-2)+b;},easeInOut:function(t,b,c,d)
{if((t/=d/2)<1)return c/2*t*t+b;return-c/2*((--t)*(t-2)-1)+b;}},quartic:{easeIn:function(t,b,c,d)
{return c*(t/=d)*t*t*t+b;},easeOut:function(t,b,c,d)
{return-c*((t=t/d-1)*t*t*t-1)+b;},easeInOut:function(t,b,c,d)
{if((t/=d/2)<1)return c/2*t*t*t*t+b;return-c/2*((t-=2)*t*t*t-2)+b;}},quintic:{easeIn:function(t,b,c,d)
{return c*(t/=d)*t*t*t*t+b;},easeOut:function(t,b,c,d)
{return c*((t=t/d-1)*t*t*t*t+1)+b;},easeInOut:function(t,b,c,d)
{if((t/=d/2)<1)return c/2*t*t*t*t*t+b;return c/2*((t-=2)*t*t*t*t+2)+b;}},sine:{easeIn:function(t,b,c,d)
{return-c*Math.cos(t/d*(Math.PI/2))+c+b;},easeOut:function(t,b,c,d)
{return c*Math.sin(t/d*(Math.PI/2))+b;},easeInOut:function(t,b,c,d)
{return-c/2*(Math.cos(Math.PI*t/d)-1)+b;}}}
function StageTimer(callback,timeout,repeat)
{this.repeat=repeat;this.initialTimeout=timeout;this.timeout=timeout;this.callback=callback;this.paused=false;this.update=function()
{if(this.paused)return;this.timeout--;if(this.timeout==0)
{if(typeof this.callback=="function")this.callback();if(typeof this.callback=="string")eval(this.callback);if(this.repeat)this.timeout=this.initialTimeout;else return true;}
return false;};this.resume=function()
{this.paused=false;};this.pause=function()
{this.paused=true;};}
function Stage(cnsId,w,h)
{var self=this;this.canvas=document.getElementById(cnsId);this.canvas.renderController=this;this.canvas.ctx=this.canvas.getContext('2d');this.backBuffer=null;this.screenWidth=w;this.screenHeight=h;this.viewport={x:0,y:0};this.objects=[];this.objectsCounter=0;this.buffer=document.createElement('canvas');this.buffer.width=w*Utils.globalScale;this.buffer.height=h*Utils.globalScale;this.buffer.ctx=this.buffer.getContext('2d');this.delay=40;this.fillColor=false;this.started=false;this.fps=0;this.lastFPS=0;this.showFPS=false;this.pixelClickEvent=false;this.pixelMouseUpEvent=false;this.pixelMouseDownEvent=false;this.pixelMouseMoveEvent=false;this.ceilSizes=false;this.tmMain
this.tmFPS
this.partialUpdate=false;this.clearLock=false;this.destroy=function()
{clearTimeout(this.tmMain);clearTimeout(this.tmFPS);this.stop();this.clear();this.clearScreen(this.canvas);}
this.clearScreen=function(canvas)
{canvas.ctx.clearRect(0,0,this.screenWidth*Utils.globalScale*Utils.globalPixelScale,this.screenHeight*Utils.globalScale*Utils.globalPixelScale);}
this.findMaxZIndex=function()
{var max=-1;var ix=false;for(var i=0;i<this.objects.length;i++)
{if(this.objects[i].zIndex>max)
{max=this.objects[i].zIndex;ix=i;}}
return{index:ix,zIndex:max};};this.findMinZIndex=function()
{var min=-1;var ix=false;for(var i=0;i<this.objects.length;i++)
{if(i==0)
{min=this.objects[i].zIndex;ix=0;}
if(this.objects[i].zIndex<min)
{min=this.objects[i].zIndex;ix=i;}}
return{index:ix,zIndex:min};};this.addChild=function(item)
{var f=this.findMaxZIndex();var z=item.zIndex;if(f.index!==false)item.zIndex=f.zIndex+1;else item.zIndex=0;this.objectsCounter++;item.uid=this.objectsCounter;item.stage=this;this.objects.push(item);if(z!=0)
{this.setZIndex(item,~~z);}
item.dispatchEvent("add",{target:item});return item;};this.removeChild=function(item)
{if(item)
{this.clearObjectTweens(item);item.dispatchEvent("remove",{target:item});item.stage=null;this.objects=Utils.removeFromArray(this.objects,item);}};this.setZIndex=function(item,index)
{var bSort=true;var i,tmp;item.zIndex=index;while(bSort)
{bSort=false;for(i=0;i<this.objects.length-1;i++)
{if(this.objects[i].zIndex>this.objects[i+1].zIndex)
{tmp=this.objects[i];this.objects[i]=this.objects[i+1];this.objects[i+1]=tmp;bSort=true;}}}}
this.hitTestPointObject=function(obj,x,y,pixelCheck,includeDragged,debug)
{var cX,cY,cW,cH,mX,mY,r,present,imageData;cW=obj.width*Math.abs(obj.scaleX);cH=obj.height*Math.abs(obj.scaleY);cX=obj.x-cW/2;cY=obj.y-cH/2;mX=x;mY=y;if(!obj.ignoreViewport)
{mX+=this.viewport.x;mY+=this.viewport.y;}
present=false;if(obj.rotation==0)
{if(cX<=mX&&cY<=mY&&cX+cW>=mX&&cY+cH>=mY)present=true;}
else
{r=obj.getDrawRectangle();if(r.hitTestPoint(new Vector(mX,mY)))present=true;}
if(present&&pixelCheck)
{this.buffer.width=this.screenWidth*Utils.globalScale*Utils.globalPixelScale;this.buffer.height=this.screenHeight*Utils.globalScale*Utils.globalPixelScale;this.clearScreen(this.buffer);this.renderObject(this.buffer,obj);var pX=Math.floor(x*Utils.globalScale*Utils.globalPixelScale);var pY=Math.floor(y*Utils.globalScale*Utils.globalPixelScale);imageData=this.buffer.ctx.getImageData(pX,pY,1,1);if(imageData.data[3]==0)present=false;}
if(!present&&includeDragged&&obj.dragged)present=true;return present;}
this.getObjectsStackByCoord=function(x,y,pixelCheck,includeDragged,debug)
{var obj;var tmp=[];for(var i=0;i<this.objects.length;i++)
{if(this.objects[i].visible||this.objects[i].eventsWhenInvisible)
{obj=this.objects[i];if(this.hitTestPointObject(obj,x,y,pixelCheck,includeDragged,debug))
{tmp.push(obj);}}}
return tmp;};this.getMaxZIndexInStack=function(stack)
{var max=-1;var ix=0;for(var i=0;i<stack.length;i++)
{if(stack[i].zIndex>max)
{max=stack[i].zIndex;ix=i;}}
return ix;};this.sortStack=function(stack,revert)
{var bSort=true;var ok;var i,tmp;while(bSort)
{bSort=false;for(i=0;i<stack.length-1;i++)
{ok=false;if(stack[i].zIndex<stack[i+1].zIndex&&!revert)ok=true;if(stack[i].zIndex>stack[i+1].zIndex&&revert)ok=true;if(ok)
{tmp=stack[i];stack[i]=stack[i+1];stack[i+1]=tmp;bSort=true;}}}
return stack;}
this.finalizeMouseCoords=function(obj,m)
{if(!obj)return m;var eX=this.prepareMouseCoord(m.x);var eY=this.prepareMouseCoord(m.y);if(!obj.ignoreViewport)
{eX+=this.viewport.x;eY+=this.viewport.y;}
eX=eX-obj.x;eY=eY-obj.y;return{x:eX,y:eY};}
this.prepareMouseCoord=function(val)
{return val/Utils.globalScale/Utils.globalPixelScale;}
this.checkClick=function(event)
{var m=Utils.getMouseCoord(event,this.canvas);var stack=this.getObjectsStackByCoord(this.prepareMouseCoord(m.x),this.prepareMouseCoord(m.y),this.pixelClickEvent,false,true);var ret,f;if(stack.length>0)
{stack=this.sortStack(stack);for(var i=0;i<stack.length;i++)
{f=this.finalizeMouseCoords(stack[i],m);ret=stack[i].dispatchEvent("click",{target:stack[i],x:f.x,y:f.y});if(ret===false)return;}}};this.checkContextMenu=function(event)
{var m=Utils.getMouseCoord(event,this.canvas);var stack=this.getObjectsStackByCoord(this.prepareMouseCoord(m.x),this.prepareMouseCoord(m.y),this.pixelClickEvent);var ret,f;if(stack.length>0)
{stack=this.sortStack(stack);for(var i=0;i<stack.length;i++)
{f=this.finalizeMouseCoords(stack[i],m);ret=stack[i].dispatchEvent("contextmenu",{target:stack[i],x:f.x,y:f.y});if(ret===false)return;}}};this.checkMouseMove=function(event)
{var m=Utils.getMouseCoord(event,this.canvas);for(i=0;i<this.objects.length;i++)
{if(this.objects[i].dragged)
{var eX=m.x/Utils.globalScale/Utils.globalPixelScale;var eY=m.y/Utils.globalScale/Utils.globalPixelScale;if(!this.objects[i].ignoreViewport)
{eX+=this.viewport.x;eY+=this.viewport.y;}
this.objects[i].x=eX-this.objects[i].dragX;this.objects[i].y=eY-this.objects[i].dragY;}}
var stack=this.getObjectsStackByCoord(this.prepareMouseCoord(m.x),this.prepareMouseCoord(m.y),this.pixelMouseMoveEvent);var i,n,ret,bOk,f;var overStack=[];if(stack.length>0)
{stack=this.sortStack(stack);for(i=0;i<stack.length;i++)
{overStack.push(stack[i]);f=this.finalizeMouseCoords(stack[i],m);if(!stack[i].mouseOn)ret=stack[i].dispatchEvent("mouseover",{target:stack[i],x:f.x,y:f.y});stack[i].mouseOn=true;if(ret===false)break;}
for(i=0;i<stack.length;i++)
{f=this.finalizeMouseCoords(stack[i],m);ret=stack[i].dispatchEvent("mousemove",{target:stack[i],x:f.x,y:f.y});if(ret===false)break;}}
for(i=0;i<this.objects.length;i++)
{if(this.objects[i].mouseOn)
{bOk=false;for(n=0;n<overStack.length;n++)
{if(overStack[n]==this.objects[i])bOk=true;}
if(!bOk)
{this.objects[i].mouseOn=false;f=this.finalizeMouseCoords(stack[i],m);ret=this.objects[i].dispatchEvent("mouseout",{target:this.objects[i],x:f.x,y:f.y});if(ret===false)break;}}}};this.checkMouseDown=function(event)
{var m=Utils.getMouseCoord(event,this.canvas);var stack=this.getObjectsStackByCoord(this.prepareMouseCoord(m.x),this.prepareMouseCoord(m.y),this.pixelMouseDownEvent);var ret,f;if(stack.length>0)
{stack=this.sortStack(stack);for(var i=0;i<stack.length;i++)
{f=this.finalizeMouseCoords(stack[i],m);ret=stack[i].dispatchEvent("mousedown",{target:stack[i],x:f.x,y:f.y});if(ret===false)return;}}};this.checkMouseUp=function(event)
{var m=Utils.getMouseCoord(event,this.canvas);var stack=this.getObjectsStackByCoord(this.prepareMouseCoord(m.x),this.prepareMouseCoord(m.y),this.pixelMouseUpEvent,true);var ret,f;if(stack.length>0)
{stack=this.sortStack(stack);for(var i=0;i<stack.length;i++)
{f=this.finalizeMouseCoords(stack[i],m);ret=stack[i].dispatchEvent("mouseup",{target:stack[i],x:f.x,y:f.y});if(ret===false)return;}}};this.clear=function()
{for(var i=0;i<this.objects.length;i++)
{this.objects[i].dispatchEvent("remove",{target:this.objects[i]});}
this.objects=[];this.tweens=[];this.timers=[];this.eventsListeners=[];this.objectsCounter=0;};this.hitTest=function(obj1,obj2)
{if(obj1.rotation==0&&obj2.rotation==0)
{var cX1=obj1.getX()-obj1.getWidth()/2;var cY1=obj1.getY()-obj1.getHeight()/2;var cX2=obj2.getX()-obj2.getWidth()/2;var cY2=obj2.getY()-obj2.getHeight()/2;var top=Math.max(cY1,cY2);var left=Math.max(cX1,cX2);var right=Math.min(cX1+obj1.getWidth(),cX2+obj2.getWidth());var bottom=Math.min(cY1+obj1.getHeight(),cY2+obj2.getHeight());var width=right-left;var height=bottom-top;if(width>0&&height>0)return true;else return false;}
else
{var r1=obj1.getDrawRectangle(),r2=obj2.getDrawRectangle();return r1.hitTestRectangle(r2);}};this.drawRectangle=function(x,y,width,height,color,fill,opacity,ignoreViewport)
{var cns=this.canvas;if(typeof opacity!='undefined')cns.ctx.globalAlpha=opacity;else cns.ctx.globalAlpha=1;cns.ctx.fillStyle=color;cns.ctx.strokeStyle=color;if(!ignoreViewport)
{x-=this.viewport.x;y-=this.viewport.y;}
x=x*Utils.globalScale*Utils.globalPixelScale;y=y*Utils.globalScale*Utils.globalPixelScale;width=width*Utils.globalScale*Utils.globalPixelScale;height=height*Utils.globalScale*Utils.globalPixelScale;if(fill)cns.ctx.fillRect(x-width/2,y-height/2,width,height);else cns.ctx.strokeRect(x-width/2,y-height/2,width,height);};this.drawCircle=function(x,y,radius,width,color,opacity,ignoreViewport)
{this.drawArc(x,y,radius,0,Math.PI*2,false,width,color,opacity,ignoreViewport);};this.drawArc=function(x,y,radius,startAngle,endAngle,anticlockwise,width,color,opacity,ignoreViewport)
{var cns=this.canvas;var oldLW=cns.ctx.lineWidth;if(typeof color=="undefined")color="#000"
cns.ctx.strokeStyle=color;if(typeof width=="undefined")width=1;cns.ctx.lineWidth=width*Utils.globalScale*Utils.globalPixelScale;if(typeof opacity=="undefined")opacity=1;cns.ctx.globalAlpha=opacity;if(!ignoreViewport)
{x-=this.viewport.x;y-=this.viewport.y;}
x=x*Utils.globalScale*Utils.globalPixelScale;y=y*Utils.globalScale*Utils.globalPixelScale;radius=radius*Utils.globalScale*Utils.globalPixelScale;cns.ctx.beginPath();cns.ctx.arc(x,y,radius,startAngle,endAngle,anticlockwise);cns.ctx.stroke();cns.ctx.lineWidth=oldLW;};this.drawPolygon=function(points,width,color,opacity,ignoreViewport)
{if((typeof points!="object")||!(points instanceof Array)||points.length<2)return;for(var i=0;i<points.length-1;i++)
{this.drawLine(points[i].x,points[i].y,points[i+1].x,points[i+1].y,width,color,opacity,ignoreViewport);}
this.drawLine(points[i].x,points[i].y,points[0].x,points[0].y,width,color,opacity,ignoreViewport);}
this.drawLine=function(x1,y1,x2,y2,width,color,opacity,ignoreViewport)
{var cns=this.canvas;var oldLW=cns.ctx.lineWidth;if(color)cns.ctx.strokeStyle=color;else cns.ctx.strokeStyle='#000';if(width)cns.ctx.lineWidth=width*Utils.globalScale*Utils.globalPixelScale;else cns.ctx.lineWidth=1*Utils.globalScale*Utils.globalPixelScale;if(opacity)cns.ctx.globalAlpha=opacity;else cns.ctx.globalAlpha=1;if(!ignoreViewport)
{x1-=this.viewport.x;y1-=this.viewport.y;x2-=this.viewport.x;y2-=this.viewport.y;}
x1=x1*Utils.globalScale*Utils.globalPixelScale;y1=y1*Utils.globalScale*Utils.globalPixelScale;x2=x2*Utils.globalScale*Utils.globalPixelScale;y2=y2*Utils.globalScale*Utils.globalPixelScale;cns.ctx.beginPath();cns.ctx.moveTo(x1,y1);cns.ctx.lineTo(x2,y2);cns.ctx.stroke();cns.ctx.lineWidth=oldLW;};this.start=function()
{if(this.started)return;this.started=true;clearFPS();render();}
this.forceRender=function()
{if(this.started)render();}
this.stop=function()
{this.started=false;}
function clearFPS()
{self.lastFPS=self.fps;self.fps=0;if(self.started)self.tmFPS=setTimeout(clearFPS,1000);}
this.setTextStyle=function(font,size,style,color,borderColor,canvas)
{var cns=(canvas?canvas:this.canvas);cns.ctx.fillStyle=color;cns.ctx.strokeStyle=borderColor;var s="";if(style)s+=style+" ";if(size)s+=Math.floor(size*Utils.globalScale*Utils.globalPixelScale)+"px ";if(font)s+=font;cns.ctx.font=s;}
this.drawText=function(text,x,y,opacity,ignoreViewport,alignCenter,canvas)
{var cns=(canvas?canvas:this.canvas);if(typeof opacity=="undefined")cns.ctx.globalAlpha=1;else cns.ctx.globalAlpha=opacity;if(!ignoreViewport)
{x-=this.viewport.x;y-=this.viewport.y;}
x=x*Utils.globalScale*Utils.globalPixelScale;y=y*Utils.globalScale*Utils.globalPixelScale;if(alignCenter)x=x-this.getTextWidth(text)/2;cns.ctx.fillText(text,x,y);}
this.strokeText=function(text,x,y,opacity,ignoreViewport,alignCenter,canvas)
{var cns=(canvas?canvas:this.canvas);if(typeof opacity=="undefined")cns.ctx.globalAlpha=1;else cns.ctx.globalAlpha=opacity;if(!ignoreViewport)
{x-=this.viewport.x;y-=this.viewport.y;}
x=x*Utils.globalScale*Utils.globalPixelScale;y=y*Utils.globalScale*Utils.globalPixelScale;if(alignCenter)x=x-this.getTextWidth(text)/2;cns.ctx.strokeText(text,x,y);}
this.getTextWidth=function(str,canvas)
{var cns=(canvas?canvas:this.canvas);return cns.ctx.measureText(str).width;}
this.allowDebugDrawing=false;this.allowStaticDebugDrawing=false;this.renderObject=function(cns,obj)
{var
r=obj.getDrawRectangle(),ow=obj.width*Utils.globalScale,oh=obj.height*Utils.globalScale,ox=r.center.x*Utils.globalPixelScale*Utils.globalScale-Math.floor(ow/2),oy=r.center.y*Utils.globalPixelScale*Utils.globalScale-Math.floor(oh/2),or=obj.rotation,scX=obj.scaleX*Utils.globalPixelScale,scY=obj.scaleY*Utils.globalPixelScale,canvasMod=Boolean(or!=0||scX!=1||scY!=1);if(!obj.ignoreViewport)
{ox-=this.viewport.x*Utils.globalPixelScale*Utils.globalScale;oy-=this.viewport.y*Utils.globalPixelScale*Utils.globalScale;}
if(canvasMod)
{cns.ctx.save();cns.ctx.translate(ox+Math.floor(ow/2),oy+Math.floor(oh/2));cns.ctx.rotate(or);cns.ctx.scale(scX,scY);ox=-Math.floor(ow/2);oy=-Math.floor(oh/2);}
cns.ctx.globalAlpha=obj.opacity;if(this.ceilSizes)
{ow=Math.ceil(ow);oh=Math.ceil(oh);}
if(obj.fillColor)
{cns.ctx.fillStyle=obj.fillColor;cns.ctx.strokeStyle=obj.fillColor;cns.ctx.fillRect(ox,oy,ow,oh);}
if(obj.bitmap)
{var iw=obj.bitmap.width,ih=obj.bitmap.height;var fx=obj.currentLayer*ow+obj.offset.left*Utils.globalScale,fy=obj.currentFrame*oh+obj.offset.top*Utils.globalScale;if(fx<iw&&fy<ih)
{var fw=ow,fh=oh,masked=false;if(fx+fw>iw)fw=iw-fx;if(fy+fh>ih)fh=ih-fy;if(obj.mask)
{this.buffer.ctx.save();this.buffer.ctx.clearRect(0,0,fw,fh);this.buffer.ctx.drawImage(obj.bitmap,fx,fy,fw,fh,0,0,fw,fh);this.buffer.ctx.globalCompositeOperation="destination-in";this.buffer.ctx.drawImage(obj.mask,0,0);fx=0;fy=0;masked=true;}
try
{cns.ctx.drawImage((masked?this.buffer:obj.bitmap),~~fx,~~fy,~~fw,~~fh,~~ox,~~oy,~~ow,~~oh);}
catch(e)
{}
if(masked)this.buffer.ctx.restore();}}
if(canvasMod)cns.ctx.restore();if(this.allowDebugDrawing&&obj.allowDebugDrawing)
{if(this.allowStaticDebugDrawing||!obj.static)
{obj.debugDraw();}}
obj.dispatchEvent("render",{target:obj,canvas:cns});}
this.clearObjectAABB=function(cns,obj)
{var w=obj.history.AABB[1].x-obj.history.AABB[0].x;var h=obj.history.AABB[1].y-obj.history.AABB[0].y;if(!this.fillColor)cns.ctx.clearRect((obj.history.AABB[0].x-this.viewport.x)*Utils.globalPixelScale,(obj.history.AABB[0].y-this.viewport.y)*Utils.globalPixelScale,w*Utils.globalPixelScale,h*Utils.globalPixelScale);else
{cns.ctx.fillStyle=this.fillColor;cns.ctx.fillRect((obj.history.AABB[0].x-this.viewport.x)*Utils.globalPixelScale,(obj.history.AABB[0].y-this.viewport.y)*Utils.globalPixelScale,w*Utils.globalPixelScale,h*Utils.globalPixelScale);}};this.addPartialDraw=function(partialDraw,obj)
{partialDraw.push(obj);obj.history.drawed=true;obj.history.changed=true;for(var i=0;i<this.objects.length;i++)
{if(!this.objects[i].history.changed&&this.objects[i].visible&&!this.objects[i]['static'])
{var top=Math.max(obj.history.AABB[0].y,this.objects[i].history.AABB[0].y);var left=Math.max(obj.history.AABB[0].x,this.objects[i].history.AABB[0].x);var right=Math.min(obj.history.AABB[1].x,this.objects[i].history.AABB[1].x);var bottom=Math.min(obj.history.AABB[1].y,this.objects[i].history.AABB[1].y);var width=right-left;var height=bottom-top;if(width>0&&height>0)this.addPartialDraw(partialDraw,this.objects[i]);}}
return partialDraw;};this.drawScenePartial=function(cns)
{var partialDraw=[];var rect,obj;if(!cns.ctx)cns.ctx=cns.getContext("2d");for(var i=0;i<this.objects.length;i++)
{this.objects[i].nextFrame();}
for(i=0;i<this.objects.length;i++)
{obj=this.objects[i];if(obj.visible&&!obj['static'])
{if(obj.destroy||obj.drawAlways||!obj.history.drawed||obj.currentFrame!=obj.history.frame||obj.getX()!=obj.history.x||obj.getY()!=obj.history.y||obj.rotation!=obj.history.rotation)
{partialDraw=this.addPartialDraw(partialDraw,obj);}}}
partialDraw=this.sortStack(partialDraw,true);var w,h;for(i=0;i<partialDraw.length;i++)
{this.clearObjectAABB(cns,partialDraw[i]);}
for(i=0;i<partialDraw.length;i++)
{obj=partialDraw[i];if(obj.destroy)
{this.removeChild(obj);}
else
{this.renderObject(cns,obj);obj.updateHistory();}}}
this.drawBackAlways=Utils.mobileCheckBrokenGalaxyPhones();this.drawBackBuffer=function(cns,drawStatic)
{if(!drawStatic&&this.backBuffer&&this.drawBackAlways)cns.ctx.drawImage(this.backBuffer,0,0,cns.width,cns.height);}
this.drawScene=function(cns,drawStatic)
{var obj,ok;if(!cns.ctx)cns.ctx=cns.getContext("2d");if(!this.fillColor)
{if(!this.clearLock)
{this.clearScreen(cns);this.drawBackBuffer(cns,drawStatic);}}
else
{cns.ctx.fillStyle=this.fillColor;cns.ctx.fillRect(0,0,this.screenWidth*Utils.globalScale*Utils.globalPixelScale,this.screenHeight*Utils.globalScale*Utils.globalPixelScale);this.drawBackBuffer(cns,drawStatic);}
for(var i=0;i<this.objects.length;i++)
{obj=this.objects[i];ok=false;if(!drawStatic&&!obj['static'])ok=true;if(drawStatic&&obj['static'])ok=true;if(ok)
{if(obj.destroy)
{this.removeChild(obj);i--;}
else
{obj.nextFrame();if(obj.visible)this.renderObject(cns,obj);}}}
if(drawStatic)
{this.backBuffer=cns;}};this.tweens=[];this.createTween=function(obj,prop,start,end,duration,ease)
{var t=new Tween(obj,prop,start,end,duration,ease);self.tweens.push(t);return t;}
this.removeTween=function(t)
{var id=null;if(isNaN(t))
{for(var i=0;i<self.tweens.length;i++)
{if(self.tweens[i]===t)
{id=i;break;}}}
else id=t;self.tweens[id].pause();self.tweens.splice(id,1);return id;}
this.clearObjectTweens=function(obj)
{for(var i=0;i<self.tweens.length;i++)
{if(self.tweens[i].obj===obj)
{i=self.removeTween(i);i--;}}}
this.updateTweens=function()
{for(var i=0;i<self.tweens.length;i++)
{if(self.tweens[i].tick())
{i=self.removeTween(i);}}}
this.timers=[];this.setTimeout=function(callback,timeout)
{var t=new StageTimer(callback,timeout);this.timers.push(t);return t;};this.clearTimeout=function(t)
{this.timers=Utils.removeFromArray(this.timers,t);};this.setInterval=function(callback,timeout)
{var t=new StageTimer(callback,timeout,true);this.timers.push(t);return t;};this.clearInterval=function(t)
{this.clearTimeout(t);};this.updateTimers=function()
{for(var i=0;i<this.timers.length;i++)
{if(this.timers[i].update())
{this.clearTimeout(this.timers[i]);i--;}}};function render()
{clearTimeout(self.tmMain);var tm_start=new Date().getTime();self.updateTweens();self.updateTimers();self.dispatchEvent("pretick");if(self.partialUpdate)self.drawScenePartial(self.canvas);else self.drawScene(self.canvas,false);if(self.showFPS)
{self.setTextStyle("sans-serif",10,"bold","#fff","#000");self.drawText("FPS: "+self.lastFPS,2,10,1,true);}
self.dispatchEvent("posttick");var d=new Date().getTime()-tm_start;d=self.delay-d-1;if(d<1)d=1;self.fps++;if(self.started)self.tmMain=setTimeout(render,d);};this.box2dSync=function(world)
{var p;for(b=world.m_bodyList;b;b=b.m_next)
{if(b.sprite)
{b.sprite.rotation=b.GetRotation();p=b.GetPosition();b.sprite.x=p.x;b.sprite.y=p.y;b.sprite.dispatchEvent("box2dsync",{target:b.sprite});}}}
this.processTouchEvent=function(touches,controller)
{for(var i=0;i<touches.length;i++)
{var e={clientX:touches[i].clientX,clientY:touches[i].clientY};self[controller](e);}}
var ffOS=(navigator.userAgent.toLowerCase().indexOf("firefox")!=-1&&navigator.userAgent.toLowerCase().indexOf("mobile")!=-1);ffOS=false;if(("ontouchstart"in this.canvas)&&!ffOS)
{this.canvas.ontouchstart=function(event)
{this.renderController.processTouchEvent(event.touches,"checkMouseDown");this.renderController.processTouchEvent(event.touches,"checkClick");};this.canvas.ontouchmove=function(event)
{this.renderController.processTouchEvent(event.touches,"checkMouseMove");};this.canvas.ontouchend=function(event)
{this.renderController.processTouchEvent(event.changedTouches,"checkMouseUp");};}
else
{this.canvas.onclick=function(event)
{this.renderController.checkClick(event);};this.canvas.onmousemove=function(event)
{this.renderController.checkMouseMove(event);};this.canvas.onmousedown=function(event)
{if(event.button==0)this.renderController.checkMouseDown(event);};this.canvas.onmouseup=function(event)
{if(event.button==0)this.renderController.checkMouseUp(event);};this.canvas.oncontextmenu=function(event)
{this.renderController.checkContextMenu(event);};}
this.onpretick=null;this.onposttick=null;this.eventsListeners=[];this.addEventListener=function(type,callback)
{EventsManager.addEvent(this,type,callback);}
this.removeEventListener=function(type,callback)
{EventsManager.removeEvent(this,type,callback);}
this.dispatchEvent=function(type,params)
{return EventsManager.dispatchEvent(this,type,params);}}
function Vector(x,y)
{if(typeof(x)=='undefined')x=0;this.x=x;if(typeof(y)=='undefined')y=0;this.y=y;this.clone=function()
{return new Vector(this.x,this.y);}
this.add=function(p)
{this.x+=p.x;this.y+=p.y;return this;}
this.subtract=function(p)
{this.x-=p.x;this.y-=p.y;return this;}
this.mult=function(n)
{this.x*=n;this.y*=n;return this;}
this.invert=function()
{this.mult(-1);return this;}
this.rotate=function(angle,offset)
{if(typeof(offset)=='undefined')offset=new Vector(0,0);var r=this.clone();r.subtract(offset);r.x=this.x*Math.cos(angle)+this.y*Math.sin(angle);r.y=this.x*-Math.sin(angle)+this.y*Math.cos(angle);r.add(offset);this.x=r.x;this.y=r.y;return this;}
this.normalize=function(angle,offset)
{if(typeof(offset)=='undefined')offset=new Vector(0,0);this.subtract(offset);this.rotate(-angle);return this;}
this.getLength=function()
{return Math.sqrt(this.x*this.x+this.y*this.y);}
this.distanceTo=function(p)
{p2=this.clone();p2.subtract(p);return p2.getLength();}}
var Rectangle=function(x,y,w,h,angle)
{this.center=new Vector(x,y);this.width=w;this.height=h;this.angle=angle;this.vertices=[];this.AABB=[];this.clone=function()
{return new Rectangle(this.center.x,this.center.y,this.width,this.height,this.angle);}
this.refreshVertices=function()
{var w=this.width/2;var h=this.height/2;this.vertices=[];this.vertices.push(new Vector(-w,h));this.vertices.push(new Vector(w,h));this.vertices.push(new Vector(w,-h));this.vertices.push(new Vector(-w,-h));this.AABB=[this.center.clone(),this.center.clone()];for(var i=0;i<4;i++)
{this.vertices[i].rotate(-this.angle,this.center);if(this.vertices[i].x<this.AABB[0].x)this.AABB[0].x=this.vertices[i].x;if(this.vertices[i].x>this.AABB[1].x)this.AABB[1].x=this.vertices[i].x;if(this.vertices[i].y<this.AABB[0].y)this.AABB[0].y=this.vertices[i].y;if(this.vertices[i].y>this.AABB[1].y)this.AABB[1].y=this.vertices[i].y;}}
this.move=function(x,y)
{this.center.add(new Vector(x,y));this.refreshVertices();}
this.rotate=function(angle)
{this.angle+=angle;this.refreshVertices();}
this.hitTestPoint=function(point)
{var p=point.clone();p.normalize(-this.angle,this.center);return((Math.abs(p.x)<=(this.width/2))&&(Math.abs(p.y)<=(this.height/2)));}
this.hitTestRectangle=function(rect)
{var r1=this.clone();var r2=rect.clone();var len,len1,len2;r1.move(-this.center.x,-this.center.y);r2.move(-this.center.x,-this.center.y);r2.center.rotate(this.angle);r1.rotate(-this.angle);r2.rotate(-this.angle);len=Math.max(r1.AABB[0].x,r1.AABB[1].x,r2.AABB[0].x,r2.AABB[1].x)-Math.min(r1.AABB[0].x,r1.AABB[1].x,r2.AABB[0].x,r2.AABB[1].x);len1=r1.AABB[1].x-r1.AABB[0].x;len2=r2.AABB[1].x-r2.AABB[0].x;if(len>len1+len2)return false;len=Math.max(r1.AABB[0].y,r1.AABB[1].y,r2.AABB[0].y,r2.AABB[1].y)-Math.min(r1.AABB[0].y,r1.AABB[1].y,r2.AABB[0].y,r2.AABB[1].y);len1=r1.AABB[1].y-r1.AABB[0].y;len2=r2.AABB[1].y-r2.AABB[0].y;if(len>len1+len2)return false;r1.move(-r2.center.x,-r2.center.y);r2.move(-r2.center.x,-r2.center.y);r1.center.rotate(r2.angle);r1.refreshVertices();r1.rotate(-r2.angle);r2.rotate(-r2.angle);len=Math.max(r1.AABB[0].x,r1.AABB[1].x,r2.AABB[0].x,r2.AABB[1].x)-Math.min(r1.AABB[0].x,r1.AABB[1].x,r2.AABB[0].x,r2.AABB[1].x);len1=r1.AABB[1].x-r1.AABB[0].x;len2=r2.AABB[1].x-r2.AABB[0].x;if(len>len1+len2)return false;len=Math.max(r1.AABB[0].y,r1.AABB[1].y,r2.AABB[0].y,r2.AABB[1].y)-Math.min(r1.AABB[0].y,r1.AABB[1].y,r2.AABB[0].y,r2.AABB[1].y);len1=r1.AABB[1].y-r1.AABB[0].y;len2=r2.AABB[1].y-r2.AABB[0].y;if(len>len1+len2)return false;return true;}
this.refreshVertices();}
var Asset=function(name,src,w,h,f,l)
{this.name=name+'';this.src=src+'';this.width=w;this.height=h;this.frames=f;this.layers=l;this.bitmap=null;this.object=null;this.ready=(this.width&&this.height);this.detectSize=function()
{if(!this.bitmap)return false;try
{if(isNaN(this.width))
{this.width=this.bitmap.width?parseInt(this.bitmap.width):0;}
if(isNaN(this.height))
{this.height=this.bitmap.height?parseInt(this.bitmap.height):0;}}
catch(e)
{if(CRENDER_DEBUG)console.log(e);}
return(!isNaN(this.width)&&!isNaN(this.height));}
this.normalize=function(scale)
{if(this.ready)return;if(!this.detectSize())return;if(isNaN(this.frames)||this.frames<1)this.frames=1;if(isNaN(this.layers)||this.layers<1)this.layers=1;this.width=Math.ceil((this.width/this.layers)/scale);this.height=Math.ceil((this.height/this.frames)/scale);this.ready=true;}}
var AssetsLibrary=function(path,scale,assets)
{var self=this;this.path='images';this.scale=1;this.items={};this.bitmaps={};this.loaded=false;this.onload=null;this.onloadprogress=null;this.spriteClass=Sprite;this.init=function(path,scale)
{if(typeof path!='undefined')
{this.path=path+'';}
if(typeof scale!='undefined')
{this.scale=parseFloat(scale);if(isNaN(this.scale))this.scale=1;}}
this.addAssets=function(data)
{if(typeof data=='undefined')return;if(typeof data!='object')return;for(var i=0;i<data.length;i++)
{var item=data[i];item.noscale=(typeof item.noscale=='undefined')?false:item.noscale;if(!item.noscale)item.src='%SCALE%/'+item.src;this.addAsset(item.src,item.name,item.width,item.height,item.frames,item.layers);}}
this.addAsset=function(src,name,w,h,f,l)
{function src2name(src)
{var name=src.split('/');name=name.pop();name=name.split('.');name=name.shift()+'';return name;}
src=src.replace('%SCALE%','%PATH%/'+this.scale);src=src.replace('%PATH%',this.path);if(typeof name=='undefined')name=src2name(src);var asset=new Asset(name,src,w,h,f,l);this.items[name]=asset;return asset;}
this.addObject=function(obj)
{var asset=this.addAsset('%SCALE%/'+obj.image,obj.name,obj.width*this.scale,obj.height*this.scale,obj.frames,obj.layers);if(asset)asset.object=obj;return asset;}
this.load=function(onload,onloadprogress)
{this.onload=onload;this.onloadprogress=onloadprogress;var preloader=new ImagesPreloader();var data=[];for(var n in this.items)
data.push(this.items[n]);preloader.load(data,self.onLoadHandler,self.onLoadProgressHandler);}
this.onLoadProgressHandler=function(val)
{if(typeof self.onloadprogress=='function')
{self.onloadprogress(val);}}
this.onLoadHandler=function(data)
{self.loaded=true;for(var n in data)
{var bmp=data[n];var asset=self.items[n];asset.bitmap=bmp;asset.normalize(self.scale);}
if(typeof self.onload=='function')
{self.onload(self.items);}}
this.getAsset=function(name,checkLoad)
{var asset=null;if((typeof this.items[name]!='undefined')&&(this.items[name].bitmap))
{checkLoad=(typeof checkLoad=='undefined')?true:checkLoad;asset=(!checkLoad||this.items[name].ready)?this.items[name]:null;}
if(!asset)
{throw new Error('Trying to get undefined asset "'+name+'"');}
return asset;}
this.getSprite=function(name,params)
{var mc=null;try
{var asset=this.getAsset(name,true);mc=new this.spriteClass(asset.bitmap,asset.width,asset.height,asset.frames,asset.layers);}
catch(e)
{mc=new this.spriteClass(null,1,1,1,1);}
if(typeof params=='object')
{for(var prop in params)mc[prop]=params[prop];}
return mc;}
this.getBitmap=function(name)
{try
{var asset=this.getAsset(name,true);return asset.bitmap;}
catch(e)
{return null;}}
this.init(path,scale);this.addAssets(assets);}
if(typeof console=='undefined')
{console={log:function(){}}};function AudioPlayer()
{var self=this;this.disabled=false;this.basePath="";this.mp3Support=true;this.webAudioSupport=false;this.delayPlay=false;this.audioWrapper=null;this.locked=false;this.busy=false;this.startPlayTime=0;this.onend=null;this.createNewAudio=function()
{if(this.webAudioSupport)
{var sound=AudioMixer.waContext.createBufferSource();sound.connect(AudioMixer.waContext.destination);return sound;}
else
{return document.createElement('audio');}};this.init=function(path,webAudioSupport)
{this.webAudioSupport=webAudioSupport;this.basePath=path?path:"";this.delayPlay=("ontouchstart"in window);this.audioWrapper=this.createNewAudio();var test=document.createElement('audio');if(test.canPlayType)this.mp3Support=test.canPlayType('audio/mpeg')!="";else this.disabled=true;return!this.disabled;};this.play=function(file,loop)
{if(this.disabled)return false;var url=this.basePath+"/"+file+(this.mp3Support?".mp3":".ogg");this.stop();this.audioWrapper=this.createNewAudio();this.audioWrapper.doLoop=(loop?true:false);if(this.webAudioSupport)
{var self=this;this.loadSound(url,function(buffer)
{self.audioWrapper.buffer=buffer;self.audioWrapper.noteOn(0);self.audioWrapper.loop=loop;self.waCheckInterval=setInterval(function()
{if(!self.audioWrapper)
{clearInterval(self.waCheckInterval);return;}
if(self.audioWrapper.playbackState==self.audioWrapper.FINISHED_STATE)
{self.controlPlay();}},100);});}
else
{this.audioWrapper.src=url;this.audioWrapper.type=(this.mp3Support?"audio/mpeg":"audio/ogg");this.audioWrapper.loop=false;this.audioWrapper.preload="auto";this.audioWrapper.load();if(this.delayPlay)this.audioWrapper.addEventListener("canplay",this.readyToPlay);else this.audioWrapper.play();this.audioWrapper.addEventListener("ended",this.controlPlay,false);}
this.busy=true;this.startPlayTime=new Date().getTime();};this.loadSound=function(url,callback)
{if(AudioMixer.buffer[url])
{if(callback)callback(AudioMixer.buffer[url]);return;}
var request=new XMLHttpRequest();request.open('GET',url,true);request.responseType='arraybuffer';request.onload=function()
{AudioMixer.waContext.decodeAudioData(this.response,function(buffer)
{AudioMixer.buffer[url]=buffer;if(callback)callback(buffer);});}
request.send();}
this.readyToPlay=function(e)
{e.currentTarget.play();}
this.stop=function()
{this.busy=false;try
{if(this.webAudioSupport)
{this.audioWrapper.noteOff(0);this.audioWrapper=null;}
else
{this.audioWrapper.removeEventListener("canplay",this.readyToPlay);this.audioWrapper.pause();this.audioWrapper.currentTime=0.0;this.audioWrapper=null;}}
catch(e){};};this.controlPlay=function()
{if(self.audioWrapper.doLoop)
{if(!this.webAudioSupport)
{self.audioWrapper.pause();self.audioWrapper.currentTime=0.0;self.audioWrapper.play();}}
else
{self.busy=false;if(typeof self.onend=="function")self.onend();if(this.waCheckInterval)
{clearInterval(this.waCheckInterval);}}}}
function AudioMixer(path,channelsCount)
{this.webAudioSupport=false;this.singleChannelMode=false;this.channels=[];this.init=function(path,channelsCount)
{this.webAudioSupport=("webkitAudioContext"in window);if(this.webAudioSupport)
{AudioMixer.waContext=new webkitAudioContext();var buffer=AudioMixer.waContext.createBuffer(1,1,22050);sound=AudioMixer.waContext.createBufferSource();sound.buffer=buffer;sound.connect(AudioMixer.waContext.destination);sound.noteOn(0);}
if(!this.webAudioSupport&&navigator.userAgent.toLowerCase().indexOf("mac")!=-1)
{this.singleChannelMode=true;channelsCount=1;}
this.path=path;this.channels=[];for(var i=0;i<channelsCount;i++)
{this.channels[i]=new AudioPlayer();this.channels[i].init(path,this.webAudioSupport);}};this.play=function(file,loop,soft,channelID)
{var cID=-1;if(typeof channelID=="number")cID=channelID;else cID=this.getFreeChannel(soft);if(cID>=0&&cID<this.channels.length)
{this.channels[cID].stop();this.channels[cID].play(file,loop);}
return this.channels[cID];};this.stop=function(cID)
{if(cID>=0&&cID<this.channels.length)this.channels[cID].stop();};this.getFreeChannel=function(soft)
{var cID=-1;var freeChannels=[];var maxID=-1;var max=-1;var t=0;for(var i=0;i<this.channels.length;i++)
{if(!this.channels[i].locked)
{if(!this.channels[i].busy)freeChannels.push(i);else
{t=new Date().getTime();t-=this.channels[i].startPlayTime;if(t>max)
{max=t;maxID=i;}}}}
if(freeChannels.length==0)
{if(!soft&&max>=0)cID=max;}
else cID=freeChannels[0];return cID;};this.init(path,channelsCount);}
AudioMixer.buffer={};AudioMixer.waContext=null;;var levels=[[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,1,1,1,1,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,1,1,1,1,1,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,1,1,1,1,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,],[0,0,1,1,1,1,0,0,0,0,0,0,0,0,0,1,1,1,1,0,],[0,1,1,1,1,1,0,0,0,0,0,0,0,0,1,1,1,1,1,0,],[0,0,1,1,1,1,0,0,0,0,0,0,0,0,0,1,1,1,1,0,],[0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,1,0,0,0,0,0,0,1,0,0,0,0,0,0,1,0,0,],[0,0,1,1,1,1,0,0,0,1,1,1,1,0,0,0,1,1,1,1,],[0,1,1,1,1,1,0,0,1,1,1,1,1,0,0,1,1,1,1,1,],[0,0,1,1,1,1,0,0,0,1,1,1,1,0,0,0,1,1,1,1,],[0,0,0,1,0,0,0,0,0,0,1,0,0,0,0,0,0,1,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,1,0,0,0,0,1,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,1,0,1,0,1,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,1,1,1,1,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,1,1,1,1,1,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,1,1,1,1,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,1,0,1,0,1,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,1,0,0,0,0,1,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,1,0,0,0,0,0,1,0,0,0,0,0,0,0,],[0,0,0,0,0,0,1,1,0,0,0,0,1,1,0,0,0,0,0,0,],[0,0,0,0,0,0,0,1,0,1,0,1,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,1,1,1,1,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,1,1,1,1,1,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,1,1,1,1,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,1,0,1,0,1,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,1,1,0,0,0,0,1,1,0,0,0,0,0,0,],[0,0,0,0,0,0,1,0,0,0,0,0,1,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,1,0,0,0,0,0,1,0,0,0,0,0,0,0,],[0,0,0,0,0,0,1,1,0,1,1,0,1,1,0,0,0,0,0,0,],[0,0,0,0,0,0,0,1,0,1,0,1,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,1,1,1,1,0,0,0,0,0,0,0,0,],[0,0,0,0,0,1,1,1,1,1,1,1,1,1,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,1,1,1,1,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,1,0,1,0,1,0,0,0,0,0,0,0,0,],[0,0,0,0,0,1,1,1,0,1,1,0,1,1,1,0,0,0,0,0,],[0,0,0,0,0,0,1,0,0,0,0,0,1,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,1,0,0,1,0,0,1,0,0,0,0,0,0,0,],[0,0,0,0,0,0,1,1,0,1,1,0,1,1,0,0,0,0,0,0,],[0,0,0,0,0,0,1,1,0,1,0,1,1,0,0,0,0,0,0,0,],[0,0,1,0,0,0,0,0,1,1,1,1,0,0,0,0,0,1,0,0,],[0,1,1,0,0,1,1,1,1,1,1,1,1,1,0,0,1,1,0,0,],[0,0,1,0,0,0,0,0,1,1,1,1,0,0,0,0,0,1,0,0,],[0,0,0,0,0,0,1,1,0,1,0,1,1,0,0,0,0,0,0,0,],[0,0,0,0,0,1,1,1,0,1,1,0,1,1,1,0,0,0,0,0,],[0,0,0,0,0,0,1,0,0,1,0,0,1,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,1,1,1,0,0,0,0,0,0,0,1,1,1,0,0,0,0,],[0,0,0,1,0,0,1,0,0,0,0,0,0,1,0,0,1,0,0,0,],[0,0,1,0,1,0,1,0,0,0,0,0,1,0,1,0,1,0,0,0,],[0,0,0,1,0,0,1,0,0,0,0,0,0,1,0,0,1,0,0,0,],[0,0,0,1,1,1,0,0,0,0,0,0,0,1,1,1,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,1,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,],[0,0,0,0,1,1,0,0,0,0,0,0,0,0,1,1,0,0,0,0,],[0,0,0,1,1,1,0,0,0,0,0,0,0,1,1,1,0,0,0,0,],[0,0,0,1,0,0,1,0,0,0,0,0,0,1,0,0,1,0,0,0,],[0,1,1,0,1,0,1,1,0,0,0,1,1,0,1,0,1,1,0,0,],[0,0,0,1,0,0,1,0,0,0,0,0,0,1,0,0,1,0,0,0,],[0,0,0,1,1,1,0,0,0,0,0,0,0,1,1,1,0,0,0,0,],[0,0,0,0,1,1,0,0,0,0,0,0,0,0,1,1,0,0,0,0,],[0,0,0,0,1,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,1,1,0,0,0,1,1,0,0,0,1,1,0,0,0,0,],[0,0,0,1,1,1,0,0,0,1,0,0,0,1,1,1,0,0,0,0,],[0,0,0,1,0,0,1,0,0,1,1,0,0,1,0,0,1,0,0,0,],[0,1,1,0,1,0,1,1,1,1,1,1,1,0,1,0,1,1,0,0,],[0,0,0,1,0,0,1,0,0,1,1,0,0,1,0,0,1,0,0,0,],[0,0,1,1,1,1,0,0,0,1,0,0,0,1,1,1,1,0,0,0,],[0,0,0,1,1,1,0,0,0,1,1,0,0,0,1,1,1,0,0,0,],[0,0,0,1,1,0,0,0,0,1,0,0,0,0,1,1,0,0,0,0,],[0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,1,1,1,1,1,1,0,0,0,0,1,1,1,1,1,1,0,0,],[0,0,1,1,1,1,1,0,0,0,0,0,1,1,1,1,1,0,0,0,],[0,0,0,1,1,1,1,0,0,0,0,0,0,1,1,1,1,0,0,0,],[0,0,0,1,1,1,0,0,0,0,0,0,0,1,1,1,0,0,0,0,],[0,0,0,0,1,1,0,0,0,0,0,0,0,0,1,1,0,0,0,0,],[0,0,0,0,1,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,'small4',0,0,0,'small4',0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,1,1,1,1,1,0,0,0,1,0,0,0,1,1,1,1,1,0,],[0,0,0,1,1,1,1,0,0,0,1,1,0,0,0,1,1,1,1,0,],[0,0,0,1,1,1,0,0,0,1,1,1,0,0,0,1,1,1,0,0,],[0,0,0,0,1,1,0,0,0,1,1,1,1,0,0,0,1,1,0,0,],[0,0,0,0,1,0,0,0,1,1,1,1,1,0,0,0,1,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,],[0,0,1,1,0,0,0,0,0,1,0,0,0,0,0,1,1,0,0,0,],[0,0,1,1,1,0,0,0,0,1,1,0,0,0,0,1,1,1,0,0,],[0,1,1,1,1,0,0,0,1,1,1,0,0,0,1,1,1,1,0,0,],[0,1,1,1,1,1,0,0,1,1,1,1,0,0,1,1,1,1,1,0,],[0,1,1,1,1,0,0,1,1,1,1,1,0,0,1,1,1,1,0,0,],[0,0,1,1,1,0,0,0,0,0,0,0,0,0,0,1,1,1,0,0,],[0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,1,1,0,0,0,],[0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,1,0,0,0,1,0,0,0,1,0,0,0,0,0,],[0,0,0,0,0,1,1,0,0,1,1,0,0,1,1,0,0,0,0,0,],[0,0,0,0,0,1,1,1,0,1,1,1,0,1,1,1,0,0,0,0,],[0,0,0,0,1,1,1,1,1,1,1,1,1,1,1,1,0,0,0,0,],[0,0,0,0,0,1,1,1,0,1,1,1,0,1,1,1,0,0,0,0,],[0,0,0,0,0,1,1,0,0,1,1,0,0,1,1,0,0,0,0,0,],[0,0,0,0,0,0,1,0,0,0,1,0,0,0,1,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,1,0,0,0,0,0,1,0,0,0,0,0,1,0,0,0,],[0,0,0,1,1,0,0,1,0,1,1,0,1,0,0,1,1,0,0,0,],[0,0,0,0,0,1,1,1,0,1,1,1,0,1,1,1,0,0,0,0,],[0,0,0,0,1,1,1,1,1,1,1,1,1,1,1,1,0,0,0,0,],[0,0,0,0,0,1,1,1,0,1,1,1,0,1,1,1,0,0,0,0,],[0,0,0,1,1,0,1,0,0,1,1,0,0,1,0,1,1,0,0,0,],[0,0,0,0,1,0,0,0,0,0,1,0,0,0,0,0,1,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,1,1,1,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,1,1,1,1,0,0,0,0,0,0,0,0,],[0,0,0,0,'boss4',0,0,1,1,1,1,1,0,0,'boss2',0,0,0,0,0,],[0,0,0,0,0,0,0,0,1,1,1,1,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,1,1,0,1,1,1,1,0,0,0,1,1,1,1,0,1,1,0,],[0,0,1,1,0,1,1,1,0,0,0,0,1,1,1,0,1,1,0,0,],[0,0,1,1,1,0,1,1,0,0,'boss4',0,0,1,1,0,1,1,1,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,1,1,1,0,0,0,0,0,1,1,1,0,0,0,0,],[0,0,0,0,0,1,1,0,0,0,0,0,0,1,1,0,0,0,0,0,],[0,0,0,0,0,0,1,0,0,0,0,0,0,0,1,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,1,0,0,0,'boss2',0,0,0,1,0,0,0,0,0,],[0,0,0,0,0,1,1,0,0,0,0,0,0,1,1,0,0,0,0,0,],[0,0,0,0,0,1,1,1,0,0,0,0,0,1,1,1,0,0,0,0,],[0,0,0,0,1,1,1,1,0,0,0,0,1,1,1,1,0,0,0,0,],[0,0,0,0,0,1,1,1,0,0,0,0,0,1,1,1,0,0,0,0,],[0,0,0,0,0,1,1,0,0,0,0,0,0,1,1,0,0,0,0,0,],[0,0,0,0,0,0,1,0,0,0,'boss2',0,0,0,1,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,'boss2',0,0,0,0,0,0,0,'boss2',0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,1,1,1,1,0,0,0,0,1,1,1,1,0,0,0,0,],[0,0,0,0,0,1,1,1,0,0,0,0,0,1,1,1,0,0,0,0,],[0,0,0,0,0,1,1,0,0,0,0,0,0,1,1,0,0,0,0,0,],[0,0,0,0,0,0,1,0,0,0,0,0,0,0,1,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,'boss2',0,0,0,0,0,0,0,0,0,0,0,0,0,0,'boss2',0,0,],[0,0,0,0,0,0,0,0,0,0,'small8',0,0,0,0,0,0,0,0,0,],[0,0,0,1,1,1,1,0,0,0,0,0,0,1,1,1,1,0,0,0,],[0,0,0,0,1,1,1,0,0,1,1,1,0,0,1,1,1,0,0,0,],[0,0,0,0,1,1,0,0,0,1,1,0,0,0,1,1,0,0,0,0,],[0,0,0,'small8',0,1,0,0,0,0,1,0,0,0,0,1,0,'small8',0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,'boss4',0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,1,1,1,1,1,1,1,0,0,0,0,0,0,],[0,0,0,0,'boss1',0,1,1,1,1,1,1,1,1,0,'boss1',0,0,0,0,],[0,0,0,0,0,0,0,1,1,1,1,1,1,1,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,],[0,0,0,1,1,0,0,0,0,0,'boss4',0,0,0,0,0,1,1,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,1,1,1,1,1,1,1,0,0,0,0,0,0,],[0,0,0,'small3',0,0,1,1,1,1,1,1,1,1,0,0,'small3',0,0,0,],[0,0,0,0,0,0,0,1,1,1,1,1,1,1,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,'small8',0,0,'small8',0,0,0,0,0,0,0,0,0,],[0,0,0,1,0,0,1,0,0,1,0,0,1,0,0,1,0,0,0,0,],[0,0,0,1,1,0,1,[1,1,],0,1,1,0,1,1,0,1,1,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,1,1,1,1,1,1,1,0,0,0,0,0,0,],[0,0,0,'small3',0,0,1,1,1,1,1,1,1,1,0,'small3',0,0,0,0,],[0,0,0,0,0,0,0,1,1,1,1,1,1,1,0,0,0,0,0,0,],[0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,1,1,0,0,0,],[0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,'small8',0,0,'small8',0,0,0,0,0,0,0,0,],[0,0,0,1,0,0,1,0,0,1,0,0,1,0,0,1,0,0,0,0,],[0,0,0,1,1,0,1,[1,1,],0,1,1,0,1,1,0,1,1,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,'small3',0,0,0,0,0,0,0,0,0,0,0,'small3',0,0,0,0,],[0,0,0,0,0,0,0,'small2',0,0,'boss4',0,0,'small2',0,0,0,0,0,0,],[0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,1,1,0,0,0,],[0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,'small8',0,0,'small8',0,0,0,0,0,0,0,0,],[0,0,0,1,0,0,1,0,0,1,0,0,1,0,0,1,0,0,0,0,],[0,0,0,1,1,0,1,[1,1,],0,1,1,0,1,1,0,1,1,0,0,0,],[0,0,0,1,0,0,1,0,0,1,0,0,1,0,0,1,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,'small3',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'small3',0,],[0,0,0,0,1,0,0,'small2',0,0,'boss1',0,0,'small2',0,0,1,0,0,0,],[0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,1,1,0,0,0,],[0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,1,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,],[0,0,0,0,1,1,0,0,0,0,0,0,0,0,1,1,0,0,0,0,],[0,0,0,1,0,1,0,0,0,0,0,0,0,1,0,1,0,0,0,0,],[0,0,0,1,0,0,1,0,0,0,0,0,0,1,0,0,1,0,0,0,],[0,0,1,0,0,0,1,0,0,0,0,0,1,0,0,0,1,0,0,0,],[0,0,0,1,0,0,1,0,0,0,0,0,0,1,0,0,1,0,0,0,],[0,0,0,1,0,1,0,0,0,0,0,0,0,1,0,1,0,0,0,0,],[0,0,0,0,1,1,0,0,0,0,0,0,0,0,1,1,0,0,0,0,],[0,0,0,0,1,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,1,1,0,0,0,0,1,1,0,0,0,0,1,1,0,0,0,],[0,0,0,1,0,1,0,0,0,1,0,1,0,0,0,1,0,1,0,0,],[0,0,1,0,0,1,0,0,1,0,0,1,0,0,1,0,0,1,0,0,],[0,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,],[0,0,1,0,0,1,0,0,1,0,0,1,0,0,1,0,0,1,0,0,],[0,0,0,1,0,1,0,0,0,1,0,1,0,0,0,1,0,1,0,0,],[0,0,0,1,1,0,0,0,0,1,1,0,0,0,0,1,1,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,],[0,0,0,1,1,0,0,0,0,1,1,0,0,0,0,1,1,0,0,0,],[0,0,0,1,0,1,0,0,0,0,1,0,0,0,0,1,0,1,0,0,],[0,0,1,0,0,1,0,0,0,1,1,0,0,0,1,0,0,1,0,0,],[0,0,1,0,1,0,1,0,0,1,0,1,0,0,1,0,1,0,1,0,],[0,0,1,0,0,1,0,0,1,0,0,1,0,0,1,0,0,1,0,0,],[0,0,0,1,0,1,0,0,1,0,1,0,1,0,0,1,0,1,0,0,],[0,0,0,1,1,0,0,0,1,0,0,1,0,0,0,1,1,0,0,0,],[0,0,0,0,0,0,0,0,0,1,0,1,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,],[0,0,0,0,1,0,0,0,0,1,1,0,0,0,0,1,0,0,0,0,],[0,0,0,0,1,1,0,0,0,0,1,0,0,0,0,1,1,0,0,0,],[0,0,0,1,1,1,0,0,1,0,0,1,0,0,1,1,1,0,0,0,],[0,0,0,1,1,1,1,0,1,1,0,1,1,0,1,1,1,1,0,0,],[0,0,0,1,1,1,0,0,1,0,0,1,0,0,1,1,1,0,0,0,],[0,0,0,0,1,1,0,0,0,0,1,0,0,0,0,1,1,0,0,0,],[0,0,0,0,1,0,0,0,0,1,1,0,0,0,0,1,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,],[0,0,0,1,0,1,0,0,0,1,1,1,0,0,0,1,0,1,0,0,],[0,0,1,1,1,1,0,0,1,1,1,1,0,0,1,1,1,1,0,0,],[0,0,0,1,0,1,0,0,0,1,0,1,0,0,0,1,0,1,0,0,],[0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,0,1,1,0,0,],[0,0,0,1,0,0,1,0,0,0,1,0,0,0,1,0,0,1,0,0,],[0,0,1,1,0,1,1,0,0,1,1,0,0,1,1,0,1,1,0,0,],[0,0,0,1,0,0,1,0,0,0,1,0,0,0,1,0,0,1,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,1,1,1,0,0,0,1,1,1,0,0,0,0,0,],[0,0,0,0,0,0,1,1,0,0,0,0,1,1,0,0,0,0,0,0,],[0,0,0,0,'boss2',0,0,1,0,0,'boss2',0,0,1,0,0,'boss2',0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,1,1,0,0,],[0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,1,1,1,0,0,0,1,1,1,0,0,0,0,0,],[0,0,0,0,0,0,1,1,0,0,0,0,1,1,0,0,0,0,0,0,],[0,0,0,0,0,0,0,1,0,0,0,0,0,1,0,0,0,0,0,0,],[0,0,0,0,0,0,'small4',0,0,0,0,0,0,'small4',0,0,0,0,0,0,],[0,0,0,1,1,0,0,0,0,0,'small8',0,0,0,0,0,1,1,0,0,],[0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,1,1,0,0,0,'small8',0,0,0,1,1,0,0,0,0,],[0,0,'boss3',0,1,1,0,0,0,0,0,0,0,0,1,1,0,'boss3',0,0,],[0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,1,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,'small4',0,0,0,0,'small8',0,0,0,0,'small4',0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,0,],[0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,1,1,0,0,0,0,1,1,0,0,0,0,0,0,],[0,0,0,0,0,0,1,1,1,0,'small8',0,1,1,1,0,0,0,0,0,],[0,0,0,'small1',0,0,1,1,0,0,0,0,1,1,0,0,'small1',0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,1,0,0,'small4',0,0,0,0,0,0,'small4',0,0,1,0,0,0,],[0,0,0,1,1,0,0,0,0,0,'small8',0,0,0,0,0,1,1,0,0,],[0,0,0,1,0,0,'small2',0,0,0,0,0,0,'small2',0,0,1,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,'small1',0,0,0,'small4',0,0,0,0,'small2',0,0,0,'small8',0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,1,1,0,0,1,1,0,0,0,0,1,1,0,0,1,1,0,0,],[0,0,1,1,1,0,1,1,1,0,0,0,1,1,1,0,1,1,1,0,],[0,0,1,1,0,0,1,1,0,0,0,0,1,1,0,0,1,1,0,0,],[0,0,0,1,0,'small8',0,1,0,0,'small3',0,0,1,0,'small5',0,1,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,1,0,0,0,1,1,1,0,0,0,1,0,0,0,0,],[0,0,0,0,1,1,0,0,0,1,1,0,0,0,1,1,0,0,0,0,],[0,0,0,1,1,1,1,1,0,0,1,0,0,1,1,1,1,1,0,0,],[0,0,0,1,1,1,1,0,0,0,0,0,0,1,1,1,1,0,0,0,],[0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,1,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,1,0,0,0,1,1,0,0,0,1,0,0,0,0,0,],[0,0,0,0,1,1,1,0,0,1,1,1,0,0,1,1,1,0,0,0,],[0,0,0,1,1,1,1,0,0,1,1,0,0,1,1,1,1,0,0,0,],[0,0,0,1,1,1,1,1,0,1,1,1,0,1,1,1,1,1,0,0,],[0,0,0,1,1,1,1,0,0,1,1,0,0,1,1,1,1,0,0,0,],[0,0,0,0,0,1,0,0,0,0,1,0,0,0,0,1,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,1,0,0,1,1,0,0,1,0,0,0,0,0,0,],[0,0,0,1,1,1,0,1,1,1,1,1,1,1,0,1,1,1,0,0,],[0,0,1,1,1,1,0,1,1,1,1,1,1,0,1,1,1,1,0,0,],[0,0,1,1,1,1,1,0,1,1,1,1,1,0,1,1,1,1,1,0,],[0,0,1,1,1,1,0,0,1,1,1,1,0,0,1,1,1,1,0,0,],[0,0,0,1,1,1,0,0,0,1,1,1,0,0,0,1,1,1,0,0,],[0,0,0,1,1,0,0,0,0,1,1,0,0,0,0,1,1,0,0,0,],[0,0,0,0,1,0,0,0,0,0,1,0,0,0,0,0,1,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,1,1,1,1,1,1,1,0,0,0,0,0,0,],[0,0,0,0,0,0,0,1,1,1,1,1,1,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,1,1,1,1,1,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,1,1,1,1,0,0,0,0,0,0,0,0,],[0,0,0,1,0,0,0,0,1,1,1,1,0,0,0,0,0,1,0,0,],[0,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,0,],[0,0,0,1,0,1,0,1,1,1,1,1,1,0,0,1,0,1,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,1,0,0,0,0,0,0,1,1,0,0,0,0,0,0,1,0,0,],[0,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,],[0,0,1,0,1,0,0,1,1,1,1,1,1,0,0,1,0,1,0,0,],[0,0,0,0,0,0,0,0,1,1,1,1,1,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,1,1,1,1,0,0,0,0,0,0,0,0,],[0,0,0,1,0,0,0,0,1,1,1,1,0,0,0,0,0,1,0,0,],[0,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,0,],[0,0,0,1,0,1,0,1,1,1,1,1,1,0,0,1,0,1,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,'small4',0,0,0,0,1,1,0,0,0,0,'small4',0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,],[0,0,0,1,1,1,0,0,0,1,1,1,0,0,0,0,1,0,0,0,],[0,0,0,1,1,0,0,0,0,1,1,0,0,0,0,1,1,0,0,0,],[0,0,1,1,1,1,1,0,0,0,1,0,0,0,1,1,1,1,1,0,],[0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,1,1,0,0,0,],[0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,],[0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,1,1,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,1,1,0,0,1,1,0,0,0,0,0,0,0,],[0,0,0,1,1,1,0,0,1,0,0,0,1,0,0,0,1,0,0,0,],[0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,1,1,0,0,0,],[0,0,1,1,1,1,1,0,0,0,'boss8',0,0,0,1,1,1,1,1,0,],[0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,1,1,0,0,0,],[0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,],[0,0,0,1,1,0,0,'small4',0,0,0,0,'small4',0,0,1,1,0,0,0,],[0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,],[0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,0,1,1,0,0,],[0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,'small2',0,0,0,0,0,0,'small2',0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,1,1,1,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,],[0,0,0,0,'boss8',0,0,0,1,1,1,1,1,0,0,0,'boss8',0,0,0,],[0,0,0,0,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,],[0,0,0,'small2',0,'small4',0,0,0,0,0,0,0,0,'small4',0,'small2',0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,'small3',0,0,0,0,0,0,'small3',0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,1,1,1,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,1,1,1,1,0,0,0,0,0,0,0,0,],[0,0,0,0,'boss8',0,0,0,1,1,1,1,1,0,0,0,'boss8',0,0,0,],[0,0,0,0,0,0,0,0,1,1,1,1,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,1,1,1,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,'small3',0,0,1,1,0,0,'small3',0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,1,1,1,0,0,0,0,0,0,0,0,],[0,0,'boss5',0,0,0,0,0,1,1,1,1,0,0,0,0,0,'boss5',0,0,],[0,0,0,0,0,0,0,0,1,1,1,1,1,0,0,0,0,0,0,0,],[0,0,0,0,'small5',0,0,0,1,1,1,1,0,0,0,'small5',0,0,0,0,],[0,0,0,0,0,0,0,0,0,1,1,1,0,0,0,0,0,0,0,0,],[0,1,1,0,0,0,0,0,0,1,1,0,0,0,0,0,0,1,1,0,],[0,0,1,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,1,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,],[0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,1,1,0,0,0,],[0,0,1,1,1,0,0,0,0,1,0,0,0,0,1,1,1,0,0,0,],[0,0,0,1,1,0,0,0,0,1,1,0,0,0,0,1,1,0,0,0,],[0,0,0,1,0,0,0,0,1,1,1,0,0,0,0,1,0,0,0,0,],[0,0,0,0,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,],[0,0,1,1,1,0,0,0,0,0,0,0,0,0,1,1,1,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,1,1,1,0,0,0,0,0,0,0,0,0,1,1,1,0,0,0,],[0,0,0,1,1,0,0,0,0,1,1,0,0,0,0,1,1,0,0,0,],[0,0,0,1,0,0,0,0,1,1,1,0,0,0,0,1,0,0,0,0,],[0,0,0,1,1,0,0,0,0,1,1,0,0,0,0,1,1,0,0,0,],[0,0,1,1,1,0,0,0,1,1,1,0,0,0,1,1,1,0,0,0,],[0,0,0,0,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,1,1,0,0,0,0,1,0,0,0,0,1,1,0,0,0,0,],[0,0,1,1,1,1,1,0,0,1,1,0,0,1,1,1,1,1,0,0,],[0,0,1,1,1,1,0,0,1,1,1,0,0,1,1,1,1,0,0,0,],[0,0,0,1,0,1,0,0,0,1,1,0,0,0,1,0,1,0,0,0,],[0,0,1,1,1,1,0,0,0,1,0,0,0,1,1,1,1,0,0,0,],[0,0,0,1,0,1,0,0,0,1,1,0,0,0,1,0,1,0,0,0,],[0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,1,1,0,0,0,0,1,1,0,0,0,0,0,0,],[0,0,0,0,0,1,0,1,0,0,0,1,0,1,0,0,0,0,0,0,],[0,0,1,1,1,1,0,0,1,1,1,1,0,0,1,1,1,1,0,0,],[0,1,0,0,1,1,0,1,1,0,1,1,0,1,1,0,0,1,0,0,],[0,0,1,0,0,1,1,1,1,0,0,1,1,1,1,0,0,1,0,0,],[0,0,1,0,1,0,0,0,1,0,1,0,0,0,1,0,1,0,0,0,],[0,0,0,1,1,0,0,0,0,1,1,0,0,0,0,1,1,0,0,0,],[0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,1,0,0,0,0,1,0,0,0,0,1,0,0,0,0,0,],[0,1,1,1,0,0,1,1,1,0,0,1,1,1,0,0,1,1,1,0,],[1,0,0,1,0,1,0,0,1,0,1,0,0,1,0,1,0,0,1,0,],[1,0,1,0,1,1,0,1,0,1,1,0,1,0,1,1,0,1,0,1,],[1,0,0,1,1,1,0,0,1,1,1,0,0,1,1,1,0,0,1,0,],[0,1,1,1,0,0,1,1,1,0,0,1,1,1,0,0,1,1,1,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,1,1,0,0,0,1,1,0,0,0,1,1,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,1,1,1,0,0,0,0,0,0,0,0,0,0,1,1,1,0,0,],[0,1,1,1,1,0,0,0,0,0,0,0,0,0,1,1,1,1,0,0,],[0,0,1,1,1,0,0,0,0,0,0,0,0,0,0,1,1,1,0,0,],[0,0,0,0,0,0,0,0,0,'small2',0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,'small4',0,0,0,0,0,0,0,0,0,0,0,0,'small4',0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,1,1,1,1,0,0,0,0,0,0,0,0,],[0,0,1,1,1,0,0,0,0,0,0,0,0,0,0,1,1,1,0,0,],[0,1,1,1,1,0,0,0,0,0,0,0,0,0,1,1,1,1,0,0,],[0,0,1,1,1,0,0,0,0,0,'small4',0,0,0,0,1,1,1,0,0,],[0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,1,1,0,0,0,],[0,0,0,1,0,0,0,0,0,0,'small2',0,0,0,0,0,1,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,1,1,1,1,0,0,0,0,0,0,0,0,],[0,0,1,1,1,0,0,0,0,0,'small4',0,0,0,0,0,1,1,1,0,],[0,1,1,1,1,0,0,0,0,0,0,0,0,0,0,1,1,1,1,0,],[0,0,1,1,1,0,0,0,0,1,1,1,0,0,0,0,1,1,1,0,],[0,0,1,1,0,0,0,0,0,1,1,0,0,0,0,0,1,1,0,0,],[0,0,0,1,1,1,0,0,0,0,1,0,0,0,0,1,1,1,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,'small2',0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,1,1,1,1,0,0,0,0,0,0,0,0,],[0,0,0,0,1,1,1,0,0,0,0,0,0,1,1,1,0,0,0,0,],[0,1,1,1,1,0,0,0,0,0,0,0,0,0,1,1,1,1,0,0,],[0,0,1,1,1,0,0,0,0,0,'boss2',0,0,0,0,1,1,1,0,0,],[0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,1,1,0,0,0,],[0,0,0,1,0,0,0,0,0,1,1,1,0,0,0,0,1,0,0,0,],[0,0,0,0,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,],[0,'small3',0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,'small3',0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,1,1,1,1,0,0,0,'boss3',0,0,0,1,1,1,1,0,0,],[0,0,0,0,1,1,1,0,0,0,0,0,0,1,1,1,0,0,0,0,],[0,0,1,1,1,1,1,1,0,0,0,0,0,1,1,1,1,1,1,0,],[0,0,1,1,1,1,1,0,0,0,0,0,0,1,1,1,1,1,0,0,],[0,0,0,1,1,0,1,0,0,1,1,1,0,0,1,0,1,1,0,0,],[0,0,0,1,1,0,0,0,0,1,1,0,0,0,0,1,1,0,0,0,],[0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,],[0,0,0,'small7',0,0,0,0,0,0,0,0,0,0,0,0,'small7',0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,1,1,1,1,0,0,0,0,1,0,0,0,1,1,1,1,0,0,],[0,0,1,1,1,0,0,0,0,1,0,0,0,0,1,1,1,0,0,0,],[0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,1,1,1,1,0,0,0,0,1,0,0,0,1,1,1,1,0,0,],[0,0,1,1,1,0,0,0,0,1,1,0,0,0,1,1,1,0,0,0,],[0,0,1,1,1,1,0,0,0,0,1,1,0,0,1,1,1,1,0,0,],[0,0,1,1,1,0,0,0,0,1,1,0,0,0,1,1,1,0,0,0,],[0,0,0,0,0,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,1,1,1,1,0,1,1,1,0,1,1,1,1,0,0,0,],[0,0,0,0,1,1,1,0,0,1,1,0,0,1,1,1,0,0,0,0,],[0,0,1,1,1,1,0,0,0,1,1,1,0,0,0,1,1,1,1,0,],[0,0,1,1,1,0,0,0,0,1,1,0,0,0,1,1,1,0,0,0,],[0,0,0,0,0,0,0,0,0,1,1,1,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,1,1,1,0,0,0,0,0,1,0,0,0,0,1,1,1,0,0,],[0,1,1,1,1,0,0,0,0,1,1,0,0,0,1,1,1,1,0,0,],[0,0,1,1,1,0,0,0,0,1,1,1,0,0,0,1,1,1,0,0,],[0,1,1,1,1,0,0,0,1,1,1,1,0,0,1,1,1,1,0,0,],[0,0,1,1,1,0,0,0,0,1,0,1,0,0,0,1,1,1,0,0,],[0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,1,1,0,0,0,],[0,0,1,1,1,0,0,0,0,0,0,0,0,0,0,1,1,1,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,],[0,0,1,1,1,0,0,0,0,1,1,0,0,0,0,1,1,1,0,0,],[0,1,0,0,1,0,0,0,1,1,1,0,0,0,1,0,0,1,0,0,],[0,0,1,1,1,0,0,0,1,1,1,1,0,0,0,1,1,1,0,0,],[0,1,1,1,1,0,0,0,1,1,1,0,0,0,1,1,1,1,0,0,],[0,0,1,1,1,0,0,0,0,1,1,0,0,0,0,1,1,1,0,0,],[0,0,0,0,0,0,0,0,1,1,1,0,0,0,0,0,0,0,0,0,],[0,0,1,1,1,0,0,0,1,1,1,1,0,0,0,1,1,1,0,0,],[0,0,0,0,0,0,0,0,1,0,1,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],];;