<?
/**********************************************************************************
* ���� ���� include
*********************************************************************************/
include "_head.php";

/**********************************************************************************
* ���� üũ
*********************************************************************************/
// �׷� ���� ���ؿ���
$setup=get_table_attrib($id);

// ������ üũ
if($exec=="view_all"&&$setup[grant_view]<$member[level]&&!$is_admin) Error("�������� �����ϴ�","login.php?id=$id&page=$page&page_num=$page_num&category=$category&keykind=$keykind&keyword=$keyword&no=$no&file=zboard.php");

if($exec!="view_all") unset($setup);

if(!$is_admin&&$exec!="view_all") Error("�������� �����ϴ�","login.php?id=$id&page=$page&page_num=$page_num&category=$category&keykind=$keykind&keyword=$keyword&no=$no&file=zboard.php");

$select_list=$selected;
$selected=explode(";",$selected);

$selected2=explode(";",$selected2);
$no_arr=array(); // �Խñ� �ѹ� ������ �迭 �ʱ�ȭ
for ($i=0;$i<count($selected2)-1;$i++) $no_arr[$selected2[$i]]=$selected2[$i];

if($exec=="copy_all") $_kind = "����";
elseif($exec=="move_all") $_kind = "�̵�";
elseif($exec=="delete_all") $_kind = "����";

/**********************************************************************************
* ���� ������ �Լ� �����ϰ� ����Ҽ� �ִ� ��
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
* View_All �϶� (���õ� �Խù� ����)
*********************************************************************************/

if($exec=="view_all") {

	$_view_included = true;
	$_view_included2 = true;
	$href.="&selected=$select_list";

	head();

	// ��� ��Ȳ �κ� ���
	include "$dir/setup.php";

	$all_depth = 0;
	for($idx=count($selected)-2;$idx>=0;$idx--) {
		$no = $selected[$idx];
		unset($data);
		$_dbTimeStart = getmicrotime();
		$data=mysql_fetch_array(mysql_query("select is_secret,ismember from $t_board"."_$id where no='$no'"));
		$_dbTime += getmicrotime()-$_dbTimeStart;
		// ��б��� �����ϰ� view.php ������ ������
		if(!$data[is_secret]||$is_admin||$data[ismember]==$member[no]||$member[level]<=$setup[grant_view_secret]) {
			$count=0;
			include "view.php";
			if($all_depth<$max_depth) $all_depth=$max_depth;
		}
	}

	// layer ���
	if($zbLayer) {
		echo "\n<script>".$zbLayer."\n</script>";
		unset($zbLayer);
	}

	foot('',$all_depth);
?>
<!-- ������ �ε��ð� ���ϱ� ��ũ��Ʈ ��� -->
<script>
function Result() {
	var nEnd =  new Date().getTime();
	var nDiff = nEnd - <?=$nStart?>;
	document.getElementById('print').innerHTML = 'īƮ ��� ��ü �������� �ε��ϴµ� ' + nDiff + 'ms(' + nDiff/1000 + '��) �ð��� �ɷȽ��ϴ�!';
}
addLoadEvent(Result);
</script>
<div id="print"></div>
<?
}

/**********************************************************************************
* Delete_All �϶� (���õ� �Խù� ����)
*********************************************************************************/

