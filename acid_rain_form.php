<?php
include_once('../../../includes/dbopen.php');
//include_once('../../../includes/common.php');
//include_once('./../../inc_header.php');
?>
</head>
<body style="padding:20px;">

<h1 class="Title" style="margin-bottom:20px;">산성비 게임 설정</h1>


<form id="RegForm" name="RegForm" method="post" enctype="multipart/form-data" accept-charset="UTF-8" autocomplete="off">


    <table width="100%" border="1" cellspacing="0" cellpadding="0" class="table_form" style="">
        <tr>
            <th >
                배경 이미지<span></span>
            </th>
            <td class="upload" style="">
                <div class="right" style="">
                    <div class="bg_logo" style="">
                        <input type="hidden" name="ContentQuizPlusImage" value="" />

                        <img src="" id="ContentQuizPlusImage" onerror="this.src='../../../images/logo_sample.png'" class="img" style="">

                        <div class="btn_area"><a href="javascript:PopupUploadImage('ContentQuizPlusImage','RegForm.ContentQuizPlusImage','../uploads/content_quiz_plus_images');" class="">이미지 업로드</a></div>
                    </div>
                </div>
                    
       

            </td>
        </tr>

        <tr>
            <th>
                활성 단어 수<span></span>
                <br>(10~30)
            </th>
            <td>
                <input type="text" id="ContentQuizPlusDescription2FontSize" name="ContentQuizPlusDescription2FontSize" value="" onfocus="this.select();" class="allownumericwithoutdecimal" style=""/> EA
            </td>
        </tr>
        <tr>
            <th>
                활성 단어 리스트<span></span>
                
            </th>
            <td>
                <textarea name="ContentQuizPlusDescription2" id="ContentQuizPlusDescription2" cols="100" rows="12" style="width:100%;margin-top:5px;margin-bottom:5px;">
                </textarea>
            </td>
        </tr>
        <tr>
            <th>
                성공 단어 수<span></span>
                <br>(최소 5개)
            </th>
            <td>
                <input type="text" id="ContentQuizPlusDescription2FontSize" name="ContentQuizPlusDescription2FontSize" value="" onfocus="this.select();" class="allownumericwithoutdecimal" style=""/> EA
            </td>
        </tr>

    </table>
</form>
<div class="btn_center" style="padding-top:25px;">
	
	<a href="javascript:FormSubmit();" class="">등록하기</a>
	
	<a href="javascript:FormClose();" class="">닫기</a>
</div>

<script>
function PopupUploadImage(ImgID,FormName,UpPath){
	openurl = "./popup_course_book_content_quiz_plus_image_upload_form.php?ImgID="+ImgID+"&FormName="+FormName+"&UpPath="+UpPath;
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


function FormSubmit(){
	
	obj = document.RegForm.ContentQuizPlusText;
	if (obj.value==""){
		alert('질문을 입력하세요.');
		obj.focus();
		return;
	}


	<?if ($ContentQuizPlusID!=""){?>
	ConfrimMsg = "수정 하시겠습니까?";
	<?}else{?>
	ConfrimMsg = "등록 하시겠습니까?";
	<?}?>

	if (confirm(ConfrimMsg)){
		document.RegForm.action = "./popup_course_book_content_quiz_plus_action.php"
		document.RegForm.submit(); 
	}

}

function FormClose(){
	
	obj = document.RegForm.ContentQuizPlusText;
	if (obj.value==""){
		alert('질문을 입력하세요.');
		obj.focus();
		return;
	}


	<?if ($ContentQuizPlusID!=""){?>
	ConfrimMsg = "수정 하시겠습니까?";
	<?}else{?>
	ConfrimMsg = "등록 하시겠습니까?";
	<?}?>

	if (confirm(ConfrimMsg)){
		document.RegForm.action = "./popup_course_book_content_quiz_plus_action.php"
		document.RegForm.submit(); 
	}

}
</script>

<?php
//include_once('./../../inc_footer.php');
include_once('../../../includes/dbclose.php');
?>
