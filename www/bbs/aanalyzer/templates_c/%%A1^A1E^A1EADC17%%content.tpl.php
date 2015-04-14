<?php /* Smarty version 2.6.13, created on 2008-11-25 02:29:24
         compiled from content.tpl */ ?>
<!--  내용 페이지 -->
<?php if ($this->_tpl_vars['no_analysis_flag']): ?>
  <table width="550" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableTopItemTitles" height="30">
      <td background="images/content_top_bar2_left.gif" width="13"><img src="images/spacer.gif" width="13" height="30" /></td>
      <td background="images/content_top_bar2_center.gif" width="529"><?php echo $this->_tpl_vars['common_messages']['no_record']; ?>
</td>
      <td background="images/content_top_bar2_right.gif" width="8"><img src="images/spacer.gif" width="8" height="30" /></td>
    </tr>
  </table><br><br>
  <table width="550" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableTopItemTitles" height="30">
      <td  width="13"><img src="images/spacer.gif" width="13" height="30" /></td>
      <td class="words" width="529"><?php echo $this->_tpl_vars['words']; ?>
</td>
      <td  width="8"><img src="images/spacer.gif" width="8" height="30" /></td>
    </tr>
  </table>
<?php else: ?>
<?php if ($this->_tpl_vars['common_page_view_info']['mode_flag'] == 'os'): ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "content_os.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php elseif ($this->_tpl_vars['common_page_view_info']['mode_flag'] == 'browser'): ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "content_browser.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php elseif ($this->_tpl_vars['common_page_view_info']['mode_flag'] == 'year'): ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "content_year.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php elseif ($this->_tpl_vars['common_page_view_info']['mode_flag'] == 'month'): ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "content_month.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php elseif ($this->_tpl_vars['common_page_view_info']['mode_flag'] == 'week'): ?>
  <table width="550" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableTopItemTitles" height="30">
      <td background="images/content_top_bar2_left.gif" width="13"><img src="images/spacer.gif" width="13" height="30" /></td>
      <td background="images/content_top_bar2_center.gif" width="120"><?php echo $this->_tpl_vars['items_titles']['subject']; ?>
</td>
      <td background="images/content_top_bar2_center.gif" width="70"><?php echo $this->_tpl_vars['items_titles']['counts']; ?>
</td>
      <td background="images/content_top_bar2_center.gif" width="5"><img src="images/spacer.gif" /></td>
      <td background="images/content_top_bar2_center.gif" width="283">&nbsp;</td>
      <td background="images/content_top_bar2_center.gif" width="55"><?php echo $this->_tpl_vars['items_titles']['percentage']; ?>
</td>
      <td background="images/content_top_bar2_right.gif" width="8"><img src="images/spacer.gif" width="8" height="30" /></td>
    </tr>
      <tr height="3">
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
        <td class="analysisTableItemRecordYear" >&nbsp;&nbsp;<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['week']; ?>
</td>
	<td class="analysisCounts" ><?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td class="analysisGraph"  width="5"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_red_left.gif" width="5" height="14"><?php endif; ?></td>
	<td class="analysisGraph" ><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_red_center.gif" width="<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage']; ?>
%" height="14" /><?php endif;  if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage'] != 100):  if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_red_right.gif" height="14"><?php endif;  endif; ?></td>
	<td class="analysisPercentage" ><?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['percentage']; ?>
 %</td>
	<td>&nbsp;</td>
      </tr>
      <?php if (! $this->_sections['report_view']['last']): ?>
      <tr height="1">
      <td><img src="images/spacer.gif" /></td>
        <td colspan="5" style=" BORDER-BOTTOM: #d0d0d0 1px solid"><img src="images/spacer.gif" /></td>
	<td><img src="images/spacer.gif" /></td>
      </tr>

      <?php endif; ?>
       <?php endfor; endif; ?>
  </table>
<table width="550" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableItems">
      <td background="images/detail_info_top_left.gif" width="13"><img src="images/spacer.gif" width="13" height="17" /></td>
      <td background="images/detail_info_top_center.gif" width="531"></td>
      <td background="images/detail_info_top_right.gif" width="6"><img src="images/spacer.gif" width="6" height="17" /></td>
    </tr>
</table>
<?php elseif ($this->_tpl_vars['common_page_view_info']['mode_flag'] == 'day'): ?>
<table width="613" align="center" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableTopItemTitles" height="30">
      <td background="images/content_top_bar2_left.gif" width="13"><img src="images/spacer.gif" width="13" height="30" /></td>
      <td background="images/content_top_bar2_center.gif" width="40"><?php echo $this->_tpl_vars['items_titles']['subject']; ?>
</td>
      <td background="images/content_top_bar2_center.gif" width="60"><?php echo $this->_tpl_vars['items_titles']['counts']; ?>
</td>
      <td background="images/content_top_bar2_center.gif" width="138">&nbsp;</td>
      <td background="images/content_top_bar2_center.gif" width="50"><?php echo $this->_tpl_vars['items_titles']['percentage']; ?>
</td>
      <td background="images/content_top_bar2_center.gif" width="16">&nbsp;</td>
      <td background="images/content_top_bar2_center.gif" width="40"><?php echo $this->_tpl_vars['items_titles']['subject']; ?>
</td>
      <td background="images/content_top_bar2_center.gif" width="60"><?php echo $this->_tpl_vars['items_titles']['counts']; ?>
