<?php

require '../include/init.inc.php';

$rule_id = $website_id = $actor_id = $machine_id = $machine_status = $item_id = $item_status = '';
extract($_REQUEST, EXTR_IF_EXISTS);

if ($rule_id == '') {
  OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
}else{
  $condition = array('id' => $rule_id);
  if (Common::isGet()) {
    $rule_info = LVSRule::getRuleByCondition(LVSRule::$item_available_table_name, $condition);
  } elseif (Common::isPost()) {
    if ($rule_id == '' || $website_id == '' || $actor_id == '' || $machine_id == '' || $machine_status == '' || $item_id == '' || $item_status == '') {
        OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
    }else{
      $rule_data = array(
        'website_id' => $website_id,
        'actor_id' => $actor_id,
        'machine_id' => $machine_id,
        'machine_status' => $machine_status,
        'item_id' => $item_id,
        'item_status' => $item_status
      );
      $result = LVSRule::updateRule(LVSRule::$item_available_table_name, $condition, $rule_data);
      if ($result >= 0) {
          SysLog::addLog(UserSession::getUserName(), 'MODIFY', 'Rule', $rule_id, json_encode($rule_data));
          Common::exitWithSuccess('更新完成', 'lvs/rule_item_available.php');
      } else {
          OSAdmin::alert('error');
      }
    }
  }
}

$website_id_list = LVSWebsite::getWebsiteIdList();
$actor_id_list = LVSActor::getActorIdList();
$status_list = LVSRule::getStatusList();
$item_id_list = LVSItem::getItemIdList();

Template::assign("rule_id",$rule_id);
Template::assign("website_id_list",$website_id_list);
Template::assign("status_list",$status_list);
Template::assign("item_id_list",$item_id_list);
Template::assign("actor_id_list_json",json_encode($actor_id_list, JSON_UNESCAPED_UNICODE));
Template::assign('rule_info', $rule_info);
Template::display('lvs/rule_item_available_modify.tpl');
