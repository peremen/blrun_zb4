
//====================[ sw_edit ���ϸ�: write_comment.js ]====================

var member_yn = document.getElementById("member_yn").value;

function check_comment_submit()
{
	if(document.check_attack.check.value==1)
	{
		alert('�۾��� ��ư�� ������ �����ø� �ȵ˴ϴ�.');
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
			alert('��ȣ�� �Է��Ͽ� �ּ���.\n\n��ȣ�� �Է��ϼž� ����/������ �� �� �ֽ��ϴ�.');
			document.write.password.focus();
			return false;
		}

		if(!document.write.name.value)
		{
			alert('�̸��� �Է��Ͽ� �ּ���.');
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
			alert("�̸��� \" ���ڰ� �� �ֽ��ϴ�.");
			document.write.name.focus();
			return false;
		}

		cnt=0;
		for(i=0;i<pLen;i++){
			if(pStr.substr(i,1)=="\"") cnt++;
		}
		if(cnt>0){
			alert('�н����忡 \" ���ڰ� �� �ֽ��ϴ�.');
			document.write.password.focus();
			return false;
		}
	}

	var rPattern=/\|\|\|\d+\|\d+$/g;

	if(edit_tag_yn == "Y") {
		var rStr=memoiW.document.body.innerHTML;
		if(!rStr||rStr=="<P>&nbsp;</P>"||rStr=="<br>")
		{
			alert('���� ������ �Է��Ͽ� �ּ���.');
			memoiW.focus();
			return false;
		}
		if(rStr.match(rPattern)!= null){
			alert('����� ���ڿ��� ����� �� �����ϴ�.');
			memoiW.focus();
			return false;
		}

	} else {
		var rStr=memoE.value;
		if(!rStr||rStr=="<P>&nbsp;</P>"||rStr=="<br>")
		{
			alert('���� ������ �Է��Ͽ� �ּ���..');
			document.write.memo.focus();
			return false;
		}
		if(rStr.match(rPattern)!= null){
			alert('����� ���ڿ��� ����� �� �����ϴ�..');
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
			if(confirm("�ۼ��� ����Ͻðڽ��ϱ�?")) {
				var doc = memoiW.document.open("text/html", "replace");
				doc.write(default_source);
				doc.close();
			}
		} else {
			alert("�Էµ� ������ �����ϴ�.");
		}
		memoiW.focus();
	} else {
		if(memoE.value) {
			if(confirm("�ۼ��� ����Ͻðڽ��ϱ�?")) {
				memoE.value = "";
			}
		} else {
			alert("�Էµ� ������ �����ϴ�.");
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
			alert('���� ������ �Է��Ͽ� �ּ���.');
			memoiW.focus();
			return false;
		}
		if(rStr.match(rPattern)!= null){
			alert('����� ���ڿ��� ����� �� �����ϴ�.');
			memoiW.focus();
			return false;
		}
	} else {
		var rStr=memoE.value;
		if(!rStr||rStr=="<P>&nbsp;</P>"||rStr=="<br>")
		{
			alert('���� ������ �Է��Ͽ� �ּ���..');
			document.write.memo.focus();
			return false;
		}
		if(rStr.match(rPattern)!= null){
			alert('����� ���ڿ��� ����� �� �����ϴ�..');
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
			alert('���� ������ �Է��Ͽ� �ּ���.');
			memoiW.focus();
			return false;
		}
		if(rStr.match(rPattern)!= null){
			alert('����� ���ڿ��� ����� �� �����ϴ�.');
			memoiW.focus();
			return false;
		}
	} else {
		var rStr=memoE.value;
		if(!rStr||rStr=="<P>&nbsp;</P>"||rStr=="<br>")
		{
			alert('���� ������ �Է��Ͽ� �ּ���..');
			document.write.memo.focus();
			return false;
		}
		if(rStr.match(rPattern)!= null){
			alert('����� ���ڿ��� ����� �� �����ϴ�..');
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
		alert('HTML üũ�� ����ϼ���.');	
	}
}

function sw_codebox(id)
{
	if (document.write.htChk.checked) {
		showCodeBox(id);					
	} else {		
		alert('HTML üũ�� ����ϼ���.');	
	}
}
