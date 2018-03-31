
//====================[ sw_edit ���ϸ�: write_comment.js ]====================

var member_yn = document.getElementById("member_yn").value;

function check_comment_submit()
{
	var rName=document.getElementById('name');
	var rPass=document.getElementById('password');
	var rMemo=document.getElementById('memo');
	var rCheck=document.getElementById('check');
	if(rCheck.value==1)
	{
		alert('�۾��� ��ư�� ������ �����ø� �ȵ˴ϴ�.');
		return false;
	}

	if(edit_tag_yn == "Y")
	{
		rMemo.value = memoi2memo(memoiW.document.body.innerHTML);
	}

	if(member_yn == "Y")
	{
		if(!rName.value)
		{
			alert('�̸��� �Է��Ͽ� �ּ���.');
			rName.focus();
			return false;
		}
		if(!rPass.value)
		{
			alert('��ȣ�� �Է��Ͽ� �ּ���.\n\n��ȣ�� �Է��ϼž� ����/������ �� �� �ֽ��ϴ�.');
			rPass.focus();
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
			rMemo.focus();
			return false;
		}
		if(rStr.match(rPattern)!= null){
			alert('����� ���ڿ��� ����� �� �����ϴ�..');
			rMemo.focus();
			return false;
		}
	}

	rCheck.value=1;
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
	var rMemo=document.getElementById('memo');
	if(edit_tag_yn == "Y")
	{
		rMemo.value = memoi2memo(memoiW.document.body.innerHTML);
	} else {
		rMemo.value = memoE.value;
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
			rMemo.focus();
			return false;
		}
		if(rStr.match(rPattern)!= null){
			alert('����� ���ڿ��� ����� �� �����ϴ�..');
			rMemo.focus();
			return false;
		}
	}
	view_preview();
	return true;
}

function preview_m()
{
	var rMemo=document.getElementById('memo');
	if(edit_tag_yn == "Y")
	{
		rMemo.value = memoi2memo(memoiW.document.body.innerHTML);
	} else {
		rMemo.value = memoE.value;
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
			rMemo.focus();
			return false;
		}
		if(rStr.match(rPattern)!= null){
			alert('����� ���ڿ��� ����� �� �����ϴ�..');
			rMemo.focus();
			return false;
		}
	}
	var rWrite=document.getElementById('write');
	rWrite.action = "view_preview2.php";
	rWrite.target = "_blank";
	rWrite.submit();
	rWrite.action = sw_d_zb_self_dir + sw_skins_dir + "/comment_ok.php";
	rWrite.target = "_self";

	return true;
}

function sw_imagebox(id)
{
	if (document.getElementById('htChk').checked) {
		showImageBox(id);
	} else {
		alert('HTML üũ�� ����ϼ���.');
	}
}

function sw_codebox(id)
{
	if (document.getElementById('htChk').checked) {
		showCodeBox(id);
	} else {
		alert('HTML üũ�� ����ϼ���.');
	}
}

function autoSave_n()
{
	var rMemo=document.getElementById('memo');
	if(edit_tag_yn == "Y")
	{
		rMemo.value = memoi2memo(memoiW.document.body.innerHTML);
	}
	autoSave();
}

var cntkey = 0;
var qSet;
function addStroke() {
	cntkey++;
	if(cntkey<2) {
		qSet = setTimeout("autoSave_n()",60000);
	} else {
		clearTimeout(qSet);
		qSet = setTimeout("autoSave_n()",30000);
	}
	if(cntkey%78==2) autoSave_n();
}
