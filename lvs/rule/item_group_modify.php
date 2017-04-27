<?php
require ('../../include/init.inc.php');
$group_id = $group_name = '';
extract($_REQUEST, EXTR_IF_EXISTS);

if(!$group_id){
  OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
}else{
  $group_data = LVSItemGroup::getGroupByID($group_id);

  if (Common::isPost()) {
    if (!$group_name) {
      OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
    }else if(LVSItemGroup::getGroupByName($group_name)){
      OSAdmin::alert("error",ErrorMessage::NAME_CONFLICT);
    }else {
      $group_data = array(
        'group_name' => $group_name
      );
      $result = LVSItemGroup::updateGroup($group_id, $group_data);
      if ($result>=0) {
        SysLog::addLog(UserSession::getUserName(), 'MODIFY', 'ItemGroup', $group_id, json_encode($group_data));
        Common::exitWithSuccess('更新完成', 'lvs/rule/item_group.php');
      } else {
        OSAdmin::alert('error');
      }
    }
  }
}


Template::assign("group_data",$group_data);
Template::display("lvs/rule/item_group_modify.tpl");
