<?php
require ('../../include/init.inc.php');

$website_id = '';
extract($_GET, EXTR_IF_EXISTS);

$website_id_list = LVSWebsite::getWebsiteIdList();

if($website_id) {
  $website_ip_list = LVSWebsiteIP::getWebsiteIPListByWebsiteID($website_id);
}else{
  $website_ip_list = LVSWebsiteIP::getWebsiteIPList();
}

//追加操作的确认层
$confirm_html = OSAdmin::renderJsConfirm("icon-remove,icon-repeat");

Template::assign("website_id_list",$website_id_list);
Template::assign("website_ip_list",$website_ip_list);
Template::assign("osadmin_action_confirm",$confirm_html);
Template::assign("_GET",$_GET);
Template::display("lvs/user/website_ip.tpl");
