<!--  내용 페이지 -->
{if $no_analysis_flag}
  <table width="550" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableTopItemTitles" height="30">
      <td background="images/content_top_bar2_left.gif" width="13"><img src="images/spacer.gif" width="13" height="30" /></td>
      <td background="images/content_top_bar2_center.gif" width="529">{$common_messages.no_record}</td>
      <td background="images/content_top_bar2_right.gif" width="8"><img src="images/spacer.gif" width="8" height="30" /></td>
    </tr>
  </table><br><br>
  <table width="550" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableTopItemTitles" height="30">
      <td  width="13"><img src="images/spacer.gif" width="13" height="30" /></td>
      <td class="words" width="529">{$words}</td>
      <td  width="8"><img src="images/spacer.gif" width="8" height="30" /></td>
    </tr>
  </table>
{else}
{if $common_page_view_info.mode_flag =="os"}
{include file="content_os.tpl"}
{elseif  $common_page_view_info.mode_flag =="browser"}
{include file="content_browser.tpl"}
{elseif  $common_page_view_info.mode_flag =="year"}
{include file="content_year.tpl"}
{elseif  $common_page_view_info.mode_flag =="month"}
{include file="content_month.tpl"}
{elseif  $common_page_view_info.mode_flag =="week"}
  <table width="550" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableTopItemTitles" height="30">
      <td background="images/content_top_bar2_left.gif" width="13"><img src="images/spacer.gif" width="13" height="30" /></td>
      <td background="images/content_top_bar2_center.gif" width="120">{$items_titles.subject}</td>
      <td background="images/content_top_bar2_center.gif" width="70">{$items_titles.counts}</td>
      <td background="images/content_top_bar2_center.gif" width="5"><img src="images/spacer.gif" /></td>
      <td background="images/content_top_bar2_center.gif" width="283">&nbsp;</td>
      <td background="images/content_top_bar2_center.gif" width="55">{$items_titles.percentage}</td>
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
   {section name=report_view loop=$analysis_info}
      <tr height="45">
        <td>&nbsp;</td>
        <td class="analysisTableItemRecordYear" >&nbsp;&nbsp;{$analysis_info[report_view].week}</td>
	<td class="analysisCounts" >{$analysis_info[report_view].counts}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td class="analysisGraph"  width="5">{if $analysis_info[report_view].counts !=0}<img src="images/graph_red_left.gif" width="5" height="14">{/if}</td>
	<td class="analysisGraph" >{if $analysis_info[report_view].counts !=0}<img src="images/graph_red_center.gif" width="{$analysis_info[report_view].graph_percentage}%" height="14" />{/if}{if $analysis_info[report_view].graph_percentage != 100}{if $analysis_info[report_view].counts !=0}<img src="images/graph_red_right.gif" height="14">{/if}{/if}</td>
	<td class="analysisPercentage" >{$analysis_info[report_view].percentage} %</td>
	<td>&nbsp;</td>
      </tr>
      {if !$smarty.section.report_view.last}
      <tr height="1">
      <td><img src="images/spacer.gif" /></td>
        <td colspan="5" style=" BORDER-BOTTOM: #d0d0d0 1px solid"><img src="images/spacer.gif" /></td>
	<td><img src="images/spacer.gif" /></td>
      </tr>

      {/if}
       {/section}
  </table>
<table width="550" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableItems">
      <td background="images/detail_info_top_left.gif" width="13"><img src="images/spacer.gif" width="13" height="17" /></td>
      <td background="images/detail_info_top_center.gif" width="531"></td>
      <td background="images/detail_info_top_right.gif" width="6"><img src="images/spacer.gif" width="6" height="17" /></td>
    </tr>
