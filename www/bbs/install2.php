<?
  require "lib.php";
  head();
?>
<body bgcolor=#000000 text=#ffffff>
<br><br><br>
<div align=center>
<table cellpadding=0 cellspacing=0 width=600 border=0>
<tr>
  <td height=30 colspan=3><img src=images/inst_top.gif></td>
</tr>
<tr>
  <td> 
    <br>

  </td>
</tr>
</table>
<!-- �⺻ ���� �Է¹޴°� -->
<script>
 function check_submit()
 {
  if(!write.user_id.value)
  {
   alert("���̵� �Է��ϼ���");
   write.user_id.focus();
   return false;
  }
  if(!write.password1.value)
  {
   alert("Password�� �Է��ϼ���");
   write.password1.focus();
   return false;
  }
  if(!write.password2.value)
  {
   alert("Confirm Password�� �Է��ϼ���");
   write.password2.focus();
   return false;
  }
  if(write.password1.value!=write.password2.value)
  {
   alert("Password�� ��ġ���� �ʽ��ϴ�");
   write.password1.value="";
   write.password2.value="";
   write.password1.focus();
   return false;
  }
  if(!write.name.value)
  {
   alert("Name�� �Է��ϼ���");
   write.name.focus();
   return false;
  }
  return true;
 }
</script>

<table border=0 cellpadding=2 cellspacing=0 width=600>
<form name=write method=post action="install2_ok.php" onsubmit="return check_submit();">

<tr>
  <td colspan=2>
  <img src=images/inst_step3.gif>
  </td>
</tr>

<tr>
  <td width=150 align=right style=font-family:Tahoma;font-size:8pt>ID&nbsp;</td>
  <td width=450> <input type=test name=user_id size=20 maxlength=20 style=font-family:Tahoma;font-size:8pt;></td>
</tr>

<tr>
  <td  align=right style=font-family:Tahoma;font-size:8pt>Password&nbsp;</td>
  <td > <input type=password name=password1 size=20 maxlength=20 style=font-family:Tahoma;font-size:8pt></td>
</tr>

<tr>
  <td  align=right style=font-family:Tahoma;font-size:8pt>Confirm Password&nbsp;</td>
  <td > <input type=password name=password2 size=20 maxlength=20 style=font-family:Tahoma;font-size:8pt></td>
</tr>

<tr>
  <td  align=right style=font-family:Tahoma;font-size:8pt>Name&nbsp;</td>
  <td > <input type=text name=name size=20 value='<?echo $data[name];?>' maxlength=20 style=font-family:Tahoma;font-size:8pt></td>
</tr>

<tr>
  <td align=center colspan=2><br>
<br>      <input type=image src=images/inst_b_3.gif border=0 align=absmiddle>
  </td>
</tr>
</form>
</table>
<?
  foot();
?>
