<?php /* Smarty version 2.6.13, created on 2008-11-25 02:30:32
         compiled from aokio_config.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_radios', 'aokio_config.tpl', 48, false),array('function', 'html_checkboxes', 'aokio_config.tpl', 62, false),array('function', 'html_options', 'aokio_config.tpl', 69, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "config_top.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<table width="800" border="0" cellspacing="0" cellpadding="0" class="mainTable">
  <tr >
    <td background="images/border.gif" width="1"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td width="12"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td width="141" class="titleTable" valign="top">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </td>
    <td width="20"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td  class="contentsCell">
<?php if ($this->_tpl_vars['config_update_completed'] != null): ?>
<div id="completed_message" class="configOKMessage"><?php echo $this->_tpl_vars['config_update_completed']; ?>
<br></div>
<?php endif; ?>
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
    <td class="configItemTitles"><?php echo $this->_tpl_vars['config_messages']['target_name']; ?>
</td>
    <td ><img src="images/spacer.gif" width="1" height="1" /></td>
    <td class="configItemContents">&nbsp;<input type="text" name="target_name" value="<?php echo $this->_tpl_vars['conf_info']['target_name']; ?>
"><br>&nbsp;<?php echo $this->_tpl_vars['config_messages']['target_name_commnet']; ?>
</td>
  </tr>
  <tr >
    <td><img src="images/spacer.gif" width="1" height="1" /></td>
    <td class="configItemTitles"><?php echo $this->_tpl_vars['config_messages']['lists_per_page']; ?>
</td>
    <td  width="5"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td class="configItemContents">&nbsp;<input type="text" name="lists_per_page"  value="<?php echo $this->_tpl_vars['conf_info']['lists_per_page']; ?>
" onKeyup="this.value=this.value.replace(/[^0-9]/g,'');"></td>
  </tr>
  <tr >
    <td><img src="images/spacer.gif" width="1" height="1" /></td>
    <td class="configItemTitles"><?php echo $this->_tpl_vars['config_messages']['access_check_pattern']; ?>
</td>
    <td><img src="images/spacer.gif" width="1" height="1" /></td>
    <td class="configItemContents"><?php echo smarty_function_html_radios(array('name' => 'access_check_pattern','selected' => $this->_tpl_vars['conf_info']['access_check_pattern'],'options' => $this->_tpl_vars['config_messages']['access_check_pattern_items'],'separator' => "<br/>"), $this);?>

    <input type="text" name="access_check_pattern_input_time" value="<?php echo $this->_tpl_vars['conf_info']['access_check_pattern_input_time']; ?>
"  onKeyup="this.value=this.value.replace(/[^0-9]/g,'');">
    </td>
  </tr>
  <tr >
    <td><img src="images/spacer.gif" width="1" height="1" /></td>
    <td class="configItemTitles"><?php echo $this->_tpl_vars['config_messages']['check_admin_access']; ?>
</td>
    <td><img src="images/spacer.gif" width="1" height="1" /></td>
    <td class="configItemContents"><?php echo smarty_function_html_radios(array('name' => 'check_admin_access','selected' => $this->_tpl_vars['conf_info']['check_admin_access'],'options' => $this->_tpl_vars['config_messages']['check_admin_access_items'],'separator' => "<br/>"), $this);?>
</td>
  </tr>
  <tr >
    <td><img src="images/spacer.gif" width="1" height="1" /></td>
    <td class="configItemTitles"><?php echo $this->_tpl_vars['config_messages']['access_permission']; ?>
</td>
    <td><img src="images/spacer.gif" width="1" height="1" /></td>
    <td class="configItemContents"><?php echo smarty_function_html_checkboxes(array('name' => 'access_permission','selected' => $this->_tpl_vars['access_perm_checked_items'],'options' => $this->_tpl_vars['config_messages']['access_permission_items'],'separator' => "<br/>"), $this);?>

    </td>
  </tr>
  <tr >
    <td><img src="images/spacer.gif" width="1" height="1" /></td>
    <td class="configItemTitles"><?php echo $this->_tpl_vars['config_messages']['portal_page']; ?>
</td>
    <td><img src="images/spacer.gif" width="1" height="1" /></td>
    <td class="configItemContents">&nbsp;<select name="portal_page"><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['config_messages']['portal_page_items'],'selected' => $this->_tpl_vars['conf_info']['portal_page']), $this);?>
</select>
    </td>
  </tr>
  <tr >
    <td  width="10"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td width="200"></td>
    <td  width="5"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td ><input type="submit" value="OK" style="width:100"></td>
  </tr>
<input type="hidden" name="config_page" value="on">
<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['aa_page']; ?>
">
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
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "bottom.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>