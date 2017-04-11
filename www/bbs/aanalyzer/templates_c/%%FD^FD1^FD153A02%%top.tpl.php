<?php /* Smarty version 2.6.13, created on 2015-04-04 13:25:29
         compiled from top.tpl */ ?>
<!---                   ---->
<!-- 탑 -->
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
    <td background="images/border.gif"></td>
    <td></td>
    <td></td>
    <td></td>
    <td background="images/border.gif"></td>
  </tr>
  <tr>
    <td background="images/border.gif" width="1"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td width="12"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td><a href=manager.php><img src="images/logo.jpg" width="415" border=0 height="54" /></a></td>
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
				 <td class="topRecordCounts" width="67">&nbsp;<?php echo $this->_tpl_vars['analysis_page']; ?>
</td>
				 <td class="topRecordCounts" width="10"></td>
				 </tr>
				   <tr >
				 <td class="topRecordItems">Total  </td>
				 <td class="topRecordItems">:</td>
				 <td class="topRecordCounts">&nbsp;<?php echo $this->_tpl_vars['common_page_view_info']['total']; ?>
</td>
				 <td class="topRecordCounts"></td>
				 </tr>
				   <tr >
				 <td class="topRecordItems">Today  </td>
				 <td class="topRecordItems">:</td>
				 <td class="topRecordCounts">&nbsp;<?php echo $this->_tpl_vars['common_page_view_info']['today']; ?>
</td>
				 <td class="topRecordCounts"></td>
				 </tr>
				   <tr >
				 <td class="topRecordItems">Max  </td>
				 <td class="topRecordItems">:</td>
				 <td class="topRecordCounts">&nbsp;<?php echo $this->_tpl_vars['common_page_view_info']['max']; ?>
</td>
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
                    <td width="22"><a href="aokio_config.php?id=<?php echo $this->_tpl_vars['aa_page']; ?>
"  onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image13','','images/config_button_02.gif',1)"><img src="images/config_button_01.gif" name="Image13" width="22" height="22" border="0" id="Image13" title="Configuration"/></a></td>
                    <td width="2">&nbsp;</td>
                    <td width="22"><a href="manager.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image12','','images/manager_button_02.gif',1)"><img src="images/manager_button_01.gif" name="Image12" width="22" height="22" border="0" id="Image12" title="Manager"/></a></td>
                    <td width="2">&nbsp;</td>
                    <td width="22"><a href="logout.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image14','','images/logout_button_02.gif',1)"><img src="images/logout_button_01.gif" name="Image14" width="22" height="22" border="0" id="Image14" title="Logout" alt"Logout"/></a></td>
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
    <td width="110" class="topApplicationName"><?php echo $this->_tpl_vars['application_name']; ?>
 : </td>
    <td class="topTargetName"><?php echo $this->_tpl_vars['common_page_view_info']['page_name']; ?>

    <?php if ($this->_tpl_vars['mode_flag'] == 'month'): ?>>>
    <?php echo $this->_tpl_vars['this_year']; ?>

    <?php elseif ($this->_tpl_vars['mode_flag'] == 'day'): ?>>>
    <?php echo $this->_tpl_vars['this_year']; ?>
.<?php echo $this->_tpl_vars['this_month']; ?>

    <?php elseif ($this->_tpl_vars['mode_flag'] == 'hour'): ?>>>
    <?php echo $this->_tpl_vars['this_year']; ?>
.<?php echo $this->_tpl_vars['this_month']; ?>
.<?php echo $this->_tpl_vars['this_day']; ?>

    <?php endif; ?><img src="images/spacer.gif" width="1" height="1" />
    </td>
    <td class="topTodayInfo" width="100">Today is <?php echo $this->_tpl_vars['today_info']['year']; ?>
.<?php echo $this->_tpl_vars['today_info']['month']; ?>
.<?php echo $this->_tpl_vars['today_info']['day']; ?>
&nbsp;&nbsp;&nbsp;</td>
    <td background="images/border.gif" width="1"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
</table>
<!---                   ---->
<!--- Top    Template   ---->
<!---                   ---->