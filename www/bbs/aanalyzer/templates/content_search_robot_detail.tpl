
<table width="613" align="center" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableItems">
      <td background="images/detail_info_top_left.gif" width="13"><img src="images/spacer.gif" width="13" height="17" /></td>
      <td background="images/detail_info_top_center.gif" width="594"></td>
      <td background="images/detail_info_top_right.gif" width="6"><img src="images/spacer.gif" width="6" height="17" /></td>
    </tr>
</table>

<table width="600" align="center" border="0" cellspacing="1" cellpadding="0">
{section name=report_view loop=$analysis_info}
<tr class="osAnalysis" height="15">
<td class="allAnalysisItem" width="80">NO.</td>
<td class="allAnalysisRecords" width="220">&nbsp;{$analysis_info[report_view].no}</td>
<td class="allAnalysisItem" width="80"></td>
<td class="allAnalysisRecords" width="220">&nbsp;</td>
</tr>
<tr class="osAnalysis" height="15">
<td class="allAnalysisItem" width="80">IP</td>
<td class="allAnalysisRecords" width="220">&nbsp;<a href="http://www.rleeden.no-ip.com/geotool.php?ip={$analysis_info[report_view].ip}" target="_blank">{$analysis_info[report_view].ip}</a></td>
<td class="allAnalysisItem" width="80">Nation</td>
<td class="allAnalysisRecords" width="220">&nbsp;<img src="images/flags/{if $analysis_info[report_view].nation_code == null}aokio{else}{$analysis_info[report_view].nation_code}{/if}.gif" />&nbsp;<a href="http://en.wikipedia.org/wiki/{$analysis_info[report_view].nation}" target="_blank">{$analysis_info[report_view].nation_trans}</td>
</tr>
<tr class="osAnalysis" height="15">		
<td class="allAnalysisItem" width="80">Access Time</td>
<td class="allAnalysisRecords" width="220">&nbsp;{$analysis_info[report_view].regtime}</td>
<td width="80"></td>
<td class="allAnalysisRecords" width="220">&nbsp;</td>
</tr>
<tr class="osAnalysis" height="15">
<td class="allAnalysisItem" width="80">Referer</td>
<td class="allAnalysisRecords" colspan=3>&nbsp;{$analysis_info[report_view].referer}</td>
</tr>
<tr class="osAnalysis" height="15">
<td class="allAnalysisItem" width="80">Useragent</td>
<td class="allAnalysisRecords" colspan=3>&nbsp;{$analysis_info[report_view].useragent}</td>
</tr>
{if !$smarty.section.report_view.last}
<tr class="osAnalysis">
<td colspan=4 bgcolor="#000000"><img src="images/spacer.gif" width="1" height="1" /></td>
</tr>
{/if}
{/section}
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
	<td class="analysisPagerNext" width="100">{if $this_page != 1}<a href="?mode={$common_page_view_info.mode}&rp=1&id={$aa_page}">First</a>{/if}</td>
	<td class="analysisPagerPrev" width="33"></td>
	<td class="analysisPagerList" width="310">
	{section name=page_view loop=$pager}
	{if !$pager[page_view].link_flag}<a href="?mode={$common_page_view_info.mode}&rp={$pager[page_view].page}&id={$aa_page}">
	<span class="analysisPagerList">
	{else}<span class="analysisPagerThisPage">
	{/if}
	{$pager[page_view].page}
	</span>
	{if !$pager[page_view].link_flag}</a>{/if}&nbsp;
	{/section}
	</td>
	<td class="analysisPagerNext" width="34"></td>
	<td class="analysisPagerPrev" width="100">{if $this_page != $pager_last}<a href="?mode={$common_page_view_info.mode}&rp={$pager_last}&id={$aa_page}">Last</a>{/if}</td>
	<td class="analysisPagerPrev" width="13"></td>
    </tr>
</table>