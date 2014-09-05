
<!--====================[ sw_edit 파일명: ed_toolbar_no_grant.php ]====================-->
<table width='100%' border='0' cellpadding='0' cellspacing='0'>
<tr>
	<td align='left'>
		<table border='0' cellpadding='0' cellspacing='0'>
		<tr>
			<td><a onClick='javascript:command_no_grant(this,event);' id='ed_bold' title='굵게' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_bold.gif' border='0' width='18' height='18' id='ed_bold_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command_no_grant(this,event);' id='ed_italic' title='기울이기' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_italic.gif' border='0' width='18' height='18' id='ed_italic_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command_no_grant(this,event);' id='ed_underline' title='밑줄' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_underline.gif' border='0' width='18' height='18' id='ed_underline_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td style='padding:0 5 0 5;'><img src='<?=$dir?>/images/spacer_0.gif' border='0' width='1' height='20'></td>
			<td><a onClick='javascript:command_no_grant(this,event);' id='ed_fontcolor' title='글자색' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_fontcolor.gif' border='0' width='18' height='18' id='ed_fontcolor_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command_no_grant(this,event);' id='ed_fontbgcolor' title='글자배경색' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_fontbgcolor.gif' border='0' width='18' height='18' id='ed_fontbgcolor_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td style='padding:0 5 0 5;'><img src='<?=$dir?>/images/spacer_0.gif' border='0' width='1' height='20'></td>
			<td><a onClick='javascript:command_no_grant(this,event);' id='ed_emoticon' title='이모티콘' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_emoticon.gif' border='0' width='18' height='18' id='ed_emoticon_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td style='padding:0 0 0 2;'><a onClick='javascript:command_no_grant(this,event);' id='ed_asword' title='특수문자' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_asword.gif' border='0' width='18' height='18' id='ed_asword_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td style='padding:0 5 0 5;'><img src='<?=$dir?>/images/spacer_0.gif' border='0' width='1' height='20'></td>
			<td><a onClick='javascript:command_no_grant(this,event);' id='ed_selectall' title='모두선택' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_selectall.gif' border='0' width='18' height='18' id='ed_selectall_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command_no_grant(this,event);' id='ed_cut' title='잘라내기' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_cut.gif' border='0' width='18' height='18' id='ed_cut_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command_no_grant(this,event);' id='ed_copy' title='복사하기' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_copy.gif' border='0' width='18' height='18' id='ed_copy_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td style='padding:0 3 0 3;'><a onClick='javascript:command_no_grant(this,event);' id='ed_paste' title='붙여넣기' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_paste.gif' border='0' width='18' height='18' id='ed_paste_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command_no_grant(this,event);' id='ed_search' title='찾기' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_search.gif' border='0' width='18' height='18' id='ed_search_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td style='padding:0 3 0 3;'><a onClick='javascript:command_no_grant(this,event);' id='ed_print' title='프린트' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_print.gif' border='0' width='18' height='18' id='ed_print_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command_no_grant(this,event);' id='ed_saveas' title='현재 내용 저장' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_saveas.gif' border='0' width='18' height='18' id='ed_saveas_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td style='padding:0 5 0 5;'><img src='<?=$dir?>/images/spacer_0.gif' border='0' width='1' height='20'></td>
			<td><a onClick='javascript:command_no_grant(this,event);' id='ed_height_in' title='창높이확대' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_height_in.gif' border='0' width='18' height='18' id='ed_height_out_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command_no_grant(this,event);' id='ed_height_out' title='창높이축소' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_height_out.gif' border='0' width='18' height='18' id='ed_height_in_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command_no_grant(this,event);' id='ed_height_default' title='창높이기본' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_height_default.gif' border='0' width='18' height='18' id='ed_height_default_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td style='padding:0 5 0 5;'><img src='<?=$dir?>/images/spacer_0.gif' border='0' width='1' height='20'></td>
			<td><a onClick='javascript:command_no_grant(this,event);' id='ed_newdoc' title='새문서' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_newdoc.gif' border='0' width='18' height='18' id='ed_newdoc_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
		</tr>
		</table>
	</td>
</tr>
</table>
<!--====================[ sw_edit 파일명: ed_toolbar_no_grant.php 끝]====================-->
