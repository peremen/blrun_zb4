{include file="header.tpl"}
{include file="config_top.tpl"}
<table width="800" border="0" cellspacing="0" cellpadding="0" class="mainTable">
  <tr >
    <td background="images/border.gif" width="1"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td width="12"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td width="141" class="titleTable" valign="top">
{include file="menu.tpl"}
    </td>
    <td width="20"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td  class="contentsCell">
{if $config_update_completed != null}
<div id="completed_message" class="configOKMessage">{$config_update_completed}<br></div>
{/if}
<table width="613" align="center" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableItems">
      <td background="images/detail_info_top_left.gif" width="13"><img src="images/spacer.gif" width="13" height="17" /></td>
      <td background="images/detail_info_top_center.gif" width="594"></td>
      <td background="images/detail_info_top_right.gif" width="6"><img src="images/spacer.gif" width="6" height="17" /></td>
    </tr>
</table>


<table width="613" border="0" cellspacing="2" cellpadding="0" class="mainTable">
<form id="aokio_config" name="aokio_config" method="post" action="aokio_config.php">
  <tr height="10">
    <td  width="10"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td width="180" class="managerItems"></td>
    <td width="3"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td width="420" ></td>
  </tr>
  <tr >
    <td  width="10"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td class="configItemTitles">{$config_messages.target_name}</td>
    <td ><img src="images/spacer.gif" width="1" height="1" /></td>
    <td class="configItemContents">&nbsp;<input type="text" name="target_name" value="{$conf_info.target_name}"><br>&nbsp;{$config_messages.target_name_commnet}</td>
  </tr>
  <tr >
    <td><img src="images/spacer.gif" width="1" height="1" /></td>
    <td class="configItemTitles">{$config_messages.lists_per_page}</td>
    <td  width="5"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td class="configItemContents">&nbsp;<input type="text" name="lists_per_page"  value="{$conf_info.lists_per_page}" onKeyup="this.value=this.value.replace(/[^0-9]/g,'');"></td>
  </tr>
  <tr >
    <td><img src="images/spacer.gif" width="1" height="1" /></td>
    <td class="configItemTitles">{$config_messages.access_check_pattern}</td>
    <td><img src="images/spacer.gif" width="1" height="1" /></td>
    <td class="configItemContents">{html_radios name="access_check_pattern" selected=$conf_info.access_check_pattern options=$config_messages.access_check_pattern_items separator="<br/>"}
    <input type="text" name="access_check_pattern_input_time" value="{$conf_info.access_check_pattern_input_time}"  onKeyup="this.value=this.value.replace(/[^0-9]/g,'');">
    </td>
  </tr>
  <tr >
    <td><img src="images/spacer.gif" width="1" height="1" /></td>
    <td class="configItemTitles">{$config_messages.check_admin_access}</td>
    <td><img src="images/spacer.gif" width="1" height="1" /></td>
    <td class="configItemContents">{html_radios name="check_admin_access" selected=$conf_info.check_admin_access options=$config_messages.check_admin_access_items separator="<br/>"}</td>
  </tr>
  <tr >
    <td><img src="images/spacer.gif" width="1" height="1" /></td>
    <td class="configItemTitles">{$config_messages.access_permission}</td>
    <td><img src="images/spacer.gif" width="1" height="1" /></td>
    <td class="configItemContents">{html_checkboxes name="access_permission" selected=$access_perm_checked_items options=$config_messages.access_permission_items separator="<br/>"}
    </td>
  </tr>
  <tr >
    <td><img src="images/spacer.gif" width="1" height="1" /></td>
    <td class="configItemTitles">{$config_messages.portal_page}</td>
    <td><img src="images/spacer.gif" width="1" height="1" /></td>
    <td class="configItemContents">&nbsp;<select name="portal_page">{html_options  options=$config_messages.portal_page_items selected=$conf_info.portal_page}</select>
    </td>
  </tr>
  <tr >
    <td  width="10"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td width="200"></td>
    <td  width="5"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td ><input type="submit" value="OK" style="width:100"></td>
  </tr>
<input type="hidden" name="config_page" value="on">
<input type="hidden" name="id" value="{$aa_page}">
</form>
  <tr height="10">
    <td  width="10"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td width="200" class="managerItems"></td>
    <td  width="5"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td ></td>
  </tr>
</table>

<table width="613" align="center" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableItems">
      <td background="images/detail_info_top_left.gif" width="13"><img src="images/spacer.gif" width="13" height="17" /></td>
      <td background="images/detail_info_top_center.gif" width="594"></td>
      <td background="images/detail_info_top_right.gif" width="6"><img src="images/spacer.gif" width="6" height="17" /></td>
    </tr>
</table>

    </td>
    <td width="12"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td background="images/border.gif" width="1"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
</table>
{include file="bottom.tpl"}
{include file="footer.tpl"}
