<?php
require ('../include/init.inc.php');
$website_id = $player_id = $player_name = $gift_type = $gift_amount = $send_time = $actor_id = $actor_name = '';
extract($_POST, EXTR_IF_EXISTS);

if(Common::isPost()){
  $condition["AND"] = array(
    "website_id" => $website_id
  );
  $exist = LVSRule::getRuleByCondition(LVSRule::$gather_table_name, $condition);
  if($exist){
    OSAdmin::alert("error",ErrorMessage::NAME_CONFLICT);
  }else{
    $data = array(
      "website_id" => $website_id,
      "player_id" => $player_id,
      "player_name" => $player_name,
      "gift_type" => $gift_type,
      "gift_amount" => $gift_amount,
      "send_time" => $send_time,
      "actor_id" => $actor_id,
      "actor_name" => $actor_name
    );
    $id = LVSRule::addRule(LVSRule::$gather_table_name, $data);

    if($id >= 0){
      SysLog::addLog(UserSession::getUserName(), 'ADD', 'Rule' ,$id, json_encode($data));
  		Common::exitWithSuccess ('规则添加成功','lvs/rule_gather.php');
    }else{
      OSAdmin::alert("error");
    }
  }
}

$website_id_list = LVSWebsite::getWebsiteIdList();

Template::assign("website_id_list",$website_id_list);
Template::assign("_POST", $_POST);
Template::display("lvs/rule_gather_add.tpl");
?>
