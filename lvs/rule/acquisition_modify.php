<?php
require ('../../include/init.inc.php');
$rule_id = $website_id = $user_id_field = $user_name_field = $gift_type_field = $gift_amount_field = $actor_id_field = $actor_name_field = '';
extract($_REQUEST, EXTR_IF_EXISTS);

$website_id_list = LVSWebsite::getWebsiteIdList();

if(!$rule_id){
  OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
}else{
  $condition['AND'] = array("id" => $rule_id);
  $rule_data = LVSRule::getRuleByCondition(LVSRule::$acquisition_table_name, $condition);
  if($rule_data){
    $rule_data = $rule_data[0];
  }
  if(Common::isPost()){
    if(!$website_id||!$user_id_field||!$user_name_field||!$gift_type_field||!$gift_amount_field||!$actor_id_field||!$actor_name_field) {
      OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
    }else{
      $condition['AND'] = array("id[!]" => $rule_id, "website_id" => $website_id);
      $exist = LVSRule::getRuleByCondition(LVSRule::$acquisition_table_name, $condition);
      if($exist){
        OSAdmin::alert("error",ErrorMessage::NAME_CONFLICT);
      }else{
        $condition['AND'] = array("id" => $rule_id);
        $rule_data = array(
          "website_id" => $website_id,
          'user_id_field' => $user_id_field,
          'user_name_field' => $user_name_field,
          'actor_id_field' => $actor_id_field,
          'actor_name_field' => $actor_name_field,
          'gift_type_field' => $gift_type_field,
          'gift_amount_field' => $gift_amount_field
        );

        $result = LVSRule::updateRule(LVSRule::$acquisition_table_name, $condition, $rule_data);
        if ($result>=0) {
          SysLog::addLog(UserSession::getUserName(), 'MODIFY', 'AcquisitionRule', $rule_id, json_encode($rule_data));
          Common::exitWithSuccess('更新完成', 'lvs/rule/acquisition.php');
        } else {
          OSAdmin::alert('error');
        }
      }
    }
  }
}

Template::assign("website_id_list",$website_id_list);
Template::assign("rule_data",$rule_data);
Template::display("lvs/rule/acquisition_modify.tpl");
