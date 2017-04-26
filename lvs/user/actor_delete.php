<?php
require ('../../include/init.inc.php');
$actor_id = '';
extract($_REQUEST, EXTR_IF_EXISTS);

if(!$actor_id) {
  Common::exitWithError('删除失败:'.ErrorMessage::NEED_PARAM, 'lvs/user/actor.php');
}else{
  $actor_info = LVSActor::getActorByID($actor_id);
  $result = LVSActor::unableActor($actor_id);
  if ($result>=0) {
    SysLog::addLog(UserSession::getUserName(), 'DELETE', 'Actor' ,$actor_id ,json_encode($actor_info));
    Common::exitWithSuccess('已删除主播','lvs/user/actor.php' );
  }else{
    Common::exitWithError('删除失败', 'lvs/user/actor.php');
  }
}
