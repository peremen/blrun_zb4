<?php /* Smarty version 2.6.13, created on 2008-11-25 02:22:26
         compiled from install.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'install.tpl', 37, false),)), $this); ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $this->_tpl_vars['encoding']; ?>
" />
<title><?php echo $this->_tpl_vars['html_title']; ?>
</title>
<?php echo '

'; ?>

</head>
<link rel=StyleSheet HREF="aokio_analyzer_install.css" type="text/css" title="Global CSS">
<body>

<table style="width:100%;height:100%" border="0" cellspacing="0" cellpadding="0" >
  <tr>
    <td align="center" valign="middle">
      <table width="441" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="images/<?php echo $this->_tpl_vars['logo_image']; ?>
" width="441" height="204" /></td>
        </tr>
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="installTable">
              <tr>
                <td background="images/install_border.gif" width="1"><img src="images/spacer.gif" width="1" height="1" /></td>
                <td>
                <?php if ($this->_tpl_vars['install_step'] == 1): ?>
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
                            <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['install_language']), $this);?>

                          </select><br/><br/>
                          <input type="hidden" name="install_step" value="<?php echo $this->_tpl_vars['install_step']; ?>
">
                          <input type="submit" value="OK" style="width:83">
                        </form>
                      </td>
                    </tr>
                  </table>
                <?php elseif ($this->_tpl_vars['install_step'] == 2): ?>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="installMessage"><?php echo $this->_tpl_vars['install_messages']['terms_of_service_title']; ?>
</td>
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
                            <td class="installSubMessage"><?php echo $this->_tpl_vars['install_messages']['terms_of_service_content']; ?>
<br><br></td>
                            <td width="10">&nbsp;</td>
                          </tr>
                          <tr >
                            <td width="10">&nbsp;</td>
                            <td class="installTermsMessage"  style="BORDER-TOP: #d0d0d0 1px solid;BORDER-BOTTOM: #d0d0d0 1px solid;BACKGROUND-COLOR: #dcf3c2"><br/>
			    <ol>
                            <li><?php echo $this->_tpl_vars['install_messages']['terms_of_service_content_1']; ?>
</li>
			    <li><?php echo $this->_tpl_vars['install_messages']['terms_of_service_content_2']; ?>
</li>
			    <li><?php echo $this->_tpl_vars['install_messages']['terms_of_service_content_3']; ?>
</li>
			    <li><?php echo $this->_tpl_vars['install_messages']['terms_of_service_content_4']; ?>
</li>
			    <li><?php echo $this->_tpl_vars['install_messages']['terms_of_service_content_5']; ?>
</li>
			    <li><?php echo $this->_tpl_vars['install_messages']['terms_of_service_content_6']; ?>
</li>
			    <li><?php echo $this->_tpl_vars['install_messages']['terms_of_service_content_7']; ?>
</li>
			    <li><?php echo $this->_tpl_vars['install_messages']['terms_of_service_content_8']; ?>
</li>
			    <li><?php echo $this->_tpl_vars['install_messages']['terms_of_service_content_9']; ?>
</li>
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
                            <td class="installSubMessage"><?php echo $this->_tpl_vars['install_messages']['terms_of_service_content_last']; ?>
</td>
                            <td width="10">&nbsp;</td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td class="installForms"><?php echo $this->_tpl_vars['terms_string']; ?>

                        <form id="install" name="install" method="post" action="install.php">
                          <input type="hidden" name="terms" value="terms">
                          <input type="hidden" name="language" value="<?php echo $this->_tpl_vars['language']; ?>
">
                          <input type="hidden" name="install_step" value="<?php echo $this->_tpl_vars['install_step']; ?>
">
                          <input type="submit" value=" OK " style="width:83">
                        </form>
                      </td>
                    </tr>
                  </table>
                <?php elseif ($this->_tpl_vars['install_step'] == 3): ?>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="installMessage"><?php echo $this->_tpl_vars['install_messages']['database_select_title']; ?>
</td>
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
                            <td class="installSubMessage"><div align="center"><?php echo $this->_tpl_vars['install_messages']['database_select_comment']; ?>
</div></td>
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
                            <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['db_list']), $this);?>

                          </select><br/><br/>
                          <input type="hidden" name="install_step" value="<?php echo $this->_tpl_vars['install_step']; ?>
">
                          <input type="hidden" name="language" value="<?php echo $this->_tpl_vars['language']; ?>
">
                          <input type="submit" value="OK" style="width:83">
                        </form>
                      </td>
                    </tr>
                  </table>
                <?php elseif ($this->_tpl_vars['install_step'] == 4): ?>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="installMessage"><?php echo $this->_tpl_vars['install_messages']['database_config_title']; ?>
</td>
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
                            <td class="installSubMessage"><?php echo $this->_tpl_vars['install_messages']['database_config_comment']; ?>
</td>
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
                      <?php if ($this->_tpl_vars['file_exist_flag']): ?>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="10">&nbsp;</td>
                            <td class="installErrorMessage"><?php echo $this->_tpl_vars['error_message']['config_file_exist']; ?>
</td>
                            <td width="10">&nbsp;</td>
                          </tr>
                        </table>
                      <?php endif; ?>
                      <?php if ($this->_tpl_vars['wrong_db_config_flag']): ?>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="10">&nbsp;</td>
                            <td class="installErrorMessage"><?php echo $this->_tpl_vars['error_message']['database_config_is_wrong']; ?>
</td>
                            <td width="10">&nbsp;</td>
                          </tr>
                        </table>
                      <?php endif; ?>
                      <?php if ($this->_tpl_vars['file_handling_error']): ?>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="10">&nbsp;</td>
                            <td class="installErrorMessage"><?php echo $this->_tpl_vars['error_message']['file_handling_error']; ?>
</td>
                            <td width="10">&nbsp;</td>
                          </tr>
                        </table>
                      <?php endif; ?>
                        <form id="install" name="install" method="post" action="install.php">
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="10">&nbsp;</td>
                              <td width="60" class="installInputTitles">&nbsp;</td>
                              <td width="90" class="installInputTitles">HOST</td>
                              <td><input type="text" name="host" value="<?php echo $this->_tpl_vars['req']['host']; ?>
" class="installInputForms" ></td>
                              <td width="10">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="10">&nbsp;</td>
                              <td class="installInputTitles">&nbsp;</td>
                              <td class="installInputTitles">D&nbsp;&nbsp;&nbsp;B</td>
                              <td><input type="text" name="db" value="<?php echo $this->_tpl_vars['req']['db']; ?>
" class="installInputForms"></td>
                              <td width="10">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="10">&nbsp;</td>
                              <td class="installInputTitles">&nbsp;</td>
                              <td class="installInputTitles">USERNAME</td>
                              <td><input type="text" name="userid" value="<?php echo $this->_tpl_vars['req']['userid']; ?>
" class="installInputForms" ></td>
                              <td width="10">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="10">&nbsp;</td>
                              <td class="installInputTitles">&nbsp;</td>
                              <td class="installInputTitles">PASSWORD</td>
                              <td><input type="password" name="password" value="<?php echo $this->_tpl_vars['req']['password']; ?>
" class="installInputForms" ></td>
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
                          <input type="hidden" name="install_step" value="<?php echo $this->_tpl_vars['install_step']; ?>
">
                          <input type="hidden" name="language" value="<?php echo $this->_tpl_vars['language']; ?>
">
                          <input type="hidden" name="db_select" value="<?php echo $this->_tpl_vars['db_select']; ?>
">
                          <input type="submit" value="OK" style="width:100"></td>
                              <td width="10">&nbsp;</td>
                            </tr>
                          </table>
                        </form>
                      </td>
                    </tr>
                  </table>
                <?php elseif ($this->_tpl_vars['install_step'] == 5): ?>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="installMessage"><?php echo $this->_tpl_vars['install_messages']['administrator_config_title']; ?>
</td>
                    </tr>
                    <tr>
                      <td class="installMessage">Administrator Configuration</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td class="installForms">
                      <?php if ($this->_tpl_vars['admin_input_is_no_flag']): ?>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="10">&nbsp;</td>
                            <td class="installErrorMessage"><?php echo $this->_tpl_vars['error_message']['admin_input_is_no']; ?>
</td>
                            <td width="10">&nbsp;</td>
                          </tr>
                        </table>
                      <?php endif; ?>
                      <?php if ($this->_tpl_vars['admin_input_is_wrong_flag']): ?>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="10">&nbsp;</td>
                            <td class="installErrorMessage"><?php echo $this->_tpl_vars['error_message']['admin_input_is_wrong']; ?>
</td>
                            <td width="10">&nbsp;</td>
                          </tr>
                        </table>
                      <?php endif; ?>
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
                        <input type="hidden" name="language" value="<?php echo $this->_tpl_vars['language']; ?>
">
                        <input type="hidden" name="install_step" value="<?php echo $this->_tpl_vars['install_step']; ?>
">
                        <input type="submit" value="OK" style="width:100"></td>
                              <td width="10">&nbsp;</td>
                            </tr>
                          </table>
                        </form>
                      </td>
                    </tr>
                  </table>
                <?php elseif ($this->_tpl_vars['install_step'] == 6): ?>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="installMessage"><?php echo $this->_tpl_vars['install_messages']['install_completed_title']; ?>
</td>
                    </tr>
                    <tr>
                      <td class="installMessage">Install Completed</td>
                    </tr>
                    <tr>
                      <td class="installErrorMessage">
                      <?php if ($this->_tpl_vars['is_initiated_flag']): ?>
                      <BR/><BR/>
                        <?php echo $this->_tpl_vars['error_message']['install_completed_already']; ?>
<BR/><BR/>&nbsp;
                      <?php else: ?><BR/><BR/>
                      <?php echo $this->_tpl_vars['install_messages']['install_completed_comment']; ?>

                      <BR/><BR/><BR/>&nbsp;
                      <?php endif; ?></td>
                    </tr>
                    <tr>
                      <td class="installForms"><a href="./manager.php"><?php echo $this->_tpl_vars['application_name']; ?>
 Manager Page</a></td>
                    </tr>
                    <tr>
                      <td><BR/><BR/><BR/>&nbsp;</td>
                    </tr>
                    <tr>
                  </table>
                <?php endif; ?>  
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
                <td class="bottomApplication"> <?php echo $this->_tpl_vars['application_name_version']; ?>
&nbsp;&nbsp;&nbsp;<a href="<?php echo $this->_tpl_vars['my_home']; ?>
"><?php echo $this->_tpl_vars['my_nick']; ?>
</a>&nbsp;&nbsp;&nbsp;</td>
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