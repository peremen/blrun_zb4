
<div align=center>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>><tr><td colspan=10 class=line1 height=1></td></tr><tr><td colspan=10 class=line2 height=1></td></tr></table>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr>
	<td align=left height=15 nowrap='nowrap' class=cub><span class=v7><font title="게시물이동"><?=$a_delete_all?>&nbsp;D&nbsp;</a><a href=javascript:show(down) onfocus=this.blur() title=검색>&nbsp;S</a></td>
	<td align=right height=15 nowrap='nowrap' class=cu><?=$a_prev_page?>&lt;&lt;</a> <span class=v8><?=$print_page?></a></span> <?=$a_next_page?>&gt;&gt;</a>&nbsp;
	</td>
</tr>
</form>
</table>
<table border=0 cellspacing=1 cellpadding=1 width=<?=$width?>>
<tr><td><!-- 폼태그 부분;; 수정하지 않는 것이 좋습니다 -->
<form method=post name=search action=<?=$PHP_SELF?>>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=id value=<?=$id?>>
<input type=hidden name=select_arrange value=<?=$select_arrange?>>
<input type=hidden name=desc value=<?=$desc?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=selected>
<input type=hidden name=exec>
<input type=hidden name=sn value="on">
<input type=hidden name=ss value="on">
<input type=hidden name=sc value="on">
<input type=hidden name=category value="<?=$category?>">
<!-- 폼 태그 끝 --></td>
<td width=100% align=right>
<span id="down" style="display:none;width:300px">
<table border=0 width=40% cellspcing=0 cellpadding=0><tr><td align=right><input type=text name=keyword value="<?=$keyword?>" <?=size(15)?> class=input2></td></tr></table>
</span>
</td></tr>
</form>
</table>
</div>
