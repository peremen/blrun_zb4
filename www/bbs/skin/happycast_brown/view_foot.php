<?
 /* ���� �����۰� ��ư ǥ��
 
  --- ����/ ���ı� ��ũ ---
  <?=$a_prev?> : ������ ��ũ
  <?=$a_next?> : ������ ��ũ

  <?=$prev_face_image?> : ������ �۾����� �� ������?;
  <?=$next_face_image?> : ������ �۾����� �� ������?;


  <?=$hide_prev_start?> <?=$hide_prev_end?> : ������ ��Ÿ����/ �����
  <?=$hide_next_start?> <?=$hide_next_end?> : ������ ��Ÿ����/ �����

  ��Ÿ �����̳� �۾��̵��� ���� ����Ÿ���� �տ� prev_ , next_ �� �� ���ΰ���;
  ex) ������ ���� : <?=$prev_subject?>

  <?=$a_write?> : �۾��� ��ư
  <?=$a_list?> : ��Ϻ��� ��ư
  <?=$a_reply?> : ��۾��� ��ư
  <?=$a_delete?> : �ۻ��� ��ư
  <?=$a_vote?> : ��õ��ư
  <?=$a_modify?> : �ۼ��� ��ư

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

<!-- ���� / ������ ��� -->
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

<!-- ��ư ���� ��� -->
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr height=23>
  <td align=left>
    <?=$a_list?><img src=<?=$dir?>/i_list.gif border=0 align=absmiddle></a>
    <?=$a_write?><img src=<?=$dir?>/i_write.gif border=0 align=absmiddle></a>
    <? if($box_view) { echo $a_preview."�̸�����</a>".$a_imagebox."�׸�â��</a>".$a_codebox."�ڵ����</a>"; }?>

  </td>
  <td align=right>
    <?=$a_home?>[HOME]</a><?=$a_bitly?>[bitly]</a><?=$a_keyword?>[��������]</a>
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
