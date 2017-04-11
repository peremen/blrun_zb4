<?php /* Smarty version 2.6.13, created on 2008-11-25 02:30:07
         compiled from content_all_info.tpl */ ?>

<table width="613" align="center" border="0" cellspacing="0" cellpadding="0">
<tr class="analysisTableItems">
<td background="images/detail_info_top_left.gif" width="13"><img src="images/spacer.gif" width="13" height="17" /></td>
<td background="images/detail_info_top_center.gif" width="594"></td>
<td background="images/detail_info_top_right.gif" width="6"><img src="images/spacer.gif" width="6" height="17" /></td>
</tr>
</table>

<table width="600" align="center" border="0" cellspacing="1" cellpadding="0">
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
<tr class="osAnalysis" height="15">
<td class="allAnalysisItem" width="80">NO.</td>
<td class="allAnalysisRecords" width="220">&nbsp;&nbsp;<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['no']; ?>
</td>
<td class="allAnalysisItem" width="80">Visit Counts</td>
<td class="allAnalysisRecords" width="220">&nbsp;<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['visit_count']; ?>
</td>
</tr>

<tr class="osAnalysis" height="15">
<td class="allAnalysisItem" width="80">OS</td>
<td class="allAnalysisRecords" colspan="3">&nbsp;
<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['os_full_name']; ?>

<?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['os_sp_info']):  echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['os_sp_info']; ?>
&nbsp;&nbsp;
<?php endif; ?>
<?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['os_net_frame']):  echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['os_net_frame']; ?>
&nbsp;&nbsp;
<?php endif; ?>
</td>
</tr>


<tr class="osAnalysis" height="15">
<td class="allAnalysisItem" width="80">Browser</td>
<td class="allAnalysisRecords" colspan="3" >&nbsp; <?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['browser_version']; ?>

<?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['browser_build_date']): ?>BuildDate:<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['browser_build_date']; ?>
&nbsp;&nbsp;
<?php endif; ?>
<?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['browser_security']): ?>Security:<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['browser_security']; ?>
&nbsp;&nbsp;
<?php endif; ?>
</td>
</tr>


<tr class="osAnalysis" height="15">
<td class="allAnalysisItem" width="80">IP</td>
<td class="allAnalysisRecords">&nbsp;<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['ip']; ?>
</td>
<td class="allAnalysisItem" width="80">Nation</td>
<td class="allAnalysisRecords">&nbsp;<img src="images/flags/<?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['nation_code'] == null): ?>aokio<?php else:  echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['nation_code'];  endif; ?>.gif" />&nbsp;<a href="http://en.wikipedia.org/wiki/<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['nation']; ?>
" target="_blank"><?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['nation_trans']; ?>
</td>
</tr>

<tr class="osAnalysis" height="15">
<td class="allAnalysisItem" width="80">Lang.Info</td>
<td class="allAnalysisRecords" width="220">&nbsp;<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['language_info']; ?>
</td>
<td class="allAnalysisItem" width="80">Language</td>
<td class="allAnalysisRecords">&nbsp;<?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['language']):  echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['language_trans']; ?>
(<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['language']; ?>
)<?php endif; ?></td>

</tr>

<tr class="osAnalysis" height="15">
<td class="allAnalysisItem" width="80">ProxyFlag</td>
<td class="allAnalysisRecords">&nbsp;<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['via_proxy_flag']; ?>
</td>
<td class="allAnalysisItem" width="80">HTTP_via Info.</td>
<td class="allAnalysisRecords">&nbsp;<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['http_via_info']; ?>
</td>
</tr>


<tr class="osAnalysis" height="15">
<td class="allAnalysisItem" width="80">ScreenSize</td>
<td class="allAnalysisRecords" width="220">&nbsp;<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['screensize']; ?>
</td>
<td class="allAnalysisItem" width="80">Resolution</td>
<td class="allAnalysisRecords" width="220">&nbsp;<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['resolution']; ?>
</td>
</tr>

<tr class="osAnalysis" height="15">
<td class="allAnalysisItem" width="80">Access Time</td>
<td class="allAnalysisRecords">&nbsp;<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['regtime']; ?>
</td>
<td class="allAnalysisItem" width="80"></td>
<td class="allAnalysisRecords">&nbsp;</td>

</tr>



<tr class="osAnalysis" height="15">
<td class="allAnalysisItem" width="80">Referer</td>
<td class="allAnalysisRecords" colspan=3 style="word-wrap:break-word;word-break:break-all" width="505">&nbsp;<?php if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['referer'] != 'NO_REFERER_INFO'): ?><a href="<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['referer']; ?>
" target="_blank"><?php endif;  echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['referer_output_format'];  if ($this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['referer'] != 'NO_REFERER_INFO'): ?></a><?php endif; ?></td>
</tr>
<tr class="osAnalysis" height="15">
<td class="allAnalysisItem" width="80">Useragent</td>
<td class="allAnalysisRecords" colspan=3>&nbsp;<?php echo $this->_tpl_vars['analysis_info'][$this->_sections['report_view']['index']]['useragent']; ?>
</td>
</tr>
<?php if (! $this->_sections['report_view']['last']): ?>
<tr class="osAnalysis">
<td colspan=4 bgcolor="#000000"><img src="images/spacer.gif" width="1" height="1" /></td>
</tr>
<?php endif; ?>
<?php endfor; endif; ?>
</table>
<table width="613" align="center" border="0" cellspacing="0" cellpadding="0">
<tr class="analysisTableItems">
<td background="images/detail_info_top_left.gif" width="13"><img src="images/spacer.gif" width="13" height="17" /></td>
<td background="images/detail_info_top_center.gif" width="594"></td>
<td background="images/detail_info_top_right.gif" width="6"><img src="images/spacer.gif" width="6" height="17" /></td>
</tr>
</table>