</table>
{elseif  $common_page_view_info.mode_flag =="day"}
<table width="613" align="center" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableTopItemTitles" height="30">
      <td background="images/content_top_bar2_left.gif" width="13"><img src="images/spacer.gif" width="13" height="30" /></td>
      <td background="images/content_top_bar2_center.gif" width="40">{$items_titles.subject}</td>
      <td background="images/content_top_bar2_center.gif" width="60">{$items_titles.counts}</td>
      <td background="images/content_top_bar2_center.gif" width="138">&nbsp;</td>
      <td background="images/content_top_bar2_center.gif" width="50">{$items_titles.percentage}</td>
      <td background="images/content_top_bar2_center.gif" width="16">&nbsp;</td>
      <td background="images/content_top_bar2_center.gif" width="40">{$items_titles.subject}</td>
      <td background="images/content_top_bar2_center.gif" width="60">{$items_titles.counts}</td>
      <td background="images/content_top_bar2_center.gif" width="138">&nbsp;</td>
      <td background="images/content_top_bar2_center.gif" width="50">{$items_titles.percentage}</td>
      <td background="images/content_top_bar2_right.gif" width="8"><img src="images/spacer.gif" width="8" height="30" /></td>
    </tr>
</table>
<table width="613" align="center" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="13">&nbsp;</td>
    <td class="valignTop" width="288">
      <table width="288" align="center" border="0" cellspacing="0" cellpadding="0">
        {section name=report_view loop=$analysis_info max="16"}
        <tr height="35">
          <td width="40" class="analysisTableItemRecordYear">{if $analysis_info[report_view].link_flag == 1}<a href="?id={$aa_page}&mode=7&y={$analysis_info[report_view].year}&m={$analysis_info[report_view].month}&d={$analysis_info[report_view].day}">{/if}{$analysis_info[report_view].day}{if $analysis_info[report_view].link_flag == 1}</a>{/if}</td>
          <td width="60" class="analysisCounts">{$analysis_info[report_view].counts}&nbsp;&nbsp;&nbsp;</td>
          <td width="5">{if $analysis_info[report_view].counts !=0}<img src="images/graph_red_left.gif" width="5" height="14">{else}<img src="images/spacer.gif" width="5" height="14">{/if}</td>
          <td width="124" >{if $analysis_info[report_view].counts !=0}<img src="images/graph_red_center.gif" width="{$analysis_info[report_view].graph_percentage}%" height="14" />{/if}{if $analysis_info[report_view].graph_percentage != 100}{if $analysis_info[report_view].counts !=0}<img src="images/graph_red_right.gif" height="14">{/if}{/if}</td>
          <td width="9">{if $analysis_info[report_view].graph_percentage == 100}<img src="images/graph_red_right.gif" height="14">{else}<img src="images/spacer.gif" width="9" height="14" />{/if}</td>
          <td width="50" class="analysisPercentage">{$analysis_info[report_view].percentage} %</td>
          </tr>
        {/section}
      </table>
    </td>
    <td width="10">&nbsp;</td>
    <td background="images/border.gif" width="2"><img src="images/spacer.gif" width="1"/></td>
    <td width="4">&nbsp;</td>
    <td class="valignTop" width="288">
      <table width="288" align="center" border="0" cellspacing="0" cellpadding="0">
        {section name=report_view loop=$analysis_info start="16"}
        <tr height="35">
          <td width="40" class="analysisTableItemRecordYear">{if $analysis_info[report_view].link_flag == 1}<a href="?id={$aa_page}&mode=7&y={$analysis_info[report_view].year}&m={$analysis_info[report_view].month}&d={$analysis_info[report_view].day}">{/if}{$analysis_info[report_view].day}{if $analysis_info[report_view].link_flag == 1}</a>{/if}</td>

          <td width="60" class="analysisCounts">{$analysis_info[report_view].counts}&nbsp;&nbsp;&nbsp;</td>
          <td width="5">{if $analysis_info[report_view].counts !=0}<img src="images/graph_red_left.gif" width="5" height="14">{else}<img src="images/spacer.gif" width="5" height="14">{/if}</td>
          <td width="124" >{if $analysis_info[report_view].counts !=0}<img src="images/graph_red_center.gif" width="{$analysis_info[report_view].graph_percentage}%" height="14" />{/if}{if $analysis_info[report_view].graph_percentage != 100}{if $analysis_info[report_view].counts !=0}<img src="images/graph_red_right.gif" height="14">{/if}{/if}</td>
          <td width="9">{if $analysis_info[report_view].graph_percentage == 100}<img src="images/graph_red_right.gif" height="14">{else}<img src="images/spacer.gif" width="9" height="14" />{/if}</td>
          <td width="50" class="analysisPercentage">{$analysis_info[report_view].percentage} %</td>
        </tr>
        {/section}
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
	<td class="analysisPagerList" width="320">{$before_next_link.before_year}{$before_next_link.before_month}</td>
	<td class="analysisPagerNext" width="34"></td>
	<td class="analysisPagerPrev" width="100"><img src="images/spacer.gif" width="1" height="1" /></td>
	<td class="analysisPagerPrev" width="13"></td>
    </tr>
