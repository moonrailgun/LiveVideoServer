<?php
require ('../../include/init.inc.php');
$rule_id = '';
extract($_REQUEST, EXTR_IF_EXISTS);

if(!$rule_id) {
  Common::exitWithError('删除失败:'.ErrorMessage::NEED_PARAM, 'lvs/rule/acquisition.php');
}else{
  $condition = array('id' => $rule_id);
  $rule_info = LVSRule::getRuleByCondition(LVSRule::$acquisition_table_name, $condition);
  $result = LVSRule::delRule(LVSRule::$acquisition_table_name, $condition);

  if ($result >= 0) {
    SysLog::addLog(UserSession::getUserName(), 'DELETE', 'AcquisitionRule', $rule_id, json_encode($rule_info));
    Common::exitWithSuccess('已删除规则','lvs/rule/acquisition.php');
  }else{
    OSAdmin::alert("error");
  }
}
