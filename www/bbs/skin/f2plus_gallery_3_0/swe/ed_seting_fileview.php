<?
/* ====================[ sw_edit 파일명: ed_seting_fileview.php ]==================== */

function filebox_add($fnumber,$fname)
{
	$fname = str_replace("<br>","&nbsp;첨부파일:",$fname);
	$fname = str_replace("이 등록되어 있습니다.","",$fname);

	$filebox_add="<table width='100%' cellpadding='0' cellspacing='0' style='border:0'><tr><td>";
	$filebox_add=$filebox_add."<input type='file' name='file".$fnumber."' maxlength='255' class='input' style='width:100%;' onLoad='imgfile_ad_view()'>";
	$filebox_add=$filebox_add."</td></tr><tr><td>";
	$filebox_add=$filebox_add."<img id='img_view_".$fnumber."' style='display:none;'>".$fname;
	$filebox_add=$filebox_add."</td></tr></table>";

	return $filebox_add;
}
?>