</table>

{elseif  $common_page_view_info.mode_flag =="hour"}
<table width="613" align="center" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableTopItemTitles" height="30">
      <td background="images/content_top_bar2_left.gif" width="13"><img src="images/spacer.gif" width="13"/></td>
      <td background="images/content_top_bar2_center.gif" width="40">{$items_titles.subject}</td>
      <td background="images/content_top_bar2_center.gif" width="60">{$items_titles.counts}</td>
      <td background="images/content_top_bar2_center.gif" width="138">&nbsp;</td>
      <td background="images/content_top_bar2_center.gif" width="50">{$items_titles.percentage}</td>
      <td background="images/content_top_bar2_center.gif" width="16">&nbsp;</td>
      <td background="images/content_top_bar2_center.gif" width="40">{$items_titles.subject}</td>
      <td background="images/content_top_bar2_center.gif" width="60">{$items_titles.counts}</td>
      <td background="images/content_top_bar2_center.gif" width="138">&nbsp;</td>
      <td background="images/content_top_bar2_center.gif" width="50">{$items_titles.percentage}</td>
      <td background="images/content_top_bar2_right.gif" width="8"><img src="images/spacer.gif" width="8" height="30" /></td>
    </tr>
</table>
<table width="613" align="center" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="13">&nbsp;</td>
    <td width="288" class="valignTop">
      <table width="288" align="center" border="0" cellspacing="0" cellpadding="0">
        {section name=report_view loop=$analysis_info max="12"}
        <tr height="40">
          <td width="40" class="analysisTableItemRecordYear">&nbsp;&nbsp;{$analysis_info[report_view].hour}</td>
          <td width="248">
            <table width="248" align="center" border="0" cellspacing="0" cellpadding="0">
              <tr height="14" valign="top">
                <td width="60" class="analysisCounts">{$analysis_info[report_view].counts}&nbsp;&nbsp;</td>
                <td width="5">{if $analysis_info[report_view].counts !=0}<img src="images/graph_red_left.gif" width="5" height="14">{else}<img src="images/spacer.gif" width="5" height="14">{/if}</td>
                <td width="124" >{if $analysis_info[report_view].counts !=0}<img src="images/graph_red_center.gif" width="{$analysis_info[report_view].graph_percentage}%" height="14" />{/if}{if $analysis_info[report_view].graph_percentage != 100}{if $analysis_info[report_view].counts !=0}<img src="images/graph_red_right.gif" height="14">{/if}{/if}</td>
                <td width="9">{if $analysis_info[report_view].graph_percentage == 100}<img src="images/graph_red_right.gif" height="14">{else}<img src="images/spacer.gif" width="9" height="14" />{/if}</td>
                <td width="50" class="analysisPercentage">{$analysis_info[report_view].percentage} %</td>
              </tr>
              <tr height="14" valign="top">
                <td width="60" class="analysisCounts">{$analysis_info[report_view].before_counts}&nbsp;&nbsp;</td>
                <td width="5">{if $analysis_info[report_view].before_counts !=0}<img src="images/graph_yellow_left.gif" width="5" height="14">{/if}</td>
                <td width="124" >{if $analysis_info[report_view].before_counts !=0}<img src="images/graph_yellow_center.gif" width="{$analysis_info[report_view].before_graph_percentage}%" height="14" />{/if}{if $analysis_info[report_view].before_graph_percentage != 100}{if $analysis_info[report_view].before_counts !=0}<img src="images/graph_yellow_right.gif" height="14">{/if}{/if}</td>
                <td width="9">{if $analysis_info[report_view].before_graph_percentage == 100}<img src="images/graph_yellow_right.gif" height="14">{/if}</td>
                <td width="50" class="analysisPercentage">{$analysis_info[report_view].before_percentage} %</td>
              </tr>
            </table>
          </td>
        </tr>
        {/section}
      </table>
    </td>
    <td width="10">&nbsp;</td>
    <td background="images/border.gif" width="2"><img src="images/spacer.gif" width="1"/></td>
    <td width="4">&nbsp;</td>
    <td width="288" class="valignTop">
      <table width="288" align="center" border="0" cellspacing="0" cellpadding="0">
        {section name=report_view loop=$analysis_info start="12"}
        <tr height="40">
          <td width="40" class="analysisTableItemRecordYear">&nbsp;&nbsp;{$analysis_info[report_view].hour}</td>
          <td width="248">
            <table width="248" align="center" border="0" cellspacing="0" cellpadding="0">
              <tr height="14" valign="top">
                <td width="60" class="analysisCounts">{$analysis_info[report_view].counts}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td width="5">{if $analysis_info[report_view].counts !=0}<img src="images/graph_red_left.gif" width="5" height="14">{else}<img src="images/spacer.gif" width="5" height="14">{/if}</td>
                <td width="124" >{if $analysis_info[report_view].counts !=0}<img src="images/graph_red_center.gif" width="{$analysis_info[report_view].graph_percentage}%" height="14" />{/if}{if $analysis_info[report_view].graph_percentage != 100}{if $analysis_info[report_view].counts !=0}<img src="images/graph_red_right.gif" height="14">{/if}{/if}</td>
                <td width="9">{if $analysis_info[report_view].graph_percentage == 100}<img src="images/graph_red_right.gif" height="14">{else}<img src="images/spacer.gif" width="9" height="14" />{/if}</td>
                <td width="50" class="analysisPercentage">{$analysis_info[report_view].percentage} %</td>
              </tr>
              <tr height="14" valign="top">
                <td width="60" class="analysisCounts">{$analysis_info[report_view].before_counts}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td width="5">{if $analysis_info[report_view].before_counts !=0}<img src="images/graph_yellow_left.gif" width="5" height="14">{/if}</td>
                <td width="124" >{if $analysis_info[report_view].before_counts !=0}<img src="images/graph_yellow_center.gif" width="{$analysis_info[report_view].before_graph_percentage}%" height="14" />{/if}{if $analysis_info[report_view].before_graph_percentage != 100}{if $analysis_info[report_view].before_counts !=0}<img src="images/graph_yellow_right.gif" height="14">{/if}{/if}</td>
                <td width="9">{if $analysis_info[report_view].before_graph_percentage == 100}<img src="images/graph_yellow_right.gif" height="14">{/if}</td>
                <td width="50" class="analysisPercentage">{$analysis_info[report_view].before_percentage} %</td>
              </tr>
            </table>
          </td>
        </tr>
        {/section}
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

