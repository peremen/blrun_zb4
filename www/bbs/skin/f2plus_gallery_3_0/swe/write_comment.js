
//====================[ sw_edit 파일명: write_comment.js ]====================

var member_yn = document.getElementById("member_yn").value;

function check_comment_submit()
{
	if(document.check_attack.check.value==1)
	{
		alert('글쓰기 버튼을 여러번 누르시면 안됩니다.');
		return false;
	}

	if(edit_tag_yn == "Y")
	{
		document.getElementById("memo").value = memoi2memo(memoiW.document.body.innerHTML);
	}

	if(member_yn == "Y")
	{
		if(!document.write.password.value)
		{
			alert('암호를 입력하여 주세요.\n\n암호를 입력하셔야 수정/삭제를 할 수 있습니다.');
			document.write.password.focus();
			return false;
		}

		if(!document.write.name.value)
		{
			alert('이름을 입력하여 주세요.');
			document.write.name.focus();
			return false;
		}

		var nStr=document.write.name.value;
		var pStr=document.write.password.value;

		var nLen=nStr.length;
		var pLen=pStr.length;
		var cnt=0;

		for(i=0;i<nLen;i++){
			if(nStr.substr(i,1)=="\"") cnt++;
		}
		if(cnt>0){
			alert("이름에 \" 문자가 들어가 있습니다.");
			document.write.name.focus();
			return false;
		}

		cnt=0;
		for(i=0;i<pLen;i++){
			if(pStr.substr(i,1)=="\"") cnt++;
		}
		if(cnt>0){
			alert('패스워드에 \" 문자가 들어가 있습니다.');
			document.write.password.focus();
			return false;
		}
	}

	var rPattern=/\|\|\|\d+\|\d+$/g;

	if(edit_tag_yn == "Y") {
		var rStr=memoiW.document.body.innerHTML;
		if(!rStr||rStr=="<P>&nbsp;</P>"||rStr=="<br>")
		{
			alert('덧글 내용을 입력하여 주세요.');
			memoiW.focus();
			return false;
		}
		if(rStr.match(rPattern)!= null){
			alert('예약된 문자열은 사용할 수 없습니다.');
			memoiW.focus();
			return false;
		}

	} else {
		var rStr=memoE.value;
		if(!rStr||rStr=="<P>&nbsp;</P>"||rStr=="<br>")
		{
			alert('덧글 내용을 입력하여 주세요..');
			document.write.memo.focus();
			return false;
		}
		if(rStr.match(rPattern)!= null){
			alert('예약된 문자열은 사용할 수 없습니다..');
			document.write.memo.focus();
			return false;
		}
	}

	document.check_attack.check.value=1;
	show_waiting();
	hideImageBox();

	document.getElementById('is_secret').disabled = false;

	return true;
}

function clear_iedit()
{
	if(edit_tag_yn == "Y")
	{
		if(memoiW.document.body.innerHTML) {
			if(confirm("작성을 취소하시겠습니까?")) {
				var doc = memoiW.document.open("text/html", "replace");
				doc.write(default_source);
				doc.close();
			}
		} else {
			alert("입력된 내용이 없습니다.");
		}
		memoiW.focus();
	} else {
		if(memoE.value) {
			if(confirm("작성을 취소하시겠습니까?")) {
				memoE.value = "";
			}
		} else {
			alert("입력된 내용이 없습니다.");
		}
		memoE.focus();
	}
}

var sw_ed_yn = "Y";

function ed_c_editdiv_v()
{
	var sw_ed_yn_fE = document.getElementById("sw_ed_yn_f");

	if(sw_ed_yn == "Y") {
		document.getElementById("ed_toolbar").style.display = "block";
		sw_ed_yn_fE.innerHTML = "<img src='"+sw_skins_dir+"/images/sw_c_weditno.gif' border='0'>";
		sw_ed_yn = "N";
	} else {
		document.getElementById("ed_toolbar").style.display = "none";
		sw_ed_yn_fE.innerHTML = "<img src='"+sw_skins_dir+"/images/sw_c_wedityes.gif' border='0'>";
		sw_ed_yn = "Y";
	}
}

function sw_preview()
{
	if(edit_tag_yn == "Y")
	{
		document.getElementById("memo").value = memoi2memo(memoiW.document.body.innerHTML);
	} else {
		document.getElementById("memo").value = memoE.value;
	}

	var rPattern=/\|\|\|\d+\|\d+$/g;
	
	if(edit_tag_yn == "Y") {
		var rStr=memoiW.document.body.innerHTML;
		if(!rStr||rStr=="<P>&nbsp;</P>"||rStr=="<br>")
		{
			alert('덧글 내용을 입력하여 주세요.');
			memoiW.focus();
			return false;
		}
		if(rStr.match(rPattern)!= null){
			alert('예약된 문자열은 사용할 수 없습니다.');
			memoiW.focus();
			return false;
		}
	} else {
		var rStr=memoE.value;
		if(!rStr||rStr=="<P>&nbsp;</P>"||rStr=="<br>")
		{
			alert('덧글 내용을 입력하여 주세요..');
			document.write.memo.focus();
			return false;
		}
		if(rStr.match(rPattern)!= null){
			alert('예약된 문자열은 사용할 수 없습니다..');
			document.write.memo.focus();
			return false;
		}
	}
	view_preview();
}

function preview_m()
{
	if(edit_tag_yn == "Y")
	{
		document.getElementById("memo").value = memoi2memo(memoiW.document.body.innerHTML);
	} else {
		document.getElementById("memo").value = memoE.value;
	}
	
	var rPattern=/\|\|\|\d+\|\d+$/g;

	if(edit_tag_yn == "Y") {
		var rStr=memoiW.document.body.innerHTML;
		if(!rStr||rStr=="<P>&nbsp;</P>"||rStr=="<br>")
		{
			alert('덧글 내용을 입력하여 주세요.');
			memoiW.focus();
			return false;
		}
		if(rStr.match(rPattern)!= null){
			alert('예약된 문자열은 사용할 수 없습니다.');
			memoiW.focus();
			return false;
		}
	} else {
		var rStr=memoE.value;
		if(!rStr||rStr=="<P>&nbsp;</P>"||rStr=="<br>")
		{
			alert('덧글 내용을 입력하여 주세요..');
			document.write.memo.focus();
			return false;
		}
		if(rStr.match(rPattern)!= null){
			alert('예약된 문자열은 사용할 수 없습니다..');
			document.write.memo.focus();
			return false;
		}
	}
	document.write.action = "view_preview2.php";
	document.write.target = "_blank";
	document.write.submit();
	document.write.action = sw_d_zb_self_dir + sw_skins_dir + "/comment_ok.php";
	document.write.target = "_self";
}

function sw_imagebox(id)
{
	if (document.write.htChk.checked) {
		showImageBox(id);					
	} else {		
		alert('HTML 체크후 사용하세요.');	
	}
}

function sw_codebox(id)
{
	if (document.write.htChk.checked) {
		showCodeBox(id);					
	} else {		
		alert('HTML 체크후 사용하세요.');	
	}
}