elseif($exec=="delete_all") {

	for ($i=0;$i<count($selected)-1;$i++) {

		$temp=mysql_fetch_array(mysql_query("select * from $t_board"."_$id where no='$selected[$i]'"));

		// ����� ���� �������̰ų� �Խñ� ����� �̵��İ� �ƴ� ��
		if(!$temp[child] && $selected[$i]!=$no_arr[$selected[$i]]) {

			// �ۻ���
			mysql_query("delete from $t_board"."_$id where no='$selected[$i]'") or Error(mysql_error());

			// ī�װ����� ���� �ϳ� ��
			mysql_query("update $t_category"."_$id set num=num-1 where no='$temp[category]'",$connect);

			// ���ϻ���
			@z_unlink("./".$temp[file_name1]);
			@z_unlink("./".$temp[file_name2]);
			// �� ���� ���� ����
			if(preg_match("#^data\/([^/]+?)\/([0-9]*?)\/(.+?)\.(.+?)#i",$temp[file_name1],$out))
				if(is_dir("./data/".$out[1]."/".$out[2])) @rmdir("./data/".$out[1]."/".$out[2]);
			if(preg_match("#^data\/([^/]+?)\/([0-9]*?)\/(.+?)\.(.+?)#i",$temp[file_name2],$out))
				if(is_dir("./data/".$out[1]."/".$out[2])) @rmdir("./data/".$out[1]."/".$out[2]);
			// ����ϻ���
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

			// ���� �ܺ� html ����� ����
			if(file_exists("./"."data/".$id."/thumbnail/".$temp[ismember]."/fs_".$temp[reg_date].".jpg")){
				@z_unlink("./"."data/".$id."/thumbnail/".$temp[ismember]."/fs_".$temp[reg_date].".jpg");
				@z_unlink("./"."data/".$id."/thumbnail/".$temp[ismember]."/fl_".$temp[reg_date].".jpg");
			}
			if(file_exists("./"."data/".$id."/thumbnail/".$temp[ismember]."/ss_".$temp[reg_date].".jpg")){
				@z_unlink("./"."data/".$id."/thumbnail/".$temp[ismember]."/ss_".$temp[reg_date].".jpg");
				@z_unlink("./"."data/".$id."/thumbnail/".$temp[ismember]."/sl_".$temp[reg_date].".jpg");
			}

			// Divison ����
			minus_division($temp[division]);

			// ����, �����ۿ� ���� ����
			if($temp[father]==0) {
				// �������� ������ ���ڸ� �޲�;;;
				if($temp[prev_no]) mysql_query("update $t_board"."_$id set next_no='$temp[next_no]' where next_no='$temp[no]'");
				// �������� ������ ���ڸ� �޲�;;;
				if($temp[next_no]) mysql_query("update $t_board"."_$id set prev_no='$temp[prev_no]' where prev_no='$temp[no]'");
			} else {
				$temp2=mysql_fetch_array(mysql_query("select count(*) from $t_board"."_$id where father='$temp[father]'"));
				// �������� ������ �������� �ڽ� ���� ����;;;
				if(!$temp2[0]) mysql_query("update $t_board"."_$id set child='0' where no='$temp[father]'");
			}

			// ������ ���(�ڸ�Ʈ) ����
			$del_comment_result=mysql_query("select * from $t_comment"."_$id where parent='$selected[$i]'");
			mysql_query("delete from $t_comment"."_$id where parent='$selected[$i]'") or Error(mysql_error());
			while($c_data=mysql_fetch_array($del_comment_result)) {
				// ���ϻ���
				@z_unlink("./".$c_data[file_name1]);
				@z_unlink("./".$c_data[file_name2]);
				// �� ���� ���� ����
				if(preg_match("#^data\/([^/]+?)\/([0-9]*?)\/(.+?)\.(.+?)#i",$c_data[file_name1],$out))
					if(is_dir("./data/".$out[1]."/".$out[2])) @rmdir("./data/".$out[1]."/".$out[2]);
				if(preg_match("#^data\/([^/]+?)\/([0-9]*?)\/(.+?)\.(.+?)#i",$c_data[file_name2],$out))
					if(is_dir("./data/".$out[1]."/".$out[2])) @rmdir("./data/".$out[1]."/".$out[2]);
			}
			@mysql_query("delete from $t_comment"."_$id"."_movie where parent='$selected[$i]'");

			// �޽��� ������ �κ�
			if($notice_user) {
				if($temp[ismember]) {
					$_to = $temp[ismember];
					$_from = $member[no];
					$_subject = del_html($temp[name])." ���� �Խù��� ".$_kind."�Ǿ����ϴ�";
					$_memo = del_html($temp[name])." �Բ��� ���� \"".del_html($temp[subject])."\" ���� $member[name]�Կ� ���ؼ� �Խ��� ���ݿ� �������� �ʾƼ� ".$_kind." �Ǿ����ϴ�\n";
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
* Copy All �϶� (���õ� �Խù� �̵�)
*********************************************************************************/

elseif($exec=="copy_all"||$exec=="move_all") {

	for($i=0;$i<count($selected)-1;$i++) {
		$s_data=mysql_fetch_array(mysql_query("select * from $t_board"."_$id where no='$selected[$i]'"));

		// ����� ������;;
		if($s_data[arrangenum]==0) {

			// �������� ��� ����
			$result=mysql_query("select * from $t_board"."_$id where headnum='$s_data[headnum]' order by no",$connect) or error(mysql_error());

			$temp=mysql_fetch_array(mysql_query("select max(division) from $t_division"."_$board_name",$connect));
			$max_division=$temp[0];
			$temp=mysql_fetch_array(mysql_query("select max(division) from $t_division"."_$board_name where num>0 and division!='$max_division'",$connect));
			if(!$temp[0]) $second_division=0; else $second_division=$temp[0];

			// �̵��� �Խ����� �ְ� headnum�� ����
			$max_headnum=mysql_fetch_array(mysql_query("select min(headnum) from $t_board"."_$board_name where (division='$max_division' or division='$second_division') and headnum>-2000000000",$connect));
			if(!$max_headnum[0]) $max_headnum[0]=0;
			$headnum=$max_headnum[0]-1;

			// �̵��� �Խ����� ����, ���ı��� ����
			$next_data=mysql_fetch_array(mysql_query("select division,headnum,arrangenum from $t_board"."_$board_name where (division='$max_division' or division='$second_division') and headnum>-2000000000 order by headnum,arrangenum limit 1"));
			if(!$next_data[0]) $next_data[0]="0";
			else $next_data=mysql_fetch_array(mysql_query("select no,headnum,division from $t_board"."_$board_name where division='$next_data[division]' and headnum='$next_data[headnum]' and arrangenum='$next_data[arrangenum]'"));
			$prev_data=mysql_fetch_array(mysql_query("select no from $t_board"."_$board_name where (division='$max_division' or division='$second_division') and headnum<=-2000000000 order by headnum desc limit 1"));
			if($prev_data[0]) $prev_no=$prev_data[0]; else $prev_no="0";

			$a_category=mysql_fetch_array(mysql_query("select min(no) from $t_category"."_$board_name",$connect));
			$category=$a_category[0];

			$next_no=$next_data[no];
			$father=0;
			$rno_arr=array(); // ��� �ѹ� ������ �迭 �ʱ�ȭ
			// looping �ϸ鼭 ����Ÿ �Է�
			while($data=mysql_fetch_array($result)) {

				if(!is_dir("./data/$board_name")) {
					@mkdir("./data/$board_name",0777,true);
				}

				// ���ε�� ������ ������� ó�� #1
				if($data[s_file_name1]) {
					$temp_ext=time();
					@mkdir("./data/$board_name/".$temp_ext,0777);
					@copy($data[file_name1] , "./data/$board_name/".$temp_ext."/".$data[s_file_name1]);
					$data[file_name1]="data/$board_name/".$temp_ext."/".$data[s_file_name1];
					@chmod("./".$data[file_name1],0706);
					@chmod("./data/$board_name/".$temp_ext,0707);
				}
				// ���ε�� ������ ������� ó�� #2
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
				$data[sitelink1]=addslashes($data[sitelink1]);
				$data[sitelink2]=addslashes($data[sitelink2]);
				$data[email]=addslashes($data[email]);
				$data[homepage]=addslashes($data[homepage]);
				$division=add_division($board_name);
				$data[headnum]=$headnum;
				$data[division]=$division;
				$data[next_no]=$next_no;
				$data[prev_no]=$prev_no;
				$data[category]=$category;

				// �Խù� ����, �̵��� ��� ���� ���
				if($notice_bbs) {
					$data[memo] .= "\n\n* $member[name]�Կ� ���ؼ� �Խù��� ".$_kind."�Ǿ����ϴ� (".date("Y-m-d H:i").")";
				}

				mysql_query("insert into $t_board"."_$board_name (division,headnum,arrangenum,depth,prev_no,next_no,father,child,ismember,memo,ip,password,name,homepage,email,subject,use_html,reply_mail,category,is_secret,sitelink1,sitelink2,file_name1,file_name2,s_file_name1,s_file_name2,x,y,reg_date,islevel,hit,vote,download1,download2,total_comment) values ('$data[division]','$data[headnum]','$data[arrangenum]','$data[depth]','$data[prev_no]','$data[next_no]','$data[father]','$data[child]','$data[ismember]','$data[memo]','$data[ip]','$data[password]','$data[name]','$data[homepage]','$data[email]','$data[subject]','$data[use_html]','$data[reply_mail]','$data[category]','$data[is_secret]','$data[sitelink1]','$data[sitelink2]','$data[file_name1]','$data[file_name2]','$data[s_file_name1]','$data[s_file_name2]','$data[x]','$data[y]','$data[reg_date]','$data[islevel]','$data[hit]','$data[vote]','$data[download1]','$data[download2]','$data[total_comment]')") or error(mysql_error());

				$ln=mysql_insert_id();
				// �μ�Ʈ �� ������ no key�� �μ�Ʈ �� no value ����(��)���� �迭 ����
				$rno_arr[$data[no]]=$ln;

				if(!$father) {
					if($prev_no) mysql_query("update $t_board"."_$board_name set next_no='$ln' where no='$prev_no'");
					if($next_no) mysql_query("update $t_board"."_$board_name set prev_no='$ln' where headnum='$next_data[headnum]' and division='$next_data[division]'");
				}

				$prev_no=$data[prev_no];
				$next_no=$data[next_no];
				$father=$ln;

				// Comment ����
				$comment_result=mysql_query("select * from $t_comment"."_$id where parent='$data[no]' order by reg_date",$connect) or error(mysql_error());
				$cno_arr=array(); // ���� �ѹ� ������ �迭 �ʱ�ȭ
				while($comment_data=mysql_fetch_array($comment_result)) {
					// ���ε�� ������ ������� ó�� #1
					if($comment_data[s_file_name1]) {
						$temp_ext=time();
						@mkdir("./data/$board_name/".$temp_ext,0777);
						@copy($comment_data[file_name1] , "./data/$board_name/".$temp_ext."/".$comment_data[s_file_name1]);
						$comment_data[file_name1]="data/$board_name/".$temp_ext."/".$comment_data[s_file_name1];
						@chmod("./".$comment_data[file_name1],0706);
						@chmod("./data/$board_name/".$temp_ext,0707);
					}
					// ���ε�� ������ ������� ó�� #2
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
					mysql_query("insert into $t_comment"."_$board_name (parent,ismember,islevel,name,password,memo,reg_date,ip,use_html2,is_secret,file_name1,file_name2,s_file_name1,s_file_name2,download1,download2) values ('$ln','$comment_data[ismember]','$comment_data[islevel]','$comment_data[name]','$comment_data[password]','$comment_data[memo]','$comment_data[reg_date]','$comment_data[ip]','$comment_data[use_html2]','$comment_data[is_secret]','$comment_data[file_name1]','$comment_data[file_name2]','$comment_data[s_file_name1]','$comment_data[s_file_name2]','$comment_data[download1]','$comment_data[download2]')") or error(mysql_error());
					// �μ�Ʈ �� ���� ���� no key�� �μ�Ʈ ���� no value ����(��)���� �迭 ����
					$cno_arr[$comment_data[no]]=mysql_insert_id();
				}
				// �μ�Ʈ�� ���� ���뿡�� ������ no ����
				unset($comment_result);
				$comment_result=mysql_query("select no,memo from $t_comment"."_$board_name where parent='$ln'",$connect) or error(mysql_error());
				while($c_data=mysql_fetch_array($comment_result)) {
					// ���� �ڸ�Ʈ ǥ�� �ҷ��� ������ ��ȣ�� ���� ó��
					$c_memo=$c_data[memo];
					unset($c_match);
					if(preg_match("#\|\|\|([0-9]{1,})\|([0-9]{1,10})$#",$c_memo,$c_match)) {
						$c_memo = str_replace($c_match[0],"",$c_memo);
						if($v=$cno_arr[$c_match[1]]) {
							$c_memo.="|||".$v."|".$c_match[2];
							$c_memo=addslashes($c_memo);
							mysql_query("update $t_comment"."_$board_name set memo='$c_memo' where no='$c_data[no]'",$connect);
						}
					}
				}

				mysql_query("update $t_category"."_$board_name set num=num+1 where no='$category'",$connect);
			}
			// �μ�Ʈ�� ��� �θ��,�ڽı� no�� �̵� ���� ��� no�� ��� ������
			unset($result);
			$result=mysql_query("select no,father,child from $t_board"."_$board_name where headnum='$headnum'",$connect) or error(mysql_error());
			while($data=mysql_fetch_array($result)) {
				if($v=$rno_arr[$data[father]]) {
					mysql_query("update $t_board"."_$board_name set father='$v' where no='$data[no]'",$connect);
				}
				if($v=$rno_arr[$data[child]]) {
					mysql_query("update $t_board"."_$board_name set child='$v' where no='$data[no]'",$connect);
				}
			}

			// �޽��� ������ �κ�
			if($notice_user) {
				if($s_data[ismember]) {
					$_to = $s_data[ismember];
					$_from = $member[no];
					$_subject = del_html($s_data[name])." ���� �Խù��� ".$_kind."�Ǿ����ϴ�";
					$_memo = del_html($s_data[name])." �Բ��� ���� \"".del_html($s_data[subject])."\" ���� $member[name]�Կ� ���ؼ� ".$_kind." �Ǿ����ϴ�\n";
					$_memo .= " �Ű��� ��ġ : zboard.php?id=".$board_name."&no=".$ln;
					_send_message($_to,$_from,$_subject,$_memo);
				}
			}
		} elseif($s_data[arrangenum]>0) {
			$selected_list2.=$s_data[no].";";
		}
	}
	$total=mysql_fetch_array(mysql_query("select count(*) from $t_board"."_$board_name",$connect));
	mysql_query("update $admin_table set total_article='$total[0]' where name='$board_name'");


	if($exec=="copy_all") {
		echo "<script>opener.location.href='zboard.php?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$desc&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no&category=$category'; window.close();</script>";
	} elseif($exec=="move_all") {
		echo "<script> location.href='list_all.php?id=$id&exec=delete_all&selected=$select_list&selected2=$selected_list2'; </script>";
		exit;
	}
}
?>