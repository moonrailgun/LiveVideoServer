<?php
require ('../../include/init.inc.php');
$website_id = $group_id = $real_name = $sex = $live_id = $channel_id = $province = $city = $remark = '';
extract($_POST, EXTR_IF_EXISTS);

$website_id_list = LVSWebsite::getWebsiteIdList();
$group_id_list = LVSGroup::getGroupIdList();
$province_list = City::getProvince();

if(Common::isPost()){
  if (!$website_id||!$group_id||!$real_name||!$sex||!$live_id||!$channel_id||!$province||!$city) {
    OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
  } else{
    $actor_data = array(
      "website_id" => $website_id,
      "group_id" => $group_id,
      "real_name" => $real_name,
      "sex" => $sex,
      "live_id" => $live_id,
      "user_id" => LVSWebsite::getWebsiteShortNameByID($website_id).$live_id,
      "channel_id" => $channel_id,
      "address" => $province.'-'.$city,
      "remark" => $remark
    );
    $actor_id = LVSActor::addActor($actor_data);
    if($actor_id) {
      SysLog::addLog(UserSession::getUserName(), 'ADD', 'Actor' ,$actor_id, json_encode($actor_data));
			Common::exitWithSuccess ('主播添加成功','lvs/user/actor.php');
    }else{
      OSAdmin::alert("error");
    }
  }
}

Template::assign("website_id_list",$website_id_list);
Template::assign("group_id_list",$group_id_list);
Template::assign("province_list",$province_list);
Template::assign("actor_data",$_POST);
Template::display("lvs/user/actor_modify.tpl");
