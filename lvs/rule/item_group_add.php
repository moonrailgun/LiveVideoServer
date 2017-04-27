<?php
require ('../../include/init.inc.php');
$group_name = '';
extract($_POST, EXTR_IF_EXISTS);

if(Common::isPost()){
  $exist = LVSItemGroup::getGroupByName($group_name);
  if($exist){
    OSAdmin::alert("error",ErrorMessage::NAME_CONFLICT);
  } elseif (!$group_name) {
    OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
  } else{
    $group_data = array(
      "group_name" => $group_name
    );
    $group_id = LVSItemGroup::addGroup($group_data);
    if($group_id) {
      SysLog::addLog(UserSession::getUserName(), 'ADD', 'ItemGroup' ,$group_id, json_encode($group_data));
			Common::exitWithSuccess ('道具组添加成功','lvs/rule/item_group.php');
    }else{
      OSAdmin::alert("error");
    }
  }
}


Template::assign("group_data",$_POST);
Template::display("lvs/rule/item_group_modify.tpl");
