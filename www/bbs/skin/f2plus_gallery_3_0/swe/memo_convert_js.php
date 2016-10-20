<?
/* ====================[ sw_edit 파일명: memo_convert_js.php ]==================== */

function love_convert($memo)
{
	global $dir;

	$osexy = "B";
	$ogirl = "<STRONG>";
	$ogood = "</STRONG>";

	for($i = 0; $i < 3; $i++)
	{
		if(preg_match("/\[SW_".$osexy."#\]/",$memo) && preg_match("/\[#SW_".$osexy."\]/",$memo))
		{
			$pattern1 = array("/\[SW_".$osexy."#\]/","/\[#SW_".$osexy."\]/");
			$replace1 = array($ogirl,$ogood);
			
			$memo = preg_replace($pattern1,$replace1,$memo);
		}
		if($osexy == "B") { $osexy = "I"; } else { $osexy = "U"; }
		if($ogirl == "<STRONG>") { $ogirl = "<EM>"; } else { $ogirl = "<U>"; }
		if($ogood == "</STRONG>") { $ogood = "</EM>"; } else { $ogood = "</U>"; }
	}

	$golf = array('FF0000','00FF00','0000FF','FFFF00','00FFFF','FF00FF','CCCCCC','999999','666666');
	$girls = "FC";
	$obaby = "<font color='";

	for($i = 0; $i < 9; $i++)
	{
		if(preg_match("/\[".$golf[$i]."_".$girls."#\]/",$memo) && preg_match("/\[#".$girls."_".$golf[$i]."\]/",$memo))
		{
			$pattern2 = array("/\[".$golf[$i]."_".$girls."#\]/","/\[#".$girls."_".$golf[$i]."\]/");
			$replace2 = array($obaby."#".$golf[$i]."'>","</font>");
			
			$memo = preg_replace($pattern2,$replace2,$memo);
		}
		if($i == 8 && $girls == "FC")
		{
			$girls = "FB";
			$obaby = "<font style='background-color:";
			$i = -1;
		}
	}

	for($i = 0; $i < 40; $i++)
	{
		if(preg_match("/\[SW_EMTC".$i."\]/",$memo))
		{
			$memo = preg_replace("/\[SW_EMTC".$i."\]/","<img src='".$dir."/images/emoticon/emtc_1_$i.gif' border='0'>",$memo);
		}
	}
	
	return $memo;
}
?>
