
<!--========================[ ������ ��� ������� üũ ]=========================-->
<!-- 
����ں��� chk_edit_use �� ���� ������ �մϴ�.
����ں���(chk_edit_use)�� ������ ���Ѵٸ� �Ʒ�ó�� �ٲټ���.
if($chk_edit_use=="on")	�� if(true) �� �ٲߴϴ�.
-->

<?	
if($emoticon_use=="on")			//<!-- ������ ��� ������� üũ -->
{
	$sw_edit_yn = "Y";			//<!-- HTML Editer ��뿩�� -->
	$sw_edit_tag_yn = "N";		//<!-- HTML/Visual ��� ��� -->
}else{
	$sw_edit_yn = "N";
	$sw_edit_tag_yn = "N";
};
?>
<!--========================[ ������ ��� ������� üũ ]=========================-->

<!--====================[ sw_edit ���ϸ�: ed_seting_head_comment.php ]====================-->
<input type='hidden' id='member_yn' name='member_yn' value='<? if(!$member['no']) { echo("Y"); }else{ echo("N"); } ?>'>
<SCRIPT language="JavaScript" src="<?=$dir?>/swe/write_comment.js"></SCRIPT>

<input type='hidden' id='sw_edit_yn' name='sw_edit_yn' value='<?=$sw_edit_yn?>'> <!-- HTML Editer ��뿩�� -->
<input type='hidden' id='sw_edit_tag_yn' name='sw_edit_tag_yn' value='<?=$sw_edit_tag_yn?>'> <!-- HTML/Visual ��� ��� -->
<input type='hidden' id='sw_m_level' name='sw_m_level' value='<?=$member['level']?>'>
<input type='hidden' id='sw_s_grant_html' name='sw_s_grant_html' value='<?=$setup['grant_html']?>'>
<input type='hidden' id='sw_s_use_html' name='sw_s_use_html' value='<?=$setup['use_html']?>'>
<input type='hidden' id='sw_edit_use' name='sw_edit_use' value='write_comment'>
<SCRIPT language="JavaScript" src="<?=$dir?>/swe/edit.js"></SCRIPT>

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
?>

<SCRIPT language="JavaScript">
  <!--
  	DocReloadInterval = setInterval("DocReload()", 300);
  //-->
</SCRIPT>
<!--====================[ sw_edit ���ϸ�: ed_seting_head_comment.php ��]====================-->
