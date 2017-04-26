<?php
require ('../../include/init.inc.php');

$website_id = $search = '';
extract($_GET, EXTR_IF_EXISTS);

if($website_id){
  $condition['AND'] = array(
    'website_id' => $website_id
  );
  $gift_list = LVSGift::getGiftBywebsiteID($website_id);
}else{
  $gift_list = LVSGift::getAllGift();
}

$website_id_list = LVSWebsite::getWebsiteIdList();

//追加操作的确认层
$confirm_html = OSAdmin::renderJsConfirm("icon-remove");

Template::assign('osadmin_action_confirm', $confirm_html);
Template::assign("gift_list",$gift_list);
Template::assign("website_id_list",$website_id_list);
Template::assign("_GET",$_GET);
Template::display("lvs/rule/gift.tpl");
