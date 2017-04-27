<?php
require ('../../include/init.inc.php');
$tool_type_id = $tool_name = $tool_direct = $queue_flag = '';
extract($_POST, EXTR_IF_EXISTS);

$item_group_id_list = LVSItemGroup::getGroupIdList();
$queue_flag_list = LVSItem::getQueueFlagList();

if(Common::isPost()) {
  if(!$tool_type_id || !$tool_name || !$tool_direct){
    OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
  }else{
    $item_data = array(
      'tool_type_id' => $tool_type_id,
      'tool_name' => $tool_name,
      'tool_direct' => $tool_direct,
      'queue_flag' => $queue_flag,
    );

    $id = LVSItem::addItem($item_data);
    if($id) {
      SysLog::addLog(UserSession::getUserName(), 'ADD', 'Item' ,$id, json_encode($item_data));
			Common::exitWithSuccess('道具添加成功','lvs/rule/item.php');
    }else{
      OSAdmin::alert("error");
    }
  }
}

Template::assign("item_group_id_list",$item_group_id_list);
Template::assign("queue_flag_list",$queue_flag_list);
Template::assign("item_data",$_POST);
Template::display("lvs/rule/item_modify.tpl");
