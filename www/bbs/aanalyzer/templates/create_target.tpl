{include file="header.tpl"}
{include file="manager_top.tpl"}
<table width="800" border="0" cellpadding="0" cellspacing="0" class="mainTable">
  <tr>
    <td background="images/border.gif" width="1"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td width="10"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td>

<table width="778" align="center" border="0" cellspacing="0" cellpadding="0">
  <tr class="managerItemTitles">
    <td background="images/content_top_bar2_left.gif" width="13"><img src="images/spacer.gif" width="13" height="30" /></td>
    <td background="images/content_top_bar2_center.gif" width="757">{$create_page_messages.title}</td>
    <td background="images/content_top_bar2_right.gif" width="8"><img src="images/spacer.gif" width="8" height="30" /></td>
</tr>
</table>
<br>
<table width="778" align="center" border="0" cellspacing="0" cellpadding="0">
  <tr class="managerItemTitles">
    <td width="13"><img src="images/spacer.gif" width="13" height="30" /></td>
    <td width="757">{$create_page_messages.howto_1}</td>
    <td  width="8"><img src="images/spacer.gif" width="8" height="30" /></td>
</tr>
  <tr class="managerItemTitles">
    <td width="13"><img src="images/spacer.gif" width="13" height="30" /></td>
    <td width="757"><br></td>
    <td  width="8"><img src="images/spacer.gif" width="8" height="30" /></td>
</tr>
  <tr>
    <td width="13"><img src="images/spacer.gif" width="13" height="30" /></td>
<td width="757">

<table width="70%" align="center" border="0" cellspacing="0" cellpadding="10">
  <tr class="managerCreateExample">
    <td style="BORDER-TOP: #d0d0d0 2px solid; BORDER-BOTTOM: #d0d0d0 1px solid;BACKGROUND-COLOR: #faeed7">
{$howto_starter}<br>
{$howto_target}<br>
{$howto_include}<br>
{$howto_ender}<br>
{$howto_javascript}<br>
    </td>
    </tr>
  <tr class="managerCreateExample">
    <td style="BORDER-TOP: #d0d0d0 1px solid; BORDER-BOTTOM: #d0d0d0 1px solid">
<strong>{$create_page_messages.comment_title}</strong><br/>
{$create_page_messages.comment}
     </td>
    </tr>
     <td style="BORDER-TOP: #d0d0d0 2px solid; ">
<a href="./manager.php">{$application_name} Manager Page</a>
     </td>
    </tr>

    </table>
</td>
    <td  width="8"><img src="images/spacer.gif" width="8" height="30" /></td>
</tr>
</table>


  </td>
  <td width="10"><img src="images/spacer.gif" width="1" height="1" /></td>
  <td background="images/border.gif" width="1"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
</table>


{include file="bottom.tpl"}
{include file="footer.tpl"}
