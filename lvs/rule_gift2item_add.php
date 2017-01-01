<?php
require ('../include/init.inc.php');
$website_id = $gift_type = $gift_amount = $item_id = '';
extract($_POST, EXTR_IF_EXISTS);

if(Common::isPost()){
  $condition["AND"] = array(
    "website_id" => $website_id,
    "item_id" => $item_id
  );
  $exist = LVSRule::getRuleByCondition(LVSRule::$gift2item_table_name, $condition);
  if($exist){
    OSAdmin::alert("error",ErrorMessage::NAME_CONFLICT);
  }else{
    $data = array(
      "website_id" => $website_id,
      "gift_type" => $gift_type,
      "gift_amount" => $gift_amount,
      "item_id" => $item_id
    );
    $id = LVSRule::addRule(LVSRule::$gift2item_table_name, $data);

    if($id >= 0){
      SysLog::addLog(UserSession::getUserName(), 'ADD', 'Rule' ,$id, json_encode($data));
  		Common::exitWithSuccess ('规则添加成功','lvs/rule_gift2item.php');
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
Template::display("lvs/rule_gift2item_add.tpl");
?>
