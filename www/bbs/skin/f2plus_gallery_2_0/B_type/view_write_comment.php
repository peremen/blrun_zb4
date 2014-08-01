<?
$pass = $_POST["pwd"];
$pass = stripslashes($pass);

if($pass == "gg" || $member[no] || $data[is_secret] != 0) {

	//랜덤한 두 숫자를 발생(1-8) 후 세션변수에 대입
	$num1 = rand(1,8);
	$num2 = rand(1,8);
	$num1num2 = $num1*10 + $num2;
	session_register("num1num2");
	//코멘트 보안을 위해 세션변수를 설정
	$ZBRD_SS_VRS = $num1num2;
	session_register("ZBRD_SS_VRS");
	//미리보기, 그림창고, 코드삽입 버튼 보이게 하기
	$box_view=true;

	$emoticon_url=$dir."/emoticon";
	?>
	<img src=<?=$dir?>/t.gif border=0 height=4><br>
	<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> align=center>
	<form method=post name=write action=comment_ok.php onsubmit="return check_submit();" enctype=multipart/form-data><input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=sm value="<?=$sm?>"><input type=hidden name=mode value="write"><input type=hidden name=antispam value="<?=$num1num2?>">
	<col width=60 style=padding:0,3,0,5></col><col width=80 style=padding:0,3,0,3></col><col width=80 style=padding:0,3,0,3></col><col width=80 style=padding:0,3,0,3></col><col width=></col>
	<tr>
	<?if(!$member['no']){?>
	<td align=center><font class=list_eng><b>Name</b></font></td>
	<td><font class=list_han><?=$c_name?></font></td>
	<?}?>
	<?=$hide_c_password_start?>
	<td align=center><font class=list_eng><b>Password</b></font></td>
	<td><input type=password name=password <?=size(8)?> maxlength=20 class=input></td>
	<?=$hide_c_password_end?>
	<td width="100%"><div align=right>
	<?if($emoticon_use=="on"){?>
	<input onclick='showEmoticon()' type=checkbox name=Emoticons value='yes'><img src=<?=$dir?>/use_emo.gif>
	</div><?}?>
	</td></tr>
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
		<td onclick="document.write.memo.rows=document.write.memo.rows+4" style=cursor:pointer valign=top align=right>
		↓</td>
		<td>
			<table border=0 cellspacing=2 cellpadding=0 width=100% height=100 style=table-layout:fixed>
			<col width=></col><col width=70></col>
			<tr>
			<td width=100% valign=top><textarea name=memo id=memo cols=20 rows=8 class=textarea style=width:100% onkeydown='return doTab(event);'></textarea></td>
			<td width=70><input type=submit rows=5 class=submit value=' 글쓰기 ' accesskey="s" style=height:100%></td>
			</tr>
			</table>
			<table border=0 cellspacing=2 cellpadding=0 width=100% height=20>
			<col width=5%></col><col width=45%></col><col width=5%></col><col width=45%>
			<tr valign=top>
			<?=$hide_pds_start?>
			  <td width=52 align=right><font class=list_eng>Upload #1</font></td>
			  <td class=list_eng><input type=file name=file1 <?=size(50)?> maxlength=255 class=input style=width:99%></td>
			  <td width=52 align=right><font class=list_eng>Upload #2</font></td>
			  <td class=list_eng><input type=file name=file2 <?=size(50)?> maxlength=255 class=input style=width:99%></td>
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
	<TD style=padding-left:18px><?if($emoticon_use=="on") include "$dir/emo.php"; ?>
	</TD>
	</TR>
	</table>
	<br>
<?
} else {
?>
	<script language="javascript">
	<!--
	function sendit() {
		//패스워드
		if(document.myform.pwd.value=="") {
			alert("패스워드를 입력해 주십시요");
			return false;
		}
		document.myform.submit();
	}
	-->
	</script>
	<img src=<?=$dir?>/t.gif border=0 height=4><br>
	<form name="myform" method="post" action=<?=$PHP_SELF?> enctype=multipart/form-data>
	<input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=sm value="<?=$sm?>"><input type=hidden name=mode value="<?=$mode?>">
	<table width=<?=$width?> height="120" border="0" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF" align="center">
		<tr><td class=line1>
			<table width="320" height="70" border="1" style="border-collapse:collapse;" bordercolor="black" bgcolor="#BEEBDD" cellpadding="1" align="center">
				<tr><td height="45" align="center"><b><span style="font-size:11pt">덧글 달기!!<br>스팸방지 비번(<font color="red">gg</font>)을 입력: </span></b><input type="password" name="pwd" size="20">
				</td></tr>
				<tr><td height="25" align="center"><input type="button" value="확인" onClick="javascript:sendit();">
			</table>
		</td></tr>
	</table>
	</form>
<? } ?>