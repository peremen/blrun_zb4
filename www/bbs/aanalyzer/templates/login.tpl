<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset={$encoding}" />
<title>{$html_title}</title>
{literal}

{/literal}
</head>
<link rel=StyleSheet HREF="{$language}_aokio.css" type="text/css">
<body>

<table style="width:100%;height:100%" border="0" cellspacing="0" cellpadding="0" >
  <tr>
    <td align="center" valign="middle">
      <table width="441" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="images/{$language}/{$logo_image}" width="441" height="204" /></td>
        </tr>
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="loginTable">
              <tr>
                <td background="images/install_border.gif" width="1"><img src="images/spacer.gif" width="1" height="1" /></td>
                <td>
                  <table width="100%" border="0" cellspacing="2" cellpadding="1">
                    <tr>
                     <td class="loginMainMessage">{$login_messages.selected_language_title}</td>
                    </tr>
                    {if !$login_messages.lang_type}
                    <tr>
                     <td class="loginSubMessage">{$login_messages.english_title}</td>
                    </tr>
                    {/if}
                    <tr>
                   <td class="loginErrorMessage">
                  {if $login_messages.input_error_wrong_input_flag}{$login_messages.input_error_wrong_input}{/if}
                  {if $login_messages.input_error_no_input_flag}{$login_messages.input_error_no_input}{/if}&nbsp;
                    </td>
                  </tr>
                  <tr>
                    <td>
                     <form style='margin:5px' id="login" name="login" method="post" action="login.php">
                       <table width="50%" align="center" border="0" cellspacing="2" cellpadding="1">
                        <tr>
                          <td class="loginInputItemTitles">{$login_messages.id}</td>
                          <td> <input type="text" name="adminid" style='width:100'></td>
                        </tr>
                        <tr>
                          <td class="loginInputItemTitles">{$login_messages.password}</td>
                          <td><input type="password" name="adminpassword" style='width:100' ></td>
                        </tr>
                        <tr>
                          <td class="loginInputItemTitles" height="3"></td><td></td>
                        </tr>
                        <tr>
                          <td><input type="hidden" name="login_submit" value="on" >&nbsp;</td>
                          <td><input type="submit" value="{$login_messages.submit}" class="loginInputForms" style='width:100'></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td></td>
                        </tr>
                       </table>
                      </form>
                    </td>
                  </tr>
                </table>
              </td>
              <td background="images/install_border.gif" width="1"><img src="images/spacer.gif" width="1" height="1" /></td>
            </tr>
            <tr>
              <td background="images/install_border.gif" width="1"><img src="images/spacer.gif" width="1" height="1" /></td>
              <td class="bottomApplicationStrings"> {$application_name_version}&nbsp;&nbsp;&nbsp;<a href="{$my_home}">{$my_nick}</a>&nbsp;&nbsp;&nbsp;</td>
              <td background="images/install_border.gif" width="1"><img src="images/spacer.gif" width="1" height="1" /></td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td><img src="images/intall_bottom.gif" width="441" height="5" /></td>
      </tr>
    </table>
    </td>
  </tr>
</table>
</body>
</html>
