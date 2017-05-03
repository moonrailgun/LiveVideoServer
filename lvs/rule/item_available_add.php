<?php
require ('../../include/init.inc.php');
$actor_id = $item_id = '';
extract($_POST, EXTR_IF_EXISTS);

if(!$actor_id && !$item_id){
  Common::exitWithError('添加失败:缺少参数', 'lvs/rule/item_available.php');
}else{
  $condition['AND'] = array(
    'actor_id' => $actor_id,
    'tool_id' => $item_id
  );
  $exist = LVSCommon::getList(LVSCommon::$itemValid, $condition);
  if($exist){
    Common::exitWithError('添加失败:已存在该主播-道具配置', 'lvs/rule/item_available.php');
  }else{
    $data = array(
      'actor_id' => $actor_id,
      'tool_id' => $item_id,
      'state' => 0,
      'state_description' => ''
    );
    $id = LVSCommon::insert(LVSCommon::$itemValid, $data);
    if($id) {
      SysLog::addLog(UserSession::getUserName(), 'ADD', 'ItemAvailable', $id, json_encode($data));
      Common::exitWithSuccess('添加完成', 'lvs/rule/item_available.php');
    }
  }
}
