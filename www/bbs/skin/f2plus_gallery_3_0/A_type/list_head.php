<?$coloring=0;?>

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> align=center>
<tr><td>
	<table border=0 cellspacing=0 cellpadding=0 width=100% align=center style=border-width:1pt;border-style:solid;border-color:#cccccc style=table-layout:fixed>
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

	<?if($hide_no=="off"){?><? if($browser=="1"){ ?><col width=40></col><? } ?><?}?><? if($browser=="1"){ ?><col width=80></col><? } ?><col width=></col><?if($hide_name=="off"){?><? if($browser=="1"){ ?><col width=100></col><? } ?><?}?><?if($hide_date=="off"){?><? if($browser=="1"){ ?><col width=65></col><? } ?><?}?><?if($hide_vote=="off"){?><? if($browser=="1"){ ?><col width=35></col><? } ?><?}?><?if($hide_hit=="off"){?><? if($browser=="1"){ ?><col width=50></col><? } ?><?}?>

	<tr align=center valign="middle" height=25>
		<?if($hide_no=="off"){?><? if($browser=="1"){ ?><td width=40><?=$a_no?><img src=<?=$dir?>/images/top_no.gif border=0></td><? } ?><?}?>

		<? if($browser=="1"){ ?><td width=80><img src=<?=$dir?>/images/top_img.gif border=0></td><? } ?>

		<td><?=$a_subject?><img src=<?=$dir?>/images/top_subject.gif border=0></td>
		<?if($hide_name=="off"){?><? if($browser=="1"){ ?><td width=100><?=$a_name?><img src=<?=$dir?>/images/top_name.gif border=0></td><? } ?><?}?>

		<?if($hide_date=="off"){?><? if($browser=="1"){ ?><td width=65><?=$a_date?><img src=<?=$dir?>/images/top_date.gif border=0></td><? } ?><?}?>

		<?if($hide_vote=="off"){?><? if($browser=="1"){ ?><td width=35><?=$a_vote?><img src=<?=$dir?>/images/top_vote.gif border=0></td><? } ?><?}?>

		<?if($hide_hit=="off"){?><? if($browser=="1"){ ?><td width=50><?=$a_hit?><img src=<?=$dir?>/images/top_hit.gif border=0></td><? } ?><?}?>

	</tr>
	</table>
	<table border=0 cellspacing=0 cellpadding=0 width=100% align=center style=table-layout:fixed>
	<?if($hide_no=="off"){?><? if($browser=="1"){ ?><col width=40></col><? } ?><?}?><? if($browser=="1"){ ?><col width=80></col><? } ?><col width=></col>
<? if ($hide_no=="on"||$browser=="0") $colspan=1; else $colspan=3;?>
	<tr><td height=1 bgcolor=#eaeaea colspan=<?=$colspan?>></td></tr>
	<tr><td height=1 bgcolor=#efefef colspan=<?=$colspan?>></td></tr>
	<tr><td height=1 bgcolor=#f1f1f1 colspan=<?=$colspan?>></td></tr>
	<tr><td height=1 bgcolor=#f5f5f5 colspan=<?=$colspan?>></td></tr>
	<tr><td height=1 bgcolor=#f7f7f7 colspan=<?=$colspan?>></td></tr>
