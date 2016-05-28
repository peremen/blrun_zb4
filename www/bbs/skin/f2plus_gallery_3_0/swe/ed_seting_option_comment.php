
<!--====================[ sw_edit 파일명: ed_seting_option_comment.php ]====================-->

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
	<td style='padding:0 0 0 10;'>
		<label for='htChk'><input type='checkbox' id='htChk' name='htChk' onClick='javascript:htClick();' style='cursor:pointer;' value=1 checked><font class='sw_ft_style_1'>HTML</font></label>
	<? } else { ?>
	<td style='padding:0 0 0 10;'>
		<label for='htChk'><input type='checkbox' id='htChk' name='htChk' style='cursor:pointer;' value=1 checked disabled><font class='sw_ft_style_1'>HTML</font></label>
	<? } ?>
		<label for='use_html2'><input type='checkbox' id='use_html2' name='use_html2' <?=$use_html2?>><font class='sw_ft_style_1'>HTML적용</font></label>
		<?=$hide_secret_start?>
		<label for='is_secret'><input type=checkbox name=is_secret <?=$secret?> value=1><font class='sw_ft_style_1'>비밀글</font></label>
		<?=$hide_secret_end?>
	</td>
	<td align='right'>
	<table border='0' cellpadding='0' cellspacing='0'>
	<tr height='21'>
		<? if(!$member['no']) { ?>
		<td style='padding:0 10 0 0;'>
			<font class='sw_ft_style_1'>이름</font>
			<?=$c_name?>
		</td>
		<? } ?>

		<?=$hide_c_password_start?>
		<td style='padding:0 13 0 0;'>
			<font class='sw_ft_style_1'>암호</font>
			<input type='password' name='password' maxlength='20' style='width:60;' class='input'>
		</td>
		<?=$hide_c_password_end?>

		<td><input type='image' name='c_confirm' src='<?=$dir?>/images/sw_a_confirm.gif' style='cursor:pointer;' accesskey='s'></td>
	</tr>
	</table>
	</td>
</tr>
</table>