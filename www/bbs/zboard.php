<?
/***************************************************************************
* ���� ���� include
**************************************************************************/
include "_head.php";
include("securimage/securimage.php");
// HTML ���
print "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN' 'http://www.w3.org/TR/html4/loose.dtd'>\n";

/***************************************************************************
* �Խ��� ���� üũ
**************************************************************************/

// ������ üũ
if($setup[grant_list]<$member[level] && !$is_admin) Error("�������� �����ϴ�","login.php?id=$id&page=$page&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no&s_url=".urlencode($REQUEST_URI));

$notice_que = "select * from $t_board"."_$id where headnum <= -2000000000 order by $select_arrange $desc limit 0, $page_num";
$notice_result = mysql_query($notice_que, $connect) or error(mysql_error());


// �˻������� ������ : ��Ȳ -> ī�װ� ����, Use_Showreply ���, �Ǵ� �˻���� �˻��� �Ҷ�
if($s_que) {
	$_dbTimeStart = getmicrotime();
	if($sm=="on") {
		$que="select $t_board"."_$id.no, division, headnum, arrangenum, depth, prev_no, next_no, father, child, $t_board"."_$id.ismember, $t_board"."_$id.islevel, $t_board"."_$id.memo, $t_board"."_$id.ip, $t_board"."_$id.name, homepage, email, subject, use_html, reply_mail, category, $t_board"."_$id.is_secret, $t_board"."_$id.file_name1, $t_board"."_$id.file_name2, $t_board"."_$id.reg_date, hit, vote, total_comment, x, y from $t_board"."_$id left join $t_comment"."_$id on parent=$t_board"."_$id.no $s_que group by $t_board"."_$id.no having count($t_board"."_$id.no)>=1 order by $select_arrange $desc limit $start_num, $page_num";
	} else {
		$que="select * from $t_board"."_$id $s_que order by $select_arrange $desc limit $start_num, $page_num";
	}
	$result=mysql_query($que,$connect) or Error(mysql_error());
	$_dbTime += getmicrotime()-$_dbTimeStart;
}

// �˻� ������ ������ : ��Ȳ -> �Ϲ� ����, �Ǵ� ���ı����� �����ų� Desc, Asc �϶�.
else {

	// �˻������� ���� ������ headnum�� ���� ���϶�;; �� �Ϲ� �����϶�;;
	if ($select_arrange=="headnum"&&$desc=="asc") {
		while($division_data=mysql_fetch_array($division_result)) {
			$sum=$sum+$division_data[num];
			$division=$division_data[division];

			if($sum>=$start_num) {
				$start_num=$start_num-($sum-$division_data[num]);
				$_dbTimeStart = getmicrotime();
				$que="select * from $t_board"."_$id where division='$division' and headnum<0 and headnum>-2000000000 order by headnum,arrangenum limit $start_num, $page_num";
//					echo $que;
				$result=mysql_query($que) or error(mysql_error());
				$_dbTime += getmicrotime()-$_dbTimeStart;
				$check1=1;

				$returnNum = mysql_num_rows($result);

				if($returnNum>=$page_num) {
					break;
				} else {
					if($division>1) {
						$division--;
						$minus=$page_num-$returnNum;
						$_dbTimeStart = getmicrotime();
						$que2="select * from $t_board"."_$id where division=$division and headnum!=0 and headnum>-2000000000 order by headnum,arrangenum limit $minus";
						$result2=mysql_query($que2) or error(mysql_error());
						$_dbTime += getmicrotime()-$_dbTimeStart;
						$check2=1;
						break;
					}
				}
			}
		}
	}

	// �˻������� ������ ���İ��� ���涧;;; //////////////////////////////
	else {
		$que="select * from $t_board"."_$id where headnum>-2000000000 order by $select_arrange $desc $add_on limit $start_num, $page_num";
//			echo $que;
		$_dbTimeStart = getmicrotime();
		$result=mysql_query($que,$connect) or Error(mysql_error());
		$_dbTime += getmicrotime()-$_dbTimeStart;
	}
}

// �������϶��� �Խ��� �� �ű�⶧���� �Խ��� ����Ʈ�� �̾ƿ�;;
if($is_admin) {
	$_dbTimeStart = getmicrotime();
	$board_result=mysql_query("select no,name from $admin_table where no!='$setup[no]'");
	$_dbTime += getmicrotime()-$_dbTimeStart;
}

