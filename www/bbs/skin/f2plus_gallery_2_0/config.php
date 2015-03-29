<?
$Thumbnail_small1="fs_".$data[reg_date].".jpg";
$Thumbnail_small2="ss_".$data[reg_date].".jpg";

$Thumbnail_large1="fl_".$data[reg_date].".jpg";
$Thumbnail_large2="sl_".$data[reg_date].".jpg";

if($_view_included==true){
	$imagePattern="#<img src\=\'data\/\w+?\/thumbnail\/([^/]+?)\/vXL_(.+?)\.(jpg|jpeg|png)\.(jpg)\'#i";
	$imagePattern2="#<img src\=\'icon\/member_image_box\/([^/]+?)\/(.+?)\.(gif|bmp)\'#i";
	if(preg_match_all($imagePattern,$data[memo],$out,PREG_SET_ORDER));
	else preg_match_all($imagePattern2,$data[memo],$out,PREG_SET_ORDER);

	//넘겨주는 out 변수 통일
	$out[0][1]=urldecode($out[0][2]);
	$out[1][1]=urldecode($out[1][2]);
	$out[0][2]=$out[0][3];
	$out[1][2]=$out[1][3];

	$iThumbnail_small1="fs_".$out[0][1].".jpg";
	$iThumbnail_small2="ss_".$out[1][1].".jpg";

	$iThumbnail_large1="fl_".$out[0][1].".jpg";
	$iThumbnail_large2="sl_".$out[1][1].".jpg";
}else{
	$imagePattern="#\[img\:(.+?)\.(jpg|jpeg|gif|png|bmp)\,#i";
	preg_match_all($imagePattern,$data[memo],$out,PREG_SET_ORDER);

	$iThumbnail_small1="fs_".$out[0][1].".jpg";
	$iThumbnail_small2="ss_".$out[1][1].".jpg";

	$iThumbnail_large1="fl_".$out[0][1].".jpg";
	$iThumbnail_large2="sl_".$out[1][1].".jpg";
}

// 외부 html <img> 태그 src url 추출
$imagePattern="#<img[^>]*src=[\\\']?[\\\"]?(http[s]?:\/\/[^>\\\'\\\"]+)[\\\']?[\\\"]?[^>]*>#i";
preg_match_all($imagePattern,$data[memo],$img,PREG_SET_ORDER);
for($i=0;$i<2;$i++)
	if(($mypos=strrpos($img[$i][1],"http://"))||($mypos=strrpos($img[$i][1],"https://")))
		$img[$i][1]=substr($img[$i][1],$mypos);
?>