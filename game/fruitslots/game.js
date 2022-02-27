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
return false;},checkSpilgamesEnvironment:function()
{return(typeof ExternalAPI!="undefined"&&ExternalAPI.type=="Spilgames"&&ExternalAPI.check());},mobileCorrectPixelRatio:function()
{var meta=document.createElement('meta');meta.name="viewport";var content="target-densitydpi=device-dpi, user-scalable=no";if(Utils.checkSpilgamesEnvironment())
{if(window.devicePixelRatio>1)content+=", initial-scale=0.5, maximum-scale=0.5, minimum-scale=0.5";else content+=", initial-scale=1, maximum-scale=1, minimum-scale=1";}
else
{if(Utils.mobileCheckIphone4())content+=", initial-scale=0.5, maximum-scale=0.5, minimum-scale=0.5";else content+=", initial-scale=1, maximum-scale=1, minimum-scale=1";}
meta.content=content;document.getElementsByTagName('head')[0].appendChild(meta);},getMobileScreenResolution:function(landscape)
{var scale=1;var w=0;var h=0;var container={width:window.innerWidth,height:window.innerHeight};if(!Utils.touchScreen||container.height>container.width)
{w=container.width;h=container.height;}
else
{w=container.height;h=container.width;}
if(Utils.touchScreen)
{if(w>320&&w<=480)scale=1.5;if(w>480)scale=2;if(Utils.mobileCheckIphone4()&&window==window.parent)scale=2;}
else
{if(landscape)
{if(h>=640)scale=2;if(h<640&&h>=480)scale=1.5;}
else
{if(h>=800&&h<960)scale=1.5;if(h>=960)scale=2;}}
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
s=document.getElementById("screen_wrapper");s.style.width=(~~width)+"px";s.style.height=(~~height)+"px";s=document.getElementById("screen_background_wrapper");s.style.width=(~~width)+"px";s.style.height=(~~height)+"px";s=document.getElementById("p2l_container");s.style.width=(~~window.innerWidth)+"px";s.style.height="2048px";Utils.dispatchEvent("fitlayout");setTimeout(Utils.mobileHideAddressBar,50);},resizeElement:function(id,width,height)
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
{return this.width*this.scaleX*Utils.globalScale;};this.getHeight=function()
{return this.height*this.scaleY*Utils.globalScale;};this.startDrag=function(x,y)
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
{var c=this.getCenter(),r=new Rectangle(0,0,this.width*this.scaleX,this.height*this.scaleY,this.rotation);r.move(c.x,c.y);return r;}
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
{var self=this;this.canvas=document.getElementById(cnsId);this.canvas.renderController=this;this.canvas.ctx=this.canvas.getContext('2d');this.screenWidth=w;this.screenHeight=h;this.viewport={x:0,y:0};this.objects=[];this.objectsCounter=0;this.buffer=document.createElement('canvas');this.buffer.width=w*Utils.globalScale;this.buffer.height=h*Utils.globalScale;this.buffer.ctx=this.buffer.getContext('2d');this.delay=40;this.fillColor=false;this.started=false;this.fps=0;this.lastFPS=0;this.showFPS=false;this.pixelClickEvent=false;this.pixelMouseUpEvent=false;this.pixelMouseDownEvent=false;this.pixelMouseMoveEvent=false;this.ceilSizes=false;this.tmMain
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
this.drawScene=function(cns,drawStatic)
{var obj,ok;if(!cns.ctx)cns.ctx=cns.getContext("2d");if(!this.fillColor)
{if(!this.clearLock)this.clearScreen(cns);}
else
{cns.ctx.fillStyle=this.fillColor;cns.ctx.fillRect(0,0,this.screenWidth*Utils.globalScale*Utils.globalPixelScale,this.screenHeight*Utils.globalScale*Utils.globalPixelScale);}
for(var i=0;i<this.objects.length;i++)
{obj=this.objects[i];ok=false;if(!drawStatic&&!obj['static'])ok=true;if(drawStatic&&obj['static'])ok=true;if(ok)
{if(obj.destroy)
{this.removeChild(obj);i--;}
else
{obj.nextFrame();if(obj.visible)this.renderObject(cns,obj);}}}};this.tweens=[];this.createTween=function(obj,prop,start,end,duration,ease)
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
{i=self.removeTween(i);}}}
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
{console={log:function(){}}};function SimpleText(font,width,height)
{this.ALIGN_LEFT=0;this.ALIGN_RIGHT=1;this.ALIGN_CENTER=2;this.font=font;this.x=0;this.y=0;this.width=width;this.height=height;this.align=this.ALIGN_LEFT;this.rotation=0;this.charSpacing=0;this.static=false;this.charMap=['0','1','2','3','4','5','6','7','8','9'];this.sprites=[];this.text="";this.manageSprites=function(text)
{var i,char;var len=text.length;var sp_len=this.sprites.length;if(sp_len<len)
{for(i=0;i<len-sp_len;i++)
{char=new Sprite(this.font,this.width,this.height,this.charMap.length);this.sprites.push(char);stage.addChild(char);}}
if(sp_len>len)
{for(i=0;i<sp_len-len;i++)stage.removeChild(this.sprites[i]);this.sprites.splice(0,sp_len-len);}}
this.write=function(text)
{var curX,curY,p,p2,n;text=text+"";this.text=text;this.manageSprites(text);curX=this.x;curY=this.y;if(this.align==this.ALIGN_CENTER)curX=this.x-(text.length-1)/2*(this.width+this.charSpacing);if(this.align==this.ALIGN_RIGHT)curX=this.x-(text.length-1)*(this.width+this.charSpacing);p=new Vector(curX-this.x,0);p.rotate(-this.rotation);curX=p.x+this.x;curY=p.y+this.y;p=new Vector(0,0);for(var i=0;i<text.length;i++)
{this.sprites[i].visible=true;n=this.charMap.indexOf(text.substr(i,1));if(n<0)this.sprites[i].visible=false;else
{this.sprites[i].gotoAndStop(n);p2=p.clone();p2.rotate(-this.rotation);this.sprites[i].x=p2.x+curX;this.sprites[i].y=p2.y+curY;this.sprites[i].rotation=this.rotation;this.sprites[i].static=this.static;p.x+=this.width+this.charSpacing;}}}};function AudioPlayer()
{var self=this;this.disabled=false;this.basePath="";this.mp3Support=true;this.delayPlay=false;this.audioWrapper=null;this.locked=false;this.busy=false;this.startPlayTime=0;this.onend=null;this.createNewAudio=function()
{return document.createElement('audio');};this.init=function(path)
{this.basePath=path?path:"";this.delayPlay=("ontouchstart"in window);this.audioWrapper=this.createNewAudio();if(this.audioWrapper.canPlayType)this.mp3Support=this.audioWrapper.canPlayType('audio/mpeg')!="";else this.disabled=true;return!this.disabled;};this.play=function(file,loop)
{if(this.disabled)return false;var url=this.basePath+"/"+file+(this.mp3Support?".mp3":".ogg");this.stop();this.audioWrapper=this.createNewAudio();this.audioWrapper.src=url;this.audioWrapper.type=(this.mp3Support?"audio/mpeg":"audio/ogg");this.audioWrapper.loop=false;this.audioWrapper.doLoop=(loop?true:false);this.audioWrapper.preload="auto";this.audioWrapper.load();this.busy=true;this.audioWrapper.addEventListener("ended",this.controlPlay,false);if(this.delayPlay)this.audioWrapper.addEventListener("canplay",function(e){e.currentTarget.play();});else this.audioWrapper.play();this.startPlayTime=new Date().getTime();};this.stop=function()
{this.busy=false;try
{this.audioWrapper.pause();this.audioWrapper.currentTime=0.0;this.audioWrapper=null;}
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
else cID=freeChannels[0];return cID;};this.init(path,channelsCount);};var stage;var world;var mc;var fps=18;var bitmaps;var GET;var data=[];var LANDSCAPE_MODE=true;var STATE_LOAD=0;var STATE_SPLASH=1;var STATE_COVER=2;var STATE_MENU=3;var STATE_ABOUT=4;var STATE_GAME_START=5;var STATE_GAME_PRE_BET=6;var STATE_GAME_BET=7;var STATE_GAME_SPIN1=8;var STATE_GAME_HOLD=9;var STATE_GAME_SPIN2=10;var STATE_GAME_RESULT=11;var STATE_GAME_LOSE=12;var gameState=STATE_LOAD;var winCoef=[0,500,300,100,70,50,25,20,10,5];var mixer;window.onload=function()
{GET=Utils.parseGet();Utils.addMobileListeners(LANDSCAPE_MODE);Utils.mobileCorrectPixelRatio();Utils.addFitLayoutListeners();setTimeout(startLoad,600);};var screenWidthCoef=1;var screenWidthRatioPos=0;var iosMode;function startLoad()
{iosMode=navigator.userAgent.toLowerCase().indexOf("mac")!=-1;var resolution=Utils.getMobileScreenResolution(LANDSCAPE_MODE);if(GET["debug"]==1)resolution=Utils.getScaleScreenResolution(1,LANDSCAPE_MODE);Utils.globalScale=resolution.scale;var ratioCoefs=[1.5,1.6,1.66,1.7,1.78];var ratioWidth=[1,1.0666,1.106,1.133,1.187];if(window.innerWidth>window.innerHeight)var coef=window.innerWidth/window.innerHeight;else var coef=window.innerHeight/window.innerWidth;var min=100000,minPos=-1,diff;for(var i=0;i<ratioCoefs.length;i++)
{diff=Math.abs(coef-ratioCoefs[i]);if(diff<min)
{min=diff;minPos=i;}}
screenWidthCoef=ratioWidth[minPos];screenWidthRatioPos=minPos;resolution.width=Math.round(resolution.width*screenWidthCoef);Utils.createLayout(document.getElementById("main_container"),resolution);Utils.addEventListener("fitlayout",function()
{if(stage)
{stage.drawScene(document.getElementById("screen"));buildBackground();}});Utils.addEventListener("lockscreen",function(){if(stage&&stage.started)stage.stop();});Utils.addEventListener("unlockscreen",function(){if(stage&&!stage.started)stage.start();});Utils.mobileHideAddressBar();if(GET["debug"]!=1)Utils.checkOrientation(LANDSCAPE_MODE);var path=Utils.imagesRoot+"/"+Utils.globalScale+"/";var preloader=new ImagesPreloader();data.push({name:"splash",src:path+"/splash.jpg"});data.push({name:"about",src:path+"/about.jpg"});data.push({name:"button_arrow_down",src:path+"/button_arrow_down.png"});data.push({name:"button_arrow_up",src:path+"/button_arrow_up.png"});data.push({name:"button_bet_one",src:path+"/button_bet_one.png"});data.push({name:"button_cash_out",src:path+"/button_cash_out.png"});data.push({name:"button_play_again",src:path+"/button_play_again.png"});data.push({name:"button_play_max",src:path+"/button_play_max.png"});data.push({name:"button_spin_reels",src:path+"/button_spin_reels.png"});data.push({name:"button_wheel_spin",src:path+"/button_wheel_spin.png"});data.push({name:"button_about",src:path+"/button_about.png"});data.push({name:"button_more_games",src:path+"/button_more_games.png"});data.push({name:"button_start_game",src:path+"/button_start_game.png"});data.push({name:"button_hold",src:path+"/button_hold.png"});data.push({name:"button_sound",src:path+"/button_sound.png"});data.push({name:"chip_10",src:path+"/chip_10.png"});data.push({name:"chip_100",src:path+"/chip_100.png"});data.push({name:"chip_25",src:path+"/chip_25.png"});data.push({name:"chip_5",src:path+"/chip_5.png"});data.push({name:"chip_50",src:path+"/chip_50.png"});data.push({name:"glass",src:path+"/glass.png"});data.push({name:"hold",src:path+"/hold.png"});data.push({name:"hold_frame",src:path+"/hold_frame.png"});data.push({name:"wheel_arrow",src:path+"/wheel_arrow.png"});data.push({name:"wheel_front",src:path+"/wheel_front.png"});data.push({name:"wheel_win",src:path+"/wheel_win.png"});data.push({name:"wheel_stars",src:path+"/wheel_stars.png"});data.push({name:"win_frame",src:path+"/win_frame.png"});data.push({name:"win_lights",src:path+"/win_lights.png"});data.push({name:"text1",src:path+"/text1.png"});data.push({name:"win_text",src:path+"/win_text.png"});data.push({name:"fruit1",src:path+"/fruits/1.png"});data.push({name:"fruit2",src:path+"/fruits/2.png"});data.push({name:"fruit3",src:path+"/fruits/3.png"});data.push({name:"fruit4",src:path+"/fruits/4.png"});data.push({name:"fruit5",src:path+"/fruits/5.png"});data.push({name:"fruit6",src:path+"/fruits/6.png"});data.push({name:"fruit7",src:path+"/fruits/7.png"});data.push({name:"fruit8",src:path+"/fruits/8.png"});data.push({name:"fruit9",src:path+"/fruits/9.png"});data.push({name:"cover",src:path+"ratios/"+screenWidthRatioPos+"/cover.jpg"});data.push({name:"menu",src:path+"ratios/"+screenWidthRatioPos+"/menu.jpg"});data.push({name:"wheel",src:path+"ratios/"+screenWidthRatioPos+"/wheel.jpg"});data.push({name:"game",src:path+"ratios/"+screenWidthRatioPos+"/game.jpg"});data.push({name:"font1",src:path+"/font1.png"});preloader.load(data,loadImagesEnd,Utils.showLoadProgress);}
function getStageWidth(){return stage.screenWidth};function getStageCenter(){return stage.screenWidth/2};function loadImagesEnd(data)
{document.getElementById('progress_container').style.display='none';document.getElementById('screen_container').style.display='block';document.getElementById('screen_background_container').style.display='block';bitmaps=data;loadSettings();mixer=new AudioMixer("sounds",1);if(GET["debug"]!=1)
{showSplash();}}
function playSound(file)
{if(!soundDisabled)
{var ok=true;if(Utils.touchScreen)
{if(SOUNDS_MODE=="disabled")ok=false;if(SOUNDS_MODE=="results"&&file!="win"&&file!="win2")ok=false;}
if(ok)
{mixer.play(file,false,false,0);}}}
var soundDisabled=false;function loadSettings()
{var v=Utils.getCookie("sm_sound_disabled")*1;if(v==1)soundDisabled=true;else soundDisabled=false;}
function saveSettings()
{Utils.setCookie("sm_sound_disabled",(soundDisabled?1:0));}
function changeSound()
{soundDisabled=!soundDisabled;saveSettings();setSound();}
function setSound()
{soundsButton.gotoAndStop(soundDisabled?1:0);}
function showMenu()
{gameState=STATE_MENU;createScene();}
function showSplash()
{gameState=STATE_SPLASH;createScene();}
function showCover()
{gameState=STATE_COVER;createScene();}
function showAbout()
{gameState=STATE_ABOUT;createScene();}
function showMoreGames()
{window.open(MORE_GAMES_URL);}
function showGame()
{gameState=STATE_GAME_START;createScene();startNewGame();}
function createStage()
{if(stage)
{stage.destroy();stage.stop();}
stage=new Stage('screen',Math.round(480*screenWidthCoef),320,false);stage.delay=1000/fps;stage.onpretick=preTick;stage.onposttick=postTick;stage.ceilSizes=true;stage.showFPS=false;}
function setBackColor(val)
{document.getElementById('screen_background_container').style.background=val;}
function createScene()
{createStage();if(gameState==STATE_SPLASH)
{setBackColor("#fee002");mc=new Sprite(bitmaps.splash,getStageWidth(),320);mc.x=getStageCenter();mc.y=160;mc.static=true;stage.addChild(mc);stage.setTimeout(showCover,fps*3);}
if(gameState==STATE_COVER)
{setBackColor("#000");mc=new Sprite(bitmaps.cover,getStageWidth(),320);mc.x=getStageCenter();mc.y=160;mc.static=true;mc.onclick=showMenu;stage.addChild(mc);}
if(gameState==STATE_MENU)
{setBackColor("#000");mc=new Sprite(bitmaps.menu,getStageWidth(),320);mc.x=getStageCenter();mc.y=160;mc.static=true;stage.addChild(mc);mc=new Sprite(bitmaps.button_start_game,90,20);mc.x=getStageCenter()-140;mc.y=267;mc.static=true;mc.onclick=showGame;stage.addChild(mc);mc=new Sprite(bitmaps.button_about,48,20);mc.x=getStageCenter();mc.y=267;mc.static=true;mc.onclick=showAbout;stage.addChild(mc);mc=new Sprite(bitmaps.button_more_games,101,20);mc.x=getStageCenter()+150;mc.y=267;mc.static=true;mc.onclick=showMoreGames;stage.addChild(mc);}
if(gameState==STATE_ABOUT)
{setBackColor("#fee002");mc=new Sprite(bitmaps.about,480,320);mc.x=getStageCenter();mc.y=160;mc.static=true;mc.onclick=showMenu;stage.addChild(mc);}
if(gameState==STATE_GAME_START)
{setBackColor("#000");mc=new Sprite(bitmaps.game,getStageWidth(),320);mc.x=getStageCenter();mc.y=160;mc.static=true;stage.addChild(mc);mc=new Sprite(bitmaps.button_sound,60,58);mc.x=getStageCenter()-205;mc.y=250;mc.scaleX=mc.scaleY=0.5;stage.addChild(mc);mc.onclick=changeSound;soundsButton=mc;setSound();if(SOUNDS_MODE=="disabled")soundsButton.visible=false;balanceText=new SimpleText(bitmaps.font1,14,22);balanceText.align=balanceText.ALIGN_RIGHT;balanceText.x=getStageCenter()-72;balanceText.y=298;coefText=new SimpleText(bitmaps.font1,14,22);coefText.x=getStageCenter()-206;coefText.y=171;creditsText=new SimpleText(bitmaps.font1,14,22);creditsText.align=creditsText.ALIGN_RIGHT;creditsText.x=getStageCenter()+222;creditsText.y=113;winnerPlayedText=new SimpleText(bitmaps.font1,14,22);winnerPlayedText.align=winnerPlayedText.ALIGN_RIGHT;winnerPlayedText.x=getStageCenter()+222;winnerPlayedText.y=175;coinsPlayedText=new SimpleText(bitmaps.font1,14,22);coinsPlayedText.align=coinsPlayedText.ALIGN_RIGHT;coinsPlayedText.x=getStageCenter()+222;coinsPlayedText.y=238;mc=new Sprite(bitmaps.button_arrow_up,38,37);mc.x=getStageCenter()-206;mc.y=138;mc.static=true;mc.onclick=function(){changeCoef(1);};stage.addChild(mc);mc=new Sprite(bitmaps.button_arrow_down,38,37);mc.x=getStageCenter()-206;mc.y=203;mc.static=true;mc.onclick=function(){changeCoef(-1);};stage.addChild(mc);mc=new Sprite(bitmaps.chip_5,31,30);mc.x=getStageCenter()+148;mc.y=30;mc.static=true;mc.onclick=function(){pay(5);};stage.addChild(mc);mc=new Sprite(bitmaps.chip_10,31,30);mc.x=getStageCenter()+183;mc.y=30;mc.static=true;mc.onclick=function(){pay(10);};stage.addChild(mc);mc=new Sprite(bitmaps.chip_25,31,30);mc.x=getStageCenter()+218;mc.y=30;mc.static=true;mc.onclick=function(){pay(25);};stage.addChild(mc);mc=new Sprite(bitmaps.chip_50,31,30);mc.x=getStageCenter()+165;mc.y=60;mc.static=true;mc.onclick=function(){pay(50);};stage.addChild(mc);mc=new Sprite(bitmaps.chip_100,31,30);mc.x=getStageCenter()+200;mc.y=60;mc.static=true;mc.onclick=function(){pay(100);};stage.addChild(mc);mc=new Sprite(bitmaps.button_cash_out,47,47);mc.x=getStageCenter()-204;mc.y=296;mc.static=true;mc.onclick=cashOut;stage.addChild(mc);mc=new Sprite(bitmaps.button_cash_out,47,47);mc.x=getStageCenter()-204;mc.y=296;mc.static=true;mc.onclick=cashOut;stage.addChild(mc);mc=new Sprite(bitmaps.button_spin_reels,47,47);mc.x=getStageCenter()+209;mc.y=296;mc.static=true;mc.onclick=spinReels;stage.addChild(mc);mc=new Sprite(bitmaps.button_play_max,47,47);mc.x=getStageCenter()+149;mc.y=296;mc.static=true;mc.onclick=playMax;stage.addChild(mc);mc=new Sprite(bitmaps.button_bet_one,47,47);mc.x=getStageCenter()+89;mc.y=296;mc.static=true;mc.onclick=betOne;stage.addChild(mc);reelsSprites=[];reelsSpinPositions=[];holdSprites=[];holdButtons=[];holdFrames=[];var curX=getStageCenter()-135;for(var i=0;i<4;i++)
{reelsSprites[i]=[];for(var n=0;n<3;n++)
{mc=new Sprite(null,56,56);mc.x=curX;reelsSprites[i][n]=mc;stage.addChild(mc);}
reelsSpinPositions[i]=0;mc=new Sprite(bitmaps.glass,71,101);mc.x=curX-1;mc.y=171;mc.slotID=i*1;mc.onclick=hold;stage.addChild(mc);mc=new Sprite(bitmaps.hold_frame,77,106);mc.x=curX;mc.y=171;stage.addChild(mc);mc.visible=false;holdFrames[i]=mc;mc=new Sprite(bitmaps.hold,19,19);mc.x=curX+20;mc.y=120;mc.visible=false;stage.addChild(mc);holdSprites[i]=mc;mc=new Sprite(bitmaps.button_hold,62,30,2);mc.x=curX;mc.y=245;mc.slotID=i*1;mc.onclick=hold;stage.addChild(mc);mc.stop();holdButtons[i]=mc;curX+=72;}
comboMark=new Sprite(bitmaps.win_lights,90,30,2);comboMark.animDelay=4;comboMark.visible=false;stage.addChild(comboMark);lockScreen=new Sprite(null,getStageWidth(),320);lockScreen.x=getStageCenter();lockScreen.y=160;lockScreen.visible=false;lockScreen.onclick=function(){return false;};stage.addChild(lockScreen);}
buildBackground();stage.start();}
var balanceText;var coefText;var creditsText;var winnerPlayedText;var coinsPlayedText;var reelsSprites;var reelsSpinPositions;var holdSprites;var holdButtons;var holdFrames;var lockScreen;var comboMark;var balance=0;var coef=1;var credits=0;var winnerPlayed=0;var coinsPlayed=0;var reels=[];var holded=[];var spinSteps=[];function startNewGame()
{balance=START_COINS;coef=1;credits=0;winnerPlayed=0;coinsPlayed=0;reels=[0,0,0,0];setReelsRandomly();showCurrentReels();startNewMatch();}
function startNewMatch()
{gameState=STATE_GAME_PRE_BET;holded=[false,false,false,false,false];showBalance();showCredits();showWinnerPlayed();showCoinsPlayed();showCoef();showHolded();}
function showBalance()
{balanceText.write(balance);}
function showCredits()
{if(credits<0)credits=0;creditsText.write(Math.floor(credits/coef));}
function showWinnerPlayed()
{if(winnerPlayed<0)winnerPlayed=0;winnerPlayedText.write(winnerPlayed);}
function showCoinsPlayed()
{if(coinsPlayed<0)coinsPlayed=0;coinsPlayedText.write(coinsPlayed);}
function showCoef()
{coefText.write(coef);}
function setReelsRandomly()
{for(var i=0;i<4;i++)
{reels[i]=Math.floor(Math.random()*9)+1;}}
function showCurrentReels()
{for(var i=0;i<4;i++)
{var v0=reels[i]-1;if(v0<=0)v0=9;var v2=reels[i]+1;if(v2>9)v2=1;reelsSprites[i][0].bitmap=bitmaps["fruit"+v0];reelsSprites[i][1].bitmap=bitmaps["fruit"+reels[i]];reelsSprites[i][2].bitmap=bitmaps["fruit"+v2];reelsSprites[i][0].y=117+reelsSpinPositions[i];reelsSprites[i][1].y=173+reelsSpinPositions[i];reelsSprites[i][2].y=229+reelsSpinPositions[i];for(var n=0;n<3;n++)
{reelsSprites[i][n].offset.top=0;reelsSprites[i][n].height=56;reelsSprites[i][n].visible=true;if(reelsSprites[i][n].y-28<125)
{reelsSprites[i][n].offset.top=125-(reelsSprites[i][n].y-28);reelsSprites[i][n].height=56-reelsSprites[i][n].offset.top;reelsSprites[i][n].y=125+reelsSprites[i][n].height/2;}
if(reelsSprites[i][n].y+28>218)
{reelsSprites[i][n].height=218-(reelsSprites[i][n].y-28);reelsSprites[i][n].y=218-reelsSprites[i][n].height/2;}
if(reelsSprites[i][n].height<=0)reelsSprites[i][n].visible=false;}}}
function pay(cnt)
{if(balance<cnt)return;balance-=cnt;credits+=cnt;showBalance();showCredits();playSound("button");}
function changeCoef(val)
{if(gameState!=STATE_GAME_PRE_BET&&gameState!=STATE_GAME_BET)return;coef+=val;if(credits<coinsPlayed*coef)coef--;if(coef<MIN_COEF)coef=MIN_COEF;if(coef>MAX_COEF)coef=MAX_COEF;showCoef();showCredits();hideResultText();unMarkCombos();playSound("button");}
function cashOut()
{balance+=credits-coinsPlayed*coef;credits=coinsPlayed*coef;showBalance();showCredits();playSound("button");}
function betOne()
{if(gameState!=STATE_GAME_BET&&gameState!=STATE_GAME_PRE_BET)return;gameState=STATE_GAME_BET;if(coinsPlayed>=MAX_BET)coinsPlayed=0;coinsPlayed++;if(coinsPlayed>Math.floor(credits/coef))
{if(credits>=coef)coinsPlayed=1;else coinsPlayed=0;}
showCredits();showCoinsPlayed();hideResultText();unMarkCombos();playSound("button");}
function playMax()
{if(gameState!=STATE_GAME_BET&&gameState!=STATE_GAME_PRE_BET)return;if(credits<=0)return;gameState=STATE_GAME_BET;var bet=Math.floor(credits/coef);if(bet>MAX_BET)bet=MAX_BET;coinsPlayed=bet;showCoinsPlayed();spinReels();}
function spinReels()
{if(coinsPlayed<=0)return;hideResultText();unMarkCombos();if(gameState==STATE_GAME_PRE_BET)gameState=STATE_GAME_BET;if(gameState==STATE_GAME_BET)
{credits-=coinsPlayed*coef;if(credits<0)credits=0;showCredits();gameState=STATE_GAME_SPIN1;doSpinReels();}
if(gameState==STATE_GAME_HOLD)
{gameState=STATE_GAME_SPIN2;doSpinReels();}}
function doSpinReels()
{var pos=[];for(var i=0;i<4;i++)
{if(!holded[i])pos[i]=Math.floor(Math.random()*9)+1}
if(gameState==STATE_GAME_SPIN2)
{var win=isWin();if(!win&&Math.random()<=CWR)
{var ok=true;var check=[];for(var i=0;i<4;i++)
{if(holded[i])check.push(reels[i]);}
for(var i=0;i<check.length;i++)
{if(check[0]!=check[i])ok=false;}
if(ok)
{var id=0;if(check.length==0)id=Math.floor(Math.random()*9)+1;else id=check[0];for(var i=0;i<4;i++)
{pos[i]=id;}}}}
for(var i=0;i<4;i++)
{if(!holded[i])spinSteps[i]=reels[i]-pos[i]+9+i*9;}
playSound("button");}
function checkReelsStop()
{if(gameState==STATE_GAME_SPIN1||gameState==STATE_GAME_SPIN2)
{var ok=true;for(var i=0;i<4;i++)
{if(spinSteps[i]>0||reelsSpinPositions[i]!=0)ok=false;}
if(ok)
{if(gameState==STATE_GAME_SPIN1)playSound("slot");endSpinReels();}}}
function endSpinReels()
{if(gameState==STATE_GAME_SPIN1)gameState=STATE_GAME_HOLD;if(gameState==STATE_GAME_SPIN2)
{gameState=STATE_GAME_RESULT;showResult();}}
function showHolded()
{for(var i=0;i<4;i++)
{holdSprites[i].visible=holded[i];holdFrames[i].visible=holded[i];holdButtons[i].gotoAndStop(holded[i]?1:0);}}
function hold(e)
{if(gameState!=STATE_GAME_HOLD)return;var id=e.target.slotID;holded[id]=!holded[id];showHolded();playSound("hold");}
function isWin()
{var win=true;for(var i=0;i<4;i++)
{if(reels[0]!=reels[i])win=false;}
return win;}
function showResult()
{var win=isWin();if(win)
{var c=winCoef[reels[0]];winnerPlayed=c*coef*coinsPlayed;showWinnerPlayed();var s="win";if(reels[0]>3)s="win2";if(reels[0]==4)lockAll(true,true,s);else lockAll(true,false,s);markCombo(reels[0]);}
else lockAll(false);}
function restartMatch()
{if(winnerPlayed>0)
{credits+=winnerPlayed;winnerPlayed=0;}
if(coinsPlayed>credits/coef)
{coinsPlayed=Math.floor(credits/coef);}}
var winText;var winLock;function lockAll(showWinText,showWheelScreen,sound)
{lockScreen.visible=true;if(showWinText)
{winLock=new Sprite(null,getStageWidth(),320);winLock.x=getStageCenter();winLock.y=160;winLock.onclick=function()
{winText.destroy=true;winLock.destroy=true;if(showWheelScreen)showWheel();else clearField();if(iosMode)playSound(sound);}
stage.addChild(winLock);winText=new Sprite(bitmaps.win_text,200,59);winText.x=getStageCenter()-30;winText.y=170;winText.scaleX=winText.scaleY=0.1;stage.addChild(winText);winText.scaleTo(1,6);if(!iosMode)playSound(sound);}
else
{playSound("slot");clearField();}}
function clearField()
{if(balance<=0&&credits<=0)
{mc=new Sprite(bitmaps.button_play_again,100,36);mc.x=getStageCenter()-30;mc.y=172;mc.onclick=function(e)
{e.target.destroy=true;lockScreen.visible=false;startNewGame();}
stage.addChild(mc);}
else doClearField();}
function doClearField()
{restartMatch();startNewMatch();lockScreen.visible=false;}
function hideResultText()
{}
function markCombo(id)
{comboMark.visible=true;var p;if(id<4)
{comboMark.x=getStageCenter()-105;p=id-1;}
else if(id<7)
{comboMark.x=getStageCenter()-12;p=id-4;}
else
{comboMark.x=getStageCenter()+68;p=id-7;}
comboMark.y=p*21+46;if(id==3)comboMark.y-=1;if(id==5)comboMark.y+=2;if(id==7)comboMark.y+=1;if(id==8)comboMark.y+=1;}
function unMarkCombos()
{comboMark.visible=false;}
var popup=[];var wheelTurned=false;var wheelFront;var wheelStars;function showWheel()
{popup=[];wheelTurned=false;for(var i=0;i<stage.objects.length;i++)
{stage.objects[i].visible=false;}
mc=new Sprite(bitmaps.wheel,getStageWidth(),320);mc.x=getStageCenter();mc.y=160;mc.static=true;stage.addChild(mc);popup.push(mc);var x=getStageCenter()+14;var y=161.5;mc=new Sprite(bitmaps.wheel_front,210,210);mc.x=x;mc.y=y;mc.velocity=0.5;mc.rotation=Math.floor(Math.random()*20)*(Math.PI*2/20);mc.active=false;mc.onenterframe=rotateWheel;stage.addChild(mc);popup.push(mc);wheelFront=mc;mc=new Sprite(bitmaps.wheel_stars,250,250,3);mc.x=x;mc.y=y;mc.stop();mc.animDelay=2;stage.addChild(mc);popup.push(mc);wheelStars=mc;mc=new Sprite(bitmaps.wheel_win,39,93);mc.x=x;mc.y=y-61;stage.addChild(mc);popup.push(mc);mc=new Sprite(bitmaps.wheel_arrow,24,67);mc.x=x;mc.y=y-27;stage.addChild(mc);popup.push(mc);mc=new Sprite(bitmaps.button_wheel_spin,46,45);mc.x=getStageCenter()+210;mc.y=290;mc.static=true;mc.onclick=turnWheel;stage.addChild(mc);popup.push(mc);buildBackground();}
function rotateWheel(e)
{if(!e.target.active)return;if(e.target.velocity>0)
{e.target.rotation+=e.target.velocity;e.target.velocity-=0.011;}
else
{showWheelResult();}}
function hideWheel()
{for(var i=0;i<popup.length;i++)
{stage.removeChild(popup[i],true);}
for(var i=0;i<stage.objects.length;i++)
{stage.objects[i].visible=true;}
unMarkCombos();showHolded();showCredits();showWinnerPlayed();buildBackground();clearField();}
function turnWheel()
{if(wheelTurned)return;wheelTurned=true;wheelFront.active=true;playSound("button");}
function showWheelResult(result)
{wheelFront.active=false;var results=[100,200,25,2,10,0,200,5,2,15,50,200,25,2,10,0,200,5,2,15];var c=Math.PI*2;var r=Math.floor(wheelFront.rotation/c);r=wheelFront.rotation-r*c;var id=Math.floor(r/(c/20));var result=results[19-id];if(result>0)
{wheelStars.play();var sound="win2";if(result>=100)sound="win";winLock=new Sprite(null,getStageWidth(),320);winLock.x=getStageCenter();winLock.y=160;winLock.onclick=function()
{winText.destroy=true;winLock.destroy=true;hideWheel();playSound(sound);if(iosMode)playSound(sound);}
stage.addChild(winLock);winText=new Sprite(bitmaps.win_text,200,59);winText.x=getStageCenter()+14;winText.y=160;winText.scaleX=winText.scaleY=0.1;stage.addChild(winText);winText.scaleTo(1,6);winnerPlayed+=result*coef*coinsPlayed;if(!iosMode)playSound(sound);}
else stage.setTimeout(hideWheel,fps*2);}
function buildBackground()
{stage.drawScene(document.getElementById("screen_background"),true);}
function preTick()
{if(gameState==STATE_GAME_SPIN1||gameState==STATE_GAME_SPIN2)
{var ok=false;var step=32;for(var i=0;i<4;i++)
{if(spinSteps[i]>0)
{ok=true;reelsSpinPositions[i]+=step;if(reelsSpinPositions[i]>=28)
{reels[i]--;if(reels[i]<1)reels[i]=9;reelsSpinPositions[i]=-28;spinSteps[i]--;}}
else
{if(reelsSpinPositions[i]<0)
{ok=true;reelsSpinPositions[i]+=step;if(reelsSpinPositions[i]>0)reelsSpinPositions[i]=0;}}}
if(ok)showCurrentReels();else checkReelsStop();}}
function postTick()
{};