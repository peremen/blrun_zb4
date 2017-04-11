
<script>
function check_submit()
{
 var rSub=document.getElementById('subject');
 var rStr=document.getElementById('memo');
 if(!rSub.value)
 {
  alert('제목을 입력하여 주세요');
  rSub.focus();
  return false;
 }
 if(!rStr.value)
 {
  alert('내용을입력하여주세요');
  rStr.focus();
  return false;
 }
 return true;
}
</script>
