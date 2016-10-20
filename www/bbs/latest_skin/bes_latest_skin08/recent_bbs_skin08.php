<?
//////////////////////////////////////////////////
// 통합코멘트 스킨버전
///////////////////////////////////////////////////

function print_comment_total($skinname, $title, $id_array, $num=2, $textlen=30, $datetype="Y/m/d"){
	global $_zb_path, $_zb_url, $t_board, $connect, $admin_table, $t_comment;

	$str = zReadFile($_zb_path."latest_skin/".$skinname."/main.html");
	if(!$str) { 
		echo "지정하신 $skinname 이라는 최근목록 스킨이 존재하지 않습니다<br>";
		return;
	}
	$tmpStr = explode("[loop]",$str);
	$header = $tmpStr[0];
	$tmpStr2 = explode("[/loop]",$tmpStr[1]);
	$loop = $tmpStr2[0];
	$footer = $tmpStr2[1];

	$id=explode(",", $id_array);
	$n=$num;

	// 날짜를 배열로 만들어 내림순으로 정열
	for($i=0;$i<count($id);$i++){
		$result = mysql_query("select * from $t_comment"."_$id[$i]  order by no desc limit $num", $connect) or die(mysql_error());

		while($data=mysql_fetch_array($result)){
			$r_date.=$data[reg_date].";".$id[$i]."|";
		}
	}

	// 내림순으로 된 날짜배열
	$re_date=explode("|", $r_date);
	rsort($re_date);

	// 새로 정열된 날짜로 데이터를 뽑아온다
	for($j=0;$j<$n;$j++){
		$_date=explode(";", $re_date[$j]);
		// get memo data

		$result = mysql_query("select * from $t_comment"."_$_date[1] where reg_date='$_date[0]'", $connect) or die(mysql_error());
		if($data=mysql_fetch_array($result)){
			// 게시판타이틀 없으면 게시판아이디 출력
			$set=mysql_fetch_array(mysql_query("select * from zetyx_admin_table where name='$_date[1]'", $connect));
			if(!$set[title])$subject=$_date[1];
			else $subject = $set[title];
			if($set[use_alllist]) $target = "zboard.php?id=".$_date[1];
			else $target = "view.php?id=".$_date[1];

			$name = del_html($data[name]);
			$date = date($datetype, $data[reg_date]);
			if($data[is_secret])
				$memo = "<font color='gray'>비밀 덧글입니다</font>";
			else {
				// 계층 코멘트 표식 불러와 처리
				unset($c_match);
				if(preg_match("#\|\|\|([0-9]{1,})\|([0-9]{1,10})$#",$data[memo],$c_match))
					$data[memo] = str_replace($c_match[0],"",$data[memo]);
				$memo = del_html(cut_str(strip_tags($data[memo]),$textlen));
			}
			$no = $data[no];
			   $parent = $data[parent];

			$main = $loop;
			$main = str_replace("[name]",$name,$main);
			$main = str_replace("[date]",$date,$main);
			$main = str_replace("[subject]","<a href='".$_zb_url.$target."&no=".$parent."' target=_self>[".$subject."]</a>",$main);
			$main = str_replace("[comment]","<a href='".$_zb_url.$target."&no=".$parent."#$data[no]' target=_self>".$memo."</a>",$main);
			// new 아이콘 달기 
			$check_time=(time()-$data[reg_date])/60/60; 
			if ($check_time<=48) 
			{ 
				$memo_on_img = $_zb_url."latest_skin/bes_latest_skin08/images/new.gif";
				$main = str_replace("[new]", "<img src=$memo_on_img border=0 align=absmiddle> ",$main);
			} 
			else 
			{  
				$main = str_replace("[new]", "",$main); 
			} 

			// 아이콘 끝 
			$main = str_replace("[name]","<a href='".$_zb_url.$target."&no=".$parent."#$data[no]' target=_self>".$name."</a>",$main);
			$main = str_replace("[date]","<a href='".$_zb_url.$target."&no=".$parent."#$data[no]' target=_self>".$date."</a>",$main);
			$main_data .= "".$main;
		}
	}

	$list=$header.$main_data.$footer;
	$list=str_replace("[title]",$title,$list);
	$list=str_replace("[dir]",$_zb_url."latest_skin/".$skinname."/images/",$list);
	echo $list;
}
?>
