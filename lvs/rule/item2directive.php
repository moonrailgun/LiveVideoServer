<?php
require ('../../include/init.inc.php');

$website_id = $search = '';
extract($_GET, EXTR_IF_EXISTS);

$table_name = LVSCommon::$tool2directive;
$item_table_name = "lvs_item";
$column = array(
  "$table_name.id",
  "$table_name.website_id",
  "$table_name.tool_id",
  "$table_name.address",
  "$table_name.command",
  "$table_name.param",
  "$item_table_name.tool_name",
  " $item_table_name.tool_direct"
);
$column = join(",", $column);
if($website_id){
  $query = "SELECT $column FROM $table_name LEFT JOIN $item_table_name ON $table_name.tool_id = $item_table_name.id WHERE website_id=1";
}else{
  $query = "SELECT $column FROM $table_name LEFT JOIN $item_table_name ON $table_name.tool_id = $item_table_name.id";
}
$list = LVSCommon::query($query);

$website_id_list = LVSWebsite::getWebsiteIdList();

//追加操作的确认层
$confirm_html = OSAdmin::renderJsConfirm("icon-remove");

Template::assign('osadmin_action_confirm', $confirm_html);
Template::assign("data_list",$list);
Template::assign("website_id_list",$website_id_list);
Template::assign("_GET",$_GET);
Template::display("lvs/rule/item2directive.tpl");