/***************************************************************************
* ��Ų���� ����� ������ ����
**************************************************************************/

$print_page="";
$show_page_num=$setup[page_num]; // �ѹ��� ���� ������ ����
$start_page=(int)(($page-1)/$show_page_num)*$show_page_num;
$i=1;

$a_1_prev_page= "<Zeroboard ";
$a_1_next_page= "<Zeroboard ";
$a_prev_page = "<Zeroboard ";
$a_next_page = "<Zeroboard ";

if($page>1) $a_1_prev_page="<a onfocus=blur() href='$PHP_SELF?id=$id&page=".($page-1)."&select_arrange=$select_arrange&desc=$desc&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&sn1=$sn1&divpage=$divpage'>";

if($page<$total_page) $a_1_next_page="<a onfocus=blur() href='$PHP_SELF?id=$id&page=".($page+1)."&select_arrange=$select_arrange&desc=$desc&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&sn1=$sn1&divpage=$divpage'>";

if($page>$show_page_num) {
	$prev_page=$start_page;
	$a_prev_page="<a onfocus=blur() href='$PHP_SELF?id=$id&page=$prev_page&select_arrange=$select_arrange&desc=$desc&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&sn1=$sn1&divpage=$divpage'>";
	$print_page.="<a onfocus=blur() href='$PHP_SELF?id=$id&page=1&select_arrange=$select_arrange&desc=$desc&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&sn1=$sn1&divpage=$divpage'><font style=font-size:9pt>[1]</a><font style=font-size:9pt>..";
	$prev_page_exists = true;
	}

while($i+$start_page<=$total_page&&$i<=$show_page_num) {
	$move_page=$i+$start_page;
	if($page==$move_page) $print_page.=" <font style=font-size:9pt><b>$move_page</b> ";
	else $print_page.="<a onfocus=blur() href='$PHP_SELF?id=$id&page=$move_page&select_arrange=$select_arrange&desc=$desc&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&sn1=$sn1&divpage=$divpage'><font style=font-size:9pt>[$move_page]</a>";
	$i++;
}

if($total_page>$move_page) {
	$next_page=$move_page+1;
	$a_next_page="<a onfocus=blur() href='$PHP_SELF?id=$id&page=$next_page&select_arrange=$select_arrange&desc=$desc&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&sn1=$sn1&divpage=$divpage'>";
	$print_page.="<font style=font-size:9pt>..<a onfocus=blur() href='$PHP_SELF?id=$id&page=$total_page&select_arrange=$select_arrange&desc=$desc&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&sn1=$sn1&divpage=$divpage'><font style=font-size:9pt>[$total_page]</a>";
	$next_page_exists = true;
}

// �˻��� Divsion ������ �̵� ǥ��
if($use_division) {
	if($prevdivpage&&!$prev_page_exists) $a_div_prev_page="<a onfocus=blur() href='$PHP_SELF?id=$id&&select_arrange=$select_arrange&desc=$desc&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&sn1=$sn1&divpage=$prevdivpage'>[���� �˻�]</a>...";
	if($nextdivpage&&!$next_page_exists) $a_div_next_page="...<a onfocus=blur() href='$PHP_SELF?id=$id&&select_arrange=$select_arrange&desc=$desc&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&sn1=$sn1&divpage=$nextdivpage'>[��� �˻�]</a>";
	$print_page = $a_div_prev_page.$print_page.$a_div_next_page;

}

/***************************************************************************
* ���� ��ũ�� �̸� �����ϴ� �κ�
**************************************************************************/

// �۾����ư
if($is_admin||$member[level]<=$setup[grant_write]) $a_write="<a onfocus=blur() href='write.php?$href$sort&no=$no&mode=write&sn1=$sn1&divpage=$divpage'>"; else $a_write="<Zeroboard ";

// ��� ��ư
if($is_admin||$member[level]<=$setup[grant_list]) $a_list="<a onfocus=blur() href='$PHP_SELF?id=$id&page=$page&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&prev_no=$no&sn1=$sn1&divpage=$divpage'>"; else $a_list="<Zeroboard ";

