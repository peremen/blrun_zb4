
<script language="javascript">
function unlock()
{
	document.getElementById('check').value=0;
}

function check_submit()
{
	var rName=document.getElementById('name');
	var rPass=document.getElementById('password');
	var rSub=document.getElementById('subject');
	var rCheck=document.getElementById('check');
	if(rCheck.value==1)
	{
		alert('�۾��� ��ư�� ������ �����ø� �ȵ˴ϴ�');
		return false;
	}
<? if($setup[use_category]) { ?>
	var myindex=document.getElementById('write').category[1].selectedIndex;
	if (myindex<1)
	{
		alert('ī�װ��� �����Ͽ� �ֽʽÿ�');
		return false;
	}
<? } ?>

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

	if(!rSub.value)
	{
		alert('������ �Է��Ͽ� �ּ���.');
		rSub.focus();
		return false;
	}
	var rStr=document.getElementById('memo');
	if(!rStr.value)
	{
		alert('������ �Է��Ͽ� �ּ���.');
		rStr.focus();
		return false;
	}

	rCheck.value=1;
	show_waiting();
	hideImageBox();

	return true;
}

var imageBoxHandler;
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
	var rSub=document.getElementById('subject');
	var rStr=document.getElementById('memo');

	if(!rSub.value)
	{
		alert('�۾��� ������ �Է��Ͽ� �ּ���.');
		rSub.focus();
		return false;
	}

	if(!rStr.value)
	{
		alert('�۾��� ������ �Է��Ͽ� �ּ���.');
		rStr.focus();
		return false;
	}
	var rWrite=document.getElementById('write');
	rWrite.action = "view_preview.php";
	rWrite.target = "_blank";
	rWrite.submit();
	rWrite.action = "write_ok.php";
	rWrite.target = "_self";

	return true;
}

function preview_m() {
	var rSub=document.getElementById('subject');
	var rStr=document.getElementById('memo');
	if(!rSub.value)
	{
		alert('�۾��� ������ �Է��Ͽ� �ּ���.');
		rSub.focus();
		return false;
	}

	if(!rStr.value)
	{
		alert('�۾��� ������ �Է��Ͽ� �ּ���.');
		rStr.focus();
		return false;
	}
	var rWrite=document.getElementById('write');
	rWrite.action = "view_preview.php";
	rWrite.target = "_blank";
	rWrite.submit();
	rWrite.action = "<?=$dir?>/write_ok.php";
	rWrite.target = "_self";

	return true;
}

function check_use_html(obj) {
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
<form name=check_attack><input type=hidden id=check name=check value=0></form>
<div id='zb_waiting' style='position:absolute; left:50px; top:120px; width:292; height: 91; z-index:1; visibility: hidden'>
<table border=0 width=98% cellspacing=1 cellpadding=0 bgcolor=black>
<form name=waiting_form>
<tr bgcolor=white>
	<td>
		<table border=0 cellspacing=0 cellpadding=0 width=100%>
		<tr>
			<td><img src=images/waiting_left.gif border=0></td>
			<td><img src=images/waiting_top.gif border=0><br><img src=images/waiting_text.gif></td>
		</tr>
		</table>
	</td>
</tr>
</form>
</table>
</div>
