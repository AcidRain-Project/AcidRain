<?php
include_once('../includes/dbopen.php');
include_once('../includes/common.php');
include_once('./inc_header.php');
?>

</head>
<body style="padding:20px;">

<?php
$CourseBookContentBankID = isset($_REQUEST["CourseBookContentBankID"]) ? $_REQUEST["CourseBookContentBankID"] : "";


$Sql = "
		select 
				count(*) as EbookExistCount
		from ContentEbookPlusSets A 
		where A.CourseBookContentBankID=:CourseBookContentBankID";
$Stmt = $DbConn_Box->prepare($Sql);
$Stmt->bindParam(':CourseBookContentBankID', $CourseBookContentBankID);
$Stmt->execute();
$Stmt->setFetchMode(PDO::FETCH_ASSOC);
$Row = $Stmt->fetch();
$Stmt = null;
$EbookExistCount = $Row["EbookExistCount"];

$Sql = "
		select 
				count(*) as EbookListCount
		from ContentEbookPluss A 
		where A.CourseBookContentBankID=:CourseBookContentBankID and A.ContentEbookPlusState=1";
$Stmt = $DbConn_Box->prepare($Sql);
$Stmt->bindParam(':CourseBookContentBankID', $CourseBookContentBankID);
$Stmt->execute();
$Stmt->setFetchMode(PDO::FETCH_ASSOC);
$Row = $Stmt->fetch();
$Stmt = null;
$EbookListCount = $Row["EbookListCount"];



if ($EbookExistCount!=0){
	$Sql = "
			select 
					A.*
			from ContentEbookPlusSets A 
			where A.CourseBookContentBankID=:CourseBookContentBankID";
	$Stmt = $DbConn_Box->prepare($Sql);
	$Stmt->bindParam(':CourseBookContentBankID', $CourseBookContentBankID);
	$Stmt->execute();
	$Stmt->setFetchMode(PDO::FETCH_ASSOC);
	$Row = $Stmt->fetch();
	$Stmt = null;

	$ContentEbookPlusSetSkinID = $Row["ContentEbookPlusSetSkinID"];
	$ContentEbookPlusSetPageType = $Row["ContentEbookPlusSetPageType"];
	$ContentEbookPlusSetScaleType = $Row["ContentEbookPlusSetScaleType"];
	$ContentEbookPlusSetPageTurnType = $Row["ContentEbookPlusSetPageTurnType"];
	$ContentEbookPlusSetDownPdf = $Row["ContentEbookPlusSetDownPdf"];
	$ContentEbookPlusSetRecord = $Row["ContentEbookPlusSetRecord"];
	$ContentEbookPlusSetDraw = $Row["ContentEbookPlusSetDraw"];
	$ContentEbookPlusSetLibrary = $Row["ContentEbookPlusSetLibrary"];
	$ContentEbookPlusSetPdfFileName = $Row["ContentEbookPlusSetPdfFileName"];
	$ContentEbookPlusSetPdfFileRealName = $Row["ContentEbookPlusSetPdfFileRealName"];
	$ContentEbookPlusSetBookImageName = $Row["ContentEbookPlusSetBookImageName"];
	$ContentEbookPlusCode = $Row["ContentEbookPlusCode"];
}else{
	$ContentEbookPlusSetSkinID = 1;
	$ContentEbookPlusSetPageType = 1;
	$ContentEbookPlusSetScaleType = 1;
	$ContentEbookPlusSetPageTurnType = 1;
	$ContentEbookPlusSetDownPdf = 0;
	$ContentEbookPlusSetRecord = 0;
	$ContentEbookPlusSetDraw = 0;
	$ContentEbookPlusSetLibrary = 0;
	$ContentEbookPlusSetPdfFileName = "";
	$ContentEbookPlusSetPdfFileRealName = "";
	$ContentEbookPlusSetBookImageName = "";
	$ContentEbookPlusCode = "";
}

$ContentEbookPlusSetScaleType_1 = $ContentEbookPlusSetScaleType;
$ContentEbookPlusSetScaleType_2 = $ContentEbookPlusSetScaleType;


$StrContentEbookPlusSetBookImageName = "../images/logo_sample.png";
if ($ContentEbookPlusSetBookImageName!="") {
	$StrContentEbookPlusSetBookImageName = "../uploads/content_ebook_plus_images/" . $ContentEbookPlusSetBookImageName;
}
?>

