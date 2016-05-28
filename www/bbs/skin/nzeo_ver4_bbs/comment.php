<?
	$a_preview = str_replace(">","><font class=list_eng>",$a_preview)."&nbsp;&nbsp;";
	$a_imagebox = str_replace(">","><font class=list_eng>",$a_imagebox)."&nbsp;&nbsp;";
	$a_codebox = str_replace(">","><font class=list_eng>",$a_codebox)."&nbsp;&nbsp;";
?>

<table border=0 cellspacing=1 cellpadding=1 class=line1 width=<?=$width?>>
<tr>
	<td bgcolor=white>
		<table border=0 cellspacing=1 cellpadding=8 width=100% height=120 bgcolor=white>
		<form method=post name=write action=comment_ok.php onsubmit="return check_submit();" enctype=multipart/form-data><input type=hidden name="page" value="<?=$page?>"><input type=hidden name="id" value="<?=$id?>"><input type=hidden name=no value="<?=$no?>"><input type=hidden name=select_arrange value="<?=$select_arrange?>"><input type=hidden name=desc value="<?=$desc?>"><input type=hidden name=page_num value="<?=$page_num?>"><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=sm value="<?=$sm?>"><input type=hidden name=mode value="modify"><input type=hidden name=c_no value=<?=$c_no?>><input type=hidden name=antispam value="<?=$num1num2?>">
		<col width=70 align=right style=padding-right:10px></col><col width=></col>
		<?=$hide_start?>
		<tr>
			<td class=list0><font class=list_eng><b>Name</b></font></td>
			<td class=list1><input type=text name=name value="<?=$name?>" <?=size(8)?> maxlength=20 class=input></td>
		</tr>
		<tr>
			<td class=list0><font class=list_eng><b>Password</b></font></td>
			<td class=list1><input type=password name=password <?=size(8)?> maxlength=20 class=input></td>
		</tr>
		<?=$hide_end?>
		<tr>
			<td class=list0><font class=list_eng><b>Option</b></font></td>
			<td class=list_eng>
				<?=$hide_html_start?> <input type=checkbox name=use_html2<?=$use_html2?>> HTML사용 <?=$hide_html_end?>
				<?=$hide_secret_start?> <input type=checkbox name=is_secret <?=$secret?> value=1> 비밀글 <?=$hide_secret_end?>
			</td>
		</tr>
		<tr>	
			<td class=list0 onclick="document.getElementById('memo').rows=document.getElementById('memo').rows+4" style=cursor:pointer><font class=list_eng><b>Comment</b><br>▼</td>
			<td width=100% height=100% class=list1>
				<table border=0 cellspacing=2 cellpadding=0 width=100% height=100 style=table-layout:fixed>
				<col width=></col><col width=70></col>
				<tr>
					<td width=100%><textarea id=memo name=memo cols=20 rows=8 class=textarea style=width:100% onkeydown='return doTab(event);'><?=$memo?></textarea></td>
					<td width=70><input type=submit rows=5 class=submit value='수정하기' accesskey="s" style=height:100%></td>
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
<table border=0 width=<?=$width?> cellsapcing=1 cellpadding=0>
<tr>
	<td width=200 height=40>
		<?=$a_preview?>미리보기</a><?=$a_imagebox?>그림창고</a><?=$a_codebox?>코드삽입</a>
	</td>
</tr>
</table>
