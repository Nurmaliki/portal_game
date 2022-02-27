
<?php
	include_once('../Access.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="css/reset.css" type="text/css">
        <link rel="stylesheet" href="css/main.css" type="text/css">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, minimal-ui" />
	<meta name="msapplication-tap-highlight" content="no"/>

        <script type="text/javascript" src="js/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="js/createjs-2014.12.12.min.js"></script>
        <script type="text/javascript" src="js/ctl_utils.js"></script>
        <script type="text/javascript" src="js/sprite_lib.js"></script>
        <script type="text/javascript" src="js/settings.js"></script>
        <script type="text/javascript" src="js/CLang.js"></script>
        <script type="text/javascript" src="js/CPreloader.js"></script>
        <script type="text/javascript" src="js/CMain.js"></script>
        <script type="text/javascript" src="js/CTextButton.js"></script>
        <script type="text/javascript" src="js/CToggle.js"></script>
        <script type="text/javascript" src="js/CDeleteButton.js"></script>
        <script type="text/javascript" src="js/CGfxButton.js"></script>
        <script type="text/javascript" src="js/CMenu.js"></script>
        <script type="text/javascript" src="js/CModeMenu.js"></script>
        <script type="text/javascript" src="js/CGame.js"></script>
        <script type="text/javascript" src="js/CInterface.js"></script>
        <script type="text/javascript" src="js/CHelpPanel.js"></script>
        <script type="text/javascript" src="js/CPausePanel.js"></script>
        <script type="text/javascript" src="js/CSudokuLoader.js"></script>
        <script type="text/javascript" src="js/CEndPanel.js"></script>
        <script type="text/javascript" src="js/CConfigPanel.js"></script>
        <script type="text/javascript" src="js/CGrid.js"></script>
        <script type="text/javascript" src="js/CCell.js"></script>
        <script type="text/javascript" src="js/CNumButton.js"></script>
        
    </head>
    <body ondragstart="return false;" ondrop="return false;" >
	<div style="position: fixed; background-color: transparent; top: 0px; left: 0px; width: 100%; height: 100%"></div>
          <script>
            $(document).ready(function(){
                     var oMain = new CMain({
                                            //Set the difficulty of each level. Less is harder.
                                            max_givens_beginner: 38, //Max number of starting givens in beginner sudoku (lower limit: 36)
                                            max_givens_intermediate: 32, //Max number of starting givens in intermediate sudoku (lower limit: 28)
                                            max_givens_advanced: 26,     //Max number of starting givens in advanced sudoku (lower limit: 25)                                           
                                            
                                            bonus_time_beginner: 600000,   //TIME LIMIT (IN MS) TO COMPLETE THE GAME, FOR BONUS POINTS CALCULATION IN BEGINNER GAME MODE (DEFAULT: 10 MINUTES)
                                            bonus_time_intermediate: 1200000,   //TIME LIMIT (IN MS) TO COMPLETE THE GAME, FOR BONUS POINTS CALCULATION IN INTERMEDIATE GAME MODE (DEFAULT: 20 MINUTES)
                                            bonus_time_advanced: 1800000,   //TIME LIMIT (IN MS) TO COMPLETE THE GAME, FOR BONUS POINTS CALCULATION IN ADVANCED GAME MODE (DEFAULT: 30 MINUTES)
                                            
                                            //////////////////////////////////////////////////////////////////////////////////////////
                                            ad_show_counter: 20     //NUMBER OF INSERTED-NUMBERS BEFORE AD SHOWN
                                            //
                                            //// THIS FUNCTIONALITY IS ACTIVATED ONLY WITH CTL ARCADE PLUGIN.///////////////////////////
                                            /////////////////// YOU CAN GET IT AT: /////////////////////////////////////////////////////////
                                            // http://codecanyon.net/item/ctl-arcade-wordpress-plugin/13856421?s_phrase=&s_rank=27 ///////////
                                            
                                           });

                    $(oMain).on("start_session", function(evt) {
                            if(getParamValue('ctl-arcade') === "true"){
                                parent.__ctlArcadeStartSession();
                            }
                            //...ADD YOUR CODE HERE EVENTUALLY
                    });
                     
                    $(oMain).on("end_session", function(evt) {
                           if(getParamValue('ctl-arcade') === "true"){
                               parent.__ctlArcadeEndSession();
                           }
                           //...ADD YOUR CODE HERE EVENTUALLY
                    });

                    $(oMain).on("restart_level", function(evt, iLevel) {
                           if(getParamValue('ctl-arcade') === "true"){
                               parent.__ctlArcadeRestartLevel({level:iLevel});
                           }
                           //...ADD YOUR CODE HERE EVENTUALLY
                    });

                    $(oMain).on("save_score", function(evt, iScore, iDifficultyMode, iTime, bNote, bSolve, bTime, iNumHint) {
                         //1 iDifficultyMode => return difficulty mode (0 = beginner, 1 = intermediate, 2 = advanced;
                         //2 iTime => return completition time of sudoku;
                         //3 bNote => return true, if player used autofill notes help;
                         //3 bSolve => return true, if player used autosolver;
                         //4 bTime => return true if player have played without time;
                         //5 iNumHint => return number of Hints used. 0 = no hints used;
                            if(getParamValue('ctl-arcade') === "true"){
                                parent.__ctlArcadeSaveScore({score: iScore, mode:iDifficultyMode, time: iTime, helpnote: bNote, helpsolve: bSolve, helpnotime:bTime, helpnumhint:iNumHint});
                            }
                     });

                    $(oMain).on("start_level", function(evt, iLevel) {
                           if(getParamValue('ctl-arcade') === "true"){
                               parent.__ctlArcadeStartLevel({level:iLevel});
                           }
                           //...ADD YOUR CODE HERE EVENTUALLY
                    });

                    $(oMain).on("end_level", function(evt,iLevel) {
                           if(getParamValue('ctl-arcade') === "true"){
                               parent.__ctlArcadeEndLevel({level:iLevel});
                           }
                           //...ADD YOUR CODE HERE EVENTUALLY
                    });

                    $(oMain).on("show_interlevel_ad", function(evt) {
                           if(getParamValue('ctl-arcade') === "true"){
                               parent.__ctlArcadeShowInterlevelAD();
                           }
                           //...ADD YOUR CODE HERE EVENTUALLY
                    });
                    
                    $(oMain).on("share_event", function(evt, iScore, szImage, szTitle, szMsg, szMsgShare) {
                           if(getParamValue('ctl-arcade') === "true"){
                               parent.__ctlArcadeShareEvent({   img:szImage,
                                                                title:szTitle,
                                                                msg:szMsg,
                                                                msg_share:szMsgShare});
                           }
                           //...ADD YOUR CODE HERE EVENTUALLY
                    });
                     
                    if(isIOS()){ 
                        setTimeout(function(){sizeHandler();},200); 
                    }else{ sizeHandler(); } 
           });

        </script>
        <canvas id="canvas" class='ani_hack' width="1080" height="1920"> </canvas>
        <div id="block_game" style="position: fixed; background-color: transparent; top: 0px; left: 0px; width: 100%; height: 100%; display:none"></div>
        
    </body>
</html>