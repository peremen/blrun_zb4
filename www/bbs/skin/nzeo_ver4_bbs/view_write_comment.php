
<img src=<?=$dir?>/t.gif border=0 height=4><br>
<table border=0 cellspacing=1 cellpadding=1 class=line1 width=<?=$width?>>
<tr>
	<td bgcolor=white>
		<table border=0 cellspacing=1 cellpadding=8 width=100% height=120 bgcolor=white>
		<form method=post id=write name=write action=comment_ok.php onsubmit="return check_submit();" enctype=multipart/form-data><input type=hidden name="page" value="<?=$page?>"><input type=hidden name="id" value="<?=$id?>"><input type=hidden name=no value="<?=$no?>"><input type=hidden name=select_arrange value="<?=$select_arrange?>"><input type=hidden name=desc value="<?=$desc?>"><input type=hidden name=page_num value="<?=$page_num?>"><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=sm value="<?=$sm?>"><input type=hidden name=mode value="write"><input type=hidden name=antispam value="<?=$num1num2?>">
		<col width=70 align=right style=padding-right:10px></col><col width=></col>
<?if(!$member['no']){?>
		<tr>
			<td align=right class=list0><font class=list_eng><b>Name</b></font></td>
			<td align=left class=list1><font class=list_han><?=$c_name?></font></td>
		</tr>
<?}?>
		<?=$hide_c_password_start?>

		<tr>
			<td align=right class=list0><font class=list_eng><b>Password</b></font></td>
			<td align=left class=list1><input type=password id=password name=password <?=size(8)?> maxlength=20 class=input onkeyup="ajaxLoad2()"> ����� ���Է��ϸ� �ӽ������� ������</td>
		</tr>
		<?=$hide_c_password_end?>

		<tr>
			<td align=right class=list0><font class=list_eng><b>Option</b></font></td>
			<td align=left class=list_eng><?=$hide_html_start?> <input type=checkbox id=use_html2 name=use_html2<?=$use_html2?>>HTML���<?=$hide_html_end?><?=$hide_secret_start?> <input type=checkbox id=is_secret name=is_secret <?=$secret?> value=1>��б�<?=$hide_secret_end?> <font id="state"></font></td>
		</tr>
		<tr>	
			<td align=right class=list0 onclick="document.getElementById('memo').rows=document.getElementById('memo').rows+4" style=cursor:pointer><font class=list_eng><b>Comment</b><br>��</font></td>
			<td align=left width=100% height=100% class=list1>
				<table border=0 cellspacing=2 cellpadding=0 width=100% height=100 style=table-layout:fixed>
				<col width=></col><col width=70></col>
				<tr>
					<td width=100%><textarea id=memo name=memo cols=20 rows=8 class=textarea style=width:100% onkeydown='return doTab(event);' onkeyup="addStroke()"></textarea></td>
					<td width=70><input type=button value='�ӽ�����' onclick=autoSave() accesskey="a" style="height:50%"><br><input type=submit class=submit value='�ۼ��Ϸ�' accesskey="s" style="height:50%"></td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan=2 class=list1>
				<table border=0 cellspacing=2 cellpadding=0 width=100% height=20>
				<col width=5%></col><col width=45%></col><col width=5%></col><col width=45%></col>
				<tr valign=top>
				  <td width=52 align=right>
				  <?=$hide_pds_start?><font class=list_eng>Upload #1</font></td>
				  <td align=left class=list_eng><input type=file name=file1 <?=size(50)?> maxlength=255 class=input style=width:99%></td>
				  <td width=52 align=right><font class=list_eng>Upload #2</font></td>
				  <td align=left class=list_eng><input type=file name=file2 <?=size(50)?> maxlength=255 class=input style=width:99%><?=$hide_pds_end?></td>
				</tr>
				</table>
			</td>
		</tr>
		</form>
		</table>
	</td>
</tr>
</table>
