<?
/*///////////////////////////////////////////////////////////////

	프로그램명	: rss.php
	버전		: 1.0
	작성자		: 바람돌이
	최초작성일	: 2006.05.26

	*** 설명 ***

	제로보드를 RSS 서비스로 제공하는 패치

	1. RSS 2.0 Specification 지원

	*** 변경 할 부분 ***
	$_zb_url		: 제로보드 주소
	$max_count		: RSS를 제공할 컨텐츠 개수
	$webMaster		: 관리자 메일주소
	
	$title 			: RSS 읽었을때 Title입니다. 뒤에 게시판 이름이 추가됩니다.
	$des			: 해당 게시판의 설명이 들어갑니다.

	자신에게 맞게 사용하세요. 

	* 사용방법
	두 파일을 제로보드 폴더내에 복사하신뒤 rss.php 에서 설정해주실 부분만 수정하시면 됩니다.
	그리고 "http://도메인/제로보드폴더/rss.php?id=게시판주소" 공개하시면 됩니다.

	* 주의 사항
	아직 시간이 없어서 비밀글등의 관리는 하지 않았습니다.
	단순히 무식하게 게시판의 글을 순서대로 읽어오기에 주의해야 합니다.

	제가 나중에 더 좋게 수정해서 올릴 수도 있지만, 누구나 수정해서 올려주시면 감사하겠습니다.

	* 참고 자료
	RSSWriter.class 파일은 www.ihelpers.co.kr의 손상모님의 강좌에서 발췌했습니다.
	손상모님께 허락을 받고 사용한 것은 아니구요. 공개된 강의 자료인 만큼 
	저와 같은 오픈 소스 철학을 가지신 분이라 믿고 사용했습니다.이해해주시길... @^-^@

	* 개인평
	아직 추가적인 개선사항이 많습니다. 
	비밀글 처리, 검색 , 카테고리별 제공 등등 무수히 많은 가능성이 열려 있다고 봅니다. 

	* 사용 원칙
	개인적으로 오픈 소스 철학을 사랑합니다. 즉, 아무런 표시 없이 가져다 쓰시면 됩니다.
	다만 더 나은 소스로 수정하셨다면, 다 같이 공유해요~@^-^@ 
	마지막으로, 손상모님 감사합니다.

/////////////////////////////////////////////////////////////////*/
	$_zb_url = "http://www.blrun.net/bbs/";			//	제로보드 주소입니다.
	$_zb_path = "/home/hosting_users/blrun/www/bbs/";

	require "./RSSWriter.class.php";
	include $_zb_path."_head.php";
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////
	//
	// Administrator가 직접 작성해야 하는 부분입니다.
	//
	/////////////////////////////////////////////////////////////////////////////////////////////////////

	$max_count = 100;											//	최대 몇개의 게시물을 읽어올지 결정합니다.
	$webMaster = "blrun39@hanafos.com";			//	관리자 메일입니다.	
	
	$title 		= "네티즌 세상을 위하여 - ";	//	RSS 읽었을때 Title입니다. 뒤에 게시판 이름이 추가됩니다.
	$des		= "네티즌칼럼에 오신 것을 환영합니다! 우리 국민 모두가 주인인 세상, 우리 네티즌 모두가 참여하는 진정한 참여민주주의를 실현해 나갑시다. 이곳은 이런 모토에 관심있는 분들, 또 거기에 열성적으로 뜻을 같이할 분들을 위한 공간입니다. 본인이 운영하는 블로그나 칼럼이 있으시면 우리모두 서로 공유합시다. 좌우 빈 여백은 그것을 위한 공간입니다. 많은 참여바랍니다. $id 게시판입니다.";						//	해당 게시판의 설명이 들어갑니다.
	//////////   --- 여기까지 --- //////////////////////

	$id="clmn1";	
	$sql = "select * from $admin_table where name='$id'";
	$result = mysql_query($sql,$connect) or die ("SQL Error : ". mysql_error());
	
	while($row = mysql_fetch_array($result)){
		$title = $title.$row[title];
		$link_root  = $_zb_url."zboard.php?id=$id";
	}
	
	// RSS 출력
	$rss = new RSSWriter($title,$link_root,$des);
	$rss->setLanguage("ko-KO");
	$rss->setLastBuildDate(date("Y/m/d H:i:s"));
	$rss->setWebMaster($webMaster);

	$sql = "select * from $t_board"."_$id where is_secret=0 order by no desc";
	$result = mysql_query($sql,$connect) or die ("SQL Error : ". mysql_error());

	$count = 0;
	while($row = mysql_fetch_array($result)){
		$file1=""; $file2="";
		$link = sprintf("$link_root&no=%d" , $row[no]);

		// 카테고리 명을 받아옵니다.
		$sql1 = "select name from $t_category"."_$id where no = $row[category]";
		$result1 = mysql_query($sql1,$connect) or die ("SQL Error : ". mysql_error());
		
		$cate = mysql_fetch_array($result1);	
	
		// 만약 자료 파일이 있다면 같이 링크합니다.
		if($row[file_name1])
			$file1 = "file link 1 : <a href=$_zb_url".str_replace("%2F", "/", urlencode($row[file_name1]))." target=_blank> $row[s_file_name1]</a><br>";
		if($row[file_name2])
			$file2 = "file link 2 : <a href=$_zb_url".str_replace("%2F", "/", urlencode($row[file_name2]))." target=_blank> $row[s_file_name2]</a><br>";

		if($row[use_html]<2)
			$row[memo]=str_replace("\n","<br />",$row[memo]);

		$description = $file1.$file2."<br />".$row[memo]."<br /><br />";
		// rss의 setItem 인자들
		//	$title,$link,$description ="",$author = "",$pubDate ="",$category ="",
		//			$guid ="",$source ="",$comments ="",$enclosure =""
		$rss->setItem(stripslashes($row[subject]),$link,stripslashes($description),$row[name],date("Y/m/d H:i:s",$row[reg_date]),$cate[name]);
		if ($count++ > $max_count)
			break;
	}
	
	$rss->println();
	
	mysql_close($connect);
?>
