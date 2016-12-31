<?php
require ('../include/init.inc.php');
$website_id = $actor_id = $machine_id = $machine_status = $item_id = $item_status = '';
extract($_POST, EXTR_IF_EXISTS);

if(Common::isPost()){
  $condition["AND"] = array(
    "website_id" => $website_id,
    "actor_id"=>$actor_id,
    "machine_id"=>$machine_id,
    "item_id"=>$item_id
  );
  $exist = LVSRule::getRuleByCondition(LVSRule::$item_available_table_name, $condition);
  if($exist){
    OSAdmin::alert('error', ErrorMessage::NAME_CONFLICT);
  }else if($website_id == '' || $actor_id == '' || $machine_id == '' || $machine_status == '' || $item_id == '' || $item_status == ''){
    OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
  }else{
    $data = array(
      "website_id" => $website_id,
      "actor_id" => $actor_id,
      "machine_id" => $machine_id,
      "machine_status" => $machine_status,
      "item_id" => $item_id,
      "item_status" => $item_status
    );
    $id = LVSRule::addRule(LVSRule::$item_available_table_name, $data);

    if($id){
      SysLog::addLog(UserSession::getUserName(), 'ADD', 'Rule' ,$id, json_encode($data));
  		Common::exitWithSuccess ('规则添加成功','lvs/rule_item_available.php');
    }else{
      OSAdmin::alert("error");
    }
  }
}

$website_id_list = LVSWebsite::getWebsiteIdList();
$actor_id_list = LVSActor::getActorIdList();
$status_list = LVSRule::getStatusList();
$item_id_list = LVSItem::getItemIdList();

Template::assign("website_id_list",$website_id_list);
Template::assign("status_list",$status_list);
Template::assign("item_id_list",$item_id_list);
Template::assign("actor_id_list_json",json_encode($actor_id_list, JSON_UNESCAPED_UNICODE));
Template::assign("_POST", $_POST);
Template::display("lvs/rule_item_available_add.tpl");
?>