</td>
      <td background="images/content_top_bar2_center.gif" width="138">&nbsp;</td>
      <td background="images/content_top_bar2_center.gif" width="50"><?php echo $this->_tpl_vars['items_titles']['percentage']; ?>
</td>
      <td background="images/content_top_bar2_right.gif" width="8"><img src="images/spacer.gif" width="8" height="30" /></td>
    </tr>
</table>
<table width="613" align="center" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="13">&nbsp;</td>
    <td class="valignTop" width="288">
      <table width="288" align="center" border="0" cellspacing="0" cellpadding="0">
        <?php unset($this->_sections['report_view']);
$this->_sections['report_view']['name'] = 'report_view';
$this->_sections['report_view']['loop'] = is_array($_loop=$this->_tpl_vars['analysis_info']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['report_view']['max'] = (int)'16';
$this->_sections['report_view']['show'] = true;
if ($this->_sections['report_view']['max'] < 0)
    $this->_sections['report_view']['max'] = $this->_sections['report_view']['loop'];
$this->_sections['report_view']['step'] = 1;
$this->_sections['report_view']['start'] = $this->_sections['report_view']['step'] > 0 ? 0 : $this->_sections['report_view']['loop']-1;
if ($this->_sections['report_view']['show']) {
    $this->_sections['report_view']['total'] = min(ceil(($this->_sections['report_view']['step'] > 0 ? $this->_sections['report_view']['loop'] - $this->_sections['report_view']['start'] : $this->_sections['report_view']['start']+1)/abs($this->_sections['report_view']['step'])), $this->_sections['report_view']['max']);
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
        <tr height="35">
          <td width="40" class="analysisTableItemRecordYear"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['link_flag'] == 1): ?><a href="?id=<?php echo $this->_tpl_vars['aa_page']; ?>
&mode=7&y=<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['year']; ?>
&m=<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['month']; ?>
&d=<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['day']; ?>
"><?php endif;  echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['day'];  if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['link_flag'] == 1): ?></a><?php endif; ?></td>
          <td width="60" class="analysisCounts"><?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts']; ?>
&nbsp;&nbsp;&nbsp;</td>
          <td width="5"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_red_left.gif" width="5" height="14"><?php else: ?><img src="images/spacer.gif" width="5" height="14"><?php endif; ?></td>
          <td width="124" ><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_red_center.gif" width="<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage']; ?>
%" height="14" /><?php endif;  if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage'] != 100):  if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_red_right.gif" height="14"><?php endif;  endif; ?></td>
          <td width="9"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage'] == 100): ?><img src="images/graph_red_right.gif" height="14"><?php else: ?><img src="images/spacer.gif" width="9" height="14" /><?php endif; ?></td>
          <td width="50" class="analysisPercentage"><?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['percentage']; ?>
 %</td>
          </tr>
        <?php endfor; endif; ?>
      </table>
    </td>
    <td width="10">&nbsp;</td>
    <td background="images/border.gif" width="2"><img src="images/spacer.gif" width="1"/></td>
    <td width="4">&nbsp;</td>
    <td class="valignTop" width="288">
      <table width="288" align="center" border="0" cellspacing="0" cellpadding="0">
        <?php unset($this->_sections['report_view']);
$this->_sections['report_view']['name'] = 'report_view';
$this->_sections['report_view']['loop'] = is_array($_loop=$this->_tpl_vars['analysis_info']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['report_view']['start'] = (int)'16';
$this->_sections['report_view']['show'] = true;
$this->_sections['report_view']['max'] = $this->_sections['report_view']['loop'];
$this->_sections['report_view']['step'] = 1;
if ($this->_sections['report_view']['start'] < 0)
    $this->_sections['report_view']['start'] = max($this->_sections['report_view']['step'] > 0 ? 0 : -1, $this->_sections['report_view']['loop'] + $this->_sections['report_view']['start']);
else
    $this->_sections['report_view']['start'] = min($this->_sections['report_view']['start'], $this->_sections['report_view']['step'] > 0 ? $this->_sections['report_view']['loop'] : $this->_sections['report_view']['loop']-1);
if ($this->_sections['report_view']['show']) {
    $this->_sections['report_view']['total'] = min(ceil(($this->_sections['report_view']['step'] > 0 ? $this->_sections['report_view']['loop'] - $this->_sections['report_view']['start'] : $this->_sections['report_view']['start']+1)/abs($this->_sections['report_view']['step'])), $this->_sections['report_view']['max']);
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
        <tr height="35">
          <td width="40" class="analysisTableItemRecordYear"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['link_flag'] == 1): ?><a href="?id=<?php echo $this->_tpl_vars['aa_page']; ?>
&mode=7&y=<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['year']; ?>
&m=<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['month']; ?>
&d=<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['day']; ?>
"><?php endif;  echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['day'];  if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['link_flag'] == 1): ?></a><?php endif; ?></td>

          <td width="60" class="analysisCounts"><?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts']; ?>
&nbsp;&nbsp;&nbsp;</td>
          <td width="5"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_red_left.gif" width="5" height="14"><?php else: ?><img src="images/spacer.gif" width="5" height="14"><?php endif; ?></td>
          <td width="124" ><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_red_center.gif" width="<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage']; ?>
%" height="14" /><?php endif;  if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage'] != 100):  if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_red_right.gif" height="14"><?php endif;  endif; ?></td>
          <td width="9"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage'] == 100): ?><img src="images/graph_red_right.gif" height="14"><?php else: ?><img src="images/spacer.gif" width="9" height="14" /><?php endif; ?></td>
          <td width="50" class="analysisPercentage"><?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['percentage']; ?>
 %</td>
        </tr>
        <?php endfor; endif; ?>
      </table>	
    </td>
    <td width="8">&nbsp;</td>
  </tr>
</table>

<table width="613" align="center" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableItems">
      <td background="images/detail_info_top_left.gif" width="13"><img src="images/spacer.gif" width="13" height="17" /></td>
      <td background="images/detail_info_top_center.gif" width="579"></td>
      <td background="images/detail_info_top_right.gif" width="6"><img src="images/spacer.gif" width="6" height="17" /></td>
    </tr>
</table>

<table width="613" align="center" border="0" cellspacing="0" cellpadding="0">
    <tr >
	<td class="analysisPagerPrev" width="13"></td>
	<td class="analysisPagerNext" width="100"><img src="images/spacer.gif" width="1" height="1" /></td>
	<td class="analysisPagerPrev" width="33"></td>
	<td class="analysisPagerList" width="320"><?php echo $this->_tpl_vars['before_next_link']['before_year'];  echo $this->_tpl_vars['before_next_link']['before_month']; ?>
</td>
	<td class="analysisPagerNext" width="34"></td>
	<td class="analysisPagerPrev" width="100"><img src="images/spacer.gif" width="1" height="1" /></td>
	<td class="analysisPagerPrev" width="13"></td>
    </tr>
</table>

<?php elseif ($this->_tpl_vars['common_page_view_info']['mode_flag'] == 'hour'): ?>
<table width="613" align="center" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableTopItemTitles" height="30">
      <td background="images/content_top_bar2_left.gif" width="13"><img src="images/spacer.gif" width="13"/></td>
      <td background="images/content_top_bar2_center.gif" width="40"><?php echo $this->_tpl_vars['items_titles']['subject']; ?>
</td>
      <td background="images/content_top_bar2_center.gif" width="60"><?php echo $this->_tpl_vars['items_titles']['counts']; ?>
</td>
      <td background="images/content_top_bar2_center.gif" width="138">&nbsp;</td>
      <td background="images/content_top_bar2_center.gif" width="50"><?php echo $this->_tpl_vars['items_titles']['percentage']; ?>
</td>
      <td background="images/content_top_bar2_center.gif" width="16">&nbsp;</td>
      <td background="images/content_top_bar2_center.gif" width="40"><?php echo $this->_tpl_vars['items_titles']['subject']; ?>
</td>
      <td background="images/content_top_bar2_center.gif" width="60"><?php echo $this->_tpl_vars['items_titles']['counts']; ?>
</td>
      <td background="images/content_top_bar2_center.gif" width="138">&nbsp;</td>
      <td background="images/content_top_bar2_center.gif" width="50"><?php echo $this->_tpl_vars['items_titles']['percentage']; ?>
</td>
      <td background="images/content_top_bar2_right.gif" width="8"><img src="images/spacer.gif" width="8" height="30" /></td>
    </tr>
</table>
<table width="613" align="center" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="13">&nbsp;</td>
    <td width="288" class="valignTop">
      <table width="288" align="center" border="0" cellspacing="0" cellpadding="0">
        <?php unset($this->_sections['report_view']);
$this->_sections['report_view']['name'] = 'report_view';
$this->_sections['report_view']['loop'] = is_array($_loop=$this->_tpl_vars['analysis_info']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['report_view']['max'] = (int)'12';
$this->_sections['report_view']['show'] = true;
if ($this->_sections['report_view']['max'] < 0)
    $this->_sections['report_view']['max'] = $this->_sections['report_view']['loop'];
$this->_sections['report_view']['step'] = 1;
$this->_sections['report_view']['start'] = $this->_sections['report_view']['step'] > 0 ? 0 : $this->_sections['report_view']['loop']-1;
if ($this->_sections['report_view']['show']) {
    $this->_sections['report_view']['total'] = min(ceil(($this->_sections['report_view']['step'] > 0 ? $this->_sections['report_view']['loop'] - $this->_sections['report_view']['start'] : $this->_sections['report_view']['start']+1)/abs($this->_sections['report_view']['step'])), $this->_sections['report_view']['max']);
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
        <tr height="40">
          <td width="40" class="analysisTableItemRecordYear">&nbsp;&nbsp;<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['hour']; ?>
</td>
          <td width="248">
            <table width="248" align="center" border="0" cellspacing="0" cellpadding="0">
              <tr height="14" valign="top">
                <td width="60" class="analysisCounts"><?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts']; ?>
&nbsp;&nbsp;</td>
                <td width="5"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_red_left.gif" width="5" height="14"><?php else: ?><img src="images/spacer.gif" width="5" height="14"><?php endif; ?></td>
                <td width="124" ><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_red_center.gif" width="<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage']; ?>
%" height="14" /><?php endif;  if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage'] != 100):  if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_red_right.gif" height="14"><?php endif;  endif; ?></td>
                <td width="9"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage'] == 100): ?><img src="images/graph_red_right.gif" height="14"><?php else: ?><img src="images/spacer.gif" width="9" height="14" /><?php endif; ?></td>
                <td width="50" class="analysisPercentage"><?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['percentage']; ?>
 %</td>
              </tr>
              <tr height="14" valign="top">
                <td width="60" class="analysisCounts"><?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['before_counts']; ?>
&nbsp;&nbsp;</td>
                <td width="5"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['before_counts'] != 0): ?><img src="images/graph_yellow_left.gif" width="5" height="14"><?php endif; ?></td>
                <td width="124" ><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['before_counts'] != 0): ?><img src="images/graph_yellow_center.gif" width="<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['before_graph_percentage']; ?>
%" height="14" /><?php endif;  if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['before_graph_percentage'] != 100):  if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['before_counts'] != 0): ?><img src="images/graph_yellow_right.gif" height="14"><?php endif;  endif; ?></td>
                <td width="9"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['before_graph_percentage'] == 100): ?><img src="images/graph_yellow_right.gif" height="14"><?php endif; ?></td>
                <td width="50" class="analysisPercentage"><?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['before_percentage']; ?>
 %</td>
              </tr>
            </table>
          </td>
        </tr>
        <?php endfor; endif; ?>
      </table>
    </td>
    <td width="10">&nbsp;</td>
    <td background="images/border.gif" width="2"><img src="images/spacer.gif" width="1"/></td>
    <td width="4">&nbsp;</td>
    <td width="288" class="valignTop">
      <table width="288" align="center" border="0" cellspacing="0" cellpadding="0">
        <?php unset($this->_sections['report_view']);
$this->_sections['report_view']['name'] = 'report_view';
$this->_sections['report_view']['loop'] = is_array($_loop=$this->_tpl_vars['analysis_info']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['report_view']['start'] = (int)'12';
$this->_sections['report_view']['show'] = true;
$this->_sections['report_view']['max'] = $this->_sections['report_view']['loop'];
$this->_sections['report_view']['step'] = 1;
if ($this->_sections['report_view']['start'] < 0)
    $this->_sections['report_view']['start'] = max($this->_sections['report_view']['step'] > 0 ? 0 : -1, $this->_sections['report_view']['loop'] + $this->_sections['report_view']['start']);
else
    $this->_sections['report_view']['start'] = min($this->_sections['report_view']['start'], $this->_sections['report_view']['step'] > 0 ? $this->_sections['report_view']['loop'] : $this->_sections['report_view']['loop']-1);
if ($this->_sections['report_view']['show']) {
    $this->_sections['report_view']['total'] = min(ceil(($this->_sections['report_view']['step'] > 0 ? $this->_sections['report_view']['loop'] - $this->_sections['report_view']['start'] : $this->_sections['report_view']['start']+1)/abs($this->_sections['report_view']['step'])), $this->_sections['report_view']['max']);
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
        <tr height="40">
          <td width="40" class="analysisTableItemRecordYear">&nbsp;&nbsp;<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['hour']; ?>
</td>
          <td width="248">
            <table width="248" align="center" border="0" cellspacing="0" cellpadding="0">
              <tr height="14" valign="top">
                <td width="60" class="analysisCounts"><?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td width="5"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_red_left.gif" width="5" height="14"><?php else: ?><img src="images/spacer.gif" width="5" height="14"><?php endif; ?></td>
                <td width="124" ><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_red_center.gif" width="<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage']; ?>
%" height="14" /><?php endif;  if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage'] != 100):  if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_red_right.gif" height="14"><?php endif;  endif; ?></td>
                <td width="9"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage'] == 100): ?><img src="images/graph_red_right.gif" height="14"><?php else: ?><img src="images/spacer.gif" width="9" height="14" /><?php endif; ?></td>
                <td width="50" class="analysisPercentage"><?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['percentage']; ?>
 %</td>
              </tr>
              <tr height="14" valign="top">
                <td width="60" class="analysisCounts"><?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['before_counts']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td width="5"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['before_counts'] != 0): ?><img src="images/graph_yellow_left.gif" width="5" height="14"><?php endif; ?></td>
                <td width="124" ><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['before_counts'] != 0): ?><img src="images/graph_yellow_center.gif" width="<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['before_graph_percentage']; ?>
%" height="14" /><?php endif;  if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['before_graph_percentage'] != 100):  if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['before_counts'] != 0): ?><img src="images/graph_yellow_right.gif" height="14"><?php endif;  endif; ?></td>
                <td width="9"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['before_graph_percentage'] == 100): ?><img src="images/graph_yellow_right.gif" height="14"><?php endif; ?></td>
                <td width="50" class="analysisPercentage"><?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['before_percentage']; ?>
 %</td>
              </tr>
            </table>
          </td>
        </tr>
        <?php endfor; endif; ?>
      </table>
    </td>
    <td width="8">&nbsp;</td>
  </tr>