// ��ҹ�ư
$a_cancel="<a onfocus=blur() href='$PHP_SELF?id=$id'>";


// ���� ��ư�� ��� $desc�� ������ ��ȯ
if($desc=="desc") $t_desc="asc"; else $t_desc="desc";

// ��ȣ ����
$a_no="<a onfocus=blur() href='$PHP_SELF?$href&select_arrange=headnum&desc=$t_desc'>";

// ���� ����
$a_subject="<a onfocus=blur() href='$PHP_SELF?$href&select_arrange=subject&desc=$t_desc'>";

// �̸� ����
$a_name="<a onfocus=blur() href='$PHP_SELF?$href&select_arrange=name&desc=$t_desc'>";

// ��ȸ�� ����
$a_hit="<a onfocus=blur() href='$PHP_SELF?$href&select_arrange=hit&desc=$t_desc'>";

// ��õ�� ����
$a_vote="<a onfocus=blur() href='$PHP_SELF?$href&select_arrange=vote&desc=$t_desc'>";

// ���ں� ����
$a_date="<a onfocus=blur() href='$PHP_SELF?$href&select_arrange=reg_date&desc=$t_desc'>";

// ù��° �׸��� �ٿ�ε� ����
$a_download1="<a onfocus=blur() href='$PHP_SELF?$href&select_arrange=download1&desc=$t_desc'>";

// �ι�° �׸��� �ٿ�ε� ����
$a_download2="<a onfocus=blur() href='$PHP_SELF?$href&select_arrange=download2&desc=$t_desc'>";

/***************************************************************************
* ������ ����Ÿ�� ����ϴ� �κ�
**************************************************************************/

// ���� ���õ� ����Ÿ�� ������, �� $no �� ������ $_view_included ���� True�� ��.
if($no&&$setup[use_alllist])
	$_view_included = true;

// ��� ���
$_skinTimeStart = getmicrotime();
head("onload=unlock2() onunload=hideImageBox2()","script_list.php");

// $_view_included ������ True �� �� �߰� ��ũ��Ʈ ����
if($_view_included) {
	if($setup[skinname] != "ruvin_cubic_gu")
		include "script/script_comment.php";
} elseif($setup[skinname] == "ruvin_cubic_gu")
	include "script/script_write.php";

// ��� ��Ȳ �κ� ���
include "$dir/setup.php";
$_skinTime += getmicrotime()-$_skinTimeStart;

// ���� ���õ� ����Ÿ�� ������, �� $no �� ������ ����Ÿ ������
if($_view_included)
	include "view.php";

// ����Ʈ�� ��� �κ� ���
$_skinTimeStart = getmicrotime();
include $dir."/list_head.php";
$_skinTime += getmicrotime()-$_skinTimeStart;

// �����ȣ�� ����
$loop_number=$total-($page-1)*$page_num;
if($setup[use_alllist]&&!$prev_no) $prev_no=$no;

// ������ ����Ÿ��ŭ �����
while($data = @mysql_fetch_array($notice_result)) {
	list_check(&$data);
	$_skinTimeStart = getmicrotime();
	include $dir."/list_notice.php";
	$_skinTime += getmicrotime()-$_skinTimeStart;
}

while($data=@mysql_fetch_array($result)) {
	list_check(&$data);
	$_skinTimeStart = getmicrotime();
	include $dir."/list_main.php";
	$_skinTime += getmicrotime()-$_skinTimeStart;
	$loop_number--;
}

if($check2) {
	while($data=@mysql_fetch_array($result2)) {
		list_check(&$data);
		$_skinTimeStart = getmicrotime();
		include $dir."/list_main.php";
		$_skinTime += getmicrotime()-$_skinTimeStart;
		$loop_number--;
	}
}

// ������ �κ� ����ϴ� �κ�;;
$_skinTimeStart = getmicrotime();
include $dir."/list_foot.php";
$_skinTime += getmicrotime()-$_skinTimeStart;

if($zbLayer) {
	$_skinTimeStart = getmicrotime();
	echo "\n<script>".$zbLayer."\n</script>";
	unset($zbLayer);
	$_skinTime += getmicrotime()-$_skinTimeStart;
}

foot();
?>