{elseif  $common_page_view_info.mode_flag =="language"}
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
      <tr height="30">
        <td>&nbsp;</td>
        <td class="analysisItem">&nbsp;&nbsp;&nbsp;{$analysis_info[report_view].language_trans}({$analysis_info[report_view].language})</td>
	<td class="analysisCounts">{$analysis_info[report_view].counts}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td class="analysisGraph" width="5">{if $analysis_info[report_view].counts !=0}<img src="images/graph_{$common_page_view_info.graph_color}_left.gif" width="5" height="14">{/if}</td>
	<td class="analysisGraph">{if $analysis_info[report_view].counts !=0}<img src="images/graph_{$common_page_view_info.graph_color}_center.gif" width="{$analysis_info[report_view].graph_percentage}%" height="14" />{/if}{if $analysis_info[report_view].graph_percentage != 100}{if $analysis_info[report_view].counts !=0}<img src="images/graph_{$common_page_view_info.graph_color}_right.gif" height="14">{/if}{/if}</td>
	<td width="9">{if $analysis_info[report_view].graph_percentage == 100}<img src="images/graph_{$common_page_view_info.graph_color}_right.gif" height="14">{/if}</td>
	<td class="analysisPercentage">{$analysis_info[report_view].percentage} %</td>
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
{elseif  $common_page_view_info.mode_flag =="nation"}
  <table width="550" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableTopItemTitles" height="30">
      <td background="images/content_top_bar2_left.gif" width="13"><img src="images/spacer.gif" width="13" height="30" /></td>
      <td background="images/content_top_bar2_center.gif" width="150">{$items_titles.subject}</td>
      <td background="images/content_top_bar2_center.gif" width="70">{$items_titles.counts}</td>
      <td background="images/content_top_bar2_center.gif" width="5"><img src="images/spacer.gif" /></td>
      <td background="images/content_top_bar2_center.gif" width="253">&nbsp;</td>
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
      <tr height="30">
        <td>&nbsp;</td>
        <td class="analysisItem">&nbsp;&nbsp;&nbsp;<img src="images/flags/{if $analysis_info[report_view].nation_code == null}aokio{else}{$analysis_info[report_view].nation_code}{/if}.gif" />&nbsp;{$analysis_info[report_view].nation_trans}</td>
	<td class="analysisCounts">{$analysis_info[report_view].counts}&nbsp;&nbsp;&nbsp;</td>
        <td class="analysisGraph" width="5">{if $analysis_info[report_view].counts !=0}<img src="images/graph_{$common_page_view_info.graph_color}_left.gif" width="5" height="14">{/if}</td>
	<td class="analysisGraph">{if $analysis_info[report_view].counts !=0}<img src="images/graph_{$common_page_view_info.graph_color}_center.gif" width="{$analysis_info[report_view].graph_percentage}%" height="14" />{/if}{if $analysis_info[report_view].graph_percentage != 100}{if $analysis_info[report_view].counts !=0}<img src="images/graph_{$common_page_view_info.graph_color}_right.gif" height="14">{/if}{/if}</td>
	<td width="9">{if $analysis_info[report_view].graph_percentage == 100}<img src="images/graph_{$common_page_view_info.graph_color}_right.gif" height="14">{/if}</td>
	<td class="analysisPercentage">{$analysis_info[report_view].percentage} %</td>
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

