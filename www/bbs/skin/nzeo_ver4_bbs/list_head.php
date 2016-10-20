<?$coloring=0;?>

<table border=0 cellspacing=1 cellpadding=4 width=<?=$width?> style=table-layout:fixed>
<form method=post name=list action=list_all.php>
<input type=hidden id=nStart name=nStart>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=id value=<?=$id?>>
<input type=hidden name=select_arrange value=<?=$select_arrange?>>
<input type=hidden name=desc value=<?=$desc?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=selected>
<input type=hidden name=exec>
<input type=hidden name=keyword value="<?=$keyword?>">
<input type=hidden name=sn value="<?=$sn?>">
<input type=hidden name=ss value="<?=$ss?>">
<input type=hidden name=sc value="<?=$sc?>">
<input type=hidden name=sm value="<?=$sm?>">
<? if($browser=="1"){ ?><col width=50></col><? } ?><?=$hide_category_start?><col width=50></col><?=$hide_category_end?><col width=></col><? if($browser=="1"){ ?><col width=80></col><? } ?><? if($browser=="1"){ ?><col width=70></col><? } ?><? if($browser=="1"){ ?><col width=50></col><col width=50></col><? } ?>

<tr align=center class=title>
	<? if($browser=="1"){ ?><td class=title_han width=50 height=30><?=$a_no?><font class=title_han>번호</font></a></td><? } ?>

	<?=$hide_category_start?><td width=50 class=title_han nowrap='nowrap'><?=$a_cart?><font class=title_han>분류</font></a></td><?=$hide_category_end?>

	<td class=title_han><?=$a_subject?><font class=title_han>제목</font></a></td>
	<? if($browser=="1"){ ?><td width=80 class=title_han><?=$a_name?><font class=title_han>작성자</font></a></td><? } ?>

	<? if($browser=="1"){ ?><td width=70 class=title_han><?=$a_date?><font class=title_han>작성일</font></a></td><? } ?>

	<? if($browser=="1"){ ?><td width=50 class=title_han><?=$a_vote?><font class=title_han>추천</font></a></td><td width=50 class=title_han><?=$a_hit?><font class=title_han>조회</font></a></td><? } ?>

</tr>
