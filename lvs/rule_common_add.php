<?php
require ('../include/init.inc.php');
$website_id = $time_span = $web_ip = '';
extract($_POST, EXTR_IF_EXISTS);

if(Common::isPost()){
  $condition = array("website_id" => $website_id);
  $exist = LVSRule::getRuleByCondition(LVSRule::$common_table_name, $condition);
  if($exist){
    OSAdmin::alert("error",ErrorMessage::NAME_CONFLICT);
  }else{
    $data = array(
      "website_id" => $website_id,
      "time_span" => $time_span,
      "web_ip" => $web_ip
    );
    $id = LVSRule::addRule(LVSRule::$common_table_name, $data);

		SysLog::addLog(UserSession::getUserName(), 'ADD', 'Rule' ,$website_id, json_encode($data));
		Common::exitWithSuccess ('规则添加成功','lvs/rule_common.php');
  }
}

$website_id_list = LVSWebsite::getWebsiteIdList();

Template::assign("website_id_list",$website_id_list);
Template::assign("_POST", $_POST);
Template::display("lvs/rule_common_add.tpl");
?>