<h1 class="Title" style="margin-bottom:20px;">E-BOOK 설정</h1>

<?
$ContentEbookPlusTabID = 2;
include_once('./inc_content_ebook_plus_tab.php');
?>
<form id="RegForm" name="RegForm" method="post" enctype="multipart/form-data" accept-charset="UTF-8" autocomplete="off">
<input type="hidden" name="CourseBookContentBankID" value="<?=$CourseBookContentBankID?>">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_form" style="margin-bottom:15px;">

  <tr style="display:;">
	<th>코드<span></span></th>
	<td class="radio">
		<?if ($ContentEbookPlusCode==""){?>
			설정을 저장하면 생성됩니다.
		<?}else{?>
			<?=$ContentEbookPlusCode?>
		<?}?>
	</td>
  </tr>


  <tr style="display:;">
	<th>스킨선택<span></span></th>
	<td class="radio" style="line-height:2;">
		<input type="radio" name="ContentEbookPlusSetSkinID" id="ContentEbookPlusSetSkinID1" value="1" <?php if ($ContentEbookPlusSetSkinID==1) {echo ("checked");}?> > <label for="ContentEbookPlusSetSkinID1"><span></span>1번</label>
        
		<input type="radio" name="ContentEbookPlusSetSkinID" id="ContentEbookPlusSetSkinID2" value="2" <?php if ($ContentEbookPlusSetSkinID==2) {echo ("checked");}?> > <label for="ContentEbookPlusSetSkinID2"><span></span>2번</label>
        
		<input type="radio" name="ContentEbookPlusSetSkinID" id="ContentEbookPlusSetSkinID3" value="3" <?php if ($ContentEbookPlusSetSkinID==3) {echo ("checked");}?> > <label for="ContentEbookPlusSetSkinID3"><span></span>3번</label>
        
		<input type="radio" name="ContentEbookPlusSetSkinID" id="ContentEbookPlusSetSkinID4" value="4" <?php if ($ContentEbookPlusSetSkinID==4) {echo ("checked");}?> > <label for="ContentEbookPlusSetSkinID4"><span></span>4번</label>
        
		<input type="radio" name="ContentEbookPlusSetSkinID" id="ContentEbookPlusSetSkinID5" value="5" <?php if ($ContentEbookPlusSetSkinID==5) {echo ("checked");}?> > <label for="ContentEbookPlusSetSkinID5"><span></span>5번</label>
        
        <input type="radio" name="ContentEbookPlusSetSkinID" id="ContentEbookPlusSetSkinID6" value="6" <?php if ($ContentEbookPlusSetSkinID==6) {echo ("checked");}?> > <label for="ContentEbookPlusSetSkinID6"><span></span>6번</label>      
                
        <input type="radio" name="ContentEbookPlusSetSkinID" id="ContentEbookPlusSetSkinID7" value="7" <?php if ($ContentEbookPlusSetSkinID==7) {echo ("checked");}?> > <label for="ContentEbookPlusSetSkinID7"><span></span>7번</label>      
                
        <input type="radio" name="ContentEbookPlusSetSkinID" id="ContentEbookPlusSetSkinID8" value="8" <?php if ($ContentEbookPlusSetSkinID==8) {echo ("checked");}?> > <label for="ContentEbookPlusSetSkinID8"><span></span>8번</label>
        
        <br>
        
        <input type="radio" name="ContentEbookPlusSetSkinID" id="ContentEbookPlusSetSkinID9" value="9" <?php if ($ContentEbookPlusSetSkinID==9) {echo ("checked");}?> > <label for="ContentEbookPlusSetSkinID9"><span></span>9번</label>
        
        <input type="radio" name="ContentEbookPlusSetSkinID" id="ContentEbookPlusSetSkinID10" value="10" <?php if ($ContentEbookPlusSetSkinID==10) {echo ("checked");}?> > <label for="ContentEbookPlusSetSkinID10"><span></span>10번</label>
        
        <input type="radio" name="ContentEbookPlusSetSkinID" id="ContentEbookPlusSetSkinID11" value="11" <?php if ($ContentEbookPlusSetSkinID==11) {echo ("checked");}?> > <label for="ContentEbookPlusSetSkinID11"><span></span>11번</label>
        
        <input type="radio" name="ContentEbookPlusSetSkinID" id="ContentEbookPlusSetSkinID12" value="12" <?php if ($ContentEbookPlusSetSkinID==12) {echo ("checked");}?> > <label for="ContentEbookPlusSetSkinID12"><span></span>12번(원바이트월드)</label>
        
        <input type="radio" name="ContentEbookPlusSetSkinID" id="ContentEbookPlusSetSkinID13" value="13" <?php if ($ContentEbookPlusSetSkinID==13) {echo ("checked");}?> > <label for="ContentEbookPlusSetSkinID13"><span></span>13번(FT)</label>


		<br>

		<input type="radio" name="ContentEbookPlusSetSkinID" id="ContentEbookPlusSetSkinID14" value="14" <?php if ($ContentEbookPlusSetSkinID==14) {echo ("checked");}?> > <label for="ContentEbookPlusSetSkinID14"><span></span>14번(EasyUtter - P1)</label>

		<input type="radio" name="ContentEbookPlusSetSkinID" id="ContentEbookPlusSetSkinID15" value="15" <?php if ($ContentEbookPlusSetSkinID==15) {echo ("checked");}?> > <label for="ContentEbookPlusSetSkinID15"><span></span>15번(EasyUtter - P2)</label>

		<input type="radio" name="ContentEbookPlusSetSkinID" id="ContentEbookPlusSetSkinID16" value="16" <?php if ($ContentEbookPlusSetSkinID==16) {echo ("checked");}?> > <label for="ContentEbookPlusSetSkinID16"><span></span>16번(EasyUtter - P3)</label>

		<br>

		<input type="radio" name="ContentEbookPlusSetSkinID" id="ContentEbookPlusSetSkinID17" value="17" <?php if ($ContentEbookPlusSetSkinID==17) {echo ("checked");}?> > <label for="ContentEbookPlusSetSkinID17"><span></span>17번(EasyUtter - P4)</label>

		<input type="radio" name="ContentEbookPlusSetSkinID" id="ContentEbookPlusSetSkinID18" value="18" <?php if ($ContentEbookPlusSetSkinID==18) {echo ("checked");}?> > <label for="ContentEbookPlusSetSkinID18"><span></span>18번(EasyUtter - P5)</label>

		<input type="radio" name="ContentEbookPlusSetSkinID" id="ContentEbookPlusSetSkinID19" value="19" <?php if ($ContentEbookPlusSetSkinID==19) {echo ("checked");}?> > <label for="ContentEbookPlusSetSkinID19"><span></span>19번(EasyUtter - P6)</label>

		<div>※ 이북이 EasyUtter 에 사용될 경우 어떤스킨을 지정해도 Phase 지정스킨이 적용됩니다.</div>

	</td>
  </tr>

  <tr>
	<th>
		표지 이미지<span></span>
	</th>
	<td class="upload" style="padding-bottom:20px;">
		<div class="right" style="float:left;">
			<div class="bg_logo" style="height:240px;">
				<input type="hidden" name="ContentEbookPlusSetBookImageName" value="<?=$ContentEbookPlusSetBookImageName?>" />
				<img src="<?=$StrContentEbookPlusSetBookImageName?>" id="ContentEbookPlusSetBookImageName" onerror="this.src='../images/logo_sample.png'" class="img" style="border:1px solid #cccccc; width:170px; height:170px;">
				<div class="btn_area"><a href="javascript:PopupUploadImage('ContentEbookPlusSetBookImageName','RegForm.ContentEbookPlusSetBookImageName','../uploads/content_ebook_plus_images');" class="rtn white">이미지 업로드</a></div>
			</div>
		</div>
			
		<?if ($ContentEbookPlusSetBookImageName!=""){?>
		<div style="display:bolck;padding-left:400px;margin-top:190px;">
		<input type="checkbox" name="DelContentEbookPlusSetBookImageName" id="DelContentEbookPlusSetBookImageName" value="1"> <label for="DelContentEbookPlusSetBookImageName"><span></span>삭제</label>
		</div>
		<?}?>

	</td>
  </tr>



  <tr style="display:;">
	<th>페이지 전환<span></span></th>
	<td class="radio">
		<input type="radio" name="ContentEbookPlusSetPageTurnType" id="ContentEbookPlusSetPageTurnType1" value="1" <?php if ($ContentEbookPlusSetPageTurnType==1) {echo ("checked");}?>> <label for="ContentEbookPlusSetPageTurnType1"><span></span>책넘김 효과</label>
		<input type="radio" name="ContentEbookPlusSetPageTurnType" id="ContentEbookPlusSetPageTurnType2" value="2" <?php if ($ContentEbookPlusSetPageTurnType==2) {echo ("checked");}?>> <label for="ContentEbookPlusSetPageTurnType2"><span></span>페이드 효과</label>
	</td>
  </tr>


  <tr style="display:;">
	<th>표시형식<span></span></th>
	<td class="radio">
		<input type="radio" name="ContentEbookPlusSetPageType" id="ContentEbookPlusSetPageType1" value="1" <?php if ($ContentEbookPlusSetPageType==1) {echo ("checked");}?> onclick="ChContentEbookPlusSetPageType(1)"> <label for="ContentEbookPlusSetPageType1"><span></span>단면</label>
		<input type="radio" name="ContentEbookPlusSetPageType" id="ContentEbookPlusSetPageType2" value="2" <?php if ($ContentEbookPlusSetPageType==2) {echo ("checked");}?> onclick="ChContentEbookPlusSetPageType(2)"> <label for="ContentEbookPlusSetPageType2"><span></span>양면</label>
	</td>
  </tr>

  <tr id="TrContentEbookPlusSetScaleType_1" style="display:<?if ($ContentEbookPlusSetPageType==2) {?>none<?}?>;">
	<th>이미지 비율<span></span></th>
	<td class="radio">
		<input type="radio" name="ContentEbookPlusSetScaleType_1" id="ContentEbookPlusSetScaleType_1_1" value="1" <?php if ($ContentEbookPlusSetScaleType_1==1) {echo ("checked");}?> > <label for="ContentEbookPlusSetScaleType_1_1"><span></span>2:1</label>
		<input type="radio" name="ContentEbookPlusSetScaleType_1" id="ContentEbookPlusSetScaleType_1_2" value="2" <?php if ($ContentEbookPlusSetScaleType_1==2) {echo ("checked");}?> > <label for="ContentEbookPlusSetScaleType_1_2"><span></span>8:3</label>
		<input type="radio" name="ContentEbookPlusSetScaleType_1" id="ContentEbookPlusSetScaleType_1_3" value="3" <?php if ($ContentEbookPlusSetScaleType_1==3) {echo ("checked");}?> > <label for="ContentEbookPlusSetScaleType_1_3"><span></span>6:4</label>
		<input type="radio" name="ContentEbookPlusSetScaleType_1" id="ContentEbookPlusSetScaleType_1_4" value="4" <?php if ($ContentEbookPlusSetScaleType_1==4) {echo ("checked");}?> > <label for="ContentEbookPlusSetScaleType_1_4"><span></span>32:9</label>
		<input type="radio" name="ContentEbookPlusSetScaleType_1" id="ContentEbookPlusSetScaleType_1_5" value="5" <?php if ($ContentEbookPlusSetScaleType_1==5) {echo ("checked");}?> > <label for="ContentEbookPlusSetScaleType_1_5"><span></span>18:16</label>
		<input type="radio" name="ContentEbookPlusSetScaleType_1" id="ContentEbookPlusSetScaleType_1_6" value="6" <?php if ($ContentEbookPlusSetScaleType_1==6) {echo ("checked");}?> > <label for="ContentEbookPlusSetScaleType_1_6"><span></span>17:10</label>
	</td>
  </tr>

  <tr id="TrContentEbookPlusSetScaleType_2" style="display:<?if ($ContentEbookPlusSetPageType==1) {?>none<?}?>;">
	<th>이미지 비율<span></span></th>
	<td class="radio">
		<input type="radio" name="ContentEbookPlusSetScaleType_2" id="ContentEbookPlusSetScaleType_2_1" value="1" <?php if ($ContentEbookPlusSetScaleType_2==1) {echo ("checked");}?> > <label for="ContentEbookPlusSetScaleType_2_1"><span></span>1:1</label>
		<input type="radio" name="ContentEbookPlusSetScaleType_2" id="ContentEbookPlusSetScaleType_2_2" value="2" <?php if ($ContentEbookPlusSetScaleType_2==2) {echo ("checked");}?> > <label for="ContentEbookPlusSetScaleType_2_2"><span></span>4:3</label>
		<input type="radio" name="ContentEbookPlusSetScaleType_2" id="ContentEbookPlusSetScaleType_2_3" value="3" <?php if ($ContentEbookPlusSetScaleType_2==3) {echo ("checked");}?> > <label for="ContentEbookPlusSetScaleType_2_3"><span></span>3:4</label>
		<input type="radio" name="ContentEbookPlusSetScaleType_2" id="ContentEbookPlusSetScaleType_2_4" value="4" <?php if ($ContentEbookPlusSetScaleType_2==4) {echo ("checked");}?> > <label for="ContentEbookPlusSetScaleType_2_4"><span></span>16:9</label>
		<input type="radio" name="ContentEbookPlusSetScaleType_2" id="ContentEbookPlusSetScaleType_2_5" value="5" <?php if ($ContentEbookPlusSetScaleType_2==5) {echo ("checked");}?> > <label for="ContentEbookPlusSetScaleType_2_5"><span></span>9:16</label>
		<input type="radio" name="ContentEbookPlusSetScaleType_2" id="ContentEbookPlusSetScaleType_2_6" value="6" <?php if ($ContentEbookPlusSetScaleType_2==6) {echo ("checked");}?> > <label for="ContentEbookPlusSetScaleType_2_6"><span></span>20:21</label>
	</td>
  </tr>



  <tr style="display:;">
	<th>PDF 파일<span></span></th>
	<td class="radio">
	
		<input type="hidden" name="ContentEbookPlusSetPdfFileName" value="<?=$ContentEbookPlusSetPdfFileName?>" />
		<input type="hidden" name="ContentEbookPlusSetPdfFileRealName" value="<?=$ContentEbookPlusSetPdfFileRealName?>" />

		<a href="javascript:PopupUploadPdf('BtnPreviewPdf', 'RegForm.ContentEbookPlusSetPdfFileName','RegForm.ContentEbookPlusSetPdfFileRealName','../uploads/content_ebook_plus_pdfs');" class="rtn white" style="width:200px;">PDF 파일 업로드</a>
		<a href="javascript:OpenPdf();" id="BtnPreviewPdf" class="rtn <?if ($ContentEbookPlusSetPdfFileName!=""){?>red<?}else{?>gray<?}?>" style="width:200px;">미리보기</a>
	</td>
  </tr>

  <tr style="display:;">
	<th>PDF 다운<span></span></th>
	<td class="radio">
		<input type="radio" name="ContentEbookPlusSetDownPdf" id="ContentEbookPlusSetDownPdf0" value="0" <?php if ($ContentEbookPlusSetDownPdf==0) {echo ("checked");}?>> <label for="ContentEbookPlusSetDownPdf0"><span></span>불가</label>
		<input type="radio" name="ContentEbookPlusSetDownPdf" id="ContentEbookPlusSetDownPdf1" value="1" <?php if ($ContentEbookPlusSetDownPdf==1) {echo ("checked");}?>> <label for="ContentEbookPlusSetDownPdf1"><span></span>허용</label>
	</td>
  </tr>

  <tr style="display:;">
	<th>녹음기능<span></span></th>
	<td class="radio">
		<input type="radio" name="ContentEbookPlusSetRecord" id="ContentEbookPlusSetRecord0" value="0" <?php if ($ContentEbookPlusSetRecord==0) {echo ("checked");}?>> <label for="ContentEbookPlusSetRecord0"><span></span>불가</label>
		<input type="radio" name="ContentEbookPlusSetRecord" id="ContentEbookPlusSetRecord1" value="1" <?php if ($ContentEbookPlusSetRecord==1) {echo ("checked");}?>> <label for="ContentEbookPlusSetRecord1"><span></span>허용</label>
	</td>
  </tr>

  <tr style="display:;">
	<th>필기기능<span></span></th>
	<td class="radio">
		<input type="radio" name="ContentEbookPlusSetDraw" id="ContentEbookPlusSetDraw0" value="0" <?php if ($ContentEbookPlusSetDraw==0) {echo ("checked");}?>> <label for="ContentEbookPlusSetDraw0"><span></span>불가</label>
		<input type="radio" name="ContentEbookPlusSetDraw" id="ContentEbookPlusSetDraw1" value="1" <?php if ($ContentEbookPlusSetDraw==1) {echo ("checked");}?>> <label for="ContentEbookPlusSetDraw1"><span></span>허용</label>
	</td>
  </tr>

  <tr style="display:;">
	<th>라이브러리 저장<span></span></th>
	<td class="radio">
		<input type="radio" name="ContentEbookPlusSetLibrary" id="ContentEbookPlusSetLibrary0" value="0" <?php if ($ContentEbookPlusSetLibrary==0) {echo ("checked");}?>> <label for="ContentEbookPlusSetLibrary0"><span></span>불가</label>
		<input type="radio" name="ContentEbookPlusSetLibrary" id="ContentEbookPlusSetLibrary1" value="1" <?php if ($ContentEbookPlusSetLibrary==1) {echo ("checked");}?>> <label for="ContentEbookPlusSetLibrary1"><span></span>허용</label>

		<div style="margin-top:20px;">
		※ 사용하는 사이트에 라이브러리 기능이 있을 때 작동합니다.
		</div>
	</td>
  </tr>

