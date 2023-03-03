var word = ["Apple", "Banana", "Cute", "Desgine", "Egg", "Fire", "Great", "Hill", "Ice", "Juice", "Korea", "Libray", "Mom", "Next", "Original", "Pixel", "Question", "Rule", "System", "Teach", "User", "Very", "World", "Xmas", "Youth", "Zoo"];

var gameArea = document.querySelector(".game_area");
var newWord = [];

// word의 각 글자마다 top을 주기위한 배열 초기화
var wordTop = new Array(word.length);
for(let i = 0; i < wordTop.length; i++){
    wordTop[i] = 0;
}

// div는 100%이기 때문에 글자 div 크기를 고정으로 주기 위한 변수
const WORDWIDTH = 0;
const WORDHEIGHT = 0;

// 그려지는 것 보다 내려오는게 간격이 더 짧게 함
const DRAWTIME = 1500;

// 내려오는 속도
const DOWNTIME = 750;

// 점수
var score = 0;
var scoreText = document.querySelector(".score_text");
scoreText.innerHTML = "Score : " + score;

// word배열의 index 값에 대한 변수
var idx = 0;

// 화면에 글자를 뿌려주기 위한 메서드
function draw(){
    var randomWord = 0;
    var temp = null;

    // 랜덤으로 word 배열을 섞어주기 위한 for문
    for(let i = 0; i < word.length; i++){
        randomWord = Math.round(Math.random() * (word.length - 1));
        temp = word[randomWord];
        word[randomWord] = word[i];
        word[i] = temp;
    }

   // 일정한 간격으로 화면에 단어를 하나씩 뿌려주기 위한 setInteval 메서드
    var drawInterval = setInterval(function(){
        var leftWidth = Math.round(Math.random() * 100);
        console.log(leftWidth);
        var wordDiv = document.createElement("div");
        wordDiv.style.width = WORDWIDTH + "px";
        wordDiv.style.height = WORDHEIGHT + "px";
        wordDiv.style.position = "absolute";
        wordDiv.style.textAlign = "center";
        wordDiv.style.border="1px solid #000";
        //wordDiv.style.display="inline";

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

        wordDiv.innerHTML = word[idx++];
        gameArea.appendChild(wordDiv);


        // 글자 width 값 까지 더하게 되면 gameArea의 범위를 넘어갈 수 있기때문에 안넘어가게 하기 위한 재설정
 
        if(leftWidth + WORDWIDTH >= gameArea.clientWidth){
            wordDiv.style.left = (leftWidth - WORDWIDTH) + "%";
        }else{
            wordDiv.style.left = leftWidth + "%";
        }

        newWord.push(wordDiv);

        // 글자가 다 뿌려지면 setInterval() 중지
        if(newWord.length === word.length){
            clearInterval(drawInterval);
        }
    }, DRAWTIME);
}


// 글자를 내려주기 위한 메서드
function down(){
    // 일정한 간격으로 글자를 내려줌.
    setInterval(function(){
        for(let i = 0; i < word.length; i++){
            if(i < newWord.length){
                newWord[i].style.top = wordTop[i] + "px";
                // 글자의 범위가 gameArea 바깥으로 나갔을 경우 제거
                if(wordTop[i] + WORDHEIGHT >= gameArea.offsetHeight){
                    if(gameArea.contains(newWord[i])) {
                        gameArea.removeChild(newWord[i]);
                    }
                }
                wordTop[i] += 40;
            }
        }
    }, DOWNTIME);

}

var textInput = document.querySelector(".text_input");
textInput.addEventListener("keydown", function (e) {
    // enter 눌렀을 때
    if(e.keyCode === 13){
        for(let i = 0; i < newWord.length; i++){
            // 타자 친 단어와 화면의 단어가 일치했을 때
            if(textInput.value.toLowerCase() === newWord[i].innerHTML.toLowerCase()){
                gameArea.removeChild(newWord[i]);
                score += 5;
                scoreText.innerHTML = "Score : " + score;
            }
        }
        // enter 눌렀을 때 input 창 초기화
        textInput.value = "";
    }
});

// 클릭 횟수에 대한 변수
var count = 0;

// 게임시작 버튼
var textButton = document.querySelector(".text_button");
textButton.addEventListener("click", function(){
    if (count === 0){
        draw();
        down();
    }
    count++;
});