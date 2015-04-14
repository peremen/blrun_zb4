  <table width="550" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableTopItemTitles" height="30">
      <td background="images/content_top_bar2_left.gif" width="13"><img src="images/spacer.gif" width="13" height="30" /></td>
      <td background="images/content_top_bar2_center.gif" width="120">{$items_titles.subject}</td>
      <td background="images/content_top_bar2_center.gif" width="70">{$items_titles.counts}</td>
      <td background="images/content_top_bar2_center.gif" width="5"><img src="images/spacer.gif" /></td>
      <td background="images/content_top_bar2_center.gif" width="283">&nbsp;</td>
      <td background="images/content_top_bar2_center.gif" width="9">&nbsp;</td>
      <td background="images/content_top_bar2_center.gif" width="55">{$items_titles.percentage}</td>
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
   {section name=report_view loop=$analysis_info}
      <tr height="45">
        <td>&nbsp;</td>
        <td class="analysisTableItemRecordYear">{if $analysis_info[report_view].link_flag == 1}<a href="?id={$aa_page}&mode=6&y={$analysis_info[report_view].year}&m={$analysis_info[report_view].month}">{/if}{$analysis_info[report_view].month}{if $analysis_info[report_view].link_flag == 1}</a>{/if}</td>
	<td class="analysisCounts">{$analysis_info[report_view].counts}&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td class="analysisGraph" width="5">{if $analysis_info[report_view].counts !=0}<img src="images/graph_red_left.gif" width="5" height="14">{/if}</td>
	<td class="analysisGraph">{if $analysis_info[report_view].counts !=0}<img src="images/graph_red_center.gif" width="{$analysis_info[report_view].graph_percentage}%" height="14" />{/if}{if $analysis_info[report_view].graph_percentage != 100}{if $analysis_info[report_view].counts !=0}<img src="images/graph_red_right.gif" height="14">{/if}{/if}</td>
	<td width="9">{if $analysis_info[report_view].graph_percentage == 100}<img src="images/graph_red_right.gif" height="14">{/if}</td>
	<td class="analysisPercentage">{$analysis_info[report_view].percentage} %&nbsp;</td>
	<td>&nbsp;</td>
      </tr>
       {/section}
  </table>
<table width="550" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableItems">
      <td background="images/detail_info_top_left.gif" width="13"><img src="images/spacer.gif" width="13" height="17" /></td>
      <td background="images/detail_info_top_center.gif" width="531"></td>
      <td background="images/detail_info_top_right.gif" width="6"><img src="images/spacer.gif" width="6" height="17" /></td>
    </tr>
</table>