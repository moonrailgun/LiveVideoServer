<?php
require ('../../include/init.inc.php');
$group_id = $group_name = $remark = '';
extract($_REQUEST, EXTR_IF_EXISTS);

if(!$group_id){
  OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
}else{
  $group_data = LVSGroup::getGroupByID($group_id);

  if (Common::isPost()) {
    if (!$group_name) {
      OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
    }else if(LVSGroup::getGroupByName($group_name)){
      OSAdmin::alert("error",ErrorMessage::NAME_CONFLICT);
    }else {
      $group_data = array(
        'group_name' => $group_name,
        'remark' => $remark
      );
      $result = LVSGroup::updateGroup($group_id, $group_data);
      if ($result) {
        SysLog::addLog(UserSession::getUserName(), 'MODIFY', 'Group', $group_id, json_encode($group_data));
        Common::exitWithSuccess('更新完成', 'lvs/user/group.php');
      } else {
        OSAdmin::alert('error');
      }
    }
  }
}


Template::assign("group_data",$group_data);
Template::display("lvs/user/group_modify.tpl");
