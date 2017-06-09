<?php
require ('../../include/init.inc.php');
$website_id = $group_id = $actor_id = '';
extract($_GET, EXTR_IF_EXISTS);

if(!!$website_id) {
  $condition['AND']['website_id'] = $website_id;
}
if(!!$group_id) {
  $condition['AND']['group_id'] = $group_id;
}
if(!!$actor_id) {
  $condition['AND']['actor_id'] = $actor_id;
}
$actor_list = LVSActor::getActorListWithCondition($condition);
$website_id_list = LVSWebsite::getWebsiteIdList();
$group_id_list = LVSGroup::getGroupIdList();

Template::assign("website_id_list",$website_id_list);
Template::assign("group_id_list",$group_id_list);
Template::assign("actor_list", $actor_list);
Template::display("lvs/trade/balance.tpl");
