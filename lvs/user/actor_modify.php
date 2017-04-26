<?php
require ('../../include/init.inc.php');
$actor_id = $website_id = $group_id = $real_name = $sex = $live_id = $channel_id = $province = $city = $remark = '';
extract($_REQUEST, EXTR_IF_EXISTS);

$website_id_list = LVSWebsite::getWebsiteIdList();
$group_id_list = LVSGroup::getGroupIdList();
$province_list = City::getProvince();

if(!$actor_id){
  OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
}else{
  $actor_data = LVSActor::getActorByID($actor_id);
  $actor_data['province'] = explode("-",$actor_data["address"])[0];
  $actor_data['city'] = explode("-",$actor_data["address"])[1];

  if(Common::isPost()){
    if(!$website_id||!$group_id||!$real_name||!$sex||!$live_id||!$channel_id||!$province||!$city) {
      OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
    }else {
      $actor_data = array(
        'website_id' => $website_id,
        'group_id' => $group_id,
        'real_name' => $real_name,
        'sex' => $sex,
        'live_id' => $live_id,
        'user_id' => LVSWebsite::getWebsiteShortNameByID($website_id).$live_id,
        'channel_id' => $channel_id,
        'address' => $province.'-'.$city,
        'remark' => $remark
      );
      $result = LVSActor::updateActor($actor_id, $actor_data);
      if ($result>=0) {
        SysLog::addLog(UserSession::getUserName(), 'MODIFY', 'Actor', $actor_id, json_encode($actor_data));
        Common::exitWithSuccess('更新完成', 'lvs/user/actor.php');
      } else {
        OSAdmin::alert('error');
      }
    }
  }
}

Template::assign("website_id_list",$website_id_list);
Template::assign("group_id_list",$group_id_list);
Template::assign("province_list",$province_list);
Template::assign("actor_data",$actor_data);
Template::display("lvs/user/actor_modify.tpl");
