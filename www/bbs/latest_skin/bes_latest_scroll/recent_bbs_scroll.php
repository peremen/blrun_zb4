<?
//////////////////////////////////////////////////
// 최근게시물 함수 지정 2008년 11월 14일 스크롤 최근게시물
///////////////////////////////////////////////////

function recent_scroll($skinname, $title, $num=10, $textlen=30, $datetype="Y/m/d") {
	global $_zb_path, $_zb_url, $t_board, $connect, $admin_table, $t_comment, $mb_id, $mb_conf, $mb_title;

//////////////////////////////////////
// 스킨의 존재여부 검사

	$str = zReadFile($_zb_path."latest_skin/".$skinname."/main.html");
	if(!$str) {
			echo "지정하신 $skinname 이라는 최근목록 스킨이 존재하지 않습니다<br>";
			return;
	}

//////////////////////////////////////
// 필요한 변수 받아내기

	if(!$mb_conf[icon])
		$ico = "<img src=".$zb_url."images/dot_green.gif width=7 height=7>";
	else
		$ico = $mb_conf[icon];

	$id = $mb_id; // id 받기
	$idTitle = $mb_title; //각 게시판의 이름 받기
	$cutTimeMode = $mb_conf[timemode]; // 최근 게시물 시간 범위
	$showCategory = 1 - $mb_conf[nocategory]; //카테고리 보이기 값
	$showIdtitle  = $mb_conf[showidtitle]; // 게시판 이름 보이기 값
	$myTitle = $mb_conf[mytitle];

	for( $i = 0; $i < sizeof($id); $i++){
		$setup = mysql_fetch_array(mysql_query("select use_alllist, use_category from $admin_table where name='".$id[$i]."'"));
		if($setup[use_alllist])
			$target[$id[$i]] = "zboard.php?id=";
		else
			$target[$id[$i]] = "view.php?id=";
		if($setup[use_category]) $use_category[$id[$i]] = 1;
		$idTitle[$id[$i]] = $mb_title[$i];
	}

// 스킨 관련 변수
	$tmpStr = explode("[loop]",$str);
	$header = $tmpStr[0];
	$tmpStr2 = explode("[/loop]",$tmpStr[1]);
	$loop = $tmpStr2[0];
	$footer = $tmpStr2[1];

//////////////////////////////////////
// 처리 시작

	$tc = 0; //전체 데이타 카운터
	$icon_new = "<img src='".$_zb_url."latest_skin/bes_latest_skin08/images/new.gif'>";
	$time_new = time() - 3600 * 48;

	/* 뽑을 게시물 시간범위 관련 설정 시작 */
	// $cutTimeMode가 1 이면 24시간 이내의 게시물 추출
	// $cutTimeMode가 2 이면 오늘 새벽 0시0분부터 올라온 게시물 추출
	// $cutTimeMode가 0 혹은 기타 수일 때 그냥 최근올려진 순서로 추출(시간제한 없음)

	if($cutTimeMode == 1){
	  $cut_time = time() - 3600 * 24;   // 24시간이내
	}else if($cutTimeMode == 2){
	  $cut_time = mktime(0,0,0,date("m"),date("d"),date("Y")); // 오늘 아침 0시부터
	}else{
	  $cut_time = 0;
	}
	/* 뽑을 게시물 시간범위 관련 설정 끝. */

// 최근 글 순으로 게시물 뽑음
	for( $i = 0; $i < sizeof($id); $i++){
		$query = "select * from ".$t_board."_".$id[$i]." where is_secret=0 and reg_date > $cut_time order by no desc limit $num";
		$result = mysql_query($query, $connect) or die(mysql_error());
		while($data=mysql_fetch_array($result)){
			$ad[$tc][name] = del_html(str_replace("&rlo;","&amp;rlo;",str_replace("&rlm;","&amp;rlm;",str_replace("\"","&quot;",addslashes($data[name])))));
			$ad[$tc][subject] = del_html(str_replace("&rlo;","&amp;rlo;",str_replace("&rlm;","&amp;rlm;",str_replace("\"","&quot;",cut_str(strip_tags(addslashes($data[subject])), $textlen)))))."</font></b>";
			$ad[$tc][date] = date($datetype, $data[reg_date]);
			$ad[$tc][reg_date] = $data[reg_date];

			$last_comment = mysql_fetch_array(mysql_query("select * from $t_comment"."_$id[$i] where parent='$data[no]' order by reg_date desc limit 1"));
			$last_comment_time = $last_comment['reg_date'];
			if(time()-$last_comment_time<3600*24)
				$comment_num = "[<font color=red>".$data[total_comment]."</font>]";
			elseif(time()-$last_comment_time<3600*48)
				$comment_num = "[<font color=blue>".$data[total_comment]."</font>]";
			else
				$comment_num = "[".$data[total_comment]."]";
			$ad[$tc][comment] = $data[total_comment] ? $comment_num : "";

			$ad[$tc][icon] = $data[reg_date] > $time_new ? $icon_new : "";
			$ad[$tc][target] = $_zb_url.$target[$id[$i]].$id[$i]."&no=".$data[no];
			$ad[$tc][catelink] = $_zb_url."zboard.php?id=".$id[$i]."&category=".$data[category];
			$ad[$tc][id] = $id[$i];
			$ad[$tc][no] = $data[no];
			$category = $data[category];
			$result_category = mysql_query("select * from zetyx_board_category_".$id[$i]." where no='$category'") or die(mysql_error());
			$category = mysql_fetch_array($result_category);
			$ad[$tc][cate] = $category[name];
			$tm[$tc] = $data[reg_date];
			$map[$data[reg_date]] = $tc;
			$tc++;
		}
	}

///////////////
// output

// 모든게시물을 시간순으로 정렬
	if($tc)
	  sort($tm);

// 스킨관련 부분
// $mbName, $mbDate, $mbSubject, $mbComment, $mbCategory;

// 최근 게시물 순으로 $num만큼을 5개씩 나누어 출력
	$sc = 0; $cnt = 0;

	for($i = sizeof($tm)-1; $i >= sizeof($tm)-$num && $i >= 0; $i--) {

		$cnt++;

		$n = $map[$tm[$i]];
		//print "$ico ";
		$mbCategory = "";

		// 게시판 이름 보이기
		if($showIdtitle){
		  $mbCategory = "[ <a href=".$_zb_url."zboard.php?id=".$ad[$n][id]." target=_self><font color=black>".$idTitle[$ad[$n][id]]."</font></a>";
		  if($showCategory)
			  $mbCategory .= ">";
		  else
			  $mbCategory .= " ]";
		}

		// 카테고리 표시하지 않기를 선택했다면 카테고리 감추고 자신이 정의한 제목을 앞에 달음
		if($showCategory){
		  if(!$showIdtitle) print "[ ";
				$mbCategory .= "<a href=".$ad[$n][catelink]." target=_self><font color=black>".$ad[$n][cate]."</font></a> ]";
		}else{
		  $mbCategory .= $myTitle; }

		$mbSubject = "<a href=".$ad[$n][target]." title='작성자:".$ad[$n][name]." 작성일:".$ad[$n][date]."' target=_self>";
		$mbSubject .= $ad[$n][subject];
		$mbSubject .= "</a> ".$ad[$n][icon];
		$mbComment = $ad[$n][comment];
		$mbName    = $ad[$n][name];
		$mbDate    = $ad[$n][date];
		//echo $mbCategory." ".$mbSubject;
		$main = $loop;
		$main = str_replace("[name]",$mbName,$main);
		$main = str_replace("[date]",$mbDate,$main);
		$main = str_replace("[subject]",$mbSubject,$main);
		$main = str_replace("[comment]",$mbComment,$main);
		$main = str_replace("[category]",$mbCategory,$main);
		$main_data .= "\n".$main;
		//echo $main_data;

		if($cnt % 5 != 0 && $cnt < $num){
			continue;
		} elseif($cnt % 5 == 0 || $cnt == $num){

			// 전체 출력 문자열을 모아놓기

			//$list[$sc] = $header.$main_data.$footer;
			$list[$sc] = "<table border=0 valign=top width=100% cellspacing=0 cellpadding=0>".$main_data.$footer;


			$header = str_replace("[title]",$title,$header);
			$header = str_replace("[dir]",$_zb_url."latest_skin/".$skinname."/images/",$header);

			//$footer = str_replace("[title]",$title,$footer);
			//$footer = str_replace("[dir]",$_zb_url."latest_skin/".$skinname."/images/",$footer);


			$list[$sc] = str_replace("[title]",$title,$list[$sc]);
			$list[$sc] = str_replace("[dir]",$_zb_url."latest_skin/".$skinname."/images/",$list[$sc]);
			//$list[$sc] = str_replace("\r\n"," ",$list[$sc]);
			$list[$sc] = str_replace("\n"," ",$list[$sc]);
			$list[$sc] = str_replace("\r"," ",$list[$sc]);
			$list[$sc] = str_replace("\"","&quot;",$list[$sc]);

			$main_data = "";
			$sc++;
		}

	}

//echo $list[$sc];
// 출력
	echo $header."<tr><td></td></tr></table>";
	echo "<script>";
	for($i=0; $i<$sc; $i++){
		echo "scroll_content[".$i."]=\"".$list[$i]."\";";
	}
	echo "</script>";

}
?>

