<script language="javascript">
function unlock()
{
	check_attack.check.value=0;
}

function check_submit()
{
	if(document.check_attack.check.value==1)
	{
		alert('글쓰기 버튼을 여러번 누르시면 안됩니다');
		return false;
	}

<? if(!$member[no]) { ?>
	if(!document.write.name.value)
	{
		alert('이름을 입력하여 주세요.');
		document.write.name.focus();
		return false;
	}

	if(!document.write.password.value)
	{
		alert('암호를 입력하여 주세요.\n\n암호를 입력하셔야 수정/삭제를 할수 있습니다');
		document.write.password.focus();
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

<? } ?>

	if(!document.write.memo.value)
	{
		alert('내용을 입력하여 주세요.');
		document.write.memo.focus();
		return false;
	}

	document.check_attack.check.value=1;
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
	if(!document.write.memo.value)
	{
		alert('덧글 내용을 입력하여 주세요.');
		document.write.memo.focus();
		return false;
	}
	document.write.action = "view_preview2.php";
	document.write.target = "_blank";
	document.write.submit();
	document.write.action = "comment_ok.php";
	document.write.target = "_self";
}

function check_use_html2(obj) {
	var c_n;
	if(!obj.checked) {
		obj.value=1;
	} else {
		c_n = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
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
<form name=check_attack><input type=hidden name=check value=0></form>
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