<?$coloring=0;?>

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> align=center>
<tr><td>
	<table border=0 cellspacing=0 cellpadding=0 width=100% align=center style=table-layout:fixed>
	<form method=post name=list action=list_all.php>
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
	
	<col width=5></col><?if($hide_no!="on"){?><? if($browser=="1"){ ?><col width=40></col><? } ?><?}?><? if($browser=="1"){ ?><col width=70></col><? } ?><col width=></col><?if($hide_name!="on"){?><? if($browser=="1"){ ?><col width=100></col><? } ?><?}?><?if($hide_date!="on"){?><? if($browser=="1"){ ?><col width=65></col><? } ?><?}?><?if($hide_vote!="on"){?><? if($browser=="1"){ ?><col width=35></col><? } ?><?}?><?if($hide_hit!="on"){?><? if($browser=="1"){ ?><col width=50></col><? } ?><?}?><col width=13></col>
	<tr align=center valign="middle" height=35>
		<td class=title1></td>
		<?if($hide_no!="on"){?><? if($browser=="1"){ ?><td class=title2><?=$a_no?><font class=title_font>no</font></td><? } ?><?}?>

		<? if($browser=="1"){ ?><td class=title2><font class=title_font>images</font></td><? } ?>

		<td class=title2><?=$a_subject?><font class=title_font>subject</font></td>
		<?if($hide_name!="on"){?><? if($browser=="1"){ ?><td align=center class=title2><?=$a_name?><font class=title_font>name</font></td><? } ?><?}?>

		<?if($hide_date!="on"){?><? if($browser=="1"){ ?><td class=title2><?=$a_date?><font class=title_font>date</font></td><? } ?><?}?>

		<?if($hide_vote!="on"){?><? if($browser=="1"){ ?><td class=title2><?=$a_vote?><font class=title_font>vote</font></td><? } ?><?}?>

		<?if($hide_hit!="on"){?><? if($browser=="1"){ ?><td class=title2><?=$a_hit?><font class=title_font>hit</font></td><? } ?><?}?>

		<td class=title3></td>
	</tr>
	</table>
	<table border=0 cellspacing=0 cellpadding=0 width=100% align=center style=table-layout:fixed>
	<col width=5></col><?if($hide_no!="on"){?><? if($browser=="1"){ ?><col width=40></col><? } ?><?}?><? if($browser=="1"){ ?><col width=70></col><? } ?><col width=></col><col width=13></col>
<? if ($hide_no=="on"||$browser=="0") $colspan=3; else $colspan=5;?>
	<tr><td height=2 colspan=<?=$colspan?>></td></tr>
