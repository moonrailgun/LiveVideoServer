<?php
require ('../../include/init.inc.php');

$group_id = $search = '';
extract($_GET, EXTR_IF_EXISTS);

if($group_id){
  $item_list = LVSItem::getItemByGroupID($group_id);
}else{
  $item_list = LVSItem::getAllItem();
}

$item_group_id_list = LVSItemGroup::getGroupIdList();
$queue_flag_list = LVSItem::getQueueFlagList();

//追加操作的确认层
$confirm_html = OSAdmin::renderJsConfirm("icon-remove");

Template::assign('osadmin_action_confirm', $confirm_html);
Template::assign("item_list",$item_list);
Template::assign("item_group_id_list",$item_group_id_list);
Template::assign("queue_flag_list",$queue_flag_list);
Template::assign("_GET",$_GET);
Template::display("lvs/rule/item.tpl");
