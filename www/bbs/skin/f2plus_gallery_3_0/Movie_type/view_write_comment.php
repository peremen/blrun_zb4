<?
	include $dir."/swe/ed_seting_head_comment.php";

	$align="right";
	if($member[no]){
		$align="left";
	}
?>

<a name="m_review_w"><img src=<?=$dir?>/images/t.gif border=0 height=4></a><br>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> align=center>
<form method=post id=write name=write action=<?=$dir?>/comment_ok.php onsubmit="return check_comment_submit();" enctype=multipart/form-data><input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=sm value="<?=$sm?>"><input type=hidden name=mode value="write"><input type=hidden name=_zb_path value="<?=$config_dir?>"><input type=hidden name=_zb_url value="<?=$_zb_url?>"><input type=hidden name=antispam value="<?=$num1num2?>">
<col width=10></col><col width=></col><col width=10></col>
<tr valign=top>
	<td height=9 background=<?=$dir?>/images/cc_head_bg1.gif></td>
	<td background=<?=$dir?>/images/cc_head_bg2.gif></td>
	<td background=<?=$dir?>/images/cc_head_bg3.gif></td>
</tr>
<tr>
	<td background=<?=$dir?>/images/cc_middle_bg1.gif></td>
	<td>
		<table border='0' cellpadding='0' cellspacing='0' width='100%'>
		<tr height='21'>
<? if($sw_edit_yn == "N") { ?>
			<td nowrap width='1%'><a onClick='javascript:edit_window_size("height_in");' style='cursor:pointer;'><img src='<?=$dir?>/images/edbtn/ed_height_in.gif' border='0' width='18' height='18'></a></td>
			<td nowrap width='1%'><a onClick='javascript:edit_window_size("height_out");' style='cursor:pointer;'><img src='<?=$dir?>/images/edbtn/ed_height_out.gif' border='0' width='18' height='18'></a></td>
			<td nowrap width='1%'><a onClick='javascript:edit_window_size("height_default");' style='cursor:pointer;'><img src='<?=$dir?>/images/edbtn/ed_height_default.gif' border='0' width='18' height='18'></a></td>
<? } ?>
<? if($sw_edit_yn == "Y") { ?>
			<td nowrap width='1%'><a id='sw_ed_yn_f' onClick='javascript:ed_c_editdiv_v();' style='cursor:pointer;'><img src='<?=$dir?>/images/sw_c_wedityes.gif' border='0'></a></td>
<? } ?>
<? if($sw_edit_yn == "Y" || $sw_edit_tag_yn == "Y") { ?>
			<td style='padding:0 0 0 10;' align='left' nowrap width='1%'>
				<label for='htChk'> <input type='checkbox' id='htChk' name='htChk' onClick='javascript:htClick();' style='cursor:pointer;' value=1 checked><font class='sw_ft_style_1'> HTML</font></label>
<? } else { ?>
			<td style='padding:0 0 0 10;' align='left' nowrap width='1%'>
				<label for='htChk'> <input type='checkbox' id='htChk' name='htChk' style='cursor:pointer;' value=1 checked disabled><font class='sw_ft_style_1'> HTML</font></label>
<? } ?>
				<label for='use_html2'> <input type='checkbox' id='use_html2' name='use_html2' <?=$use_html2?>><font class='sw_ft_style_1'> HTML적용</font></label>
<?=$hide_secret_start?>

				<label for='is_secret'> <input type=checkbox id=is_secret name=is_secret <?=$secret?> value=1><font class='sw_ft_style_1'> 비밀글</font></label>
<?=$hide_secret_end?>

			</td>
			<td align='right' width='100%'>
			<table border='0' cellpadding='0' cellspacing='0'>
			<tr height='21'>
				<td colspan='3' align='right'><font id="state"></font><font color=orange> 비번을 재입력하면 임시저장이 복원됨! </font></td>
			</tr>
			<tr height='21' >
<? if(!$member['no']) { ?>
				<td valign=top style='padding:0 10 0 0;' nowrap>
					<font class='sw_ft_style_1'>이름</font><?=$c_name?>
				</td>
<? } ?>
<?=$hide_c_password_start?>

				<td valign=top style='padding:0 13 0 0;' nowrap>
					<font class='sw_ft_style_1'>암호</font><input type='password' id='password' name='password' maxlength='20' style='width:60px;' class='input' onkeyup="ajaxLoad2()">
				</td>
<?=$hide_c_password_end?>

<? if($member['no']) { ?>
				<td valign=top >
				<select name="_point1">
					<option value=0 style=background-color:#ffffff;color:#555555 selected>포인트</option>
					<option value=1 style=background-color:#ffffff;color:#888888>★</option>
					<option value=2 style=background-color:#ffffff;color:#666666>★★</option>
					<option value=3 style=background-color:#ffffff;color:#444444>★★★</option>
					<option value=4 style=background-color:#ffffff;color:#222222>★★★★</option>
					<option value=5 style=background-color:#ffffff;color:#000000>★★★★★</option>
				</select></td>
				<td valign=top>
				<select name="_point2">
					<option value=0 style=background-color:#ffffff;color:#555555 selected>절반</option>
					<option value=1 style=background-color:#ffffff;color:black>☆</option>
				</select></td>
<? } ?>
				<td valign=top>&nbsp;<img src=<?=$dir?>/images/bt_imsi_ok.gif border=0 accesskey="a" onclick=autoSave_n() style="cursor:pointer">&nbsp;<input type='image' name='c_confirm' src='<?=$dir?>/images/sw_a_confirm.gif' style='cursor:pointer;' accesskey='s'></td>
			</tr>
			</table>
			</td>
		</tr>
		</table>
		<? include $dir."/swe/ed_seting_edit.php"; ?>
	</td>
	<td background=<?=$dir?>/images/cc_middle_bg2.gif></td>
</tr>
</table>
<table border=0 width=<?=$width?> cellspacing=0 cellpadding=0 align=center style=table-layout:fixed>
<col width=10></col><col width=></col><col width=200></col><col width=10></col>
<tr valign=bottom height=9>
	<td background=<?=$dir?>/images/cc_foot_bg1-1.gif></td>
	<td background=<?=$dir?>/images/cc_foot_bg1-2.gif></td>
	<td background=<?=$dir?>/images/cc_foot_bg1-2.gif></td>
	<td background=<?=$dir?>/images/cc_foot_bg1-3.gif></td>
</tr>
</table>
<table border=0 cellspacing=2 cellpadding=0 width=100% height=20>
<col width=5%></col><col width=45%></col><col width=5%></col><col width=45%></col>
<tr valign=top>
<?=$hide_pds_start?>

	<td width=52 align=right><font class=list_eng>Upload #1</font></td>
	<td align=left class=list_eng><input type=file name=file1 <?=size(50)?> maxlength=255 class=input style=width:99%></td>
	<td width=52 align=right><font class=list_eng>Upload #2</font></td>
	<td align=left class=list_eng><input type=file name=file2 <?=size(50)?> maxlength=255 class=input style=width:99%></td>
<?=$hide_pds_end?>

</tr>
</form>
</table>
<BR>
