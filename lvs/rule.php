<?php
require ('../include/init.inc.php');

$global_rule = LVSRule::getGlobalRule();
$rule_temp = array();
foreach ($global_rule as $key => $value) {
  $rule_name = $value['ruleName'];
  $rule_data = $value['ruleData'];
  $rule_temp[$rule_name] = $rule_data;
}

Template::assign('rule', $rule_temp);
Template::assign('tool2DirectiveRule', json_decode($rule_temp['tool2DirectiveRule'],true));
Template::assign('gift2SenderInfoRule', json_decode($rule_temp['gift2SenderInfoRule'],true));
Template::assign('costControlRule', json_decode($rule_temp['costControlRule'],true));
Template::assign('controllerDirectiveRule', json_decode($rule_temp['controllerDirectiveRule']));
Template::assign('acquisitionRule', json_decode($rule_temp['acquisitionRule']));
Template::display ( 'lvs/rule.tpl' );