<table width="613" align="center" border="0" cellspacing="0" cellpadding="0">
<tr >
<td class="analysisPagerPrev" width="13"></td>
<td class="analysisPagerNext" width="100"><?php if ($this->_tpl_vars['this_page'] != 1): ?><a href="?mode=<?php echo $this->_tpl_vars['common_page_view_info']['mode']; ?>
&p=1&id=<?php echo $this->_tpl_vars['aa_page']; ?>
&order=<?php echo $this->_tpl_vars['order_option']; ?>
&ot=<?php echo $this->_tpl_vars['order_type']; ?>
">First</a><?php endif; ?><img src="images/spacer.gif" width="1" height="1" /></td>
<td class="analysisPagerPrev" width="33"></td>
<td class="analysisPagerList" width="320">
<?php unset($this->_sections['page_view']);
$this->_sections['page_view']['name'] = 'page_view';
$this->_sections['page_view']['loop'] = is_array($_loop=$this->_tpl_vars['pager']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['page_view']['show'] = true;
$this->_sections['page_view']['max'] = $this->_sections['page_view']['loop'];
$this->_sections['page_view']['step'] = 1;
$this->_sections['page_view']['start'] = $this->_sections['page_view']['step'] > 0 ? 0 : $this->_sections['page_view']['loop']-1;
if ($this->_sections['page_view']['show']) {
    $this->_sections['page_view']['total'] = $this->_sections['page_view']['loop'];
    if ($this->_sections['page_view']['total'] == 0)
        $this->_sections['page_view']['show'] = false;
} else
    $this->_sections['page_view']['total'] = 0;
if ($this->_sections['page_view']['show']):

            for ($this->_sections['page_view']['index'] = $this->_sections['page_view']['start'], $this->_sections['page_view']['iteration'] = 1;
                 $this->_sections['page_view']['iteration'] <= $this->_sections['page_view']['total'];
                 $this->_sections['page_view']['index'] += $this->_sections['page_view']['step'], $this->_sections['page_view']['iteration']++):
$this->_sections['page_view']['rownum'] = $this->_sections['page_view']['iteration'];
$this->_sections['page_view']['index_prev'] = $this->_sections['page_view']['index'] - $this->_sections['page_view']['step'];
$this->_sections['page_view']['index_next'] = $this->_sections['page_view']['index'] + $this->_sections['page_view']['step'];
$this->_sections['page_view']['first']      = ($this->_sections['page_view']['iteration'] == 1);
$this->_sections['page_view']['last']       = ($this->_sections['page_view']['iteration'] == $this->_sections['page_view']['total']);
?>
<?php if (! $this->_tpl_vars['pager'][$this->_sections['page_view']['index']]['link_flag']): ?><a href="?mode=<?php echo $this->_tpl_vars['common_page_view_info']['mode']; ?>
&p=<?php echo $this->_tpl_vars['pager'][$this->_sections['page_view']['index']]['page']; ?>
&id=<?php echo $this->_tpl_vars['aa_page']; ?>
&order=<?php echo $this->_tpl_vars['order_option']; ?>
&ot=<?php echo $this->_tpl_vars['order_type']; ?>
&os=<?php echo $this->_tpl_vars['os_param']; ?>
">
<span class="analysisPagerList">
<?php else: ?><span class="analysisPagerThisPage">
<?php endif; ?>
<?php echo $this->_tpl_vars['pager'][$this->_sections['page_view']['index']]['page']; ?>

</span>
<?php if (! $this->_tpl_vars['pager'][$this->_sections['page_view']['index']]['link_flag']): ?></a><?php endif; ?>&nbsp;
<?php endfor; endif; ?>
</td>
<td class="analysisPagerNext" width="34"></td>
<td class="analysisPagerPrev" width="100"><img src="images/spacer.gif" width="1" height="1" /><?php if ($this->_tpl_vars['this_page'] != $this->_tpl_vars['pager_last']): ?><a href="?mode=<?php echo $this->_tpl_vars['common_page_view_info']['mode']; ?>
&p=<?php echo $this->_tpl_vars['pager_last']; ?>
&id=<?php echo $this->_tpl_vars['aa_page']; ?>
&order=<?php echo $this->_tpl_vars['order_option']; ?>
&ot=<?php echo $this->_tpl_vars['order_type']; ?>
">Last</a><?php endif; ?></td>
<td class="analysisPagerPrev" width="13"></td>
</tr>
</table>