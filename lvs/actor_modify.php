<?php

require '../include/init.inc.php';

$actor_id = $actor_nick_name = $actor_phone = $actor_real_name = $website_id = '';
extract($_REQUEST, EXTR_IF_EXISTS);

if ($actor_id == '') {
  OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
}else{
  $website_id_list = LVSWebsite::getWebsiteIdList();

  if (Common::isGet()) {
    $actor_info = LVSActor::getActorInfoById($actor_id);
    $website_id = $actor_info["actor_website"];
  } elseif (Common::isPost()) {
    if ($actor_nick_name == ''||$actor_phone == ''||$actor_real_name == '' || $website_id == '') {
        OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
    }else{
      $website_info = LVSWebsite::getWebsiteInfoById($website_id);
      $website_short_name = $website_info['website_short_name'];
      $generated_name = $website_short_name . $actor_nick_name;

      $exist = LVSActor::getActorNameByGeneratedName($generated_name);
      if($exist){
        OSAdmin::alert("error",ErrorMessage::NAME_CONFLICT);
      }else{
        $actor_info = array(
          "actor_nick_name" => $actor_nick_name,
          "actor_website" => $website_id,
          "actor_generated_name" => $generated_name,
          "actor_phone" => $actor_phone,
          "actor_real_name" => $actor_real_name,
        );
        $result = LVSActor::updateActor($actor_id, $actor_info);
        if($result >= 0){
          SysLog::addLog(UserSession::getUserName(), 'MODIFY', 'Actor', $actor_id, json_encode($actor_info));
          Common::exitWithSuccess('更新完成', 'lvs/actor.php');
        }else{
          OSAdmin::alert("error");
        }
      }
    }
  }
}

Template::assign('actor_id',$actor_id);
Template::assign('actor_info', $actor_info);
Template::assign('website_id_list', $website_id_list);
Template::assign('website_id',$website_id);
Template::display('lvs/actor_modify.tpl');