{elseif  $common_page_view_info.mode_flag =="referer"}
  <table width="613" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableTopItemTitles" height="30">
      <td background="images/content_top_bar2_left.gif" width="13"><img src="images/spacer.gif" width="13" height="30" /></td>
      <td background="images/content_top_bar2_center.gif" width="300">{$items_titles.subject}</td>
      <td background="images/content_top_bar2_center.gif" width="60">{$items_titles.counts}</td>
      <td background="images/content_top_bar2_center.gif" width="5"><img src="images/spacer.gif" /></td>
      <td background="images/content_top_bar2_center.gif" width="168">&nbsp;</td>
      <td background="images/content_top_bar2_center.gif" width="9">&nbsp;</td>
      <td background="images/content_top_bar2_center.gif" width="50">{$items_titles.percentage}</td>
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
      <tr height="35">
        <td>&nbsp;</td>
        <td class="analysisRefererItem">&nbsp;&nbsp;{if $analysis_info[report_view].link_flag}<a href="{$analysis_info[report_view].referer}" target="_blank" title="{$analysis_info[report_view].referer}">{$analysis_info[report_view].short_referer}</a>{else}{$analysis_info[report_view].short_referer}{/if}</td>
	<td class="analysisCounts">{$analysis_info[report_view].counts}&nbsp;&nbsp;</td>
        <td class="analysisGraph" width="5">{if $analysis_info[report_view].counts !=0}<img src="images/graph_{$common_page_view_info.graph_color}_left.gif" width="5" height="14">{/if}</td>
	<td class="analysisGraph">{if $analysis_info[report_view].counts !=0}<img src="images/graph_{$common_page_view_info.graph_color}_center.gif" width="{$analysis_info[report_view].graph_percentage}%" height="14" />{/if}{if $analysis_info[report_view].graph_percentage != 100}{if $analysis_info[report_view].counts !=0}<img src="images/graph_{$common_page_view_info.graph_color}_right.gif" height="14">{/if}{/if}</td>
	<td width="9">{if $analysis_info[report_view].graph_percentage == 100}<img src="images/graph_{$common_page_view_info.graph_color}_right.gif" height="14">{/if}</td>
	<td class="analysisPercentage">{$analysis_info[report_view].percentage} %</td>
	<td>&nbsp;</td>
      </tr>
       {/section}
  </table>
<table width="613" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableItems">
      <td background="images/detail_info_top_left.gif" width="13"><img src="images/spacer.gif" width="13" height="17" /></td>
      <td background="images/detail_info_top_center.gif" width="594"></td>
      <td background="images/detail_info_top_right.gif" width="6"><img src="images/spacer.gif" width="6" height="17" /></td>
    </tr>
