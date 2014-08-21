<?
if(!preg_match("/Zeroboard/i",$a_list)) $a_list = str_replace(">","><font class=list_eng>",$a_list)."&nbsp;&nbsp;";
if(!preg_match("/Zeroboard/i",$a_reply)) $a_reply = str_replace(">","><font class=list_eng>",$a_reply)."&nbsp;&nbsp;";
if(!preg_match("/Zeroboard/i",$a_modify)) $a_modify = str_replace(">","><font class=list_eng>",$a_modify)."&nbsp;&nbsp;";
if(!preg_match("/Zeroboard/i",$a_delete)) $a_delete = str_replace(">","><font class=list_eng>",$a_delete)."&nbsp;&nbsp;";
if(!preg_match("/Zeroboard/i",$a_write)) $a_write = str_replace(">","><font class=list_eng>",$a_write)."&nbsp;&nbsp;";
if(!preg_match("/Zeroboard/i",$a_vote)) $a_vote = str_replace(">","><font class=list_eng>",$a_vote)."&nbsp;&nbsp;";
if(!preg_match("/Zeroboard/i",$a_preview)) $a_preview = str_replace(">","><font class=list_eng>",$a_preview)."&nbsp;&nbsp;";
if(!preg_match("/Zeroboard/i",$a_imagebox)) $a_imagebox = str_replace(">","><font class=list_eng>",$a_imagebox)."&nbsp;&nbsp;";
if(!preg_match("/Zeroboard/i",$a_codebox))	$a_codebox = str_replace(">","><font class=list_eng>",$a_codebox)."&nbsp;&nbsp;";

if(!preg_match("/Zeroboard/i",$a_home)) $a_home = str_replace(">","><font class=list_eng>",$a_home)."&nbsp;&nbsp;";
if(!preg_match("/Zeroboard/i",$a_bitly)) $a_bitly = str_replace(">","><font class=list_eng>",$a_bitly)."&nbsp;&nbsp;";
if(!preg_match("/Zeroboard/i",$a_keyword)) $a_keyword = str_replace(">","><font class=list_eng>",$a_keyword)."&nbsp;&nbsp;";
?>

<table border=0 cellspacing=0 cellpadding=0 height=1 width=<?=$width?>>
<tr><td height=1 class=line1 style=height:1px><img src=<?=$dir?>/t.gif border=0 height=1></td></tr>
<tr><td height=8 bgcolor=white></td></tr>
</table>
<table width=<?=$width?> cellspacing=0 cellpadding=0>
<tr>
	<td height=30>
		<?=$a_reply?>답글달기</a>
		<?=$a_modify?>수정하기</a>
		<?=$a_delete?>삭제하기</a>
		<?=$a_vote?>추천하기</a>
		<? if($box_view) { echo $a_preview."미리보기</a>".$a_imagebox."그림창고</a>".$a_codebox."코드삽입</a>"; }?>

	</td>
	<td align=right>
		<?=$a_home?>[HOME]</a><?=$a_bitly?>[bitly]</a><?=$a_keyword?>[반전해제]</a><?=$a_list?>목록보기</a><?=$a_write?>글쓰기</a>
	</td>
</tr>
</table>
<table border=0	cellspacing=0 cellpadding=0 width=<?=$width?> height=2>
<tr>
	<td height=2 class=line2><img src=<?=$dir?>/t.gif border=0	height=2></td>
</tr>
</table>
<br>
<?=$hide_prev_start?>

<table width=<?=$width?>>
<tr>
	<td style='word-break:break-all;'>▲ <?=$a_prev?><?=$prev_subject?></a></td>
</tr>
</table>
<?=$hide_prev_end?>

<?=$hide_next_start?>

<table width=<?=$width?>>
<tr>
	<td style='word-break:break-all;'>▼ <?=$a_next?><?=$next_subject?></a></td>
</tr>
</table>
<?=$hide_next_end?>

<?
if (!$setup[use_alllist]) {
echo '<form method=get name=search action="zboard.php"><input type=hidden name=id value='.$id.'><input type=hidden name=select_arrange value='.$select_arrange.'><input type=hidden name=desc value='.$desc.'><input type=hidden name=page_num value='.$page_num.'><input type=hidden name=selected><input type=hidden name=exec><input type=hidden name=sn value='.$sn.'><input type=hidden name=ss value='.$ss.'><input type=hidden name=sc value='.$sc.'><input type=hidden name=sm value='.$sm.'><input type=hidden name=category value='.$category.'><input type=hidden name=keyword value='.$keyword.'></form>'; }
?>
<br>