</table>
<table width="613" align="center" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableItems">
      <td background="images/detail_info_top_left.gif" width="13"><img src="images/spacer.gif" width="13" height="17" /></td>
      <td background="images/detail_info_top_center.gif" width="579"></td>
      <td background="images/detail_info_top_right.gif" width="6"><img src="images/spacer.gif" width="6" height="17" /></td>
    </tr>
</table>
<table width="550" border="0" cellspacing="0" cellpadding="0">
  <tr class="analysisTableItems">
    <td width="13"><img src="images/spacer.gif" width="13" height="10" /></td>
    <td width="80"></td>
    <td width="2"></td>
    <td width="100"></td>
    <td width="347"></td>
    <td width="8"><img src="images/spacer.gif" width="6" height="17" /></td>
  </tr>
  <tr>
    <td width="13"><img src="images/spacer.gif" width="13" height="17" /></td>
    <td class="analysisTableBottomTitles">Today</td>
    <td class="analysisTableBottomTitles">:</td>
    <td class="analysisTableBottomRecords">&nbsp;<img src="images/graph_red_left.gif" width="5" height="14"><img src="images/graph_red_center.gif" width="30" height="14"><img src="images/graph_red_right.gif" height="14"></td>
    <td align="right"><!-- <img src="images/icons/application_add.png">--></td>
    <td ><img src="images/spacer.gif" width="6" height="17" /></td>
  </tr>
  <tr class="analysisTableItems">
    <td><img src="images/spacer.gif" width="13" height="17" /></td>
    <td class="analysisTableBottomTitles">Yesterday</td>
    <td class="analysisTableBottomTitles">:</td>
    <td class="analysisTableBottomRecords">&nbsp;<img src="images/graph_yellow_left.gif" width="5" height="14"><img src="images/graph_yellow_center.gif" width="30" height="14"><img src="images/graph_yellow_right.gif" height="14"></td>
    <td></td>
    <td width="6"><img src="images/spacer.gif" width="6" height="17" /></td>
  </tr>