</table>
</form>

<div class="btn_center" style="padding-top:25px;">
	<?if ($EbookExistCount!=0){?>
	<a href="javascript:FormSubmit();" class="btn red">수정하기</a>
	<?}else{?>
	<a href="javascript:FormSubmit();" class="btn red">등록하기</a>
	<?}?>
	<a href="javascript:parent.$.fn.colorbox.close();" class="btn gray">닫기</a>
</div>
<script>
function PopupUploadImage(ImgID,FormName,UpPath){
	openurl = "./popup_course_book_content_ebook_plus_image_upload_form.php?ImgID="+ImgID+"&FormName="+FormName+"&UpPath="+UpPath;
	$.colorbox({	
		href:openurl
		,width:"500" 
		,height:"300"
		,title:""
		,iframe:true 
		,scrolling:false
		//,onClosed:function(){location.reload(true);}   
	}); 
}



function ChContentEbookPlusSetPageType(ContentEbookPlusSetPageType){
	if (ContentEbookPlusSetPageType==1){
		$("#TrContentEbookPlusSetScaleType_1").css("display", "");
		$("#TrContentEbookPlusSetScaleType_2").css("display", "none");
	}else{
		$("#TrContentEbookPlusSetScaleType_1").css("display", "none");
		$("#TrContentEbookPlusSetScaleType_2").css("display", "");
	}
}

