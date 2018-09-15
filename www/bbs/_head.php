<?
/***************************************************************************
* ������ ȣ��� ���� �߻� ����
**************************************************************************/
if(defined("_head_php_excuted")) return;
define("_head_php_excuted",true);

/***************************************************************************
* �⺻ ���̺귯�� include
**************************************************************************/

// ���̺귯�� �Լ� ���� include
include "lib.php";

/***************************************************************************
* ���� _head.php�� ȣ���ϴ� ������ �Խ��� ���� �������� �˻�
**************************************************************************/
$_zb_file_list = array("apply_vote.php","comment.php","comment_ok.php","comment_modify.php","comment_modify_ok.php","del_comment.php","del_comment_ok.php","delete.php","download.php","download_c.php","list_all.php","view.php","vote.php","write.php","write_ok.php","zboard.php","image_box.php");
$_zb_c = count($_zb_file_list);
for($i=0;$i<$_zb_c;$i++) {
	if(preg_match("/".$_zb_file_list[$i]."/i",$PHP_SELF)) { $_zboardis = TRUE; break; }
	else $_zboardis = FALSE;
}

// SyntaxHighlighter �ڵ� ���� ����
$code=array("applescript","as3","bash","cf","csharp","cpp","css","delphi","diff","erl","groovy","js","java","jfx","perl","php","plain","ps","py","ruby","scss","scala","sql","vb","html");

// ����Ʈ üũ �Լ� ���� include
if($_zboardis) include "include/list_check.php";

/***************************************************************************
* �⺻ ���� üũ
**************************************************************************/

// �Խ��� $id üũ
if(!$id&&$_zboardis) Error("�Խ��� �̸��� ������ �ּž� �մϴ�.<br><br>��) zboard.php?id=�̸�",""); // �Խ��� �̸� üũ

/***************************************************************************
* DB �����Ͽ� �⺻ ����Ÿ ����
**************************************************************************/
// DB ����
if(!$connect) $connect=dbConn();

// ��� ���� ���ؿ���;;; ����� ������
$_dbTimeStart = getmicrotime();
$member=member_info();
$_dbTime += getmicrotime()-$_dbTimeStart;

