<?
$config_file=$dir."/".$id."_config.php";
if(file_exists($config_file)) include $config_file; 
else{ 
	$type="A2_type";
}

if(file_exists($dir."/".$type."/Image_Tag.php")) include $dir."/".$type."/Image_Tag.php";
include $dir."/".$type."/script.php";
if($Exif_use=="on") include "$dir/exif.php";
if($gd_use==1) include $dir."/".$type."/thumbnail_make1.php";
elseif($gd_use==2) include $dir."/".$type."/thumbnail_make2.php";
include "$dir/member_icon.php";
include $dir."/swe/memo_convert_js.php";  
$a_install="$dir/install.php";

if(!preg_match("/Zeroboard/i",$a_login)) $a_login= str_replace(">","><font class=com>",$a_login)."&nbsp;";
if(!preg_match("/Zeroboard/i",$a_logout)) $a_logout= str_replace(">","><font class=com>",$a_logout)."&nbsp;";
if(!preg_match("/Zeroboard/i",$a_setup)) $a_setup= str_replace(">","><font class=com>",$a_setup)."&nbsp;";
if(!preg_match("/Zeroboard/i",$a_member_join)) $a_member_join= str_replace(">","><font class=com>",$a_member_join)."&nbsp;";
if(!preg_match("/Zeroboard/i",$a_member_modify)) $a_member_modify= str_replace(">","><font class=com>",$a_member_modify)."&nbsp;";
if(!preg_match("/Zeroboard/i",$a_member_memo)) $a_member_memo= str_replace(">","><font class=com>",$a_member_memo)."&nbsp;";
if($setup[use_alllist]) $view_target="zboard.php"; else $view_target="view.php";
?>

<BR>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> height=25 align=center>
<?if($member[is_admin]==1){?>
<FORM METHOD=POST ACTION="<?=$a_install?>" target=_blank>
<?}?>
<col width=50%></col><col width=50%></col>
<tr>
  <td align=left>
    <font class=com>Total article&nbsp;</font><b><font class=title_eng4><?=$setup[total_article]?> :</font></b>
    <?if($setup[total_article]!=$total) echo " (<font color=red>$total</font> searched) ";?>&nbsp;<b><font class=title_eng4><?=$page?></font></b><font class=com> page&nbsp;/&nbsp;total </font><b><font class=title_eng4><?=$total_page?></font></b><font class=com> page   <?=$memo_on_sound?></font>
  </td>
  <td align=right>
    <?=$a_login?>Login</a>
    <?=$a_member_join?>Join</a>
    <?=$a_member_modify?>Modify</a>
    <?=$a_member_memo?>Memo</a>
    <?=$a_logout?>Logout</a>
    <?=$a_setup?>Admin</a>
    <?if($member[is_admin]==1){?><INPUT TYPE="hidden" name=id value=<?=$id?>><INPUT TYPE="hidden" name=zb_path value=<?=$config_dir?>><INPUT TYPE="hidden" name=user_id value=<?=$member[user_id]?>><INPUT TYPE="hidden" name=password value=<?=$member[password]?>><INPUT TYPE=image src=<?=$dir?>/images/sc.gif align=absmiddle border=0><?}?><font size=3>&nbsp;</font>
  </td>
</tr>
</FORM>
</table>
<?=$hide_category_start?>

<?if($category_use==1){?>
<table border=0 cellspacing=1 cellpadding=0 width=<?=$width?>>
<tr><td background=<?=$dir?>/images/dot.gif height=1></td></tr>
<tr align=center>
	<td align=left>
		<? include "include/print_category.php"; ?>

	</td>
</tr>
<tr><td background=<?=$dir?>/images/dot.gif height=1></td></tr>
</table>
<?}?>
<?=$hide_category_end?>
