<? /////////////////////////////////////////////////////////////////////////
  /*
  �� ������ ����� �� ����� ���� ������ ���� �κ��Դϴ�.
  ���̺��� �ݰ� ������ ����̳� �˻� ���, ��ư���� ����ϸ� �˴ϴ�.
  �Ʒ��κ��� �״�� ����Ͻø� �˴ϴ�.


  <?=$a_1_prev_page?> : ������������ ����մϴ�. (���������� �̵�)
  <?=$a_1_next_page?> : ���� �������� ����մϴ�. (���������� �̵�)
  <?=$a_prev_page?> : ������������ ����մϴ�.
  <?=$a_next_page?> : ���� �������� ����մϴ�.  
  <?=$print_page?> : �������� ����մϴ�
  <?=$a_write?> : �۾��� ��ư
  <?=$a_list?> : ��Ϻ��� ��ư
  <?=$a_cancel?> : ��� ��ư
  <?=$a_reply?> : ��۾��� ��ư
  <?=$a_delete?> : �ۻ��� ��ư
  <?=$a_modify?> : �ۼ��� ��ư
  <?=$a_delete_all?> : �������϶� ��Ÿ���� ���õ� �� ���� ��ư;;
  
  */
///////////////////////////////////////////////////////////////////////// ?>

<!-- ������ �κ��Դϴ� -->
<tr>
   <td colspan=10 bgcolor=<?=$list_footer_bg_color?>><img src=images/t.gif height=3></td></tr>
</table>

<!-- ��ư �κ� -->
<table border=0 cellspacing=1 cellpadding=1 width=<?=$width?>>
<tr>
 <td width=40% height=20 nowrap> 
  <?=$hide_cart_start?><?=$a_cart?><img src=<?=$dir?>/i_list.gif border=0 align=absmiddle></a><?=$hide_cart_end?>
  <?=$a_delete_all?><img src=<?=$dir?>/i_admin.gif border=0 align=absmiddle></a>
  <?=$a_1_prev_page?><img src=<?=$dir?>/i_prev.gif border=0 align=absmiddle></a>  
  <?=$a_1_next_page?><img src=<?=$dir?>/i_next.gif border=0 align=absmiddle></a>
</td>
 <td align=center colspan=2 class=listnum nowrap>
<!-- ������ ��� ---------------------->
   <?=$a_prev_page?>[prev]</a>
   <?=$print_page?>
   <?=$a_next_page?>[next]</a>
 </td>
 <td align=right width=40%>
  <?=$a_write?><img src=<?=$dir?>/i_write.gif border=0 align=absmiddle></a>
 </td>
</tr>
</table>
</form>

<!-- �˻��� �κ� ---------------------->
<!-- ���±� �κ�;; �������� �ʴ� ���� �����ϴ� -->
<form method=post name=search action="zboard.php">
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=id value=<?=$id?>>
<input type=hidden name=select_arrange value=<?=$select_arrange?>>
<input type=hidden name=desc value=<?=$desc?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=selected>
<input type=hidden name=exec>
<input type=hidden name=sn value="<?=$sn?>">
<input type=hidden name=ss value="<?=$ss?>">
<input type=hidden name=sc value="<?=$sc?>">
<input type=hidden name=sm value="<?=$sm?>">
<input type=hidden name=category value="<?=$category?>">
<!----------------------------------------------->

<div align=center>
  <a href="javascript:OnOff('sn')"><img src=<?=$dir?>/name_<?=$sn?>.gif border=0 name=sn></a>
  <a href="javascript:OnOff('ss')"><img src=<?=$dir?>/subject_<?=$ss?>.gif border=0 name=ss></a>
  <a href="javascript:OnOff('sc')"><img src=<?=$dir?>/content_<?=$sc?>.gif border=0 name=sc></a>
  <a href="javascript:OnOff('sm')" onfocus=blur()><img src=<?=$dir?>/comment_<?=$sm?>.gif border=0 name=sm></a><img src=images/t.gif width=35 height=1>
<br>

<table border=0 cellspacing=0 cellpadding=0>
<tr>
  <td><img src=<?=$dir?>/search_left.gif></td>
  <td><input type=text name=keyword value="<?=$keyword?>" <?=size(15)?> class=input style=font-size:8pt;font-family:Arial;vertical-align:top;border-left-color:#ffffff;border-right-color:#ffffff;border-top-color:<?=$list_footer_bg_color?>;border-bottom-color:<?=$list_footer_bg_color?>;height:18px;></td>
  <td><input type=image border=0 src=<?=$dir?>/search_right.gif></td>
  <td><?=$a_cancel?><img src=<?=$dir?>/search_right2.gif border=0></a></td>
</tr>
</table>
</form>

<?
 if($setup[use_category])
{
?>
  </td>
</tr>
</table>
<?}?>
