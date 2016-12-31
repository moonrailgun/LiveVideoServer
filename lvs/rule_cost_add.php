<?php
require ('../include/init.inc.php');
$website_id = $item_id = $item_cost = '';
extract($_POST, EXTR_IF_EXISTS);

if(Common::isPost()){
  $condition["AND"] = array(
    "website_id" => $website_id,
    "item_id" => $item_id
  );
  $exist = LVSRule::getRuleByCondition(LVSRule::$cost_table_name, $condition);
  if($exist){
    OSAdmin::alert("error",ErrorMessage::NAME_CONFLICT);
  }else{
    $data = array(
      "website_id" => $website_id,
      "item_id" => $item_id,
      "item_cost" => $item_cost
    );
    $id = LVSRule::addRule(LVSRule::$cost_table_name, $data);

    if($id >= 0){
      SysLog::addLog(UserSession::getUserName(), 'ADD', 'Rule' ,$id, json_encode($data));
  		Common::exitWithSuccess ('规则添加成功','lvs/rule_cost.php');
    }else{
      OSAdmin::alert("error");
    }
  }
}

$website_id_list = LVSWebsite::getWebsiteIdList();
$item_id_list = LVSItem::getItemIdList();

Template::assign("website_id_list",$website_id_list);
Template::assign("item_id_list",$item_id_list);
Template::assign("_POST", $_POST);
Template::display("lvs/rule_cost_add.tpl");
?>
