
<!--쌀리가 노가다 하다-->
<script language=javascript>
function showEmoticon(){
	if(Emoticon.style.display=='none'){
		Emoticon.style.display='';
	}else{
		Emoticon.style.display='none';
	}
}

function insert_emo(str)
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
		objTextArea.selectionStart = objTextArea.selectionEnd = sStart + str.length;
	}
	else
	{
		objTextArea.value += str;
	}
}

function insertSmiley(smiley){
	insert_emo(smiley);
}
</script>
<style>
.on {border:1px solid #6B717B}
.off {border:1px solid white}
.down {border:1px solid #444A54;background-color:efefef}
.up {border:1px solid #6B717B;background-color:white}
.curHand {cursor:pointer}
</style>
<div id=Emoticon style="display:none">

<table border=0 cellpadding=3 cellspacing=0 style="background-color:white;border:1px solid #cdcdcd;" align=left>
<tr>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_001','write')"><img class="curHand" SRC="<?=$emoticon_url?>/1.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_002','write')"><img class="curHand" SRC="<?=$emoticon_url?>/2.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_003','write')"><img class="curHand" SRC="<?=$emoticon_url?>/3.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_004','write')"><img class="curHand" SRC="<?=$emoticon_url?>/4.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_005','write')"><img class="curHand" SRC="<?=$emoticon_url?>/5.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_006','write')"><img class="curHand" SRC="<?=$emoticon_url?>/6.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_007','write')"><img class="curHand" SRC="<?=$emoticon_url?>/7.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_008','write')"><img class="curHand" SRC="<?=$emoticon_url?>/8.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_009','write')"><img class="curHand" SRC="<?=$emoticon_url?>/9.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_010','write')"><img class="curHand" SRC="<?=$emoticon_url?>/10.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_011','write')"><img class="curHand" SRC="<?=$emoticon_url?>/11.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_012','write')"><img class="curHand" SRC="<?=$emoticon_url?>/12.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_013','write')"><img class="curHand" SRC="<?=$emoticon_url?>/13.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_014','write')"><img class="curHand" SRC="<?=$emoticon_url?>/14.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_015','write')"><img class="curHand" SRC="<?=$emoticon_url?>/15.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_016','write')"><img class="curHand" SRC="<?=$emoticon_url?>/16.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_017','write')"><img class="curHand" SRC="<?=$emoticon_url?>/17.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_018','write')"><img class="curHand" SRC="<?=$emoticon_url?>/18.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_019','write')"><img class="curHand" SRC="<?=$emoticon_url?>/19.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_020','write')"><img class="curHand" SRC="<?=$emoticon_url?>/20.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_021','write')"><img class="curHand" SRC="<?=$emoticon_url?>/21.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_022','write')"><img class="curHand" SRC="<?=$emoticon_url?>/22.gif" width=18 height=18 border=0 align=absmiddle></a></td>
</tr>
<tr>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_023','write')"><img class="curHand" SRC="<?=$emoticon_url?>/23.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_024','write')"><img class="curHand" SRC="<?=$emoticon_url?>/24.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_025','write')"><img class="curHand" SRC="<?=$emoticon_url?>/25.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_026','write')"><img class="curHand" SRC="<?=$emoticon_url?>/26.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_027','write')"><img class="curHand" SRC="<?=$emoticon_url?>/27.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_028','write')"><img class="curHand" SRC="<?=$emoticon_url?>/28.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_029','write')"><img class="curHand" SRC="<?=$emoticon_url?>/29.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_030','write')"><img class="curHand" SRC="<?=$emoticon_url?>/30.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_031','write')"><img class="curHand" SRC="<?=$emoticon_url?>/31.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_032','write')"><img class="curHand" SRC="<?=$emoticon_url?>/32.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_033','write')"><img class="curHand" SRC="<?=$emoticon_url?>/33.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_034','write')"><img class="curHand" SRC="<?=$emoticon_url?>/34.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_035','write')"><img class="curHand" SRC="<?=$emoticon_url?>/35.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_036','write')"><img class="curHand" SRC="<?=$emoticon_url?>/36.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_037','write')"><img class="curHand" SRC="<?=$emoticon_url?>/37.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_038','write')"><img class="curHand" SRC="<?=$emoticon_url?>/38.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_039','write')"><img class="curHand" SRC="<?=$emoticon_url?>/39.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_040','write')"><img class="curHand" SRC="<?=$emoticon_url?>/40.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_041','write')"><img class="curHand" SRC="<?=$emoticon_url?>/41.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_042','write')"><img class="curHand" SRC="<?=$emoticon_url?>/42.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_043','write')"><img class="curHand" SRC="<?=$emoticon_url?>/43.gif" width=18 height=18 border=0 align=absmiddle></a></td>
<td class=off onmousedown=this.className='down' onmouseup=this.className='up' onmouseover=this.className='on' onmouseout=this.className='off'><a onclick="insertSmiley('emtp_044','write')"><img class="curHand" SRC="<?=$emoticon_url?>/44.gif" width=18 height=18 border=0 align=absmiddle></a></td>
</tr>
</table>
</div>