/***************************************************************************
* ���� _head.php�� �ҷ����� ������ �Խ����ϰ�쿡 üũ �ϴ� �׸��
**************************************************************************/
if($_zboardis) {

	// �Խ��� ���� �о� ����
	$_dbTimeStart = getmicrotime();
	$setup = get_table_attrib($id);
	if(!$setup[name]) Error("�������� ���� �Խ����Դϴ�.<br><br>�Խ����� ������ ����Ͻʽÿ�",""); // �������� ���� �Խ���

	// ���� �Խ����� �׷��� ���� �о� ����
	if($_zboardis) $group=group_info($setup[group_no]);
	$_dbTime += getmicrotime()-$_dbTimeStart;

	// ���� �α��εǾ� �ִ� ����� ��ü, �׷������, �Խ��ǰ��������� �˻�
	if($member[is_admin]==1||($member[is_admin]==2&&$member[group_no]==$setup[group_no])||check_board_master($member, $setup[no])) $is_admin=1; else $is_admin="";

	// ���� �׷��� ���׷��̰� �α����� ����� �����϶� ����ǥ��
	if($group[is_open]==0&&!$is_admin&&$member[group_no]!=$setup[group_no]) Error("���� �Ǿ� ���� �ʽ��ϴ�");

	// ���� ���� �������� ��� �����ϱ�;;;
	if(!$is_admin) check_blockip();

	// �������ϰ�쿡�� ������ �ٱ��� ��� Ȱ��ȭ ��Ŵ (�Խù� ������ ���ؼ�)
	if($is_admin) $setup[use_cart]=1;

	// ��Ų ���丮 : $dir �̶�� ������ ����ؼ� ��Ų��� ���Ϸ�
	$dir="skin/".$setup[skinname];

	// �Խ����� ����ũ�� ����
	$width=$setup[table_width];

	// ī�װ� �о����
	if($setup[use_category]) {
		$_dbTimeStart = getmicrotime();
		$result=mysql_query("select * from $t_category"."_$id order by no");
		$_dbTime += getmicrotime()-$_dbTimeStart;
		$a_category="<select name=category onchange=category_change(this)><option value=''>Category</option>";
		while($data=mysql_fetch_array($result)) {
				$category_num_c[]=$data[no];
				$category_name_c[]=$data[name];
				$category_n_c[]=$data[num];
				$category_data[$data[no]]=$data[name];
				$_category_data[$data[no]]=$data[num];
				if($category==$data[no]) $a_category.="<option value=$data[no] selected>$data[name]</option>";
				else $a_category.="<option value=$data[no]>$data[name]</option>";
		}
		$a_category.="</select>";
	} else {
		$category="";
	}

	/////////////////////////////////////////////
	// write.php�� �ƴҶ� �˻����� �� query ����
	/////////////////////////////////////////////
	if(!preg_match("/write.php/i",$PHP_SELF)) {

		// Division�� ��Ȳ�� üũ
		$_dbTimeStart = getmicrotime();
		$division_result=mysql_query("select * from $t_division"."_$id where num>0 order by division desc");
		$_dbTime += getmicrotime()-$_dbTimeStart;
		$total_division=mysql_num_rows($division_result);
		$sum=0;
		$division=0;

		// division �������� ������ ���� (�˻��� ����ϴ� ����������)
		if(!$divpage) $divpage = $total_division;
		if($divpage<$total_division) $prevdivpage = $divpage +1;
		if($divpage>1) $nextdivpage = $divpage -1;

		// ���� ��� : $select_arrange �� ���� �ʵ�, $desc �� ����, �����Ľ�
		if(!$select_arrange) $select_arrange="headnum";
		if(!$desc) $desc="asc";

		// ��� ��Ͽ� ��Ÿ���� �ʰ� �����Ͽ����� (�Խ��� ������ use_showreply�� üũ �Ǿ�����)
		if(!$setup[use_showreply]) if(!$s_que) $s_que=" arrangenum=0 "; else $s_que.=" and arrangenum=0 ";

		// ī�װ� : ī�װ��� ������ category�� �˻� ���ǿ� ����
		//if($category) if(!$s_que) $s_que=" category='$category' "; else $s_que.=" and category='$category'";
		if($category) {
			if(!$s_que) $s_que="( category='$category' and headnum>-2000000000 )"; else $s_que.=" and category='$category' and headnum>-2000000000";
		}

		// �˻� ��� üũ, $sn �̸� $ss ���� $sc ���� �˻�, $keyword ����;;
		$keyword=stripslashes($keyword);
		$keyword=str_replace("`","",$keyword);
		$keyword=str_replace("\"","",$keyword);
		$keyword=str_replace("'","",$keyword);
		if(!$sn) $sn="off";
		if(!$ss) $ss="off";
		if(!$sc) $sc="off";
		if(!$sm) $sm="off";
		if($sc=="off"&&$sn=="off"&&$ss=="off"&&$sm=="off") {
			$sc="on";
			$ss="on";
			$sm="on";
		}
		if(!isspace($keyword)) {
			$keyword=addslashes($keyword);
			if($sm=="on") {
				$t_s_que =" $t_comment"."_$id.memo like '%$keyword%' ";
				if(!$sn1) {
					if($sn=="on") $t_s_que.=" or $t_board"."_$id.name like '%$keyword%' or $t_comment"."_$id.name like '%$keyword%' ";
				} else {
					if($sn=="on") $t_s_que.=" or $t_board"."_$id.name = '$keyword' or $t_comment"."_$id.name = '$keyword' ";
				}
				if($ss=="on") $t_s_que.=" or subject like '%$keyword%' ";
				if($sc=="on") $t_s_que.=" or $t_board"."_$id.memo like '%$keyword%' ";
				if($s_que) $s_que.=" and ( ".$t_s_que." ) ";
				else $s_que.= " ( ".$t_s_que." ) ";
			} else {
				if(!$sn1) {
					if($sn=="on"&&$t_s_que) $t_s_que.=" or name like '%$keyword%' ";
					elseif($sn=="on") $t_s_que.=" name like '%$keyword%' ";
				} else {
					if($sn=="on"&&$t_s_que) $t_s_que.=" or name = '$keyword' ";
					elseif($sn=="on") $t_s_que.=" name = '$keyword' ";
				}
				if($ss=="on"&&$t_s_que) $t_s_que.=" or subject like '%$keyword%' "; elseif($ss=="on") $t_s_que.=" subject like '%$keyword%' ";
				if($sc=="on"&&$t_s_que) $t_s_que.=" or memo like '%$keyword%' "; elseif($sc=="on") $t_s_que.=" memo like '%$keyword%' ";
				if($s_que) $s_que.=" and ( ".$t_s_que." ) ";
				else $s_que.= " ( ".$t_s_que." ) ";
			}
			$keyword=stripslashes($keyword);
		}

		// �˻� ������ ������ �տ� where �� �߰�
		if($s_que) $s_que=" where ".$s_que;

		// ��ü������ ���� : �˻�� �������� ���� ��ü ������ ����, �ƴϸ� �Խ��ǿ� �ִ°�����
		if($s_que) {
			// ī�װ��� ���� ���
			if(!$keyword&&$setup[use_showreply]) {
				$total=$_category_data[$category];

			// �˻�� ��۾����� üũ�Ǿ� �������
			} else {
				$use_division = true;
				$s_que = str_replace("where","where division='$divpage' and headnum<0 and headnum>-2000000000 and ", $s_que);
				$_dbTimeStart = getmicrotime();
				if($sm=="on") {
					//��� �˻��̸�
					$sql="select $t_board"."_$id.no from $t_board"."_$id left join $t_comment"."_$id on parent=$t_board"."_$id.no $s_que group by $t_board"."_$id.no having count($t_board"."_$id.no)>=1";
					//��ۿ� �˻�� ����ִ� �ߺ����� ���� ���������� ���Ѵ�.
					$cnt=0;
					$rs=mysql_query($sql);

					if($rs) //�˻��� ��� ���ڵ�� ����
					{
						while($data=mysql_fetch_array($rs))
						{
							$cnt=$cnt+1;
						}
						$total=$cnt;
					} else {
						$total=0;
					}

				} else {
					$temp=mysql_fetch_array(mysql_query("select count(*) from $t_board"."_$id $s_que ",$connect));
					$total=$temp[0];
				}
				$_dbTime += getmicrotime()-$_dbTimeStart;
			}
		} else $total=$setup[total_article];

		// ������ ���� ������ ����
		$page_num=$setup[memo_num];
		if(!$page) $page=1; // ���� $page��� ������ ���� ������ ���Ƿ� 1 ������ �Է�

		$total_page=(int)(($total-1)/$page_num)+1; // ��ü ������ ����

		if($page>$total_page) $page=$total_page; // �������� ��ü ���������� ũ�� ������ ��ȣ �ٲ�

		$start_num=($page-1)*$page_num; // ������ ���� ���� ��½� ù��°�� �� ���� ��ȣ ����
	}

	// ��ũ ����
	unset($href);

	$href="id=$id&page=$page&sn1=$sn1&divpage=$divpage";
	if($category) $href.="&category=$category";
	if($sn) $href.="&sn=$sn";
	if($ss) $href.="&ss=$ss";
	if($sc) $href.="&sc=$sc";
	if($sm) $href.="&sm=$sm";
	if($prev_num) $href.="&prev_num=$prev_num";
	if($keyword) {
		$href2=$href;
		$href.="&keyword=$keyword";
	}

	unset($sort);
	if($select_arrange) $sort.="&select_arrange=$select_arrange";
	if($desc) $sort.="&desc=$desc";

	// ī�װ��� ��Ÿ���� �ϴ� ����
	if(!$setup[use_category]) {
		$hide_category_start="<!--";
		$hide_category_end="-->";
	}

	// �ٱ��ϸ� ��Ÿ���� �ϴ� ����
	if($is_admin||$setup[use_cart]) {
		$a_cart="<a onfocus=blur() href='javascript:reverse()'>";
	} else {
		$hide_cart_start="<!--";
		$hide_cart_end="-->";
		$a_cart="";
	}

	// ��λ��� ��ư
	if($is_admin) $a_delete_all="<a onfocus=blur() href='javascript:delete_all()'>"; else $a_delete_all="<Zeroboard ";

	// ����ư
	if($setup[use_status]) $a_status="<a onfocus=blur() href=javascript:void(window.open('stat.php?id=$id','status','width=400,height=400,statusbar=no,toolbar=no,resizable=no'))>"; else $a_status="<Zeroboard ";
	$a_status="<Zeroboard ";

	// Setup ��ư
	if($is_admin) $a_setup="<a onfocus=blur() href='admin2.php?exec=view_board&no=$setup[no]&group_no=$setup[group_no]&exec2=modify' target=_blank>"; else $a_setup="<Zeroboard ";

	// ���� ����� �� ������ ������ ������ ����;;
	if($member[no]) {
		if($member[new_memo]) {
			$member_memo_icon="<img name=memozzz src=$dir/member_memo_on.gif border=0 align=absmiddle>";
			$memo_on_sound="<embed src='$memo_swf' loop='false' width='1' height='1'></embed>";
		} else $member_memo_icon="<img src=$dir/member_memo_off.gif border=0 align=absmiddle>";
	} else $member_memo_icon="";

}

