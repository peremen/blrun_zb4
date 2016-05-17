
<script language=JavaScript>
function findObj(n, d) { //v4.0
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=findObj(n,d.layers[i].document);
  if(!x && document.getElementById) x=document.getElementById(n); return x;
}
function swapImage() {
  var i,j=0,x,a=swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
</script>
<script language="JavaScript">
<!--
function transimg(id,img,str) {
	Objimg=new Image();
	Objimg.src=img;
	document.images[id].src = Objimg.src;
}
-->
</script>
<!-----------------이미지 미리보기-------------------->
<div id="message" style="border-width:0px; border-style:none; position:absolute; left:0px; top:0px; z-index:1;" class=shadow></div>
<script language="javascript">
<!--
function msgposit(x, y, myEvent) {
	var element = document.getElementById("message");
	var scrollLeft = (document.documentElement && document.documentElement.scrollLeft) || document.body.scrollLeft;
	var scrollTop = (document.documentElement && document.documentElement.scrollTop) || document.body.scrollTop;

	element.style.left = ((myEvent.clientX - x) + scrollLeft) + "px"; //오버될때 보여질 이미지의 x 좌표
	element.style.top = ((myEvent.clientY - y) + scrollTop) + "px"; //오버될때 보여질 이미지의 y 좌표
}

function msgset(str){
	var text
	text ='<table align="left" border="0" cellpadding="0" cellspacing="0" class=shadow>'
	text += '<tr><td align=left>'+str+'</td></tr></table>'
	message.innerHTML=text
}

function msghide(){
	message.innerHTML=''
}
-->
</script>
<!-----------------마우스 위치값 알아내기-------------------->
<script language="javascript">
<!--
var IE = document.all?true:false;
if (!IE) document.captureEvents(Event.MOUSEMOVE)
	document.onmousemove = getMouseXY;
var tempX = 0;
var tempY = 0;
function getMouseXY(e) {
	if (IE) { // grab the x-y pos.s if browser is IE
		tempX = event.clientX + document.body.scrollLeft;
		tempY = event.clientY + document.body.scrollTop;
	}
	else {  // grab the x-y pos.s if browser is NS
		tempX = e.pageX;
		tempY = e.pageY;
	}
	if (tempX < 0){tempX = 0;}
	if (tempY < 0){tempY = 0;}
	return true;
}

var imgObj = new Image();
function showImgWin(imgName) {

  imgObj.src = imgName;
  setTimeout("createImgWin(imgObj)", 100);
}
function createImgWin(imgObj) {
  if (! imgObj.complete) {
    setTimeout("createImgWin(imgObj)", 100);
    return;
  }
  imageWin = window.top.open("", "imageWin",
    "width=" + imgObj.width + ",height=" + imgObj.height);
  imageWin.document.write("<html><body style='margin:0;cursor:pointer'>");
  imageWin.document.write("<a href='javascript:self.close()'>");
  imageWin.document.write("<img src='" + imgObj.src + "'border=0></a>");
  imageWin.document.write("</body><html>");
  imageWin.document.title = imgObj.src;
}
-->
</script>
