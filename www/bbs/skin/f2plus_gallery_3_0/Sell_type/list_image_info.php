<?
unset($thumb_img);
unset($thumb_img1);
unset($thumb_img2);
unset($img_info);

if($Thumbnail_use=="on"){
	//����� ���丮 �� �� ȸ���� ���丮 ����
	if(!is_dir($zb_path."data/$id/thumbnail/".$data[ismember]."/")) {
		if(!@mkdir($zb_path."data/$id/thumbnail/".$data[ismember]."/",0777,true)) $error_check+=1;
		if(!@chmod($zb_path."data/$id/thumbnail/".$data[ismember]."/",0707)) $error_check+=2;
	}
	if($error_check==2) echo "<br> ".$zb_path."data/$id/thumbnail/".$data[ismember]."/ ���丮�� ������ 707�� �����ϼ���<br><br>";
	elseif($error_check==3) echo "<br> ".$zb_path."data/$id/thumbnail/ ���丮 ���� ".$data[ismember]."�� ȸ�� ���丮 ������ �����߽��ϴ�.<br> �ش��ο� ���丮�� �������� �ֽð� ������ 707�� �����ϼ���<br><br>";

	if(preg_match("#\.(jpg|jpeg|png)$#i",$data[file_name1])){
		$src_img1=$data[file_name1];
		if(!file_exists($Thumbnail_path.$Thumbnail_small1)){
			thumbnail($min_width_size,$src_img1,$Thumbnail_path,$Thumbnail_small1,3/2);
		}
		$thumb_img1=$Thumbnail_url.$Thumbnail_small1;

	}elseif(preg_match("#\.(jpg|jpeg|png)$#i",$out[0][1].".".$out[0][2])) {

		$src_img1="icon/member_image_box/".$data[ismember]."/".$out[0][1].".".$out[0][2];
		if(file_exists($src_img1) && !file_exists($Thumbnail_path.$data[ismember]."/".$iThumbnail_small1)){
			thumbnail($min_width_size,$src_img1,$Thumbnail_path.$data[ismember]."/",$iThumbnail_small1,3/2);
			$thumb_img1=$Thumbnail_url.$data[ismember]."/".str_replace("%2F", "/", urlencode($iThumbnail_small1));
		}elseif(!file_exists($src_img1)){
			$src_img1=$dir."/images/no_image.gif";
			$thumb_img1="";
		}else{
			$thumb_img1=$Thumbnail_url.$data[ismember]."/".str_replace("%2F", "/", urlencode($iThumbnail_small1));
		}

	}elseif(($src_img1=stripslashes($img[0][1])) && !preg_match("#\.(gif|bmp)$#i",$src_img1)){
		if(!file_exists($Thumbnail_path.$data[ismember]."/".$Thumbnail_small1)){
			$zx=thumbnail($min_width_size,$src_img1,$Thumbnail_path.$data[ismember]."/",$Thumbnail_small1,3/2);
			@mysql_query("update $t_board"."_$id set x='$zx' where no='$data[no]'") or error(mysql_error());
		}
		$re=mysql_fetch_array(mysql_query("select x from $t_board"."_$id where no='$data[no]'"));
		if($re[x]){
			$thumb_img1=$Thumbnail_url.$data[ismember]."/".str_replace("%2F", "/", urlencode($Thumbnail_small1));
		}else{
			$src_img1=$dir."/images/no_image.gif";
			$thumb_img1="";
		}

	}elseif(preg_match("#\.(gif|bmp)$#i",$data[file_name1])){
		$src_img1=str_replace("%2F", "/", urlencode($data[file_name1]));
		$thumb_img1=$src_img1;
	}elseif(preg_match("#\.(gif|bmp)$#i",$out[0][1].".".$out[0][2])) {
		$src_img1="icon/member_image_box/".$data[ismember]."/".$out[0][1].".".$out[0][2];
		if(!file_exists($src_img1)){
			$src_img1=$dir."/images/no_image.gif";
			$thumb_img1="";
		}else{
			$thumb_img1=str_replace("%2F", "/", urlencode($src_img1));
		}
	}elseif(($src_img1=stripslashes($img[0][1])) && preg_match("#\.(gif|bmp)$#i",$src_img1)){
		$thumb_img1=$src_img1;
	}

	if(preg_match("#\.(jpg|jpeg|png)$#i",$data[file_name2])){
		$src_img2=$data[file_name2];
		if(!file_exists($Thumbnail_path.$Thumbnail_small2)){
			thumbnail($min_width_size,$src_img2,$Thumbnail_path,$Thumbnail_small2,3/2);
		}
		$thumb_img2=$Thumbnail_url.$Thumbnail_small2;
	}elseif(preg_match("#\.(jpg|jpeg|png)$#i",$out[1][1].".".$out[1][2])) {

		$src_img2="icon/member_image_box/".$data[ismember]."/".$out[1][1].".".$out[1][2];
		if(file_exists($src_img2) && !file_exists($Thumbnail_path.$data[ismember]."/".$iThumbnail_small2)){
			thumbnail($min_width_size,$src_img2,$Thumbnail_path.$data[ismember]."/",$iThumbnail_small2,3/2);
			$thumb_img2=$Thumbnail_url.$data[ismember]."/".str_replace("%2F", "/", urlencode($iThumbnail_small2));
		}elseif(!file_exists($src_img2)){
			$src_img2=$dir."/images/no_image.gif";
			$thumb_img2="";
		}else{
			$thumb_img2=$Thumbnail_url.$data[ismember]."/".str_replace("%2F", "/", urlencode($iThumbnail_small2));
		}

	}elseif(($src_img2=stripslashes($img[1][1])) && !preg_match("#\.(gif|bmp)$#i",$src_img2)){
		if(!file_exists($Thumbnail_path.$data[ismember]."/".$Thumbnail_small2)){
			$zy=thumbnail($min_width_size,$src_img2,$Thumbnail_path.$data[ismember]."/",$Thumbnail_small2,3/2);
			@mysql_query("update $t_board"."_$id set y='$zy' where no='$data[no]'") or error(mysql_error());
		}
		$re=mysql_fetch_array(mysql_query("select y from $t_board"."_$id where no='$data[no]'"));
		if($re[y]){
			$thumb_img2=$Thumbnail_url.$data[ismember]."/".str_replace("%2F", "/", urlencode($Thumbnail_small2));
		}else{
			$src_img2=$dir."/images/no_image.gif";
			$thumb_img2="";
		}

	}elseif(preg_match("#\.(gif|bmp)$#i",$data[file_name2])){
		$src_img2=str_replace("%2F", "/", urlencode($data[file_name2]));
		$thumb_img2=$src_img2;
	}elseif(preg_match("#\.(gif|bmp)$#i",$out[1][1].".".$out[1][2])) {
		$src_img2="icon/member_image_box/".$data[ismember]."/".$out[1][1].".".$out[1][2];
		if(!file_exists($src_img2)){
			$src_img2=$dir."/images/no_image.gif";
			$thumb_img2="";
		}else{
			$thumb_img2=str_replace("%2F", "/", urlencode($src_img2));
		}
	}elseif(($src_img2=stripslashes($img[1][1])) && preg_match("#\.(gif|bmp)$#i",$src_img2)){
		$thumb_img2=$src_img2;
	}

	if($thumb_img1){
		$img_tag=$src_img1;
		$img_info=@getImageSize(urldecode($src_img1));
		$thumb_img=$thumb_img1;            //����Ʈ ���ο��� ������ 75 X 56 �������� �����
	}                                                       //����Ʈ ���ο����� ù��° ������ ����ϸ� ������
	elseif($thumb_img2){   //���ε� �̹��� 2�� ���ϸ� ������
		$img_tag=$src_img2;
		$img_info=@getImageSize(urldecode($src_img2));
		$thumb_img=$thumb_img2;
	}
	else{                                // ���ε� �̹��� ������ ������
		$img_tag=$dir."/images/no_image.gif";
		$thumb_img=$dir."/images/no_image.gif";     //������� �̸� ������ �̹��� ���� ���.�����ϼŵ� �˴ϴ�.
		$img_info=@getImageSize($thumb_img);
	}

	$img_tag=str_replace("%2F", "/", urlencode($img_tag));

	if($img_show=="on"){
		$view_img="<a onclick=window.open('$dir/img_view.php?img=$img_tag&width=".($img_info[0]+10)."&height=".($img_info[1]+55)."','view_info','width=0,height=0,toolbar=no,scrollbars=no') class=shadow style='cursor:pointer'>";
	}else{
		$view_img="<a href=$zb_url/$view_target?$href$sort&no=$data[no] class=shadow style='cursor:pointer'>";
	}
			 // �ڹ� ��ũ��Ʈ�� �̿��� ���콺 ������ ���극�̾� â���� �̹��� ���
}else{
	if(preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$data[file_name1])){
		$thumb_img1=$data[file_name1];
		$thumb_img1=str_replace("%2F", "/", urlencode($thumb_img1));
	}elseif(preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$out[0][1].".".$out[0][2])){
		$thumb_img1="icon/member_image_box/".$data[ismember]."/".$out[0][1].".".$out[0][2];
		if(!file_exists($thumb_img1)) $thumb_img1="";
		else $thumb_img1=str_replace("%2F", "/", urlencode($thumb_img1));
	}elseif($src_img1=stripslashes($img[0][1]))
		$thumb_img1=$src_img1;

	if(preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$data[file_name2])){
		$thumb_img2=$data[file_name2];
		$thumb_img2=str_replace("%2F", "/", urlencode($thumb_img2));
	}elseif(preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$out[1][1].".".$out[1][2])){
		$thumb_img2="icon/member_image_box/".$data[ismember]."/".$out[1][1].".".$out[1][2];
		if(!file_exists($thumb_img2)) $thumb_img2="";
		else $thumb_img2=str_replace("%2F", "/", urlencode($thumb_img2));
	}elseif($src_img2=stripslashes($img[1][1]))
		$thumb_img2=$src_img2;

	if($thumb_img1){                              //���ε� �̹��� ������ �Ѵ� ������
		$img_info=@getImageSize(urldecode($thumb_img1));
		$thumb_img=$thumb_img1;            //����Ʈ ���ο��� ������ 75 X 56 �������� �����
	}                                                       //����Ʈ ���ο����� ù��° ������ ����ϸ� ������
	elseif($thumb_img2){   //���ε� �̹��� 2�� ���ϸ� ������
		$img_info=@getImageSize(urldecode($thumb_img2));
		$thumb_img=$thumb_img2;
	}
	else{                                // ���ε� �̹��� ������ ������
		$thumb_img=$dir."/images/no_image.gif";     //������� �̸� ������ �̹��� ���� ���.�����ϼŵ� �˴ϴ�.
		$img_info=@getImageSize($thumb_img);
	}

	if($img_show=="on"){
		$view_img="<a onclick=window.open('$dir/img_view.php?img=$thumb_img&width=".($img_info[0]+10)."&height=".($img_info[1]+55)."','view_info','width=0,height=0,toolbar=no,scrollbars=no') class=shadow style='cursor:pointer'>";
	}else{
		$view_img="<a href=$zb_url/$view_target?$href$sort&no=$data[no] class=shadow style='cursor:pointer'>";
	}
			 // �ڹ� ��ũ��Ʈ�� �̿��� ���콺 ������ ���극�̾� â���� �̹��� ���
}
?>