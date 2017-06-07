<?php
require ('../../include/init.inc.php');
$actor_id = $start_date = $end_date = '';
extract($_GET, EXTR_IF_EXISTS);

if(!$start_date || !$end_date) {
  $start_date = date("Y-m-d",mktime(0,0,0,date("m"),date("d")-6,date("Y")));
  $end_date = date("Y-m-d",mktime(0,0,0,date("m"),date("d")+1,date("Y")));
}

$query = "SELECT * FROM lvs_item_log LEFT JOIN lvs_actor ON lvs_item_log.actorID = lvs_actor.user_id";
if($actor_id) {
  $query .= " WHERE lvs_actor.id = $actor_id";
}
if(!!$start_date && !!$end_date) {
  if ($actor_id) {
    $query .= ' AND lvs_item_log.createdDate BETWEEN "'.$start_date.'" AND "'.$end_date.'" ';
  }else {
    $query .= ' WHERE lvs_item_log.createdDate BETWEEN "'.$start_date.'" AND "'.$end_date.'" ';
  }
}


$data_list = LVSCommon::query($query);
$data_count = LVSCommon::query("SELECT SUM(totalCost) FROM lvs_item_log");

$website_id_list = LVSWebsite::getWebsiteIdList();
$group_id_list = LVSGroup::getGroupIdList();

Template::assign("website_id_list",$website_id_list);
Template::assign("group_id_list",$group_id_list);
Template::assign("data_list",$data_list);
Template::assign("data_count",$data_count[0]);
Template::assign("osadmin_action_confirm",$confirm_html);
Template::display("lvs/trade/consume.tpl");
