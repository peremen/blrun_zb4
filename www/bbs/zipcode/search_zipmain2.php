 <tr>
 <td align="left" style="padding-top: 4px;font-size:12px;">
 &nbsp;&nbsp;해당 주소가 검색 되었습니다.<br />&nbsp;&nbsp;나머지 주소를 아래 칸에 입력해주세요.<br /><br />&nbsp;&nbsp;<img src="../images/bullet.gif" style="vertical-align: middle;" /> <span style="color:#006F00"><?=urldecode($address)?></span><br />
 </td>
</tr>
<tr>
<td>
<form name="ws_form" method="post" action="<?=$PHP_SELF?>" style="margin: 0px" onsubmit="returnmain();">
<input name="frm_name" type="hidden" value="<?=urldecode($address)?>">
<input name="num" type="hidden" value="<?=$num?>">
&nbsp;&nbsp;<input name="accass" type="text" style="border:1px solid #e1e1e1;vertical-align: middle;background-color: #f7f7f7;" size="18" value=""> <input type="image" style="border: 0px;vertical-align: middle;width: 20px;height: 20px" src="../images/btn_search.gif"><br />&nbsp;&nbsp;예) 198-11 아셈타워 3층
</form>
<script type='text/javascript'>
<!--
var f = document.ws_form;
f.accass.focus();
-->
</script>
</td>
</tr>