<? // ====================[ sw_edit 파일명: ed_seting_option.php ]==================== ?>

<? if($sw_edit_yn == "Y" || $sw_edit_tag_yn == "Y") { ?>
		<label for='htChk'> <input type='checkbox' id='htChk' name='htChk' onClick='javascript:htClick();' style='cursor:pointer;' value=1 checked>HTML</label>
<? } else { ?>
		<label for='htChk'> <input type='checkbox' id='htChk' name='htChk' style='cursor:pointer;' value=1 checked disabled>HTML</label>
<? } ?>
		<label for='use_html'> <input type='checkbox' id='use_html' name='use_html' <?=$use_html?>>HTML적용</label>
