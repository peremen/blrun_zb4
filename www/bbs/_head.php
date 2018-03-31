<?
/***************************************************************************
* 여러번 호출시 에러 발생 금지
**************************************************************************/
if(defined("_head_php_excuted")) return;
define("_head_php_excuted",true);

/***************************************************************************
* 기본 라이브러리 include
**************************************************************************/

// 라이브러리 함수 파일 include
include "lib.php";

/***************************************************************************
* 현재 _head.php를 호출하는 파일이 게시판 관련 파일인지 검사
**************************************************************************/
$_zb_file_list = array("apply_vote.php","comment.php","comment_ok.php","comment_modify.php","comment_modify_ok.php","del_comment.php","del_comment_ok.php","delete.php","download.php","download_c.php","list_all.php","view.php","vote.php","write.php","write_ok.php","zboard.php","image_box.php");
$_zb_c = count($_zb_file_list);
for($i=0;$i<$_zb_c;$i++) {
	if(preg_match("/".$_zb_file_list[$i]."/i",$PHP_SELF)) { $_zboardis = TRUE; break; }
	else $_zboardis = FALSE;
}

// SyntaxHighlighter 코드 종류 변수
$code=array("applescript","as3","bash","cf","csharp","cpp","css","delphi","diff","erl","groovy","js","java","jfx","perl","php","plain","ps","py","ruby","scss","scala","sql","vb","html");

// 리스트 체크 함수 파일 include
if($_zboardis) include "include/list_check.php";

/***************************************************************************
* 기본 설정 체크
**************************************************************************/

// 게시판 $id 체크
if(!$id&&$_zboardis) Error("게시판 이름을 지정해 주셔야 합니다.<br><br>예) zboard.php?id=이름",""); // 게시판 이름 체크

/***************************************************************************
* DB 연결하여 기본 데이타 추출
**************************************************************************/
// DB 연결
if(!$connect) $connect=dbConn();

// 멤버 정보 구해오기;;; 멤버가 있을때
$_dbTimeStart = getmicrotime();
$member=member_info();
$_dbTime += getmicrotime()-$_dbTimeStart;

