<?php
require ('../include/init.inc.php');
$actor_nick_name = $actor_phone = $website_id = $actor_real_name = '';
extract($_POST, EXTR_IF_EXISTS);

$website_id_list = LVSWebsite::getWebsiteIdList();

if(Common::isPost()){
  $website_info = LVSWebsite::getWebsiteInfoById($website_id);
  $website_short_name = $website_info['website_short_name'];
  $generated_name = $website_short_name . $actor_nick_name;

  $exist = LVSActor::getActorNameByGeneratedName($generated_name);
  if($exist){
    OSAdmin::alert("error",ErrorMessage::NAME_CONFLICT);
  }else{
    $actor_data = array(
      "actor_nick_name" => $actor_nick_name,
      "actor_website" => $website_id,
      "actor_generated_name" => $generated_name,
      "actor_phone" => $actor_phone,
      "actor_real_name" => $actor_real_name,
      "actor_currency" => 0,
      "actor_is_actived" => 1
    );
    $actor_id = LVSActor::addActor($actor_data);
    if($actor_id){
      SysLog::addLog(UserSession::getUserName(), 'ADD', 'Actor' ,$user_id, json_encode($actor_data));
			Common::exitWithSuccess ('客户添加成功','lvs/actor.php');
    }else{
			OSAdmin::alert("error");
		}
  }
}

Template::assign("_POST",$_POST);
Template::assign("website_id_list", $website_id_list);
Template::display("lvs/actor_add.tpl");
?>
