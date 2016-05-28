<?php /* Smarty version 2.6.13, created on 2008-11-25 02:29:24
         compiled from menu.tpl */ ?>
<!-- 메뉴 -->
<table width="100" border="0" cellspacing="0" cellpadding="0">
  <tr class="menuTableBorder">
   <td width="1" height="1"><img src="images/spacer.gif" width="1" height="1" /></td>
   <td width="139" height="1"><img src="images/spacer.gif" width="1" height="1" /></td>
   <td width="1" height="1"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
 <?php unset($this->_sections['menu_view']);
$this->_sections['menu_view']['name'] = 'menu_view';
$this->_sections['menu_view']['loop'] = is_array($_loop=$this->_tpl_vars['menu_info']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['menu_view']['show'] = true;
$this->_sections['menu_view']['max'] = $this->_sections['menu_view']['loop'];
$this->_sections['menu_view']['step'] = 1;
$this->_sections['menu_view']['start'] = $this->_sections['menu_view']['step'] > 0 ? 0 : $this->_sections['menu_view']['loop']-1;
if ($this->_sections['menu_view']['show']) {
    $this->_sections['menu_view']['total'] = $this->_sections['menu_view']['loop'];
    if ($this->_sections['menu_view']['total'] == 0)
        $this->_sections['menu_view']['show'] = false;
} else
    $this->_sections['menu_view']['total'] = 0;
if ($this->_sections['menu_view']['show']):

            for ($this->_sections['menu_view']['index'] = $this->_sections['menu_view']['start'], $this->_sections['menu_view']['iteration'] = 1;
                 $this->_sections['menu_view']['iteration'] <= $this->_sections['menu_view']['total'];
                 $this->_sections['menu_view']['index'] += $this->_sections['menu_view']['step'], $this->_sections['menu_view']['iteration']++):
$this->_sections['menu_view']['rownum'] = $this->_sections['menu_view']['iteration'];
$this->_sections['menu_view']['index_prev'] = $this->_sections['menu_view']['index'] - $this->_sections['menu_view']['step'];
$this->_sections['menu_view']['index_next'] = $this->_sections['menu_view']['index'] + $this->_sections['menu_view']['step'];
$this->_sections['menu_view']['first']      = ($this->_sections['menu_view']['iteration'] == 1);
$this->_sections['menu_view']['last']       = ($this->_sections['menu_view']['iteration'] == $this->_sections['menu_view']['total']);
?>
  <tr height="48">
    <td  width="1" height="48" class="menuTableBorder"><img src="images/spacer.gif" width="1" /></td>
    <td width="139"><a href="<?php echo $this->_tpl_vars['analysis_view_file_name']; ?>
?mode=<?php echo $this->_tpl_vars['menu_info'][$this->_sections['menu_view']['index']]['mode']; ?>
&id=<?php echo $this->_tpl_vars['aa_page']; ?>
" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('<?php echo $this->_tpl_vars['menu_info'][$this->_sections['menu_view']['index']]['image_name']; ?>
_analysis','','images/<?php echo $this->_tpl_vars['language']; ?>
/<?php echo $this->_tpl_vars['menu_info'][$this->_sections['menu_view']['index']]['image_name']; ?>
_menu02.gif',1)"><img src="images/<?php echo $this->_tpl_vars['language']; ?>
/<?php echo $this->_tpl_vars['menu_info'][$this->_sections['menu_view']['index']]['image_name']; ?>
_menu01.gif" name="<?php echo $this->_tpl_vars['menu_info'][$this->_sections['menu_view']['index']]['image_name']; ?>
_analysis" width="139" height="48" border="0" id="<?php echo $this->_tpl_vars['menu_info'][$this->_sections['menu_view']['index']]['image_name']; ?>
_analysis" title="<?php echo $this->_tpl_vars['menu_info'][$this->_sections['menu_view']['index']]['menu_comment']; ?>
"/></a></td>
    <td  width="1" class="menuTableBorder"><img src="images/spacer.gif" width="1" /></td>
  </tr>
 <?php endfor; endif; ?>
  <tr class="menuTableBorder">
    <td width="1" height="1"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td width="139" height="1"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td width="1" height="1"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
</table>