</table>

{elseif  $common_page_view_info.mode_flag =="refererserver"}
  <table width="613" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableTopItemTitles" height="30">
      <td background="images/content_top_bar2_left.gif" width="13"><img src="images/spacer.gif" width="13" height="30" /></td>
      <td background="images/content_top_bar2_center.gif" width="250">{$items_titles.subject}</td>
      <td background="images/content_top_bar2_center.gif" width="60">{$items_titles.counts}</td>
      <td background="images/content_top_bar2_center.gif" width="5"><img src="images/spacer.gif" /></td>
      <td background="images/content_top_bar2_center.gif" width="218">&nbsp;</td>
      <td background="images/content_top_bar2_center.gif" width="9">&nbsp;</td>
      <td background="images/content_top_bar2_center.gif" width="50">{$items_titles.percentage}</td>
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
      <tr height="35">
        <td>&nbsp;</td>
        <td class="analysisItem">&nbsp;&nbsp;<a href="{$analysis_info[report_view].refererserver}" target="_blank">{$analysis_info[report_view].refererserver}</a></td>
	<td class="analysisCounts">{$analysis_info[report_view].counts}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td class="analysisGraph" width="5">{if $analysis_info[report_view].counts !=0}<img src="images/graph_{$common_page_view_info.graph_color}_left.gif" width="5" height="14">{/if}</td>
	<td class="analysisGraph">{if $analysis_info[report_view].counts !=0}<img src="images/graph_{$common_page_view_info.graph_color}_center.gif" width="{$analysis_info[report_view].graph_percentage}%" height="14" />{/if}{if $analysis_info[report_view].graph_percentage != 100}{if $analysis_info[report_view].counts !=0}<img src="images/graph_{$common_page_view_info.graph_color}_right.gif" height="14">{/if}{/if}</td>
	<td width="9">{if $analysis_info[report_view].graph_percentage == 100}<img src="images/graph_{$common_page_view_info.graph_color}_right.gif" height="14">{/if}</td>
	<td class="analysisPercentage">{$analysis_info[report_view].percentage} %</td>
	<td>&nbsp;</td>
      </tr>
       {/section}
  </table>
<table width="613" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableItems">
      <td background="images/detail_info_top_left.gif" width="13"><img src="images/spacer.gif" width="13" height="17" /></td>
      <td background="images/detail_info_top_center.gif" width="594"></td>
      <td background="images/detail_info_top_right.gif" width="6"><img src="images/spacer.gif" width="6" height="17" /></td>
    </tr>
