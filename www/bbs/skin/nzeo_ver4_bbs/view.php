
<img src=<?=$dir?>/t.gif border=0 height=5><br>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr class=title>
	<td align=left class=title2_han style=padding:8px;word-break:break-all;>
		<b><?=$hide_category_start?>[<?=$category_name?>] <?=$hide_category_end?><?=$subject?></b>
	</td>
</tr>
<tr class=list1>
	<td height=180 valign=top bgcolor=white>
		<table border=0 cellspacing=0 width=100% style=table-layout:fixed height=30 class=list0 style=table-layout:fixed>
		<col width=></col><col width=249></col>
		<tr>
			<td align=left nowrap='nowrap' style=padding-left:10px>
				<div style="overflow:hidden;" class=list_han><?=$face_image?> <?=$name?>&nbsp;
				<? if($data['homepage']) { ?><a href="<?=$data['homepage']?>" target=_blank><font class=list_eng>(Homepage)</font></a><? } ?></div>
			</td>
			<td align=right style=padding-right:10px class=list_eng><?=$date?>, 조회 : <b><?=number_format($hit)?></b>, 추천 : <b><?=$vote?></b></td>
		</tr>
		</table>
		<table border=0 cellspacing=0 cellpadding=10 width=100% padding=8 style=table-layout:fixed>
		<tr>
			<td align=left class=memo>
				<?=$hide_sitelink1_start?><font class=list_eng>- <b>SiteLink #1</b> : <?=$sitelink1?></font><br><?=$hide_sitelink1_end?>

				<?=$hide_sitelink2_start?><font class=list_eng>- <b>SiteLink #2</b> : <?=$sitelink2?></font><br><?=$hide_sitelink2_end?>

				<?=$hide_download1_start?><font class=list_eng>- <b>Download #1</b> : <?=$a_file_link1?><?=$file_name1?> (<?=$file_size1?>)</a>, Download : <?=$file_download1?></font><br><?=$upload_image1?><br><?=$hide_download1_end?>

				<?=$hide_download2_start?><font class=list_eng>- <b>Download #2</b> : <?=$a_file_link2?><?=$file_name2?> (<?=$file_size2?>)</a>, Download : <?=$file_download2?></font><br><?=$upload_image2?><br><?=$hide_download2_end?>
		
				<img src=<?=$dir?>/t.gif border=0 width=10><br>
				<!--여기부터 본문 내용 시작입니다-->
				<?=$memo?><br><br>
				<? include "script/sns.php"; ?>
				<br><div align=right class=list_eng><?=$ip?></div><br>
				<a href="http://www.ntzn.net/" target="_blank" style="color:blue;">http://www.ntzn.net/</a>
				<!--여기까지 본문 내용 끝입니다-->
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>
<img src=<?=$dir?>/t.gif border=0 height=2><br>
