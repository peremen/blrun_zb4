<?
if(!preg_match("/Zeroboard/i",$a_login)) $a_login= str_replace(">","><font class=list_han>",$a_login)."&nbsp;";
if(!preg_match("/Zeroboard/i",$a_logout)) $a_logout= str_replace(">","><font class=list_han>",$a_logout)."&nbsp;";
if(!preg_match("/Zeroboard/i",$a_setup)) $a_setup= str_replace(">","><font class=list_han>",$a_setup)."&nbsp;";
if(!preg_match("/Zeroboard/i",$a_member_join)) $a_member_join= str_replace(">","><font class=list_han>",$a_member_join)."&nbsp;";
if(!preg_match("/Zeroboard/i",$a_member_modify)) $a_member_modify= str_replace(">","><font class=list_han>",$a_member_modify)."&nbsp;";
if(!preg_match("/Zeroboard/i",$a_member_memo)) $a_member_memo= str_replace(">","><font class=list_han>",$a_member_memo)."&nbsp;";
?>

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr>
	<td align=left <?if(!$setup[use_category]) echo"align=right";?>>
		<?=$a_login?>�α���</a>
		<?=$a_member_join?>ȸ������</a>
		<?=$a_member_modify?>��������</a>
		<?=$a_member_memo?>�޸�ڽ�</a>
		<?=$a_logout?>�α׾ƿ�</a>
		<?=$a_setup?>��������</a>
	</td>
<?=$hide_category_start?>

	<td align=right><font class=list_eng><b>Category</b> :</font> <?=$a_category?></td>
<?=$hide_category_end?>

</tr>
</table>
