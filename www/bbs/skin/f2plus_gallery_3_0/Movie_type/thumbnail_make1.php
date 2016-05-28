<?
function thumbnail($size,$source_file,$save_path,$small,$ratio){

	$img_info=@getimagesize($source_file);

	if($img_info[2]==1) $srcimg=@ImageCreateFromGIF($source_file);
	elseif($img_info[2]==2) $srcimg=@ImageCreateFromJPEG($source_file);
	else                     $srcimg=@ImageCreateFromPNG($source_file);

	$max_width=$size;
	$max_height=intval($size*$ratio);

	if($img_info[0]<=$max_width || $img_info[1]<=$max_height){
		$new_width=$img_info[0];
		$new_height=$img_info[1];
	}else{
		if($img_info[0]*$ratio >= $img_info[1]){
			$alpha=(double)$max_height/$img_info[1];
			$new_width=intval($img_info[0]*$alpha);
			$new_height=$max_height;
		}
		else{
			$alpha=(double)$max_width/$img_info[0];
			$new_width=$max_width;
			$new_height=intval($alpha*$img_info[1]);
		}
	}

	$srcx=(int)($max_width-$new_width)/2;
	$srcy=(int)($max_height-$new_height)/2;

	$dstimg=@ImageCreate($max_width,$max_height);
	@ImageColorAllocate($dstimg,255,255,255);
	@ImageCopyResized($dstimg, $srcimg,$srcx,$srcy,0,0,$new_width,$new_height,ImageSX($srcimg),ImageSY($srcimg));

	@ImageJPEG($dstimg,$save_path.$small,85);
	@ImageDestroy($dstimg);
	@ImageDestroy($srcimg);
}

function thumbnail2($size,$source_file,$save_file){

	$img_info=@getimagesize($source_file);
	
	if($img_info[2]==1) $srcimg=@ImageCreateFromGIF($source_file);
	elseif($img_info[2]==2) $srcimg=@ImageCreateFromJPEG($source_file);
	else                     $srcimg=@ImageCreateFromPNG($source_file);

	if($img_info[0]>=$size){
		$max_width=$size;
		$max_height=ceil($img_info[1]*$size/$img_info[0]);
	}else{
		$max_width=$img_info[0];
		$max_height=$img_info[1];
	}
	
	$dstimg=@ImageCreate($max_width,$max_height);
	@ImageColorAllocate($dstimg,255,255,255);
	@ImageCopyResized($dstimg, $srcimg,0,0,0,0,$max_width,$max_height,ImageSX($srcimg),ImageSY($srcimg));
	
	@ImageJPEG($dstimg,$save_file,85);
	
	@ImageDestroy($dstimg);
	@ImageDestroy($srcimg);
}
?>