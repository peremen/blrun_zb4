
<!-- �ڸ�Ʈ ���� ���� ���� ��ũ��Ʈ ��� -->
<script language="javascript">
function ajaxLoad()
{
	$.ajax({
		type: "POST",
		url: "comment_init_ok.php",
		dataType: "json",
		data: $("#write").serialize(),
		success: function(data) {
			if(data=='') {
				// ���� ����
			} else {
				var yn = confirm("�ӽ������ ������ �ҷ����ðڽ��ϱ�?");
				if(yn) {
<? if($setup[use_html]>0||$is_admin||$member[level]<=$setup[grant_html]) { ?>
					if(data.use_html2) {
						$("#use_html2").prop("checked", true);
						$("#use_html2").val(data.use_html2);
					} else $("#use_html2").prop("checked", false);
<? } ?>

<? if($setup[use_secret]) { ?>
					if(data.is_secret) $("#is_secret").prop("checked", true);
					else $("#is_secret").prop("checked", false);
<? } ?>

<? if(!$member[no]) { ?>
					$("#name").val(data.name);
<? } ?>
					$("#memo").val(data.memo);
				}
			}
		}
	});
}

function loadAjax2()
{
	$.ajax({
		type: "POST",
		url: "comment_init_ok.php",
		dataType: "json",
		data: $("#write").serialize(),
		success: function(data) {
			if(data=='') {
				// ���� ����
			} else {
<? if($setup[use_html]>0||$is_admin||$member[level]<=$setup[grant_html]) { ?>
				if(data.use_html2) {
					$("#use_html2").prop("checked", true);
					$("#use_html2").val(data.use_html2);
				} else $("#use_html2").prop("checked", false);
<? } ?>

<? if($setup[use_secret]) { ?>
				if(data.is_secret) $("#is_secret").prop("checked", true);
				else $("#is_secret").prop("checked", false);
<? } ?>

<? if(!$member[no]) { ?>
				$("#name").val(data.name);
<? } ?>
				$("#memo").val(data.memo);
			}
		}
	});
}

var cntLoad = 0;
var pSet;

function ajaxLoad2()
{
	cntLoad++;
	if(cntLoad<2) {
		pSet = setTimeout("loadAjax2()",3000);
	} else {
		clearTimeout(pSet);
		pSet = setTimeout("loadAjax2()",1500);
	}
}

function autoSave()
{
	$('#state').css('color','red');
	$('#state').html('�ӽ�������...');
	$.ajax({
		type: "POST",
		url: "comment_imsi_ok.php",
		dataType: "json",
		data: $("#write").serialize(),
		success: function(data) {
			if(data=='') {
				$('#state').css('color','red');
				$('#state').html('�ӽ����� ����!');
			} else {
				$('#state').css('color','blue');
				$('#state').html('�ӽ����� �Ϸ�!');
			}
		},
		error: function() {
			$('#state').css('color','red');
			$('#state').html('�ӽ����� ����!');
		}
	});
}

function unlock()
{
	document.getElementById('check').value=0;
	ajaxLoad();
}

var cntkey = 0;
var qSet;
function addStroke() {
	cntkey++;
	if(cntkey<2) {
		qSet = setTimeout("autoSave()",60000);
	} else {
		clearTimeout(qSet);
		qSet = setTimeout("autoSave()",30000);
	}
	if(cntkey%78==2) autoSave();
}

function check_submit()
{
	var rName=document.getElementById('name');
	var rPass=document.getElementById('password');
	var rCheck=document.getElementById('check');
	if(rCheck.value==1)
	{
		alert('�۾��� ��ư�� ������ �����ø� �ȵ˴ϴ�');
		return false;
	}

<? if(!$member[no]) { ?>
	if(!rName.value)
	{
		alert('�̸��� �Է��Ͽ� �ּ���.');
		rName.focus();
		return false;
	}
	if(!rPass.value)
	{
		alert('��ȣ�� �Է��Ͽ� �ּ���.\n\n��ȣ�� �Է��ϼž� ����/������ �Ҽ� �ֽ��ϴ�');
		rPass.focus();
		return false;
	}
<? } ?>

	var rPattern=/\|\|\|\d+\|\d+$/g;
	var rStr=document.getElementById('memo');

	if(!rStr.value)
	{
		alert('������ �Է��Ͽ� �ּ���.');
		rStr.focus();
		return false;
	}

	if(rStr.value.match(rPattern)!= null){
		alert('����� ���ڿ��� ����� �� �����ϴ�.');
		rStr.focus();
		return false;
	}

	rCheck.value=1;
	show_waiting();
	hideImageBox();

	document.getElementById('is_secret').disabled = false;

	return true;
}

