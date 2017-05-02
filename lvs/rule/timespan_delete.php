<?php
require ('../../include/init.inc.php');
$id = '';
extract($_REQUEST, EXTR_IF_EXISTS);

if(!$id){
  Common::exitWithError('删除失败:'.ErrorMessage::NEED_PARAM, 'lvs/rule/timespan.php');
}else{
  $condition['AND'] = array(
    'id' => $id
  );
  $data = LVSCommon::getList(LVSCommon::$timespan, $condition)[0];
  $result = LVSCommon::delete(LVSCommon::$timespan, $condition);
  if($result>=0){
    SysLog::addLog(UserSession::getUserName(), 'DELETE', 'Timespan', $id, json_encode($data));
    Common::exitWithSuccess('已删除规则','lvs/rule/timespan.php' );
  }else{
    Common::exitWithError('删除失败', 'lvs/rule/timespan.php');
  }
}
