<?php
require ('../../include/init.inc.php');
$website_id = $group_id = $actor_id = $search = $add = '';
extract($_GET, EXTR_IF_EXISTS);

$query = 'SELECT * FROM	lvs_toolValid_rule LEFT JOIN lvs_actor ON lvs_toolValid_rule.actor_id = lvs_actor.id LEFT JOIN lvs_item ON lvs_toolValid_rule.tool_id = lvs_item.id';
if($actor_id){
  $query += " WHERE actor_id = $actor_id";
}
$data_list = LVSCommon::query($query);

$website_id_list = LVSWebsite::getWebsiteIdList();
$group_id_list = LVSGroup::getGroupIdList();
$item_id_list = LVSItem::getItemIdList();
$item_state_list = LVSItem::getItemStateList();

Template::assign("website_id_list",$website_id_list);
Template::assign("group_id_list",$group_id_list);
Template::assign("item_id_list",$item_id_list);
Template::assign("item_state_list",$item_state_list);
Template::assign("data_list",$data_list);
Template::assign("_GET",$_GET);
Template::display("lvs/rule/item_available.tpl");
