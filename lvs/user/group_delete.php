<?php
require ('../../include/init.inc.php');
$group_id = '';
extract($_REQUEST, EXTR_IF_EXISTS);

if(!$group_id) {
  Common::exitWithError('删除失败:'.ErrorMessage::NEED_PARAM, 'lvs/user/group.php');
}else{
  $group_info = LVSGroup::getGroupByID($group_id);
  $result = LVSGroup::deleteGroup($group_id);
  if ($result>=0) {
    SysLog::addLog(UserSession::getUserName(), 'DELETE', 'Group' ,$group_id ,json_encode($group_info));
    Common::exitWithSuccess('已删除工会','lvs/user/group.php' );
  }else{
    Common::exitWithError('删除失败', 'lvs/user/group.php');
  }
}
