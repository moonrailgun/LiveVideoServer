<?php
require ('../include/init.inc.php');

$rule_id = $method = "";
extract($_REQUEST, EXTR_IF_EXISTS);

$rule_list = LVSRule::getRule(LVSRule::$item_available_table_name);
$website_id_list = LVSWebsite::getWebsiteIdList();
$actor_id_list = LVSActor::getActorIdList();
$item_id_list = LVSItem::getItemIdList();
$status_list = LVSRule::getStatusList();

if($method == 'del' && !empty($rule_id)) {
  $condition = array('id' => $rule_id);
  $rule_info = LVSRule::getRuleByCondition(LVSRule::$item_available_table_name, $condition);
  $result = LVSRule::delRule(LVSRule::$item_available_table_name, $condition);

  if ($result >= 0) {
    SysLog::addLog(UserSession::getUserName(), 'DELETE', 'Rule' ,$rule_id ,json_encode($rule_info));
    Common::exitWithSuccess('已删除规则','lvs/rule_item_available.php' );
  }else{
    OSAdmin::alert("error");
  }
}

//追加操作的确认层
$confirm_html = OSAdmin::renderJsConfirm("icon-remove");

Template::assign ('osadmin_action_confirm' , $confirm_html);
Template::assign("rule_list",$rule_list);
Template::assign("website_id_list",$website_id_list);
Template::assign("actor_id_list",$actor_id_list);
Template::assign("item_id_list",$item_id_list);
Template::assign("status_list",$status_list);
Template::display("lvs/rule_item_available.tpl");

?>
