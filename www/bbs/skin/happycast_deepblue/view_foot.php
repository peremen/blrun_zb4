<?
 /* 이전 다음글과 버튼 표시
 
  --- 이전/ 이후글 링크 ---
  <?=$a_prev?> : 이전글 링크
  <?=$a_next?> : 다음글 링크

  <?=$prev_face_image?> : 이전글 글쓴이의 얼굴 아이콘?;
  <?=$next_face_image?> : 다음글 글쓴이의 얼굴 아이콘?;


  <?=$hide_prev_start?> <?=$hide_prev_end?> : 이전글 나타나기/ 숨기기
  <?=$hide_next_start?> <?=$hide_next_end?> : 다음글 나타나기/ 숨기기

  기타 제목이나 글쓴이등은 위의 데이타에서 앞에 prev_ , next_ 를 덧 붙인것임;
  ex) 이전글 제목 : <?=$prev_subject?>

  <?=$a_write?> : 글쓰기 버튼
  <?=$a_list?> : 목록보기 버튼
  <?=$a_reply?> : 답글쓰기 버튼
  <?=$a_delete?> : 글삭제 버튼
  <?=$a_vote?> : 추천버튼
  <?=$a_modify?> : 글수정 버튼

 */
?>
<?=$hide_comment_end?>
<?
if(!preg_match("/Zeroboard/i",$a_preview)) $a_preview = str_replace(">","><font class=view_title1>",$a_preview)."&nbsp;&nbsp;";
if(!preg_match("/Zeroboard/i",$a_imagebox)) $a_imagebox = str_replace(">","><font class=view_title1>",$a_imagebox)."&nbsp;&nbsp;";
if(!preg_match("/Zeroboard/i",$a_codebox))	$a_codebox = str_replace(">","><font class=view_title1>",$a_codebox)."&nbsp;&nbsp;";

if(!preg_match("/Zeroboard/i",$a_home)) $a_home = str_replace(">","><font class=view_title1>",$a_home)."&nbsp;&nbsp;";
if(!preg_match("/Zeroboard/i",$a_bitly)) $a_bitly = str_replace(">","><font class=view_title1>",$a_bitly)."&nbsp;&nbsp;";
if(!preg_match("/Zeroboard/i",$a_keyword)) $a_keyword = str_replace(">","><font class=view_title1>",$a_keyword)."&nbsp;&nbsp;";
?>

<!-- 이전 / 다음글 출력 -->
<table border=0 cellpadding cellspacing=0 width=<?=$width?>>
<tr><td colspan=10 bgcolor=white><img src=images/t.gif height=1></td></tr>
<tr><td colspan=10 bgcolor=<?=$view_left_header_color?>><img src=images/t.gif height=2></td></tr>
</table>
<?=$hide_prev_start?>

<table border=0 width=<?=$width?> cellspacing=0 cellpadding=0>
<tr>
  <td colspan=8 bgcolor=<?=$list_header_dark0?>><img src=images/t.gif height=1></td>
</tr>
<tr align=center height=24>
  <td width=8% class=listnum>Prev</td>
  <td width=82% align=left style='word-break:break-all;'><img src=images/t.gif height=3><br>&nbsp; <?=$prev_icon?><?=$a_prev?><?=$prev_subject?></a></td>
  <td width=10% nowrap><img src=images/t.gif height=3><br><?=$prev_face_image?> <?=$prev_name?></td>
</tr>
</table>
<table border=0 cellpadding cellspacing=0 width=<?=$width?>>
<tr>
  <td colspan=10 bgcolor=<?=$list_divider?>><img src=images/t.gif height=1></td>
</tr>
</table>
<?=$hide_prev_end?>

<?=$hide_next_start?>

<table border=0 width=<?=$width?> cellspacing=0 cellpadding=0>
<tr>
  <td colspan=8 bgcolor=<?=$list_header_dark1?>><img src=images/t.gif height=1></td>
</tr>
<tr align=center height=24>
  <td width=8% class=listnum>Next</td>
  <td width=82% align=left style='word-break:break-all;'><img src=images/t.gif height=3><br>&nbsp; <?=$next_icon?><?=$a_next?><?=$next_subject?></a></td>
  <td width=10% nowrap><img src=images/t.gif height=3><br><?=$next_face_image?> <?=$next_name?></td>
</tr>
</table>
<table border=0 cellpadding cellspacing=0 width=<?=$width?>>
<tr>
  <td colspan=10 bgcolor=<?=$list_footer_bg_color?>><img src=images/t.gif height=1></td>
</tr>
</table>
<?=$hide_next_end?>

<!-- 버튼 관련 출력 -->
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr height=23>
  <td align=left>
    <?=$a_list?><img src=<?=$dir?>/i_list.gif border=0 align=absmiddle></a>
    <?=$a_write?><img src=<?=$dir?>/i_write.gif border=0 align=absmiddle></a>
    <? if($box_view) { echo $a_preview."미리보기</a>".$a_imagebox."그림창고</a>".$a_codebox."코드삽입</a>"; }?>

  </td>
  <td align=right>
    <?=$a_home?>[HOME]</a><?=$a_bitly?>[bitly]</a><?=$a_keyword?>[반전해제]</a>
    <?=$a_vote?><img src=<?=$dir?>/i_vote.gif border=0 align=absmiddle></a>
    <?=$a_reply?><img src=<?=$dir?>/i_reply.gif border=0 align=absmiddle></a>
  </td>
</tr>
</table>
<?
if (!$setup[use_alllist]) {
echo '<form method=get name=search action="zboard.php"><input type=hidden name=id value='.$id.'><input type=hidden name=select_arrange value='.$select_arrange.'><input type=hidden name=desc value='.$desc.'><input type=hidden name=page_num value='.$page_num.'><input type=hidden name=selected><input type=hidden name=exec><input type=hidden name=sn value='.$sn.'><input type=hidden name=ss value='.$ss.'><input type=hidden name=sc value='.$sc.'><input type=hidden name=sm value='.$sm.'><input type=hidden name=category value='.$category.'><input type=hidden name=keyword value='.$keyword.'></form>'; }
?>
<br>
