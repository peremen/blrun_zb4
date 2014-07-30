<? 
	$m_data=mysql_fetch_array(mysql_query("select * from $t_comment"."_$id"."_movie where parent='$s_data[parent]' and reg_date='$s_data[reg_date]'"));
	$_point1=$m_data[point1];
	$_point2=$m_data[point2];
	$parent=$m_data[parent];
	$c_date=$m_data[reg_date];

	$a_preview = str_replace("view_preview()","preview_m()",$a_preview);
	$a_preview = str_replace(">","><font class=list_eng>",$a_preview)."&nbsp;&nbsp;";
	$a_imagebox = str_replace(">","><font class=list_eng>",$a_imagebox)."&nbsp;&nbsp;";
	$a_codebox = str_replace(">","><font class=list_eng>",$a_codebox)."&nbsp;&nbsp;";

	$align="right";
	if ($member[no]){
		$align="left";
	}
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function zb_formresize(obj) {
	obj.rows += 3;
}

function check_submit_y() {
	<? if(!$member[no]) { ?>
	if(!document.write.name.value){
		alert('이름을 입력하여 주세요.');
		document.write.name.focus();
		return false;
	}
	else if(!document.write.password.value){
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

	if(document.getElementById("memo").value==""){
		alert("내용을 입력하세요!");
		document.getElementById("memo").focus();
		return false;
	}

	return true;
}

function preview_m() {
	if(!document.write.memo.value)
	{
		alert('덧글 내용을 입력하여 주세요..');
		document.write.memo.focus();
		return false;
	}
	document.write.action = "view_preview2.php";
	document.write.target = "_blank";
	document.write.submit();
	document.write.action = "<?=$dir?>/comment_ok.php";
	document.write.target = "_self";
}
//-->
</SCRIPT><br>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> align=center>
<form method=post name=write action=<?=$dir?>/comment_ok.php onsubmit="return check_submit();" enctype=multipart/form-data><input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=sm value="<?=$sm?>"><input type=hidden name=mode value="modify"><input type=hidden name=c_no value=<?=$c_no?>><input type=hidden name=parent value=<?=$parent?>><input type=hidden name=c_date value=<?=$c_date?>><input type=hidden name=_zb_path value="<?=$config_dir?>"><input type=hidden name=_zb_url value="<?=$zb_url?>"><input type=hidden name=antispam value="<?=$num1num2?>">
<col width=80 style=padding:0,3,0,5></col><col width=80 style=padding:0,3,0,3></col><col width=80 style=padding:0,3,0,3></col><col width=80 style=padding:0,3,0,3></col><col width=></col>
<tr>
<?=$hide_start?>
<td class=list_eng><b>Name</b></td><td class=list_han><input type=text name=name value="<?=$name?>" <?=size(8)?> maxlength=20 class=input></td>
<td class=list_eng><b>Password</b></td><td class=list_han><input type=password name=password <?=size(8)?> maxlength=20 class=input></td>
<?=$hide_end?>
<td width="100%"><div align=<?=$align?>><?if ($emoticon_use=="on"){?>
<input onclick='showEmoticon()' type=checkbox name=Emoticons value='yes'><img src=<?=$dir?>/use_emo.gif>
</div><?}?>
</td>
<?if($s_data[ismember]){?>
<td align=right>
<table border=0 cellspacing=0 cellpadding=3 width=100%><tr><td>
<select name="_point1" value=<?=$_point1?>>
<? $checked=array("","","","","","");
 $checked[$_point1]="selected"?>
	<option value=0 style=background-color:#ffffff;color:555555 <?=$checked[0]?>>포인트</option>
	<option value=1 style=background-color:#ffffff;color:888888 <?=$checked[1]?>>★</option>
	<option value=2 style=background-color:#ffffff;color:666666 <?=$checked[2]?>>★★</option>
	<option value=3 style=background-color:#ffffff;color:444444 <?=$checked[3]?>>★★★</option>
	<option value=4 style=background-color:#ffffff;color:222222 <?=$checked[4]?>>★★★★</option>
	<option value=5 style=background-color:#ffffff;color:000000 <?=$checked[5]?>>★★★★★</option></SELECT></td>
<td valign=top>
<select name="_point2" value=<?=$_point2?>>
<?$checked[$_point2]="selected"?>
	<option value=0 style=background-color:#ffffff;color:555555 <?=$checked[0]?>>절반</option>
	<option value=1 style=background-color:#ffffff;color:black <?=$checked[1]?>>☆</option>
</select></td>
</tr></table>
</td><?}?>
</tr>
<tr><td height=1 colspan=5 background=<?=$dir?>/dot.gif>
</td></tr>
<tr><td colspan=5 align=right class=list_eng><?=$hide_html_start?> <input type=checkbox name=use_html2<?=$use_html2?>> HTML사용 <?=$hide_html_end?><?=$hide_secret_start?> <input type=checkbox name=is_secret <?=$secret?> value=1> 비밀글 <?=$hide_secret_end?>
</td></tr>
<tr><td bgcolor=white height=3 colspan=5>
</td></tr><tr><td colspan=5>
	<table border=0 cellspacing=0 cellpadding=3 width=100%>
	
	</table>
	<table border=0 cellspacing=1 cellpadding=0 width=100% height=120>
	<col width=5 align=center><col width=></col>
	<tr> 
	<td onclick="document.write.memo.rows=document.write.memo.rows+4" style=cursor:hand valign=top align=right>
	↓</td>
	<td>
		<table border=0 cellspacing=2 cellpadding=0 width=100% height=100 style=table-layout:fixed>
		<col width=></col><col width=90></col>
		<tr>
		<td width=100% valign=top><textarea name=memo id=memo cols=20 rows=8 class=textarea style=width:100% onkeydown='return doTab(event);'><?=$memo?></textarea></td>
		<td width=90><input type=submit rows=5 class=submit value='영화평쓰기' accesskey="s" style=height:100%></td>
		</tr>
		</table>
		<table border=0 cellspacing=2 cellpadding=0 width=100% height=20>
		<col width=5%></col><col width=45%></col><col width=5%></col><col width=45%>
		<tr valign=top>
		<?=$hide_pds_start?>
		  <td width=52 align=right><font class=list_eng>Upload #1</font></td>
		  <td class=list_eng><input type=file name=file1 <?=size(50)?> maxlength=255 class=input style=width:99%> <?=$s_file_name1?></td>
		  <td width=52 align=right><font class=list_eng>Upload #2</font></td>
		  <td class=list_eng><input type=file name=file2 <?=size(50)?> maxlength=255 class=input style=width:99%> <?=$s_file_name2?></td>
		<?=$hide_pds_end?>
		</tr>
		</table>
	</td>
	</tr>
	</form>
	</table>

</td>
</tr>
</table>
<TABLE BORDER=0 CELLPADDING=0 CELLSPACING=0 align="center" width=<?=$width?>>
<TR>
<TD style=padding-left:18px><? if($emoticon_use=="on") include "$dir/emo.php"; ?>
</TD>
</TR>
</table>
<table border=0 width=<?=$width?> cellsapcing=1 cellpadding=0>
<tr>
	<td width=200 height=40>
		<?=$a_preview?>미리보기</a><?=$a_imagebox?>그림창고</a><?=$a_codebox?>코드삽입</a>
	</td>
</tr>
</table>
