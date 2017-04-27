<?php
require ('../../include/init.inc.php');
$id = $tool_type_id = $tool_name = $tool_direct = $queue_flag = '';
extract($_REQUEST, EXTR_IF_EXISTS);

$item_group_id_list = LVSItemGroup::getGroupIdList();
$queue_flag_list = LVSItem::getQueueFlagList();

if(!$id){
  OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
}else {
  $item_data = LVSItem::getItemInfoById($id);

  if(Common::isPost()){
    if(!$tool_type_id || !$tool_name || !$tool_direct){
      OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
    }else{
      $item_data = array(
        'tool_type_id' => $tool_type_id,
        'tool_name' => $tool_name,
        'tool_direct' => $tool_direct,
        'queue_flag' => $queue_flag,
      );
      $result = LVSItem::updateItem($id, $item_data);
      if ($result>=0) {
        SysLog::addLog(UserSession::getUserName(), 'MODIFY', 'Item', $id, json_encode($item_data));
        Common::exitWithSuccess('更新完成', 'lvs/rule/item.php');
      } else {
        OSAdmin::alert('error');
      }
    }
  }
}

Template::assign("item_group_id_list",$item_group_id_list);
Template::assign("queue_flag_list",$queue_flag_list);
Template::assign("item_data",$item_data);
Template::display("lvs/rule/item_modify.tpl");
