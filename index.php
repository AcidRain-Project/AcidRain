<!DOCTYPE html>
<?php
include_once('./includes/dbopen.php');
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
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

shuffle($ContentAcidRainActivityWord);
// 활성 단어수 만큼 줄이기 
$ContentAcidRainActivityWord = array_slice($ContentAcidRainActivityWord,0,$ContentAcidRainActivityWordNumbers);

// echo count($ContentAcidRainActivityWord);

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
                            <!-- <span name="word_list"></span> -->
                            <?for($i=0; $i<10; $i++){?>
                                <span id=word_<?=$i?>><?=$ContentAcidRainActivityWord[$i];?></span>
                            <?}?>
       
                        </div>
                    </div>

                    <div class="info_box">
                        <div class="score_text"></div>
                        <!-- 10% => style="width: calc(100% - 90%);
                             90% => style="width: calc(100% - 10%); -->
                        <div id="time" class="score_time">
                            <img class="score_time_img" src="images/lv_bar_01.png">
                            <div class="score_bar_inner" style="width: calc(100% - 0%);"></div>
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
    <div class="save_wrap" style="display: ;">
        <div class="save_area">
            <div class="save_img">
                <img class="pass_img" src="images/pass.png" style="display: ">
            </div>
            <div class="save_btns">
                <button>Retry</button>
                <button>Next</button>
            </div>
        </div>
    </div>

    

</body>

