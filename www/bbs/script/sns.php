<? if(preg_match("/MSIE ([1-8]{1}\.[0-9]{1,})/i",$HTTP_USER_AGENT)) {
	;
} else {
?>

<!--SNS 관련 태그 삽입-->
<center>
<div style="clear:both;line-height:1em;width:300px;">
<table style="clear:both;width:100%;" border="0" cellpadding="0" cellspacing="0">
<tr>
	<td style="width:100%;">
		<div style="float:left;display:inline;">
			<a href="http://twitter.com/share" class="twitter-share-button" data-text="<?=strip_tags(str_replace("\"","&quot;",$subject))?>" data-url="<?=urldecode($social_ref)?>" data-count="horizontal" data-via="<?=preg_replace("#http[s]?\:\/\/#i","",str_replace("www.","",mb_substr(zbUrl(),0,mb_strpos(zbUrl(),"/bbs/"))))?>">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
		</div>
		<div style="float:right;display:inline;">
			<iframe src="http://www.facebook.com/plugins/like.php?href=<?=$social_ref?>&amp;layout=button_count&amp;show_faces=false&amp;&amp;width=110&amp;send=true&amp;action=like&amp;font=trebuchet+ms&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none;overflow:hidden;width:180px;height:21px;" allowTransparency="true"></iframe>
		</div>
	</td>
</tr>
</table>
</div>
</center>
<!--SNS 관련 태그 삽입 끝-->
<? } ?>
