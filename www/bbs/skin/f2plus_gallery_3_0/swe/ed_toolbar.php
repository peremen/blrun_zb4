
<!--====================[ sw_edit ���ϸ�: ed_toolbar.php ]====================-->

<table width='100%' border='0' cellpadding='0' cellspacing='0'>
<tr>
	<td align='left'>
		<table border='0' cellpadding='0' cellspacing='0'>
		<tr>
			<td>
				<select id='ed_font' onchange='command(this)'>
				<option>����ü</option>
				<option value='����'>����</option>
				<option value='����ü'>����ü</option>
				<option value='����'>����</option>
				<option value='����ü'>����ü</option>
				<option value='����'>����</option>
				<option value='����ü'>����ü</option>
				<option value='�ü�'>�ü�</option>
				<option value='�ü�ü'>�ü�ü</option>
				<option value='Arial'>Arial</option>
				<option value='Tahoma'>Tahoma</option>
				<option value='Times New Roman'>Times</option>
				<option value='Verdana'>Verdana</option>
				<option value='Courier'>Courier</option>
				</select>
			</td>
		
			<td style='padding:0 3 0 0;'></td>
		
			<td>
				<select id='ed_fontsize' onchange='command(this)'>
				<option>����ũ��</option>
				<option value='1'>8pt</option>
				<option value='2'>10pt</option>
				<option value='3'>12pt</option>
				<option value='4'>14pt</option>
				<option value='5'>18pt</option>
				<option value='6'>24pt</option>
				<option value='7'>36pt</option>
				</select>
			</td>
		
			<td style='padding:0 5 0 6;'><img src='<?=$dir?>/images/spacer_0.gif' border='0' width='1' height='20'></td>
		
			<td><a onClick='javascript:command(this,event);' id='ed_emoticon' title='�̸�Ƽ��' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_emoticon.gif' border='0' width='18' height='18' id='ed_emoticon_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td style='padding:0 2 0 2;'><a onClick='javascript:command(this,event);' id='ed_asword' title='Ư������' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_asword.gif' border='0' width='18' height='18' id='ed_asword_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command(this,event);' id='ed_urlmedia' title='�̵�����' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_urlmedia.gif' border='0' width='18' height='18' id='ed_urlmedia_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td style='padding:0 3 0 2;'><a onClick='javascript:command(this,event);' id='ed_urlimage' title='�׸�����' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_urlimage.gif' border='0' width='18' height='18' id='ed_urlimage_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command(this,event);' id='ed_createLink' title='��ũ�ɱ�' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_createLink.gif' border='0' width='18' height='18' id='ed_createLink_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			
		
			<td style='padding:0 5 0 5;'><img src='<?=$dir?>/images/spacer_0.gif' border='0' width='1' height='20'></td>
			<td><a onClick='javascript:command(this,event);' id='ed_hr' title='���߱�' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_hr.gif' border='0' width='18' height='18' id='ed_hr_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td style='padding:0 5 0 5;'><img src='<?=$dir?>/images/spacer_0.gif' border='0' width='1' height='20'></td>		
			<td><a onClick='javascript:command(this,event);' id='ed_table' title='ǥ�����' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_table.gif' border='0' width='18' height='18' id='ed_table_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command(this,event);' id='ed_tablebgcolor' title='ǥ����' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_tablebgcolor.gif' border='0' width='18' height='18' id='ed_tablebgcolor_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
		
			<td style='padding:0 5 0 5;'><img src='<?=$dir?>/images/spacer_0.gif' border='0' width='1' height='20'></td>
		
			<td><a onClick='javascript:command(this,event);' id='ed_height_in' title='â����Ȯ��' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_height_in.gif' border='0' width='18' height='18' id='ed_height_out_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command(this,event);' id='ed_height_out' title='â�������' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_height_out.gif' border='0' width='18' height='18' id='ed_height_in_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command(this,event);' id='ed_height_default' title='â���̱⺻' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_height_default.gif' border='0' width='18' height='18' id='ed_height_default_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
		
			<td style='padding:0 5 0 5;'><img src='<?=$dir?>/images/spacer_0.gif' border='0' width='1' height='20'></td>
		
			<td><a onClick='javascript:command(this,event);' id='ed_newdoc' title='������' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_newdoc.gif' border='0' width='18' height='18' id='ed_newdoc_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
		</tr>
		</table>
	</td>