</table>

<?php elseif ($this->_tpl_vars['common_page_view_info']['mode_flag'] == 'language'): ?>
  <table width="550" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableTopItemTitles" height="30">
      <td background="images/content_top_bar2_left.gif" width="13"><img src="images/spacer.gif" width="13" height="30" /></td>
      <td background="images/content_top_bar2_center.gif" width="120"><?php echo $this->_tpl_vars['items_titles']['subject']; ?>
</td>
      <td background="images/content_top_bar2_center.gif" width="70"><?php echo $this->_tpl_vars['items_titles']['counts']; ?>
</td>
      <td background="images/content_top_bar2_center.gif" width="5"><img src="images/spacer.gif" /></td>
      <td background="images/content_top_bar2_center.gif" width="283">&nbsp;</td>
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
      <tr height="30">
        <td>&nbsp;</td>
        <td class="analysisItem">&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['language_trans']; ?>
(<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['language']; ?>
)</td>
	<td class="analysisCounts"><?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td class="analysisGraph" width="5"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_<?php echo $this->_tpl_vars['common_page_view_info']['graph_color']; ?>
_left.gif" width="5" height="14"><?php endif; ?></td>
	<td class="analysisGraph"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_<?php echo $this->_tpl_vars['common_page_view_info']['graph_color']; ?>
