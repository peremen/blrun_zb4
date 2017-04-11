<?
function member_icon($m_data){
	global $dir,$zb_url,$zb_path,$Thumbnamil_icon_use;

	if($m_data[no]){                              //회원일경우
		if($Thumbnail_icon_use=="on"){                         //회원 사진을 썸네일을 사용할 경우
			$str=str_replace("icon/","/icon/thumbnail/",$m_data[picture]);
			if(preg_match("#\.jpg#i",$str)) $str=str_replace(".jpg","",$str);
			elseif(preg_match("#\.gif#i",$str)) $str=str_replace(".gif","",$str);

			$icon_small=$str."_small.jpg";
			$icon_large=$str."_large.jpg";

			if(!file_exists($zb_path.$icon_small) ||!file_exists($zb_path.$icon_large)){
				$size=array(44,160);
				thumbnail($size,$m_data[picture],$zb_path,$icon_small,$icon_large,3/4);

			}
			$member_icon_small= $zb_url.$icon_small; //이곳에 회원사진의 썸네일 작은것
			$member_icon_large=$zb_url.$icon_large; //회원 사진 썸네일 사이즈 큰것
			$img_tag=image_tag($member_icon_large,"");

			$view_img="<a href=javascript:void(window.open('$zb_url/view_info2.php?member_no=$m_data[no]','view_info','width=400,height=410,toolbar=no,scrollbars=yes')) onfocus='this.blur();' onMouseMove=\"msgposit()\";  onMouseOver=\"msgset('$img_tag')\"; onMouseOut=\"msghide();\">";
			$result=$view_img."<img src=$member_icon_small  width=44 height=33 align=center  style=border-width:1pt;border-style:solid;border-color:#666666; ></a>";

			return $result;

		}else{                                     //썸네일 사용 하지 않을 경우
			$member_icon=$m_data[picture];
			$img_tag=image_tag($member_icon,"");
			$view_img="<a href=javascript:void(window.open('$zb_url/view_info2.php?member_no=$m_data[no]','view_info','width=400,height=410,toolbar=no,scrollbars=yes')) onfocus='this.blur();' onMouseMove=\"msgposit()\";  onMouseOver=\"msgset('$img_tag')\"; onMouseOut=\"msghide();\">";
			 $result=$view_img."<img src=$member_icon  width=44 height=33 align=center  style=border-width:1pt;border-style:solid;border-color:#666666;></a>";

			return $result;
		}
	}else{                   //회원이 아닐경우
		$member_icon=$dir."/images/no_images2.gif";
		$img_tag=image_tag($dir."/images/matrix.gif","");
		$view_img="<a href=javascript:void(window.open('$dir/no_member.php','view_info','width=270,height=120')) onfocus='this.blur();' onMouseMove=\"msgposit()\";  onMouseOver=\"msgset('$img_tag')\"; onMouseOut=\"msghide();\">";
		$result=$view_img."<img src=$member_icon  width=44 height=33 align=center  style=border-width:1pt;border-style:solid;border-color:#666666; ></a>";
		return $result;
	}
}
?>
