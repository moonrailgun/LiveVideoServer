<?php
require ('../../include/init.inc.php');
$group_name = $remark = '';
extract($_POST, EXTR_IF_EXISTS);

if(Common::isPost()){
  $exist = LVSGroup::getGroupByName($group_name);
  if($exist){
    OSAdmin::alert("error",ErrorMessage::NAME_CONFLICT);
  } elseif (!$group_name) {
    OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
  } else{
    $group_data = array(
      "group_name" => $group_name,
      "remark" => $remark
    );
    $group_id = LVSGroup::addGroup($group_data);
    if($group_id) {
      SysLog::addLog(UserSession::getUserName(), 'ADD', 'Group' ,$group_id, json_encode($group_data));
			Common::exitWithSuccess ('工会添加成功','lvs/user/group.php');
    }else{
      OSAdmin::alert("error");
    }
  }
}


Template::assign("group_data",$_POST);
Template::display("lvs/user/group_modify.tpl");
