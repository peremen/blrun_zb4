<?
//�⺻������ $img1�� �׻� �����͸� ����, �׷��� $img2�� �ִٸ� �Ѵٸ� ���. ���ٸ� $img1 �� ���
function image_tag($img1,$img2){
   if($img2){
   $img_tag="<img src=$img1 width=200 border=0 style=filter: Alpha(Opacity=75) style=PADDING-RIGHT: 10px; PADDING-LEFT: 13px; style=border-width:1pt;border-style:solid;border-color:#000000;>"."&nbsp;&nbsp;<img src=$img2 width=160 height=120 border=0 style=PADDING-RIGHT: 10px; PADDING-LEFT: 13px; style=border-width:1pt;border-style:solid;border-color:#000000  style=filter:progid:DXImageTransform.Microsoft.Alpha(style=1,opacity=100,finishOpacity=0,startX=0,finishX=100,startY=100,finishY=100);>";
   }
   else{ 
	   $img_tag="<img src=$img1 width=200 border=0 style=filter: Alpha(Opacity=75) style=PADDING-RIGHT: 10px; PADDING-LEFT: 13px; style=border-width:1pt;border-style:solid;border-color:#000000;>";
   }
   return $img_tag;
}
?>