_center.gif" width="<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage']; ?>
%" height="14" /><?php endif;  if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage'] != 100):  if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_<?php echo $this->_tpl_vars['common_page_view_info']['graph_color']; ?>
_right.gif" height="14"><?php endif;  endif; ?></td>
	<td width="9"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage'] == 100): ?><img src="images/graph_<?php echo $this->_tpl_vars['common_page_view_info']['graph_color']; ?>
_right.gif" height="14"><?php endif; ?></td>
	<td class="analysisPercentage"><?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['percentage']; ?>
 %</td>
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
<?php elseif ($this->_tpl_vars['common_page_view_info']['mode_flag'] == 'nation'): ?>
  <table width="550" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableTopItemTitles" height="30">
      <td background="images/content_top_bar2_left.gif" width="13"><img src="images/spacer.gif" width="13" height="30" /></td>
      <td background="images/content_top_bar2_center.gif" width="150"><?php echo $this->_tpl_vars['items_titles']['subject']; ?>
</td>
      <td background="images/content_top_bar2_center.gif" width="70"><?php echo $this->_tpl_vars['items_titles']['counts']; ?>
</td>
      <td background="images/content_top_bar2_center.gif" width="5"><img src="images/spacer.gif" /></td>
      <td background="images/content_top_bar2_center.gif" width="253">&nbsp;</td>
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
      <tr height="30">
        <td>&nbsp;</td>
        <td class="analysisItem">&nbsp;&nbsp;&nbsp;<img src="images/flags/<?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['nation_code'] == null): ?>aokio<?php else:  echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['nation_code'];  endif; ?>.gif" />&nbsp;<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['nation_trans']; ?>
</td>
	<td class="analysisCounts"><?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts']; ?>
&nbsp;&nbsp;&nbsp;</td>
        <td class="analysisGraph" width="5"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_<?php echo $this->_tpl_vars['common_page_view_info']['graph_color']; ?>
_left.gif" width="5" height="14"><?php endif; ?></td>
	<td class="analysisGraph"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_<?php echo $this->_tpl_vars['common_page_view_info']['graph_color']; ?>
_center.gif" width="<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage']; ?>
%" height="14" /><?php endif;  if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage'] != 100):  if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_<?php echo $this->_tpl_vars['common_page_view_info']['graph_color']; ?>
_right.gif" height="14"><?php endif;  endif; ?></td>
	<td width="9"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage'] == 100): ?><img src="images/graph_<?php echo $this->_tpl_vars['common_page_view_info']['graph_color']; ?>
