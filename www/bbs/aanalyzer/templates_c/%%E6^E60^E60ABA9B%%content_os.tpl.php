<?php /* Smarty version 2.6.13, created on 2008-11-25 02:29:27
         compiled from content_os.tpl */ ?>
<table width="550" border="0" cellspacing="0" cellpadding="0">
  <tr class="analysisTableTopItemTitles" height="30">
    <td background="images/content_top_bar2_left.gif" width="13"><img src="images/spacer.gif" width="13" height="30" /></td>
    <td background="images/content_top_bar2_center.gif" width="200"><?php echo $this->_tpl_vars['items_titles']['subject']; ?>
</td>
    <td background="images/content_top_bar2_center.gif" width="70"><?php echo $this->_tpl_vars['items_titles']['counts']; ?>
</td>
    <td background="images/content_top_bar2_center.gif" width="5"><img src="images/spacer.gif" /></td>
    <td background="images/content_top_bar2_center.gif" width="193">&nbsp;</td>
    <td background="images/content_top_bar2_center.gif" width="9">&nbsp;</td>
    <td background="images/content_top_bar2_center.gif" width="55"><?php echo $this->_tpl_vars['items_titles']['percentage']; ?>
</td>
    <td background="images/content_top_bar2_right.gif" width="8"><img src="images/spacer.gif" width="8" height="30" /></td>
  </tr>
    <tr height="9">
      <td><img src="images/spacer.gif" /></td>
      <td><img src="images/spacer.gif" /></td>
      <td><img src="images/spacer.gif" /></td>
      <td><img src="images/spacer.gif" /></td>
      <td><img src="images/spacer.gif" /></td>
      <td><img src="images/spacer.gif" /></td>
      <td><img src="images/spacer.gif" /></td>
      <td><img src="images/spacer.gif" /></td>
    </tr>
 <?php unset($this->_sections['report_view']);
$this->_sections['report_view']['name'] = 'report_view';
$this->_sections['report_view']['loop'] = is_array($_loop=$this->_tpl_vars['analysis_info']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
    <tr height="45">
      <td>&nbsp;</td>
      <td class="analysisItem">&nbsp;&nbsp;<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['os_full_name']; ?>
</td>
      <td class="analysisCounts"><?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;</td>
      <td class="analysisGraph" width="5"><img src="images/graph_<?php echo $this->_tpl_vars['common_page_view_info']['graph_color']; ?>
_left.gif" width="5" height="14"></td>
      <td class="analysisGraph"><img src="images/graph_<?php echo $this->_tpl_vars['common_page_view_info']['graph_color']; ?>
_center.gif" width="<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage']; ?>
%" height="14" /><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage'] != 100): ?><img src="images/graph_<?php echo $this->_tpl_vars['common_page_view_info']['graph_color']; ?>
_right.gif" height="14"><?php endif; ?></td>
      <td width="9"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage'] == 100): ?><img src="images/graph_<?php echo $this->_tpl_vars['common_page_view_info']['graph_color']; ?>
_right.gif" height="14"><?php endif; ?></td>
      <td class="analysisPercentage"><?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['percentage']; ?>
 %&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
 <?php endfor; endif; ?>
</table>
<table width="550" border="0" cellspacing="0" cellpadding="0">
  <tr class="analysisTableItems">
    <td background="images/detail_info_top_left.gif" width="13"><img src="images/spacer.gif" width="13" height="17" /></td>
    <td background="images/detail_info_top_center.gif" width="531"></td>
    <td background="images/detail_info_top_right.gif" width="6"><img src="images/spacer.gif" width="6" height="17" /></td>
  </tr>
</table>

<table width="550" border="0" cellspacing="0" cellpadding="0">
  <tr height="10">
    <td colspan="2">&nbsp;
    </td></tr>
  <tr class="analysisTableItems">
    <td width="225" valign="top" >
<div class="analysisHangulItem"><a href="<?php echo $this->_tpl_vars['analysis_view_file_name']; ?>
?mode=1&id=<?php echo $this->_tpl_vars['aa_page']; ?>
&vo=fn" ><?php echo $this->_tpl_vars['items_titles']['full_name_analysis']; ?>
</a></div>
<div class="analysisHangulItem"><a href="<?php echo $this->_tpl_vars['analysis_view_file_name']; ?>
?mode=1&id=<?php echo $this->_tpl_vars['aa_page']; ?>
&vo=ca" ><?php echo $this->_tpl_vars['items_titles']['category_analysis']; ?>
</a>
</div>
<div ><!--<a href="<?php echo $this->_tpl_vars['analysis_view_file_name']; ?>
?mode=1&id=<?php echo $this->_tpl_vars['aa_page']; ?>
&vo=bo" >both</a><br>--></div>
<div ></div>

    </td>
    <td width="225">
    <table width="100%" border="0" cellspacing="0" cellpadding="0"class=" analysisRefererItem" >
    <tr >
    <td width="60">Total</td><td>: <?php echo $this->_tpl_vars['bottom_misc_counts']['total']; ?>
</td></tr>
    <td >OS Counts</td><td>: <?php echo $this->_tpl_vars['bottom_misc_counts']['items_counts']; ?>
</td></tr>
    <td >Average</td><td>: <?php echo $this->_tpl_vars['bottom_misc_counts']['average']; ?>
</td></tr>
    <td >Max</td><td>: <?php echo $this->_tpl_vars['bottom_misc_counts']['max']; ?>
</td></tr>
    <td >Min</td><td>: <?php echo $this->_tpl_vars['bottom_misc_counts']['min']; ?>
</td></tr>
</table>
    </td>
  </tr>
</table>
