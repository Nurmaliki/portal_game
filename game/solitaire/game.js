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
var style=document.createElement('style');style.type="text/css";style.innerHTML='@font-face {font-family: "'+name+'"; src: url("'+url+'");}';document.getElementsByTagName('head')[0].appendChild(style);}};function SimpleText(font,width,height)
{this.ALIGN_LEFT=0;this.ALIGN_RIGHT=1;this.ALIGN_CENTER=2;this.font=font;this.x=0;this.y=0;this.width=width;this.height=height;this.align=this.ALIGN_LEFT;this.rotation=0;this.charSpacing=0;this.static=false;this.charMap=['0','1','2','3','4','5','6','7','8','9'];this.sprites=[];this.text="";this.manageSprites=function(text)
{var i,char;var len=text.length;var sp_len=this.sprites.length;if(sp_len<len)
{for(i=0;i<len-sp_len;i++)
{char=new Sprite(this.font,this.width,this.height,this.charMap.length);this.sprites.push(char);stage.addChild(char);}}
if(sp_len>len)
{for(i=0;i<sp_len-len;i++)stage.removeChild(this.sprites[i]);this.sprites.splice(0,sp_len-len);}}
this.write=function(text)
{var curX,curY,p,p2,n;text=text+"";this.text=text;this.manageSprites(text);curX=this.x;curY=this.y;if(this.align==this.ALIGN_CENTER)curX=this.x-(text.length-1)/2*(this.width+this.charSpacing);if(this.align==this.ALIGN_RIGHT)curX=this.x-(text.length-1)*(this.width+this.charSpacing);p=new Vector(curX-this.x,0);p.rotate(-this.rotation);curX=p.x+this.x;curY=p.y+this.y;p=new Vector(0,0);for(var i=0;i<text.length;i++)
{this.sprites[i].visible=true;n=this.charMap.indexOf(text.substr(i,1));if(n<0)this.sprites[i].visible=false;else
{this.sprites[i].gotoAndStop(n);p2=p.clone();p2.rotate(-this.rotation);this.sprites[i].x=p2.x+curX;this.sprites[i].y=p2.y+curY;this.sprites[i].rotation=this.rotation;this.sprites[i].static=this.static;p.x+=this.width+this.charSpacing;}}}};var waContext;function AudioPlayer()
{var self=this;this.disabled=false;this.basePath="";this.mp3Support=true;this.webAudioSupport=false;this.delayPlay=false;this.audioWrapper=null;this.locked=false;this.busy=false;this.startPlayTime=0;this.onend=null;this.createNewAudio=function()
{if(this.webAudioSupport)
{var sound=waContext.createBufferSource();sound.connect(waContext.destination);return sound;}
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
{waContext.decodeAudioData(this.response,function(buffer)
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
{waContext=new webkitAudioContext();var buffer=waContext.createBuffer(1,1,22050);sound=waContext.createBufferSource();sound.buffer=buffer;sound.connect(waContext.destination);sound.noteOn(0);}
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
AudioMixer.buffer={};;;var ADManager={containerId:"advert",frameId:"advert_frame",showTimer:null,init:function()
{var c=document.createElement("div");c.setAttribute("id",ADManager.containerId);c.setAttribute("align","center");c.setAttribute("style","display: none; position: absolute; left: 0px; top: 0px; z-index: 10000; width: 100%;");document.body.appendChild(c);},createFrame:function()
{var f=document.createElement("iframe");f.setAttribute("id",ADManager.frameId);f.setAttribute("src","");f.setAttribute("frameborder","0");f.setAttribute("width","320");f.setAttribute("height","50");f.setAttribute("scrolling","no");f.setAttribute("style","overflow: none");ADManager.getContainer().appendChild(f);},destroyFrame:function()
{var container=ADManager.getContainer();var frame=ADManager.getFrame();if(container&&frame)container.removeChild(frame);},getContainer:function()
{return document.getElementById(ADManager.containerId);},getFrame:function()
{return document.getElementById(ADManager.frameId);},show:function(type)
{clearTimeout(ADManager.showTimer);var config=adConfig[type];if(config)
{ADManager.destroyFrame();ADManager.createFrame();var frame=ADManager.getFrame();frame.setAttribute("src",config.url);frame.setAttribute("width",config.width);frame.setAttribute("height",config.height);var container=ADManager.getContainer();container.style.height=config.height+"px";container.style.display="block";if(typeof config.timeout=="number")
{if(config.timeout>0)ADManager.showTimer=setTimeout(ADManager.hide,config.timeout);}
else
{if(typeof config.timerPosition=="undefined")config.timerPosition=-1;config.timerPosition++;if(config.timerPosition>=config.timeout.length)config.timerPosition=0;if(config.timeout[config.timerPosition].show)
{ADManager.showTimer=setTimeout(function(){ADManager.show(type)},config.timeout[config.timerPosition].show);}
if(config.timeout[config.timerPosition].pause)
{ADManager.destroyFrame();ADManager.showTimer=setTimeout(function(){ADManager.show(type)},config.timeout[config.timerPosition].pause);}
if(config.timeout[config.timerPosition].end)ADManager.hide();}}
else ADManager.hide();setTimeout(Utils.mobileHideAddressBar,1000);},hide:function()
{ADManager.destroyFrame();ADManager.getContainer().style.display="none";}};;;;;;var stage;var needToBuildBackground=false;var world;var mc;var fps=50;var bitmaps={};var GET;var data=[];var LANDSCAPE_MODE=true;var STATE_LOAD=0;var STATE_SPLASH=1;var STATE_COVER=2;var STATE_MENU=3;var STATE_INSTRUCTION=4;var STATE_GAME=5;var STATE_FINISHED=6;var STATE_LEADER=7;var STATE_ABOUT=8;var STATE_PAUSE=9;var PROCESS_START=1;var PROCESS_GAME=0;var gameState=STATE_LOAD;var processState=PROCESS_START;var startGameScore=250000;var gameScore;var maxGameScore=0;var gameEnd=false;var startGameTime=0;var stopGameTime=0;var generalGameTime=0;var minGameTime=0;var library;var cardSuit={HEARTS:1,DIAMONDS:2,CLUBS:3,SPADES:4};var suitAndSlotsRelation=[4,2,1,3];var cardValue={ACE:1,TWO:2,THREE:3,FOUR:4,FIVE:5,SIX:6,SEVEN:7,EIGHT:8,NINE:9,TEN:10,JACK:11,QUEEN:12,KING:13};var cardColor={RED:0,BLACK:1};var deckOffset=0;var deck=new Array(52);var slots=new Array(4);var stock=new Array(24);var columns=new Array(7);var pile=[];var placeCard={DECK:0,COLUMNS:1,SLOTS:2};var coordColumns=[{x:-206,y:140},{x:-139,y:140},{x:-72,y:140},{x:-4,y:140},{x:65,y:140},{x:132,y:140},{x:202,y:140}];var faceCardColumnsOffset=17;var coordSlot=[{x:-4,y:45},{x:65,y:45},{x:132,y:45},{x:202,y:45}];var startCoordDeck={x:-139,y:45};var startCoordDeckCard={x:-72,y:45};var levelDifficultyCountCard={EASY:1,HARD:3};var levelDifficulty;var stepDeckOffset;var dblclick_flag=0;var pause_flag=false;var build_flag=[];var timerText=null;var timer=0;var mixer;var sound=false;var gameTimer=0;var H=0;var M=0;var S=0;var minH=0;var minM=0;var minS=0;var dragElement={};var arrayDragCards=[];var oldPositionDragCard=[];var startUid;var gNumber=0;var coorFirstDragCard={};;;window.onload=function()
{GET=Utils.parseGet();Utils.addMobileListeners(LANDSCAPE_MODE);Utils.mobileCorrectPixelRatio();Utils.addFitLayoutListeners();setTimeout(startLoad,600);};function startLoad()
{var resolution=Utils.getMobileScreenResolution(LANDSCAPE_MODE);if(GET["debug"]==1){resolution=Utils.getScaleScreenResolution(1,LANDSCAPE_MODE);}
Utils.globalScale=resolution.scale;var ratioCoefs=[1.5,1.6,1.66,1.7,1.78];var ratioWidth=[1,1.0666,1.106,1.133,1.187];var coef;if(window.innerWidth>window.innerHeight){coef=window.innerWidth/window.innerHeight;}
else{coef=window.innerHeight/window.innerWidth;}
var min=100000,minPos=-1,diff;for(var i=0;i<ratioCoefs.length;i++){diff=Math.abs(coef-ratioCoefs[i]);if(diff<min){min=diff;minPos=i;}}
screenWidthCoef=ratioWidth[minPos];screenWidthRatioPos=minPos;resolution.width=Math.round(resolution.width*screenWidthCoef);Utils.createLayout(document.getElementById("main_container"),resolution);Utils.addEventListener("fitlayout",function()
{if(stage)
{buildForeground();buildBackground();}});Utils.addEventListener("lockscreen",function(){if(stage&&stage.started)
{stage.stop();}});Utils.addEventListener("unlockscreen",function(){if(stage&&!stage.started)
{stage.start();}});Utils.fitLayoutToScreen();Utils.mobileHideAddressBar();mixer=new AudioMixer("music",1);if(GET["debug"]!=1){Utils.checkOrientation(LANDSCAPE_MODE);}
var path="rations/"+minPos+"/";var assets=[{"name":"3-1","src":"cards/Clubs/3-1.png","width":66,"height":88},{"name":"3-10","src":"cards/Clubs/3-10.png","width":66,"height":88},{"name":"3-11","src":"cards/Clubs/3-11.png","width":66,"height":88},{"name":"3-12","src":"cards/Clubs/3-12.png","width":66,"height":88},{"name":"3-13","src":"cards/Clubs/3-13.png","width":66,"height":88},{"name":"3-2","src":"cards/Clubs/3-2.png","width":66,"height":88},{"name":"3-3","src":"cards/Clubs/3-3.png","width":66,"height":88},{"name":"3-4","src":"cards/Clubs/3-4.png","width":66,"height":88},{"name":"3-5","src":"cards/Clubs/3-5.png","width":66,"height":88},{"name":"3-6","src":"cards/Clubs/3-6.png","width":66,"height":88},{"name":"3-7","src":"cards/Clubs/3-7.png","width":66,"height":88},{"name":"3-8","src":"cards/Clubs/3-8.png","width":66,"height":88},{"name":"3-9","src":"cards/Clubs/3-9.png","width":66,"height":88},{"name":"2-1","src":"cards/Diamonds/2-1.png","width":66,"height":88},{"name":"2-10","src":"cards/Diamonds/2-10.png","width":66,"height":88},{"name":"2-11","src":"cards/Diamonds/2-11.png","width":66,"height":88},{"name":"2-12","src":"cards/Diamonds/2-12.png","width":66,"height":88},{"name":"2-13","src":"cards/Diamonds/2-13.png","width":66,"height":88},{"name":"2-2","src":"cards/Diamonds/2-2.png","width":66,"height":88},{"name":"2-3","src":"cards/Diamonds/2-3.png","width":66,"height":88},{"name":"2-4","src":"cards/Diamonds/2-4.png","width":66,"height":88},{"name":"2-5","src":"cards/Diamonds/2-5.png","width":66,"height":88},{"name":"2-6","src":"cards/Diamonds/2-6.png","width":66,"height":88},{"name":"2-7","src":"cards/Diamonds/2-7.png","width":66,"height":88},{"name":"2-8","src":"cards/Diamonds/2-8.png","width":66,"height":88},{"name":"2-9","src":"cards/Diamonds/2-9.png","width":66,"height":88},{"name":"1-1","src":"cards/Hearts/1-1.png","width":66,"height":88},{"name":"1-10","src":"cards/Hearts/1-10.png","width":66,"height":88},{"name":"1-11","src":"cards/Hearts/1-11.png","width":66,"height":88},{"name":"1-12","src":"cards/Hearts/1-12.png","width":66,"height":88},{"name":"1-13","src":"cards/Hearts/1-13.png","width":66,"height":88},{"name":"1-2","src":"cards/Hearts/1-2.png","width":66,"height":88},{"name":"1-3","src":"cards/Hearts/1-3.png","width":66,"height":88},{"name":"1-4","src":"cards/Hearts/1-4.png","width":66,"height":88},{"name":"1-5","src":"cards/Hearts/1-5.png","width":66,"height":88},{"name":"1-6","src":"cards/Hearts/1-6.png","width":66,"height":88},{"name":"1-7","src":"cards/Hearts/1-7.png","width":66,"height":88},{"name":"1-8","src":"cards/Hearts/1-8.png","width":66,"height":88},{"name":"1-9","src":"cards/Hearts/1-9.png","width":66,"height":88},{"name":"4-1","src":"cards/Spades/4-1.png","width":66,"height":88},{"name":"4-10","src":"cards/Spades/4-10.png","width":66,"height":88},{"name":"4-11","src":"cards/Spades/4-11.png","width":66,"height":88},{"name":"4-12","src":"cards/Spades/4-12.png","width":66,"height":88},{"name":"4-13","src":"cards/Spades/4-13.png","width":66,"height":88},{"name":"4-2","src":"cards/Spades/4-2.png","width":66,"height":88},{"name":"4-3","src":"cards/Spades/4-3.png","width":66,"height":88},{"name":"4-4","src":"cards/Spades/4-4.png","width":66,"height":88},{"name":"4-5","src":"cards/Spades/4-5.png","width":66,"height":88},{"name":"4-6","src":"cards/Spades/4-6.png","width":66,"height":88},{"name":"4-7","src":"cards/Spades/4-7.png","width":66,"height":88},{"name":"4-8","src":"cards/Spades/4-8.png","width":66,"height":88},{"name":"4-9","src":"cards/Spades/4-9.png","width":66,"height":88},{"name":"about","src":"about.jpg","width":480,"height":320},{"name":"back-card","src":"back-card.png","width":66,"height":89},{"name":"best-score-btn","src":"menu/best-score-btn.png","width":69,"height":69},{"name":"info-btn","src":"menu/info-btn.png","width":69,"height":69},{"name":"play-btn","src":"menu/play-btn.png","width":113,"height":112},{"name":"sound-off-btn","src":"menu/sound-off-btn.png","width":53,"height":53},{"name":"sound-on-btn","src":"menu/sound-on-btn.png","width":53,"height":53},{"name":"num","src":"num.png","width":10,"height":198},{"name":"back-btn","src":"pause/back-btn.png","width":67,"height":67},{"name":"play-2-btn","src":"pause/play-2-btn.png","width":67,"height":67},{"name":"replay-btn","src":"pause/replay-btn.png","width":67,"height":67},{"name":"pause-btn","src":"pause-btn.png","width":37,"height":37},{"name":"splash","src":"splash.png","width":480,"height":320},{"name":"best-score","src":path+"best-score.png"},{"name":"cover","src":path+"cover.png"},{"name":"finished","src":path+"finished.png"},{"name":"game-area","src":path+"game-area.jpg"},{"name":"instructions","src":path+"instructions.png"},{"name":"menu","src":path+"menu.jpg"},{"name":"pause","src":path+"pause.png"}];library=new AssetsLibrary('images',Utils.globalScale,assets);library.load(loadImagesEnd,Utils.showLoadProgress);}
function loadImagesEnd()
{document.getElementById('progress_container').style.display='none';document.getElementById('screen_container').style.display='block';document.getElementById('screen_background_container').style.display='block';if(GET["debug"]!=1)
{prepareGame();}}
function createStage()
{if(stage){stage.destroy();stage.stop();}
stage=new Stage('screen',Math.round(480*screenWidthCoef),320);stage.delay=1000/fps;stage.onpretick=preTick;stage.onposttick=postTick;stage.ceilSizes=true;stage.showFPS=false;}
function getStageWidth()
{return Math.floor(480*screenWidthCoef);}
function getStageCenter()
{return getStageWidth()/2;}
function createScene()
{createStage();setBackColor('#004e00');if(gameState==STATE_SPLASH)
{setBackColor('#fee002');showSplash();}
if(gameState==STATE_COVER)
{showCover();}
if(gameState==STATE_MENU)
{showMenu();}
if(gameState==STATE_INSTRUCTION)
{showInstruction();}
if(gameState==STATE_GAME)
{if(processState==PROCESS_START){eraseGameArrays();launchGame();}
else{startTimer();}}
if(gameState==STATE_FINISHED)
{getPlayerScore();showFinished();setPlayerScore();resetScoreAndTime();}
if(gameState==STATE_LEADER)
{getPlayerScore();showHighscores();}
if(gameState==STATE_ABOUT)
{setBackColor('#fee002');showAbout();}
if(gameState==STATE_PAUSE)
{showPause();}
buildBackground();stage.start();}
function setMouseoutOnScreenWrapper()
{document.body.setAttribute('tabindex',1);document.body.onblur=eventStopDrag;document.body.onmouseout=eventStopDrag;}
function eventStopDrag()
{if(Object.keys(dragElement).length>0){stopDrag(dragElement);}}
function buildBackground()
{stage.drawScene(document.getElementById("screen_background"),true);}
function buildForeground()
{stage.drawScene(document.getElementById("screen"),false);}
function setBackColor(color)
{document.body.style.background=color;}
function showHighscores()
{mc=library.getSprite('best-score');mc.x=getStageCenter();mc.y=160;mc.static=true;stage.addChild(mc);mc=library.getSprite('back-btn');mc.x=getStageCenter();mc.y=280;mc.static=true;mc.onclick=function()
{gameState=STATE_MENU;createScene();};stage.addChild(mc);var sec=(minS<10?'0'+minS:minS);var min=(minM<10?'0'+minM:minM);var text=new SimpleText(library.getBitmap('num'),10,18);text.x=getStageCenter()+95;text.y=178;text.charMap=['0','1','2','3','4','5','6','7','8','9',':'];text.align=TEXT_ALIGN_LEFT;text.charSpacing=1;text.write(min+":"+sec);var text=new SimpleText(library.getBitmap('num'),10,18);text.x=getStageCenter()+95;text.y=217;text.charMap=['0','1','2','3','4','5','6','7','8','9',':'];text.align=TEXT_ALIGN_LEFT;text.charSpacing=1;text.write(maxGameScore);}
function preTick()
{if(needToBuildBackground)
{buildBackground();needToBuildBackground=false;}}
function postTick()
{for(var i=0;i<stage.objects.length;i++){if(stage.objects[i].drag){stage.drawRectangle(stage.objects[i].x,stage.objects[i].y,70,92,'red');}}}
function prepareGame()
{if((parseInt(Utils.getCookie("sound"))==2)||(parseInt(Utils.getCookie("sound"))==1)){}
else{Utils.setCookie("sound",1);}
if(parseInt(Utils.getCookie("sound"))==1){sound=true;}
else if(parseInt(Utils.getCookie("sound"))==2){sound=false;}
getPlayerScore();gameState=STATE_SPLASH;createScene();}
function showSplash()
{var spr=library.getSprite("splash",getStageWidth(),320);spr.x=getStageCenter();spr.y=160;spr.static=true;stage.addChild(spr);setTimeout(function()
{gameState=STATE_COVER;createScene();},3000);}
function showCover()
{var spr=library.getSprite("cover",getStageWidth(),320);spr.x=getStageCenter();spr.y=160;spr.static=true;spr.onclick=function()
{gameState=STATE_MENU;createScene();};stage.addChild(spr);}
function showMenu()
{mc=library.getSprite('menu',getStageWidth(),320);mc.x=getStageCenter();mc.y=160;mc.static=true;stage.addChild(mc);mc=library.getSprite(sound?'sound-on-btn':'sound-off-btn');mc.x=getStageCenter()-207;mc.y=30;mc.static=true;mc.zIndex=20;mc.onclick=function(e)
{if(sound){e.target.bitmap=library.getBitmap('sound-off-btn');mixer.stop(0);Utils.setCookie('sound',2);sound=false;}
else{e.target.bitmap=library.getBitmap('sound-on-btn');mixer.play('solitaire',true,false,0);Utils.setCookie('sound',1);sound=true;}
buildBackground();};stage.addChild(mc);mc=library.getSprite('info-btn');mc.x=getStageCenter()-196;mc.y=stage.screenHeight-50;mc.static=true;mc.zIndex=20;mc.onclick=function()
{gameState=STATE_ABOUT;createScene();};stage.addChild(mc);mc=library.getSprite('play-btn');mc.x=getStageCenter()-11;mc.y=stage.screenHeight-63;mc.static=true;mc.zIndex=20;mc.onclick=function()
{gameState=STATE_INSTRUCTION;createScene();};stage.addChild(mc);mc=library.getSprite('best-score-btn');mc.x=getStageCenter()+108;mc.y=stage.screenHeight-50;mc.static=true;mc.zIndex=20;mc.onclick=function()
{gameState=STATE_LEADER;createScene();};stage.addChild(mc);mc=library.getSprite("more-games-btn");mc.x=getStageCenter()+198;mc.y=stage.screenHeight-50;mc.static=true;mc.onclick=function()
{window.open();};stage.addChild(mc);if(sound){mixer.play('solitaire',true,false,0);}}
function showInstruction()
{mc=library.getSprite('instructions',getStageWidth(),320);mc.x=getStageCenter();mc.y=160;mc.static=true;stage.addChild(mc);mc=library.getSprite('play-2-btn');mc.x=getStageWidth()-45;mc.y=stage.screenHeight-50;mc.animated=false;mc.static=true;mc.onclick=function()
{gameState=STATE_GAME;createScene();};stage.addChild(mc);}
function showFinished()
{mc=library.getSprite('finished',getStageWidth(),320);mc.x=getStageCenter();mc.y=160;mc.static=true;mc.onmousedown=function()
{return false;};mc.onmouseup=function()
{return false;};stage.addChild(mc);mc=library.getSprite('play-2-btn');mc.x=getStageWidth()-45;mc.y=stage.screenHeight-50;mc.zIndex=20;mc.animated=false;mc.static=true;mc.onclick=function()
{gameState=STATE_MENU;createScene();};stage.addChild(mc);var min=(M<10?'0'+M:M);var sec=(S<10?'0'+S:S);var text=new SimpleText(library.getBitmap('num'),10,18);text.x=getStageCenter()-125;text.y=169;text.charMap=['0','1','2','3','4','5','6','7','8','9',':'];text.align=TEXT_ALIGN_LEFT;text.charSpacing=1;text.write(min+':'+sec);text=new SimpleText(library.getBitmap('num'),10,18);text.x=getStageCenter()-125;text.y=209;text.charMap=['0','1','2','3','4','5','6','7','8','9',':'];text.align=TEXT_ALIGN_LEFT;text.charSpacing=1;text.write(gameScore);if(minH==0&&minM==0&&minS==0){minH=H;minM=M;minS=S;}
min=(minM<10?'0'+minM:minM);sec=(minS<10?'0'+minS:minS);text=new SimpleText(library.getBitmap('num'),10,18);text.x=getStageCenter()+162;text.y=169;text.charMap=['0','1','2','3','4','5','6','7','8','9',':'];text.align=TEXT_ALIGN_LEFT;text.charSpacing=1;text.write(min+':'+sec);if(maxGameScore==0){maxGameScore=gameScore;}
text=new SimpleText(library.getBitmap('num'),10,18);text.x=getStageCenter()+162;text.y=209;text.charMap=['0','1','2','3','4','5','6','7','8','9',':'];text.align=TEXT_ALIGN_LEFT;text.charSpacing=1;text.write(maxGameScore);}
function eraseGameArrays()
{slots=new Array(4);}
function launchGame()
{gameScore=startGameScore;stepDeckOffset=levelDifficultyCountCard.EASY;setMouseoutOnScreenWrapper();generateCardDeck();shuffleCardDeck();fillCardColumns();fillCardStock();drawGameBackground();drawDeck();drawCardColumns();startTimer();}
function showAbout()
{var spr=library.getSprite("about",getStageWidth(),320);spr.x=getStageCenter();spr.y=160;spr.static=true;spr.fillColor="#fee002";spr.onclick=function()
{gameState=STATE_MENU;createScene();};stage.addChild(spr);}
function showPause()
{stopTimer();pause_flag=true;var pauseBG=library.getSprite('pause',getStageWidth(),320);pauseBG.x=getStageCenter();pauseBG.y=160;pauseBG.static=false;pauseBG.onmousedown=function()
{return false;};pauseBG.onmouseup=function()
{return false;};stage.addChild(pauseBG);var sound_button=library.getSprite(sound?'sound-on-btn':'sound-off-btn');sound_button.x=getStageCenter()-207;sound_button.y=30;sound_button.static=false;sound_button.onclick=function(e)
{if(sound){e.target.bitmap=library.getBitmap('sound-off-btn');mixer.stop(0);Utils.setCookie('sound',2);sound=false;}
else{e.target.bitmap=library.getBitmap('sound-on-btn');mixer.play('solitaire',true,false,0);Utils.setCookie('sound',1);sound=true;}
buildBackground();};stage.addChild(sound_button);var backButton=library.getSprite('back-btn');backButton.x=getStageCenter()-130;backButton.y=180;backButton.static=false;backButton.onclick=function()
{resetScoreAndTime();pause_flag=false;processState=PROCESS_START;gameState=STATE_MENU;createScene();};stage.addChild(backButton);var replayButton=library.getSprite('replay-btn');replayButton.x=getStageCenter();replayButton.y=180;replayButton.static=false;replayButton.onclick=function()
{resetScoreAndTime();pause_flag=false;processState=PROCESS_START;gameState=STATE_GAME;createScene();};stage.addChild(replayButton);var playButton=library.getSprite('play-2-btn');playButton.x=getStageCenter()+130;playButton.y=180;playButton.static=false;playButton.onclick=function()
{pauseBG.destroy=true;backButton.destroy=true;replayButton.destroy=true;playButton.destroy=true;sound_button.destroy=true;pause_flag=false;startTimer();buildBackground();return false;};stage.addChild(playButton);buildBackground();}
function drawGameBackground()
{mc=library.getSprite('game-area',getStageWidth(),320);mc.x=getStageCenter();mc.y=160;mc.static=true;mc.onmouseup=redrawDeck;mc.onmousemove=Utils.mobileHideAddressBar;stage.addChild(mc);mc=library.getSprite('pause-btn');mc.x=getStageCenter()-210;mc.y=20;mc.static=true;mc.onclick=function()
{if(!pause_flag){showPause();}
return false;};stage.addChild(mc);timerText=new SimpleText(library.getBitmap('num'),10,18);timerText.x=getStageCenter()-210;timerText.y=75;timerText.charMap=['0','1','2','3','4','5','6','7','8','9',':'];timerText.align=TEXT_ALIGN_RIGHT;timerText.charSpacing=-1;timerText.static=false;timerText.write("00:00");}
function drawDeck()
{var tx=getStageCenter()+startCoordDeck.x;var ty=startCoordDeck.y;mc=new Sprite(null,57,78);mc.x=getStageCenter()+startCoordDeck.x;mc.y=startCoordDeck.y;mc.zIndex=0;mc.static=true;stage.addChild(mc);for(var i=0;i<stock.length;i++){mc=library.getSprite('back-card');mc.onmousedown=startDrag;mc.onmouseup=stopDrag;mc.x=tx;mc.y=ty;mc.place=placeCard.DECK;mc.drag=false;mc.static=true;stage.addChild(mc);stock[i].sprite=mc;stock[i].uid=mc.uid;}}
function drawCardColumns()
{for(var i=0;i<7;i++){for(var j=0;j<(i+1);j++){if(j==i){mc=library.getSprite(columns[i][j].name);columns[i][j].face=true;columns[i][j].top=true;}
else{mc=library.getSprite('back-card');}
mc.onmousedown=startDrag;mc.onmouseup=stopDrag;mc.x=getStageCenter()+coordColumns[i].x;mc.y=coordColumns[i].y+j*5;mc.place=placeCard.COLUMNS;mc.drag=false;mc.static=true;stage.addChild(mc);columns[i][j].sprite=mc;columns[i][j].uid=mc.uid;}}}
function redrawDeck(e)
{if((e.x<=(startCoordDeck.x+33)&&e.x>=(startCoordDeck.x-33))&&(e.y<=-71&&e.y>=-159))
{var tx=getStageCenter()+startCoordDeck.x;var ty=startCoordDeck.y;var max_zIndex=stage.objects[stage.getMaxZIndexInStack(stage.objects)].zIndex+1;for(var i=0;i<stock.length;i++){stock[i].sprite.bitmap=library.getBitmap('back-card');stock[i].sprite.setPosition(tx,ty);stock[i].sprite.setZIndex(max_zIndex+i);stock[i].sprite.dragStartPosition=null;stock[i].face=false;}}
needToBuildBackground=true;buildForeground();}
function startTimer()
{var sec='';var min='';startGameTime=new Date().getTime();gameTimer=setInterval(function()
{S++;gameScore-=69.44;gameScore=Math.floor(gameScore);if(S==60){S=0;M++;}
sec=(S<10?'0'+S:S);min=(M<10?'0'+M:M);timerText.write(min+':'+sec);if(gameEnd||M==60||gameScore<=0){stopTimer();gameState=STATE_FINISHED;createScene();}},1000);}
function stopTimer()
{clearInterval(gameTimer);stopGameTime=new Date().getTime();generalGameTime+=stopGameTime-startGameTime;}
function resetScoreAndTime()
{gameScore=startGameScore;generalGameTime=0;H=0;M=0;S=0;}
function setPlayerScore()
{if(((generalGameTime<minGameTime)||(minGameTime==0))&&((gameScore>maxGameScore)||(minGameTime==0)))
{Utils.setCookie("solitaire_game_time",generalGameTime);Utils.setCookie("solitaire_H",H);Utils.setCookie("solitaire_M",M);Utils.setCookie("solitaire_S",S);Utils.setCookie("solitaire_score",gameScore);}}
function getPlayerScore()
{minH=(Utils.getCookie("solitaire_H")==null?0:Utils.getCookie("solitaire_H"));minM=(Utils.getCookie("solitaire_M")==null?0:Utils.getCookie("solitaire_M"));minS=(Utils.getCookie("solitaire_S")==null?0:Utils.getCookie("solitaire_S"));maxGameScore=(Utils.getCookie("solitaire_score")==null?0:Utils.getCookie("solitaire_score"));minGameTime=(Utils.getCookie("solitaire_game_time")==null?0:Utils.getCookie("solitaire_score"));}
function getRandom(min,max)
{return Math.floor(Math.random()*(max-min+1))+min;};function clickCard(e)
{if(timer){clearTimeout(timer);}
dblclick_flag++;timer=setTimeout(function()
{var static_flag=false;if(dblclick_flag==1){if(e.target.place==placeCard.DECK){clickDeckCard(e);}
else{e.target.static=true;static_flag=true;}}
if(dblclick_flag>=2){if(addCardToSlot(e)===0){e.target.static=true;static_flag=true;}}
if(static_flag){for(var i=0;i<arrayDragCards.length;i++){arrayDragCards[i].sprite.static=true;}}
dblclick_flag=0;clearTimeout(timer);needToBuildBackground=true;},200);return false;}
function clickDeckCard(e)
{var position=searchElement(e.target,e.target.place);if(typeof(position)==='undefined'||stock[position].face){e.target.static=true;}
else{stock[position].face=true;e.target.setZIndex(stage.objects[stage.getMaxZIndexInStack(stage.objects)].zIndex+1);e.target.bitmap=library.getBitmap(stock[position].name);e.target.moveTo(getStageCenter()+startCoordDeckCard.x,startCoordDeckCard.y,0);}
needToBuildBackground=true;return false;}
function addCardToSlot(e)
{var element;var position;if(e.target.place==placeCard.SLOTS){return 0;}
position=searchElement(e.target,e.target.place);if(e.target.place==placeCard.DECK){element=stock[position];if(!element.face){return 0;}}
if(e.target.place==placeCard.COLUMNS){element=columns[position[0]][position[1]];if(!element.top){return 0;}}
for(var i=0;i<4;i++){if((typeof(slots[i])==='undefined')||(slots[i].length===0)){if((element.value==cardValue.ACE)&&(element.suit==suitAndSlotsRelation[i]))
{slots[i]=[];manipulationWithCard(e.target,position,getStageCenter()+coordSlot[i].x,coordSlot[i].y);e.target.place=placeCard.SLOTS;slots[i][0]=element;}}
else if((slots[i][slots[i].length-1].suit==element.suit)&&(slots[i][slots[i].length-1].value==(element.value-1)))
{manipulationWithCard(e.target,position,getStageCenter()+coordSlot[i].x,coordSlot[i].y);e.target.place=placeCard.SLOTS;slots[i].push(element);}}
e.target.static=true;needToBuildBackground=true;checkResult();return false;}
function addCardToColumn(e)
{var element;var position=searchElement(e.target,e.target.place);if(e.target.place==placeCard.SLOTS){element=slots[position[0]][position[1]];}
if(e.target.place==placeCard.DECK){element=stock[position];}
if(e.target.place==placeCard.COLUMNS){element=columns[position[0]][position[1]];}
for(var i=0;i<7;i++){var arr_last_id=columns[i].length-1;if((columns[i].length==0)){if((element.value==13)&&checkCoorRange(e.target,getStageCenter()+coordColumns[i].x,coordColumns[i].y,getStageCenter()+coordColumns[i].x,coordColumns[i].y))
{manipulationWithCard(e.target,position,getStageCenter()+coordColumns[i].x,coordColumns[i].y);e.target.place=placeCard.COLUMNS;element.top=true;gNumber=i;columns[i].push(element);return true;}}
else if(columns[i][arr_last_id].top&&columns[i][arr_last_id].face&&checkCoorRange(e.target,columns[i][arr_last_id].sprite.x,columns[i][arr_last_id].sprite.y,columns[i][arr_last_id].sprite.x,columns[i][arr_last_id].sprite.y)&&((element.value+1)==columns[i][arr_last_id].value)&&(element.color!=columns[i][arr_last_id].color))
{manipulationWithCard(e.target,position,columns[i][arr_last_id].sprite.x,columns[i][arr_last_id].sprite.y+faceCardColumnsOffset);e.target.place=placeCard.COLUMNS;element.top=true;columns[i].push(element);gNumber=i;return true;}}
needToBuildBackground=true;checkResult();return false;}
function manipulationWithCard(element,position,coorX,coorY)
{coorFirstDragCard.x=coorX;coorFirstDragCard.y=coorY;element.moveTo(coorX,coorY,0);if(element.place==placeCard.SLOTS){slots[position[0]].splice(position[1],1);}
if(element.place==placeCard.DECK){if((position-1)>=0){stock[position-1].top=true;}
stock.splice(position,1);}
if(element.place==placeCard.COLUMNS){if((position[1]-1)>=0){columns[position[0]][position[1]-1].top=true;columns[position[0]][position[1]-1].face=true;columns[position[0]][position[1]-1].sprite.bitmap=library.getBitmap(columns[position[0]][position[1]-1].name);}
columns[position[0]].splice(position[1],1);}
return false;}
function topCardCorrect(pos)
{for(var i=0;i<columns[pos].length;i++){columns[pos][i].top=false;}
columns[pos][columns[pos].length-1].top=true;}
function setStaticSprites(pos)
{for(var i=0;i<columns[pos].length;i++){columns[pos][i].sprite.static=true;}
needToBuildBackground=true;}
function startDrag(e)
{startUid=e.target.uid;dragElement={};arrayDragCards=[];oldPositionDragCard=[];var position=searchElement(e.target,e.target.place);var dragIndex=stage.objects[stage.getMaxZIndexInStack(stage.objects)].zIndex+1;if((e.target.place==placeCard.DECK)&&!stock[position].face){return false;}
if(e.target.place==placeCard.COLUMNS){if(!columns[position[0]][position[1]].face){return false;}
if((columns[position[0]].length-position[1])>1){oldPositionDragCard.push(position[0],position[1]);for(var i=1;i<(columns[position[0]].length-position[1]);i++){var element=columns[position[0]][position[1]+i];element.sprite.static=false;element.sprite.dragStartPosition={x:e.target.x,y:e.target.y+(i*faceCardColumnsOffset)};element.sprite.setZIndex(dragIndex+i);element.sprite.startDrag(e.x,e.y-(i*faceCardColumnsOffset));arrayDragCards.push(element);}}}
e.target.static=false;e.target.dragStartPosition={x:e.target.x,y:e.target.y};dragElement=e;e.target.startDrag(e.x,e.y);e.target.setZIndex(dragIndex);needToBuildBackground=true;return false;}
function stopDrag(e)
{Utils.mobileHideAddressBar();e.target.stopDrag();if(e.target.uid!=startUid){return true;}
var diffX=0;var diffY=0;if(typeof(e.target.dragStartPosition)!=='undefined'&&e.target.dragStartPosition!==null){diffX=Math.floor(Math.abs(e.target.x-e.target.dragStartPosition.x));diffY=Math.floor(Math.abs(e.target.y-e.target.dragStartPosition.y));}
if(diffX>0||diffY>0){var add_flag=false;if(checkCoorRange(e.target,getStageCenter()+coordSlot[0].x,coordSlot[0].y,getStageCenter()+coordSlot[3].x,coordSlot[3].y)){add_flag=addCardToSlot(e);}
if(e.target.y>=(coordColumns[0].y-20)){add_flag=addCardToColumn(e);if(e.target.place==placeCard.COLUMNS){if(add_flag&&arrayDragCards.length){columns[oldPositionDragCard[0]].splice(oldPositionDragCard[1],arrayDragCards.length);for(var i=0;i<arrayDragCards.length;i++){build_flag[arrayDragCards[i].uid]=true;arrayDragCards[i].sprite.moveTo(coorFirstDragCard.x,coorFirstDragCard.y+((i+1)*faceCardColumnsOffset),0);columns[gNumber].push(arrayDragCards[i]);}}
topCardCorrect(gNumber);}
setStaticSprites(gNumber);}
if(!add_flag){var coord=calculateCoordForCard(e.target);e.target.static=true;e.target.moveTo(coord.x,coord.y,0);for(var i=0;i<arrayDragCards.length;i++){arrayDragCards[i].sprite.stopDrag();arrayDragCards[i].sprite.static=true;arrayDragCards[i].sprite.moveTo(arrayDragCards[i].sprite.dragStartPosition.x,arrayDragCards[i].sprite.dragStartPosition.y,0);}}}
else{clickCard(e);}
needToBuildBackground=true;return false;}
function checkCoorRange(element,coorX1,coorY1,coorX2,coorY2)
{return((element.x>=(coorX1-50))&&(element.y>=(coorY1-50))&&(element.x<=(coorX2+50))&&(element.y<=(coorY2+50)));}
function calculateCoordForCard(element)
{if(element.place==placeCard.SLOTS){var position=searchElement(element,placeCard.SLOTS);return{x:getStageCenter()+coordSlot[position[0]].x,y:coordSlot[position[0]].y};}
if(element.place==placeCard.DECK){return{x:getStageCenter()+startCoordDeckCard.x,y:startCoordDeckCard.y};}
if(element.place==placeCard.COLUMNS){var position=searchElement(element,placeCard.COLUMNS);var return_x=getStageCenter()+coordColumns[position[0]].x;var return_y=coordColumns[position[0]].y;var prev_element=columns[position[0]][position[1]-1];if(typeof(prev_element)!=='undefined'){return_x=prev_element.sprite.x;return_y=prev_element.sprite.y+(prev_element.face?faceCardColumnsOffset:5);}
return{x:return_x,y:return_y};}}
function checkResult()
{var result=0;for(var i=0;i<4;i++){if(typeof(slots[i])!=='undefined'){result+=slots[i].length;}}
if(gameScore<0){gameScore=0;}
if((result==52)||(gameScore<=0)||!checkRemainingMoves()){gameEnd=true;}
return false;}
function checkRemainingMoves()
{for(var i=0;i<7;i++){for(var j=0;j<columns[i].length;j++){if(columns[i][j].face){if(checkForDeck(columns[i][j])||checkForColumns(columns[i][j])||checkForSlots(columns[i][j])){return true;}}}}
return false;}
function checkForDeck(element)
{for(var i=0;i<stock.length;i++){if(((element.value-1)==stock[i].value)&&(element.color!=stock[i].color)){return true;}}
return false;}
function checkForColumns(element)
{for(var i=0;i<7;i++){for(var j=0;j<columns[i].length;j++){if((element.value-1==columns[i][j].value)&&(element.color!=columns[i][j].color)){return true;}}}
return false;}
function checkForSlots(element)
{for(var i=0;i<4;i++){var length=(typeof(slots[i])==='undefined'?0:slots[i].length);if(length==0){if(element.value==cardValue.ACE){return true;}}
else{for(var j=0;j<length;j++){if((element.value-1==slots[i][j].value)&&(element.suit==slots[i][j].suit)){return true;}}}}
return false;}
function generateCardDeck()
{var k=0;for(var i=1;i<=4;i++){for(var j=1;j<=13;j++){deck[k++]={suit:i,value:j,color:(i<3?cardColor.RED:cardColor.BLACK),name:i+"-"+j,face:false,top:false,place:placeCard.DECK};}}}
function shuffleCardDeck()
{deck.sort(function()
{return(Math.random()*10)<5;});}
function fillCardColumns()
{var position_element=0;for(var i=0;i<7;i++){columns[i]=[];for(var j=0;j<(i+1);j++){position_element=getRandom(0,52);if(typeof(deck[position_element])==='undefined'){while(typeof(deck[position_element])==='undefined'){position_element=getRandom(0,52);}}
columns[i][j]=deck[position_element];columns[i][j].place=placeCard.COLUMNS;deck.splice(position_element,1);}}}
function fillCardStock()
{var j=0;for(var i=0;i<deck.length;i++){stock[j++]=deck[i];}}
function searchElement(element,place)
{if(place==placeCard.DECK){for(var i=0;i<stock.length;i++){if(element.uid==stock[i].uid){return i;}}}
else{var arr_elements=(place==placeCard.COLUMNS?columns:slots);var length=(typeof(arr_elements.length)==='undefined'?0:arr_elements.length);for(var i=0;i<length;i++){var element_length=(typeof(arr_elements[i])==='undefined'?0:arr_elements[i].length);for(var j=0;j<element_length;j++){if(element.uid==arr_elements[i][j].uid){return[i,j];}}}}};;;;