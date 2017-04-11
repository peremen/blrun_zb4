<?
$colspanNum = 8;
if($setup[use_cart]) $colspanNum--;
if(!$setup[use_category]) {
	$hide_category_start="<!--";
	$hide_category_end="-->";
	$setup[use_category]=false;
}
?>

<SCRIPT LANGUAGE="JavaScript">
<!--
	function zb_formresize(obj) {
		obj.rows += 4;
	}
// -->
</SCRIPT>

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr>
  <td align=left><?=$a_category?></td>
  <td align=right>
    <?=$a_login?><img src=<?=$dir?>/btn_s_login.gif border=0 align=absmiddle></a>
    <?=$a_member_join?><img src=<?=$dir?>/btn_join.gif border=0 align=absmiddle></a>
    <?=$a_member_modify?><img src=<?=$dir?>/btn_info.gif border=0 align=absmiddle></a>
    <?=$a_member_memo?><img src=<?=$dir?>/btn_memobox.gif border=0 align=absmiddle></a>
    <?=$a_logout?><img src=<?=$dir?>/btn_logout.gif border=0 align=absmiddle></a>
    <?=$a_setup?><img src=<?=$dir?>/btn_setup.gif border=0 align=absmiddle></a>
  </td>
</tr>
</table>
