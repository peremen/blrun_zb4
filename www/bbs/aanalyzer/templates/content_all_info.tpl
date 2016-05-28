
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
<td class="allAnalysisRecords" width="220">&nbsp;&nbsp;{$analysis_info[report_view].no}</td>
<td class="allAnalysisItem" width="80">Visit Counts</td>
<td class="allAnalysisRecords" width="220">&nbsp;{$analysis_info[report_view].visit_count}</td>
</tr>

<tr class="osAnalysis" height="15">
<td class="allAnalysisItem" width="80">OS</td>
<td class="allAnalysisRecords" colspan="3">&nbsp;
{$analysis_info[report_view].os_full_name}
{if $analysis_info[report_view].os_sp_info}{$analysis_info[report_view].os_sp_info}&nbsp;&nbsp; 
{/if}
{if $analysis_info[report_view].os_net_frame}{$analysis_info[report_view].os_net_frame}&nbsp;&nbsp; 
{/if}
</td>
</tr>


<tr class="osAnalysis" height="15">
<td class="allAnalysisItem" width="80">Browser</td>
<td class="allAnalysisRecords" colspan="3" >&nbsp; {$analysis_info[report_view].browser_version}
{if $analysis_info[report_view].browser_build_date}BuildDate:{$analysis_info[report_view].browser_build_date}&nbsp;&nbsp; 
{/if}
{if $analysis_info[report_view].browser_security}Security:{$analysis_info[report_view].browser_security}&nbsp;&nbsp; 
{/if}
</td>
</tr>


<tr class="osAnalysis" height="15">
<td class="allAnalysisItem" width="80">IP</td>
<td class="allAnalysisRecords">&nbsp;{$analysis_info[report_view].ip}</td>
<td class="allAnalysisItem" width="80">Nation</td>
<td class="allAnalysisRecords">&nbsp;<img src="images/flags/{if $analysis_info[report_view].nation_code == null}aokio{else}{$analysis_info[report_view].nation_code}{/if}.gif" />&nbsp;<a href="http://en.wikipedia.org/wiki/{$analysis_info[report_view].nation}" target="_blank">{$analysis_info[report_view].nation_trans}</td>
</tr>

<tr class="osAnalysis" height="15">
<td class="allAnalysisItem" width="80">Lang.Info</td>
<td class="allAnalysisRecords" width="220">&nbsp;{$analysis_info[report_view].language_info}</td>
<td class="allAnalysisItem" width="80">Language</td>
<td class="allAnalysisRecords">&nbsp;{if $analysis_info[report_view].language}{$analysis_info[report_view].language_trans}({$analysis_info[report_view].language}){/if}</td>

</tr>

<tr class="osAnalysis" height="15">
<td class="allAnalysisItem" width="80">ProxyFlag</td>
<td class="allAnalysisRecords">&nbsp;{$analysis_info[report_view].via_proxy_flag}</td>
<td class="allAnalysisItem" width="80">HTTP_via Info.</td>
<td class="allAnalysisRecords">&nbsp;{$analysis_info[report_view].http_via_info}</td>
</tr>


<tr class="osAnalysis" height="15">
<td class="allAnalysisItem" width="80">ScreenSize</td>
<td class="allAnalysisRecords" width="220">&nbsp;{$analysis_info[report_view].screensize}</td>
<td class="allAnalysisItem" width="80">Resolution</td>
<td class="allAnalysisRecords" width="220">&nbsp;{$analysis_info[report_view].resolution}</td>
</tr>

<tr class="osAnalysis" height="15">		
<td class="allAnalysisItem" width="80">Access Time</td>
<td class="allAnalysisRecords">&nbsp;{$analysis_info[report_view].regtime}</td>
<td class="allAnalysisItem" width="80"></td>
<td class="allAnalysisRecords">&nbsp;</td>

</tr>



<tr class="osAnalysis" height="15">
<td class="allAnalysisItem" width="80">Referer</td>
<td class="allAnalysisRecords" colspan=3 style="word-wrap:break-word;word-break:break-all" width="505">&nbsp;{if $analysis_info[report_view].referer !='NO_REFERER_INFO'}<a href="{$analysis_info[report_view].referer}" target="_blank">{/if}{$analysis_info[report_view].referer_output_format}{if $analysis_info[report_view].referer !='NO_REFERER_INFO'}</a>{/if}</td>
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
<td class="analysisPagerNext" width="100">{if $this_page != 1}<a href="?mode={$common_page_view_info.mode}&p=1&id={$aa_page}&order={$order_option}&ot={$order_type}">First</a>{/if}<img src="images/spacer.gif" width="1" height="1" /></td>
<td class="analysisPagerPrev" width="33"></td>
<td class="analysisPagerList" width="320">
{section name=page_view loop=$pager}
{if !$pager[page_view].link_flag}<a href="?mode={$common_page_view_info.mode}&p={$pager[page_view].page}&id={$aa_page}&order={$order_option}&ot={$order_type}&os={$os_param}">
<span class="analysisPagerList">
{else}<span class="analysisPagerThisPage">
{/if}
{$pager[page_view].page}
</span>
{if !$pager[page_view].link_flag}</a>{/if}&nbsp;
{/section}
</td>
<td class="analysisPagerNext" width="34"></td>
<td class="analysisPagerPrev" width="100"><img src="images/spacer.gif" width="1" height="1" />{if $this_page != $pager_last}<a href="?mode={$common_page_view_info.mode}&p={$pager_last}&id={$aa_page}&order={$order_option}&ot={$order_type}">Last</a>{/if}</td>
<td class="analysisPagerPrev" width="13"></td>
</tr>
</table>