<?
unset($prev_thumb);
unset($next_thumb);
unset($print_img1);
unset($print_img2);
unset($view_img1);
unset($view_img2);

if($Thumbnail_use=="on" && $Thumbnail_view=="on"){       //썸네일 사용시
	if($upload_image1){
		if(preg_match("#\.(jpg|jpeg|png)$#i",$data[file_name1])){
			if(!file_exists($Thumbnail_path.$view_large1)){
				thumbnail2($max_width_size,$data[file_name1],$Thumbnail_path.$view_large1);
			}
			$thumb_view1=$Thumbnail_url.$view_large1;
			$view_img1="<img src=$thumb_view1 border=0 name=zb_target_resize align=left class=shadow5>";
		}else {
			$view_img1=str_replace("<br>","",$upload_image1);
			$view_img1=preg_replace("#onclick=\"javascript\:[^>]+?(>)#i","align=left class=shadow5\\1",$view_img1);
		}
		$img_info1=@getimagesize($data[file_name1]);
		$img_info1[0]=$img_info1[0]+10;
		$img_info1[1]=$img_info1[1]+55;
		$print_img1="<a onclick=window.open('$dir/img_view.php?img=$data[file_name1]&width=$img_info1[0]&height=$img_info1[1]','view_info','width=0,height=0,toolbar=no,scrollbars=no','status=no') style='cursor:pointer'>";
	}
	if($upload_image2){
		if(preg_match("#\.(jpg|jpeg|png)$#i",$data[file_name2])){
			if(!file_exists($Thumbnail_path.$view_large2)){
				thumbnail2($max_width_size,$data[file_name2],$Thumbnail_path.$view_large2);
			}
			$thumb_view2=$Thumbnail_url.$view_large2;
			$view_img2="<img src=$thumb_view2 border=0 name=zb_target_resize align=left class=shadow5>";
		}else {
			$view_img2=str_replace("<br>","",$upload_image2);
			$view_img2=preg_replace("#onclick=\"javascript\:[^>]+?(>)#i","align=left class=shadow5\\1",$view_img2);
		}
		$img_info2=@getimagesize($data[file_name2]);
		$img_info2[0]=$img_info2[0]+10;
		$img_info2[1]=$img_info2[1]+55;
		$print_img2="<a onclick=window.open('$dir/img_view.php?img=$data[file_name2]&width=$img_info2[0]&height=$img_info2[1]','view_info','width=0,height=0,toolbar=no,scrollbars=no','status=no') style='cursor:pointer'>";
	}
	//이전 및 다음 데이터의 썸네일 정보를 읽어옴
	if(preg_match("#\.(jpg|jpeg|png)$#i",$prev_data[file_name1])){

		if(!file_exists($Thumbnail_path.$Prev_thumb_small1)){
			thumbnail($min_width_size,$prev_data[file_name1],$Thumbnail_path,$Prev_thumb_small1,3/2);
		}
		$prev_thumb=$Thumbnail_url.$Prev_thumb_large1;
	}
	elseif(preg_match("#\.(jpg|jpeg|png)$#i",$prev_data[file_name2])){

		if(!file_exists($Thumbnail_path.$Prev_thumb_small2)){
			thumbnail($min_width_size,$prev_data[file_name2],$Thumbnail_path,$Prev_thumb_small2,3/2);
		}
		$prev_thumb=$Thumbnail_url.$Prev_thumb_large2;
	}elseif(preg_match("#\.(gif|bmp)$#i",$prev_data[file_name1]))
		$prev_thumb=$prev_data[file_name1];
	elseif(preg_match("#\.(gif|bmp)$#i",$prev_data[file_name2]))
		$prev_thumb=$prev_data[file_name2];
	elseif($prev_data[no]) $prev_thumb=$dir."/images/no_image.gif";

	if(preg_match("#\.(jpg|jpeg|png)$#i",$next_data[file_name1])){

		if(!file_exists($Thumbnail_path.$Next_thumb_small1)){
			thumbnail($min_width_size,$next_data[file_name1],$Thumbnail_path,$Prev_thumb_small1,3/2);
		}
		$next_thumb=$Thumbnail_url.$Next_thumb_small1;
	}
	elseif(preg_match("#\.(jpg|jpeg|png)$#i",$next_data[file_name2])){

		if(!file_exists($Thumbnail_path.$Prev_thumb_small2)){
			thumbnail($min_width_size,$next_data[file_name2],$Thumbnail_path,$Prev_thumb_small2,3/2);
		}
		$next_thumb=$Thumbnail_url.$Prev_thumb_small2;
	}elseif(preg_match("#\.(gif|bmp)$#i",$next_data[file_name1]))
		$next_thumb=$next_data[file_name1];
	elseif(preg_match("#\.(gif|bmp)$#i",$next_data[file_name2]))
		$next_thumb=$next_data[file_name2];
	elseif($prev_data[no]) $prev_thumb=$dir."/images/no_image.gif";

}else{
	if($upload_image1){
		$source_img=str_replace("%2F", "/", urlencode($data[file_name1]));
		if(preg_match("#\.(jpg|jpeg|png)$#i",$data[file_name1])){
			$view_img1="<img src=$source_img name=zb_target_resize border=0 alt='$alt1'>";
		}else {
			$view_img1=str_replace("<br>","",$upload_image1);
			$view_img1=preg_replace("#onclick=\"javascript\:[^>]+?(>)#i","align=left class=shadow5\\1",$view_img1);
		}
		$img_info1=@getimagesize($data[file_name1]);
		$img_info1[0]=$img_info1[0]+10;
		$img_info1[1]=$img_info1[1]+55;
		$print_img1="<a onclick=window.open('$dir/img_view.php?img=$data[file_name1]&width=$img_info1[0]&height=$img_info1[1]','view_info','width=0,height=0,toolbar=no,scrollbars=no','status=no') style='cursor:pointer'>";
	}
	if($upload_image2){
		$source_img=str_replace("%2F", "/", urlencode($data[file_name2]));
		if(preg_match("#\.(jpg|jpeg|png)$#i",$data[file_name2])){
			$view_img2="<img src=$source_img name=zb_target_resize border=0 alt='$alt2'>";
		}else {
			$view_img2=str_replace("<br>","",$upload_image2);
			$view_img2=preg_replace("#onclick=\"javascript\:[^>]+?(>)#i","align=left class=shadow5\\1",$view_img2);
		}
		$img_info2=@getimagesize($data[file_name2]);
		$img_info2[0]=$img_info2[0]+10;
		$img_info2[1]=$img_info2[1]+55;
		$print_img2="<a onclick=window.open('$dir/img_view.php?img=$data[file_name2]&width=$img_info2[0]&height=$img_info2[1]','view_info','width=0,height=0,toolbar=no,scrollbars=no','status=no') style='cursor:pointer'>";
	}

	//썸네일 사용하지 않을때 이전파일및 다음파일 정보를 저장
	if(preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$prev_data[file_name1]))
		$prev_thumb=$prev_data[file_name1];
  	elseif(preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$prev_data[file_name2]))
		$prev_thumb=$prev_data[file_name2];
	elseif($prev_data[no]) $prev_thumb=$dir."/images/no_image.gif";

	if(preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$next_data[file_name1]))
		$next_thumb=$next_data[file_name1];
	elseif(preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$next_data[file_name2]))
		$next_thumb= $next_data[file_name2];
	elseif($next_data[no]) $next_thumb=$dir."/images/no_image.gif";
}
?>