<?
/**********************************************************************************
* 공통 파일 include
*********************************************************************************/
include "_head.php";

/**********************************************************************************
* 설정 체크
*********************************************************************************/
// 그룹 정보 구해오기
$setup=get_table_attrib($id);

// 사용권한 체크
if($exec=="view_all"&&$setup[grant_view]<$member[level]&&!$is_admin) Error("사용권한이 없습니다","login.php?id=$id&page=$page&page_num=$page_num&category=$category&keykind=$keykind&keyword=$keyword&no=$no&file=zboard.php");

if($exec!="view_all") unset($setup);

if(!$is_admin&&$exec!="view_all") Error("사용권한이 없습니다","login.php?id=$id&page=$page&page_num=$page_num&category=$category&keykind=$keykind&keyword=$keyword&no=$no&file=zboard.php");

$select_list=$selected;
$selected=explode(";",$selected);

if($exec=="copy_all") $_kind = "복사";
elseif($exec=="move_all") $_kind = "이동";
elseif($exec=="delete_all") $_kind = "삭제";

/**********************************************************************************
* 쪽지 보내는 함수 간단하게 사용할수 있는 것
*********************************************************************************/
function _send_message($to, $from, $subject, $memo) {

	global $get_memo_table, $send_memo_table, $member_table;

	$reg_date = time();

	mysql_query("insert into $get_memo_table (member_no,member_from,subject,memo,readed,reg_date)
				values ('$to','$from','$subject','$memo',1,'$reg_date')") or error(mysql_error());

	mysql_query("insert into $send_memo_table (member_to,member_no,subject,memo,readed,reg_date)
				values ('$to','$from','$subject','$memo',1,'$reg_date')") or error(mysql_error());

	mysql_query("update $member_table set new_memo=1 where no='$to'") or error(mysql_error());
}

/**********************************************************************************
* View_All 일때 (선택된 게시물 보기)
*********************************************************************************/

if($exec=="view_all") {

	$_view_included = true;
	$_view_included2 = true;
	$href.="&selected=$select_list";

	head();

	//global $max_depth;

	// 상단 현황 부분 출력
	include "$dir/setup.php";

	$all_depth = 0;
	for($idx=count($selected)-2;$idx>=0;$idx--) {
		$no = $selected[$idx];
		unset($data);
		$_dbTimeStart = getmicrotime();
		$data=mysql_fetch_array(mysql_query("select is_secret,ismember from $t_board"."_$id where no='$no'"));
		$_dbTime += getmicrotime()-$_dbTimeStart;
		// 비밀글은 제외하고 view.php 파일을 연결함
		if(!$data[is_secret]||$is_admin||$data[ismember]==$member[no]||$member[level]<=$setup[grant_view_secret]) {
			$count=0;
			include "view.php";
			if($all_depth<$max_depth) $all_depth=$max_depth;
		}
	}

	// layer 출력
	if($zbLayer) {
		echo "\n<script>".$zbLayer."\n</script>";
		unset($zbLayer);
	}

	foot('',$all_depth);
?>
<!-- 브라우저 로딩시간 구하기 스크립트 출력 -->
<script>
function Result() {
	var nEnd =  new Date().getTime();
	var nDiff = nEnd - <?=$nStart?>;
	document.getElementById('print').innerHTML = '카트 목록 전체 페이지를 로딩하는데 ' + nDiff + 'ms(' + nDiff/1000 + '초) 시간이 걸렸습니다!';
}
addLoadEvent(Result);
</script>
<div id="print"></div>
<?
}

/**********************************************************************************
* Delete_All 일때 (선택된 게시물 삭제)
*********************************************************************************/

elseif($exec=="delete_all") {

	for ($i=0;$i<count($selected)-1;$i++) {

		$temp=mysql_fetch_array(mysql_query("select * from $t_board"."_$id where no='$selected[$i]'"));

		// 답글이 없을때
		if(!$temp[child]) {

			// 글삭제
			mysql_query("delete from $t_board"."_$id where no='$selected[$i]'") or Error(mysql_error());

			// 카테고리에서 숫자 하나 뺌
			mysql_query("update $t_category"."_$id set num=num-1 where no='$temp[category]'",$connect);

			// 파일삭제
			@z_unlink("./".$temp[file_name1]);
			@z_unlink("./".$temp[file_name2]);
			// 빈 파일 폴더 삭제
			if(preg_match("#^data\/([^/]+?)\/([0-9]*?)\/(.+?)\.(.+?)#i",$temp[file_name1],$out))
				if(is_dir("./data/".$out[1]."/".$out[2])) @rmdir("./data/".$out[1]."/".$out[2]);
			if(preg_match("#^data\/([^/]+?)\/([0-9]*?)\/(.+?)\.(.+?)#i",$temp[file_name2],$out))
				if(is_dir("./data/".$out[1]."/".$out[2])) @rmdir("./data/".$out[1]."/".$out[2]);
			// 썸네일삭제
			if(preg_match("#\.(jpg|jpeg|png)$#i",$temp[file_name1])){
				@z_unlink("./"."data/".$id."/thumbnail/fs_".$temp[reg_date].".jpg");
				@z_unlink("./"."data/".$id."/thumbnail/fl_".$temp[reg_date].".jpg");
				@z_unlink("./"."data/".$id."/thumbnail/fXL_".$temp[reg_date].".jpg");
			}
			if(preg_match("#\.(jpg|jpeg|png)$#i",$temp[file_name2])){
				@z_unlink("./"."data/".$id."/thumbnail/ss_".$temp[reg_date].".jpg");
				@z_unlink("./"."data/".$id."/thumbnail/sl_".$temp[reg_date].".jpg");
				@z_unlink("./"."data/".$id."/thumbnail/sXL_".$temp[reg_date].".jpg");
			}

			// 기존 외부 html 썸네일 삭제
			if(file_exists("./"."data/".$id."/thumbnail/".$temp[ismember]."/fs_".$temp[reg_date].".jpg")){
				@z_unlink("./"."data/".$id."/thumbnail/".$temp[ismember]."/fs_".$temp[reg_date].".jpg");
				@z_unlink("./"."data/".$id."/thumbnail/".$temp[ismember]."/fl_".$temp[reg_date].".jpg");
			}
			if(file_exists("./"."data/".$id."/thumbnail/".$temp[ismember]."/ss_".$temp[reg_date].".jpg")){
				@z_unlink("./"."data/".$id."/thumbnail/".$temp[ismember]."/ss_".$temp[reg_date].".jpg");
				@z_unlink("./"."data/".$id."/thumbnail/".$temp[ismember]."/sl_".$temp[reg_date].".jpg");
			}

			// Divison 정리
			minus_division($temp[division]);

			// 이전, 다음글에 대한 정리
			if($temp[depth]==0) {
				// 이전글이 있으면 빈자리 메꿈;;;
				if($temp[prev_no]) mysql_query("update $t_board"."_$id set next_no='$temp[next_no]' where next_no='$temp[no]'");
				// 다음글이 있으면 빈자리 메꿈;;;
				if($temp[next_no]) mysql_query("update $t_board"."_$id set prev_no='$temp[prev_no]' where prev_no='$temp[no]'");
			} else {
				$temp2=mysql_fetch_array(mysql_query("select count(*) from $t_board"."_$id where father='$temp[father]'"));
				// 원본글이 있으면 원본글의 자식 글을 없앰;;;
				if(!$temp2[0]) mysql_query("update $t_board"."_$id set child='0' where no='$temp[father]'");
			}

			// 간단한 답글(코멘트) 삭제
			$del_comment_result=mysql_query("select * from $t_comment"."_$id where parent='$selected[$i]'");
			mysql_query("delete from $t_comment"."_$id where parent='$selected[$i]'") or Error(mysql_error());
			while($c_data=mysql_fetch_array($del_comment_result)) {
				// 파일삭제
				@z_unlink("./".$c_data[file_name1]);
				@z_unlink("./".$c_data[file_name2]);
				// 빈 파일 폴더 삭제
				if(preg_match("#^data\/([^/]+?)\/([0-9]*?)\/(.+?)\.(.+?)#i",$c_data[file_name1],$out))
					if(is_dir("./data/".$out[1]."/".$out[2])) @rmdir("./data/".$out[1]."/".$out[2]);
				if(preg_match("#^data\/([^/]+?)\/([0-9]*?)\/(.+?)\.(.+?)#i",$c_data[file_name2],$out))
					if(is_dir("./data/".$out[1]."/".$out[2])) @rmdir("./data/".$out[1]."/".$out[2]);
			}
			@mysql_query("delete from $t_comment"."_$id"."_movie where parent='$selected[$i]'");

			// 메시지 보내는 부분
			if($notice_user) {
				if($temp[ismember]) {
					$_to = $temp[ismember];
					$_from = $member[no];
					$_subject = del_html($temp[name])." 님의 게시물이 ".$_kind."되었습니다";
					$_memo = del_html($temp[name])." 님께서 쓰신 \"".del_html($temp[subject])."\" 글이 $member[name]님에 의해서 게시판 성격에 적합하지 않아서 ".$_kind." 되었습니다\n";
					_send_message($_to,$_from,$_subject,$_memo);
				}
			}

		}
	}
	$temp=mysql_fetch_array(mysql_query("select count(*) from  $t_board"."_$id",$connect));
	@mysql_query("update $admin_table set total_article='$temp[0]' where name='$id'") or Error(mysql_error());
	echo "<script>opener.location.href='zboard.php?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$desc&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no&category=$category'; window.close();</script>";
}

/**********************************************************************************
* Copy All 일때 (선택된 게시물 이동)
*********************************************************************************/

elseif($exec=="copy_all"||$exec=="move_all") {

	for($i=0;$i<count($selected)-1;$i++) {
		$s_data=mysql_fetch_array(mysql_query("select * from $t_board"."_$id where no='$selected[$i]'"));


		// 답글이 없을때;;
		if($s_data[arrangenum]==0) {

			// 원본글을 모두 구함
			$result=mysql_query("select * from $t_board"."_$id where headnum='$s_data[headnum]' order by arrangenum",$connect) or error(mysql_error());

			$temp=mysql_fetch_array(mysql_query("select max(division) from $t_division"."_$board_name",$connect));
			$max_division=$temp[0];
			$temp=mysql_fetch_array(mysql_query("select max(division) from $t_division"."_$board_name where num>0 and division!='$max_division'",$connect));
			if(!$temp[0]) $second_division=0; else $second_division=$temp[0];

			// 이동할 게시판의 최고 headnum을 구함
			$max_headnum=mysql_fetch_array(mysql_query("select min(headnum) from $t_board"."_$board_name where (division='$max_division' or division='$second_division') and headnum>-2000000000",$connect));
			if(!$max_headnum[0]) $max_headnum[0]=0;
			$headnum=$max_headnum[0]-1;

			// 이동할 게시판의 이전, 이후글을 구함
			$next_data=mysql_fetch_array(mysql_query("select division,headnum,arrangenum from $t_board"."_$board_name where (division='$max_division' or division='$second_division') and headnum>-2000000000 order by headnum limit 1"));
			if(!$next_data[0]) $next_data[0]="0";
			else $next_data=mysql_fetch_array(mysql_query("select no,headnum,division from $t_board"."_$board_name where division='$next_data[division]' and headnum='$next_data[headnum]' and arrangenum='$next_data[arrangenum]'"));

			$a_category=mysql_fetch_array(mysql_query("select min(no) from $t_category"."_$board_name",$connect));
			$category=$a_category[0];

			$next_no=$next_data[no];
			$father=0;
			$term_father=0;
			$root_no=0;

			// looping 하면서 데이타 입력
			while($data=mysql_fetch_array($result)) {

				if(!is_dir("./data/$board_name")) {
					@mkdir("./data/$board_name",0777,true);
				}

				// 업로드된 파일이 있을경우 처리 #1
				if($data[s_file_name1]) {
					$temp_ext=time();
					@mkdir("./data/$board_name/".$temp_ext,0777);
					@copy($data[file_name1] , "./data/$board_name/".$temp_ext."/".$data[s_file_name1]);
					$data[file_name1]="data/$board_name/".$temp_ext."/".$data[s_file_name1];
					@chmod("./".$data[file_name1],0706);
					@chmod("./data/$board_name/".$temp_ext,0707);
				}
				// 업로드된 파일이 있을경우 처리 #2
				if($data[s_file_name2]) {
					$temp_ext=time();
					@mkdir("./data/$board_name/".$temp_ext,0777);
					@copy($data[file_name2] , "./data/$board_name/".$temp_ext."/".$data[s_file_name2]);
					$data[file_name2]="data/$board_name/".$temp_ext."/".$data[s_file_name2];
					@chmod("./".$data[file_name2],0706);
					@chmod("./data/$board_name/".$temp_ext,0707);
				}

				$data[name]=addslashes($data[name]);
				$data[subject]=addslashes($data[subject]);
				$data[memo]=addslashes($data[memo]);
				$sitelink1=addslashes($sitelink1);
				$sitelink2=addslashes($sitelink2);
				$email=addslashes($email);
				$homepage=addslashes($homepage);
				$division=add_division($board_name);
				$data[headnum]=$headnum;
				$data[division]=$division;
				$data[next_no]=$next_no;
				$data[prev_no]=0;
				$data[category]=$category;
				$data[father]=$data[father]+$term_father;
				$data[child]=$data[child]+$term_child;

				// 게시물 복사, 이동시 기록 남길 경우
				if($notice_bbs) {
					$data[memo] .= "\n\n* $member[name]님에 의해서 게시물이 ".$_kind."되었습니다 (".date("Y-m-d H:i").")";
				}

				mysql_query("insert into $t_board"."_$board_name (division,headnum,arrangenum,depth,prev_no,next_no,father,child,ismember,memo,ip,password,name,homepage,email,subject,use_html,reply_mail,category,is_secret,sitelink1,sitelink2,file_name1,file_name2,s_file_name1,s_file_name2,x,y,reg_date,islevel,hit,vote,download1,download2,total_comment) values ('$data[division]','$data[headnum]','$data[arrangenum]','$data[depth]','$data[prev_no]','$data[next_no]','$data[father]','$data[child]','$data[ismember]','$data[memo]','$data[ip]','$data[password]','$data[name]','$data[homepage]','$data[email]','$data[subject]','$data[use_html]','$data[reply_mail]','$data[category]','$data[is_secret]','$data[sitelink1]','$data[sitelink2]','$data[file_name1]','$data[file_name2]','$data[s_file_name1]','$data[s_file_name2]','$data[x]','$data[y]','$data[reg_date]','$data[islevel]','$data[hit]','$data[vote]','$data[download1]','$data[download2]','$data[total_comment]')") or error(mysql_error());

				$no=mysql_insert_id();
				if(!$father) {
					$root_no=$no;
					$father=$no;
					$term_father=$data[no]-$no;
				}

				// Comment 정리
				$comment_result=mysql_query("select * from $t_comment"."_$id where parent='$data[no]' order by reg_date",$connect) or error(mysql_error());
				while($comment_data=mysql_fetch_array($comment_result)) {
					// 업로드된 파일이 있을경우 처리 #1
					if($comment_data[s_file_name1]) {
						$temp_ext=time();
						@mkdir("./data/$board_name/".$temp_ext,0777);
						@copy($comment_data[file_name1] , "./data/$board_name/".$temp_ext."/".$comment_data[s_file_name1]);
						$comment_data[file_name1]="data/$board_name/".$temp_ext."/".$comment_data[s_file_name1];
						@chmod("./".$comment_data[file_name1],0706);
						@chmod("./data/$board_name/".$temp_ext,0707);
					}
					// 업로드된 파일이 있을경우 처리 #2
					if($comment_data[s_file_name2]) {
						$temp_ext=time();
						@mkdir("./data/$board_name/".$temp_ext,0777);
						@copy($comment_data[file_name2] , "./data/$board_name/".$temp_ext."/".$comment_data[s_file_name2]);
						$comment_data[file_name2]="data/$board_name/".$temp_ext."/".$comment_data[s_file_name2];
						@chmod("./".$comment_data[file_name2],0706);
						@chmod("./data/$board_name/".$temp_ext,0707);
					}
					$comment_data[memo]=addslashes($comment_data[memo]);
					$comment_data[name]=addslashes($comment_data[name]);
					mysql_query("insert into $t_comment"."_$board_name (parent,ismember,islevel,name,password,memo,reg_date,ip,use_html2,is_secret,file_name1,file_name2,s_file_name1,s_file_name2,download1,download2) values ('$no','$comment_data[ismember]','$comment_data[islevel]','$comment_data[name]','$comment_data[password]','$comment_data[memo]','$comment_data[reg_date]','$comment_data[ip]','$comment_data[use_html2]','$comment_data[is_secret]','$comment_data[file_name1]','$comment_data[file_name2]','$comment_data[s_file_name1]','$comment_data[s_file_name2]','$comment_data[download1]','$comment_data[download2]')") or error(mysql_error());
				}

				mysql_query("update $t_category"."_$board_name set num=num+1 where no='$category'",$connect);
			}
			$prev_data=mysql_fetch_array(mysql_query("select headnum from $t_board"."_$board_name where headnum>'$headnum' order by headnum limit 1"));
			mysql_query("update $t_board"."_$board_name set prev_no='$root_no' where headnum='$prev_data[0]'",$connect) or Error(mysql_error());


			// 메시지 보내는 부분
			if($notice_user) {
				if($s_data[ismember]) {
					$_to = $s_data[ismember];
					$_from = $member[no];
					$_subject = del_html($s_data[name])." 님의 게시물이 ".$_kind."되었습니다";
					$_memo = del_html($s_data[name])." 님께서 쓰신 \"".del_html($s_data[subject])."\" 글이 $member[name]님에 의해서 ".$_kind." 되었습니다\n";
					$_memo .= " 옮겨진 위치 : zboard.php?id=".$board_name."&no=".$no;
					_send_message($_to,$_from,$_subject,$_memo);
				}
			}
		}
	}
	$total=mysql_fetch_array(mysql_query("select count(*) from $t_board"."_$board_name",$connect));
	mysql_query("update $admin_table set total_article='$total[0]' where name='$board_name'");


	if($exec=="copy_all") {
		echo "<script>opener.location.href='zboard.php?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$desc&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no&category=$category'; window.close();</script>";
	} elseif($exec=="move_all") {
		echo "<script> location.href='list_all.php?id=$id&exec=delete_all&selected=$select_list'; </script>";
		exit;
	}
}
?>
