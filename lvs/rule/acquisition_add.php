<?php
require ('../../include/init.inc.php');
$website_id = $user_id_field = $user_name_field = $gift_type_field = $gift_amount_field = $actor_id_field = $actor_name_field = '';
extract($_POST, EXTR_IF_EXISTS);

$website_id_list = LVSWebsite::getWebsiteIdList();

if(Common::isPost()){
  $condition["AND"] = array(
    "website_id" => $website_id
  );
  $exist = LVSRule::getRuleByCondition(LVSRule::$acquisition_table_name, $condition);
  if($exist){
    OSAdmin::alert("error",ErrorMessage::NAME_CONFLICT);
  }else{
    $data = array(
      "website_id" => $website_id,
      'user_id_field' => $user_id_field,
      'user_name_field' => $user_name_field,
      'actor_id_field' => $actor_id_field,
      'actor_name_field' => $actor_name_field,
      'gift_type_field' => $gift_type_field,
      'gift_amount_field' => $gift_amount_field
    );
    $id = LVSRule::addRule(LVSRule::$acquisition_table_name, $data);
    if($id >= 0){
      SysLog::addLog(UserSession::getUserName(), 'ADD', 'AcquisitionRule' ,$id, json_encode($data));
  		Common::exitWithSuccess ('规则添加成功','lvs/rule/acquisition.php');
    }else{
      OSAdmin::alert("error");
    }
  }
}elseif(Common::isGet()){
  $_POST = array(
    'user_id_field' => 'userid',
    'user_name_field' => 'username',
    'actor_id_field' => 'actorID',
    'actor_name_field' => 'actorName',
    'gift_type_field' => 'giftType',
    'gift_amount_field' => 'giftAmount'
  );
}

Template::assign("website_id_list",$website_id_list);
Template::assign("rule_data",$_POST);
Template::display("lvs/rule/acquisition_modify.tpl");
