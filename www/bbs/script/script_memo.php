
<script>
function check_submit()
{
 var rSub=document.getElementById('subject');
 var rStr=document.getElementById('memo');
 if(!rSub.value)
 {
  alert('������ �Է��Ͽ� �ּ���');
  rSub.focus();
  return false;
 }
 if(!rStr.value)
 {
  alert('�������Է��Ͽ��ּ���');
  rStr.focus();
  return false;
 }
 return true;
}
</script>
