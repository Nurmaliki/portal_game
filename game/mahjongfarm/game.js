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
x1=x1*Utils.globalScale*Utils.globalPixelScale;y1=y1*Utils.globalScale*Utils.globalPixelScale;x2=x2*Utils.globalScale*Utils.globalPixelScale;y2=y2*Utils.globalScale*Utils.globalPixelScale;cns.ctx.beginPath();cns.ctx.moveTo(x1,y1);cns.ctx.lineTo(x2,y2);cns.ctx.closePath();cns.ctx.stroke();cns.ctx.lineWidth=oldLW;};this.start=function()
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
{console={log:function(){}}};var TEXT_ALIGN_LEFT=0;var TEXT_ALIGN_CENTER=1;var TEXT_ALIGN_RIGHT=2;var TEXT_VALIGN_TOP=0;var TEXT_VALIGN_MIDDLE=1;var TEXT_VALIGN_BOTTOM=2;var TEXT_SPRITE_FONT_DEFAULT="sans-serif";function TextSprite(img,w,h,f,l)
{var self=this;TextSprite.superclass.constructor.call(this,img,w,h,f,l);this.text="";this.style={font:TEXT_SPRITE_FONT_DEFAULT,size:10,color:"#fff",borderColor:"#000",borderWidth:0,bold:false,italic:false,lineHeight:10};this.padding={left:0,right:0,top:0,bottom:0};this.align=TEXT_ALIGN_LEFT;this.valign=TEXT_VALIGN_TOP;this.wordWrap=true;this.showTextAlways=false;this.prepareLine=function(text,y,ret)
{var availWidth=this.width-this.padding.left-this.padding.right;var availHeight=this.height-this.padding.top-this.padding.bottom;var words;y+=this.style.lineHeight;if(y>=availHeight)
{return{ret:ret,y:0,next:false};}
words=text.split(" ");var s="";var tmp="";var newLine=false;for(var i=0;i<words.length;i++)
{tmp+=(i>0?" ":"")+words[i];if(this.stage.getTextWidth(tmp,this.canvas)/Utils.globalScale/Utils.globalPixelScale>availWidth)
{if(this.wordWrap)newLine=true;break;}
else s=tmp;}
var x=this.x-this.width/2+this.padding.left;if(this.align!=TEXT_ALIGN_LEFT)
{var textWidth=this.stage.getTextWidth(s,this.canvas)/Utils.globalScale/Utils.globalPixelScale;if(this.align==TEXT_ALIGN_CENTER)
{x=this.x-textWidth/2;x+=(this.padding.left-this.padding.right)/2;}
if(this.align==TEXT_ALIGN_RIGHT)x=this.x+availWidth/2-textWidth-this.padding.right;}
ret.push({text:s,x:x});if(newLine)
{s="";for(var n=i;n<words.length;n++)s+=(n>i?" ":"")+words[n];tmp=this.prepareLine(s,y,ret);ret=tmp.ret;y=tmp.y;}
return{ret:ret,y:y,next:true};}
this.prepareText=function()
{var ret=[];var y=0;var tmp;var txt=this.text+"";var lines=txt.split("\n");for(var i=0;i<lines.length;i++)
{tmp=this.prepareLine(lines[i],y,ret);ret=tmp.ret;y=tmp.y;if(tmp.next===false)return ret;}
return ret;}
this.renderText=function(e)
{self.canvas=e.canvas;var oldLW=self.canvas.ctx.lineWidth;var style="";if(self.style.bold)style+="bold ";if(self.style.italic)style+="italic ";self.stage.setTextStyle(self.style.font,self.style.size,style,self.style.color,self.style.borderColor,self.canvas);self.canvas.ctx.lineWidth=self.style.borderWidth*Utils.globalScale*Utils.globalPixelScale;var data=self.prepareText();var sY=0;if(self.valign==TEXT_VALIGN_TOP)sY=self.y-self.height/2+self.padding.top;if(self.valign==TEXT_VALIGN_MIDDLE)
{var y=self.y;y+=(self.padding.top-self.padding.bottom)/2;sY=y-data.length*self.style.lineHeight/2;}
if(self.valign==TEXT_VALIGN_BOTTOM)sY=self.y+self.height/2-self.padding.bottom-data.length*self.style.lineHeight;sY+=self.style.lineHeight;var ox,oy,diffX,diffY,ignoreVP,canvasMod;for(var i=0;i<data.length;i++)
{oy=sY+i*self.style.lineHeight;ox=data[i].x;diffX=ox-self.x;diffY=oy-self.y;canvasMod=false;ignoreVP=self.ignoreViewport;if(self.rotation!=0||self.scaleX!=1||self.scaleY!=1)
{canvasMod=true;var ow=self.width*Utils.globalScale;var oh=self.height*Utils.globalScale;var ox=self.getX()*Utils.globalPixelScale-Math.floor(ow/2);var oy=self.getY()*Utils.globalPixelScale-Math.floor(oh/2);if(!self.ignoreViewport)
{ox-=self.stage.viewport.x*Utils.globalPixelScale*Utils.globalScale;oy-=self.stage.viewport.y*Utils.globalPixelScale*Utils.globalScale;}
self.canvas.ctx.save();self.canvas.ctx.translate(ox+Math.floor(ow/2),oy+Math.floor(oh/2));self.canvas.ctx.rotate(self.rotation);self.canvas.ctx.scale(self.scaleX,self.scaleY);ox=diffX;oy=diffY;ignoreVP=true;}
if(self.style.borderWidth>0)self.stage.strokeText(data[i].text,ox,oy,(self.showTextAlways?1:self.opacity),ignoreVP,false,self.canvas);self.stage.drawText(data[i].text,ox,oy,(self.showTextAlways?1:self.opacity),ignoreVP,false,self.canvas);if(canvasMod)self.canvas.ctx.restore();}
self.canvas.ctx.lineWidth=oldLW;}
this.addEventListener("render",this.renderText);}
Utils.extend(TextSprite,Sprite);var FontsManager={fonts:[],embed:function(name,url)
{for(var i=0;i<FontsManager.fonts.length;i++)
{if(FontsManager.fonts[i].url==url&&FontsManager.fonts[i].name==name)return;}
var style=document.createElement('style');style.type="text/css";style.innerHTML='@font-face {font-family: "'+name+'"; src: url("'+url+'");}';document.getElementsByTagName('head')[0].appendChild(style);}};var ExternalAPI={type:"Spilgames",init:function(callback)
{if(typeof SpilGames=='undefined')
{if(typeof window.parent!='undefined')
{SpilGames=window.parent.SpilGames;}}
if(ExternalAPI.check())SpilGames.Events.subscribe('gamecontainer.resize',Utils.fitLayoutToScreen);else
{Utils.addFitLayoutListeners();}},check:function()
{return(typeof SpilGames!='undefined');},checkUserLoggedIn:function()
{var state=SpilGames.Auth.getAuthState();if(state=="NOT_AUTHENTICATED")return false;return true;},getUserInfo:function()
{},addChangeLocaleListener:function(callback)
{SpilGames.Events.subscribe('game.language.change',callback);},showLoginForm:function(callback)
{if(!callback)callback=function(){};SpilGames.Portal.forceAuthentication(callback);},showScoreboard:function(callback)
{if(!callback)callback=function(){};SpilGames.Portal.showScoreboard(callback);},submitScores:function(val,callback)
{if(!callback)callback=function(){};SpilGames.Highscores.insert({score:val},callback);}}
if(!ExternalAPI.check())var SpilGames;;var STR_ALIGN_LEFT='left';var STR_ALIGN_CENTER='center';var STR_ALIGN_RIGHT='right';var STR_VALIGN_TOP='top';var STR_VALIGN_MIDDLE='middle';var STR_VALIGN_BOTTOM='bottom';var GUIFont=function(font_asset)
{this.animated=false;this.fontProperties=font_asset;this.charmap=this.fontProperties.charmap;GUIFont.superclass.constructor.call(this,this.fontProperties.image.bitmap,this.fontProperties.image.width,this.fontProperties.image.height,this.fontProperties.image.frames,this.fontProperties.image.layers);GUIFont.prototype.validChar=function(c)
{return(this.fontProperties.charmap.indexOf(c.toString())>=0);}
GUIFont.prototype.setChar=function(c)
{var i=this.fontProperties.charmap.indexOf(c.toString());if(i<0)return;var l=i%this.totalLayers;this.currentLayer=l;var f=Math.floor(i/this.totalLayers);this.gotoAndStop(f);}
GUIFont.prototype.getChar=function()
{var n=this.currentLayer+this.currentFrame*this.totalLayers;return this.fontProperties.charmap[n];}}
Utils.extend(GUIFont,Sprite);var GUIString=function(fontClass,in_back,params)
{this.font=FontManager.getFont(fontClass);if(!this.font)throw new Error("Font '"+fontClass+"' not found!");this.strings=[];this.chars=[];this.align=STR_ALIGN_CENTER;this.valign=STR_VALIGN_MIDDLE;var ch=new this.font();this.charWidth=ch.fontProperties['char'].width;this.charHeight=ch.fontProperties['char'].height;delete(ch);this.visible=true;this.x=0;this.y=0;this.zIndex=0;this.rotation=0;this.opacity=1.0;this.height=0;this.width=0;this['static']=(typeof in_back=='undefined')?false:in_back;this.getString=function()
{return this.strings.join("\n");}
this.getParams=function()
{var obj={visible:this.visible,x:this.x,y:this.y,zIndex:this.zIndex,rotation:this.rotation,opacity:this.opacity,align:this.align,valign:this.valign,letterSpacing:this.charWidth,lineHeight:this.charHeight}
return obj;}
this.setParams=function(obj,refresh)
{if(typeof obj!='object')obj={};if(typeof refresh=='undefined')refresh=false;if(typeof obj['visible']=='undefined')obj.visible=this.visible;if(typeof obj['letterSpacing']=='undefined')obj.letterSpacing=this.charWidth;if(typeof obj['lineHeight']=='undefined')obj.lineHeight=this.charHeight;if(typeof obj['align']=='undefined')obj.align=this.align;if(typeof obj['valign']=='undefined')obj.valign=this.valign;if(typeof obj['x']=='undefined')obj.x=this.x;obj.x=parseInt(obj.x);if(isNaN(obj.x))obj.x=this.x;if(typeof obj['y']=='undefined')obj.y=this.y;obj.y=parseInt(obj.y);if(isNaN(obj.y))obj.y=this.y;if(typeof obj['zIndex']=='undefined')obj.zIndex=this.zIndex;obj.zIndex=parseInt(obj.zIndex);if(isNaN(obj.zIndex))obj.zIndex=this.zIndex;if(typeof obj['rotation']=='undefined')obj.rotation=this.rotation;obj.rotation=parseFloat(obj.rotation);if(isNaN(obj.rotation))obj.rotation=this.rotation;if(typeof obj['opacity']=='undefined')obj.opacity=this.opacity;obj.opacity=parseFloat(obj.opacity);if(isNaN(obj.opacity))obj.opacity=this.opacity;if((obj.letterSpacing!=this.charWidth)||(obj.lineHeight!=this.charHeight))
{this._setSpacing(obj.letterSpacing,obj.lineHeight);refresh=true;}
if((obj.align!=this.align)||(obj.valign!=this.valign))
{this._setAlign(obj.align,obj.valign);refresh=true;}
if((obj.x!=this.x)||(obj.y!=this.y)||(obj.rotation!=this.rotation)||refresh)
{this._refreshSize();this._setPosition(obj.x,obj.y);this._setRotation(obj.rotation);this._setOpacity(obj.opacity);refresh=true;}
if(obj.zIndex!=this.zIndex)
{this._setZIndex(obj.zIndex);}
if(obj.visible!=this.visible)
{this._setVisible(obj.visible);}}
this.refresh=function()
{this.setParams(this.getParams());}
this.write=function(str,x,y,align,valign,rotation,hspace,vspace)
{str=this._prepareString(str);this.strings=str;this._createStageChars();var params={align:align,valign:valign,x:x,y:y,rotation:rotation,letterSpacing:hspace,lineHeight:vspace}
if(this.chars.length>0)params.zIndex=(this.zIndex>0?this.zIndex:this.chars[0].zIndex);var n=0;for(var i=0;i<this.strings.length;i++)
{for(var j=0;j<this.strings[i].length;j++)
{var mc=this.chars[n++];mc['static']=this['static'];mc.setChar(this.strings[i].substring(j,j+1));}}
this.setParams(params,true);}
this.clear=function()
{this.write('');}
this._setVisible=function(v)
{this.visible=v;for(var i=0;i<this.chars.length;i++)
{if(this.chars[i])this.chars[i].visible=this.visible;}}
this._setOpacity=function(v)
{this.opacity=v;for(var i=0;i<this.chars.length;i++)
{if(this.chars[i])this.chars[i].opacity=this.opacity;}}
this._setZIndex=function(z)
{if(typeof z=='undefined')z=this.zIndex;z=~~z;if(z!=this.zIndex)
{this.zIndex=~~z;for(var i=0;i<this.chars.length;i++)
{if(this.chars[i])this.chars[i].setZIndex(z);}}}
this._setSpacing=function(letterSpacing,lineHeight)
{if(typeof letterSpacing=='undefined')letterSpacing=this.charWidth;this.charWidth=~~letterSpacing;if(typeof lineHeight=='undefined')lineHeight=this.charHeight;this.charHeight=~~lineHeight;}
this._setAlign=function(align,valign)
{if(typeof align=='undefined')align=this.align;this.align=align.toString().toLowerCase();if(typeof valign=='undefined')valign=this.valign;this.valign=valign.toString().toLowerCase();}
this._setPosition=function(x,y)
{this.x=x;this.y=y;var dy=Math.round(this.charHeight/2);if(this.valign==STR_VALIGN_MIDDLE)dy-=Math.round(this.height/2);if(this.valign==STR_VALIGN_BOTTOM)dy-=this.height;var n=0;for(var i=0;i<this.strings.length;i++)
{var strWidth=this.charWidth*this.strings[i].length;var dx=-Math.round(this.charWidth/2);if(this.align==STR_ALIGN_CENTER)dx-=Math.round(strWidth/2);if(this.align==STR_ALIGN_RIGHT)dx-=strWidth;for(var j=0;j<this.strings[i].length;j++)
{var ch=this.chars[n++];if(ch)
{dx+=this.charWidth;ch.x=this.x+dx;ch.y=this.y+dy;}}
dy+=this.charHeight;}}
this._setRotation=function(a)
{if(a>=Math.PI*2)a-=Math.PI*2;if(a<0)a+=Math.PI*2;this.rotation=a;if(this.chars.length==0)return;for(var i=0;i<this.chars.length;i++)
{if(!this.chars[i])continue;var p=new Vector(this.chars[i].x-this.x,this.chars[i].y-this.y);p.rotate(-this.rotation);this.chars[i].x=this.x+p.x;this.chars[i].y=this.y+p.y;this.chars[i].rotation=this.rotation;}}
this._validateString=function(str)
{str=str.toString();var valid='';var font=new this.font();for(var i=0;i<str.length;i++)
{var c=str.substring(i,i+1);if(font.validChar(c))valid+=c;}
return valid;}
this._refreshSize=function()
{var maxLength=0;for(var i=0;i<this.strings.length;i++)
{maxLength=Math.max(maxLength,this.strings[i].length);}
this.width=this.charWidth*maxLength;this.height=this.charHeight*this.strings.length;}
this._createStageChars=function()
{var n=this.strings.join('').length;var diff=this.chars.length-n;if(diff==0)return;while(diff!=0)
{var mc;if(diff<0)
{mc=new this.font();mc=stage.addChild(mc);mc.visible=this.visible;this.chars.push(mc);}
else
{mc=this.chars.pop();stage.removeChild(mc);}
diff+=diff<0?1:-1;}
this._refreshSize();}
this._prepareString=function(str)
{str=String(str).split("\n");for(var i=0;i<str.length;i++)
{str[i]=this._validateString(str[i]);}
return str;}
this.debugDraw=function(col)
{if(typeof col=='undefined')col='#FFF';this._debugDrawAnchor(col);this._debugDrawBox(col);}
this._debugDrawBox=function(col)
{}
this._debugDrawAnchor=function(col)
{stage.drawRectangle(this.x,this.y,3,3,col,true,0.8);}
if(typeof params=='object')this.setParams(params);}
var Charset={getByName:function(name)
{if(typeof Charset[name]=='undefined')
{throw new Error("Character set ' "+name+" ' is not defined!");}
return Charset[name];},digits:['0','1','2','3','4','5','6','7','8','9','+','-','.',',','*','/','=','(',')','<','>','#','$','%','&',':',';','|','№','@','~','"'],full:[' ','!','"','#','$','%','&','\'','(',')','*','+',',','-','.','/','0','1','2','3','4','5','6','7','8','9',':',';','<','=','>','?','@','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','[','\\',']','^','_','`','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','{','|','}','~',' ','Ё','Ђ','Ѓ','Є','Ѕ','І','Ї','Ј','Љ','Њ','Ћ','Ќ','Ў','Џ','А','Б','В','Г','Д','Е','Ж','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я','а','б','в','г','д','е','ж','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я','№','ё','ђ','ѓ','є','ѕ','і','ї','ј','љ','њ','ћ','ќ','§','ў','џ','Š','Ž','š','ž','Ÿ','¢','£','¥','§','©','«','®','µ','»','À','Á','Â','Ã','Ä','Å','Æ','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ð','Ñ','Ò','Ó','Ô','Õ','Ö','×','Ø','Ù','Ú','Û','Ü','Ý','Þ','ß','à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í','î','ï','ð','ñ','ò','ó','ô','õ','ö','÷','ø','ù','ú','û','ü','ý','þ','ÿ'],latin:[' ','!','"','#','$','%','&','\'','(',')','*','+',',','-','.','/','0','1','2','3','4','5','6','7','8','9',':',';','<','=','>','?','@','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','[','\\',']','^','_','`','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','{','|','}','~',' ']}
var FontManager={_fonts:{},defaultCharmap:Charset.full,fontNameFromBitmap:function(bitmap)
{var src=(typeof bitmap=='string')?bitmap:bitmap.src;src=src.replace('\\','/').split('/').pop();src=src.split('.').shift();return src;},createAssetFromSprite:function(name,sprite)
{var img=new Asset(name,sprite.bitmap.src,sprite.width,sprite.height,sprite.totalFrames,sprite.totalLayers);img.bitmap=sprite.bitmap;return img;},createFontAsset:function(img,charmap,w,h)
{var asset,name;if(typeof img=='string')
{if(typeof library=='undefined')throw new Error("Bitmaps access by name works only with AssetsLibrary");try
{name=img;asset=library.getAsset(name);}
catch(e)
{throw new Error("Sprite not found for font '"+name+"'");}}
else if(typeof img=='object')
{var check_props=['bitmap','width','height','totalFrames','totalLayers'];for(var i=0;i<check_props.length;i++)
{if(typeof img[check_props[i]]=='undefined')
{throw new Error("Invalid image. Instance of Sprite expected.");}}
name=FontManager.fontNameFromBitmap(img.bitmap);asset=FontManager.createAssetFromSprite(name,img);}
else throw new Error("Invalid image. Asset name or instance of Sprite expected.");asset=new GUIFontAsset(name,asset,charmap);w=~~w;h=~~h;if(w>0)asset['char'].width=w;if(h>0)asset['char'].height=h;return asset;},registerFont:function(bitmap,charmap,w,h)
{if(typeof charmap=='string')
{charmap=Charset.getByName(charmap);}
var asset=FontManager.createFontAsset(bitmap,charmap,w,h);var f=function()
{f.superclass.constructor.call(this,asset);}
Utils.extend(f,GUIFont);FontManager._fonts[asset.name]=f;return asset.name;},getFont:function(name)
{if(typeof FontManager._fonts[name]=='undefined')
{FontManager.registerFont(name,FontManager.defaultCharmap);}
return FontManager._fonts[name];}}
var GUIFontAsset=function(name,asset,charmap)
{this.name=name;this.image=asset;this.charmap=charmap;this['char']={width:asset.width,height:asset.height};};function AudioPlayer()
{var self=this;this.disabled=false;this.basePath="";this.mp3Support=true;this.delayPlay=false;this.audioWrapper=null;this.locked=false;this.busy=false;this.startPlayTime=0;this.onend=null;this.createNewAudio=function()
{return document.createElement('audio');};this.init=function(path)
{this.basePath=path?path:"";this.delayPlay=("ontouchstart"in window);this.audioWrapper=this.createNewAudio();if(this.audioWrapper.canPlayType)this.mp3Support=this.audioWrapper.canPlayType('audio/mpeg')!="";else this.disabled=true;return!this.disabled;};this.play=function(file,loop)
{if(this.disabled)return false;var url=this.basePath+"/"+file+(this.mp3Support?".mp3":".ogg");this.stop();this.audioWrapper=this.createNewAudio();this.audioWrapper.src=url;this.audioWrapper.type=(this.mp3Support?"audio/mpeg":"audio/ogg");this.audioWrapper.loop=false;this.audioWrapper.doLoop=(loop?true:false);this.audioWrapper.preload="auto";this.audioWrapper.load();this.busy=true;this.audioWrapper.addEventListener("ended",this.controlPlay,false);if(this.delayPlay)this.audioWrapper.addEventListener("canplay",this.readyToPlay);else this.audioWrapper.play();this.startPlayTime=new Date().getTime();};this.readyToPlay=function(e)
{e.currentTarget.play();}
this.stop=function()
{this.busy=false;try
{this.audioWrapper.removeEventListener("canplay",this.readyToPlay);this.audioWrapper.pause();this.audioWrapper.currentTime=0.0;this.audioWrapper=null;}
catch(e){};};this.controlPlay=function()
{if(self.audioWrapper.doLoop)
{self.audioWrapper.pause();self.audioWrapper.currentTime=0.0;self.audioWrapper.play();}
else
{self.busy=false;if(typeof self.onend=="function")self.onend();}}}
function AudioMixer(path,channelsCount)
{this.channels=[];this.init=function(path,channelsCount)
{this.path=path;this.channels=[];for(var i=0;i<channelsCount;i++)
{this.channels[i]=new AudioPlayer(path);this.channels[i].init(path);}};this.play=function(file,loop,soft,channelID)
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
else cID=freeChannels[0];return cID;};this.init(path,channelsCount);};var ELEMENTS=[[[[6,0,8],[0,0,0],[2,0,3],],],[[[6,0,8,0,3,0,1],[0,0,0,0,0,0,0],[2,0,3,0,3,0,1],],[[0,0,0,0,0,0,0],[0,2,0,0,0,2,0],[0,0,0,0,0,0,0],],],[[[6,0,8,0,3,0,1,0,1,0,1,0,1,0,1],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[6,0,8,0,3,0,1,0,1,0,1,0,1,0,1],],],[[[0,0,1,0,0,0,1,0,0,0,1,0,0,0,1,0,0,0,1,0,0,0,1,],[1,0,0,0,1,0,0,0,1,0,0,0,1,0,0,0,1,0,0,0,1,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,1,0,0,0,1,0,0,0,1,0,0,0,1,0,0,0,1,0,0,0,1,],[1,0,0,0,1,0,0,0,1,0,0,0,1,0,0,0,1,0,0,0,1,0,0,],],],[[[0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,0,],[0,0,0,0,0,0,3,0,0,0,3,0,0,0,3,0,0,0,3,0,0,0,0,],[1,0,3,0,3,0,0,0,3,0,0,0,3,0,0,0,3,0,0,0,2,0,2,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[2,0,3,0,0,0,3,0,0,0,3,0,0,0,3,0,0,0,3,0,2,0,2,],[0,0,0,0,4,0,0,0,3,0,0,0,3,0,0,0,3,0,0,0,0,0,0,],[0,0,3,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,0,],],],[[[0,0,0,0,6,0,0,0,6,0,0,0,6,0,0,0,6,0,0,0,6,0,0,0,6,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,2,0,3,0,3,0,3,0,3,0,3,0,3,0,3,0,3,0,3,0,3,0,3,0,0],[2,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,3],[0,0,2,0,3,0,3,0,3,0,3,0,3,0,3,0,3,0,3,0,3,0,3,0,3,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,6,0,0,0,6,0,0,0,6,0,0,0,6,0,0,0,6,0,0,0,6,0,0],],],[[[0,0,0,0,0,0,0,0,0,0,2,0,2,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,2,0,2,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,2,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,2,0,0,],[2,0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,2,],[0,0,2,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,2,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,2,0,2,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,2,0,2,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],],[[[0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,2,0,2,0,0,0,0,0,2,0,2,0,0,0,0,0,2,0,2,0,0,],[2,0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,2,],[0,0,2,0,2,0,0,0,0,0,2,0,2,0,0,0,0,0,2,0,2,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],],[[[0,2,0,2,0,2,0,0,0,0,0,0,0,0,0,0,0,2,0,2,0,2,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,2,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,2,0,0,],[2,0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,2,],[0,0,2,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,2,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,2,0,2,0,2,0,0,0,0,0,0,0,0,0,0,0,2,0,2,0,2,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],],[[[0,2,0,2,0,2,0,0,0,0,0,0,0,2,0,2,0,2,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,2,0,2,0,0,0,0,0,0,0,0,0,2,0,2,0,0,],[2,0,0,0,0,0,2,0,0,0,0,0,2,0,0,0,0,0,2,],[0,0,2,0,2,0,0,0,0,0,0,0,0,0,2,0,2,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,2,0,2,0,2,0,0,0,0,0,0,0,2,0,2,0,2,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],],[[[0,0,0,0,0,2,0,0,0,0,0,0,2,0,0,0,0,0,0,2,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,2,0,2,0,2,0,0,0,0,2,0,0,0,0,2,0,2,0,2,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,2,0,2,0,0,0,0,0,0,0,0,0,0,0,2,0,2,0,0,0,0,],[2,0,2,0,0,0,0,0,2,0,2,0,0,0,2,0,2,0,0,0,0,0,2,0,2,],[0,0,0,0,2,0,2,0,0,0,0,0,0,0,0,0,0,0,2,0,2,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,2,0,2,0,2,0,0,0,0,2,0,0,0,0,2,0,2,0,2,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,2,0,0,0,0,0,0,2,0,0,0,0,0,0,2,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],],[[[0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,2,0,2,0,2,0,2,0,0,0,0,0,0,0,0,2,0,2,0,2,0,2,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,2,0,2,0,0,0,0,0,0,0,0,0,0,2,0,2,0,0,0,0,],[2,0,2,0,0,0,0,0,2,0,2,0,0,2,0,2,0,0,0,0,0,2,0,2,],[0,0,0,0,2,0,2,0,0,0,0,0,0,0,0,0,0,2,0,2,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,2,0,2,0,2,0,2,0,0,0,0,0,0,0,0,2,0,2,0,2,0,2,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,2,0,2,0,2,0,0,0,0,0,0,0,0,2,0,2,0,2,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],],[[[0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,2,0,2,0,2,0,2,0,2,0,0,0,0,0,2,0,2,0,2,0,2,0,2,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,2,0,2,0,0,0,0,0,0,0,0,0,0,0,2,0,2,0,0,0,0,],[2,0,2,0,0,0,0,0,2,0,2,0,0,0,2,0,2,0,0,0,0,0,2,0,2,],[0,0,0,0,2,0,2,0,0,0,0,0,0,0,0,0,0,0,2,0,2,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,2,0,2,0,2,0,2,0,2,0,0,0,0,0,2,0,2,0,2,0,2,0,2,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,0,],[0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,2,0,2,0,2,0,0,0,0,0,0,0,0,0,2,0,2,0,2,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,],[0,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],],[[[0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,2,0,2,0,2,0,2,0,2,0,0,0,2,0,2,0,2,0,2,0,2,0,2,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,2,0,2,0,0,0,0,0,0,0,0,0,0,0,2,0,2,0,0,0,0,],[2,0,2,0,0,0,0,0,2,0,2,0,0,0,2,0,2,0,0,0,0,0,2,0,2,],[0,0,0,0,2,0,2,0,0,0,0,0,0,0,0,0,0,0,2,0,2,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,2,0,2,0,2,0,2,0,2,0,2,0,0,0,2,0,2,0,2,0,2,0,2,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,2,0,0,0,0,0,2,0,0,0,0,0,0,0,2,0,0,0,0,0,2,0,0,],[0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,2,0,2,0,2,0,0,0,0,0,0,0,0,0,2,0,2,0,2,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,],[0,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],],[[[0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,2,0,2,0,2,0,2,0,2,0,0,0,2,0,2,0,2,0,2,0,2,0,2,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,2,0,2,0,0,0,0,0,0,0,0,0,0,0,2,0,2,0,0,0,0,],[2,0,2,0,0,0,0,0,2,0,2,0,0,0,2,0,2,0,0,0,0,0,2,0,2,],[0,0,0,0,2,0,2,0,0,0,0,0,0,0,0,0,0,0,2,0,2,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,2,0,2,0,2,0,2,0,2,0,2,0,0,0,2,0,2,0,2,0,2,0,2,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,2,0,2,0,0,0,0,0,0,0,0,0,2,0,2,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,2,0,0,0,0,0,2,0,0,0,0,0,0,0,2,0,0,0,0,0,2,0,0,],[0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,2,0,2,0,2,0,0,0,0,0,0,0,0,0,2,0,2,0,2,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,],[0,0,2,0,0,0,0,0,2,0,0,0,0,0,0,0,2,0,0,0,0,0,2,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,2,0,2,0,0,0,0,0,0,0,0,0,0,0,2,0,2,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,3,0,0,0,0,0,0,0,0,0,0,0,0,0,3,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],],[[[0,0,0,0,0,0,0,0,0,0,1,0,1,0,0,0,0,0,0,0,0,0,0,],[0,0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,1,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[1,0,1,0,1,0,1,0,0,0,1,0,1,0,0,0,1,0,1,0,1,0,1,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[1,0,1,0,1,0,1,0,0,0,1,0,1,0,0,0,1,0,1,0,1,0,1,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,1,0,0,],[0,0,0,0,0,0,0,0,0,0,1,0,1,0,0,0,0,0,0,0,0,0,0,],],],[[[0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,1,0,1,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,1,0,0,0,1,0,1,0,1,0,1,0,1,0,1,0,0,0,1,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[1,0,1,0,0,1,0,1,0,1,0,1,0,1,0,1,0,0,1,0,1],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,1,0,1,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0],],],[[[0,0,0,0,0,0,0,0,0,1,0,1,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,1,0,1,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[1,0,1,0,0,1,0,1,0,1,0,1,0,1,0,1,0,0,1,0,1],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[1,0,1,0,0,1,0,1,0,1,0,1,0,1,0,1,0,0,1,0,1],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,1,0,1,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,1,0,1,0,0,0,0,0,0,0,0,0],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,2,0,0,0,0,0,0,2,0,0,0,2,0,0,0,0,0,0,2,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],],],[[[0,0,0,0,0,0,0,0,0,1,0,1,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,1,0,1,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[1,0,1,0,1,0,0,1,0,1,0,1,0,1,0,0,1,0,1,0,1],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[1,0,1,0,1,0,0,1,0,1,0,1,0,1,0,0,1,0,1,0,1],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,1,0,1,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,1,0,1,0,0,0,0,0,0,0,0,0],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,2,0,2,0,0,0,0,0,2,0,2,0,0,0,0,0,2,0,2,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,3,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,3,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],],],[[[0,0,0,0,0,0,0,0,0,0,0,1,0,1,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,1,0,0,0,0,0,0,1,0,1,0,0,0,0,0,0,1,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,1,0,1,0,1,0,0,1,0,1,0,1,0,1,0,0,1,0,1,0,1,0,0],[1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1],[0,0,1,0,1,0,1,0,0,1,0,1,0,1,0,1,0,0,1,0,1,0,1,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,1,0,0,0,0,0,0,1,0,1,0,0,0,0,0,0,1,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,1,0,1,0,0,0,0,0,0,0,0,0,0,0],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,2,0,2,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,2,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,2,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,2,0,2,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],],],[[[0,0,0,0,0,0,0,0,0,0,0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,],[0,0,1,0,0,0,0,0,0,0,0,1,0,1,0,0,0,0,0,0,0,0,1,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[1,0,1,0,1,0,0,0,0,1,0,1,0,1,0,1,0,0,0,0,1,0,1,0,1,],[0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,],[1,0,1,0,1,0,0,0,0,1,0,1,0,1,0,1,0,0,0,0,1,0,1,0,1,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,1,0,0,0,0,0,0,0,0,1,0,1,0,0,0,0,0,0,0,0,1,0,0,],[0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,2,0,2,0,0,0,0,0,0,0,0,0,0,0,],[0,2,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,2,0,],[0,0,0,0,0,0,0,0,0,0,0,2,0,2,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],],[[[0,0,1,0,0,0,0,0,0,0,0,1,0,1,0,0,0,0,0,0,0,0,1,0,0,],[1,0,0,0,1,0,0,0,0,1,0,0,0,0,0,1,0,0,0,0,1,0,0,0,1,],[0,0,1,0,0,0,0,0,0,0,0,1,0,1,0,0,0,0,0,0,0,0,1,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[1,0,1,0,1,0,0,0,0,1,0,1,0,1,0,1,0,0,0,0,1,0,1,0,1,],[0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,],[1,0,1,0,1,0,0,0,0,1,0,1,0,1,0,1,0,0,0,0,1,0,1,0,1,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,1,0,0,0,0,0,0,0,0,1,0,1,0,0,0,0,0,0,0,0,1,0,0,],[1,0,0,0,1,0,0,0,0,1,0,0,0,0,0,1,0,0,0,0,1,0,0,0,1,],[0,0,1,0,0,0,0,0,0,0,0,1,0,1,0,0,0,0,0,0,0,0,1,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,2,0,2,0,0,0,0,0,0,0,0,0,0,0,],[0,2,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,2,0,],[0,0,0,0,0,0,0,0,0,0,0,2,0,2,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,3,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,3,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,3,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,3,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],],[[[0,0,0,0,0,0,0,0,0,0,0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,1,0,1,0,1,0,1,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,1,0,1,0,1,0,1,0,1,0,1,0,0,0,0,0,0,0,],[0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,],[0,0,0,0,0,0,0,1,0,1,0,1,0,1,0,1,0,1,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,1,0,1,0,1,0,1,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,2,0,2,0,2,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,2,0,2,0,2,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],],[[[0,0,0,0,0,0,0,0,0,1,0,1,0,1,0,1,0,0,0,0,0,0,0,0,0,],[1,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,1,0,1,0,1,0,1,0,1,0,1,0,0,0,0,0,0,0,],[0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,],[0,0,0,0,0,0,0,1,0,1,0,1,0,1,0,1,0,1,0,0,0,0,0,0,0,],[0,0,0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,1,0,0,0,],[0,0,0,0,0,0,0,1,0,1,0,1,0,1,0,1,0,1,0,0,0,0,0,0,0,],[0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,],[0,0,0,0,0,0,0,1,0,1,0,1,0,1,0,1,0,1,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,1,],[0,0,0,0,0,0,0,0,0,1,0,1,0,1,0,1,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,2,0,2,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,2,0,2,0,2,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,2,0,2,0,2,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,2,0,2,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],],[[[0,0,0,0,0,0,0,1,0,1,0,1,0,1,0,1,0,1,0,0,0,0,0,0,0,],[1,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,1,],[0,0,0,0,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,0,0,0,0,],[0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,],[0,0,0,0,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,0,0,0,0,],[0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,1,0,],[0,0,0,0,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,0,0,0,0,],[0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,],[0,0,0,0,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,0,0,0,0,],[1,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,1,],[0,0,0,0,0,0,0,1,0,1,0,1,0,1,0,1,0,1,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,],[0,0,0,0,0,0,0,0,0,0,0,2,0,2,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,2,0,0,0,0,0,2,0,2,0,2,0,0,0,0,0,2,0,0,0,0,],[0,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,0,],[0,0,0,0,2,0,0,0,0,0,2,0,2,0,2,0,0,0,0,0,2,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,2,0,2,0,0,0,0,0,0,0,0,0,0,0,],[0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,3,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,3,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],],[[[1,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,1,],[0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,],[1,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,1,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,1,0,1,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,1,0,1,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[1,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,1,],[0,0,0,0,0,0,0,0,0,1,0,1,0,0,0,0,0,0,0,0,0,],[1,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,1,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],],[[[1,0,1,0,0,0,0,0,1,0,1,0,0,0,0,0,1,0,1,0,0,0,0,0,1,0,1,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[1,0,1,0,0,0,0,0,1,0,1,0,0,0,0,0,1,0,1,0,0,0,0,0,1,0,1,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,1,0,0,0,0,0,1,0,0,0,1,0,0,0,0,0,1,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[1,0,1,0,0,0,0,0,1,0,1,0,0,0,0,0,1,0,1,0,0,0,0,0,1,0,1,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[1,0,1,0,0,0,0,0,1,0,1,0,0,0,0,0,1,0,1,0,0,0,0,0,1,0,1,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,2,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,2,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,2,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,2,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],],[[[1,0,1,0,0,0,0,0,1,0,1,0,0,0,0,0,1,0,1,0,0,0,0,0,1,0,1,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[1,0,1,0,0,0,0,0,1,0,1,0,0,0,0,0,1,0,1,0,0,0,0,0,1,0,1,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,1,0,1,0,0,0,0,0,1,0,1,0,0,0,0,0,1,0,1,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,1,0,1,0,0,0,0,0,1,0,1,0,0,0,0,0,1,0,1,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[1,0,1,0,0,0,0,0,1,0,1,0,0,0,0,0,1,0,1,0,0,0,0,0,1,0,1,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[1,0,1,0,0,0,0,0,1,0,1,0,0,0,0,0,1,0,1,0,0,0,0,0,1,0,1,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,2,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,2,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,2,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,2,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],],[[[1,0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,1,0,1,0,1,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[1,0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,1,0,1,0,1,],[0,0,0,0,0,0,0,0,0,1,0,1,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,1,0,1,0,0,0,0,0,0,0,0,0,],[1,0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,1,0,1,0,1,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[1,0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,1,0,1,0,1,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,2,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,2,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,2,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,2,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,3,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,3,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,3,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,3,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],],[[[1,0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,1,0,1,0,1,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[1,0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,1,0,1,0,1,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,1,0,1,0,1,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,1,0,1,0,1,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[1,0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,1,0,1,0,1,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[1,0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,1,0,1,0,1,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,2,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,2,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,2,0,2,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,2,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,2,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,3,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,3,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,3,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,3,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],],[[[1,0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,1,0,1,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[1,0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,1,0,1,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,1,0,1,0,1,0,0,0,1,0,1,0,1,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,1,0,1,0,1,0,0,0,1,0,1,0,1,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[1,0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,1,0,1,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[1,0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,1,0,1,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,2,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,2,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,2,0,2,0,0,0,0,0,2,0,2,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,2,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,2,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,3,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,3,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,3,0,0,0,0,0,0,0,3,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,3,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,3,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],],[[[0,0,0,0,0,0,0,0,0,0,1,0,1,0,1,0,0,0,0,0,0,0,0,0,0,],[0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,1,0,],[0,0,0,0,0,0,0,0,1,0,1,0,1,0,1,0,1,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,1,0,1,0,1,0,1,0,1,0,0,0,0,0,0,0,0,],[0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,1,0,],[0,0,0,0,0,0,0,0,0,0,1,0,1,0,1,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,2,0,2,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,2,0,2,0,0,0,2,0,2,0,0,0,2,0,2,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,2,0,2,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],],[[[0,0,0,0,0,0,0,0,0,0,1,0,1,0,1,0,0,0,0,0,0,0,0,0,0,],[0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,1,0,],[0,0,0,0,0,0,0,0,1,0,1,0,1,0,1,0,1,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,1,0,1,0,1,0,1,0,1,0,0,0,0,0,0,0,0,],[0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,1,0,],[0,0,0,0,0,0,0,0,0,0,1,0,1,0,1,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,2,0,0,0,0,0,0,0,0,2,0,2,0,0,0,0,0,0,0,0,2,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,2,0,2,0,0,0,2,0,2,0,0,0,2,0,2,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,2,0,0,0,0,0,0,0,0,2,0,2,0,0,0,0,0,0,0,0,2,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,3,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,3,0,0,0,0,0,0,0,0,0,0,0,3,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,3,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],],[[[1,0,1,0,0,0,0,0,0,0,1,0,1,0,1,0,0,0,0,0,0,0,1,0,1,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[1,0,1,0,0,0,0,0,1,0,1,0,1,0,1,0,1,0,0,0,0,0,1,0,1,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[1,0,1,0,0,0,0,0,1,0,1,0,1,0,1,0,1,0,0,0,0,0,1,0,1,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[1,0,1,0,0,0,0,0,0,0,1,0,1,0,1,0,0,0,0,0,0,0,1,0,1,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,2,0,0,0,0,0,0,0,0,0,2,0,2,0,0,0,0,0,0,0,0,0,2,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,2,0,2,0,0,0,2,0,2,0,0,0,2,0,2,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,2,0,0,0,0,0,0,0,0,0,2,0,2,0,0,0,0,0,0,0,0,0,2,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,3,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,3,0,0,0,0,0,0,0,0,0,0,0,3,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,3,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],],[[[0,0,0,0,0,0,0,0,0,0,0,1,0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,0,0,0,0,],[0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,],[0,0,0,0,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,1,0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,2,0,2,0,2,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,2,0,2,0,2,0,0,0,0,0,2,0,2,0,2,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,2,0,2,0,2,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,2,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,3,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,3,0,0,0,0,3,0,0,0,0,3,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,3,0,3,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],],[[[0,0,1,0,1,0,0,0,0,0,0,1,0,1,0,1,0,0,0,0,0,0,1,0,1,0,0,],[1,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,1,],[0,0,1,0,1,0,0,0,0,1,0,1,0,1,0,1,0,1,0,0,0,0,1,0,1,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,1,0,1,0,0,0,0,1,0,1,0,1,0,1,0,1,0,0,0,0,1,0,1,0,0,],[1,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,1,],[0,0,1,0,1,0,0,0,0,0,0,1,0,1,0,1,0,0,0,0,0,0,1,0,1,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,2,0,0,0,0,0,0,0,0,2,0,2,0,0,0,0,0,0,0,0,2,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,2,0,2,0,0,0,2,0,2,0,0,0,2,0,2,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,2,0,0,0,0,0,0,0,0,2,0,2,0,0,0,0,0,0,0,0,2,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,3,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,3,0,0,0,0,0,0,0,0,0,0,0,3,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,3,0,0,0,0,0,0,0,0,0,0,0,0,0,],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,],],],];;var stage;var mc;var fps=24;var bitmaps;var data=[];var STATE_SPLASH=0;var STATE_MENU=1;var STATE_INSTRUCTIONS=2;var STATE_SELECT_LEVEL=3;var STATE_GAME=4;var STATE_BEST_SCORE=5;var STATE_ABOUT=6;var STATE_UNLOCKED_LEVEL=7;var score=0;var total_score;var LANDSCAPE_MODE=true;var mixer;var iosMode=false;var level=1;var lives=0;var total_score=0;var block=false;var screenWidthCoef=1;var screenWidthRatioPos=0;window.onload=function()
{GET=Utils.parseGet();Utils.addMobileListeners(LANDSCAPE_MODE);Utils.mobileCorrectPixelRatio();Utils.addFitLayoutListeners();setTimeout(startLoad,600);};function startLoad()
{var resolution=Utils.getMobileScreenResolution(LANDSCAPE_MODE);if(GET["debug"]==1)resolution=Utils.getScaleScreenResolution(1,LANDSCAPE_MODE);Utils.globalScale=resolution.scale;var ratioCoefs=[1.5,1.6,1.66,1.7,1.78,1.52];var ratioWidth=[1,1.0666,1.106,1.133,1.187,1.0666];var ratioHeight=[1,1,1,1,1,1.05];if(window.innerWidth>window.innerHeight)var coef=window.innerWidth/window.innerHeight;else var coef=window.innerHeight/window.innerWidth;var min=100000,minPos=-1,diff;for(var i=0;i<ratioCoefs.length-1;i++)
{diff=Math.abs(coef-ratioCoefs[i]);if(diff<min)
{min=diff;minPos=i;}}
if(window.innerHeight==672)
{minPos=5;}
screenWidthCoef=ratioWidth[minPos];screenHeightCoef=ratioHeight[minPos];screenWidthRatioPos=minPos;resolution.width=Math.round(resolution.width*screenWidthCoef);resolution.height=Math.round(resolution.height*screenHeightCoef);Utils.createLayout(document.getElementById("main_container"),resolution);Utils.addEventListener("fitlayout",function()
{if(stage)
{stage.drawScene(document.getElementById("screen"));buildBackground();}});Utils.addEventListener("lockscreen",function(){if(stage&&stage.started)stage.stop();});Utils.addEventListener("unlockscreen",function(){if(stage&&!stage.started)stage.start();});Utils.mobileHideAddressBar();if(GET["debug"]!=1)Utils.checkOrientation(LANDSCAPE_MODE);var path=Utils.imagesRoot+"/"+Utils.globalScale+"/";var preloader=new ImagesPreloader();if(minPos==5)minPos=0;for(var i=0;i<29;i++)
{var j=i+1;data.push({name:"elem"+j,src:path+"elem"+j+".png"});}
data.push({name:"select",src:path+"select.png"});data.push({name:"explosion",src:path+"explosion_anim.png"});data.push({name:"p50",src:path+"p50.png"});data.push({name:"levelnum1",src:path+"levelnum1.png"});data.push({name:"text_elem_1",src:path+"text_elem_1.png"});data.push({name:"text_elem_2",src:path+"text_elem_2.png"});data.push({name:"text_elem_3",src:path+"text_elem_3.png"});data.push({name:"pause_btn",src:path+"pause.png"});data.push({name:"about_btn",src:path+"about.png"});data.push({name:"back_btn",src:path+"back.png"});data.push({name:"best_score_btn",src:path+"best_score.png"});data.push({name:"more_games_btn",src:path+"more_games.png"});data.push({name:"play_btn",src:path+"play.png"});data.push({name:"play_mini_btn",src:path+"play_mini.png"});data.push({name:"replay_btn",src:path+"replay.png"});data.push({name:"select_lvl_btn",src:path+"select_lvl.png"});data.push({name:"shuffle_btn",src:path+"shuffle.png"});data.push({name:"more_games",src:path+"more_games.png"});data.push({name:"sound_btn",src:path+"sound.png"});data.push({name:"splash",src:path+"splash.png"});data.push({name:"about",src:path+"about.jpg"});data.push({name:"best_score",src:path+"rations/"+minPos+"/best_score.png"});data.push({name:"cover",src:path+"rations/"+minPos+"/cover.jpg"});data.push({name:"level_cleared",src:path+"rations/"+minPos+"/level_cleared.png"});data.push({name:"game_over",src:path+"rations/"+minPos+"/game_over.png"});data.push({name:"instructions",src:path+"rations/"+minPos+"/instructions.jpg"});data.push({name:"menu",src:path+"rations/"+minPos+"/menu.jpg"});data.push({name:"gamebackground",src:path+"rations/"+minPos+"/gamebackground.png"});data.push({name:"map",src:path+"rations/"+minPos+"/map.jpg"});data.push({name:"pause_back",src:path+"rations/"+minPos+"/pause.jpg"});data.push({name:"goat_unlocked",src:path+"rations/"+minPos+"/goat_unlocked.jpg"});data.push({name:"pig_unlocked",src:path+"rations/"+minPos+"/pig_unlocked.jpg"});data.push({name:"chicken_unlocked",src:path+"rations/"+minPos+"/chicken_unlocked.jpg"});data.push({name:"cow_unlocked",src:path+"rations/"+minPos+"/cow_unlocked.jpg"});data.push({name:"horse_unlocked",src:path+"rations/"+minPos+"/horse_unlocked.jpg"});data.push({name:"sheep_unlocked",src:path+"rations/"+minPos+"/sheep_unlocked.jpg"});data.push({name:"lvl_cleared",src:path+"lvl_cleared.png"});data.push({name:"lvl_locked",src:path+"lvl_locked.png"});data.push({name:"route",src:path+"route.png"});data.push({name:"chick",src:path+"chick.png"});data.push({name:"cow",src:path+"cow.png"});data.push({name:"goat",src:path+"goat.png"});data.push({name:"horse",src:path+"horse.png"});data.push({name:"pig",src:path+"pig.png"});data.push({name:"sheep",src:path+"sheep.png"});data.push({name:"chick_shadow",src:path+"chick_shadow.png"});data.push({name:"cow_shadow",src:path+"cow_shadow.png"});data.push({name:"goat_shadow",src:path+"goat_shadow.png"});data.push({name:"horse_shadow",src:path+"horse_shadow.png"});data.push({name:"pig_shadow",src:path+"pig_shadow.png"});data.push({name:"sheep_shadow",src:path+"sheep_shadow.png"});preloader.load(data,loadImagesEnd,Utils.showLoadProgress);}
function getStageWidth(){return Math.floor(480*screenWidthCoef);}
function getStageHeight(){return Math.floor(320*screenHeightCoef);}
function getStageWidthCenter(){return getStageWidth()/2;}
function getStageHeightCenter(){return getStageHeight()/2;}
function loadImagesEnd(data)
{document.getElementById('progress_container').style.display='none';document.getElementById('screen_container').style.display='block';document.getElementById('screen_background_container').style.display='block';bitmaps=data;mixer=new AudioMixer("music",(Utils.touchScreen?1:3));getLevelsScores();complete=levelsScores.length;if(GET["debug"]!=1)
{showSplash();}
if(parseInt(Utils.getCookie("sound"))==2||parseInt(Utils.getCookie("sound"))==1){}
else
{Utils.setCookie("sound",1);}}
function getLevelsScores()
{levelsScores=[];var s=Utils.getCookie('levels_scores_1')+"";if(s!="null")
{levelsScores=s.split(',');}}
function saveLevelsScores()
{Utils.setCookie('levels_scores_1',levelsScores.join(","));}
function getTotalLevelsScores()
{var sum=0;for(var i=0;i<levelsScores.length;i++)
{if(levelsScores[i]>=0)sum+=levelsScores[i]*1;}
return sum;}
function setBackColor(color)
{document.getElementById("screen_background_container").style.background=color;}
function createStage()
{if(stage)
{stage.destroy();stage.stop();}
stage=new Stage('screen',getStageWidth(),getStageHeight(),false);stage.delay=1000/fps;stage.onpretick=preTick;stage.onposttick=postTick;stage.ceilSizes=true;stage.showFPS=false;}
function showSplash()
{gameState=STATE_SPLASH;createScene();}
function showAbout()
{gameState=STATE_ABOUT;createScene();}
function showMenu()
{gameState=STATE_MENU;createScene();}
function showBestScore()
{gameState=STATE_BEST_SCORE;createScene();}
function showMoreGames()
{window.open(MORE_GAMES_URL);}
function showInstructions()
{gameState=STATE_INSTRUCTIONS;createScene();}
function showSelectLevel()
{gameState=STATE_SELECT_LEVEL;createScene();}
function showUnlockedLevel()
{gameState=STATE_UNLOCKED_LEVEL;createScene();}
function showGame()
{gameState=STATE_GAME;createScene();}
function setBackground(val)
{if(val===lastBackground)return;document.getElementById("screen_background_container").style.background=val;document.getElementById("screen_background_container").style.backgroundRepeat="repeat-x";lastBackground=val;}
function createScene()
{createStage();if(gameState==STATE_SPLASH)
{setBackColor("#fee002");mc=new Sprite(bitmaps.splash,480,320);mc.x=getStageWidthCenter();mc.y=getStageHeightCenter();mc.static=true;stage.addChild(mc);setTimeout(function()
{showMenu();},3000);}
else if(gameState==STATE_ABOUT)
{setBackColor("#fee002");mc=new Sprite(bitmaps.about,getStageWidth(),getStageHeight());mc.x=getStageWidthCenter();mc.y=getStageHeightCenter();mc.static=true;mc.onclick=showMenu;stage.addChild(mc);}
else if(gameState==STATE_MENU)
{setBackColor("#67B432");mc=new Sprite(bitmaps.menu,getStageWidth(),getStageHeight());mc.x=getStageWidthCenter();mc.y=getStageHeightCenter();mc.static=true;stage.addChild(mc);mc=new Sprite(bitmaps.play_btn,115,114);mc.x=getStageWidth()-70;mc.y=getStageHeight()-100;mc.static=true;mc.onclick=showInstructions;stage.addChild(mc);mc=new Sprite(bitmaps.best_score_btn,62,62);mc.x=35;mc.y=getStageHeight()-110;mc.static=true;mc.onclick=showBestScore;stage.addChild(mc);mc=new Sprite(bitmaps.more_games_btn,62,62);mc.x=35;mc.y=getStageHeight()-35;mc.static=true;mc.onclick=showMoreGames;stage.addChild(mc);mc=new Sprite(bitmaps.about_btn,63,62);mc.x=110;mc.y=getStageHeight()-35;mc.static=true;mc.onclick=showAbout;stage.addChild(mc);putSound();}
else if(gameState==STATE_BEST_SCORE)
{setBackColor("#67B432");mc=new Sprite(bitmaps.best_score,getStageWidth(),getStageHeight());mc.x=getStageWidthCenter();mc.y=getStageHeightCenter();mc.static=true;stage.addChild(mc);mc=new Sprite(bitmaps.back_btn,73,73);mc.x=getStageWidthCenter();mc.y=getStageHeightCenter()+110;mc.static=true;mc.onclick=showMenu;stage.addChild(mc);putBestScoreElements();}
else if(gameState==STATE_INSTRUCTIONS)
{setBackColor("#67B432");mc=new Sprite(bitmaps.instructions,getStageWidth(),getStageHeight());mc.x=getStageWidthCenter();mc.y=getStageHeightCenter();mc.static=true;mc.onclick=function()
{return false;}
stage.addChild(mc);mc=new Sprite(bitmaps.play_mini_btn,87,86);mc.x=getStageWidth()-50;mc.y=getStageHeight()-50;mc.static=true;mc.onclick=showSelectLevel;stage.addChild(mc);}
else if(gameState==STATE_SELECT_LEVEL)
{setBackColor("#67B432");mc=new Sprite(bitmaps.map,getStageWidth(),getStageHeight());mc.x=getStageWidthCenter();mc.y=getStageHeightCenter();mc.static=true;stage.addChild(mc);mc=new Sprite(bitmaps.play_mini_btn,87,86);mc.x=getStageWidthCenter();mc.y=getStageHeightCenter()+100;mc.static=true;mc.onclick=function()
{if(block)return false;curLevel=complete;showGame();}
stage.addChild(mc);createSelectLevelElements();}
else if(gameState==STATE_UNLOCKED_LEVEL)
{var spr;if(complete==6)spr=new Sprite(bitmaps.goat_unlocked,getStageWidth(),getStageHeight());if(complete==12)spr=new Sprite(bitmaps.pig_unlocked,getStageWidth(),getStageHeight());if(complete==18)spr=new Sprite(bitmaps.horse_unlocked,getStageWidth(),getStageHeight());if(complete==24)spr=new Sprite(bitmaps.sheep_unlocked,getStageWidth(),getStageHeight());if(complete==30)spr=new Sprite(bitmaps.chicken_unlocked,getStageWidth(),getStageHeight());spr.x=getStageWidthCenter();spr.y=getStageHeightCenter();spr.onclick=function()
{return false;};stage.addChild(spr);var spr1=new Sprite(bitmaps.play_mini_btn,87,86);spr1.x=getStageWidth()-50;spr1.y=getStageHeight()-50;spr1.onclick=function()
{animation=true;showSelectLevel();spr.destroy=true;spr1.destroy=true;return false;};stage.addChild(spr1);}
else if(gameState==STATE_GAME)
{setBackColor("#67B432");mc=new Sprite(bitmaps.gamebackground,getStageWidth(),getStageHeight());mc.x=getStageWidthCenter();mc.y=getStageHeightCenter();mc.static=true;stage.addChild(mc);mc=new Sprite(bitmaps.pause_btn,38,37);mc.x=25;mc.y=20;mc.static=true;mc.onclick=createPause;stage.addChild(mc);mc=new Sprite(bitmaps.shuffle_btn,40,40);mc.x=25;mc.y=65;mc.static=true;mc.onclick=doShuffle;stage.addChild(mc);createGameField();}
buildBackground();stage.start();}
function manageBackground()
{var c=Utils.globalScale*Utils.globalPixelScale;document.getElementById("screen_background_container").style.backgroundSize=window.innerWidth+"px "+Math.floor(320*c)+"px";}
var items=[];var cnt=0;var check_type;var token;var x1;var y1;var x2=17;var y2=22;var dz=5;var POSITIONS=[];var levelsScores;var levels=36;function putBestScoreElements()
{var best_level=new Text(bitmaps.levelnum1,17,30);best_level.align=best_level.ALIGN_LEFT;best_level.x=getStageWidthCenter()+70;best_level.y=getStageHeightCenter()+15;var best_score=new Text(bitmaps.levelnum1,17,30);best_score.align=best_score.ALIGN_LEFT;best_score.x=getStageWidthCenter()+65;best_score.y=getStageHeightCenter()+53;var best=0;if(levelsScores.length>0)
{for(var i=0;i<levelsScores.length;i++)
{if(levelsScores[i]*1>levelsScores[best]*1)
{best=i;}}
best_level.write(best+1);best_score.write(levelsScores[best]*1);}
else
{best_level.write(0);best_score.write(0);}}
var animation=false;var block=false;function createSelectLevelElements()
{var x1=30+(getStageWidth()-480)/2;var x2=85;var y1=30;var y2=50;var cow;var goat;var pig;var horse;var sheep;var chick;for(var n=0;n<levels;n++)
{var i=n%6;var j=Math.floor(n/6);var spr;var spr2;if(n<complete)
{spr=new Sprite(bitmaps.lvl_cleared,42,43);if(i<5)
{spr2=new Sprite(null,x2,2);spr2.fillColor="#154D91";spr2.n=n;spr2.x=x1+x2*i+x2/2;spr2.y=y1+y2*j;spr2.static=true;stage.addChild(spr2);}}
else
{spr=new Sprite(bitmaps.lvl_locked,22,23);}
spr.n=n;spr.x=x1+x2*i;spr.y=y1+y2*j;spr.static=true;spr.onclick=function(e)
{if(e.target.n>complete)
{return false;}
curLevel=e.target.n;gameState=STATE_GAME;createScene();return false;}
stage.addChild(spr);}
if(animation)
{complete--;block=true;}
if(complete>=6)
{cow=new Sprite(bitmaps.cow,23,18);cow.x=x1+x2*5;cow.y=y1-6;stage.addChild(cow);}
else
{cow=new Sprite(bitmaps.cow,23,18);cow.x=x1+x2*complete;cow.y=y1-6;stage.addChild(cow);}
if(complete<6)
{goat=new Sprite(bitmaps.goat_shadow,23,31);goat.x=x1;goat.y=y1+y2*1-6;stage.addChild(goat);}
else if(complete>=12)
{goat=new Sprite(bitmaps.goat,23,31);goat.x=x1+x2*5;goat.y=y1+y2*1-6;stage.addChild(goat);}
else
{goat=new Sprite(bitmaps.goat,23,31);goat.x=x1+x2*(complete%6);goat.y=y1+y2*1-6;stage.addChild(goat);}
if(complete<12)
{pig=new Sprite(bitmaps.pig_shadow,20,17);pig.x=x1;pig.y=y1+y2*2-6;stage.addChild(pig);}
else if(complete>=18)
{pig=new Sprite(bitmaps.pig,20,17);pig.x=x1+x2*5;pig.y=y1+y2*2-6;stage.addChild(pig);}
else
{pig=new Sprite(bitmaps.pig,20,17);pig.x=x1+x2*(complete%6);pig.y=y1+y2*2-6;stage.addChild(pig);}
if(complete<18)
{horse=new Sprite(bitmaps.horse_shadow,24,26);horse.x=x1;horse.y=y1+y2*3-6;stage.addChild(horse);}
else if(complete>=24)
{horse=new Sprite(bitmaps.horse,24,26);horse.x=x1+x2*5;horse.y=y1+y2*3-6;stage.addChild(horse);}
else
{horse=new Sprite(bitmaps.horse,24,26);horse.x=x1+x2*(complete%6);horse.y=y1+y2*3-6;stage.addChild(horse);}
if(complete<24)
{sheep=new Sprite(bitmaps.sheep_shadow,24,21);sheep.x=x1;sheep.y=y1+y2*4-6;stage.addChild(sheep);}
else if(complete>=30)
{sheep=new Sprite(bitmaps.sheep,24,21);sheep.x=x1+x2*5;sheep.y=y1+y2*4-6;stage.addChild(sheep);}
else
{sheep=new Sprite(bitmaps.sheep,24,21);sheep.x=x1+x2*(complete%6);sheep.y=y1+y2*4-6;stage.addChild(sheep);}
if(complete<30)
{chick=new Sprite(bitmaps.chick_shadow,19,24);chick.x=x1;chick.y=y1+y2*5-6;stage.addChild(chick);}
else if(complete>=36)
{chick=new Sprite(bitmaps.chick,19,24);chick.x=x1+x2*5;chick.y=y1+y2*5-6;stage.addChild(chick);}
else
{chick=new Sprite(bitmaps.chick,19,24);chick.x=x1+x2*(complete%6);chick.y=y1+y2*5-6;stage.addChild(chick);}
if(animation)
{if(complete<5)
{cow.moveTo(cow.x+x2,cow.y,50,Easing.linear,function()
{doExplosion(cow.x,cow.y);});}
else if((complete>=6)&&(complete<11))
{goat.moveTo(goat.x+x2,goat.y,50,Easing.linear,function()
{doExplosion(goat.x,goat.y);});}
else if((complete>=12)&&(complete<17))
{pig.moveTo(pig.x+x2,pig.y,50,Easing.linear,function()
{doExplosion(pig.x,pig.y);});}
else if((complete>=18)&&(complete<23))
{horse.moveTo(horse.x+x2,horse.y,50,Easing.linear,function()
{doExplosion(horse.x,horse.y);});}
else if((complete>=24)&&(complete<29))
{sheep.moveTo(sheep.x+x2,sheep.y,50,Easing.linear,function()
{doExplosion(sheep.x,sheep.y);});}
else if((complete>=30)&&(complete<35))
{chick.moveTo(chick.x+x2,chick.y,50,Easing.linear,function()
{doExplosion(chick.x,chick.y);});}
else
{if(complete+1==6)doExplosion(goat.x,goat.y);if(complete+1==12)doExplosion(pig.x,pig.y);if(complete+1==18)doExplosion(horse.x,horse.y);if(complete+1==24)doExplosion(sheep.x,sheep.y);if(complete+1==30)doExplosion(chick.x,chick.y);}}
return;}
var score_text;var level_text;var curLevel=0;function doExplosion(x,y)
{var spr=new Sprite(bitmaps.explosion,79,79,13);spr.x=x;spr.y=y;stage.addChild(spr);spr.onenterframe=function(en)
{if(en.target.currentFrame==12)
{en.target.stop();en.target.destroy=true;complete++;animation=false;block=false;showSelectLevel();}}}
function createGameField()
{score=0;clearPositions();POSITIONS=ELEMENTS[curLevel];var depth=POSITIONS.length;var w=POSITIONS[0][0].length;var h=POSITIONS[0].length;x1=getStageWidthCenter()-w*x2/2+20;y1=getStageHeightCenter()-h*y2/2+25;var cnt=0;for(var z=0;z<depth;z++)
{for(var y=0;y<h;y++)
{for(var x=0;x<w;x++)
{if(POSITIONS[z][y][x]*1!=0)
{var xx=x;var yy=y;var zz=z;cnt++;}}}}
if(cnt%2!=0)
{POSITIONS[zz][yy][xx]=0;cnt--;}
setRandomElements(cnt);var cnt=0;for(var z=0;z<depth;z++)
{items.push([]);for(var y=0;y<h;y++)
{items[z].push([]);for(var x=0;x<w;x++)
{if(POSITIONS[z][y][x]*1!=0)
{var el=temp_arr[cnt]*1;putRandomElements(x,y,z,el,true);cnt++;}
else
{items[z][y].push(0);}}}}
var dx=(screenWidthRatioPos==5)?10:0;time=TIMERS[curLevel]*60;score_text=new Text(bitmaps.levelnum1,17,30);score_text.align=score_text.ALIGN_LEFT;score_text.x=getStageWidthCenter()+40;score_text.y=17;score_text.write(score);level_text=new Text(bitmaps.levelnum1,17,30);level_text.align=level_text.ALIGN_LEFT;level_text.x=getStageWidthCenter()-100;level_text.y=17;level_text.write(curLevel+1);minutes=Math.floor(time/60);seconds=time-minutes*60;if(seconds<10)seconds="0"+seconds;timer_text_minute=new Text(bitmaps.levelnum1,17,30);timer_text_minute.align=timer_text_minute.ALIGN_LEFT;timer_text_minute.x=getStageWidthCenter()+190+5+dx;timer_text_minute.y=20;timer_text_minute.write(minutes);var spr=new Sprite(bitmaps.text_elem_3,5,13);spr.x=getStageWidthCenter()+200+5+dx;spr.y=17;stage.addChild(spr);timer_text_seconds=new Text(bitmaps.levelnum1,17,30);timer_text_seconds.align=timer_text_seconds.ALIGN_LEFT;timer_text_seconds.x=getStageWidthCenter()+210+5+dx;timer_text_seconds.y=20;timer_text_seconds.write(seconds);startTimer();}
var temp_arr=[];var timer_text;var time;var TIMER_INTERVAL;var minutes;var seconds;function startTimer()
{TIMER_INTERVAL=setInterval(function()
{time--;minutes=Math.floor(time/60);seconds=time-minutes*60;if(seconds<10)seconds="0"+seconds;timer_text_minute.write(minutes);timer_text_seconds.write(seconds);if(time<0)
{showPopup(1);clearInterval(TIMER_INTERVAL);}},1000);}
function clearPositions()
{for(var i=0;i<POSITIONS.length;i++)
{POSITIONS[i].destroy=true;}
POSITIONS=[];for(var i=0;i<items.length;i++)
{items[i].destroy=true;}
items=[];}
function doShuffle()
{for(var i=0;i<stage.objects.length;i++)
{stage.objects[i].check=false;}
if(token)token.destroy=true;check_type=null;var temp_arr2=[];var cnt=0;var width=items[0][0].length;var height=items[0].length;var depth=items.length;for(var z=0;z<depth;z++)
{for(var y=0;y<height;y++)
{for(var x=0;x<width;x++)
{if(items[z][y][x]*1!=0)
{var obj={x:x,y:y,z:z,type:items[z][y][x].type}
temp_arr2.push(obj);cnt++;items[z][y][x].destroy=true;items[z][y][x]=1;}}}}
setRandomShuffleElements(temp_arr2);var cnt=0;for(var z=0;z<depth;z++)
{for(var y=0;y<height;y++)
{for(var x=0;x<width;x++)
{if(items[z][y][x]*1!=0)
{var el=temp_arr[cnt].type*1;var x1=temp_arr[cnt].x;var y1=temp_arr[cnt].y;var z1=temp_arr[cnt].z;putRandomElements(x,y,z,el);cnt++;}}}}}
function setRandomShuffleElements(arr)
{if(temp_arr.length>0)
{for(var i=0;i<temp_arr.length;i++)
{temp_arr[i].destroy=true;}
temp_arr=[];}
for(var i=0;i<arr.length;i++)
{temp_arr.push(0);}
n=0;while(n!=arr.length)
{i=Math.floor((Math.random()*arr.length));if(arr[i]!=0)
{temp_arr[n]=arr[i];n++;arr[i]=0;}}}
function setRandomElements(length)
{if(temp_arr.length>0)
{for(var i=0;i<temp_arr.length;i++)
{temp_arr[i].destroy=true;}
temp_arr=[];}
for(var i=0;i<length;i++)
{temp_arr.push(0);}
for(var i=0;i<length/2;i++)
{var elem=Math.floor(Math.random()*28);var n=2;while(n>0)
{var pos=Math.floor(Math.random()*length)
if(temp_arr[pos]==0)
{temp_arr[pos]=elem+1;n--;}}}}
function putRandomElements(x,y,z,el,start)
{var spr=new Sprite(bitmaps["elem"+el],42,53);spr.x=x1+x2*x+dz*z;spr.y=y1+y2*y-dz*z;spr.zIndex=100+10*z+y-x;spr.type=el;spr.check=false;spr.x1=x;spr.y1=y;spr.z1=z;spr.onclick=clickOnElement;stage.addChild(spr);if(start)
{items[z][y].push(spr);}
else
{items[z][y][x]=spr;}}
function clickOnElement(e)
{var x=e.target.x1;var y=e.target.y1;var z=e.target.z1;if(canBeRemoved(x,y,z))
{if(e.target.check)
{if(token)token.destroy=true;e.target.check=false;check_type=null;}
else
{if(e.target.type==check_type)
{e.target.check=true;if(token)token.destroy=true;destroyCheckedElements(x,y,z);check_type=null;}
else
{for(var i=0;i<stage.objects.length;i++)
{stage.objects[i].check=false;}
e.target.check=true;if(token)token.destroy=true;token=new Sprite(bitmaps.select,37,48);token.x=e.target.x+dz;token.y=e.target.y-dz;token.zIndex=e.target.zIndex;stage.addChild(token);check_type=e.target.type;}}}
else
{}
return false;}
function createPause()
{clearInterval(TIMER_INTERVAL);var pause1=new Sprite(bitmaps.pause_back,getStageWidth(),getStageHeight());pause1.x=getStageWidthCenter();pause1.y=getStageHeightCenter();pause1.onclick=function(){return false};stage.addChild(pause1);var pause2=new Sprite(bitmaps.play_btn,115,114);pause2.x=getStageWidthCenter();pause2.y=getStageHeightCenter()+15;pause2.onclick=function()
{startTimer();pause1.destroy=true;pause2.destroy=true;pause3.destroy=true;pause4.destroy=true;pause5.destroy=true;sound_button.destroy=true;};stage.addChild(pause2);var pause3=new Sprite(bitmaps.back_btn,73,73);pause3.x=getStageWidthCenter()-110;pause3.y=getStageHeightCenter()+15;pause3.onclick=function()
{startTimer();pause1.destroy=true;pause2.destroy=true;pause3.destroy=true;pause4.destroy=true;pause5.destroy=true;sound_button.destroy=true;};stage.addChild(pause3);var pause4=new Sprite(bitmaps.replay_btn,73,73);pause4.x=getStageWidthCenter()+110;pause4.y=getStageHeightCenter()+15;pause4.onclick=function()
{clearInterval(TIMER_INTERVAL);showGame();}
stage.addChild(pause4);var pause5=new Sprite(bitmaps.select_lvl_btn,73,73);pause5.x=getStageWidthCenter();pause5.y=getStageHeightCenter()+100+15;pause5.onclick=function()
{clearInterval(TIMER_INTERVAL);showSelectLevel();}
stage.addChild(pause5);putSound();}
function canBeRemoved(x,y,z)
{if(z+1<items.length)
{for(var i=-1;i<2;i++)
{for(var j=-1;j<2;j++)
{if(((y+j)>=0)&&((y+j)<items[0].length)&&((x+i)>=0)&&((x+i)<items[0][0].length))
{if(items[z+1][y+j][x+i])return false;}}}}
var c=0;for(var i=-1;i<2;i++)
{if(((y+i)>=0)&&((y+i)<items[0].length)&&((x+2)<items[0][0].length))
{if(items[z][y+i][x+2])
{c++;break;}}}
for(var i=-1;i<2;i++)
{if(((y+i)>=0)&&((y+i)<items[0].length)&&((x-2)>=0))
{if(items[z][y+i][x-2])
{c++;break;}}}
if(c==2)return false;return true;}
function destroyCheckedElements()
{for(var i=0;i<stage.objects.length;i++)
{if(stage.objects[i].check)
{var x=stage.objects[i].x1;var y=stage.objects[i].y1;var z=stage.objects[i].z1;var spr=new Sprite(bitmaps.explosion,79,79,13);spr.x=stage.objects[i].x+dz;spr.y=stage.objects[i].y-dz;stage.addChild(spr);spr.onenterframe=function(en)
{if(en.target.currentFrame==12)
{en.target.stop();en.target.destroy=true;}}
var spr1=new Sprite(bitmaps.p50,30,13);spr1.x=stage.objects[i].x;spr1.y=stage.objects[i].y-5;stage.addChild(spr1);spr1.moveBy(0,-5,10,20,function(e)
{score+=50;e.target.obj.destroy=true;score_text.write(score);},null);stage.objects[i].destroy=true;items[z][y][x]=0;checkWinner();}}}
function checkWinner()
{var cnt=0;for(var z=0;z<items.length;z++)
{for(var y=0;y<items[0].length;y++)
{for(var x=0;x<items[0][0].length;x++)
{if(items[z][y][x]*1!=0)cnt++;}}}
if(cnt==0)
{clearInterval(TIMER_INTERVAL);setTimeout(function()
{showPopup(2);},1000);}
else
{return false;}}
function showPopup(type)
{if(type==1)
{console.log("проигрышь")
var spr=new Sprite(bitmaps.game_over,getStageWidth(),getStageHeight());spr.x=getStageWidthCenter();spr.y=getStageHeightCenter();spr.onclick=function(){return false};stage.addChild(spr);var spr=new Sprite(bitmaps.back_btn,73,73);spr.x=getStageWidthCenter()-60;spr.y=getStageHeightCenter()+75;spr.onclick=function()
{showSelectLevel();return false;};stage.addChild(spr);var spr=new Sprite(bitmaps.replay_btn,73,73);spr.x=getStageWidthCenter()+60;spr.y=getStageHeightCenter()+75;spr.onclick=function()
{showGame();return false;};stage.addChild(spr);var level_text=new Text(bitmaps.levelnum1,17,30);level_text.align=level_text.ALIGN_LEFT;level_text.x=getStageWidthCenter()+50;level_text.y=getStageHeightCenter()-17;level_text.write(curLevel+1);var total_score__text=new Text(bitmaps.levelnum1,17,30);total_score__text.align=total_score__text.ALIGN_LEFT;total_score__text.x=getStageWidthCenter()+65;total_score__text.y=getStageHeightCenter()+22;total_score__text.write(getTotalLevelsScores());}
else
{var totalscore=time*100+score;if((levelsScores[curLevel])&&(totalscore>levelsScores[curLevel]))
{levelsScores[curLevel]=totalscore;saveLevelsScores();}
else if((levelsScores[curLevel])&&(totalscore<=levelsScores[curLevel]))
{}
else
{levelsScores.push(totalscore);saveLevelsScores();}
var spr=new Sprite(bitmaps.level_cleared,getStageWidth(),getStageHeight());spr.x=getStageWidthCenter();spr.y=getStageHeightCenter();spr.onclick=function()
{return false;};stage.addChild(spr);var level_text=new Text(bitmaps.levelnum1,17,30);level_text.align=level_text.ALIGN_LEFT;level_text.x=getStageWidthCenter()+40;level_text.y=getStageHeightCenter()-38;level_text.write(curLevel+1);var minutes_text=new Text(bitmaps.levelnum1,17,30);minutes_text.align=minutes_text.ALIGN_LEFT;minutes_text.x=getStageWidthCenter()-90;minutes_text.y=getStageHeightCenter();minutes_text.write(minutes);var spr=new Sprite(bitmaps.text_elem_3,5,13);spr.x=getStageWidthCenter()-80;spr.y=getStageHeightCenter();stage.addChild(spr);var seconds_text=new Text(bitmaps.levelnum1,17,30);seconds_text.align=seconds_text.ALIGN_LEFT;seconds_text.x=getStageWidthCenter()-65;seconds_text.y=getStageHeightCenter();seconds_text.write(seconds);var spr=new Sprite(bitmaps.text_elem_1,15,21);spr.x=getStageWidthCenter()-30;spr.y=getStageHeightCenter();stage.addChild(spr);var text_100=new Text(bitmaps.levelnum1,17,30);text_100.align=text_100.ALIGN_LEFT;text_100.x=getStageWidthCenter()-10;text_100.y=getStageHeightCenter();text_100.write(100);var spr=new Sprite(bitmaps.text_elem_2,15,21);spr.x=getStageWidthCenter()+45;spr.y=getStageHeightCenter();stage.addChild(spr);var time_score_text=new Text(bitmaps.levelnum1,17,30);time_score_text.align=time_score_text.ALIGN_LEFT;time_score_text.x=getStageWidthCenter()+65;time_score_text.y=getStageHeightCenter();time_score_text.write(time*100);var total_score_text=new Text(bitmaps.levelnum1,17,30);total_score_text.align=total_score_text.ALIGN_LEFT;total_score_text.x=getStageWidthCenter()+60;total_score_text.y=getStageHeightCenter()+40;total_score_text.write(getTotalLevelsScores());if(curLevel!=35)
{var spr=new Sprite(bitmaps.play_mini_btn,87,86);spr.x=getStageWidth()-50;spr.y=getStageHeight()-50;spr.onclick=function()
{if(curLevel==complete)
{showSecondPopup();}
else
{curLevel++;showGame();}
return false;}
stage.addChild(spr);}
else
{var spr=new Sprite(bitmaps.select_lvl_btn,73,73);spr.x=getStageWidth()-50;spr.y=getStageHeight()-50;spr.onclick=function()
{animation=false;showSelectLevel();return false;};stage.addChild(spr);}
if(curLevel==complete)
{curLevel++;complete++;}}}
var sound;var sound_button;function showSecondPopup()
{if(complete==6||complete==12||complete==18||complete==24||complete==30)
{showUnlockedLevel();return;}
if(curLevel==complete)
{animation=true;showSelectLevel();}
else
{console.log("animation false")
animation=false;showSelectLevel();}
return false;}
function putSound()
{sound_button=new Sprite(bitmaps.sound_btn,49,49,2);sound_button.x=30;sound_button.y=30;sound_button.gotoAndStop(0);stage.addChild(sound_button);if(parseInt(Utils.getCookie("sound"))==1&&!sound)
{sound_button.gotoAndStop(0);sound=true;mixer.play("track",true,false,0);}
else if(parseInt(Utils.getCookie("sound"))==2)
{sound_button.gotoAndStop(1);sound=false;mixer.stop(0);Utils.setCookie("sound",2);}
sound_button.onclick=function(e)
{if(sound)
{e.target.gotoAndStop(1);Utils.setCookie("sound",2);sound=false;mixer.stop(0);}
else
{e.target.gotoAndStop(0);Utils.setCookie("sound",1);sound=true;mixer.play("track",true,false,0);}}}
function Text(font,width,height)
{this.ALIGN_LEFT=0;this.ALIGN_RIGHT=1;this.ALIGN_CENTER=2;this.font=font;this.x=0;this.y=0;this.width=width;this.height=height;this.align=this.ALIGN_LEFT;this.rotation=0;this.static=false;this.charMap=['0','1','2','3','4','5','6','7','8','9'];this.sprites=[];this.manageSprites=function(text)
{var i,char;var len=text.length;var sp_len=this.sprites.length;if(sp_len<len)
{for(i=0;i<len-sp_len;i++)
{char=new Sprite(this.font,this.width,this.height,this.charMap.length);this.sprites.push(char);stage.addChild(char);}}
if(sp_len>len)
{for(i=0;i<sp_len-len;i++)stage.removeChild(this.sprites[i]);this.sprites.splice(0,sp_len-len);}}
this.write=function(text)
{var curX,curY,p,p2,n;text=text+"";this.manageSprites(text);curX=this.x;curY=this.y;if(this.align==this.ALIGN_CENTER)curX=this.x-(text.length-1)/2*this.width;if(this.align==this.ALIGN_RIGHT)curX=this.x-(text.length-1)*this.width;p=new Vector(curX-this.x,0);p.rotate(-this.rotation);curX=p.x+this.x;curY=p.y+this.y;p=new Vector(0,0);for(var i=0;i<text.length;i++)
{this.sprites[i].visible=true;n=this.charMap.indexOf(text.substr(i,1));if(n<0)this.sprites[i].visible=false;else
{this.sprites[i].gotoAndStop(n);p2=p.clone();p2.rotate(-this.rotation);this.sprites[i].x=p2.x+curX;this.sprites[i].y=p2.y+curY;this.sprites[i].rotation=this.rotation;this.sprites[i].static=this.static;p.x+=this.width;}}}
this.moveTo=function(value,duration)
{for(var i=0;i<this.sprites.length;i++)
{this.sprites[i].moveTo(this.sprites[i].x,value,duration,null,function(e)
{count=0;},null);}}}
function buildBackground()
{stage.drawScene(document.getElementById("screen_background"),true);}
function preTick()
{}
function postTick()
{};var Loader={endCallback:null,loadedData:null,landscapeMode:false,create:function(callback,landscape)
{Loader.endCallback=callback;Loader.landscapeMode=landscape;var c=document.getElementById("progress_container");c.style.zIndex="1000";c=document.getElementById("progress");var img=document.createElement('img');img.src='images/'+Utils.globalScale+'/splash.png';img.id='loader_splash';c.appendChild(img);document.getElementById("screen_background_container").style.background="#ffffff";},progressVal:0,showLoadProgress:function(val)
{Loader.progressVal=val;},loadComplete:function(data)
{Loader.showLoadProgress(100);Loader.loadedData=data;},close:function()
{Loader.endCallback(Loader.loadedData);if(Utils.touchScreen)document.body.addEventListener("touchstart",Utils.preventEvent,false);var c=document.getElementById("progress_container");c.style.display='none';}};;