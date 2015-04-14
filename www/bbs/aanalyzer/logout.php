<?php
require_once "Aokio.Cookie.class.php";
require_once "Aokio.Common.Manager.php";

$cookie = new Aokio_Cookie();
$cookie->clearAdminCookieInfo();

AokioCommonManager::redirectPage("login.php");

?>