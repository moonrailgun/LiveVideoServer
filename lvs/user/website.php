<?php
require ('../../include/init.inc.php');

extract($_REQUEST, EXTR_IF_EXISTS);

$website_list = LVSWebsite::getWebsiteList();

//追加操作的确认层
$confirm_html = OSAdmin::renderJsConfirm("icon-remove,icon-repeat");

Template::assign("website_list",$website_list);
Template::assign("osadmin_action_confirm",$confirm_html);
Template::display("lvs/user/website.tpl");
