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

	?>
	<img src=<?=$dir?>/t.gif border=0 height=4><br>
	<table border=0 cellspacing=1 cellpadding=1 class=line1 width=<?=$width?>>
	<tr>
		<td bgcolor=white>
			<table border=0 cellspacing=1 cellpadding=8 width=100% height=120 bgcolor=white>
			<form method=post name=write action=comment_ok.php onsubmit="return check_submit();" enctype=multipart/form-data><input type=hidden name="page" value="<?=$page?>"><input type=hidden name="id" value="<?=$id?>"><input type=hidden name=no value="<?=$no?>"><input type=hidden name=select_arrange value="<?=$select_arrange?>"><input type=hidden name=desc value="<?=$desc?>"><input type=hidden name=page_num value="<?=$page_num?>"><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=sm value="<?=$sm?>"><input type=hidden name=mode value="write"><input type=hidden name=antispam value="<?=$num1num2?>">
			<col width=70 align=right style=padding-right:10px></col><col width=></col>
			<?if(!$member['no']){?>
			<tr>
				<td class=list0><font class=list_eng><b>Name</b></font></td>
				<td class=list1><font class=list_han><? $c_name=stripslashes($c_name); echo $c_name; ?></font></td>
			</tr>
			<?}?>
			<?=$hide_c_password_start?>
			<tr>
				<td class=list0><font class=list_eng><b>Password</b></font></td>
				<td class=list1><input type=password name=password <?=size(8)?> maxlength=20 class=input></td>
			</tr>
			<?=$hide_c_password_end?>
			<tr>
				<td class=list0><font class=list_eng><b>Option</b></font></td>
				<td class=list_eng>
					<?=$hide_html_start?> <input type=checkbox name=use_html2<?=$use_html2?>> HTML사용 <?=$hide_html_end?>
					<?=$hide_secret_start?> <input type=checkbox name=is_secret <?=$secret?> value=1> 비밀글 <?=$hide_secret_end?>
				</td>
			</tr>
			<tr>	
				<td class=list0 onclick="document.getElementById('memo').rows=document.getElementById('memo').rows+4" style=cursor:pointer><font class=list_eng><b>Comment</b><br>▼</font></td>
				<td width=100% height=100% class=list1>
					<table border=0 cellspacing=2 cellpadding=0 width=100% height=100 style=table-layout:fixed>
					<col width=></col><col width=70></col>
					<tr>
						<td width=100%><textarea id=memo name=memo cols=20 rows=8 class=textarea style=width:100% onkeydown='return doTab(event);'></textarea></td>
						<td width=70><input type=submit rows=5 class=submit value=' 글쓰기 ' accesskey="s" style=height:100%></td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan=2 class=list1>
					<table border=0 cellspacing=2 cellpadding=0 width=100% height=20>
					<col width=5%></col><col width=45%></col><col width=5%></col><col width=45%></col>
					<tr valign=top>
					  <td width=52 align=right><?=$hide_pds_start?><font class=list_eng>Upload #1</font></td>
					  <td class=list_eng><input type=file name=file1 <?=size(50)?> maxlength=255 class=input style=width:99%></td>
					  <td width=52 align=right><font class=list_eng>Upload #2</font></td>
					  <td class=list_eng><input type=file name=file2 <?=size(50)?> maxlength=255 class=input style=width:99%><?=$hide_pds_end?></td>
					</tr>
					</table>
				</td>
			</tr>
			</form>
			</table>
		</td>
	</tr>
	</table>
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