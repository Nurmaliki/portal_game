
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
        <script type="text/javascript" src="js/createjs-2015.11.26.min.js"></script>
        <script type="text/javascript" src="js/ctl_utils.js"></script>
        <script type="text/javascript" src="js/sprite_lib.js"></script>
        <script type="text/javascript" src="js/settings.js"></script>
        <script type="text/javascript" src="js/CLang.js"></script>
        <script type="text/javascript" src="js/CPreloader.js"></script>
        <script type="text/javascript" src="js/CMain.js"></script>
        <script type="text/javascript" src="js/CTextButton.js"></script>
        <script type="text/javascript" src="js/CTextToggle.js"></script>
        <script type="text/javascript" src="js/CToggle.js"></script>
        <script type="text/javascript" src="js/CNumToggle.js"></script>
        <script type="text/javascript" src="js/CGfxButton.js"></script>
        <script type="text/javascript" src="js/CMenu.js"></script>
        <script type="text/javascript" src="js/CGame.js"></script>
        <script type="text/javascript" src="js/CInterface.js"></script>
        <script type="text/javascript" src="js/CHelpPanel.js"></script>
        <script type="text/javascript" src="js/CGameOver.js"></script>
        <script type="text/javascript" src="js/CPause.js"></script>
        <script type="text/javascript" src="js/CAreYouSurePanel.js"></script>
        <script type="text/javascript" src="js/CBlock.js"></script>
        <script type="text/javascript" src="js/CGameField.js"></script>
        <script type="text/javascript" src="js/CCell.js"></script>
        <script type="text/javascript" src="js/CNextBlockBoard.js"></script>
        <script type="text/javascript" src="js/CNextBlock.js"></script>
        <script type="text/javascript" src="js/CInfoBoard.js"></script>
        <script type="text/javascript" src="js/CScoreBoard.js"></script>
        <script type="text/javascript" src="js/CController.js"></script>
        <script type="text/javascript" src="js/CEdges.js"></script>


    </head>
    <body ondragstart="return false;" ondrop="return false;" >
        <div style="position: fixed; background-color: transparent; top: 0px; left: 0px; width: 100%; height: 100%"></div>
        <script>
            $(document).ready(function () {
                var oMain = new CMain({
                    level_up_lines: 10, //EVERY N LINES IS FILL 
                    score_line: [40, 100, 300, 1200], //ADD THIS VALUE TO SCORE WHEN DESTROY LINES
                    blocks_occurence: [19, 19, 19, 12, 12, 7, 11], //BLOCKS SPAWN OCCURENCE 
                    start_refresh_game: 1,
                    min_refresh_game: 0.05, //MINIUM REFRESH FOR GAME UPDATE (MAX VELOCITY OF GAME)
                    step_decrease_refresh_game: 0.25, //EVERY LEVEL UP REFRESH VALUE IS DECREASE 
                    num_levels_for_ads: 3 //NUMBER OF TURNS PLAYED BEFORE AD SHOWING //
                            //////// THIS FEATURE  IS ACTIVATED ONLY WITH CTL ARCADE PLUGIN./////////////////////////// 
                            /////////////////// YOU CAN GET IT AT: ///////////////////////////////////////////////////////// 
                            // http://codecanyon.net/item/ctl-arcade-wordpress-plugin/13856421///////////
                });

                $(oMain).on("start_session", function (evt) {
                    if (getParamValue('ctl-arcade') === "true") {
                        parent.__ctlArcadeStartSession();
                    }
                });

                $(oMain).on("end_session", function (evt) {
                    if (getParamValue('ctl-arcade') === "true") {
                        parent.__ctlArcadeEndSession();
                    }
                });

                $(oMain).on("start_level", function (evt, iLevel) {
                    if (getParamValue('ctl-arcade') === "true") {
                        parent.__ctlArcadeStartLevel({level: iLevel});
                    }
                });

                $(oMain).on("end_level", function (evt, iLevel) {
                    if (getParamValue('ctl-arcade') === "true") {
                        parent.__ctlArcadeEndLevel({level: iLevel});
                    }
                });

                $(oMain).on("restart_level", function (evt, iLevel) {
                    if (getParamValue('ctl-arcade') === "true") {
                        parent.__ctlArcadeRestartLevel({level: iLevel});
                    }
                });

                $(oMain).on("save_score", function (evt, iScore) {
                    if (getParamValue('ctl-arcade') === "true") {
                        parent.__ctlArcadeSaveScore({score: iScore});
                    }
                });

                $(oMain).on("show_interlevel_ad", function (evt) {
                    if (getParamValue('ctl-arcade') === "true") {
                        parent.__ctlArcadeShowInterlevelAD();
                    }
                });

                $(oMain).on("share_event", function (evt, iScore) {
                    if (getParamValue('ctl-arcade') === "true") {
                        parent.__ctlArcadeShareEvent({img: TEXT_SHARE_IMAGE,
                            title: TEXT_SHARE_TITLE,
                            msg: TEXT_SHARE_MSG1 + iScore
                                    + TEXT_SHARE_MSG2,
                            msg_share: TEXT_SHARE_SHARE1
                                    + iScore + TEXT_SHARE_SHARE1});
                    }
                });

                if (isIOS()) {
                    setTimeout(function () {
                        sizeHandler();
                    }, 200);
                } else {
                    sizeHandler();
                }
            });

        </script>
        <canvas id="canvas" class='ani_hack' width="960" height="1440"> </canvas>

        <div id="block_game" style="position: fixed; background-color: transparent; top: 0px; left: 0px; width: 100%; height: 100%; display:none"></div>

    </body>
</html>