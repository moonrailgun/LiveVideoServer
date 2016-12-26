<?php
require ('../include/init.inc.php');

$actor_id = $method = "";
extract($_REQUEST, EXTR_IF_EXISTS);

if($method == 'del' && !empty($actor_id)){
  $actor_info = LVSActor::getActorInfoById($actor_id);
  $result = LVSActor::unableActor($actor_id);

  var_dump($result);

  if ($result>=0) {
    SysLog::addLog(UserSession::getUserName(), 'DELETE', 'Actor' ,$actor_id ,json_encode($actor_info));
    Common::exitWithSuccess('已删除客户','lvs/actor.php' );
  }else{
    OSAdmin::alert("error");
  }
}


$actor_list = LVSActor::getAllActor();

if($actor_list) {
  $website_id_list = LVSWebsite::getWebsiteIdList();
  foreach ($actor_list as $key => $value) {
    $actor_list[$key]['actor_website'] = $website_id_list[$value['actor_website']];
  }
}

//追加操作的确认层
$confirm_html = OSAdmin::renderJsConfirm("icon-remove");

Template::assign ( 'osadmin_action_confirm' , $confirm_html);
Template::assign("actor_list",$actor_list);
Template::display("lvs/actor.tpl");