/***************************************************************************
* ���� �⺻ ��ư ����
**************************************************************************/

// �α���, �ƿ�, ȸ�� ���� ����, ���� �޴� ��ư

$s_url = $REQUEST_URI;
if($id&&!preg_match("/".$id."/i", $s_url)) {
	if(preg_match("/\?/i",$s_url)) $s_url = $s_url . "&id=$id";
	else $s_url = $s_url . "?id=$id";
}
$s_url = urlencode($s_url);

if(!$member[no]) {
	// ��ū �ʱ�ȭ
	$_SESSION['_token']='';
	setCookie("token","",0,"/","");

	$a_login="<a onfocus=blur() href='".$_zb_url."login.php?$href$sort&s_url=$s_url'>";
	$a_logout="<Zeroboard ";
	$a_member_modify="<Zeroboard ";
	$a_member_memo="<Zeroboard ";
} else {
	// email IP ǥ�� �ҷ��� ó��
	unset($c_match);
	if(preg_match("#\|\|\|([0-9.]{1,})$#",$member[email],$c_match)) {
		$tokenID = $c_match[1];
	}
	if($_SESSION['_token']!=$_COOKIE['token']||$tokenID!=$REMOTE_ADDR) Error("���� ������ŷ�� ������ �ʽ��ϴ�.<br>������ ��ŷ�Ǿ� ��Ŀ�� �α����� �õ��ϰ� ������ �������� ��Ű�� ����� ������ �ٶ��ϴ�.<br>�� ���� ��Ŀ�� ������ ����ϱ� ���� ��� ��й�ȣ�� �ٲ�� �մϴ�!");
	$a_login="<Zeroboard ";
	$a_logout="<a onfocus=blur() href='".$_zb_url."logout.php?$href$sort&s_url=$s_url'>";
	if($member[user_id]!="sprdrg") {
	$a_member_modify="<a onfocus=blur() href=# onclick=\"window.open('".$_zb_url."member_modify.php?group_no=$member[group_no]','zbMemberModify','width=560,height=590,toolbars=no,resizable=yes,scrollbars=yes')\">";
	} else $a_member_modify="<Zeroboard ";
	$a_member_memo="<a onfocus=blur() href=\"javascript:void(window.open('".$_zb_url."member_memo.php','member_memo','width=450,height=500,status=no,toolbar=no,resizable=yes,scrollbars=yes'))\">";
}

// ȸ�����Թ�ư;;
if(!$member[no]&&$group[use_join]) $a_member_join="<a onfocus=blur() href=# onclick=\"window.open('".$_zb_url."member_join.php?group_no=$setup[group_no]','zbMemberJoin','width=560,height=590,toolbars=no,resizable=yes,scrollbars=yes')\">"; else $a_member_join="<Zeroboard ";
?>