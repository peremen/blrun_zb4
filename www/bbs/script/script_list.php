
<script language="javascript">
browserName = navigator.appName;
browserVer = parseInt(navigator.appVersion);
if(browserName == "Netscape" && browserVer >= 3){ init = "net"; }
else { init = "ie"; }


if(((init == "net")&&(browserVer >=3))||((init == "ie")&&(browserVer >= 4))){

 sn_on=new Image;
 sn_off=new Image;
 sn_on.src= "<?=$dir?>/name_on.gif";
 sn_off.src= "<?=$dir?>/name_off.gif";

 ss_on=new Image;
 ss_off=new Image;
 ss_on.src= "<?=$dir?>/subject_on.gif";
 ss_off.src= "<?=$dir?>/subject_off.gif";

 sc_on=new Image;
 sc_off=new Image;
 sc_on.src= "<?=$dir?>/content_on.gif";
 sc_off.src= "<?=$dir?>/content_off.gif";

 sm_on=new Image;
 sm_off=new Image;
 sm_on.src= "<?=$dir?>/comment_on.gif";
 sm_off.src= "<?=$dir?>/comment_off.gif";

}

function OnOff(name) {
if(((init == "net")&&(browserVer >=3))||((init == "ie")&&(browserVer >= 4))) {
  if(document.search[name].value=='on')
  {
   document.search[name].value='off';
   ImgSrc=eval(name+"_off.src");
   document[name].src=ImgSrc;
  }
  else
  {
   document.search[name].value='on';
   ImgSrc=eval(name+"_on.src");
   document[name].src=ImgSrc;
  }
 }
}
</script>

<script language="javascript">
function reverse() {
	var i, chked=0;
	if(confirm('목록을 반전하시겠습니까?\n\n반전을 원하지 않는다면 취소를 누르시면 다음으로 넘어갑니다'))
	{
		for(i=0;i<document.list.length;i++)
		{
		 if(document.list[i].type=='checkbox')
		 {
		  if(document.list[i].checked) { document.list[i].checked=false; }
		  else { document.list[i].checked=true; }
		 }
		}
	}
	for(i=0;i<document.list.length;i++)
	{
		if(document.list[i].type=='checkbox')
		{
		 if(document.list[i].checked) chked=1;
		}
	}
	if(chked) {
		if(confirm('선택된 항목을 보시겠습니까?'))
		{
		  //실행시간 스타트 타임 저장
		  var nStart = new Date().getTime();
		  document.getElementById('nStart').value = nStart;

		  document.list.selected.value='';
		  document.list.exec.value='view_all';
		  for(i=0;i<document.list.length;i++)
		  {
		   if(document.list[i].type=='checkbox')
		   {
			if(document.list[i].checked)
			{
			 document.list.selected.value=document.list[i].value+';'+document.list.selected.value;
			}
		   }
		  }
		  document.list.submit();
		  return true;
		}
	}
}

function delete_all() {
	var i, chked=0;
	for(i=0;i<document.list.length;i++)
	{
		if(document.list[i].type=='checkbox')
		{
		 if(document.list[i].checked) chked=1;
		}
	}
	if(chked)
	{
		document.list.selected.value='';
		document.list.exec.value='delete_all';
		for(i=0;i<document.list.length;i++)
		{
		 if(document.list[i].type=='checkbox')
		 {
		  if(document.list[i].checked)
		  {
		   document.list.selected.value=document.list[i].value+';'+document.list.selected.value;
		  }
		 }
		}
		window.open("select_list_all.php?id=<?=$id?>&page="+document.list.page.value+"&page_num="+document.list.page_num.value+"&select_arrange="+document.list.select_arrange.value+"&desc="+document.list.desc.value+"&sn="+document.list.sn.value+"&ss="+document.list.ss.value+"&sc="+document.list.sc.value+"&sm="+document.list.sm.value+"&keyword="+document.list.keyword.value+"&category="+document.search.category.value+"&selected="+document.list.selected.value,"게시물정리","width=260,height=180,toolbars=no,resize=no,scrollbars=no");
	}
	else {alert('정리할 게시물을 선택하여 주십시요');}
}

function category_change(obj) {
	var myindex=obj.selectedIndex;
	document.search.category.value=obj.options[myindex].value;
	document.search.submit();
	return true;
}
//-->
</script>
