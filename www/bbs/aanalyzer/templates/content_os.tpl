<table width="550" border="0" cellspacing="0" cellpadding="0">
  <tr class="analysisTableTopItemTitles" height="30">
    <td background="images/content_top_bar2_left.gif" width="13"><img src="images/spacer.gif" width="13" height="30" /></td>
    <td background="images/content_top_bar2_center.gif" width="200">{$items_titles.subject}</td>
    <td background="images/content_top_bar2_center.gif" width="70">{$items_titles.counts}</td>
    <td background="images/content_top_bar2_center.gif" width="5"><img src="images/spacer.gif" /></td>
    <td background="images/content_top_bar2_center.gif" width="193">&nbsp;</td>
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
      <td class="analysisItem">&nbsp;&nbsp;{$analysis_info[report_view].os_full_name}</td>
      <td class="analysisCounts">{$analysis_info[report_view].counts}&nbsp;&nbsp;&nbsp;&nbsp;</td>
      <td class="analysisGraph" width="5"><img src="images/graph_{$common_page_view_info.graph_color}_left.gif" width="5" height="14"></td>
      <td class="analysisGraph"><img src="images/graph_{$common_page_view_info.graph_color}_center.gif" width="{$analysis_info[report_view].graph_percentage}%" height="14" />{if $analysis_info[report_view].graph_percentage != 100}<img src="images/graph_{$common_page_view_info.graph_color}_right.gif" height="14">{/if}</td>
      <td width="9">{if $analysis_info[report_view].graph_percentage == 100}<img src="images/graph_{$common_page_view_info.graph_color}_right.gif" height="14">{/if}</td>
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

<table width="550" border="0" cellspacing="0" cellpadding="0">
  <tr height="10">
    <td colspan="2">&nbsp;
    </td></tr>
  <tr class="analysisTableItems">
    <td width="225" valign="top" >
<div class="analysisHangulItem"><a href="{$analysis_view_file_name}?mode=1&id={$aa_page}&vo=fn" >{$items_titles.full_name_analysis}</a></div>
<div class="analysisHangulItem"><a href="{$analysis_view_file_name}?mode=1&id={$aa_page}&vo=ca" >{$items_titles.category_analysis}</a>
</div>
<div ><!--<a href="{$analysis_view_file_name}?mode=1&id={$aa_page}&vo=bo" >both</a><br>--></div>
<div ></div>

    </td>
    <td width="225">
    <table width="100%" border="0" cellspacing="0" cellpadding="0"class=" analysisRefererItem" >
    <tr >
    <td width="60">Total</td><td>: {$bottom_misc_counts.total}</td></tr>
    <td >OS Counts</td><td>: {$bottom_misc_counts.items_counts}</td></tr>
    <td >Average</td><td>: {$bottom_misc_counts.average}</td></tr>
    <td >Max</td><td>: {$bottom_misc_counts.max}</td></tr>
    <td >Min</td><td>: {$bottom_misc_counts.min}</td></tr>
</table>
    </td>
  </tr>
</table>