/***************************************************************************
* 현재 _head.php를 불러오는 파일이 게시판일경우에 체크 하는 항목들
**************************************************************************/
if($_zboardis) {

	// 게시판 설정 읽어 오기
	$_dbTimeStart = getmicrotime();
	$setup = get_table_attrib($id);
	if(!$setup[name]) Error("생성되지 않은 게시판입니다.<br><br>게시판을 생성후 사용하십시요",""); // 설정되지 않은 게시판

	// 현재 게시판의 그룹의 설정 읽어 오기
	if($_zboardis) $group=group_info($setup[group_no]);
	$_dbTime += getmicrotime()-$_dbTimeStart;

	// 현재 로그인되어 있는 멤버가 전체, 그룹관리자, 게시판관리자인지 검사
	if($member[is_admin]==1||($member[is_admin]==2&&$member[group_no]==$setup[group_no])||check_board_master($member, $setup[no])) $is_admin=1; else $is_admin="";

	// 현재 그룹이 폐쇄그룹이고 로그인한 멤버가 비멤버일때 에러표시
	if($group[is_open]==0&&!$is_admin&&$member[group_no]!=$setup[group_no]) Error("공개 되어 있지 않습니다");

	// 접근 금지 아이피인 경우 금지하기;;;
	if(!$is_admin) check_blockip();

	// 관리자일경우에는 무조건 바구니 기능 활성화 시킴 (게시물 정리를 위해서)
	if($is_admin) $setup[use_cart]=1;

	// 스킨 디렉토리 : $dir 이라는 변수는 계속해서 스킨경로 파일로
	$dir="skin/".$setup[skinname];

	// 게시판의 가로크기 설정
	$width=$setup[table_width];

	// 카테고리 읽어오기
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
	// write.php가 아닐때 검색갯수 및 query 정리
	/////////////////////////////////////////////
	if(!preg_match("/write.php/i",$PHP_SELF)) {

		// Division의 현황을 체크
		$_dbTimeStart = getmicrotime();
		$division_result=mysql_query("select * from $t_division"."_$id where num>0 order by division desc");
		$_dbTime += getmicrotime()-$_dbTimeStart;
		$total_division=mysql_num_rows($division_result);
		$sum=0;
		$division=0;

		// division 페이지가 없으면 설정 (검색시 사용하는 단위페이지)
		if(!$divpage) $divpage = $total_division;
		if($divpage<$total_division) $prevdivpage = $divpage +1;
		if($divpage>1) $nextdivpage = $divpage -1;

		// 정렬 기능 : $select_arrange 는 정렬 필드, $desc 는 정렬, 역정렬시
		if(!$select_arrange) $select_arrange="headnum";
		if(!$desc) $desc="asc";

		// 답글 목록에 나타나지 않게 설정하였을때 (게시판 설정시 use_showreply가 체크 되었을때)
		if(!$setup[use_showreply]) if(!$s_que) $s_que=" arrangenum=0 "; else $s_que.=" and arrangenum=0 ";

		// 카테고리 : 카테고리가 있을때 category를 검색 조건에 넣음
		//if($category) if(!$s_que) $s_que=" category='$category' "; else $s_que.=" and category='$category'";
		if($category) {
			if(!$s_que) $s_que="( category='$category' and headnum>-2000000000 )"; else $s_que.=" and category='$category' and headnum>-2000000000";
		}

		// 검색 기능 체크, $sn 이름 $ss 제목 $sc 내용 검사, $keyword 내용;;
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
		if(!isblank($keyword)) {
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

		// 검색 조건이 있을때 앞에 where 문 추가
		if($s_que) $s_que=" where ".$s_que;

		// 전체개수를 구함 : 검색어가 있을때는 따로 전체 갯수를 구함, 아니면 게시판에 있는것으로
		if($s_que) {
			// 카테고리만 있을 경우
			if(!$keyword&&$setup[use_showreply]) {
				$total=$_category_data[$category];

			// 검색어나 답글없음이 체크되어 있을경우
			} else {
				$use_division = true;
				$s_que = str_replace("where","where division='$divpage' and headnum<0 and headnum>-2000000000 and ", $s_que);
				$_dbTimeStart = getmicrotime();
				if($sm=="on") {
					//댓글 검색이면
					$sql="select $t_board"."_$id.no from $t_board"."_$id left join $t_comment"."_$id on parent=$t_board"."_$id.no $s_que group by $t_board"."_$id.no having count($t_board"."_$id.no)>=1";
					//댓글에 검색어가 들어있는 중복되지 않은 본문갯수를 구한다.
					$cnt=0;
					$rs=mysql_query($sql);

					if($rs) //검색인 경우 레코드수 구함
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

		// 페이지 관련 변수값 정함
		$page_num=$setup[memo_num];
		if(!$page) $page=1; // 만약 $page라는 변수에 값이 없으면 임의로 1 페이지 입력

		$total_page=(int)(($total-1)/$page_num)+1; // 전체 페이지 구함

		if($page>$total_page) $page=$total_page; // 페이지가 전체 페이지보다 크면 페이지 번호 바꿈

		$start_num=($page-1)*$page_num; // 페이지 수에 따른 출력시 첫번째가 될 글의 번호 구함
	}

	// 링크 설정
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

	// 카테고리를 나타나게 하는 변수
	if(!$setup[use_category]) {
		$hide_category_start="<!--";
		$hide_category_end="-->";
	}

	// 바구니를 나타나게 하는 변수
	if($is_admin||$setup[use_cart]) {
		$a_cart="<a onfocus=blur() href='javascript:reverse()'>";
	} else {
		$hide_cart_start="<!--";
		$hide_cart_end="-->";
		$a_cart="";
	}

	// 모두삭제 버튼
	if($is_admin) $a_delete_all="<a onfocus=blur() href='javascript:delete_all()'>"; else $a_delete_all="<Zeroboard ";

	// 통계버튼
	if($setup[use_status]) $a_status="<a onfocus=blur() href=javascript:void(window.open('stat.php?id=$id','status','width=400,height=400,statusbar=no,toolbar=no,resizable=no'))>"; else $a_status="<Zeroboard ";
	$a_status="<Zeroboard ";

	// Setup 버튼
	if($is_admin) $a_setup="<a onfocus=blur() href='admin2.php?exec=view_board&no=$setup[no]&group_no=$setup[group_no]&exec2=modify' target=_blank>"; else $a_setup="<Zeroboard ";

	// 현재 멤버의 새 쪽지가 있을때 아이콘 변경;;
	if($member[no]) {
		if($member[new_memo]) {
			$member_memo_icon="<img name=memozzz src=$dir/member_memo_on.gif border=0 align=absmiddle>";
			$memo_on_sound="<embed src='$memo_swf' loop='false' width='1' height='1'></embed>";
		} else $member_memo_icon="<img src=$dir/member_memo_off.gif border=0 align=absmiddle>";
	} else $member_memo_icon="";

}

/***************************************************************************
* 각종 기본 버튼 설정
**************************************************************************/

// 로그인, 아웃, 회원 정보 수정, 쪽지 메뉴 버튼

$s_url = $REQUEST_URI;
if($id&&!preg_match("/".$id."/i", $s_url)) {
	if(preg_match("/\?/i",$s_url)) $s_url = $s_url . "&id=$id";
	else $s_url = $s_url . "?id=$id";
}
$s_url = urlencode($s_url);

if(!$member[no]) {
	// 토큰 초기화
	$_SESSION['_token']='';
	setCookie("token","",0,"/","");

	$a_login="<a onfocus=blur() href='".$_zb_url."login.php?$href$sort&s_url=$s_url'>";
	$a_logout="<Zeroboard ";
	$a_member_modify="<Zeroboard ";
	$a_member_memo="<Zeroboard ";
} else {
	// email IP 표식 불러와 처리
	unset($c_match);
	if(preg_match("#\|\|\|([0-9.]{1,})$#",$member[email],$c_match)) {
		$tokenID = $c_match[1];
	}
	if($_SESSION['_token']!=$_COOKIE['token']||$tokenID!=$REMOTE_ADDR) Error("세션 하이재킹은 허용되지 않습니다.<br>세션이 해킹되어 해커가 로그인을 시도하고 있으니 브라우저의 쿠키를 지우고 재접속 바랍니다.<br>그 다음 해커가 계정을 사용하기 전에 즉시 비밀번호를 바꿔야 합니다!");
	$a_login="<Zeroboard ";
	$a_logout="<a onfocus=blur() href='".$_zb_url."logout.php?$href$sort&s_url=$s_url'>";
	if($member[user_id]!="sprdrg") {
	$a_member_modify="<a onfocus=blur() href=# onclick=\"window.open('".$_zb_url."member_modify.php?group_no=$member[group_no]','zbMemberModify','width=560,height=590,toolbars=no,resizable=yes,scrollbars=yes')\">";
	} else $a_member_modify="<Zeroboard ";
	$a_member_memo="<a onfocus=blur() href=\"javascript:void(window.open('".$_zb_url."member_memo.php','member_memo','width=450,height=500,status=no,toolbar=no,resizable=yes,scrollbars=yes'))\">";
}

// 회원가입버튼;;
if(!$member[no]&&$group[use_join]) $a_member_join="<a onfocus=blur() href=# onclick=\"window.open('".$_zb_url."member_join.php?group_no=$setup[group_no]','zbMemberJoin','width=560,height=590,toolbars=no,resizable=yes,scrollbars=yes')\">"; else $a_member_join="<Zeroboard ";
?>
