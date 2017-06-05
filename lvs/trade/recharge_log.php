<?php
require ('../../include/init.inc.php');

$query = "SELECT * FROM lvs_recharge_log LEFT JOIN lvs_actor ON lvs_recharge_log.user_id = lvs_actor.user_id";
$data_list = LVSCommon::query($query);

$website_id_list = LVSWebsite::getWebsiteIdList();
$group_id_list = LVSGroup::getGroupIdList();

Template::assign("website_id_list",$website_id_list);
Template::assign("group_id_list",$group_id_list);
Template::assign("data_list",$data_list);
Template::assign("osadmin_action_confirm",$confirm_html);
Template::display("lvs/trade/recharge_log.tpl");
