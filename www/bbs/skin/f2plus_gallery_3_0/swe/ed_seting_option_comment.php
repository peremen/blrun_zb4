
<!--====================[ sw_edit ���ϸ�: ed_seting_option_comment.php ]====================-->
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
	<td align='left' style='padding:0 0 0 10;'>
		<label for='htChk'> <input type='checkbox' id='htChk' name='htChk' onClick='javascript:htClick();' style='cursor:pointer;' value=1 checked><font class='sw_ft_style_1'>HTML</font></label>
<? } else { ?>
	<td align='left' style='padding:0 0 0 10;'>
		<label for='htChk'> <input type='checkbox' id='htChk' name='htChk' style='cursor:pointer;' value=1 checked disabled><font class='sw_ft_style_1'>HTML</font></label>
<? } ?>
		<label for='use_html2'> <input type='checkbox' id='use_html2' name='use_html2' <?=$use_html2?>><font class='sw_ft_style_1'>HTML����</font></label>
		<?=$hide_secret_start?><label for='is_secret'> <input type=checkbox name=is_secret id=is_secret <?=$secret?> value=1><font class='sw_ft_style_1'>��б�</font></label><?=$hide_secret_end?>

	</td>
	<td align='right'>
	<table border='0' cellpadding='0' cellspacing='0'>
	<tr height='21'>
		<td colspan='3' align='right'><font id="state"></font><font color=orange> ����� ���Է��ϸ� �ӽ������� ������! </font></td>
	</tr>
	<tr height='21'>
<? if(!$member['no']) { ?>
		<td style='padding:0 10 0 0;'>
			<font class='sw_ft_style_1'>�̸�</font><?=$c_name?>

		</td>
<? } ?>
<?=$hide_c_password_start?>

		<td style='padding:0 13 0 0;'>
			<font class='sw_ft_style_1'>��ȣ</font>
			<input type='password' id='password' name='password' size='8' maxlength='20' class='input' onkeyup="ajaxLoad2()">
		</td>
<?=$hide_c_password_end?>

		<td>&nbsp;<img src=<?=$dir?>/images/bt_imsi_ok.gif border=0 accesskey="a" onclick=autoSave_n() style="cursor:pointer">&nbsp;<input type='image' name='c_confirm' src='<?=$dir?>/images/sw_a_confirm.gif' style='cursor:pointer;' accesskey='s'></td>
	</tr>
	</table>
	</td>
</tr>
</table>
<!--====================[ sw_edit ���ϸ�: ed_seting_option_comment.php ��]====================-->
