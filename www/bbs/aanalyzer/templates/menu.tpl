<!-- 메뉴 -->
<table width="100" border="0" cellspacing="0" cellpadding="0">
  <tr class="menuTableBorder">
   <td width="1" height="1"><img src="images/spacer.gif" width="1" height="1" /></td>
   <td width="139" height="1"><img src="images/spacer.gif" width="1" height="1" /></td>
   <td width="1" height="1"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
 {section name=menu_view loop=$menu_info}
  <tr height="48">
    <td  width="1" height="48" class="menuTableBorder"><img src="images/spacer.gif" width="1" /></td>
    <td width="139"><a href="{$analysis_view_file_name}?mode={$menu_info[menu_view].mode}&id={$aa_page}" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('{$menu_info[menu_view].image_name}_analysis','','images/{$language}/{$menu_info[menu_view].image_name}_menu02.gif',1)"><img src="images/{$language}/{$menu_info[menu_view].image_name}_menu01.gif" name="{$menu_info[menu_view].image_name}_analysis" width="139" height="48" border="0" id="{$menu_info[menu_view].image_name}_analysis" title="{$menu_info[menu_view].menu_comment}"/></a></td>
    <td  width="1" class="menuTableBorder"><img src="images/spacer.gif" width="1" /></td>
  </tr>
 {/section}
  <tr class="menuTableBorder">
    <td width="1" height="1"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td width="139" height="1"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td width="1" height="1"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
</table>
