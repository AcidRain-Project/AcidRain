<!DOCTYPE html>
<?php
include_once('../../../includes/dbopen.php');
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>산성비 게임</title>
    <link href="css/common.css" rel="stylesheet">
    <style>
        html, body{ height: 100%;}
    </style>
</head>
<?
$CourseBookContentBankID = isset($_REQUEST["CourseBookContentBankID"]) ? $_REQUEST["CourseBookContentBankID"] : 1;

$Sql = "SELECT * FROM ContentAcidRains where CourseBookContentBankID=:CourseBookContentBankID";
$Stmt = $DbConn_Box->prepare($Sql);
$Stmt->bindParam(':CourseBookContentBankID', $CourseBookContentBankID);
$Stmt->execute();
$Stmt->setFetchMode(PDO::FETCH_ASSOC);
$Row = $Stmt->fetch();
$Stmt = null;

$ContentAcidRainID = $Row["ContentAcidRainID"];
$ContentAcidRainBgImage = $Row["ContentAcidRainBgImage"];
$ContentAcidRainSuccessScore = $Row["ContentAcidRainSuccessScore"];
$ContentAcidRainActivityWordNumbers = $Row["ContentAcidRainActivityWordNumbers"];
$ContentAcidRainActivityWordList = $Row["ContentAcidRainActivityWordList"];

$ContentAcidRainActivityWord = explode("|", $ContentAcidRainActivityWordList);

// echo $ContentAcidRainSuccessScore;

?>
<body>
    <!-- 다른 배경이미지로 변경시 main_wrap의 background-images url을 변경 -->
    <div class="main_wrap" style="background-image: url(images/main_bg01.png);">
        <div class="main_bg" style="background-image: url(images/main_bg_1080.png);">

            <div class="header_wrap" style="display: ;">
                <div class="header_area">
                    <div class="view_box">
                        <div class="view_inner">
                            <!-- span class="active" 보기 사라짐 -->
                            
                            <?for($i=0; $i<$ContentAcidRainActivityWordNumbers; $i++){?>
                                <span><?=$ContentAcidRainActivityWord[$i];?></span>
                            <?}?>
                            <!-- <span>Banana</span>
                            <span>Cute</span>
                            <span>Desgine</span>
                            <span>Egg</span>
                            <span>Fire</span>
                            <span>Great</span>
                            <span>Hill</span>
                            <span>Ice</span>
                            <span>Juice</span> -->
                        </div>
                    </div>

                    <div class="info_box">
                        <div class="score_text"></div>
                        <!-- 10% => style="width: calc(100% - 90%);
                             90% => style="width: calc(100% - 10%); -->
                        <div id="time" class="score_time">
                            <img class="score_time_img" src="images/lv_bar_01.png">
                            <div class="score_bar_inner" style="width: calc(100% - 30%);"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="game_wrap">
                <div class="game_area"></div>
                
                <div class="textbox">
                    <div class="textbox_wrap">
                        <input class="text_input" type="text">
                        <button class="text_button">게임시작</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 성공, 실패 팝업 -->
    <div class="save_wrap" style="display: none;">
        <img class="save_img pass" src="images/pass.png" style="display: ;">
        <img class="save_img fail" src="images/fail.png" style="display: none;">
    </div>

<script>
        ContentAcidRainSuccessScore = '<?=$ContentAcidRainSuccessScore?>';
        var score = 0;
        var scoreText = document.querySelector(".score_text");
        scoreText.innerHTML = "Score : " + score + " / " + ContentAcidRainSuccessScore;

</script>
    


<script src= "js/script.js"></script>
</body>


<?php
include_once('../../../includes/dbclose.php');
?>