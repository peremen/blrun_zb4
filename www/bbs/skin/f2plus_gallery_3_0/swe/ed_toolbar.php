
<!--====================[ sw_edit 파일명: ed_toolbar.php ]====================-->

<table width='100%' border='0' cellpadding='0' cellspacing='0'>
<tr>
	<td align='left'>
		<table border='0' cellpadding='0' cellspacing='0'>
		<tr>
			<td>
				<select id='ed_font' onchange='command(this)'>
				<option>글자체</option>
				<option value='돋움'>돋움</option>
				<option value='돋움체'>돋움체</option>
				<option value='굴림'>굴림</option>
				<option value='굴림체'>굴림체</option>
				<option value='바탕'>바탕</option>
				<option value='바탕체'>바탕체</option>
				<option value='궁서'>궁서</option>
				<option value='궁서체'>궁서체</option>
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
				<option>글자크기</option>
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
		
			<td><a onClick='javascript:command(this,event);' id='ed_emoticon' title='이모티콘' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_emoticon.gif' border='0' width='18' height='18' id='ed_emoticon_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td style='padding:0 2 0 2;'><a onClick='javascript:command(this,event);' id='ed_asword' title='특수문자' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_asword.gif' border='0' width='18' height='18' id='ed_asword_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command(this,event);' id='ed_urlmedia' title='미디어삽입' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_urlmedia.gif' border='0' width='18' height='18' id='ed_urlmedia_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td style='padding:0 3 0 2;'><a onClick='javascript:command(this,event);' id='ed_urlimage' title='그림삽입' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_urlimage.gif' border='0' width='18' height='18' id='ed_urlimage_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command(this,event);' id='ed_createLink' title='링크걸기' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_createLink.gif' border='0' width='18' height='18' id='ed_createLink_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			
		
			<td style='padding:0 5 0 5;'><img src='<?=$dir?>/images/spacer_0.gif' border='0' width='1' height='20'></td>
			<td><a onClick='javascript:command(this,event);' id='ed_hr' title='선긋기' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_hr.gif' border='0' width='18' height='18' id='ed_hr_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td style='padding:0 5 0 5;'><img src='<?=$dir?>/images/spacer_0.gif' border='0' width='1' height='20'></td>		
			<td><a onClick='javascript:command(this,event);' id='ed_table' title='표만들기' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_table.gif' border='0' width='18' height='18' id='ed_table_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command(this,event);' id='ed_tablebgcolor' title='표배경색' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_tablebgcolor.gif' border='0' width='18' height='18' id='ed_tablebgcolor_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
		
			<td style='padding:0 5 0 5;'><img src='<?=$dir?>/images/spacer_0.gif' border='0' width='1' height='20'></td>
		
			<td><a onClick='javascript:command(this,event);' id='ed_height_in' title='창높이확대' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_height_in.gif' border='0' width='18' height='18' id='ed_height_out_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command(this,event);' id='ed_height_out' title='창높이축소' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_height_out.gif' border='0' width='18' height='18' id='ed_height_in_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command(this,event);' id='ed_height_default' title='창높이기본' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_height_default.gif' border='0' width='18' height='18' id='ed_height_default_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
		
			<td style='padding:0 5 0 5;'><img src='<?=$dir?>/images/spacer_0.gif' border='0' width='1' height='20'></td>
		
			<td><a onClick='javascript:command(this,event);' id='ed_newdoc' title='새문서' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_newdoc.gif' border='0' width='18' height='18' id='ed_newdoc_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
		</tr>
		</table>
	</td>
</tr>

<tr><td style='padding:3 0 3 0;'><img src='<?=$dir?>/images/spacer_0.gif' border='0' width='100%' height='1'></td></tr>

<tr>
	<td align='left'>
		<table border='0' cellpadding='0' cellspacing='0'>
		<tr>
			<td><a onClick='javascript:command(this,event);' id='ed_bold' title='굵게' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_bold.gif' border='0' width='18' height='18' id='ed_bold_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command(this,event);' id='ed_italic' title='기울이기' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_italic.gif' border='0' width='18' height='18' id='ed_italic_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command(this,event);' id='ed_underline' title='밑줄' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_underline.gif' border='0' width='18' height='18' id='ed_underline_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command(this,event);' id='ed_strikethrough' title='삭제선' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_strikethrough.gif' border='0' width='18' height='18' id='ed_strikethrough_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
		
			<td style='padding:0 5 0 5;'><img src='<?=$dir?>/images/spacer_0.gif' border='0' width='1' height='20'></td>
		
			<td><a onClick='javascript:command(this,event);' id='ed_fontcolor' title='글자색' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_fontcolor.gif' border='0' width='18' height='18' id='ed_fontcolor_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command(this,event);' id='ed_fontbgcolor' title='글자배경색' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_fontbgcolor.gif' border='0' width='18' height='18' id='ed_fontbgcolor_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
		
			<td style='padding:0 5 0 5;'><img src='<?=$dir?>/images/spacer_0.gif' border='0' width='1' height='20'></td>
		
			<td><a onClick='javascript:command(this,event);' id='ed_selectall' title='모두선택' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_selectall.gif' border='0' width='18' height='18' id='ed_selectall_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command(this,event);' id='ed_cut' title='잘라내기' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_cut.gif' border='0' width='18' height='18' id='ed_cut_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command(this,event);' id='ed_copy' title='복사하기' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_copy.gif' border='0' width='18' height='18' id='ed_copy_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td style='padding:0 3 0 3;'><a onClick='javascript:command(this,event);' id='ed_paste' title='붙여넣기' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_paste.gif' border='0' width='18' height='18' id='ed_paste_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command(this,event);' id='ed_search' title='찾기' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_search.gif' border='0' width='18' height='18' id='ed_search_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td style='padding:0 3 0 3;'><a onClick='javascript:command(this,event);' id='ed_print' title='프린트' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_print.gif' border='0' width='18' height='18' id='ed_print_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command(this,event);' id='ed_saveas' title='현재 내용 저장' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_saveas.gif' border='0' width='18' height='18' id='ed_saveas_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
		
			<td style='padding:0 5 0 5;'><img src='<?=$dir?>/images/spacer_0.gif' border='0' width='1' height='20'></td>
		
			<td><a onClick='javascript:command(this,event);' id='ed_left' title='왼쪽정렬' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_left.gif' border='0' width='18' height='18' id='ed_left_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command(this,event);' id='ed_center' title='가운데정렬' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_center.gif' border='0' width='18' height='18' id='ed_center_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command(this,event);' id='ed_right' title='오른쪽정렬' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_right.gif' border='0' width='18' height='18' id='ed_right_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
		
			<td style='padding:0 5 0 5;'><img src='<?=$dir?>/images/spacer_0.gif' border='0' width='1' height='20'></td>
		
			<td><a onClick='javascript:command(this,event);' id='ed_numlist' title='숫자기호' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_numlist.gif' border='0' width='18' height='18' id='ed_numlist_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command(this,event);' id='ed_itemlist' title='문자기호' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_itemlist.gif' border='0' width='18' height='18' id='ed_itemlist_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command(this,event);' id='ed_outdent' title='탭줄이기' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_outdent.gif' border='0' width='18' height='18' id='ed_outdent_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
			<td><a onClick='javascript:command(this,event);' id='ed_indent' title='탭늘이기' class='a_style_0'><img src='<?=$dir?>/images/edbtn/ed_indent.gif' border='0' width='18' height='18' id='ed_indent_img' onmouseover='buttonover(this)' onmouseout='buttonout(this)'></a></td>
		</tr>
		</table>
	</td>
</tr>
</table>