</table>
{elseif  $common_page_view_info.mode_flag =="screensize"}
  <table width="550" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableTopItemTitles" height="30">
      <td background="images/content_top_bar2_left.gif" width="13"><img src="images/spacer.gif" width="13" height="30" /></td>
      <td background="images/content_top_bar2_center.gif" width="130">{$items_titles.subject}</td>
      <td background="images/content_top_bar2_center.gif" width="70">{$items_titles.counts}</td>
      <td background="images/content_top_bar2_center.gif" width="5"><img src="images/spacer.gif" /></td>
      <td background="images/content_top_bar2_center.gif" width="273">&nbsp;</td>
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
        <td class="analysisItem">&nbsp;&nbsp;&nbsp;&nbsp;{$analysis_info[report_view].screensize}</td>
	<td class="analysisCounts">{$analysis_info[report_view].counts}&nbsp;&nbsp;&nbsp;</td>
        <td class="analysisGraph" width="5">{if $analysis_info[report_view].counts !=0}<img src="images/graph_{$common_page_view_info.graph_color}_left.gif" width="5" height="14">{/if}</td>
	<td class="analysisGraph">{if $analysis_info[report_view].counts !=0}<img src="images/graph_{$common_page_view_info.graph_color}_center.gif" width="{$analysis_info[report_view].graph_percentage}%" height="14" />{/if}{if $analysis_info[report_view].graph_percentage != 100}{if $analysis_info[report_view].counts !=0}<img src="images/graph_{$common_page_view_info.graph_color}_right.gif" height="14">{/if}{/if}</td>
	<td width="9">{if $analysis_info[report_view].graph_percentage == 100}<img src="images/graph_{$common_page_view_info.graph_color}_right.gif" height="14">{/if}</td>
	<td class="analysisPercentage">{$analysis_info[report_view].percentage} %</td>
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
{elseif  $common_page_view_info.mode_flag =="resolution"}
  <table width="550" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableTopItemTitles" height="30">
      <td background="images/content_top_bar2_left.gif" width="13"><img src="images/spacer.gif" width="13" height="30" /></td>
      <td background="images/content_top_bar2_center.gif" width="220">{$items_titles.subject}</td>
      <td background="images/content_top_bar2_center.gif" width="70">{$items_titles.counts}</td>
      <td background="images/content_top_bar2_center.gif" width="5"><img src="images/spacer.gif" /></td>
      <td background="images/content_top_bar2_center.gif" width="183">&nbsp;</td>
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
        <td class="analysisItem">&nbsp;&nbsp;{$analysis_info[report_view].resolution} Colors({$analysis_info[report_view].bit}bit)</td>
	<td class="analysisCounts">{$analysis_info[report_view].counts}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td class="analysisGraph" width="5">{if $analysis_info[report_view].counts !=0}<img src="images/graph_{$common_page_view_info.graph_color}_left.gif" width="5" height="14">{/if}</td>
	<td class="analysisGraph">{if $analysis_info[report_view].counts !=0}<img src="images/graph_{$common_page_view_info.graph_color}_center.gif" width="{$analysis_info[report_view].graph_percentage}%" height="14" />{/if}{if $analysis_info[report_view].graph_percentage != 100}{if $analysis_info[report_view].counts !=0}<img src="images/graph_{$common_page_view_info.graph_color}_right.gif" height="14">{/if}{/if}</td>
	<td width="9">{if $analysis_info[report_view].graph_percentage == 100}<img src="images/graph_{$common_page_view_info.graph_color}_right.gif" height="14">{/if}</td>
	<td class="analysisPercentage">{$analysis_info[report_view].percentage} %</td>
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

{elseif  $common_page_view_info.mode_flag =="searchkeyword"}
  <table width="550" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableTopItemTitles" height="30">
      <td background="images/content_top_bar2_left.gif" width="13"><img src="images/spacer.gif" width="13" height="30" /></td>
      <td background="images/content_top_bar2_center.gif" width="220">{$items_titles.subject}</td>
      <td background="images/content_top_bar2_center.gif" width="70">{$items_titles.counts}</td>
      <td background="images/content_top_bar2_center.gif" width="5"><img src="images/spacer.gif" /></td>
      <td background="images/content_top_bar2_center.gif" width="183">&nbsp;</td>
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
        <td class="analysisItem">&nbsp;&nbsp;{$analysis_info[report_view].keyword}</td>
	<td class="analysisCounts">{$analysis_info[report_view].counts}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td class="analysisGraph" width="5">{if $analysis_info[report_view].counts !=0}<img src="images/graph_{$common_page_view_info.graph_color}_left.gif" width="5" height="14">{/if}</td>
	<td class="analysisGraph">{if $analysis_info[report_view].counts !=0}<img src="images/graph_{$common_page_view_info.graph_color}_center.gif" width="{$analysis_info[report_view].graph_percentage}%" height="14" />{/if}{if $analysis_info[report_view].graph_percentage != 100}{if $analysis_info[report_view].counts !=0}<img src="images/graph_{$common_page_view_info.graph_color}_right.gif" height="14">{/if}{/if}</td>
	<td width="9">{if $analysis_info[report_view].graph_percentage == 100}<img src="images/graph_{$common_page_view_info.graph_color}_right.gif" height="14">{/if}</td>
	<td class="analysisPercentage">{$analysis_info[report_view].percentage} %</td>
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


