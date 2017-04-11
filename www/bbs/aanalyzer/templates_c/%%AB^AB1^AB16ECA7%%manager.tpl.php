<?php /* Smarty version 2.6.13, created on 2008-11-25 02:23:52
         compiled from manager.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'manager.tpl', 135, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "manager_top.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<table width="800" border="0" cellpadding="0" cellspacing="0" class="mainTable">
  <tr>
    <td background="images/border.gif" width="1"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td width="10"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td>

<table width="778" align="center" border="0" cellspacing="0" cellpadding="0">
    <tr class="managerItemTitles">
      <td background="images/content_top_bar2_left.gif" width="13"><img src="images/spacer.gif" width="13" height="30" /></td>
      <td background="images/content_top_bar2_center.gif" width="100"><?php echo $this->_tpl_vars['target_list_item_titles']['no']; ?>
</td>
      <td background="images/content_top_bar2_center.gif" width="357"><?php echo $this->_tpl_vars['target_list_item_titles']['target']; ?>
</td>
      <td background="images/content_top_bar2_center.gif" width="60"><?php echo $this->_tpl_vars['target_list_item_titles']['total']; ?>
</td>
      <td background="images/content_top_bar2_center.gif" width="60"><?php echo $this->_tpl_vars['target_list_item_titles']['today']; ?>
</td>
      <td background="images/content_top_bar2_center.gif" width="60"><?php echo $this->_tpl_vars['target_list_item_titles']['max']; ?>
</td>
      <td background="images/content_top_bar2_center.gif" width="60"><?php echo $this->_tpl_vars['target_list_item_titles']['drop']; ?>
</td>
      <td background="images/content_top_bar2_center.gif" width="60"><?php echo $this->_tpl_vars['target_list_item_titles']['truncate']; ?>
</td>
      <td background="images/content_top_bar2_center.gif" width="60"><?php echo $this->_tpl_vars['target_list_item_titles']['config']; ?>
</td>
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
<?php unset($this->_sections['report_view']);
$this->_sections['report_view']['name'] = 'report_view';
$this->_sections['report_view']['loop'] = is_array($_loop=$this->_tpl_vars['manage_list']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['report_view']['show'] = true;
$this->_sections['report_view']['max'] = $this->_sections['report_view']['loop'];
$this->_sections['report_view']['step'] = 1;
$this->_sections['report_view']['start'] = $this->_sections['report_view']['step'] > 0 ? 0 : $this->_sections['report_view']['loop']-1;
if ($this->_sections['report_view']['show']) {
    $this->_sections['report_view']['total'] = $this->_sections['report_view']['loop'];
    if ($this->_sections['report_view']['total'] == 0)
        $this->_sections['report_view']['show'] = false;
} else
    $this->_sections['report_view']['total'] = 0;
if ($this->_sections['report_view']['show']):

            for ($this->_sections['report_view']['index'] = $this->_sections['report_view']['start'], $this->_sections['report_view']['iteration'] = 1;
                 $this->_sections['report_view']['iteration'] <= $this->_sections['report_view']['total'];
                 $this->_sections['report_view']['index'] += $this->_sections['report_view']['step'], $this->_sections['report_view']['iteration']++):
$this->_sections['report_view']['rownum'] = $this->_sections['report_view']['iteration'];
$this->_sections['report_view']['index_prev'] = $this->_sections['report_view']['index'] - $this->_sections['report_view']['step'];
$this->_sections['report_view']['index_next'] = $this->_sections['report_view']['index'] + $this->_sections['report_view']['step'];
$this->_sections['report_view']['first']      = ($this->_sections['report_view']['iteration'] == 1);
$this->_sections['report_view']['last']       = ($this->_sections['report_view']['iteration'] == $this->_sections['report_view']['total']);
?>
<tr class="managerItemContents" height="30">
        <td ></td>
<td class="installMessage"><?php echo $this->_tpl_vars['manage_list'][$this->_sections['report_view']['index']]['v_no']; ?>
</td>
<td class="installMessage"><a href="./view.php?id=<?php echo $this->_tpl_vars['manage_list'][$this->_sections['report_view']['index']]['target']; ?>
"><?php echo $this->_tpl_vars['manage_list'][$this->_sections['report_view']['index']]['target_name']; ?>
:<?php echo $this->_tpl_vars['manage_list'][$this->_sections['report_view']['index']]['target']; ?>
</a></td>
<td class="installMessage"><?php echo $this->_tpl_vars['manage_list'][$this->_sections['report_view']['index']]['total']; ?>
</td>
<td class="installMessage"><?php echo $this->_tpl_vars['manage_list'][$this->_sections['report_view']['index']]['today']; ?>
</td>
<td class="installMessage"><?php echo $this->_tpl_vars['manage_list'][$this->_sections['report_view']['index']]['max']; ?>
</td>

<td class="installMessage"><a href="./manager.php?id=<?php echo $this->_tpl_vars['manage_list'][$this->_sections['report_view']['index']]['target']; ?>
&mode=drop"><?php echo $this->_tpl_vars['target_list_item_titles']['drop']; ?>
</a></td>
<td class="installMessage"><a href="./manager.php?id=<?php echo $this->_tpl_vars['manage_list'][$this->_sections['report_view']['index']]['target']; ?>
&mode=truncate"><?php echo $this->_tpl_vars['target_list_item_titles']['truncate']; ?>
</a></td>
<td class="installMessage"><a href="aokio_config.php?id=<?php echo $this->_tpl_vars['manage_list'][$this->_sections['report_view']['index']]['target']; ?>
"><?php echo $this->_tpl_vars['target_list_item_titles']['config']; ?>
</a></td>
	<td ></td>
</tr>
<?php endfor; endif; ?>
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
<?php if ($this->_tpl_vars['no_id_flag']): ?>
<tr>
<td   class="configOKMessage" colspan="2"><?php echo $this->_tpl_vars['manager_messages']['no_id_message']; ?>

</td>
</tr>
<?php endif; ?>
<form method="post" action="manager.php">
<tr>
<?php if ($this->_tpl_vars['drop_confirm_flag']): ?>
<td  class="configOKMessage"><?php echo $this->_tpl_vars['manager_messages']['drop_confirm_message']; ?>
</td>
<td>
<input type="hidden" name="confirm" value="OK">
<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['drop_id']; ?>
">
<input type="hidden" name="mode" value="drop">
<input type="submit" value="<?php echo $this->_tpl_vars['target_list_item_titles']['drop']; ?>
" style="width:150">
</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['truncate_confirm_flag']): ?>
<td class="configOKMessage" ><?php echo $this->_tpl_vars['manager_messages']['truncate_confirm_message']; ?>
</td>
<td >
<input type="hidden" name="confirm" value="OK">
<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['truncate_id']; ?>
">
<input type="hidden" name="mode" value="truncate">
<input type="submit" value="<?php echo $this->_tpl_vars['target_list_item_titles']['truncate']; ?>
" style="width:150">

</td>
<?php endif; ?>
</tr>
</form>
</table>

 <form id="create_target_page" name="create_counter_page" method="post" action="create_target_page.php">
<table width="778" align="center" border="0" cellspacing="3" cellpadding="0">
<tr class="analysisTableItems">
<td width="180"  class="managerConfigItemTitles">
<?php echo $this->_tpl_vars['manager_messages']['create_new_target']; ?>
</td>
<td align="left"> <input type="text" name="target_page" onKeyup="this.value=this.value.replace(/[^0-9a-zA-Z_]/g,'');">&nbsp;&nbsp;<input type="submit" value="OK" class="loginInputForms" style='width:100'>
</td>
</tr>
<tr class="analysisTableItems">
<td width="180" >
</td>
<td align="left" class="managerConfigCreateComment"><?php echo $this->_tpl_vars['manager_messages']['howto_create_new_target']; ?>
</td>
</tr>
<?php if ($this->_tpl_vars['create_error'] != null): ?>
<tr class="analysisTableItems">
<td width="180" >
</td>
<td align="left" class="managerConfigCreateComment">
<?php if ($this->_tpl_vars['create_error'] == 1):  echo $this->_tpl_vars['create_error_message']['input_error_no_input']; ?>

<?php elseif ($this->_tpl_vars['create_error'] == 2):  echo $this->_tpl_vars['create_error_message']['input_error_character_error']; ?>

<?php elseif ($this->_tpl_vars['create_error'] == 3):  echo $this->_tpl_vars['create_error_message']['input_error_is_exist']; ?>

<?php elseif ($this->_tpl_vars['create_error'] == 5):  echo $this->_tpl_vars['create_error_message']['input_error_too_long']; ?>

<?php endif; ?></td>
</tr>
<?php endif; ?>
</table>
</form>
<form id="manager_config" name="manager_config" method="post" action="manager.php">
<table width="778" align="center" border="0" cellspacing="2" cellpadding="0">
<tr>
<td class="managerConfigItemTitles" width="180" >
<?php echo $this->_tpl_vars['manager_messages']['change_language']; ?>
</td>
<td> <select name="language"><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['lang_list'],'selected' => $this->_tpl_vars['language']), $this);?>

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
<?php echo $this->_tpl_vars['manager_messages']['update_check']; ?>
</td>
<td> <input type="hidden" name="version" value="<?php echo $this->_tpl_vars['version']; ?>
">
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