</tr>

<tr><td style='padding:3 0 3 0;'><img src='<?=$dir?>/images/spacer_0.gif' border='0' width='100%' height='1'></td></tr>

<tr>
	<td align='left'>
		<table border='0' cellpadding='0' cellspacing='0'>
		<tr>
			<td><a onClick='javascript:command(this,event);' id='ed_bold' title='����' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_bold.gif' border='0' width='18' height='18' id='ed_bold_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command(this,event);' id='ed_italic' title='����̱�' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_italic.gif' border='0' width='18' height='18' id='ed_italic_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command(this,event);' id='ed_underline' title='����' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_underline.gif' border='0' width='18' height='18' id='ed_underline_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command(this,event);' id='ed_strikethrough' title='������' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_strikethrough.gif' border='0' width='18' height='18' id='ed_strikethrough_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
		
			<td style='padding:0 5 0 5;'><img src='<?=$dir?>/images/spacer_0.gif' border='0' width='1' height='20'></td>
		
			<td><a onClick='javascript:command(this,event);' id='ed_fontcolor' title='���ڻ�' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_fontcolor.gif' border='0' width='18' height='18' id='ed_fontcolor_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command(this,event);' id='ed_fontbgcolor' title='���ڹ���' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_fontbgcolor.gif' border='0' width='18' height='18' id='ed_fontbgcolor_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
		
			<td style='padding:0 5 0 5;'><img src='<?=$dir?>/images/spacer_0.gif' border='0' width='1' height='20'></td>
		
			<td><a onClick='javascript:command(this,event);' id='ed_selectall' title='��μ���' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_selectall.gif' border='0' width='18' height='18' id='ed_selectall_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command(this,event);' id='ed_cut' title='�߶󳻱�' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_cut.gif' border='0' width='18' height='18' id='ed_cut_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command(this,event);' id='ed_copy' title='�����ϱ�' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_copy.gif' border='0' width='18' height='18' id='ed_copy_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td style='padding:0 3 0 3;'><a onClick='javascript:command(this,event);' id='ed_paste' title='�ٿ��ֱ�' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_paste.gif' border='0' width='18' height='18' id='ed_paste_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command(this,event);' id='ed_search' title='ã��' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_search.gif' border='0' width='18' height='18' id='ed_search_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td style='padding:0 3 0 3;'><a onClick='javascript:command(this,event);' id='ed_print' title='����Ʈ' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_print.gif' border='0' width='18' height='18' id='ed_print_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command(this,event);' id='ed_saveas' title='���� ���� ����' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_saveas.gif' border='0' width='18' height='18' id='ed_saveas_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
		
			<td style='padding:0 5 0 5;'><img src='<?=$dir?>/images/spacer_0.gif' border='0' width='1' height='20'></td>
		
			<td><a onClick='javascript:command(this,event);' id='ed_left' title='��������' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_left.gif' border='0' width='18' height='18' id='ed_left_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command(this,event);' id='ed_center' title='�������' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_center.gif' border='0' width='18' height='18' id='ed_center_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command(this,event);' id='ed_right' title='����������' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_right.gif' border='0' width='18' height='18' id='ed_right_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
		
			<td style='padding:0 5 0 5;'><img src='<?=$dir?>/images/spacer_0.gif' border='0' width='1' height='20'></td>
		
			<td><a onClick='javascript:command(this,event);' id='ed_numlist' title='���ڱ�ȣ' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_numlist.gif' border='0' width='18' height='18' id='ed_numlist_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command(this,event);' id='ed_itemlist' title='���ڱ�ȣ' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_itemlist.gif' border='0' width='18' height='18' id='ed_itemlist_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command(this,event);' id='ed_outdent' title='�����̱�' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_outdent.gif' border='0' width='18' height='18' id='ed_outdent_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command(this,event);' id='ed_indent' title='�Ǵ��̱�' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_indent.gif' border='0' width='18' height='18' id='ed_indent_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
		</tr>
		</table>
	</td>
</tr>
</table>