function PopupUploadPdf(BtnPreview, FormNameFile, FormNameRealFile, UpPath){
	openurl = "./popup_ebook_plus_upload_form.php?BtnPreview="+BtnPreview+"&FormNameFile="+FormNameFile+"&FormNameRealFile="+FormNameRealFile+"&UpPath="+UpPath;
	$.colorbox({	
		href:openurl
		,width:"500" 
		,height:"300"
		,title:""
		,iframe:true 
		,scrolling:false
		//,onClosed:function(){location.reload(true);}   
	}); 
}

function OpenPdf(){

	ContentEbookPlusSetPdfFileName = document.RegForm.ContentEbookPlusSetPdfFileName.value;

	if (ContentEbookPlusSetPdfFileName==""){
		alert("등록된 파일이 없습니다.");
	}else{
		var iframe = "<html><head><style>body, html {width: 100%; height: 100%; margin: 0; padding: 0}</style></head><body><iframe src='../viewer_js/?zoom=auto#../uploads/content_ebook_plus_pdfs/"+ContentEbookPlusSetPdfFileName+"' frameborder='0' style='height:calc(100% - 4px);width:calc(100% - 4px)'></iframe><input type='hidden' id='filename' value='"+ContentEbookPlusSetPdfFileName+"'></div></body></html>";

		var win = window.open("","coursebookcontent","frameborder=0,width="+(screen.width*0.7)+",height="+(screen.height*0.7)+",top=0,left=0,directories=no,location=no,channelmode=yes,fullscreen=yes,menubar=no, resizable=no,status=no,toolbar=no,history=no,scrollbars=yes");

		win.document.body.innerHTML = "";
		win.document.write(iframe);
		win.focus();
	}
}


function FormSubmit(){

	<?if ($EbookExistCount!=0){?>
	ConfrimMsg = "수정 하시겠습니까?";
	<?}else{?>
	ConfrimMsg = "등록 하시겠습니까?";
	<?}?>

	if (confirm(ConfrimMsg)){
		document.RegForm.action = "./popup_course_book_content_ebook_plus_set_action.php"
		document.RegForm.submit(); 
	}

}
</script>



<?php
include_once('./inc_footer.php');
include_once('../includes/dbclose.php');
?>
</body>
</html>