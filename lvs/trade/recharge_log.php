<?php
require ('../../include/init.inc.php');
$actor_id= $start_date = $end_date = '';
extract($_GET, EXTR_IF_EXISTS);

$query = "SELECT * FROM lvs_recharge_log LEFT JOIN lvs_actor ON lvs_recharge_log.user_id = lvs_actor.user_id";
if($actor_id) {
  $query .= " WHERE lvs_actor.id = $actor_id";
}

if(!!$start_date && !!$end_date) {
  if ($actor_id) {
    $query .= ' AND lvs_recharge_log.recharge_time BETWEEN "'.$start_date.'" AND "'.$end_date.'" ';
  }else {
    $query .= ' WHERE lvs_recharge_log.recharge_time BETWEEN "'.$start_date.'" AND "'.$end_date.'" ';
  }
}

$data_list = LVSCommon::query($query);

$data_count = LVSCommon::query("SELECT SUM(recharge_amount), SUM(recharge_rmb) FROM lvs_recharge_log");

$website_id_list = LVSWebsite::getWebsiteIdList();
$group_id_list = LVSGroup::getGroupIdList();

Template::assign("website_id_list",$website_id_list);
Template::assign("group_id_list",$group_id_list);
Template::assign("data_list",$data_list);
Template::assign("data_count",$data_count[0]);
Template::assign("osadmin_action_confirm",$confirm_html);
Template::display("lvs/trade/recharge_log.tpl");
