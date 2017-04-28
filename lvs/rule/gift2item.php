<?php
require ('../../include/init.inc.php');

$website_id = $search = '';
extract($_GET, EXTR_IF_EXISTS);

if($website_id){
  $condition['AND'] = array(
    'website_id' => $website_id
  );
  $list = LVSCommon::getList(LVSCommon::$gift2senderInfo,$condition);
}else{
  $list = LVSCommon::getList(LVSCommon::$gift2senderInfo);
}

$website_id_list = LVSWebsite::getWebsiteIdList();
$gift_type_id_list = LVSGift::getGiftTypeIdList();
$item_id_list = LVSItem::getItemIdList();

//追加操作的确认层
$confirm_html = OSAdmin::renderJsConfirm("icon-remove");

Template::assign('osadmin_action_confirm', $confirm_html);
Template::assign("data_list",$list);
Template::assign("website_id_list",$website_id_list);
Template::assign("item_id_list",$item_id_list);
Template::assign("gift_type_id_list",$gift_type_id_list);
Template::assign("_GET",$_GET);
Template::display("lvs/rule/gift2item.tpl");
