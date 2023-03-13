<?php
header('Content-Type: application/json; charset=UTF-8');
include_once('./includes/dbopen.php');



$ContentAcidRainID = isset($_REQUEST["ContentAcidRainID"]) ? $_REQUEST["ContentAcidRainID"] : "";
$resultNum = isset($_REQUEST["resultNum"]) ? $_REQUEST["resultNum"] : "";
$ArrAcidRainActivityWord = isset($_REQUEST["ArrAcidRainActivityWord"]) ? $_REQUEST["ArrAcidRainActivityWord"] : "";
$MemberID = isset($_REQUEST["MemberID"]) ? $_REQUEST["MemberID"] : 1;
$writeList = isset($_REQUEST["writeList"]) ? $_REQUEST["writeList"] : "";

if(isset($ArrAcidRainActivityWord) && isset($writeList)){

     $ArrAcidRainActivityWord =  json_encode($ArrAcidRainActivityWord);
     $writeList = json_encode($writeList);

    $Sql = "INSERT into AcidRainResults(
        ContentAcidRainID,
        ContentAcidRainActivityWordList,
        MemberID,
        MemberWriteWordList,
        AcidRainResultNum,
        AcidRainResultModiDateTime,
        AcidRainResultRegDateTime,
        AcidRainResultState
        )VALUES(
        :ContentAcidRainID,
        :ContentAcidRainActivityWordList,
        :MemberID,
        :MemberWriteWordList,
        :AcidRainResultNum,
        NOW(),
        NOW(),
        1
        );";
        			
    $Stmt = $DbConn_Box->prepare($Sql);
    $Stmt->bindParam(':ContentAcidRainID', $ContentAcidRainID);
    $Stmt->bindParam(':ContentAcidRainActivityWordList', $ArrAcidRainActivityWord);
    $Stmt->bindParam(':MemberID', $MemberID);
    $Stmt->bindParam(':MemberWriteWordList', $writeList);
    $Stmt->bindParam(':AcidRainResultNum', $resultNum);
    $Stmt->execute();
    $Stmt = null;
}





$ArrValue["ResultValue"] = 1;

$QueryResult = my_json_encode($ArrValue);
echo $QueryResult; 

function my_json_encode($arr){
	//convmap since 0x80 char codes so it takes all multibyte codes (above ASCII 127). So such characters are being "hidden" from normal json_encoding
	array_walk_recursive($arr, function (&$item, $key) { if (is_string($item)) $item = mb_encode_numericentity($item, array (0x80, 0xffff, 0, 0xffff), 'UTF-8'); });
	return mb_decode_numericentity(json_encode($arr), array (0x80, 0xffff, 0, 0xffff), 'UTF-8');
}

include_once('./includes/dbclose.php');
?>