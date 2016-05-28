
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> style=table-layout:fixed>
<form method=post name=list action=list_all.php>
<input type=hidden id=nStart name=nStart>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=id value=<?=$id?>>
<input type=hidden name=select_arrange value=<?=$select_arrange?>>
<input type=hidden name=desc value=<?=$desc?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=selected><input type=hidden name=exec>
<input type=hidden name=keyword value="<?=$keyword?>">
<input type=hidden name=sn value="<?=$sn?>">
<input type=hidden name=ss value="<?=$ss?>">
<input type=hidden name=sc value="<?=$sc?>">
<input type=hidden name=sm value="<?=$sm?>">
<!--카트 -->
<?=$hide_cart_start?>
<col width=20></col>
<?=$hide_cart_end?>
<!--번호 --><? if($browser=="1"){ ?><col width=40></col><? } ?>
<!--제목 --><col width=100%></col>
<!--작성자--><? if($browser=="1"){ ?><col width=80></col><? } ?>
<!--작성일--><? if($browser=="1"){ ?><col width=65></col><? } ?>
<? if($browser=="1"){ ?>
<!--조회--><col width=35></col>
<!--추천--><col width=35></col> 
<? } ?>

<tr>
  <td colspan="7" height="2" bgcolor="#99CC33"></td>
</tr>
<tr align=center class=zv3_header>
<!--카트-->
<?=$hide_cart_start?>

  <td width=20>
    <table cellspacing=0 cellpadding=0 ><tr><td align=center><?=$a_cart?><img src=<?=$dir?>/h_cart.gif border=0></a></td></tr></table>
  </td>
<?=$hide_cart_end?>

<!--번호-->
  <? if($browser=="1"){ ?><td width=40><table cellspacing=0 cellpadding=0><tr><td align=center><?=$a_no?><img src=<?=$dir?>/h_num.gif border=0></a></td></tr></table></td><? } ?>

<!--제목-->
  <td width=100%><table cellspacing=0 cellpadding=0><tr><td align=center><?=$a_subject?><img src=<?=$dir?>/h_subject.gif border=0></a></td></tr></table></td>

<!--작성자-->
  <? if($browser=="1"){ ?><td width=80><table cellspacing=0 cellpadding=0><tr><td align=center><?=$a_name?><img src=<?=$dir?>/h_writer.gif border=0></a></td></tr></table></td><? } ?>

<!--작성일-->
  <? if($browser=="1"){ ?><td width=65><table cellspacing=0 cellpadding=0><tr><td align=center><?=$a_date?><img src=<?=$dir?>/h_date.gif border=0></a></td></tr></table></td><? } ?>

<!--조회--><!--추천-->
<? if($browser=="1"){ ?>
  <td width=35><table cellspacing=0 cellpadding=0><tr><td align=center><?=$a_hit?><img src=<?=$dir?>/h_read.gif border=0></a></td></tr></table></td>
  <td width=35><table cellspacing=0 cellpadding=0><tr><td align=center><?=$a_vote?><img src=<?=$dir?>/h_vote.gif border=0></a></td></tr></table></td>
<? } ?>
</tr>
<tr>
  <td colspan="7" height="1" bgcolor="#CCCCCC"></td>
</tr>
