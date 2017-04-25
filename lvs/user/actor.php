<?php
require ('../../include/init.inc.php');

$group_id = $website_id = $province = $city = '';
extract($_GET, EXTR_IF_EXISTS);


$website_id_list = LVSWebsite::getWebsiteIdList();
$group_id_list = LVSGroup::getGroupIdList();
$province_list = City::getProvince();

if(Common::isGet()) {
  if($group_id || $website_id || $province || $city){
    // $condition["AND"]["is_invalid"] = 0;
    if($group_id){
      $condition["AND"]["group_id"] = $group_id;
    }
    if($website_id){
      $condition["AND"]["website_id"] = $website_id;
    }
    if($province || $city){
      $condition["LIKE"]["address"] = $province."-".$city;
    }

    $actor_list = LVSActor::getActorListWithCondition($condition);
  }else{
    $actor_list = LVSActor::getAllActor();
  }
}

//追加操作的确认层
$confirm_html = OSAdmin::renderJsConfirm("icon-remove,icon-repeat");

Template::assign("province_list",$province_list);
Template::assign("website_id_list",$website_id_list);
Template::assign("group_id_list",$group_id_list);
Template::assign("actor_list",$actor_list);
Template::assign("osadmin_action_confirm",$confirm_html);
Template::assign("_GET",$_GET);
Template::display("lvs/user/actor.tpl");
