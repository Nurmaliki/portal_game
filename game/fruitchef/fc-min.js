/* www.tweensoft.com */
var config={speed_x:12,speed_y_max:-48,speed_y_min:-62,rotation:6,acceleration_y:2.2,time:10,ration:10,push:[1,1,1,3,1,4,1,5],combo_time:0.22,glow_cout:50,glow_time:10,knife_credits:[0,900,1800,2400],url_button_gamepad:"http://www.tweensoft.com/",url_logo:"http://www.tweensoft.com/",screen_time:1.5,url_screen:"http://www.tweensoft.com/",add_home_post:5,fb_post:10,appId:'646368918760094',fb_name:'Fruit Chef',fb_caption:'Hey!',fb_description:'I am playing Fruit Chef. Come check it out!',special_point:5000,special_time:10,special_push:[2,3,3,4],special:[{items:5,chances:3},{items:5,chances:3},{items:5,chances:3},{items:5,chances:3},{items:5,chances:3},{items:6,chances:2},{items:6,chances:2},{items:6,chances:2},{items:6,chances:2},{items:7,chances:2},{items:7,chances:2},{items:7,chances:2},{items:7,chances:2},{items:7,chances:2},{items:7,chances:2},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1},{items:7,chances:1}]};var addToHomeConfig={autostart:false};var canvas_game,stage_game;var location_game,main_menu,load,pause_menu,end_menu,save,help,setting,best,market,about,help_s;var bg_img,l2p;var screen_time,screen_a;var music,splice,splice_mute,audio_supported;(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(d.getElementById(id)){return;}
js=d.createElement(s);js.id=id;js.src="//connect.facebook.net/en_US/all.js";fjs.parentNode.insertBefore(js,fjs);}(document,'script','facebook-jssdk'));function init_game()
{FB.init({appId:config.appId,status:true,xfbml:true});canvas_game=document.getElementById("canvas_game");stage_game=new createjs.Stage(canvas_game);stage_game.autoClear=false;pad_save=0;l2p=null;if(window.orientation!==undefined)
{l2p=document.createElement("img");l2p.id="imgl2p";l2p.src="assets/l2p.png";l2p.unselectable="on";document.body.appendChild(l2p);var style=document.createElement("style");style.appendChild(document.createTextNode("@media all and (orientation:landscape) { #imgl2p{ display: block; } #gameArea{ display: none; }"));document.head.appendChild(style);}
load=new ClassLoad();save=new ClassSave();ResizeLoadGame();window.addEventListener('resize',ResizeLoadGame,false);}
function DrwUpd()
{if(screen_time>0)
{screen_time-=0.03;if(screen_time<=0)
{stage_game.removeChild(screen_a);main_menu.Open();}}
location_game.DrwUpd();if(end_menu.GetImg.visible)end_menu.DrwUpd();if(market.GetImg.visible)market.DrwUpd();stage_game.clear();stage_game.update();}
function ResizeLoadGame()
{var gameArea=document.getElementById('gameArea');document.body.style.height=((window.innerHeight*2)<<0)+'px';window.scrollTo(0,1);var newHeight=window.innerHeight;var newWidth=newHeight*(792/920);var pxls=newWidth/792;var pad=Math.max((newWidth-window.innerWidth)/2,0);canvas_game.style.width=(newWidth<<0)+'px';canvas_game.style.height=(newHeight<<0)+'px';gameArea.style.width=(newWidth<<0)+'px';gameArea.style.height=(newHeight<<0)+'px';gameArea.style.marginLeft=(-newWidth/2)+'px';load.Resize((pad<<0)/pxls);if(l2p!=null)
{var wh=Math.min(window.innerHeight,Math.min(window.innerWidth,250));l2p.style.height=wh+"px";l2p.style.width=wh+"px";l2p.style.marginLeft=wh/(-2)+"px";l2p.style.marginTop=wh/(-2)+"px";}}
function ResizeGame()
{var gameArea=document.getElementById('gameArea');document.body.style.height=((window.innerHeight*2)<<0)+'px';window.scrollTo(0,1);var newHeight=window.innerHeight;var newWidth=newHeight*(792/920);var newWidth2=newHeight*(640/920);var pxls=newWidth/792;var pad=Math.max((newWidth-window.innerWidth)/2,0);if(pad>(newWidth-newWidth2)/2)
{newWidth=window.innerWidth;newHeight=newWidth/(640/920);newWidth=newHeight*(792/920);pxls=newWidth/792;pad=Math.max((newWidth-window.innerWidth)/2,0);}
canvas_game.style.width=(newWidth<<0)+'px';canvas_game.style.height=(newHeight<<0)+'px';canvas_life.style.width=((186*pxls)<<0)+'px';canvas_life.style.height=((82*pxls)<<0)+'px';canvas_life.style.marginLeft=(-(93*pxls)<<0)+'px';canvas_special.style.width=((792*pxls)<<0)+'px';canvas_special.style.height=((128*pxls)<<0)+'px';canvas_special.style.marginLeft=(-(396*pxls)<<0)+'px';canvas_score.style.width=((224*pxls)<<0)+'px';canvas_score.style.height=((74*pxls)<<0)+'px';canvas_score.style.marginLeft=((-(224*pxls)-pad)<<0)+'px';canvas_cout.style.width=((328*pxls)<<0)+'px';canvas_cout.style.height=((104*pxls)<<0)+'px';canvas_cout.style.marginLeft=(pad<<0)+'px';gameArea.style.width=(newWidth<<0)+'px';gameArea.style.height=(newHeight<<0)+'px';gameArea.style.marginLeft=(-newWidth/2)+'px';location_game.special.Resize((pad<<0)/pxls);location_game.glow.Resize((pad<<0)/pxls);load.Resize((pad<<0)/pxls);if(l2p!=null)
{var wh=Math.min(window.innerHeight,Math.min(window.innerWidth,250));l2p.style.height=wh+"px";l2p.style.width=wh+"px";l2p.style.marginLeft=wh/(-2)+"px";l2p.style.marginTop=wh/(-2)+"px";}}
function LoadCompleteStartGame()
{load.Close();stage_game.removeAllChildren();load.Clear();CreateData();location_game=new ClassLocationGame();location_game.CreateGame();main_menu=new ClassMainMenu();pause_menu=new ClassPauseMenu();end_menu=new ClassMenuEnd();help=new ClassHelp();setting=new ClassSetting();best=new ClassBest();market=new ClassMarket();about=new ClassAbout();help_s=new ClassHelpS();screen_a=new createjs.Bitmap(load.queue.getResult("screen"));screen_a.addEventListener("mousedown",function(){window.open(config.url_screen);},false);stage_game.addChild(screen_a);screen_time=config.screen_time;CreateMouse();window.removeEventListener('resize',ResizeLoadGame,false);ResizeGame();window.addEventListener('resize',ResizeGame,false);createjs.Ticker.setFPS(30);createjs.Ticker.addEventListener("tick",DrwUpd);}
function MenuToLocation()
{if(load.audio_cm)load.LoadAudio();main_menu.Close();location_game.Restart();if(save.special)
{help_s.Open();}
else
{if(save.help)
help.Open(0);else
market.Open();}}
function PauseToMenu()
{location_game.pause=true;main_menu.Open();pause_menu.Close();}
function LocationToPause()
{location_game.pause=true;pause_menu.Open();location_game.Close();}
function PauseToLocation()
{location_game.Open();pause_menu.Close();}
function LocationToEndMenu(n,point,sliced)
{end_menu.Open(n,point,sliced);location_game.Close();}
function EndMenuToMenu()
{main_menu.Open();end_menu.Close();}
function EndMenuToLocation()
{location_game.Restart();if(save.special)
help_s.Open();else
market.Open();end_menu.Close();}
function HelpToMenu()
{main_menu.Open();help.Close();}
function PauseToHelp()
{help.Open(1);pause_menu.Close();}
function HelpToPause()
{pause_menu.Open();help.Close();}
function HelpToLocation()
{if(save.help)save.OffHelp();location_game.Open();help.Close();}
function SettingToMenu()
{main_menu.Open();setting.Close();}
function MenuToSetting()
{if(load.audio_cm)load.LoadAudio();setting.Open();main_menu.Close();}
function HelpToSetting()
{setting.Open();help.Close();}
function SettingToHelp()
{help.Open(2);setting.Close();}
function BestToMenu()
{main_menu.Open();best.Close();}
function MenuToBest()
{if(load.audio_cm)load.LoadAudio();best.Open();main_menu.Close();}
function MarketToMenu()
{main_menu.Open();market.Close();}
function MarketToLocation()
{location_game.Open();market.Close();}
function AboutToSetting()
{setting.Open();about.Close();}
function SettingToAbout()
{about.Open();setting.Close();}
function HelpSToLocation()
{location_game.Open();help_s.Close();}function ClassGlow()
{this.cout=0;this.include=false;this.sin_cos=0;this.GetImg=new createjs.Container();this.GetImg.visible=false;this.g0=new createjs.Shape();this.g0.graphics.beginLinearGradientFill(["rgba(255,255,255,1)","rgba(255,255,255,0)"],[0,1],0,0,0,60).rect(0,0,792,60);this.g0.y=0;this.g1=new createjs.Shape();this.g1.graphics.beginLinearGradientFill(["rgba(255,255,255,1)","rgba(255,255,255,0)"],[1,0],0,0,0,60).rect(0,0,792,60);this.g1.y=880;this.g2=new createjs.Shape();this.g2.graphics.beginLinearGradientFill(["rgba(255,255,255,1)","rgba(255,255,255,0)"],[0,1],0,0,60,0).rect(0,0,60,960);this.g2.x=0;this.g3=new createjs.Shape();this.g3.graphics.beginLinearGradientFill(["rgba(255,255,255,1)","rgba(255,255,255,0)"],[1,0],0,0,60,0).rect(0,0,60,960);this.g3.x=752;this.GetImg.addChild(this.g0);this.GetImg.addChild(this.g1);this.GetImg.addChild(this.g2);this.GetImg.addChild(this.g3);}
ClassGlow.prototype.AddCout=function()
{if(!this.include)this.cout++;};ClassGlow.prototype.Upd=function()
{if(this.timer!==0)
{this.sin_cos+=0.2;if(Math.sin(this.sin_cos)>0)this.GetImg.alpha=1;else this.GetImg.alpha=0;this.timer-=0.03;if(this.timer<0)
{this.timer=0;this.Off();}}};ClassGlow.prototype.Resize=function(pad)
{this.g2.x=pad;this.g3.x=752-pad;};ClassGlow.prototype.On=function()
{this.sin_cos=0;this.GetImg.visible=true;this.include=true;this.timer=config.glow_time;for(i=0;i<5;i++)
location_game.start_fruits[i].GlowOn();};ClassGlow.prototype.Off=function()
{this.GetImg.visible=false;this.include=false;this.timer=0;for(i=0;i<5;i++)
location_game.start_fruits[i].GlowOff();};var home_cout,fb_cout;function ClassMarket()
{home_cout=0;fb_cout=0;this.GetImg=new createjs.Container();this.btn_menu=new createjs.Shape();this.btn_menu.graphics.beginFill("#f00").drawCircle(134,864,48);this.btn_menu.addEventListener("mousedown",MarketToMenu,false);this.GetImg.addChild(this.btn_menu);this.btn_go=new createjs.Shape();this.btn_go.graphics.beginFill("#f00").drawCircle(656,864,48);this.btn_go.addEventListener("mousedown",MarketToLocation,false);this.GetImg.addChild(this.btn_go);var l_hit_test=new createjs.Shape();l_hit_test.graphics.beginFill("#f00").drawCircle(150+44,460+50,48);l_hit_test.addEventListener("mousedown",function(){market.Add(-1);},false);var r_hit_test=new createjs.Shape();r_hit_test.graphics.beginFill("#f00").drawCircle(568+24,460+50,48);r_hit_test.addEventListener("mousedown",function(){market.Add(1);},false);this.btn_knife=new createjs.Shape();this.btn_knife.graphics.beginFill("#f00").drawCircle(396,520,120);this.btn_knife.addEventListener("mousedown",KnifeCl,false);this.GetImg.addChild(this.btn_knife);this.GetImg.addChild(l_hit_test);this.GetImg.addChild(r_hit_test);var bg=new createjs.Bitmap(load.queue.getResult("bg_upgrade"));bg.x=76;this.GetImg.addChild(bg);this.glow=ss_sprite.clone();this.glow.gotoAndStop("glow");this.glow.x=246;this.glow.y=380;this.GetImg.addChild(this.glow);this.mark=ss_sprite.clone();this.mark.gotoAndStop("mark_round");this.mark.x=260;this.mark.y=274;this.GetImg.addChild(this.mark);this.btn_l=ss_sprite.clone();this.btn_l.gotoAndStop("btn_l");this.btn_l.x=190-30;this.btn_l.y=480;this.GetImg.addChild(this.btn_l);this.btn_r=ss_sprite.clone();this.btn_r.gotoAndStop("btn_r");this.btn_r.x=558+20;this.btn_r.y=480;this.GetImg.addChild(this.btn_r);this.knife=ss_sprite.clone();this.knife.gotoAndStop("knife_0");this.knife.x=254;this.knife.y=360;this.GetImg.addChild(this.knife);this.mark_knife=ss_sprite.clone();this.mark_knife.gotoAndStop("mark_green");this.mark_knife.x=434;this.mark_knife.y=456;this.GetImg.addChild(this.mark_knife);this.credits=new ClassFont(6,1);this.credits.GetImg.x=630;this.credits.GetImg.y=172;this.GetImg.addChild(this.credits.GetImg);this.knife_credits=new ClassFont(6,1);this.knife_credits.GetImg.x=396;this.knife_credits.GetImg.y=640;this.knife_credits.GetImg.scaleX=this.knife_credits.GetImg.scaleY=0.8;this.GetImg.addChild(this.knife_credits.GetImg);this.knife_credits_s=ss_sprite.clone();this.knife_credits_s.gotoAndStop("yellow_dollar");this.knife_credits_s.x=388;this.knife_credits_s.y=640;this.knife_credits_s.scaleX=this.knife_credits_s.scaleY=0.8;this.GetImg.addChild(this.knife_credits_s);this.gold=ss_sprite.clone();this.gold.gotoAndStop("gold");this.gold.x=630;this.gold.y=160;this.GetImg.addChild(this.gold);this.knife_i=0;this.step=0;this.sleep=0;stage_game.addChild(this.GetImg);this.Close();}
ClassMarket.prototype.Add=function(a)
{this.knife_i+=a;if(this.knife_i<0)
this.knife_i=3;if(this.knife_i>3)
this.knife_i=0;this.mark.x=260+70*this.knife_i;this.knife.gotoAndStop("knife_"+this.knife_i);if(this.knife_i===0)
{this.btn_knife.visible=false;this.glow.visible=true;this.mark_knife.gotoAndStop("mark_green");this.knife_credits.GetImg.visible=false;this.knife_credits_s.visible=false;}
else
{this.knife_credits_s.visible=true;this.btn_knife.visible=true;this.glow.visible=false;this.mark_knife.gotoAndStop("mark_buy");this.knife_credits.GetImg.visible=true;this.knife_credits.Set(config.knife_credits[this.knife_i]);this.knife_credits.GetImg.regX=this.knife_credits.GetImg.width/2-28;this.knife_credits_s.x=360-this.knife_credits.GetImg.regX;}};ClassMarket.prototype.DrwUpd=function()
{if(!this.GetImg.mouseEnabled)
{if(save.credits<this.credits.GetValue)
{if(save.credits>=(this.credits.GetValue-this.step))
{this.sleep=0.5;this.credits.Set(save.credits);this.credits.GetImg.x=630-this.credits.GetImg.width;this.gold.x=510-this.credits.GetImg.width;}
else
{this.credits.Set(this.credits.GetValue-this.step);this.credits.GetImg.x=630-this.credits.GetImg.width;this.gold.x=510-this.credits.GetImg.width;}}
if(this.sleep>0)
{this.sleep-=0.03;if(this.sleep<0)
{MarketToLocation();}}}};ClassMarket.prototype.Open=function()
{if((home_cout===0)&&(save.addHs!==0)){addToHome.show(true);save.AddHomeScreen();}
home_cout++;if(home_cout===config.add_home_post)home_cout=0;if(fb_cout===(config.fb_post-1))
{FB.ui({method:'feed',name:config.fb_name,link:window.location.href,picture:window.location.href.substring(0,window.location.href.lastIndexOf('/')+1)+"assets/facebook.jpg",caption:config.fb_caption,description:config.fb_description},function(response){});fb_cout=0;}
fb_cout++;this.sleep=0;this.knife_credits_s.visible=false;this.btn_knife.visible=false;this.GetImg.mouseEnabled=true;this.credits.Set(save.credits);this.credits.GetImg.x=630-this.credits.GetImg.width;this.gold.x=510-this.credits.GetImg.width;this.glow.visible=true;this.mark_knife.gotoAndStop("mark_green");this.knife_credits.GetImg.visible=false;this.mark.x=260;this.knife.gotoAndStop("knife_0");this.knife_i=0;this.GetImg.visible=true;};ClassMarket.prototype.Close=function()
{this.GetImg.visible=false;location_game.combo.knife=this.knife_i+1;};function KnifeCl()
{if(save.credits>=config.knife_credits[market.knife_i])
{market.glow.visible=true;market.mark_knife.gotoAndStop("mark_green");market.GetImg.mouseEnabled=false;save.AddCredits(-config.knife_credits[market.knife_i]);market.step=config.knife_credits[market.knife_i]/40;}}function ClassHelpS()
{this.GetOldWindow=0;this.GetImg=new createjs.Container();this.btn_bac=new createjs.Shape();this.btn_bac.graphics.beginFill("#f00").drawCircle(662,860,50);this.btn_bac.addEventListener("mousedown",HelpSToLocation,false);this.GetImg.addChild(this.btn_bac);var bg=new createjs.Bitmap(load.queue.getResult("bg_help_2"));bg.x=76;this.GetImg.addChild(bg);this.GetFont=new ClassFont(2,1);this.GetFont.GetImg.x=614;this.GetFont.GetImg.y=18;this.GetImg.addChild(this.GetFont.GetImg);stage_game.addChild(this.GetImg);this.Close();}
ClassHelpS.prototype.Open=function()
{this.GetFont.Set(save.special_num+1);this.GetImg.visible=true;};ClassHelpS.prototype.Close=function()
{this.GetImg.visible=false;};var k_0,k_1;function ClassGameLogic()
{this.logic=1;this.game_over=false;this.time=0;this.f_cout=0;this.random_bad=0.5*(config.ration/100.0);this.push_i=1;this.mouse_graphics=new createjs.Graphics();this.mouse_draw=new createjs.Shape(this.mouse_graphics);this.mouse_draw.alpha=0.4;this.mouse_xboct=[6];for(i=0;i<6;i++)
this.mouse_xboct[i]={x:0,y:0};this.fx=ss_sprite.clone();this.fx.gotoAndStop("fx");this.fx.regX=94;this.fx.regY=9;}
ClassGameLogic.prototype.Restart=function()
{k_0=0;k_1=5;this.game_over=false;this.time=0;this.f_cout=0;this.random_bad=0.5*(config.ration/100.0);this.push_i=1;this.fx.alpha=0;};ClassGameLogic.prototype.DrwUpd=function()
{if(this.logic===0)
this.DrwUpd0();else
this.DrwUpd1();};ClassGameLogic.prototype.DrwUpd0=function()
{this.time+=30/1000;if(this.time>config.time)
{this.random_bad+=0.5*(config.ration/100.0);if(this.random_bad>0.5)this.random_bad=0.5;this.push_i+=2;if(this.push_i>config.push.length)this.push_i-=2;this.time=0;}
if(mouse_down)
{this.DrwUpdMouse();mouse_normal.x=this.mouse_xboct[4].x-mouse.x;mouse_normal.y=this.mouse_xboct[4].y-mouse.y;mouse_lng=Math.sqrt(mouse_normal.x*mouse_normal.x+mouse_normal.y*mouse_normal.y);if(mouse_lng>2)
{mouse_step=((mouse_lng/40)<<0)+1;mouse_d.x=mouse_normal.x/mouse_step;mouse_d.y=mouse_normal.y/mouse_step;mouse_normal.x=mouse_normal.x/mouse_lng;mouse_normal.y=mouse_normal.y/mouse_lng;for(j=0;j<mouse_step;j++)
{for(i=0;i<location_game.start_fruits.length;i++)
if(location_game.start_fruits[i].GetImg.visible&&location_game.start_fruits[i].GetImg.hitTest(mouse.x+mouse_d.x*j-location_game.start_fruits[i].GetImg.x,mouse.y+mouse_d.y*j-location_game.start_fruits[i].GetImg.y))
{switch(location_game.start_fruits[i].GetType)
{case 0:location_game.AddCout();this.fx.alpha=1;this.fx.x=location_game.start_fruits[i].GetImg.x;this.fx.y=location_game.start_fruits[i].GetImg.y;this.fx.rotation=Math.atan2(mouse_d.y,mouse_d.x)*57.2975;location_game.start_fruits[i].Kill(mouse_normal,this.fx.rotation);break;case 1:location_game.AddCout();this.fx.alpha=1;this.fx.x=location_game.start_fruits[i].GetImg.x;this.fx.y=location_game.start_fruits[i].GetImg.y;this.fx.rotation=Math.atan2(mouse_d.y,mouse_d.x)*57.2975;location_game.start_fruits[i].Kill(mouse_normal,this.fx.rotation);if(!location_game.glow.include)location_game.glow.On();break;case 3:location_game.life.Add(-3);location_game.start_fruits[i].Kill();break;}}}}}
location_game.combo.Upd();location_game.glow.Upd();if(this.fx.alpha>0)this.fx.alpha-=0.08;for(i=0;i<location_game.all_fruits.length;i++)
location_game.all_fruits[i].DrwUpd();for(i=0;i<location_game.all_fruits.length;i++)
if(location_game.all_fruits[i].GetImg.visible&&location_game.all_fruits[i].GetImg.y>1120)
{location_game.all_fruits[i].GetImg.visible=false;switch(location_game.all_fruits[i].GetType)
{case 0:location_game.life.Add(-1);this.f_cout-=2;break;case 1:if(!location_game.glow.include)location_game.all_fruits[i].GlowOff();location_game.life.Add(-1);this.f_cout-=2;break;case 2:this.f_cout--;break;case 3:this.f_cout-=2;break;}}
if(this.f_cout===0)
this.Shot0();if(this.game_over)
{if((save.credits+location_game.score.GetValue())>=1500)
{for(i=0;i<location_game.all_fruits.length;i++)
{location_game.all_fruits[i].GetImg.visible=false;if(location_game.all_fruits[i].GetType<2)
{location_game.all_fruits[i].GetSpl.visible=false;location_game.all_fruits[i].GetKpl.visible=false;}}
this.fx.alpha=0;location_game.OpenExtraLife();}
else
this.GameOver0();}};ClassGameLogic.prototype.DrwUpd1=function()
{this.time+=30/1000;if(this.time>config.special_time)
{this.push_i+=2;if(this.push_i>config.special_push.length)this.push_i-=2;this.time=0;}
if(mouse_down)
{this.DrwUpdMouse();mouse_normal.x=this.mouse_xboct[4].x-mouse.x;mouse_normal.y=this.mouse_xboct[4].y-mouse.y;mouse_lng=Math.sqrt(mouse_normal.x*mouse_normal.x+mouse_normal.y*mouse_normal.y);if(mouse_lng>2)
{mouse_step=((mouse_lng/40)<<0)+1;mouse_d.x=mouse_normal.x/mouse_step;mouse_d.y=mouse_normal.y/mouse_step;mouse_normal.x=mouse_normal.x/mouse_lng;mouse_normal.y=mouse_normal.y/mouse_lng;for(j=0;j<mouse_step;j++)
{for(i=0;i<location_game.start_fruits.length;i++)
if(location_game.start_fruits[i].GetImg.visible)
if(location_game.start_fruits[i].GetImg.hitTest(mouse.x+mouse_d.x*j-location_game.start_fruits[i].GetImg.x,mouse.y+mouse_d.y*j-location_game.start_fruits[i].GetImg.y))
{location_game.AddCout();this.fx.alpha=1;this.fx.x=location_game.start_fruits[i].GetImg.x;this.fx.y=location_game.start_fruits[i].GetImg.y;this.fx.rotation=Math.atan2(mouse_d.y,mouse_d.x)*57.2975;location_game.start_fruits[i].Kill(mouse_normal,this.fx.rotation);this.game_over=location_game.special.Kill(location_game.start_fruits[i].GetImg.currentAnimation);}}}}
if(this.fx.alpha>0)this.fx.alpha-=0.08;for(i=0;i<location_game.all_fruits.length;i++)
location_game.all_fruits[i].DrwUpd();for(i=0;i<location_game.all_fruits.length;i++)
if(location_game.all_fruits[i].GetImg.visible&&location_game.all_fruits[i].GetImg.y>1120)
{location_game.all_fruits[i].GetImg.visible=false;if(location_game.all_fruits[i].GetType===0)
this.f_cout-=2;else
this.f_cout--;}
if(this.f_cout===0)
this.Shot1();if(this.game_over)
this.GameOver1();};ClassGameLogic.prototype.GameOver0=function()
{save.TestBestCombo(location_game.combo.max_combo);save.TestBestScore(location_game.score.GetValue());save.TestBestCout(location_game.cout.GetValue());LocationToEndMenu(0,location_game.score.GetValue(),location_game.cout.GetValue());};ClassGameLogic.prototype.GameOver1=function()
{if(location_game.special.complete)
LocationToEndMenu(2,config.special[location_game.special.GetNum].items*10,location_game.special.GetNum+1);else
LocationToEndMenu(1,config.special[location_game.special.GetNum].items*10,location_game.special.GetNum+1);};ClassGameLogic.prototype.Shot0=function()
{var cout=config.push[this.push_i-1]+((Math.random()*(config.push[this.push_i]-config.push[this.push_i-1]+1))<<0);this.f_cout=cout*2;for(i=0;i<cout;i++)
{if(Math.random()>this.random_bad)
{if(location_game.glow.cout>=config.glow_cout)
{location_game.start_fruits[k_0].GlowOn();location_game.glow.cout=0;}
location_game.start_fruits[k_0].Shot();k_0++;if(k_0>4)k_0=0;}
else
{location_game.start_fruits[k_1].Shot();k_1++;if(k_1>9)k_1=5;}}};ClassGameLogic.prototype.Shot1=function()
{var cout=config.special_push[this.push_i-1]+((Math.random()*(config.special_push[this.push_i]-config.special_push[this.push_i-1]+1))<<0);this.f_cout=cout*2;for(i=0;i<cout;i++)
{if(Math.random()>location_game.special.chances)
{location_game.start_fruits[k_0].ShotS(location_game.special.good[(Math.random()*location_game.special.good.length)<<0]);k_0++;if(k_0>4)k_0=0;}
else
{location_game.start_fruits[k_0].ShotS(location_game.special.bad[(Math.random()*location_game.special.bad.length)<<0]);k_0++;if(k_0>4)k_0=0;}}};ClassGameLogic.prototype.DrwUpdMouse=function()
{for(i=0;i<5;i++)
{this.mouse_xboct[i].x=this.mouse_xboct[i+1].x;this.mouse_xboct[i].y=this.mouse_xboct[i+1].y;}
this.mouse_xboct[5].x=mouse.x;this.mouse_xboct[5].y=mouse.y;this.mouse_graphics.clear();this.mouse_graphics.setStrokeStyle(8,"miter").beginStroke("#fff");this.mouse_graphics.moveTo(this.mouse_xboct[0].x,this.mouse_xboct[0].y);for(i=1;i<6;i++)
this.mouse_graphics.lineTo(this.mouse_xboct[i].x,this.mouse_xboct[i].y);};ClassGameLogic.prototype.ClearMouse=function()
{for(i=0;i<6;i++)
{this.mouse_xboct[i].x=mouse.x;this.mouse_xboct[i].y=mouse.y;}};ClassGameLogic.prototype.ReExtraLife=function()
{this.game_over=false;this.f_cout=0;};function ClassMenuEnd()
{this.GetImg=new createjs.Container();this.end_0=new createjs.Container();this.end_1=new createjs.Container();this.end_2=new createjs.Container();this.btn_menu_0=new createjs.Shape();this.btn_menu_0.graphics.beginFill("#f00").drawCircle(132,862,46);this.btn_menu_0.addEventListener("mousedown",EndMenuToMenu,false);this.end_0.addChild(this.btn_menu_0);this.btn_restart=new createjs.Shape();this.btn_restart.graphics.beginFill("#f00").drawCircle(660,862,46);this.btn_restart.addEventListener("mousedown",EndMenuToLocation,false);this.end_0.addChild(this.btn_restart);this.btn_menu_1=new createjs.Shape();this.btn_menu_1.graphics.beginFill("#f00").drawCircle(666,868,46);this.btn_menu_1.addEventListener("mousedown",EndMenuToMenu,false);this.end_1.addChild(this.btn_menu_1);this.btn_menu_2=new createjs.Shape();this.btn_menu_2.graphics.beginFill("#f00").drawCircle(666,868,46);this.btn_menu_2.addEventListener("mousedown",EndMenuToMenu,false);this.end_2.addChild(this.btn_menu_2);var bg=new createjs.Bitmap(load.queue.getResult("bg_game_over"));bg.x=76;this.GetImg.addChild(bg);bg=ss_sprite.clone();bg.gotoAndStop("end_0");bg.x=76;this.end_0.addChild(bg);this.knife=ss_sprite.clone();this.knife.gotoAndStop("knife");this.knife.x=186;this.knife.y=286;this.end_0.addChild(this.knife);this.point=new createjs.Container();this.point.x=396;this.point.y=460;var point_t=font_3_sprite.clone();point_t.gotoAndStop("text_points");this.point.addChild(point_t);this.point_f=new ClassFont(6,3);this.point_f.GetImg.x=202;this.point.addChild(this.point_f.GetImg);this.end_0.addChild(this.point);this.sliced=new createjs.Container();this.sliced.x=396;this.sliced.y=600;var sliced_t=font_3_sprite.clone();sliced_t.gotoAndStop("text_total_sliced");this.sliced.addChild(sliced_t);this.sliced_f=new ClassFont(4,3);this.sliced_f.GetImg.x=367;this.sliced.addChild(this.sliced_f.GetImg);this.end_0.addChild(this.sliced);this.credits=new createjs.Container();this.credits.x=396;this.credits.y=740;var credits_t=font_3_sprite.clone();credits_t.gotoAndStop("text_total_credits");credits_t.regX=205;this.credits.addChild(credits_t);this.credits_f=new ClassFont(6,3);this.credits_f.GetImg.y=54;this.credits.addChild(this.credits_f.GetImg);this.end_0.addChild(this.credits);this.btn_play=ss_sprite.clone();this.btn_play.gotoAndStop("btn");this.btn_play.x=612;this.btn_play.y=814;this.end_0.addChild(this.btn_play);this.high_score_0=ss_sprite.clone();this.high_score_0.gotoAndStop("high_score");this.high_score_0.x=80;this.high_score_0.y=440;this.end_0.addChild(this.high_score_0);this.high_score_1=ss_sprite.clone();this.high_score_1.gotoAndStop("high_score");this.high_score_1.x=80;this.high_score_1.y=580;this.end_0.addChild(this.high_score_1);this.point_anim=new ClassFont(6,3);this.point_anim.GetImg.y=460;this.end_0.addChild(this.point_anim.GetImg);bg=ss_sprite.clone();bg.gotoAndStop("end_1");bg.x=172;bg.y=202;this.end_1.addChild(bg);this.ord=new ClassFont(2,0);this.ord.GetImg.x=520;this.ord.GetImg.y=310;this.end_1.addChild(this.ord.GetImg);bg=ss_sprite.clone();bg.gotoAndStop("end_2");bg.x=172;bg.y=194;this.end_2.addChild(bg);this.ord_2=new ClassFont(2,2);this.ord_2.GetImg.scaleX=this.ord_2.GetImg.scaleY=0.66;this.ord_2.GetImg.x=510;this.ord_2.GetImg.y=280;this.end_2.addChild(this.ord_2.GetImg);this.point_f_2=new ClassFont(6,0);this.point_f_2.GetImg.x=210;this.point_f_2.GetImg.y=540;this.end_2.addChild(this.point_f_2.GetImg);this.credits_2=new createjs.Container();this.credits_2.x=396;this.credits_2.y=680;credits_t=font_3_sprite.clone();credits_t.gotoAndStop("text_total_credits");credits_t.regX=205;this.credits_2.addChild(credits_t);this.credits_2_f=new ClassFont(6,3);this.credits_2_f.GetImg.y=54;this.credits_2.addChild(this.credits_2_f.GetImg);this.end_2.addChild(this.credits_2);this.draw_point=0;this.speed={x:0,y:0};this.step_anim_speed=20;this.GetImg.addChild(this.end_0);this.GetImg.addChild(this.end_1);this.GetImg.addChild(this.end_2);stage_game.addChild(this.GetImg);this.Close();}
ClassMenuEnd.prototype.DrwUpd=function()
{if(this.end_0.visible)
{if(this.draw_point!==0)
{if(this.point_anim.GetImg.visible&&this.point_anim.GetImg.y>794)
{this.point_anim.GetImg.visible=false;}
else
{this.point_anim.GetImg.x+=this.speed.x;this.point_anim.GetImg.y+=this.speed.y;this.point_anim.GetImg.scaleX/=1.04;this.point_anim.GetImg.scaleY/=1.04;}
if(!this.point_anim.GetImg.visible&&this.credits_f.GetValue<save.credits)
{this.credits_f.Set(this.credits_f.GetValue+this.draw_point);this.credits_f.GetImg.regX=this.credits_f.GetImg.width/2;if(this.credits_f.GetValue>save.credits)
{this.credits_f.Set(save.credits);this.credits_f.GetImg.regX=this.credits_f.GetImg.width/2;}}}}
if(this.end_2.visible)
{if(this.credits_2_f.GetValue<save.credits)
{this.credits_2_f.Set(this.credits_2_f.GetValue+this.draw_point);this.credits_2_f.GetImg.regX=this.credits_2_f.GetImg.width/2;if(this.credits_2_f.GetValue>save.credits)
{this.credits_2_f.Set(save.credits);this.credits_2_f.GetImg.regX=this.credits_2_f.GetImg.width/2;}}}};ClassMenuEnd.prototype.SetKnife=function(a)
{this.knife.x=((186+366*a)<<0);};ClassMenuEnd.prototype.Open=function(n,point,sliced)
{this.GetImg.visible=true;this.end_0.visible=(n===0);this.end_1.visible=(n===1);this.end_2.visible=(n===2);if(n===0)
{if(point!==0)
{this.point_anim.GetImg.x=288;this.point_anim.GetImg.y=460;this.point_anim.GetImg.scaleX=1;this.point_anim.GetImg.scaleY=1;this.point_anim.GetImg.visible=true;this.draw_point=point/this.step_anim_speed;}
else
{this.point_anim.GetImg.visible=false;this.draw_point=0;}
this.high_score_0.visible=(point===save.best[1]);this.high_score_1.visible=(sliced===save.best[0]);var a=Math.min((save.score+point)/config.special_point,1);if(a===1)
this.btn_play.visible=true;else
this.btn_play.visible=false;this.SetKnife(a);this.SetPoint(point);this.SetSliced(sliced);this.credits_f.Set(save.credits);this.credits_f.GetImg.regX=this.credits_f.GetImg.width/2;save.AddScore(point);save.AddCredits(point);}
if(n===1)
{this.ord.Set(sliced);save.AddScore(0);}
if(n===2)
{this.draw_point=point/this.step_anim_speed;this.point_f_2.Set(point);this.point_f_2.x=(210-this.point_f.GetImg.width);this.ord_2.Set(sliced);this.credits_2_f.Set(save.credits);this.credits_2_f.GetImg.regX=this.credits_2_f.GetImg.width/2;save.AddScore(0);save.AddCredits(point);save.AddSpecial();}};ClassMenuEnd.prototype.Close=function()
{this.GetImg.visible=false;};ClassMenuEnd.prototype.SetPoint=function(a)
{this.point_anim.Set(a);this.point_anim.GetImg.regX=this.point_anim.GetImg.width/2;this.point_anim.GetImg.x=396+(202+this.point_anim.GetImg.width)/2-this.point_anim.GetImg.regX;this.speed.x=(396-this.point_anim.GetImg.x)/20;this.speed.y=(794-this.point_anim.GetImg.y)/20;this.point_f.Set(a);this.point.regX=(202+this.point_f.GetImg.width)/2;};ClassMenuEnd.prototype.SetSliced=function(a)
{this.sliced_f.Set(a);this.sliced.regX=(367+this.sliced_f.GetImg.width)/2;};var font_0_sprite,font_1_sprite,font_2_sprite,font_3_sprite,font_4_sprite,ss_sprite,fruit_sprite,spl_sprite,kpl_sprite;function CreateData()
{var data={"images":[load.queue.getResult("font_0")],"frames":[[64,146,58,70,0,-2,-3],[62,2,50,70,0,-7,-3],[68,74,54,70,0,-4,-3],[170,2,48,70,0,-7,-3],[2,74,64,70,0,0,-3],[114,2,54,70,0,-5,-3],[124,74,52,70,0,-5,-3],[2,146,60,70,0,-2,-3],[124,146,54,72,0,-4,-1],[2,2,58,70,0,-3,-3]],"animations":{"0":[0],"1":[1],"2":[2],"3":[3],"4":[4],"5":[5],"6":[6],"7":[7],"8":[8],"9":[9]}};font_0_sprite=new createjs.Sprite(new createjs.SpriteSheet(data));data={"images":[load.queue.getResult("font_1")],"frames":[[64,146,58,70,0,-2,-3],[62,2,50,70,0,-7,-3],[68,74,54,70,0,-4,-3],[170,2,48,70,0,-7,-3],[2,74,64,70,0,0,-3],[114,2,54,70,0,-5,-3],[124,74,52,70,0,-5,-3],[2,146,60,70,0,-2,-4],[124,146,54,72,0,-4,-1],[2,2,58,70,0,-3,-4]],"animations":{"0":[0],"1":[1],"2":[2],"3":[3],"4":[4],"5":[5],"6":[6],"7":[7],"8":[8],"9":[9]}};font_1_sprite=new createjs.Sprite(new createjs.SpriteSheet(data));data={"images":[load.queue.getResult("font_2")],"frames":[[112,366,96,118,0,-33,-2],[288,244,84,118,0,-40,-1],[270,124,88,118,0,-37,-1],[360,124,78,118,0,-46,-1],[2,368,108,118,0,-28,-3],[196,244,90,118,0,-37,-2],[210,364,86,118,0,-38,-2],[94,246,100,118,0,-31,-2],[2,246,90,120,0,-36,0],[172,124,96,118,0,-34,-2],[2,2,518,120,0,0,0],[2,124,168,120,0,-1,0]],"animations":{"0":[0],"1":[1],"2":[2],"3":[3],"4":[4],"5":[5],"6":[6],"7":[7],"8":[8],"9":[9],"combo":[10],"go":[11],"timeGo":{frames:[3,2,1,11],next:"timeGo",speed:0.05}}};font_2_sprite=new createjs.Sprite(new createjs.SpriteSheet(data));data={"images":[load.queue.getResult("font_3")],"frames":[[336,106,42,50,0,-3,-2],[2,316,36,50,0,-5,-2],[2,212,38,50,0,-4,-2],[40,264,34,50,0,-7,-2],[200,106,46,50,0,-1,-2],[369,54,40,50,0,-4,-2],[2,264,36,50,0,-6,-2],[292,106,42,50,0,-3,-2],[2,158,38,52,0,-5,0],[248,106,42,50,0,-3,-2],[2,106,196,50,0,-2,-2],[2,2,408,50,0,-1,-2],[2,54,365,50,0,-1,-2]],"animations":{"0":[0],"1":[1],"2":[2],"3":[3],"4":[4],"5":[5],"6":[6],"7":[7],"8":[8],"9":[9],"text_points":[10],"text_total_credits":[11],"text_total_sliced":[12]}};font_3_sprite=new createjs.Sprite(new createjs.SpriteSheet(data));data={"images":[load.queue.getResult("font_4")],"frames":[[26,2,24,30,0,-4,-3],[78,34,20,30,0,-6,-3],[76,2,22,30,0,-5,-3],[56,34,20,30,0,-5,-3],[2,36,28,30,0,-1,-3],[52,2,22,30,0,-4,-3],[32,34,22,30,0,-4,-3],[2,68,26,30,0,-2,-3],[2,2,22,32,0,-5,-1],[30,68,24,30,0,-4,-3]],"animations":{"0":[0],"1":[1],"2":[2],"3":[3],"4":[4],"5":[5],"6":[6],"7":[7],"8":[8],"9":[9]}};font_4_sprite=new createjs.Sprite(new createjs.SpriteSheet(data));data={"images":[load.queue.getResult("ss")],"frames":[[782,1468,42,60,0,-1,-1],[842,1432,102,102,0,-1,-1],[1477,80,42,60,0,-1,-1],[549,710,514,460,0,-0,-1],[718,1468,62,60,0,-1,-3],[2,2,636,688,0,-4,-232],[640,2,551,706,0,-2,-12],[2,692,545,714,0,-2,-9],[652,1450,188,16,0,-0,-1],[549,1172,276,276,0,-4,-3],[1201,1204,124,128,0,-0,-0],[1339,934,128,128,0,-0,-0],[1327,1204,122,128,0,-0,-0],[1339,1064,124,128,0,-0,-0],[827,1302,126,128,0,-0,-0],[1201,1334,122,128,0,-0,-0],[827,1172,128,128,0,-0,-0],[1339,804,128,128,0,-0,-0],[1065,710,104,84,0,-0,-0],[957,1204,242,264,0,-36,-0],[1193,402,274,400,0,-5,-1],[1065,804,272,398,0,-6,-3],[1193,2,282,398,0,-3,-4],[1425,1438,62,82,0,-0,-0],[946,1470,78,36,0,-6,-2],[652,1468,64,62,0,-10,8],[1477,142,50,50,0,-1,-1],[1325,1438,98,98,0,-0,-0],[398,1408,130,130,0,-0,-1],[266,1408,130,130,0,-0,-1],[134,1408,130,130,0,-0,-1],[2,1408,130,130,0,-0,-1],[1325,1334,112,102,0,-3,-6],[1477,2,52,76,0,-0,-2],[530,1450,120,88,0,-0,-1]],"animations":{"btn_l":[0],"btn_pause":[1],"btn_r":[2],"buy_extra_life":[3],"close":[4],"end_0":[5],"end_1":[6],"end_2":[7],"fx":[8],"glow":[9],"y0":[10],"y1":[11],"g2":[12],"y3":[13],"o4":[14],"y5":[15],"r6":[16],"r7":[17],"knife":[18],"knife_0":[19],"knife_1":[20],"knife_2":[21],"knife_3":[22],"life":[23],"mark_buy":[24],"mark_green":[25],"mark_round":[26],"btn":[27],"btn_music_off":[28],"btn_music_on":[29],"btn_sound_off":[30],"btn_sound_on":[31],"gold":[32],"yellow_dollar":[33],"high_score":[34]}};ss_sprite=new createjs.Sprite(new createjs.SpriteSheet(data));data={"images":[load.queue.getResult("items_f"),load.queue.getResult("items_b")],"frames":[[642,660,82,114,0,41,57],[164,616,82,73,0,41,36],[248,616,82,71,0,41,35],[292,2,122,152,0,61,76],[512,666,128,122,0,64,61],[2,698,128,89,0,64,44],[605,575,128,83,0,64,41],[288,267,166,160,0,83,80],[456,415,129,111,0,64,55],[520,154,104,98,0,52,49],[290,169,106,96,0,53,48],[456,263,168,150,0,84,75],[170,2,120,165,0,60,82],[362,556,122,126,0,61,63],[398,156,120,105,0,60,52],[2,492,160,204,0,80,102],[630,2,158,128,0,79,64],[626,244,151,115,0,75,57],[630,132,158,110,0,79,55],[164,446,196,168,0,98,84],[2,268,126,222,0,63,111],[252,689,127,102,0,63,51],[362,429,83,125,0,41,62],[2,2,166,264,0,83,132],[486,528,117,136,0,58,68],[170,169,118,96,0,59,48],[132,698,118,87,0,59,43],[130,268,156,176,0,78,88],[605,463,173,110,0,86,55],[626,361,134,100,0,67,50],[381,684,129,95,0,64,47],[416,2,212,150,0,106,75],[458,444,154,185,1,77,92],[302,444,154,185,1,77,92],[2,2,163,182,1,81,91],[166,223,173,158,1,86,79],[341,223,162,219,1,81,109],[331,2,162,219,1,81,109],[2,186,162,219,1,81,109],[167,2,162,219,1,81,109],[505,218,134,214,1,67,107],[2,407,134,214,1,67,107],[166,383,134,214,1,67,107],[495,2,134,214,1,67,107]],"animations":{"g2":[0],"g2_0":[1],"g2_1":[2],"g2_g":[3],"o4":[4],"o4_0":[5],"o4_1":[6],"o4_g":[7],"r6":[8],"r6_0":[9],"r6_1":[10],"r6_g":[11],"r7":[12],"r7_0":[13],"r7_1":[14],"r7_g":[15],"y0":[16],"y0_0":[17],"y0_1":[18],"y0_g":[19],"y1":[20],"y1_0":[21],"y1_1":[22],"y1_g":[23],"y3":[24],"y3_0":[25],"y3_1":[26],"y3_g":[27],"y5":[28],"y5_0":[29],"y5_1":[30],"y5_g":[31],"b0":[32],"b1":[33],"b10":[34],"b11":[35],"b2":[36],"b3":[37],"b4":[38],"b5":[39],"b6":[40],"b7":[41],"b8":[42],"b9":[43]}};fruit_sprite=new createjs.Sprite(new createjs.SpriteSheet(data));data={"images":[load.queue.getResult("spl")],"frames":[[2,546,246,270,0,-31,-11],[850,238,198,292,0,-63,-1],[250,568,270,234,0,-1,-37],[698,796,210,262,0,-31,-40],[250,2,246,270,0,-31,-11],[650,238,198,292,0,-63,-1],[2,818,270,234,0,-1,-37],[650,532,210,262,0,-31,-40],[2,274,246,270,0,-31,-11],[450,274,198,292,0,-63,-1],[770,2,270,234,0,-1,-37],[486,804,210,262,0,-31,-40],[2,2,246,270,0,-31,-11],[250,274,198,292,0,-63,-1],[498,2,270,234,0,-1,-37],[274,804,210,262,0,-31,-40]],"animations":{"g0":[0],"g1":[1],"g2":[2],"g3":[3],"o0":[4],"o1":[5],"o2":[6],"o3":[7],"r0":[8],"r1":[9],"r2":[10],"r3":[11],"y0":[12],"y1":[13],"y2":[14],"y3":[15]}};spl_sprite=new createjs.Sprite(new createjs.SpriteSheet(data));data={"images":[load.queue.getResult("kpl")],"frames":[[780,418,188,138,0,-77,-73],[278,686,234,204,0,-38,-33],[546,418,232,138,0,-64,-47],[592,212,252,204,0,-18,-47],[710,898,152,126,0,-84,-59],[2,292,290,280,0,-12,-9],[304,2,286,276,0,-13,-10],[854,2,186,136,0,-77,-73],[534,558,230,200,0,-41,-35],[514,760,228,136,0,-65,-48],[2,838,248,200,0,-20,-48],[874,752,122,116,0,-113,-68],[854,140,176,130,0,-81,-75],[766,558,220,192,0,-45,-37],[492,898,216,130,0,-71,-50],[294,492,238,192,0,-26,-50],[874,870,116,108,0,-115,-72],[2,574,274,262,0,-19,-16],[252,892,238,142,0,-61,-46],[304,280,240,210,0,-35,-31],[846,272,194,142,0,-73,-72],[592,2,260,208,0,-14,-47],[744,760,128,120,0,-110,-68],[2,2,300,288,0,-6,-7]],"animations":{"g0":[0],"g1":[1],"g2":[2],"g4":[3],"g5":[4],"g6":[5],"o0":[6],"o1":[7],"o2":[8],"o3":[9],"o4":[10],"o5":[11],"r0":[12],"r1":[13],"r2":[14],"r3":[15],"r4":[16],"r5":[17],"y0":[18],"y1":[19],"y2":[20],"y3":[21],"y4":[22],"y5":[23]}};kpl_sprite=new createjs.Sprite(new createjs.SpriteSheet(data));}function ClassSave()
{this.addHs=3;this.credits=0;this.score=0;this.special=false;this.special_num=0;this.help=true;this.best=[];this.Load();}
ClassSave.prototype.Load=function()
{if(window.localStorage.getItem("fruit_chef_credits")===null)
{this.credits=0;this.score=0;this.best=[0,0,0];window.localStorage.setItem("fruit_chef_credits",0);window.localStorage.setItem("fruit_chef_addhs",3);window.localStorage.setItem("fruit_chef_score",0);window.localStorage.setItem("fruit_chef_special","false");window.localStorage.setItem("fruit_chef_special_num",0);window.localStorage.setItem("fruit_chef_help","true");window.localStorage.setItem("fruit_chef_best","[0, 0, 0]");}
else
{this.addHs=parseInt(window.localStorage.getItem("fruit_chef_addhs"));this.credits=parseInt(window.localStorage.getItem("fruit_chef_credits"));this.score=parseInt(window.localStorage.getItem("fruit_chef_score"));this.special=(window.localStorage.getItem("fruit_chef_special")==="true");this.special_num=parseInt(window.localStorage.getItem("fruit_chef_special_num"));this.help=(window.localStorage.getItem("fruit_chef_help")==="true");this.best=JSON.parse(window.localStorage.getItem("fruit_chef_best"));}};ClassSave.prototype.AddHomeScreen=function()
{this.addHs-=1;window.localStorage.setItem("fruit_chef_addhs",this.addHs);};ClassSave.prototype.AddCredits=function(a)
{this.credits+=a;window.localStorage.setItem("fruit_chef_credits",this.credits);};ClassSave.prototype.GetSpecial=function()
{if(this.special)
return 1;else
return 0;};ClassSave.prototype.AddSpecial=function()
{if(this.special_num<config.special.length-1)this.special_num++;window.localStorage.setItem("fruit_chef_special_num",this.special_num);};ClassSave.prototype.AddScore=function(a)
{this.score+=a;this.special=false;if(this.score>config.special_point)
{this.score=this.score%config.special_point;this.special=true;}
window.localStorage.setItem("fruit_chef_score",this.score);window.localStorage.setItem("fruit_chef_special",this.special);};ClassSave.prototype.OffHelp=function()
{this.help=false;window.localStorage.setItem("fruit_chef_help","false");};ClassSave.prototype.TestBestScore=function(a)
{if(this.best[1]<a){this.best[1]=a;}};ClassSave.prototype.TestBestCombo=function(a)
{if(this.best[2]<a){this.best[2]=a;}};ClassSave.prototype.TestBestCout=function(a)
{if(this.best[0]<a){this.best[0]=a;}
this.SaveBest();};ClassSave.prototype.SaveBest=function()
{window.localStorage.setItem("fruit_chef_best","["+this.best[0]+","+this.best[1]+","+this.best[2]+"]");};function ClassFruit(n)
{this.GetType=2;this.GetImg=fruit_sprite.clone();this.GetImg.snapToPixel=true;this.GetImg.gotoAndStop("r7");this.GetImg.x=0;this.GetImg.y=0;this.GetImg.self=this;this.GetImg.visible=false;this.Speed={x:0,y:0,rotation:0};location_game.all_fruits.push(this);if(n===0)
{this.GetType=0;this.GetSpl=spl_sprite.clone();this.GetSpl.snapToPixel=true;this.GetSpl.regX=282/2;this.GetSpl.regY=302/2;this.GetSpl.visible=false;this.GetKpl=kpl_sprite.clone();this.GetKpl.snapToPixel=true;this.GetKpl.regX=312/2;this.GetKpl.regY=302/2;this.GetKpl.visible=false;this.child1=new ClassFruit(2);this.child2=new ClassFruit(2);}}
ClassFruit.prototype.Shot=function()
{this.Speed.x=((Math.random()*config.speed_x)-(config.speed_x/2));this.Speed.y=(config.speed_y_min+(Math.random()*(config.speed_y_max-config.speed_y_min))-((config.speed_y_max-config.speed_y_min)/2));this.Speed.rotation=((Math.random()*config.rotation)-(config.rotation/2));random_shot=name_f[(Math.random()*8<<0)];if(this.GetType===0)
this.GetImg.gotoAndStop(random_shot);else
this.GetImg.gotoAndStop(random_shot+"_g");this.GetImg.visible=true;if(this.Speed.x>0)
this.GetImg.x=76+(320*Math.random());else
this.GetImg.x=320+76+(320*Math.random());this.GetImg.y=1100;this.GetImg.rotation=(Math.random()*360);if(this.GetType<2)
{this.child1.GetImg.gotoAndStop(random_shot+"_0");this.child2.GetImg.gotoAndStop(random_shot+"_1");this.child1.GetImg.visible=false;this.child2.GetImg.visible=false;}};ClassFruit.prototype.ShotS=function(n)
{this.Speed.x=((Math.random()*config.speed_x)-(config.speed_x/2));this.Speed.y=(config.speed_y_min+(Math.random()*(config.speed_y_max-config.speed_y_min))-((config.speed_y_max-config.speed_y_min)/2));this.Speed.rotation=((Math.random()*config.rotation)-(config.rotation/2));this.GetImg.gotoAndStop(n);this.GetImg.visible=true;if(this.Speed.x>0)
this.GetImg.x=76+(320*Math.random());else
this.GetImg.x=320+76+(320*Math.random());this.GetImg.y=1100;this.GetImg.rotation=(Math.random()*360);if(this.GetType<2)
{this.child1.GetImg.gotoAndStop(n+"_0");this.child2.GetImg.gotoAndStop(n+"_1");this.child1.GetImg.visible=false;this.child2.GetImg.visible=false;}};ClassFruit.prototype.DrwUpd=function()
{if(this.GetImg.visible)
{this.Speed.y+=config.acceleration_y;this.GetImg.x+=this.Speed.x;this.GetImg.y+=this.Speed.y;this.GetImg.rotation+=this.Speed.rotation;}
if(this.GetType<2&&this.GetSpl.visible&&this.GetSpl.alpha>0)
{this.GetSpl.alpha-=0.03;this.GetKpl.alpha-=0.03;if(this.GetSpl.alpha-0.01<0)
{this.GetSpl.alpha=1;this.GetSpl.visible=false;this.GetKpl.alpha=1;this.GetKpl.visible=false;}}};ClassFruit.prototype.Kill=function(normal,r)
{if(this.GetType<2)
{if(!splice_mute&&audio_supported)splice.play();this.GetImg.visible=false;this.GetSpl.alpha=1;this.GetSpl.rotation=(Math.random()*360);this.GetSpl.x=this.GetImg.x;this.GetSpl.y=this.GetImg.y;this.GetSpl.visible=true;this.GetSpl.gotoAndStop(this.GetImg.currentAnimation[0]+(Math.random()*4<<0));this.GetKpl.alpha=1;this.GetKpl.rotation=(Math.random()*360);this.GetKpl.x=this.GetImg.x;this.GetKpl.y=this.GetImg.y;this.GetKpl.visible=true;this.GetKpl.gotoAndStop(this.GetImg.currentAnimation[0]+(Math.random()*6<<0));this.child1.GetImg.x=this.GetImg.x+80*normal.y;this.child1.GetImg.y=this.GetImg.y+80*(-normal.x);this.child1.GetImg.rotation=r;this.child1.GetImg.visible=true;this.child1.Speed.x=this.Speed.x+4*normal.y;this.child1.Speed.y=this.Speed.y-4*normal.x;this.child1.Speed.rotation=this.Speed.rotation;this.child2.GetImg.x=this.GetImg.x+80*(-normal.y);this.child2.GetImg.y=this.GetImg.y+80*normal.x;this.child2.GetImg.rotation=r;this.child2.GetImg.visible=true;this.child2.Speed.x=this.Speed.x-4*normal.y;this.child2.Speed.y=this.Speed.y+4*normal.x;this.child2.Speed.rotation=-this.Speed.rotation;}};ClassFruit.prototype.GlowOn=function()
{if(this.GetType!==1)
{this.GetType=1;this.GetImg.gotoAndStop(this.GetImg.currentAnimation+"_g");}};ClassFruit.prototype.GlowOff=function()
{if(this.GetType!==0)
{this.GetType=0;this.GetImg.gotoAndStop(this.GetImg.currentAnimation.substring(0,2));}};function ClassCombo()
{this.knife=1;this.combo_cout=0;this.combo_timer=0;this.GetImg=new createjs.Container();this.GetImg.visible=false;this.GetImg.regX=340;this.GetImg.scaleX=this.GetImg.scaleY=0.75;this.GetImg.x=36+340;this.GetImg.y=260;this.combo_graphics_cout=font_2_sprite.clone();this.combo_graphics_cout.gotoAndStop("2");this.GetImg.addChild(this.combo_graphics_cout);this.combo_graphics_text=font_2_sprite.clone();this.combo_graphics_text.gotoAndStop("combo");this.combo_graphics_text.x=160;this.GetImg.addChild(this.combo_graphics_text);this.combo_graphics_timer=0;this.max_combo=0;}
ClassCombo.prototype.Add=function()
{this.combo_cout++;this.combo_timer=config.combo_time;};ClassCombo.prototype.Upd=function()
{this.combo_timer-=30/1000;if(this.combo_timer<0&&this.combo_timer>-0.03)
{if(this.combo_cout===1)
{location_game.AddScore(this.combo_cout*this.knife*((location_game.glow.include)?2:1));this.combo_cout=0;}
else
{location_game.AddScore(this.combo_cout*this.knife*this.combo_cout*((location_game.glow.include)?2:1));this.combo_graphics_cout.gotoAndStop(this.combo_cout);this.GetImg.visible=true;this.combo_graphics_timer=0.4;this.max_combo=Math.max(this.max_combo,this.combo_cout);this.combo_cout=0;}}
if(this.GetImg.visible)
{this.combo_graphics_timer-=30/1000;if(this.combo_graphics_timer<0)
this.GetImg.visible=false;}};ClassCombo.prototype.Restart=function()
{this.combo_cout=0;this.combo_timer=0;this.GetImg.visible=false;};function ClassSetting()
{this.GetOldWindow=0;this.GetImg=new createjs.Container();this.btn_menu=new createjs.Shape();this.btn_menu.graphics.beginFill("#f00").drawCircle(132,858,50);this.btn_menu.addEventListener("mousedown",SettingToMenu,false);this.GetImg.addChild(this.btn_menu);this.btn_help=new createjs.Shape();this.btn_help.graphics.beginFill("#f00").drawCircle(390,330,60);this.btn_help.addEventListener("mousedown",SettingToHelp,false);this.GetImg.addChild(this.btn_help);this.btn_about=new createjs.Shape();this.btn_about.graphics.beginFill("#f00").drawCircle(390,714,60);this.btn_about.addEventListener("mousedown",SettingToAbout,false);this.GetImg.addChild(this.btn_about);var bg=new createjs.Bitmap(load.queue.getResult("bg_setting"));bg.x=76;this.GetImg.addChild(bg);this.btn_music_img=ss_sprite.clone();this.btn_music_img.gotoAndStop("btn_music_on");this.btn_music_img.x=414;this.btn_music_img.y=456;this.btn_music_img.addEventListener("mousedown",function(){if(music.playState==="playSucceeded")
{music.stop();setting.btn_music_img.gotoAndStop("btn_music_off");}else
{music.play({loop:-1});setting.btn_music_img.gotoAndStop("btn_music_on");}},false);this.GetImg.addChild(this.btn_music_img);this.btn_sound_img=ss_sprite.clone();this.btn_sound_img.gotoAndStop("btn_sound_on");this.btn_sound_img.x=234;this.btn_sound_img.y=456;this.btn_sound_img.addEventListener("mousedown",function(){splice_mute=!splice_mute;if(splice_mute)
setting.btn_sound_img.gotoAndStop("btn_sound_off");else
setting.btn_sound_img.gotoAndStop("btn_sound_on");},false);this.GetImg.addChild(this.btn_sound_img);stage_game.addChild(this.GetImg);this.Close();}
ClassSetting.prototype.Open=function()
{if(audio_supported)
{if(splice_mute)
this.btn_sound_img.gotoAndStop("btn_sound_off");else
this.btn_sound_img.gotoAndStop("btn_sound_on");if((music===undefined)||(music.playState!=="playSucceeded"))
this.btn_music_img.gotoAndStop("btn_music_off");else
this.btn_music_img.gotoAndStop("btn_music_on");}
else
{this.btn_sound_img.visible=false;this.btn_music_img.visible=false;}
this.GetImg.visible=true;};ClassSetting.prototype.Close=function()
{this.GetImg.visible=false;};function ClassLoad()
{this.GetImg=new createjs.Container();this.audio_cm=true;this.queue=new createjs.LoadQueue(true);this.queue.addEventListener("complete",PreLoadComplete,false);this.queue.loadManifest([{id:"load_text",src:"assets/load/load.png"},{id:"load_bg",src:"assets/load/bg.png"},{id:"load_knife",src:"assets/load/knife.png"},{id:"load_progress",src:"assets/load/progress.png"}]);stage_game.addChild(this.GetImg);this.Close();this.queue.load();}
ClassLoad.prototype.DrwUpd=function()
{if(this.GetImg.visible)
{this.draw_point.x=123+91+380*this.queue.progress;this.draw_line.scaleX=380*this.queue.progress;stage_game.clear();stage_game.update();}};ClassLoad.prototype.StartLoad=function()
{var text=new createjs.Bitmap(this.queue.getResult("load_text"));text.x=212;text.y=300;this.GetImg.addChild(text);var bg=new createjs.Bitmap(this.queue.getResult("load_bg"));bg.x=123;bg.y=560;this.GetImg.addChild(bg);this.draw_line=new createjs.Bitmap(this.queue.getResult("load_progress"));this.draw_line.x=214;this.draw_line.y=bg.y+45;this.GetImg.addChild(this.draw_line);this.draw_point=new createjs.Bitmap(this.queue.getResult("load_knife"));this.draw_point.x=214;this.draw_point.y=bg.y+65;this.draw_point.regX=52;this.draw_point.regY=42;this.GetImg.addChild(this.draw_point);this.queue.removeAllEventListeners();this.queue.addEventListener("progress",function(){load.DrwUpd();},false);this.queue.addEventListener("complete",LoadCompleteStartGame,false);this.queue.loadManifest([{id:"screen",src:"assets/screen.jpg"},{id:"bg",src:"assets/bg/bg.jpg"},{id:"bg_about",src:"assets/bg/bg_about.jpg"},{id:"bg_best",src:"assets/bg/bg_best.jpg"},{id:"bg_game_over",src:"assets/bg/bg_game_over.jpg"},{id:"bg_help_0",src:"assets/bg/bg_help_0.jpg"},{id:"bg_help_1",src:"assets/bg/bg_help_1.jpg"},{id:"bg_help_2",src:"assets/bg/bg_help_2.jpg"},{id:"bg_main_menu",src:"assets/bg/bg_main_menu.jpg"},{id:"bg_pause_menu",src:"assets/bg/bg_pause_menu.jpg"},{id:"bg_setting",src:"assets/bg/bg_setting.jpg"},{id:"bg_upgrade",src:"assets/bg/bg_upgrade.jpg"},{id:"items_b",src:"assets/items_b.png"},{id:"items_f",src:"assets/items_f.png"},{id:"font_0",src:"assets/fonts/font_0.png"},{id:"font_1",src:"assets/fonts/font_1.png"},{id:"font_2",src:"assets/fonts/font_2.png"},{id:"font_3",src:"assets/fonts/font_3.png"},{id:"font_4",src:"assets/fonts/font_4.png"},{id:"ss",src:"assets/ss.png"},{id:"spl",src:"assets/spl.png"},{id:"kpl",src:"assets/kpl.png"}]);this.Open();};ClassLoad.prototype.Resize=function(pad)
{this.pad=pad;load.DrwUpd();};ClassLoad.prototype.Open=function()
{this.GetImg.visible=true;};ClassLoad.prototype.Close=function()
{this.GetImg.visible=false;};ClassLoad.prototype.Clear=function()
{this.GetImg.removeAllChildren();delete this.draw_line;delete this.draw_point;};function PreLoadComplete()
{load.StartLoad();}
ClassLoad.prototype.LoadAudio=function()
{createjs.Sound.registerPlugins([createjs.WebAudioPlugin]);audio_supported=createjs.WebAudioPlugin.isSupported();if(audio_supported)
{createjs.Sound.alternateExtensions=["mp3"];this.queue.installPlugin(createjs.Sound);this.queue.removeAllEventListeners();this.queue.addEventListener("complete",MusicPlay,false);this.queue.loadManifest([{id:"splice",src:"assets/splice.ogg",type:createjs.LoadQueue.SOUND},{id:"music",src:"assets/music.ogg",type:createjs.LoadQueue.SOUND}]);}};function MusicPlay()
{load.audio_cm=false;splice_mute=false;music=createjs.Sound.createInstance("music");splice=createjs.Sound.createInstance("splice");music.play({loop:-1});}var canvas_special,stage_special;function ClassSpecial()
{canvas_special=document.getElementById("canvas_special");stage_special=new createjs.Stage(canvas_special);stage_special.autoClear=false;stage_special.nextStage=stage_game;this.GetImg=new createjs.Container();stage_special.addChild(this.GetImg);this.good=[];this.bad=[];this.complete=false;this.include=false;this.cout=0;this.chances=0;this.GetNum=0;this.need_fruits=[7];for(i=0;i<7;i++)
{this.need_fruits[i]=ss_sprite.clone();this.GetImg.addChild(this.need_fruits[i]);}
this.btn_pause=ss_sprite.clone();this.btn_pause.gotoAndStop("btn_pause");this.btn_pause.addEventListener("mousedown",LocationToPause,false);this.GetImg.addChild(this.btn_pause);this.DrwUpd();}
ClassSpecial.prototype.Load=function(num)
{this.complete=false;this.include=false;this.cout=0;this.chances=0;this.GetNum=0;this.good=[];this.bad=[];this.GetNum=num;this.cout=config.special[num].items;this.chances=1/(config.special[num].chances+1);var n;for(i=0;i<7;i++)
{if(this.cout<(i+1))
{this.need_fruits[i].visible=false;}
else
{n=name_f[(Math.random()*8<<0)];if(this.good[this.good.length-1]===n)n=name_f[(Math.random()*8<<0)];this.good.push(n);this.need_fruits[i].alpha=1;this.need_fruits[i].gotoAndStop(n);this.need_fruits[i].x=104+(688/this.cout)*i;this.need_fruits[i].visible=true;}}
var b;for(i=0;i<8;i++)
{b=true;for(j=0;j<7;j++)
{if(this.good[j]===name_f[i])
b=false;}
if(b)this.bad.push(name_f[i]);}
ResizeGame();this.DrwUpd();};ClassSpecial.prototype.Open=function()
{this.GetImg.visible=true;this.DrwUpd();canvas_cout.style.display="none";};ClassSpecial.prototype.Close=function()
{this.GetImg.visible=false;this.DrwUpd();};ClassSpecial.prototype.DrwUpd=function()
{stage_special.clear();canvas_special.style.display="none";canvas_special.offsetHeight;canvas_special.style.display="inherit";stage_special.update();};ClassSpecial.prototype.Kill=function(name)
{for(i=0;i<7;i++)
{if(this.need_fruits[i].alpha===1&&this.need_fruits[i].currentAnimation===name)
{this.need_fruits[i].alpha=0.25;break;}}
var k=0;var del=0;for(i=0;i<this.good.length;i++)
if(this.good[i]===name)
{del=i;k++;}
if(k===1)
{this.good.splice(del,1);this.bad.push(name);if(this.good.length===0)
{this.complete=true;return true;}}
else
{if(k>1)
{this.good.splice(del,1);}
else
{return true;}}
this.DrwUpd();return false;};ClassSpecial.prototype.Resize=function(pad)
{this.btn_pause.x=pad;var st=((688-pad*2)/this.cout<<0);for(i=0;i<7;i++)
{this.need_fruits[i].x=pad+104+st*i;}
this.DrwUpd();};var name_f=["y0","y1","g2","y3","o4","y5","r6","r7"];var random_shot;function ClassLocationGame()
{this.logic=new ClassGameLogic();this.pause=false;this.combo=new ClassCombo();this.glow=new ClassGlow();this.special=new ClassSpecial();this.life=new ClassLife();this.score=new ClassScore();this.cout=new ClassCout();this.location=new createjs.Container();stage_game.addChild(this.location);this.location.addChild(new createjs.Bitmap(load.queue.getResult("bg")));this.go=font_2_sprite.clone();this.go.x=311;this.go.y=292;this.go.addEventListener("animationend",function(evt){evt.target.visible=false;location_game.logic.ClearMouse();},false);this.start_fruits=[12];this.all_fruits=[];this.extra_life=new createjs.Container();var bg=new createjs.Shape();bg.graphics.beginFill("#002").drawRect(0,0,792,920);bg.alpha=0.7;this.extra_life.addChild(bg);var extra=ss_sprite.clone();extra.gotoAndStop("buy_extra_life");extra.x=150;extra.y=200;this.btn_extra_no=new createjs.Shape();this.btn_extra_no.graphics.beginFill("#f00").drawCircle(extra.x+126,extra.y+386,72);this.btn_extra_no.addEventListener("mousedown",function(){location_game.logic.GameOver0();},false);this.extra_life.addChild(this.btn_extra_no);this.extra_credits=new ClassFont(6,1);this.extra_credits.GetImg.x=416;this.extra_credits.GetImg.y=720;this.extra_credits.GetImg.scaleX=this.extra_credits.GetImg.scaleY=0.8;this.extra_life.addChild(this.extra_credits.GetImg);this.extra_gold=new createjs.Bitmap(load.queue.getResult("gold"));this.extra_gold.x=396;this.extra_gold.y=686;this.extra_life.addChild(this.extra_gold);this.extra_time=0;this.btn_extra_yes=new createjs.Shape();this.btn_extra_yes.graphics.beginFill("#f00").drawCircle(extra.x+314,extra.y+386,72);this.btn_extra_yes.addEventListener("mousedown",function(){location_game.extra_time=30;},false);this.extra_life.addChild(this.btn_extra_yes);this.extra_life.addChild(extra);this.extra_life.visible=false;this.Close();}
ClassLocationGame.prototype.Restart=function()
{this.logic.Restart();this.extra_life.visible=false;this.life.SetValue(3);this.score.SetValue(0);this.cout.Restart();this.combo.Restart();this.glow.Off();this.glow.cout=0;for(i=0;i<this.all_fruits.length;i++)
{this.all_fruits[i].GetImg.visible=false;if(this.all_fruits[i].GetType<2)
{this.all_fruits[i].GetSpl.visible=false;this.all_fruits[i].GetKpl.visible=false;}}
if(this.logic.logic===1)
this.special.Load(save.special_num);};ClassLocationGame.prototype.CreateGame=function()
{this.start_fruits[0]=new ClassFruit(0);this.start_fruits[1]=new ClassFruit(0);this.start_fruits[2]=new ClassFruit(0);this.start_fruits[3]=new ClassFruit(0);this.start_fruits[4]=new ClassFruit(0);this.start_fruits[5]=new ClassBad();this.start_fruits[6]=new ClassBad();this.start_fruits[7]=new ClassBad();this.start_fruits[8]=new ClassBad();this.start_fruits[9]=new ClassBad();k_0=0;k_1=5;for(i=0;i<this.start_fruits.length;i++)
this.location.addChild(this.start_fruits[i].GetSpl);for(i=0;i<this.all_fruits.length;i++)
this.location.addChild(this.all_fruits[i].GetImg);this.location.addChild(this.logic.mouse_draw);this.location.addChild(this.logic.fx);for(i=0;i<this.start_fruits.length;i++)
this.location.addChild(this.start_fruits[i].GetKpl);this.location.addChild(this.combo.GetImg);this.location.addChild(this.go);this.location.addChild(this.extra_life);this.location.addChild(this.glow.GetImg);};ClassLocationGame.prototype.Open=function()
{this.logic.logic=save.GetSpecial();if(this.logic.logic===0)
{this.life.Open();this.score.Open();this.cout.Open();}
else
{this.special.Open();}
this.location.visible=true;this.pause=false;this.go.visible=true;this.go.gotoAndPlay("timeGo");};ClassLocationGame.prototype.Close=function()
{this.special.Close();this.life.Close();this.score.Close();this.cout.Close();this.location.visible=false;this.pause=true;this.go.visible=false;};ClassLocationGame.prototype.DrwUpd=function()
{if(this.pause||this.go.visible||this.extra_life.visible)
{if(this.extra_time>0)
{this.extra_credits.Set((save.credits+location_game.score.GetValue())-(1500-(50*this.extra_time)));this.extra_credits.GetImg.regX=((this.extra_credits.GetImg.width/2)<<0);this.extra_gold.x=296-this.extra_credits.GetImg.regX;this.extra_time-=1;if(this.extra_time<=0)
{this.extra_time=0;location_game.logic.ReExtraLife();location_game.life.SetValue(1);location_game.CloseExtraLife();save.AddCredits(-1500);}}}
else
{this.logic.DrwUpd();}};ClassLocationGame.prototype.AddScore=function(a)
{this.score.Add(a);};ClassLocationGame.prototype.AddCout=function()
{this.combo.Add();this.cout.Add(1);this.glow.AddCout();};ClassLocationGame.prototype.OpenExtraLife=function()
{this.extra_credits.Set((save.credits+location_game.score.GetValue()));this.extra_credits.GetImg.regX=((this.extra_credits.GetImg.width/2)<<0);this.extra_gold.x=296-this.extra_credits.GetImg.regX;this.extra_life.visible=true;this.cout.HidePause();};ClassLocationGame.prototype.CloseExtraLife=function()
{this.go.visible=true;this.go.gotoAndPlay("timeGo");this.extra_life.visible=false;this.cout.ShowPause();};var canvas_score,stage_score;function ClassScore()
{canvas_score=document.getElementById("canvas_score");stage_score=new createjs.Stage(canvas_score);stage_score.nextStage=stage_game;stage_score.autoClear=false;this.GetFont=new ClassFont(4,0);this.GetFont.Set(0);stage_score.addChild(this.GetFont.GetImg);this.DrwUpd();}
ClassScore.prototype.GetValue=function()
{return this.GetFont.GetValue;};ClassScore.prototype.Open=function()
{this.GetFont.GetImg.visible=true;this.DrwUpd();};ClassScore.prototype.Close=function()
{this.GetFont.GetImg.visible=false;this.DrwUpd();};ClassScore.prototype.SetValue=function(a)
{this.GetFont.Set(a);this.DrwUpd();};ClassScore.prototype.Add=function(a)
{this.GetFont.Set((this.GetFont.GetValue+a));this.DrwUpd();};ClassScore.prototype.DrwUpd=function()
{this.GetFont.GetImg.x=212-this.GetFont.GetImg.width;stage_score.clear();canvas_score.style.display="none";canvas_score.offsetHeight;canvas_score.style.display="inherit";stage_score.update();};var canvas_cout,stage_cout;function ClassCout()
{canvas_cout=document.getElementById("canvas_cout");stage_cout=new createjs.Stage(canvas_cout);stage_cout.autoClear=false;stage_cout.nextStage=stage_game;this.GetImg=new createjs.Container();stage_cout.addChild(this.GetImg);this.GetFont=new ClassFont(4,1);this.GetFont.GetImg.x=104;this.GetFont.Set(0);this.GetImg.addChild(this.GetFont.GetImg);this.btn_pause=ss_sprite.clone();this.btn_pause.gotoAndStop("btn_pause");this.btn_pause.addEventListener("mousedown",LocationToPause,false);this.GetImg.addChild(this.btn_pause);this.DrwUpd();}
ClassCout.prototype.GetValue=function()
{return this.GetFont.GetValue;};ClassCout.prototype.HidePause=function()
{this.btn_pause.visible=false;this.GetFont.GetImg.x=0;this.DrwUpd();};ClassCout.prototype.ShowPause=function()
{this.btn_pause.visible=true;this.GetFont.GetImg.x=104;this.DrwUpd();};ClassCout.prototype.Restart=function()
{this.btn_pause.visible=true;this.GetFont.GetImg.x=104;this.GetFont.Set(0);this.DrwUpd();};ClassCout.prototype.Open=function()
{this.GetImg.visible=true;this.DrwUpd();canvas_special.style.display="none";};ClassCout.prototype.Close=function()
{this.GetImg.visible=false;this.DrwUpd();};ClassCout.prototype.SetValue=function(a)
{this.GetFont.Set(a);this.DrwUpd();};ClassCout.prototype.Add=function(a)
{this.GetFont.Set((this.GetFont.GetValue+a));this.DrwUpd();};ClassCout.prototype.DrwUpd=function()
{stage_cout.clear();canvas_cout.style.display="none";canvas_cout.offsetHeight;canvas_cout.style.display="inherit";stage_cout.update();};var canvas_life,stage_life;function ClassLife()
{canvas_life=document.getElementById("canvas_life");stage_life=new createjs.Stage(canvas_life);stage_life.nextStage=stage_game;stage_life.autoClear=false;this.GetImg=new createjs.Container();stage_life.addChild(this.GetImg);this.GetValue=3;this.life0=ss_sprite.clone();this.life0.gotoAndStop("life");this.life0.x=0;this.life0.visible=true;this.GetImg.addChild(this.life0);this.life1=ss_sprite.clone();this.life1.gotoAndStop("life");this.life1.x=62;this.life1.visible=true;this.GetImg.addChild(this.life1);this.life2=ss_sprite.clone();this.life2.gotoAndStop("life");this.life2.x=124;this.life2.visible=true;this.GetImg.addChild(this.life2);this.DrwUpd();}
ClassLife.prototype.Open=function()
{this.GetImg.visible=true;this.DrwUpd();};ClassLife.prototype.Close=function()
{this.GetImg.visible=false;this.DrwUpd();};ClassLife.prototype.SetValue=function(a)
{this.GetValue=a;this.DrwUpd();};ClassLife.prototype.Add=function(a)
{this.GetValue+=a;this.DrwUpd();if(this.GetValue<=0)
location_game.logic.game_over=true;};ClassLife.prototype.DrwUpd=function()
{switch(this.GetValue)
{case 3:this.life0.visible=true;this.life1.visible=true;this.life2.visible=true;break;case 2:this.life0.visible=true;this.life1.visible=true;this.life2.visible=false;break;case 1:this.life0.visible=true;this.life1.visible=false;this.life2.visible=false;break;default:this.life0.visible=false;this.life1.visible=false;this.life2.visible=false;break;}
stage_life.clear();canvas_life.style.display="none";canvas_life.offsetHeight;canvas_life.style.display="inherit";stage_life.update();};var font_i=0;function ClassFont(m_lng,style)
{var x=0;this.GetImg=new createjs.Container();this.GetImg.width=0;this.GetValue=0;this.point=[m_lng];switch(style)
{case 0:this.GetImg.height=54;for(font_i=0;font_i<m_lng;font_i++)
{this.point[font_i]=font_0_sprite.clone();this.point[font_i].x=x;this.GetImg.addChild(this.point[font_i]);x+=56;}
break;case 1:this.GetImg.height=74;for(font_i=0;font_i<m_lng;font_i++)
{this.point[font_i]=font_1_sprite.clone();this.point[font_i].x=x;this.GetImg.addChild(this.point[font_i]);x+=56;}
break;case 2:this.GetImg.height=122;for(font_i=0;font_i<m_lng;font_i++)
{this.point[font_i]=font_2_sprite.clone();this.point[font_i].x=x;this.GetImg.addChild(this.point[font_i]);x+=78;}
break;case 3:this.GetImg.height=74;for(font_i=0;font_i<m_lng;font_i++)
{this.point[font_i]=font_3_sprite.clone();this.point[font_i].x=x;this.GetImg.addChild(this.point[font_i]);x+=36;}
break;case 4:this.GetImg.height=34;for(font_i=0;font_i<m_lng;font_i++)
{this.point[font_i]=font_4_sprite.clone();this.point[font_i].x=x;this.GetImg.addChild(this.point[font_i]);x+=28;}
break;}
delete x;}
ClassFont.prototype.Set=function(a)
{var s=(a<<0).toString();this.GetValue=a;this.GetImg.width=s.length*this.point[1].x;for(font_i=0;font_i<this.point.length;font_i++)
{if(font_i<s.length)
{this.point[font_i].gotoAndStop(s[font_i]);this.point[font_i].visible=true;}
else
{this.point[font_i].visible=false;}}
delete s;};function ClassPauseMenu()
{this.GetImg=new createjs.Container();this.btn_play=new createjs.Shape();this.btn_play.graphics.beginFill("#f00").drawCircle(578,546,110);this.btn_play.addEventListener("mousedown",PauseToLocation,false);this.GetImg.addChild(this.btn_play);this.btn_help=new createjs.Shape();this.btn_help.graphics.beginFill("#f00").drawCircle(246,546,60);this.btn_help.addEventListener("mousedown",PauseToHelp,false);this.GetImg.addChild(this.btn_help);this.btn_menu=new createjs.Shape();this.btn_menu.graphics.beginFill("#f00").drawCircle(200,66,50);this.btn_menu.addEventListener("mousedown",PauseToMenu,false);this.GetImg.addChild(this.btn_menu);var bg=new createjs.Bitmap(load.queue.getResult("bg_pause_menu"));bg.x=76;this.GetImg.addChild(bg);stage_game.addChild(this.GetImg);this.Close();}
ClassPauseMenu.prototype.Open=function()
{this.GetImg.visible=true;};ClassPauseMenu.prototype.Close=function()
{this.GetImg.visible=false;};function ClassBest()
{this.GetImg=new createjs.Container();this.btn_menu=new createjs.Shape();this.btn_menu.graphics.beginFill("#f00").drawCircle(138,100,48);this.btn_menu.addEventListener("mousedown",BestToMenu,false);this.GetImg.addChild(this.btn_menu);var bg=new createjs.Bitmap(load.queue.getResult("bg_best"));bg.x=76;this.GetImg.addChild(bg);this.b_0=new ClassFont(6,4);this.b_0.GetImg.x=630;this.b_0.GetImg.y=224;this.GetImg.addChild(this.b_0.GetImg);this.b_1=new ClassFont(6,4);this.b_1.GetImg.x=630;this.b_1.GetImg.y=224+130;this.GetImg.addChild(this.b_1.GetImg);this.b_2=new ClassFont(6,4);this.b_2.GetImg.x=630;this.b_2.GetImg.y=224+130*2;this.GetImg.addChild(this.b_2.GetImg);this.b_3=new ClassFont(6,4);this.b_3.GetImg.x=630;this.b_3.GetImg.y=224+130*3;this.GetImg.addChild(this.b_3.GetImg);this.b_4=new ClassFont(6,4);this.b_4.GetImg.x=630;this.b_4.GetImg.y=224+130*4;this.GetImg.addChild(this.b_4.GetImg);stage_game.addChild(this.GetImg);this.Close();}
ClassBest.prototype.Open=function()
{this.b_0.Set(save.best[0]);this.b_0.GetImg.x=630-this.b_0.GetImg.width;this.b_1.Set(save.best[1]);this.b_1.GetImg.x=630-this.b_1.GetImg.width;this.b_2.Set(save.best[2]);this.b_2.GetImg.x=630-this.b_2.GetImg.width;this.b_3.Set(save.special_num);this.b_3.GetImg.x=630-this.b_3.GetImg.width;this.b_4.Set(save.credits);this.b_4.GetImg.x=630-this.b_4.GetImg.width;this.GetImg.visible=true;};ClassBest.prototype.Close=function()
{this.GetImg.visible=false;};function ClassAbout()
{this.GetOldWindow=0;this.GetImg=new createjs.Container();this.btn_bac=new createjs.Shape();this.btn_bac.graphics.beginFill("#f00").drawCircle(132,858,50);this.btn_bac.addEventListener("mousedown",AboutToSetting,false);this.GetImg.addChild(this.btn_bac);var bg=new createjs.Bitmap(load.queue.getResult("bg_about"));bg.x=76;this.GetImg.addChild(bg);stage_game.addChild(this.GetImg);this.Close();}
ClassAbout.prototype.Open=function()
{this.GetImg.visible=true;};ClassAbout.prototype.Close=function()
{this.GetImg.visible=false;};function ClassHelp()
{this.GetOldWindow=0;this.GetImg=new createjs.Container();this.h_0=new createjs.Container();this.h_1=new createjs.Container();this.btn_menu=new createjs.Shape();this.btn_menu.graphics.beginFill("#f00").drawCircle(132,866,46);this.btn_menu.addEventListener("mousedown",function()
{if(help.GetOldWindow===0)HelpToMenu();if(help.GetOldWindow===1)HelpToPause();if(help.GetOldWindow===2)HelpToSetting();},false);this.h_0.addChild(this.btn_menu);this.btn_r=new createjs.Shape();this.btn_r.graphics.beginFill("#f00").drawCircle(660,866,46);this.btn_r.addEventListener("mousedown",function(){help.h_1.visible=true;help.h_0.visible=false;},false);this.h_0.addChild(this.btn_r);var bg=new createjs.Bitmap(load.queue.getResult("bg_help_0"));bg.x=76;this.h_0.addChild(bg);this.btn_l=new createjs.Shape();this.btn_l.graphics.beginFill("#f00").drawCircle(132,862,46);this.btn_l.addEventListener("mousedown",function(){help.h_0.visible=true;help.h_1.visible=false;},false);this.h_1.addChild(this.btn_l);this.btn_go=new createjs.Shape();this.btn_go.graphics.beginFill("#f00").drawCircle(660,862,46);this.btn_go.addEventListener("mousedown",function()
{if(help.GetOldWindow===0)HelpToLocation();if(help.GetOldWindow===1)HelpToPause();if(help.GetOldWindow===2)HelpToSetting();},false);this.h_1.addChild(this.btn_go);bg=new createjs.Bitmap(load.queue.getResult("bg_help_1"));bg.x=76;this.h_1.addChild(bg);this.GetImg.addChild(this.h_0);this.GetImg.addChild(this.h_1);stage_game.addChild(this.GetImg);this.Close();}
ClassHelp.prototype.Open=function(b)
{this.GetOldWindow=b;this.h_0.visible=true;this.h_1.visible=false;this.GetImg.visible=true;};ClassHelp.prototype.Close=function()
{this.GetImg.visible=false;};function ClassMainMenu()
{this.GetImg=new createjs.Container();this.btn_more_game=new createjs.Shape();this.btn_more_game.graphics.beginFill("#f00").drawCircle(418,846,62);this.btn_more_game.addEventListener("mousedown",function(){window.open(config.url_button_gamepad);},false);this.GetImg.addChild(this.btn_more_game);this.btn_logo=new createjs.Shape();this.btn_logo.graphics.beginFill("#f00").drawRect(368,132,340,50);this.btn_logo.addEventListener("mousedown",function(){window.open(config.url_logo);},false);this.GetImg.addChild(this.btn_logo);this.btn_play=new createjs.Shape();this.btn_play.graphics.beginFill("#f00").drawCircle(600,800,110);this.btn_play.addEventListener("mousedown",MenuToLocation,false);this.GetImg.addChild(this.btn_play);this.btn_setting=new createjs.Shape();this.btn_setting.graphics.beginFill("#f00").drawCircle(146,846,62);this.btn_setting.addEventListener("mousedown",MenuToSetting,false);this.GetImg.addChild(this.btn_setting);this.btn_best=new createjs.Shape();this.btn_best.graphics.beginFill("#f00").drawCircle(282,846,62);this.btn_best.addEventListener("mousedown",MenuToBest,false);this.GetImg.addChild(this.btn_best);this.bg=new createjs.Bitmap(load.queue.getResult("bg_main_menu"));this.GetImg.addChild(this.bg);stage_game.addChild(this.GetImg);this.Close();}
ClassMainMenu.prototype.Open=function()
{this.GetImg.visible=true;};ClassMainMenu.prototype.Close=function()
{this.GetImg.visible=false;};function ClassBad()
{this.GetType=3;this.GetImg=fruit_sprite.clone();this.GetImg.snapToPixel=true;this.GetImg.x=0;this.GetImg.y=0;this.GetImg.self=this;this.GetImg.visible=false;this.Speed={x:0,y:0,rotation:0};location_game.all_fruits.push(this);}
ClassBad.prototype.Shot=function()
{this.Speed.x=((Math.random()*config.speed_x)-(config.speed_x/2));this.Speed.y=(config.speed_y_min+(Math.random()*(config.speed_y_max-config.speed_y_min))-((config.speed_y_max-config.speed_y_min)/2));this.Speed.rotation=((Math.random()*config.rotation)-(config.rotation/2));this.GetImg.visible=true;this.GetImg.gotoAndStop("b"+((Math.random()*11)<<0));if(this.Speed.x>0)
this.GetImg.x=76+(320*Math.random());else
this.GetImg.x=320+76+(320*Math.random());this.GetImg.y=1100;this.GetImg.rotation=(Math.random()*360);};ClassBad.prototype.DrwUpd=function()
{if(this.GetImg.visible)
{this.Speed.y+=config.acceleration_y;this.GetImg.x+=this.Speed.x;this.GetImg.y+=this.Speed.y;this.GetImg.rotation+=this.Speed.rotation;}};ClassBad.prototype.Kill=function()
{};var mouse={x:0,y:0};var mouse_d={x:0,y:0};var mouse_normal={x:0,y:0};var mouse_lng=0,mouse_step=0;var mouse_down;function CreateMouse()
{stage_game.enableMouseOver(10);stage_cout.enableMouseOver(10);stage_score.enableMouseOver(10);stage_life.enableMouseOver(10);createjs.Touch.enable(stage_game);createjs.Touch.enable(stage_cout);createjs.Touch.enable(stage_score);createjs.Touch.enable(stage_life);stage_game.addEventListener("stagemousemove",function(event){mouse.x=event.stageX;mouse.y=event.stageY;});stage_game.addEventListener("stagemousedown",function(event){mouse_down=true;for(i=0;i<6;i++)
{location_game.logic.mouse_xboct[i].x=event.stageX;location_game.logic.mouse_xboct[i].y=event.stageY;}
mouse.x=event.stageX;mouse.y=event.stageY;});stage_game.addEventListener("stagemouseup",function(event){location_game.logic.mouse_graphics.clear();mouse_down=false;});}var addToHome=(function(w){var nav=w.navigator,isIDevice='platform'in nav&&(/iphone|ipod|ipad/gi).test(nav.platform),isIPad,isRetina,isSafari,isStandalone,OSVersion,startX=0,startY=0,lastVisit=0,isExpired,isSessionActive,isReturningVisitor,balloon,overrideChecks,positionInterval,closeTimeout,options={autostart:true,returningVisitor:false,animationIn:'drop',animationOut:'fade',startDelay:2000,lifespan:15000,bottomOffset:14,expire:0,message:'',touchIcon:false,arrow:true,hookOnLoad:true,closeButton:true,iterations:100},intl={ar:'<span dir="rtl">قم بتثبيت هذا التطبيق على <span dir="ltr">%device:</span>انقر<span dir="ltr">%icon</span> ،<strong>ثم اضفه الى الشاشة الرئيسية.</strong></span>',ca_es:'Per instal·lar aquesta aplicació al vostre %device premeu %icon i llavors <strong>Afegir a pantalla d\'inici</strong>.',cs_cz:'Pro instalaci aplikace na Váš %device, stiskněte %icon a v nabídce <strong>Přidat na plochu</strong>.',da_dk:'Tilføj denne side til din %device: tryk på %icon og derefter <strong>Føj til hjemmeskærm</strong>.',de_de:'Installieren Sie diese App auf Ihrem %device: %icon antippen und dann <strong>Zum Home-Bildschirm</strong>.',el_gr:'Εγκαταστήσετε αυτήν την Εφαρμογή στήν συσκευή σας %device: %icon μετά πατάτε <strong>Προσθήκη σε Αφετηρία</strong>.',en_us:'Install this web app on your %device: tap %icon and then <strong>Add to Home Screen</strong>.',es_es:'Para instalar esta app en su %device, pulse %icon y seleccione <strong>Añadir a pantalla de inicio</strong>.',fi_fi:'Asenna tämä web-sovellus laitteeseesi %device: paina %icon ja sen jälkeen valitse <strong>Lisää Koti-valikkoon</strong>.',fr_fr:'Ajoutez cette application sur votre %device en cliquant sur %icon, puis <strong>Ajouter à l\'écran d\'accueil</strong>.',he_il:'<span dir="rtl">התקן אפליקציה זו על ה-%device שלך: הקש %icon ואז <strong>הוסף למסך הבית</strong>.</span>',hr_hr:'Instaliraj ovu aplikaciju na svoj %device: klikni na %icon i odaberi <strong>Dodaj u početni zaslon</strong>.',hu_hu:'Telepítse ezt a web-alkalmazást az Ön %device-jára: nyomjon a %icon-ra majd a <strong>Főképernyőhöz adás</strong> gombra.',it_it:'Installa questa applicazione sul tuo %device: premi su %icon e poi <strong>Aggiungi a Home</strong>.',ja_jp:'このウェブアプリをあなたの%deviceにインストールするには%iconをタップして<strong>ホーム画面に追加</strong>を選んでください。',ko_kr:'%device에 웹앱을 설치하려면 %icon을 터치 후 "홈화면에 추가"를 선택하세요',nb_no:'Installer denne appen på din %device: trykk på %icon og deretter <strong>Legg til på Hjem-skjerm</strong>',nl_nl:'Installeer deze webapp op uw %device: tik %icon en dan <strong>Voeg toe aan beginscherm</strong>.',pl_pl:'Aby zainstalować tę aplikacje na %device: naciśnij %icon a następnie <strong>Dodaj jako ikonę</strong>.',pt_br:'Instale este aplicativo em seu %device: aperte %icon e selecione <strong>Adicionar à Tela Inicio</strong>.',pt_pt:'Para instalar esta aplicação no seu %device, prima o %icon e depois o <strong>Adicionar ao ecrã principal</strong>.',ru_ru:'Установите это веб-приложение на ваш %device: нажмите %icon, затем <strong>Добавить в «Домой»</strong>.',sv_se:'Lägg till denna webbapplikation på din %device: tryck på %icon och därefter <strong>Lägg till på hemskärmen</strong>.',th_th:'ติดตั้งเว็บแอพฯ นี้บน %device ของคุณ: แตะ %icon และ <strong>เพิ่มที่หน้าจอโฮม</strong>',tr_tr:'Bu uygulamayı %device\'a eklemek için %icon simgesine sonrasında <strong>Ana Ekrana Ekle</strong> düğmesine basın.',zh_cn:'您可以将此应用程式安装到您的 %device 上。请按 %icon 然后点选<strong>添加至主屏幕</strong>。',zh_tw:'您可以將此應用程式安裝到您的 %device 上。請按 %icon 然後點選<strong>加入主畫面螢幕</strong>。'};function init(){if(!isIDevice)return;var now=Date.now(),title,i;if(w.addToHomeConfig){for(i in w.addToHomeConfig){options[i]=w.addToHomeConfig[i];}}
if(!options.autostart)options.hookOnLoad=false;isIPad=(/ipad/gi).test(nav.platform);isRetina=w.devicePixelRatio&&w.devicePixelRatio>1;isSafari=(/Safari/i).test(nav.appVersion)&&!(/CriOS/i).test(nav.appVersion);isStandalone=nav.standalone;OSVersion=nav.appVersion.match(/OS (\d+_\d+)/i);OSVersion=OSVersion[1]?+OSVersion[1].replace('_','.'):0;lastVisit=+w.localStorage.getItem('addToHome');isSessionActive=w.sessionStorage.getItem('addToHomeSession');isReturningVisitor=options.returningVisitor?lastVisit&&lastVisit+28*24*60*60*1000>now:true;if(!lastVisit)lastVisit=now;isExpired=isReturningVisitor&&lastVisit<=now;if(options.hookOnLoad)w.addEventListener('load',loaded,false);else if(!options.hookOnLoad&&options.autostart)loaded();}
function loaded(){w.removeEventListener('load',loaded,false);if(!isReturningVisitor)w.localStorage.setItem('addToHome',Date.now());else if(options.expire&&isExpired)w.localStorage.setItem('addToHome',Date.now()+options.expire*60000);if(!overrideChecks&&(!isSafari||!isExpired||isSessionActive||isStandalone||!isReturningVisitor))return;var touchIcon='',platform=nav.platform.split(' ')[0],language=nav.language.replace('-','_'),i,l;balloon=document.createElement('div');balloon.id='addToHomeScreen';balloon.style.cssText+='left:-9999px;-webkit-transition-property:-webkit-transform,opacity;-webkit-transition-duration:0;-webkit-transform:translate3d(0,0,0);position:'+(OSVersion<5?'absolute':'fixed');if(options.message in intl){language=options.message;options.message='';}
if(options.message===''){options.message=language in intl?intl[language]:intl['en_us'];}
if(options.touchIcon){touchIcon=isRetina?document.querySelector('head link[rel^=apple-touch-icon][sizes="114x114"],head link[rel^=apple-touch-icon][sizes="144x144"]'):document.querySelector('head link[rel^=apple-touch-icon][sizes="57x57"],head link[rel^=apple-touch-icon]');if(touchIcon){touchIcon='<span style="background-image:url('+touchIcon.href+')" class="addToHomeTouchIcon"></span>';}}
balloon.className=(isIPad?'addToHomeIpad':'addToHomeIphone')+(touchIcon?' addToHomeWide':'');balloon.innerHTML=touchIcon+
options.message.replace('%device',platform).replace('%icon',OSVersion>=4.2?'<span class="addToHomeShare"></span>':'<span class="addToHomePlus">+</span>')+
(options.arrow?'<span class="addToHomeArrow"></span>':'')+
(options.closeButton?'<span class="addToHomeClose">\u00D7</span>':'');document.body.appendChild(balloon);if(options.closeButton)balloon.addEventListener('click',clicked,false);if(!isIPad&&OSVersion>=6)window.addEventListener('orientationchange',orientationCheck,false);setTimeout(show,options.startDelay);}
function show(){var duration,iPadXShift=208;if(isIPad){if(OSVersion<5){startY=w.scrollY;startX=w.scrollX;}else if(OSVersion<6){iPadXShift=160;}
balloon.style.top=startY+options.bottomOffset+'px';balloon.style.left=startX+iPadXShift-Math.round(balloon.offsetWidth/2)+'px';switch(options.animationIn){case'drop':duration='0.6s';balloon.style.webkitTransform='translate3d(0,'+-(w.scrollY+options.bottomOffset+balloon.offsetHeight)+'px,0)';break;case'bubble':duration='0.6s';balloon.style.opacity='0';balloon.style.webkitTransform='translate3d(0,'+(startY+50)+'px,0)';break;default:duration='1s';balloon.style.opacity='0';}}else{startY=w.innerHeight+w.scrollY;if(OSVersion<5){startX=Math.round((w.innerWidth-balloon.offsetWidth)/2)+w.scrollX;balloon.style.left=startX+'px';balloon.style.top=startY-balloon.offsetHeight-options.bottomOffset+'px';}else{balloon.style.left='50%';balloon.style.marginLeft=-Math.round(balloon.offsetWidth/2)-(w.orientation%180&&OSVersion>=6?40:0)+'px';balloon.style.bottom=options.bottomOffset+'px';}
switch(options.animationIn){case'drop':duration='1s';balloon.style.webkitTransform='translate3d(0,'+-(startY+options.bottomOffset)+'px,0)';break;case'bubble':duration='0.6s';balloon.style.webkitTransform='translate3d(0,'+(balloon.offsetHeight+options.bottomOffset+50)+'px,0)';break;default:duration='1s';balloon.style.opacity='0';}}
balloon.offsetHeight;balloon.style.webkitTransitionDuration=duration;balloon.style.opacity='1';balloon.style.webkitTransform='translate3d(0,0,0)';balloon.addEventListener('webkitTransitionEnd',transitionEnd,false);closeTimeout=setTimeout(close,options.lifespan);}
function manualShow(override){if(!isIDevice||balloon)return;overrideChecks=override;loaded();}
function close(){clearInterval(positionInterval);clearTimeout(closeTimeout);closeTimeout=null;if(!balloon)return;var posY=0,posX=0,opacity='1',duration='0';if(options.closeButton)balloon.removeEventListener('click',clicked,false);if(!isIPad&&OSVersion>=6)window.removeEventListener('orientationchange',orientationCheck,false);if(OSVersion<5){posY=isIPad?w.scrollY-startY:w.scrollY+w.innerHeight-startY;posX=isIPad?w.scrollX-startX:w.scrollX+Math.round((w.innerWidth-balloon.offsetWidth)/2)-startX;}
balloon.style.webkitTransitionProperty='-webkit-transform,opacity';switch(options.animationOut){case'drop':if(isIPad){duration='0.4s';opacity='0';posY=posY+50;}else{duration='0.6s';posY=posY+balloon.offsetHeight+options.bottomOffset+50;}
break;case'bubble':if(isIPad){duration='0.8s';posY=posY-balloon.offsetHeight-options.bottomOffset-50;}else{duration='0.4s';opacity='0';posY=posY-50;}
break;default:duration='0.8s';opacity='0';}
balloon.addEventListener('webkitTransitionEnd',transitionEnd,false);balloon.style.opacity=opacity;balloon.style.webkitTransitionDuration=duration;balloon.style.webkitTransform='translate3d('+posX+'px,'+posY+'px,0)';}
function clicked(){w.sessionStorage.setItem('addToHomeSession','1');isSessionActive=true;close();}
function transitionEnd(){balloon.removeEventListener('webkitTransitionEnd',transitionEnd,false);balloon.style.webkitTransitionProperty='-webkit-transform';balloon.style.webkitTransitionDuration='0.2s';if(!closeTimeout){balloon.parentNode.removeChild(balloon);balloon=null;return;}
if(OSVersion<5&&closeTimeout)positionInterval=setInterval(setPosition,options.iterations);}
function setPosition(){var matrix=new WebKitCSSMatrix(w.getComputedStyle(balloon,null).webkitTransform),posY=isIPad?w.scrollY-startY:w.scrollY+w.innerHeight-startY,posX=isIPad?w.scrollX-startX:w.scrollX+Math.round((w.innerWidth-balloon.offsetWidth)/2)-startX;if(posY==matrix.m42&&posX==matrix.m41)return;balloon.style.webkitTransform='translate3d('+posX+'px,'+posY+'px,0)';}
function reset(){w.localStorage.removeItem('addToHome');w.sessionStorage.removeItem('addToHomeSession');}
function orientationCheck(){balloon.style.marginLeft=-Math.round(balloon.offsetWidth/2)-(w.orientation%180&&OSVersion>=6?40:0)+'px';}
init();return{show:manualShow,close:close,reset:reset};})(window);