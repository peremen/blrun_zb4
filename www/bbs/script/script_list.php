
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
	if(confirm('����� �����Ͻðڽ��ϱ�?\n\n������ ������ �ʴ´ٸ� ��Ҹ� �����ø� �������� �Ѿ�ϴ�'))
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
		if(confirm('���õ� �׸��� ���ðڽ��ϱ�?'))
		{
		  //����ð� ��ŸƮ Ÿ�� ����
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
		window.open("select_list_all.php?id=<?=$id?>&page="+document.list.page.value+"&page_num="+document.list.page_num.value+"&select_arrange="+document.list.select_arrange.value+"&desc="+document.list.desc.value+"&sn="+document.list.sn.value+"&ss="+document.list.ss.value+"&sc="+document.list.sc.value+"&sm="+document.list.sm.value+"&keyword="+document.list.keyword.value+"&category="+document.search.category.value+"&selected="+document.list.selected.value,"�Խù�����","width=260,height=180,toolbars=no,resize=no,scrollbars=no");
	}
	else {alert('������ �Խù��� �����Ͽ� �ֽʽÿ�');}
}

function category_change(obj) {
	var myindex=obj.selectedIndex;
	document.search.category.value=obj.options[myindex].value;
	document.search.submit();
	return true;
}
//-->
</script>