<script>
    $(document).ready(function(){

    });
    /*  시간,스코어 논의 필요
        맞춰야 되는 스코어 DB
        바다에 빠지면 -1
        맞추면 + 1 
        맞추지 못하면 0
        
    */
    let AcidRainBgImage = '<?=$ContentAcidRainBgImage?>';
    let AcidRainSuccessScore = <?=$ContentAcidRainSuccessScore?>;
    let AcidRainActivityWordNumbers = <?=$ContentAcidRainActivityWordNumbers?>;
    let AcidRainActivityWordList = '<?=$ContentAcidRainActivityWordList?>';
    let AcidRainActivityWord = '<?= json_encode($ContentAcidRainActivityWord) ?>';
    
    AcidRainActivityWord = AcidRainActivityWord.replaceAll("\"","");
    AcidRainActivityWord = AcidRainActivityWord.replaceAll("[","");
    AcidRainActivityWord = AcidRainActivityWord.replaceAll("]","");

    // 총 단어 배열 
    let ArrAcidRainActivityWord = (AcidRainActivityWord.split(','));
    //  현대 단어 10개
    let NowArrAcidRainActivityWord = ArrAcidRainActivityWord.slice(0,9);
    // 다음 단어 배열
    let NextArrAcidRainActivityWord = ArrAcidRainActivityWord.slice(10);

    console.log(ArrAcidRainActivityWord);
    console.log(NowArrAcidRainActivityWord);
    console.log(NextArrAcidRainActivityWord);
    
    
    let view_inner = document.querySelector('.view_inner'); // 상단 단어 리스트 
    let save_area = document.querySelector('.save_area'); // 끝났을때 이미지
    let save_img = document.querySelector('.save_img'); // 끝났을때 이미지
    let gameArea = document.querySelector(".game_area"); // 단어 내려오는 배경
    
    
    let newWord = [];

    // word의 각 글자마다 top을 주기위한 배열 초기화
    let wordTop = new Array(ArrAcidRainActivityWord.length);
    for(let i = 0; i < wordTop.length; i++){
        wordTop[i] = 0;
    }

    // div는 100%이기 때문에 글자 div 크기를 고정으로 주기 위한 변수
    const WORDWIDTH = 0;
    const WORDHEIGHT = 0;

    // 그려지는 것 보다 내려오는게 간격이 더 짧게 함
    const DRAWTIME = 1500; // 3000이 적당해 보임
    // 내려오는 속도
    const DOWNTIME = 750;

    // 제한 시간
    const STOPTIME = 30000; // 30초

    // 점수
    const FAILSCORE = -2;
    let score = 0;
    let bar_score = 0;

    let scoreText = document.querySelector(".score_text");
    let score_bar = document.querySelector(".score_bar_inner"); // 점수 바
    scoreText.innerHTML = "Score : " + score + " / " + AcidRainSuccessScore;

    
    function start(){
        // word배열의 index 값에 대한 변수
        let idx = 0;
        
       /*  let randomWord = 0;
        let temp = null;
        랜덤으로 word 배열을 섞어주기 위한 for문
        for(let i = 0; i < ArrAcidRainActivityWord.length; i++){

            randomWord = Math.round(Math.random() * (ArrAcidRainActivityWord.length - 1));
            temp = ArrAcidRainActivityWord[randomWord];
            ArrAcidRainActivityWord[randomWord] = ArrAcidRainActivityWord[i];
            ArrAcidRainActivityWord[i] = temp;
        } */
            
        
        // 일정한 간격으로 화면에 단어를 하나씩 뿌려주기 위한 메서드
        let drawInterval = setInterval(function(){
            
            var leftWidth = Math.round(Math.random() * 90);
            var wordDiv = document.createElement("div");
            wordDiv.style.width = WORDWIDTH + "px";
            wordDiv.style.height = WORDHEIGHT + "px";
            wordDiv.style.position = "absolute";
            wordDiv.style.textAlign = "center";
            // wordDiv.style.border="1px solid #000";
            // wordDiv.style.display="inline";

            // 폰트사이즈
            var sizeChange = gameArea.clientWidth;
                if(sizeChange <= 938){
                    wordDiv.style.fontSize = 14 + "px"
                }else if(sizeChange >= 939 && sizeChange <= 1249){
                    wordDiv.style.fontSize = 18 + "px"
                }else if(sizeChange >= 1250 && sizeChange <= 1640){
                    wordDiv.style.fontSize = 22 + "px"
                }else{
                    wordDiv.style.fontSize = 24 + "px"
                }

            
            // 리스트 하나씩 삭제
            $("#word_"+idx+"").addClass("active");
            
            
            // 다음 리스트 추가 
            if(NextArrAcidRainActivityWord[idx] !== undefined){
                let view_wordSpan = document.createElement('span');
                let next_idx = 10+idx;
                view_wordSpan.setAttribute('id', 'word_'+next_idx)
                view_wordSpan.innerHTML= NextArrAcidRainActivityWord[idx];
                view_inner.appendChild(view_wordSpan);
            }
            
            //단어 비 내림
            wordDiv.innerHTML = ArrAcidRainActivityWord[idx++];
            gameArea.appendChild(wordDiv);

            // 글자 width 값 까지 더하게 되면 gameArea의 범위를 넘어갈 수 있기때문에 안넘어가게 하기 위한 재설정
            if(leftWidth + WORDWIDTH >= gameArea.clientWidth){
                wordDiv.style.left = (leftWidth - WORDWIDTH) + "%";
            }else{
                wordDiv.style.left = leftWidth + "%";
            }

            newWord.push(wordDiv);

            // 글자가 다 뿌려지면 setInterval() 중지
            if(newWord.length === ArrAcidRainActivityWord.length){
                clearInterval(drawInterval)
            }
        }, DRAWTIME);
        

        // 일정한 간격으로 글자를 내려줌.
        let downInterval = setInterval(function(){
            for(let i = 0; i < ArrAcidRainActivityWord.length; i++){
                
                if(i < newWord.length){
                    newWord[i].style.top = wordTop[i] + "px";
                    
                    // 글자의 범위가 gameArea 바깥으로 나갔을 경우 제거
                    if(wordTop[i] + WORDHEIGHT >= gameArea.offsetHeight){
                        if(gameArea.contains(newWord[i])) {
                            
                            gameArea.removeChild(newWord[i]);
                            score -=1 ;
                            if(score <= -1){
                                bar_score = 0; 
                            }else{
                                bar_score -= 10;
                            } 
                            
                            scoreText.innerHTML = "Score : " + score + " / " + AcidRainSuccessScore;
                            score_bar.style = "width: calc(100% - "+bar_score+"%);";

                            // 정한 갯수만큼 실패 
                            if(score == FAILSCORE){     
                                gameEnd(drawInterval,downInterval,2);
                            }
                        }
                    }
                    wordTop[i] += 40;
                }
            }
        }, DOWNTIME);
        

    

        var textInput = document.querySelector(".text_input");
        textInput.addEventListener("keydown", function (e) {
            // enter 눌렀을 때
            let DivisionNum = 0;
            
            if(e.keyCode === 13){
                for(let i = 0; i < newWord.length; i++){
                    // 타자 친 단어와 화면의 단어가 일치했을 때
                    if(textInput.value.toLowerCase() === newWord[i].innerHTML.toLowerCase()){
                        gameArea.removeChild(newWord[i]);
                        console.log('Right');
                        score += 1;
                        bar_score += 10;
                        scoreText.innerHTML = "Score : " + score + " / " + AcidRainSuccessScore;
                        score_bar.style = "width: calc(100% - "+bar_score+"%);";

                        if(score == AcidRainSuccessScore){
                            gameEnd(drawInterval,downInterval,1);
                        }
                        DivisionNum = 1;
                    } 
                }    

                // 틀렸을 때
                if(DivisionNum == 0){
                    /* sy 틀렸을때 효과 추가  */
                    console.log('Wrong');
                }
                
                textInput.value = "";
            }
        }); //addEventListener

        // 30초 지났을때 실패 
        let timeout = setTimeout(() => {
            gameEnd(drawInterval,downInterval,2,timeout);
        }, STOPTIME);

        function gameEnd(drawInterval,downInterval,resultNum){
            clearInterval(drawInterval);
            clearInterval(downInterval);
            clearTimeout(timeout)
            save_area.style = "display:";

            if(resultNum === 2){ // 실패
                save_img.src = "images/fail.png";
            }else{ // 성공
                save_img.src = "images/pass.png";
            }
        }
    }// start

    
    

    function nextStep (){
        alert('next');
        location.reload();
    }

    function Replay(){
        location.reload();
    }


    function resultSave(){

    }

    // 클릭 횟수에 대한 변수
    var count = 0;
    // 게임시작 버튼
    var textButton = document.querySelector(".text_button");
    textButton.addEventListener("click", function(){
        console.log('go');
        if (count === 0){
            start();
        }
        count++;
    });

</script>

<?php
// include_once('./js/script.js');
include_once('./includes/dbclose.php');
?>