_right.gif" height="14"><?php endif; ?></td>
	<td class="analysisPercentage"><?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['percentage']; ?>
 %</td>
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

<?php elseif ($this->_tpl_vars['common_page_view_info']['mode_flag'] == 'referer'): ?>
  <table width="613" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableTopItemTitles" height="30">
      <td background="images/content_top_bar2_left.gif" width="13"><img src="images/spacer.gif" width="13" height="30" /></td>
      <td background="images/content_top_bar2_center.gif" width="300"><?php echo $this->_tpl_vars['items_titles']['subject']; ?>
</td>
      <td background="images/content_top_bar2_center.gif" width="60"><?php echo $this->_tpl_vars['items_titles']['counts']; ?>
</td>
      <td background="images/content_top_bar2_center.gif" width="5"><img src="images/spacer.gif" /></td>
      <td background="images/content_top_bar2_center.gif" width="168">&nbsp;</td>
      <td background="images/content_top_bar2_center.gif" width="9">&nbsp;</td>
      <td background="images/content_top_bar2_center.gif" width="50"><?php echo $this->_tpl_vars['items_titles']['percentage']; ?>
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
      <tr height="35">
        <td>&nbsp;</td>
        <td class="analysisRefererItem">&nbsp;&nbsp;<?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['link_flag']): ?><a href="<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['referer']; ?>
" target="_blank" title="<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['referer']; ?>
"><?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['short_referer']; ?>
</a><?php else:  echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['short_referer'];  endif; ?></td>
	<td class="analysisCounts"><?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts']; ?>
&nbsp;&nbsp;</td>
        <td class="analysisGraph" width="5"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_<?php echo $this->_tpl_vars['common_page_view_info']['graph_color']; ?>
_left.gif" width="5" height="14"><?php endif; ?></td>
	<td class="analysisGraph"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_<?php echo $this->_tpl_vars['common_page_view_info']['graph_color']; ?>
_center.gif" width="<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage']; ?>
%" height="14" /><?php endif;  if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage'] != 100):  if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_<?php echo $this->_tpl_vars['common_page_view_info']['graph_color']; ?>
_right.gif" height="14"><?php endif;  endif; ?></td>
	<td width="9"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage'] == 100): ?><img src="images/graph_<?php echo $this->_tpl_vars['common_page_view_info']['graph_color']; ?>
_right.gif" height="14"><?php endif; ?></td>
	<td class="analysisPercentage"><?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['percentage']; ?>
 %</td>
	<td>&nbsp;</td>
      </tr>
       <?php endfor; endif; ?>
  </table>
<table width="613" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableItems">
      <td background="images/detail_info_top_left.gif" width="13"><img src="images/spacer.gif" width="13" height="17" /></td>
      <td background="images/detail_info_top_center.gif" width="594"></td>
      <td background="images/detail_info_top_right.gif" width="6"><img src="images/spacer.gif" width="6" height="17" /></td>
    </tr>
</table>

<?php elseif ($this->_tpl_vars['common_page_view_info']['mode_flag'] == 'refererserver'): ?>
  <table width="613" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableTopItemTitles" height="30">
      <td background="images/content_top_bar2_left.gif" width="13"><img src="images/spacer.gif" width="13" height="30" /></td>
      <td background="images/content_top_bar2_center.gif" width="250"><?php echo $this->_tpl_vars['items_titles']['subject']; ?>
</td>
      <td background="images/content_top_bar2_center.gif" width="60"><?php echo $this->_tpl_vars['items_titles']['counts']; ?>
</td>
      <td background="images/content_top_bar2_center.gif" width="5"><img src="images/spacer.gif" /></td>
      <td background="images/content_top_bar2_center.gif" width="218">&nbsp;</td>
      <td background="images/content_top_bar2_center.gif" width="9">&nbsp;</td>
      <td background="images/content_top_bar2_center.gif" width="50"><?php echo $this->_tpl_vars['items_titles']['percentage']; ?>
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
      <tr height="35">
        <td>&nbsp;</td>
        <td class="analysisItem">&nbsp;&nbsp;<a href="<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['refererserver']; ?>
" target="_blank"><?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['refererserver']; ?>
</a></td>
	<td class="analysisCounts"><?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td class="analysisGraph" width="5"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_<?php echo $this->_tpl_vars['common_page_view_info']['graph_color']; ?>
_left.gif" width="5" height="14"><?php endif; ?></td>
	<td class="analysisGraph"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_<?php echo $this->_tpl_vars['common_page_view_info']['graph_color']; ?>
_center.gif" width="<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage']; ?>
%" height="14" /><?php endif;  if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage'] != 100):  if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_<?php echo $this->_tpl_vars['common_page_view_info']['graph_color']; ?>
_right.gif" height="14"><?php endif;  endif; ?></td>
	<td width="9"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage'] == 100): ?><img src="images/graph_<?php echo $this->_tpl_vars['common_page_view_info']['graph_color']; ?>
_right.gif" height="14"><?php endif; ?></td>
	<td class="analysisPercentage"><?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['percentage']; ?>
 %</td>
	<td>&nbsp;</td>
      </tr>
       <?php endfor; endif; ?>
  </table>
