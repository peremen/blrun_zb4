<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset={$encoding}" />
<title>{$html_title}</title>
{literal}

{/literal}
</head>
<link rel=StyleSheet HREF="aokio_analyzer_install.css" type="text/css" title="Global CSS">
<body>

<table style="width:100%;height:100%" border="0" cellspacing="0" cellpadding="0" >
  <tr>
    <td align="center" valign="middle">
      <table width="441" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="images/{$logo_image}" width="441" height="204" /></td>
        </tr>
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="installTable">
              <tr>
                <td background="images/install_border.gif" width="1"><img src="images/spacer.gif" width="1" height="1" /></td>
                <td>
                {if $install_step == 1}
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="installMessage">Select Language</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td class="installForms">
                        <form id="install" name="install" method="post" action="install.php">
                          <select name="language">
                            {html_options  options=$install_language}
                          </select><br/><br/>
                          <input type="hidden" name="install_step" value="{$install_step}">
                          <input type="submit" value="OK" style="width:83">
                        </form>
                      </td>
                    </tr>
                  </table>
                {elseif $install_step == 2}
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="installMessage">{$install_messages.terms_of_service_title}</td>
                    </tr>
                    <tr>
                      <td class="installMessage">Terms of License</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="10">&nbsp;</td>
                            <td class="installSubMessage">{$install_messages.terms_of_service_content}<br><br></td>
                            <td width="10">&nbsp;</td>
                          </tr>
                          <tr >
                            <td width="10">&nbsp;</td>
                            <td class="installTermsMessage"  style="BORDER-TOP: #d0d0d0 1px solid;BORDER-BOTTOM: #d0d0d0 1px solid;BACKGROUND-COLOR: #dcf3c2"><br/>
			    <ol>
                            <li>{$install_messages.terms_of_service_content_1}</li>
			    <li>{$install_messages.terms_of_service_content_2}</li>
			    <li>{$install_messages.terms_of_service_content_3}</li>
			    <li>{$install_messages.terms_of_service_content_4}</li>
			    <li>{$install_messages.terms_of_service_content_5}</li>
			    <li>{$install_messages.terms_of_service_content_6}</li>
			    <li>{$install_messages.terms_of_service_content_7}</li>
			    <li>{$install_messages.terms_of_service_content_8}</li>
			    <li>{$install_messages.terms_of_service_content_9}</li>
			    </ol>
			    </td>
			    <td width="10">&nbsp;</td>
                          </tr>
			  <tr>
                            <td width="10">&nbsp;</td>
                            <td class="installTermsMessage" ></td>
                            <td width="10">&nbsp;</td>
                          </tr>
                          <tr>
                            <td width="10">&nbsp;</td>
                            <td class="installSubMessage">{$install_messages.terms_of_service_content_last}</td>
                            <td width="10">&nbsp;</td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td class="installForms">{$terms_string}
                        <form id="install" name="install" method="post" action="install.php">
                          <input type="hidden" name="terms" value="terms">
                          <input type="hidden" name="language" value="{$language}">
                          <input type="hidden" name="install_step" value="{$install_step}">
                          <input type="submit" value=" OK " style="width:83">
                        </form>
                      </td>
                    </tr>
                  </table>
                {elseif $install_step == 3}
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="installMessage">{$install_messages.database_select_title}</td>
                    </tr>
                    <tr>
                      <td class="installMessage">Database Select</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="10">&nbsp;</td>
                            <td class="installSubMessage"><div align="center">{$install_messages.database_select_comment}</div></td>
                            <td width="10">&nbsp;</td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td class="installForms">
                        <form id="install" name="install" method="post" action="install.php">
                          <select name="db_select">
                            {html_options  options=$db_list}
                          </select><br/><br/>
                          <input type="hidden" name="install_step" value="{$install_step}">
                          <input type="hidden" name="language" value="{$language}">
                          <input type="submit" value="OK" style="width:83">
                        </form>
                      </td>
                    </tr>
                  </table>
                {elseif $install_step == 4}
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="installMessage">{$install_messages.database_config_title}</td>
                    </tr>
                    <tr>
                      <td class="installMessage">Database Configuration</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td><!--
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="10">&nbsp;</td>
                            <td class="installSubMessage">{$install_messages.database_config_comment}</td>
                            <td width="10">&nbsp;</td>
                          </tr>
                        </table>-->
                      </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td class="installForms">
                      {if $file_exist_flag}
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="10">&nbsp;</td>
                            <td class="installErrorMessage">{$error_message.config_file_exist}</td>
                            <td width="10">&nbsp;</td>
                          </tr>
                        </table>
                      {/if}
                      {if $wrong_db_config_flag}
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="10">&nbsp;</td>
                            <td class="installErrorMessage">{$error_message.database_config_is_wrong}</td>
                            <td width="10">&nbsp;</td>
                          </tr>
                        </table>
                      {/if}
                      {if $file_handling_error}
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="10">&nbsp;</td>
                            <td class="installErrorMessage">{$error_message.file_handling_error}</td>
                            <td width="10">&nbsp;</td>
                          </tr>
                        </table>
                      {/if}
                        <form id="install" name="install" method="post" action="install.php">
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="10">&nbsp;</td>
                              <td width="60" class="installInputTitles">&nbsp;</td>
                              <td width="90" class="installInputTitles">HOST</td>
                              <td><input type="text" name="host" value="{$req.host}" class="installInputForms" ></td>
                              <td width="10">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="10">&nbsp;</td>
                              <td class="installInputTitles">&nbsp;</td>
                              <td class="installInputTitles">D&nbsp;&nbsp;&nbsp;B</td>
                              <td><input type="text" name="db" value="{$req.db}" class="installInputForms"></td>
                              <td width="10">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="10">&nbsp;</td>
                              <td class="installInputTitles">&nbsp;</td>
                              <td class="installInputTitles">USERNAME</td>
                              <td><input type="text" name="userid" value="{$req.userid}" class="installInputForms" ></td>
                              <td width="10">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="10">&nbsp;</td>
                              <td class="installInputTitles">&nbsp;</td>
                              <td class="installInputTitles">PASSWORD</td>
                              <td><input type="password" name="password" value="{$req.password}" class="installInputForms" ></td>
                              <td width="10">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="10">&nbsp;</td>
                              <td class="installInputTitles">&nbsp;</td>
                              <td class="installInputTitles"></td>
                              <td></td>
                              <td width="10">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="10">&nbsp;</td>
                              <td class="installInputTitles">&nbsp;</td>
                              <td class="installInputTitles"></td>
                              <td>
                          <input type="hidden" name="install_step" value="{$install_step}">
                          <input type="hidden" name="language" value="{$language}">
                          <input type="hidden" name="db_select" value="{$db_select}">
                          <input type="submit" value="OK" style="width:100"></td>
                              <td width="10">&nbsp;</td>
                            </tr>
                          </table>
                        </form>
                      </td>
                    </tr>
                  </table>
                {elseif $install_step == 5}
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="installMessage">{$install_messages.administrator_config_title}</td>
                    </tr>
                    <tr>
                      <td class="installMessage">Administrator Configuration</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td class="installForms">
                      {if $admin_input_is_no_flag}
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="10">&nbsp;</td>
                            <td class="installErrorMessage">{$error_message.admin_input_is_no}</td>
                            <td width="10">&nbsp;</td>
                          </tr>
                        </table>
                      {/if}
                      {if $admin_input_is_wrong_flag}
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="10">&nbsp;</td>
                            <td class="installErrorMessage">{$error_message.admin_input_is_wrong}</td>
                            <td width="10">&nbsp;</td>
                          </tr>
                        </table>
                      {/if}
                        <form id="install" name="install" method="post" action="install.php">
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="10">&nbsp;</td>
                              <td width="60" class="installInputTitles">&nbsp;</td>
                              <td width="90" class="installInputTitles">I  D</td>
                              <td><input type="text" name="adminid" class="installInputForms" ></td>
                              <td width="10">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="10">&nbsp;</td>
                              <td width="60" class="installInputTitles">&nbsp;</td>
                              <td width="90" class="installInputTitles">Password</td>
                              <td><input type="password" name="adminpassword" class="installInputForms" ></td>
                              <td width="10">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="10">&nbsp;</td>
                              <td width="60" class="installInputTitles">&nbsp;</td>
                              <td width="90" class="installInputTitles"></td>
                              <td></td>
                              <td width="10">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="10">&nbsp;</td>
                              <td width="60" class="installInputTitles">&nbsp;</td>
                              <td width="90" class="installInputTitles"></td>
                              <td><input type="hidden" name="admin" value="terms">
                        <input type="hidden" name="language" value="{$language}">
                        <input type="hidden" name="install_step" value="{$install_step}">
                        <input type="submit" value="OK" style="width:100"></td>
                              <td width="10">&nbsp;</td>
                            </tr>
                          </table>
                        </form>
                      </td>
                    </tr>
                  </table>
                {elseif $install_step == 6}
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="installMessage">{$install_messages.install_completed_title}</td>
                    </tr>
                    <tr>
                      <td class="installMessage">Install Completed</td>
                    </tr>
                    <tr>
                      <td class="installErrorMessage">
                      {if $is_initiated_flag}
                      <BR/><BR/>
                        {$error_message.install_completed_already}<BR/><BR/>&nbsp;
                      {else}<BR/><BR/>
                      {$install_messages.install_completed_comment}
                      <BR/><BR/><BR/>&nbsp;
                      {/if}</td>
                    </tr>
                    <tr>
                      <td class="installForms"><a href="./manager.php">{$application_name} Manager Page</a></td>
                    </tr>
                    <tr>
                      <td><BR/><BR/><BR/>&nbsp;</td>
                    </tr>
                    <tr>
                  </table>
                {/if}  
                </td>
                <td background="images/install_border.gif" width="1"><img src="images/spacer.gif" width="1" height="1" /></td>
              </tr>
              <tr>
                <td background="images/install_border.gif" width="1"><img src="images/spacer.gif" width="1" height="1" /></td>
                <td>&nbsp;</td>
                <td background="images/install_border.gif" width="1"><img src="images/spacer.gif" width="1" height="1" /></td>
              </tr>
              <tr>
                <td background="images/install_border.gif" width="1"><img src="images/spacer.gif" width="1" height="1" /></td>
                <td class="bottomApplication"> {$application_name_version}&nbsp;&nbsp;&nbsp;<a href="{$my_home}">{$my_nick}</a>&nbsp;&nbsp;&nbsp;</td>
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
