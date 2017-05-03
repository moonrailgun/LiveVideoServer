<?php
require ('../../include/init.inc.php');
$id = $select_ids = $item_state = '';
extract($_POST, EXTR_IF_EXISTS);

$table_name = LVSCommon::$itemValid;
$item_state_list = LVSItem::getItemStateList();

if(Common::isPost()){
  if($item_state == ''){
    Common::exitWithError('修改失败:缺少参数', 'lvs/rule/item_available.php',100000);
  }

  if($id) {
    $condition = array(
      'id' => $id
    );
  }else{
    $condition = array(
      'id' => $select_ids
    );
  }
  $result = LVSCommon::update($table_name, array('state' => $item_state), $condition);
  if($result >= 0){
    SysLog::addLog(UserSession::getUserName(), 'MODIFY', 'ItemAvailable', $result, json_encode($item_state));
    Common::exitWithSuccess('更新完成,修改为'.$item_state_list[$item_state], 'lvs/rule/item_available.php');
  }
}
