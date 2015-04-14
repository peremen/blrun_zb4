<!---                   ---->
<!--- Top    Template   ---->
<!---                   ---->
<table width="800" align="center" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>

<table width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="5"><img src="images/top_left.gif" width="5" height="4" /></td>
    <td background="images/top_center.gif"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td width="4"><img src="images/top_right.gif" width="4" height="4" /></td>
  </tr>
</table>
<table width="800" border="0" cellpadding="0" cellspacing="0" class="mainTable">
  <tr height="10">
    <td background="images/border.gif"><span class="style1"></span></td>
    <td><span class="style1"></span></td>
    <td><span class="style1"></span></td>
    <td><span class="style1"></span></td>
    <td background="images/border.gif"><span class="style1"></span></td>
  </tr>
  <tr>
    <td background="images/border.gif" width="1"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td width="12"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td><img src="images/logo.jpg" width="415" height="54" /></td>
    <td>
    <table width="371" border="0" cellpadding="0" cellspacing="0">
       <tr >
         <td class="topRecordItems" width="371">
		<table width="371" border="0" cellpadding="0" cellspacing="2">
	       <tr >
		   <td width="120"> 
				<table width="120" border="0" cellpadding="0" cellspacing="2">
				   <tr >
				 <td class="topRecordItems" width="30">Page  </td>
				 <td class="topRecordItems" width="3">:</td>
				 <td class="topRecordCounts" width="67">&nbsp;{$conf_info.target}</td>
				 <td class="topRecordCounts" width="10"></td>
				 </tr>
				   <tr >
				 <td class="topRecordItems">Total  </td>
				 <td class="topRecordItems">:</td>
				 <td class="topRecordCounts">&nbsp;{$conf_info.total}</td>
				 <td class="topRecordCounts"></td>
				 </tr>
				   <tr >
				 <td class="topRecordItems">Today  </td>
				 <td class="topRecordItems">:</td>
				 <td class="topRecordCounts">&nbsp;{$conf_info.today}</td>
				 <td class="topRecordCounts"></td>
				 </tr>
				   <tr >
				 <td class="topRecordItems">Max  </td>
				 <td class="topRecordItems">:</td>
				 <td class="topRecordCounts">&nbsp;{$conf_info.max}</td>
				 <td class="topRecordCounts"></td>
				 </tr>
				</table>
				</td>
				<td valign="bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>&nbsp;</td>
                    <td width="22">&nbsp;</td>
                    <td width="2">&nbsp;</td>
                    <td width="22">&nbsp;</td>
                    <td width="2">&nbsp;</td>
                    <td width="22">&nbsp;</td>
                    <td width="10">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td width="22">&nbsp;</td>
                    <td width="2">&nbsp;</td>
                    <td width="22"><a href="manager.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image12','','images/manager_button_02.gif',1)"><img src="images/manager_button_01.gif" name="Image12" width="22" height="22" border="0" id="Image12" /></a></td>
                    <td width="2">&nbsp;</td>
                    <td width="22"><a href="logout.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image14','','images/logout_button_02.gif',1)"><img src="images/logout_button_01.gif" name="Image14" width="22" height="22" border="0" id="Image14" /></a></td>
                    <td width="10">&nbsp;</td>
                  </tr>
                </table>				</td>
			  </tr>
			</table>
	</td>
	</tr>
    </table>
    </td>
    <td background="images/border.gif" width="1"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
</table>
<table width="800" border="0" cellspacing="0" cellpadding="0" class="titleTable">
  <tr height="35">
    <td background="images/border.gif" width="1"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td width="12"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td>AokioAnalyzer : {$common_page_view_info.page_name}
    
    {if  $mode_flag =="month"}>>
    {$this_year}
    {elseif  $mode_flag =="day"}>>
    {$this_year}.{$this_month}
    {elseif  $mode_flag =="hour"}>>
    {$this_year}.{$this_month}.{$this_day}
    {/if}
    </td>
    <td><img src="images/spacer.gif" width="1" height="1" /></td>
    <td background="images/border.gif" width="1"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
</table>
<!---                   ---->
<!--- Top    Template   ---->
<!---                   ---->