{elseif  $common_page_view_info.mode_flag =="searchsite"}
  <table width="550" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableTopItemTitles" height="30">
      <td background="images/content_top_bar2_left.gif" width="13"><img src="images/spacer.gif" width="13" height="30" /></td>
      <td background="images/content_top_bar2_center.gif" width="220">{$items_titles.subject}</td>
      <td background="images/content_top_bar2_center.gif" width="70">{$items_titles.counts}</td>
      <td background="images/content_top_bar2_center.gif" width="5"><img src="images/spacer.gif" /></td>
      <td background="images/content_top_bar2_center.gif" width="183">&nbsp;</td>
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
        <td class="analysisItem">&nbsp;&nbsp;{$analysis_info[report_view].searchsite} </td>
	<td class="analysisCounts">{$analysis_info[report_view].counts}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td class="analysisGraph" width="5">{if $analysis_info[report_view].counts !=0}<img src="images/graph_{$common_page_view_info.graph_color}_left.gif" width="5" height="14">{/if}</td>
	<td class="analysisGraph">{if $analysis_info[report_view].counts !=0}<img src="images/graph_{$common_page_view_info.graph_color}_center.gif" width="{$analysis_info[report_view].graph_percentage}%" height="14" />{/if}{if $analysis_info[report_view].graph_percentage != 100}{if $analysis_info[report_view].counts !=0}<img src="images/graph_{$common_page_view_info.graph_color}_right.gif" height="14">{/if}{/if}</td>
	<td width="9">{if $analysis_info[report_view].graph_percentage == 100}<img src="images/graph_{$common_page_view_info.graph_color}_right.gif" height="14">{/if}</td>
	<td class="analysisPercentage">{$analysis_info[report_view].percentage} %</td>
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


{elseif  $common_page_view_info.mode_flag =="search_robot"}
  <table width="613" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableTopItemTitles" height="30">
      <td background="images/content_top_bar2_left.gif" width="13"><img src="images/spacer.gif" width="13" height="30" /></td>
      <td background="images/content_top_bar2_center.gif" width="300">{$items_titles.subject}</td>
      <td background="images/content_top_bar2_center.gif" width="60">{$items_titles.counts}</td>
      <td background="images/content_top_bar2_center.gif" width="5"><img src="images/spacer.gif" /></td>
      <td background="images/content_top_bar2_center.gif" width="168">&nbsp;</td>
      <td background="images/content_top_bar2_center.gif" width="9">&nbsp;</td>
      <td background="images/content_top_bar2_center.gif" width="50">{$items_titles.percentage}</td>
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
      <tr height="35">
        <td>&nbsp;</td>
        <td class="analysisItem">&nbsp;&nbsp;{$analysis_info[report_view].bot.name} {$analysis_info[report_view].bot.version} {if $analysis_info[report_view].bot.bot_url}<a href="{$analysis_info[report_view].bot.bot_url}" target="_blank">Bot Information URL</a>{/if}</td>
	<td class="analysisCounts">{$analysis_info[report_view].counts}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td class="analysisGraph" width="5">{if $analysis_info[report_view].counts !=0}<img src="images/graph_{$common_page_view_info.graph_color}_left.gif" width="5" height="14">{/if}</td>
	<td class="analysisGraph">{if $analysis_info[report_view].counts !=0}<img src="images/graph_{$common_page_view_info.graph_color}_center.gif" width="{$analysis_info[report_view].graph_percentage}%" height="14" />{/if}{if $analysis_info[report_view].graph_percentage != 100}{if $analysis_info[report_view].counts !=0}<img src="images/graph_{$common_page_view_info.graph_color}_right.gif" height="14">{/if}{/if}</td>
	<td width="9">{if $analysis_info[report_view].graph_percentage == 100}<img src="images/graph_{$common_page_view_info.graph_color}_right.gif" height="14">{/if}</td>
	<td class="analysisPercentage">{$analysis_info[report_view].percentage} %</td>
	<td>&nbsp;</td>
      </tr>
       {/section}
  </table>
<table width="613" border="0" cellspacing="0" cellpadding="0">
    <tr class="analysisTableItems">
      <td background="images/detail_info_top_left.gif" width="13"><img src="images/spacer.gif" width="13" height="17" /></td>
      <td background="images/detail_info_top_center.gif" width="594"></td>
      <td background="images/detail_info_top_right.gif" width="6"><img src="images/spacer.gif" width="6" height="17" /></td>
    </tr>
</table>
{elseif  $common_page_view_info.mode_flag =="search_robot_detail"}
{include file="content_search_robot_detail.tpl"}
{elseif  $common_page_view_info.mode_flag =="all_info"}
{include file="content_all_info.tpl"}
{/if}

{/if}