function showImageBox(id) {
	imageBoxHandler= window.open("image_box.php?id="+id,"imageBox","width=600,height=540,resizable=yes,scrollbars=yes,toolbars=no");
}

function hideImageBox() {
	if(imageBoxHandler) {
		if(imageBoxHandler != 'undefined') {
			if(imageBoxHandler.closed==false) imageBoxHandler.close();
		}
	}
}

var codeBoxHandler;
function showCodeBox() {
	codeBoxHandler= window.open("pop_code.php","codebox","width=830,height=500,left=1,top=1,toolbar=no,scrollbars=yes");
}

function view_preview() {
	var rPattern=/\|\|\|\d+\|\d+$/g;
	var rStr=document.getElementById('memo');

	if(!rStr.value)
	{
		alert('������ �Է��Ͽ� �ּ���..');
		rStr.focus();
		return false;
	}

	if(rStr.value.match(rPattern)!= null){
		alert('����� ���ڿ��� ����� �� �����ϴ�..');
		rStr.focus();
		return false;
	}
	var rWrite=document.getElementById('write');
	rWrite.action = "view_preview2.php";
	rWrite.target = "_blank";
	rWrite.submit();
	rWrite.action = "comment_modify_ok.php?flag=ok";
	rWrite.target = "_self";

	return true;
}

function check_use_html2(obj) {
	var c_n;
	if(!obj.checked) {
		obj.value=1;
	} else {
		c_n = confirm("�ڵ� �ٹٲ��� �Ͻðڽ��ϱ�?\n\n�ڵ� �ٹٲ��� �Խù� ������ �ٹٲ� ����<br>�±׷� ��ȯ�ϴ� ����Դϴ�.");
		if(c_n) {
			obj.value=1;
		} else {
			obj.value=2;
		}
	}
}

function show_waiting() {
	var _x = document.body.clientWidth/2 + document.body.scrollLeft - 145;
	var _y = document.body.clientHeight/2 + document.body.scrollTop - 44;
	zb_waiting.style.posLeft=_x;
	zb_waiting.style.posTop=_y;
	zb_waiting.style.visibility='visible';
}

function hide_waiting() {
	zb_waiting.style.visibility='hidden';
	check_attack.check.value=0;
}

function insert_tag(str)
{
	var objSelection = document.selection;
	var objTextArea = document.getElementById('memo');
	objTextArea.focus();

	if(typeof objSelection != 'undefined') //IE
	{
		var sRange = objSelection.createRange();
		//var selectedText = sRange.text;
		sRange.text = str;
	}
	else if(typeof objTextArea.selectionStart != 'undefined') //FF
	{
		var sStart = objTextArea.selectionStart;
		var sEnd = objTextArea.selectionEnd;
		objTextArea.value = objTextArea.value.substr(0, sStart) + str + objTextArea.value.substr(sEnd);
		objTextArea.selectionStart = objTextArea.selectionEnd = sStart + 1;
	}
	else
	{
		objTextArea.value += str;
	}
}

function doTab(arg1){
	var k;
	if("which" in arg1){k=arg1.which;}
	else if("keyCode" in arg1){k=arg1.keyCode;}
	else if("keyCode" in window.event){k=window.event.keyCode;}
	else if("which" in window.event){k=arg1.which;}
	else{return true;}

	if(k == 9) {
		insert_tag("\t");
		return false;
	}
	return true;
}
</script>
<!-- �ڸ�Ʈ ���� ���� ���� ��ũ��Ʈ ��� �� -->
