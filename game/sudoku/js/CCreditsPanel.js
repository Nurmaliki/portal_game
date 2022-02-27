function CCreditsPanel(){
    
    var _oFade;
    var _oPanelContainer;
    var _oButExit;
    var _oLogo;
    
    var _pStartPanelPos;
    
    this._init = function(){

        _oPanelContainer = new createjs.Container();        
        s_oStage.addChild(_oPanelContainer);
        
        var oSprite = s_oSpriteLibrary.getSprite('credit_bg');
        var oPanel = createBitmap(oSprite);        
        oPanel.regX = oSprite.width/2;
        oPanel.regY = oSprite.height/2;
        _oPanelContainer.addChild(oPanel);
        
        _oPanelContainer.x = CANVAS_WIDTH/2;
        _oPanelContainer.y = CANVAS_HEIGHT/2;  
        _pStartPanelPos = {x: _oPanelContainer.x, y: _oPanelContainer.y};

        var oTitle = new createjs.Text("DEVELOPED BY"," 80px "+SECONDARY_FONT, "#008df0");
        oTitle.y = -120;
        oTitle.textAlign = "center";
        oTitle.textBaseline = "middle";
        oTitle.lineWidth = 600;
        _oPanelContainer.addChild(oTitle);

        var oLink = new createjs.Text("www.codethislab.com"," 80px "+SECONDARY_FONT, "#008df0");
        oLink.y = 120;
        oLink.textAlign = "center";
        oLink.textBaseline = "middle";
        oLink.lineWidth = 600;
        _oPanelContainer.addChild(oLink);
        
        var oSprite = s_oSpriteLibrary.getSprite('ctl_logo');
        _oLogo = createBitmap(oSprite);
        _oLogo.on("mousedown",this._onLogoButRelease);
        _oLogo.regX = oSprite.width/2;
        _oLogo.regY = oSprite.height/2;
        _oPanelContainer.addChild(_oLogo);
      
        var oSprite = s_oSpriteLibrary.getSprite('but_exit');
        _oButExit = new CGfxButton(400, -204, oSprite, _oPanelContainer);
        _oButExit.addEventListener(ON_MOUSE_UP, this.unload, this);
        
    };
    
    this.unload = function(){

        s_oStage.removeChild(_oFade);
        s_oStage.removeChild(_oPanelContainer);

        _oButExit.unload();

        _oLogo.off("mousedown",this._onLogoButRelease);
        
        
    };
    
    this._onLogoButRelease = function(){
        window.open("http://www.codethislab.com/index.php?&l=en");
    };

    
    this._init();
    
    
};