<table width="613" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableItems">
      <td background="images/detail_info_top_left.gif" width="13"><img src="images/spacer.gif" width="13" height="17" /></td>
      <td background="images/detail_info_top_center.gif" width="594"></td>
      <td background="images/detail_info_top_right.gif" width="6"><img src="images/spacer.gif" width="6" height="17" /></td>
    </tr>
</table>
<?php elseif ($this->_tpl_vars['common_page_view_info']['mode_flag'] == 'screensize'): ?>
  <table width="550" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableTopItemTitles" height="30">
      <td background="images/content_top_bar2_left.gif" width="13"><img src="images/spacer.gif" width="13" height="30" /></td>
      <td background="images/content_top_bar2_center.gif" width="130"><?php echo $this->_tpl_vars['items_titles']['subject']; ?>
</td>
      <td background="images/content_top_bar2_center.gif" width="70"><?php echo $this->_tpl_vars['items_titles']['counts']; ?>
</td>
      <td background="images/content_top_bar2_center.gif" width="5"><img src="images/spacer.gif" /></td>
      <td background="images/content_top_bar2_center.gif" width="273">&nbsp;</td>
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
        <td class="analysisItem">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['screensize']; ?>
</td>
	<td class="analysisCounts"><?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts']; ?>
&nbsp;&nbsp;&nbsp;</td>
        <td class="analysisGraph" width="5"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_<?php echo $this->_tpl_vars['common_page_view_info']['graph_color']; ?>
_left.gif" width="5" height="14"><?php endif; ?></td>
	<td class="analysisGraph"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_<?php echo $this->_tpl_vars['common_page_view_info']['graph_color']; ?>
_center.gif" width="<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage']; ?>
%" height="14" /><?php endif;  if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage'] != 100):  if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_<?php echo $this->_tpl_vars['common_page_view_info']['graph_color']; ?>
_right.gif" height="14"><?php endif;  endif; ?></td>
	<td width="9"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage'] == 100): ?><img src="images/graph_<?php echo $this->_tpl_vars['common_page_view_info']['graph_color']; ?>
_right.gif" height="14"><?php endif; ?></td>
	<td class="analysisPercentage"><?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['percentage']; ?>
 %</td>
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
<?php elseif ($this->_tpl_vars['common_page_view_info']['mode_flag'] == 'resolution'): ?>
  <table width="550" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableTopItemTitles" height="30">
      <td background="images/content_top_bar2_left.gif" width="13"><img src="images/spacer.gif" width="13" height="30" /></td>
      <td background="images/content_top_bar2_center.gif" width="220"><?php echo $this->_tpl_vars['items_titles']['subject']; ?>
</td>
      <td background="images/content_top_bar2_center.gif" width="70"><?php echo $this->_tpl_vars['items_titles']['counts']; ?>
</td>
      <td background="images/content_top_bar2_center.gif" width="5"><img src="images/spacer.gif" /></td>
      <td background="images/content_top_bar2_center.gif" width="183">&nbsp;</td>
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
        <td class="analysisItem">&nbsp;&nbsp;<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['resolution']; ?>
 Colors(<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['bit']; ?>
bit)</td>
	<td class="analysisCounts"><?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td class="analysisGraph" width="5"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_<?php echo $this->_tpl_vars['common_page_view_info']['graph_color']; ?>
_left.gif" width="5" height="14"><?php endif; ?></td>
	<td class="analysisGraph"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_<?php echo $this->_tpl_vars['common_page_view_info']['graph_color']; ?>
_center.gif" width="<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage']; ?>
%" height="14" /><?php endif;  if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage'] != 100):  if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_<?php echo $this->_tpl_vars['common_page_view_info']['graph_color']; ?>
_right.gif" height="14"><?php endif;  endif; ?></td>
	<td width="9"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage'] == 100): ?><img src="images/graph_<?php echo $this->_tpl_vars['common_page_view_info']['graph_color']; ?>
_right.gif" height="14"><?php endif; ?></td>
	<td class="analysisPercentage"><?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['percentage']; ?>
 %</td>
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

<?php elseif ($this->_tpl_vars['common_page_view_info']['mode_flag'] == 'searchkeyword'): ?>
  <table width="550" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableTopItemTitles" height="30">
      <td background="images/content_top_bar2_left.gif" width="13"><img src="images/spacer.gif" width="13" height="30" /></td>
      <td background="images/content_top_bar2_center.gif" width="220"><?php echo $this->_tpl_vars['items_titles']['subject']; ?>
</td>
      <td background="images/content_top_bar2_center.gif" width="70"><?php echo $this->_tpl_vars['items_titles']['counts']; ?>
</td>
      <td background="images/content_top_bar2_center.gif" width="5"><img src="images/spacer.gif" /></td>
      <td background="images/content_top_bar2_center.gif" width="183">&nbsp;</td>
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
        <td class="analysisItem">&nbsp;&nbsp;<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['keyword']; ?>
</td>
	<td class="analysisCounts"><?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td class="analysisGraph" width="5"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_<?php echo $this->_tpl_vars['common_page_view_info']['graph_color']; ?>
_left.gif" width="5" height="14"><?php endif; ?></td>
	<td class="analysisGraph"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_<?php echo $this->_tpl_vars['common_page_view_info']['graph_color']; ?>
