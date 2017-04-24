<?php
require ('../../include/init.inc.php');

$website_id_list = LVSWebsite::getWebsiteIdList();
$website_ip_list = LVSWebsiteIP::getWebsiteIPList();

//追加操作的确认层
$confirm_html = OSAdmin::renderJsConfirm("icon-remove,icon-repeat");

Template::assign("website_id_list",$website_id_list);
Template::assign("website_ip_list",$website_ip_list);
Template::assign("osadmin_action_confirm",$confirm_html);
Template::display("lvs/user/website_ip.tpl");
