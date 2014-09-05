
<!--========================[ 에디터 기능 사용유무 체크 ]=========================-->
<!-- 
사용자변수 chk_edit_use 는 직접 만들어야 합니다.
사용자변수(chk_edit_use)를 만들지 못한다면 아래처럼 바꾸세요.
if($chk_edit_use=="on")	를 if(true) 로 바꿉니다.
-->

<?	
if($emoticon_use=="on")			//<!-- 에디터 기능 사용유무 체크 -->
{
	$sw_edit_yn = "Y";			//<!-- HTML Editer 사용여부 -->
	$sw_edit_tag_yn = "N";		//<!-- HTML/Visual 모드 토글 -->
}else{
	$sw_edit_yn = "N";
	$sw_edit_tag_yn = "N";
};
?>
<!--========================[ 에디터 기능 사용유무 체크 ]=========================-->

<!--====================[ sw_edit 파일명: ed_seting_head.php ]====================-->

<input type='hidden' id='use_category_yn' name='use_category_yn' value='<? if($setup['use_category']) { echo("Y"); }else{ echo("N"); } ?>'>
<input type='hidden' id='member_yn' name='member_yn' value='<? if(!$member['no']) { echo("Y"); }else{ echo("N"); } ?>'>
<input type='hidden' id='subeva_yn' name='subeva_yn' value='<? if($member['is_admin']==1 && $mode == "write") { echo("Y"); }else{ echo("N"); } ?>'>
<SCRIPT language="JavaScript" src="<?=$dir?>/swe/write.js"></SCRIPT>

<input type='hidden' id='sw_edit_yn' name='sw_edit_yn' value='<?=$sw_edit_yn?>'>
<input type='hidden' id='sw_edit_tag_yn' name='sw_edit_tag_yn' value='<?=$sw_edit_tag_yn?>'>
<input type='hidden' id='sw_m_level' name='sw_m_level' value='<?=$member['level']?>'>
<input type='hidden' id='sw_s_grant_html' name='sw_s_grant_html' value='<?=$setup['grant_html']?>'>
<input type='hidden' id='sw_s_use_html' name='sw_s_use_html' value='<?=$setup['use_html']?>'>
<input type='hidden' id='sw_edit_use' name='sw_edit_use' value='write'>
<SCRIPT language="JavaScript" src="<?=$dir?>/swe/edit.js"></SCRIPT>

<input type='hidden' id='sw_mode' name='sw_mode' value="<?=$mode?>">				
<? if($mode == "modify") { ?>
<input type='hidden' id='sw_file_name1' name='sw_file_name1' value="<?=str_replace("%2F", "/", rawurlencode($data['file_name1']))?>">
<input type='hidden' id='sw_file_name2' name='sw_file_name2' value="<?=str_replace("%2F", "/", rawurlencode($data['file_name2']))?>">
<? } ?>		
<SCRIPT language="JavaScript" src="<?=$dir?>/swe/img_preview.js"></SCRIPT>

<? $zb_self_dir = dirname($_SERVER['PHP_SELF'])."/"; ?>
<input type='hidden' id='sw_skins_dir' name='sw_skins_dir' value="<?=$dir?>">
<input type='hidden' id='sw_d_zb_self_dir' name='sw_d_zb_self_dir' value="<?=$zb_self_dir?>">
<?
if($sw_edit_yn == "Y") {
	if($setup['use_html'] > 0) {
		echo("<SCRIPT language='JavaScript' src='$dir/swe/layers.js'></SCRIPT>");
	} else {
		echo("<SCRIPT language='JavaScript' src='$dir/swe/layers_no_grant.js'></SCRIPT>");
	}
}

if($type=="Movie_type"||$type=="Sell_type")
	$a_preview = str_replace("view_preview()","preview_m()",$a_preview);
else
	$a_preview = str_replace("view_preview()","sw_preview()",$a_preview);

$a_imagebox = str_replace("showImageBox","sw_imagebox",$a_imagebox);
$a_codebox = str_replace("showCodeBox","sw_codebox",$a_codebox);
if($mode == "reply") {	$memo = preg_replace("/>(<P>)|>(<P align=[a-z]+>)/i","$1$2>",$memo); }

include $dir."/swe/ed_seting_fileview.php";	
?>

<SCRIPT language="JavaScript">
  <!--
  	DocReloadInterval = setInterval("DocReload()", 300);	
	imgViewReloadInterval = setInterval("imgViewReload()", 300);	
  //-->
</SCRIPT>
<!--====================[ sw_edit 파일명: ed_seting_head.php 끝]====================-->
