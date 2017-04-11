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
      <td background="images/content_top_bar2_center.gif" width="100">{$target_list_item_titles.no}</td>
      <td background="images/content_top_bar2_center.gif" width="357">{$target_list_item_titles.target}</td>
      <td background="images/content_top_bar2_center.gif" width="60">{$target_list_item_titles.total}</td>
      <td background="images/content_top_bar2_center.gif" width="60">{$target_list_item_titles.today}</td>
      <td background="images/content_top_bar2_center.gif" width="60">{$target_list_item_titles.max}</td>
      <td background="images/content_top_bar2_center.gif" width="60">{$target_list_item_titles.drop}</td>
      <td background="images/content_top_bar2_center.gif" width="60">{$target_list_item_titles.truncate}</td>
      <td background="images/content_top_bar2_center.gif" width="60">{$target_list_item_titles.config}</td>
      <td background="images/content_top_bar2_right.gif" width="8"><img src="images/spacer.gif" width="8" height="30" /></td>
    </tr>
      <tr height="9">
        <td><img src="images/spacer.gif" height="9" /></td>
        <td ></td>
        <td ></td>
	<td ></td>
        <td ></td>
	<td ></td>
	<td ></td>
	<td ></td>
	<td ></td>
	<td ></td>
      </tr>
{section name=report_view loop=$manage_list}
<tr class="managerItemContents" height="30">
        <td ></td>
<td class="installMessage">{$manage_list[report_view].v_no}</td>
<td class="installMessage"><a href="./view.php?id={$manage_list[report_view].target}">{$manage_list[report_view].target_name}:{$manage_list[report_view].target}</a></td>
<td class="installMessage">{$manage_list[report_view].total}</td>
<td class="installMessage">{$manage_list[report_view].today}</td>
<td class="installMessage">{$manage_list[report_view].max}</td>

<td class="installMessage"><a href="./manager.php?id={$manage_list[report_view].target}&mode=drop">{$target_list_item_titles.drop}</a></td>
<td class="installMessage"><a href="./manager.php?id={$manage_list[report_view].target}&mode=truncate">{$target_list_item_titles.truncate}</a></td>
<td class="installMessage"><a href="aokio_config.php?id={$manage_list[report_view].target}">{$target_list_item_titles.config}</a></td>
	<td ></td>
</tr>
{/section}
      <tr height="9">
        <td><img src="images/spacer.gif" height="9" /></td>
        <td ></td>
        <td ></td>
	<td ></td>
        <td ></td>
	<td ></td>
        <td ></td>
	<td ></td>
	<td ></td>
	<td ></td>
      </tr>
  </table>


<table width="778" align="center" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableItems">
      <td background="images/detail_info_top_left.gif" width="13"><img src="images/spacer.gif" width="13" height="17" /></td>
      <td background="images/detail_info_top_center.gif" width="759"></td>
      <td background="images/detail_info_top_right.gif" width="6"><img src="images/spacer.gif" width="6" height="17" /></td>
    </tr>
</table>
<table width="500" align="center" border="0" cellspacing="2" cellpadding="0">
{if $no_id_flag}
<tr>
<td   class="configOKMessage" colspan="2">{$manager_messages.no_id_message}
</td>
</tr>
{/if}
<form method="post" action="manager.php">
<tr>
{if $drop_confirm_flag}
<td  class="configOKMessage">{$manager_messages.drop_confirm_message}</td>
<td>
<input type="hidden" name="confirm" value="OK">
<input type="hidden" name="id" value="{$drop_id}">
<input type="hidden" name="mode" value="drop">
<input type="submit" value="{$target_list_item_titles.drop}" style="width:150">
</td>
{/if}
{if $truncate_confirm_flag}
<td class="configOKMessage" >{$manager_messages.truncate_confirm_message}</td>
<td >
<input type="hidden" name="confirm" value="OK">
<input type="hidden" name="id" value="{$truncate_id}">
<input type="hidden" name="mode" value="truncate">
<input type="submit" value="{$target_list_item_titles.truncate}" style="width:150">

</td>
{/if}
</tr>
</form>
</table>

 <form id="create_target_page" name="create_counter_page" method="post" action="create_target_page.php">
<table width="778" align="center" border="0" cellspacing="3" cellpadding="0">
<tr class="analysisTableItems">
<td width="180"  class="managerConfigItemTitles">
{$manager_messages.create_new_target}</td>
<td align="left"> <input type="text" name="target_page" onKeyup="this.value=this.value.replace(/[^0-9a-zA-Z_]/g,'');">&nbsp;&nbsp;<input type="submit" value="OK" class="loginInputForms" style='width:100'>
</td>
</tr>
<tr class="analysisTableItems">
<td width="180" >
</td>
<td align="left" class="managerConfigCreateComment">{$manager_messages.howto_create_new_target}</td>
</tr>
{if $create_error !=null}
<tr class="analysisTableItems">
<td width="180" >
</td>
<td align="left" class="managerConfigCreateComment">
{if $create_error == 1}{$create_error_message.input_error_no_input}
{elseif $create_error == 2}{$create_error_message.input_error_character_error}
{elseif $create_error == 3}{$create_error_message.input_error_is_exist}
{elseif $create_error == 5}{$create_error_message.input_error_too_long}
{/if}</td>
</tr>
{/if}
</table>
</form>
<form id="manager_config" name="manager_config" method="post" action="manager.php">
<table width="778" align="center" border="0" cellspacing="2" cellpadding="0">
<tr>
<td class="managerConfigItemTitles" width="180" >
{$manager_messages.change_language}</td>
<td> <select name="language">{html_options  options=$lang_list selected=$language}
</select><input type="hidden" name="manager_config_flag" value="true">
<input type="submit" value="OK" class="loginInputForms" style='width:100'>
</td>
</tr>
</table>
 </form>
<!--
<form id="version_check" name="version_check" method="post" action="version_check.php">
<table width="778" align="center" border="0" cellspacing="2" cellpadding="0">
<tr>
<td class="managerConfigItemTitles" width="180" >
{$manager_messages.update_check}</td>
<td> <input type="hidden" name="version" value="{$version}">
<input type="submit" value="Update Check" class="loginInputForms" style='width:100'>
</td>
</tr>
</table>
 </form>
-->
    </td>
    <td width="10"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td background="images/border.gif" width="1"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
</table>

{include file="bottom.tpl"}
{include file="footer.tpl"}