<SCRIPT type="text/javascript">
var scrollerheight=110;                // 스크롤러의 세로
var html, total_area=0, wait_flag=true;

var bMouseOver = 1, bOnclick = 0;
var waitingtime = 7000;                // 멈추는 시간
var s_tmp = 0, s_amount = 22;
var scroll_content=new Array();

var startPanel=0, n_panel=0, i=0;
var curPage=0;

function startscroll()
{ // 스크롤 시작
	i=0;
	for (i in scroll_content)
		n_panel++;

	total_area=n_panel;
	n_panel = n_panel -1 ;
	startPanel = Math.round(Math.random()*n_panel);

	insert_area(startPanel);

	curPage = startPanel%total_area + 1;

	document.getElementById('myroll').innerHTML = curPage + "/" + total_area + " " + "<span style='cursor:pointer;' onMouseover='bMouseOver=0' onMouseout='bMouseOver=1;bOnclick=0;' onClick='bOnclick=-1;left_click();'>◀</span> <span style='cursor:pointer;' onMouseover='bMouseOver=0' onMouseout='bMouseOver=1;bOnclick=0;' onClick='bOnclick=1;right_click();'>▶</span>" //최근 코멘트 제목에 현재 페이지 표시.

	window.setTimeout("scrolling()",waitingtime);
}