_center.gif" width="<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage']; ?>
%" height="14" /><?php endif;  if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage'] != 100):  if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_<?php echo $this->_tpl_vars['common_page_view_info']['graph_color']; ?>
_right.gif" height="14"><?php endif;  endif; ?></td>
	<td width="9"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage'] == 100): ?><img src="images/graph_<?php echo $this->_tpl_vars['common_page_view_info']['graph_color']; ?>
_right.gif" height="14"><?php endif; ?></td>
	<td class="analysisPercentage"><?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['percentage']; ?>
 %</td>
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


<?php elseif ($this->_tpl_vars['common_page_view_info']['mode_flag'] == 'searchsite'): ?>
  <table width="550" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableTopItemTitles" height="30">
      <td background="images/content_top_bar2_left.gif" width="13"><img src="images/spacer.gif" width="13" height="30" /></td>
      <td background="images/content_top_bar2_center.gif" width="220"><?php echo $this->_tpl_vars['items_titles']['subject']; ?>
</td>
      <td background="images/content_top_bar2_center.gif" width="70"><?php echo $this->_tpl_vars['items_titles']['counts']; ?>
</td>
      <td background="images/content_top_bar2_center.gif" width="5"><img src="images/spacer.gif" /></td>
      <td background="images/content_top_bar2_center.gif" width="183">&nbsp;</td>
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
        <td class="analysisItem">&nbsp;&nbsp;<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['searchsite']; ?>
 </td>
	<td class="analysisCounts"><?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td class="analysisGraph" width="5"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_<?php echo $this->_tpl_vars['common_page_view_info']['graph_color']; ?>
_left.gif" width="5" height="14"><?php endif; ?></td>
	<td class="analysisGraph"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_<?php echo $this->_tpl_vars['common_page_view_info']['graph_color']; ?>
_center.gif" width="<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage']; ?>
%" height="14" /><?php endif;  if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage'] != 100):  if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_<?php echo $this->_tpl_vars['common_page_view_info']['graph_color']; ?>
_right.gif" height="14"><?php endif;  endif; ?></td>
	<td width="9"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage'] == 100): ?><img src="images/graph_<?php echo $this->_tpl_vars['common_page_view_info']['graph_color']; ?>
_right.gif" height="14"><?php endif; ?></td>
	<td class="analysisPercentage"><?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['percentage']; ?>
 %</td>
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


<?php elseif ($this->_tpl_vars['common_page_view_info']['mode_flag'] == 'search_robot'): ?>
  <table width="613" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableTopItemTitles" height="30">
      <td background="images/content_top_bar2_left.gif" width="13"><img src="images/spacer.gif" width="13" height="30" /></td>
      <td background="images/content_top_bar2_center.gif" width="300"><?php echo $this->_tpl_vars['items_titles']['subject']; ?>
</td>
      <td background="images/content_top_bar2_center.gif" width="60"><?php echo $this->_tpl_vars['items_titles']['counts']; ?>
</td>
      <td background="images/content_top_bar2_center.gif" width="5"><img src="images/spacer.gif" /></td>
      <td background="images/content_top_bar2_center.gif" width="168">&nbsp;</td>
      <td background="images/content_top_bar2_center.gif" width="9">&nbsp;</td>
      <td background="images/content_top_bar2_center.gif" width="50"><?php echo $this->_tpl_vars['items_titles']['percentage']; ?>
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
      <tr height="35">
        <td>&nbsp;</td>
        <td class="analysisItem">&nbsp;&nbsp;<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['bot']['name']; ?>
 <?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['bot']['version']; ?>
 <?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['bot']['bot_url']): ?><a href="<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['bot']['bot_url']; ?>
" target="_blank">Bot Information URL</a><?php endif; ?></td>
	<td class="analysisCounts"><?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td class="analysisGraph" width="5"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_<?php echo $this->_tpl_vars['common_page_view_info']['graph_color']; ?>
_left.gif" width="5" height="14"><?php endif; ?></td>
	<td class="analysisGraph"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_<?php echo $this->_tpl_vars['common_page_view_info']['graph_color']; ?>
_center.gif" width="<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage']; ?>
%" height="14" /><?php endif;  if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage'] != 100):  if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['counts'] != 0): ?><img src="images/graph_<?php echo $this->_tpl_vars['common_page_view_info']['graph_color']; ?>
_right.gif" height="14"><?php endif;  endif; ?></td>
	<td width="9"><?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['graph_percentage'] == 100): ?><img src="images/graph_<?php echo $this->_tpl_vars['common_page_view_info']['graph_color']; ?>
_right.gif" height="14"><?php endif; ?></td>
	<td class="analysisPercentage"><?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['percentage']; ?>
 %</td>
	<td>&nbsp;</td>
      </tr>
       <?php endfor; endif; ?>
  </table>
<table width="613" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableItems">
      <td background="images/detail_info_top_left.gif" width="13"><img src="images/spacer.gif" width="13" height="17" /></td>
      <td background="images/detail_info_top_center.gif" width="594"></td>
      <td background="images/detail_info_top_right.gif" width="6"><img src="images/spacer.gif" width="6" height="17" /></td>
    </tr>
</table>
<?php elseif ($this->_tpl_vars['common_page_view_info']['mode_flag'] == 'search_robot_detail'): ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "content_search_robot_detail.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php elseif ($this->_tpl_vars['common_page_view_info']['mode_flag'] == 'all_info'): ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "content_all_info.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>

<?php endif; ?>