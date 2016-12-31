<?php

require '../include/init.inc.php';

$rule_id = $website_id = $item_id = $item_cost = '';
extract($_REQUEST, EXTR_IF_EXISTS);

if ($rule_id == '') {
OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
}else{
  $condition = array('id' => $rule_id);
  if (Common::isGet()) {
    $rule_info = LVSRule::getRuleByCondition(LVSRule::$cost_table_name, $condition);
  } elseif (Common::isPost()) {
    if ($rule_id == ''||$website_id == ''||$item_id == ''||$item_cost == '') {
        OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
    }else{
      $rule_data = array(
        "website_id" => $website_id,
        "item_id" => $item_id,
        "item_cost" => $item_cost
      );
      $result = LVSRule::updateRule(LVSRule::$cost_table_name, $condition, $rule_data);
      if ($result >= 0) {
          SysLog::addLog(UserSession::getUserName(), 'MODIFY', 'Rule', $rule_id, json_encode($rule_data));
          Common::exitWithSuccess('更新完成', 'lvs/rule_cost.php');
      } else {
          OSAdmin::alert('error');
      }
    }
  }
}

$website_id_list = LVSWebsite::getWebsiteIdList();
$item_id_list = LVSItem::getItemIdList();

Template::assign("website_id_list",$website_id_list);
Template::assign("item_id_list",$item_id_list);
Template::assign("rule_id",$rule_id);
Template::assign('rule_info', $rule_info);
Template::display('lvs/rule_cost_modify.tpl');
