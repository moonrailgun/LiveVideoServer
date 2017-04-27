<?php
require ('../../include/init.inc.php');
$group_id = '';
extract($_REQUEST, EXTR_IF_EXISTS);

if(!$group_id) {
  Common::exitWithError('删除失败:'.ErrorMessage::NEED_PARAM, 'lvs/rule/item_group.php');
}else{
  $group_info = LVSItemGroup::getGroupByID($group_id);
  $result = LVSItemGroup::deleteGroup($group_id);
  if ($result>=0) {
    SysLog::addLog(UserSession::getUserName(), 'DELETE', 'ItemGroup' ,$group_id ,json_encode($group_info));
    Common::exitWithSuccess('已删除道具组','lvs/rule/item_group.php' );
  }else{
    Common::exitWithError('删除失败', 'lvs/rule/item_group.php');
  }
}
