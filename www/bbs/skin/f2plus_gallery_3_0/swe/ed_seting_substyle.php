
<!--====================[ sw_edit 파일명: ed_seting_substyle.php ]====================-->
<? if($mode == "write" && $is_admin && $sw_edit_yn == "Y") { ?>
<input type='hidden' id='sub_style_S' name='sub_style_S' value="">
<input type='hidden' id='sub_style_E' name='sub_style_E' value="</font>">
<table width='100%' border='0' cellpadding='3' cellspacing='0' class='sw_bd_style_5'>
<tr>
<td>
<table border='0' cellpadding='0' cellspacing='0'>
<tr>
 <td>
  <select onChange='sub_style_chg(this.value)' id='sub_fcolor' name='sub_fcolor' style='background-color:#444444;'>
  <SCRIPT language="JavaScript">
  <!--
   var sub_fc_Val = new Array('#444444','#FF0000','#00FF00','#0000FF','#FFFF00','#00FFFF','#FF00FF','#CCCCCC','#999999','#666666');     
   for(var i=0; i < sub_fc_Val.length; i++)
	 document.writeln("<option value='" + sub_fc_Val[i] + "' style='background-color:" + sub_fc_Val[i] + ";'>&nbsp;&nbsp;&nbsp;</option>");     
  //-->
  </SCRIPT>
  </select>
 </td>
 <td width='4'></td>
 <td><img src='<?=$dir?>/images/edbtn/ed_fontcolor.gif' border='0' alt='글자색'></td>
 <td style='padding:0 4 0 6;'><img src='<?=$dir?>/images/spacer_0.gif' border='0' width='1' height='20'></td>
 <td><input type='checkbox' id='sub_fwet' name='sub_fwet'></td>
 <td><img src='<?=$dir?>/images/edbtn/ed_bold.gif' border='0' alt='굵게'></td>
 <td style='padding:0 4 0 6;'><img src='<?=$dir?>/images/spacer_0.gif' border='0' width='1' height='20'></td>
 <td><input type='checkbox' id='sub_funderl' name='sub_funderl'></td>
 <td><img src='<?=$dir?>/images/edbtn/ed_underline.gif' border='0' alt='밑줄'></td>
 <td style='padding:0 4 0 6;'><img src='<?=$dir?>/images/spacer_0.gif' border='0' width='1' height='20'></td>
 <td><input type='checkbox' id='sub_fmarq' name='sub_fmarq'></td>
 <td style='padding:3 0 0 2;' class='sw_ft_style_1'>MARQUEE</td>
</tr>
</table>
</td>
</tr>
</table>
<? } ?>
<table width='100%' border='0' cellpadding='0' cellspacing='0' class='sw_bd_style_5' style='border:0'>
<tr>
<td><input type='text' id='subject' name='subject' value="<?=$subject?>" maxlength='200' style='width:100%' class='input' onkeyup="addStroke()"></td>
</tr>
</table>
<!--====================[ sw_edit 파일명: ed_seting_substyle.php 끝]====================-->
