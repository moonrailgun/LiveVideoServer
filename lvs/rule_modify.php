<?php
require ('../include/init.inc.php');
$acquisitionRule = $controllerDirectiveRule = $costControlRule = $gift2SenderInfoRule = $tool2DirectiveRule = '';
extract ( $_REQUEST, EXTR_IF_EXISTS );

if(Common::isGet()){
  $ruleList=LVSRule::getGlobalRule();
  $ruleDataList=array();
  foreach ($ruleList as $key => $value) {
    $ruleName = $value['ruleName'];
    $ruleData = $value['ruleData'];
    $ruleDataList[$ruleName] = $ruleData;
  }
  extract ( $ruleDataList, EXTR_IF_EXISTS );
}

if(Common::isPost()){
  if($acquisitionRule==''||$controllerDirectiveRule==''||$costControlRule==''
    ||$gift2SenderInfoRule==''||$tool2DirectiveRule=='') {
    OSAdmin::alert("error",ErrorMessage::NEED_PARAM);
  }else if(!Common::isJson($acquisitionRule)||!Common::isJson($controllerDirectiveRule)||
        !Common::isJson($costControlRule)||!Common::isJson($gift2SenderInfoRule)||!Common::isJson($tool2DirectiveRule)){
    OSAdmin::alert("error",ErrorMessage::PARAM_IS_NOT_JSON);

    $json_check = array();
    array_push($json_check,Common::isJson($acquisitionRule));
    array_push($json_check,Common::isJson($controllerDirectiveRule));
    array_push($json_check,Common::isJson($costControlRule));
    array_push($json_check,Common::isJson($gift2SenderInfoRule));
    array_push($json_check,Common::isJson($tool2DirectiveRule));
    Template::assign('json_check', $json_check);//json合法性检查结果统计
  }else{
    $update_data = array ('acquisitionRule' => $acquisitionRule,
                      'controllerDirectiveRule' => $controllerDirectiveRule,
                  		'costControlRule' => $costControlRule,
                      'gift2SenderInfoRule' => $gift2SenderInfoRule,
                      'tool2DirectiveRule' => $tool2DirectiveRule );
    $result = LVSRule::updateGlobalRule($update_data);
    if($result){
      SysLog::addLog ( UserSession::getUserName(), 'MODIFY', 'LVSRule' , null, json_encode($update_data) );
			Common::exitWithSuccess ('更新完成','lvs/rule_modify.php');
    }else{
      OSAdmin::alert("error");
    }
  }
}

Template::assign('acquisitionRuleValue', $acquisitionRule);
Template::assign('controllerDirectiveRuleValue', $controllerDirectiveRule);
Template::assign('costControlRuleValue', $costControlRule);
Template::assign('gift2SenderInfoRuleValue', $gift2SenderInfoRule);
Template::assign('tool2DirectiveRuleValue', $tool2DirectiveRule);
Template::display ('lvs/rule_modify.tpl');
?>