function scrolling(){ // 실제로 스크롤 하는 부분

	if (bMouseOver && wait_flag && !bOnclick){
		startPanel++;
		curPage = startPanel%total_area + 1;

		document.getElementById('scroll_area').innerHTML = scroll_content[curPage-1]+'\n'; // Area 내용 변경
		document.getElementById('myroll').innerHTML = curPage + "/" + total_area + " " + "<span style='cursor:pointer;' onMouseover='bMouseOver=0' onMouseout='bMouseOver=1;bOnclick=0;' onClick='bOnclick=-1;left_click();'>◀</span> <span style='cursor:pointer;' onMouseover='bMouseOver=0' onMouseout='bMouseOver=1;bOnclick=0;' onClick='bOnclick=1;right_click();'>▶</span>" //최근 코멘트 제목에 현재 페이지 표시.
		if (++s_tmp == 1){
		  wait_flag=false;
		  window.setTimeout("wait_flag=true;s_tmp=0;",waitingtime);
		}

	} else if (!bMouseOver && bOnclick) {
		if (startPanel == 0) startPanel += total_area;

		startPanel += bOnclick;
		curPage = startPanel%total_area + 1;

		document.getElementById('scroll_area').innerHTML = scroll_content[curPage-1]+'\n'; // Area 내용 변경
		document.getElementById('myroll').innerHTML = curPage + "/" + total_area + " " + "<span style='cursor:pointer;' onMouseover='bMouseOver=0' onMouseout='bMouseOver=1;bOnclick=0;' onClick='bOnclick=-1;left_click();'>◀</span> <span style='cursor:pointer;' onMouseover='bMouseOver=0' onMouseout='bMouseOver=1;bOnclick=0;' onClick='bOnclick=1;right_click();'>▶</span>" //최근 코멘트 제목에 현재 페이지 표시.
		bOnclick = 0;
		if (++s_tmp == 1){
		  wait_flag=false;
		  window.setTimeout("wait_flag=true;s_tmp=0;",waitingtime);
		}
	}
	window.setTimeout("scrolling()",waitingtime);
}

function insert_area(idx){ // area 삽입
	html='<div style="left: 0px; width: 100%; position: absolute; top: 0px" id="scroll_area">\n';
	html+=scroll_content[idx]+'\n';
	html+='</div>\n';
	document.write(html);
}

function left_click(){
	scrolling();
}

function right_click(){
	scrolling();
}
</SCRIPT>
