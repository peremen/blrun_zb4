
</form>
</table>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr>
<!--페이징-->    
  <td height="40" align=left style="padding-left:10px;"><?=$a_prev_page?>[이전<?=$setup[page_num]?>개]</a> <?=$print_page?> <font class=zv3_normal><?=$a_next_page?>[다음<?=$setup[page_num]?>개]</font></a></td>
<!--검색-->
  <td align=right>
    <table border=0 cellspacing=0 cellpadding=0>
    <form method=post name=search action="zboard.php"><input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=selected><input type=hidden name=exec><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=sm value="<?=$sm?>"><input type=hidden name=category value="<?=$category?>">
    <tr>
      <td>
        <a href="javascript:OnOff('sn')" onfocus=blur()><img src=<?=$dir?>/name_<?=$sn?>.gif border=0 name=sn></a>
        <a href="javascript:OnOff('ss')" onfocus=blur()><img src=<?=$dir?>/subject_<?=$ss?>.gif border=0 name=ss></a>
        <a href="javascript:OnOff('sc')" onfocus=blur()><img src=<?=$dir?>/content_<?=$sc?>.gif border=0 name=sc></a>
        <a href="javascript:OnOff('sm')" onfocus=blur()><img src=<?=$dir?>/comment_<?=$sm?>.gif border=0 name=sm></a>
      </td>
      <td><input type=text name=keyword value="<?=$keyword?>" class=zv3_search size=10></td>
      <td><input type=image src=<?=$dir?>/btn_search.gif border=0 onfocus=blur()></td>
      <td><?=$a_cancel?><img src=<?=$dir?>/btn_search_cancel.gif border=0></a></td>
    </tr>
    </form>
    </table>
  </td>
</tr>
<tr>
  <td colspan=2 height=2 class=zv3_footer><img src=<?=$dir?>/t.gif border=0 height=2></td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 width=<?=$width?>>
<tr>
  <!--하단버튼들-->
  <td width="80%" height="35" align=left>
    <?=$a_delete_all?><img src=<?=$dir?>/btn_admin.gif border=0 align=absmiddle></a>
    <?=$hide_cart_start?><?=$a_cart?><img src=<?=$dir?>/btn_list.gif border=0 align=absmiddle></a><?=$hide_cart_end?>

    <?=$a_1_prev_page?><img src=<?=$dir?>/btn_prev.gif border=0 align=absmiddle></a><?=$a_1_next_page?><img src=<?=$dir?>/btn_next.gif border=0 align=absmiddle></a>
  </td>
  <td align=right>
    <?=$a_write?><img src=<?=$dir?>/btn_write.gif border=0 align=absmiddle></a>
  </td>
</tr>
<tr>
  <td colspan="2" height="1" bgcolor="#EBEBEB"></td>
</tr>
</table>
