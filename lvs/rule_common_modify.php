<?php

require '../include/init.inc.php';

$website_id = $time_span = $web_ip = '';
extract($_REQUEST, EXTR_IF_EXISTS);

if ($website_id == '') {
  OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
}else{
  $condition = array('website_id' => $website_id);
  if (Common::isGet()) {
    $rule_info = LVSRule::getRuleByCondition(LVSRule::$common_table_name, $condition);
  } elseif (Common::isPost()) {
    if ($website_id == ''||$time_span == '') {
        OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
    }else{
      $rule_data = array(
        'time_span' => $time_span,
        'web_ip' => $web_ip
      );
      $result = LVSRule::updateRule(LVSRule::$common_table_name, $condition, $rule_data);
      if ($result >= 0) {
          SysLog::addLog(UserSession::getUserName(), 'MODIFY', 'Rule', $website_id, json_encode($rule_data));
          Common::exitWithSuccess('更新完成', 'lvs/rule_common.php');
      } else {
          OSAdmin::alert('error');
      }
    }
  }
}

Template::assign("website_id",$website_id);
Template::assign('rule_info', $rule_info);
Template::display('lvs/rule_common_modify.tpl');
