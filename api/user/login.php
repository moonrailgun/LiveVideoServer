<?php
// TODO 需要更新API
require ('../../include/init.inc.php');
$userID = $password = '';
extract ($_POST, EXTR_IF_EXISTS);

if(Common::isPost()) {
	Common::setJsonHeader();

	$res['statusCode'] = 1;
	$actor_info = LVSActor::checkPassword($userID, $password);
	if ($actor_info) {
		if($actor_info['is_invalid']==0){
			$res['resultCode'] = 1;
			$res['data']['user']['userID']=$actor_info['id'];
			$res['data']['user']['userName']=$actor_info['user_id'];
			$res['data']['user']['realName']=$actor_info['real_name'];
			$res['data']['user']['currencyCount']=$actor_info['currency_count'];
			$website_info = LVSWebsite::getWebsiteByID($actor_info['website_id']);
			$res['data']['user']['webName']=$website_info['website_name'];

			$website_id = $actor_info['website_id'];
			$actor_id = $actor_info['id'];
			$gift_type_id_list = LVSGift::getGiftTypeIdList();
			$item_state_list = LVSItem::getItemStateList();

			// TODO
			//输出规则
			$condition['AND'] = array(
		    'website_id' => $website_id
		  );
		  $rule_list = LVSCommon::getList(LVSCommon::$acquisition, $condition)[0];
			$acquisitionRule = array(
				'userID' => $rule_list['user_id_field'],
				'userName' => $rule_list['user_name_field'],
				'giftType' => $rule_list['gift_type_field'],
				'giftAmount' => $rule_list['gift_amount_field'],
				'actorID' => $rule_list['actor_id_field'],
				'actorName' => $rule_list['actor_name_field'],
			);
			$res['data']['rule']['acquisitionRule'] = $acquisitionRule;

			$query = "SELECT * FROM lvs_gift2senderInfo_rule LEFT JOIN lvs_item ON lvs_gift2senderInfo_rule.map_tool_name = lvs_item.id WHERE website_id = $website_id";
			$rule_list = LVSCommon::query($query);
			$costControlRule = array();
			$gift2SenderInfoRule = array();
			foreach ($rule_list as $key => $value) {
				array_push($costControlRule, array(
					'toolName' => $value['tool_name'],
					'toolCost' => $value['tool_cost']
				));
				array_push($gift2SenderInfoRule, array(
					'giftType' => $gift_type_id_list[$value['gift_type']],
					'giftAmount' => $value['gift_amount'],
					'mapToolName' => $value['tool_name'],
					'queueFlag' => $value['queue_flag'],
				));
			}
			$res['data']['rule']['costControlRule'] = $costControlRule;
			$res['data']['rule']['gift2SenderInfoRule'] = $gift2SenderInfoRule;

			$query = "SELECT * FROM lvs_tool2directive_rule LEFT JOIN lvs_item ON lvs_tool2directive_rule.tool_id = lvs_item.id WHERE website_id=$website_id";
			$rule_list = LVSCommon::query($query);
			$tool2DirectiveRule = array();
			foreach ($rule_list as $key => $value) {
				array_push($tool2DirectiveRule, array(
					'toolName' => $value['tool_name'],
					'directiveName' => $value['tool_direct'],
					'address' => $value['address'],
					'command' => $value['command'],
					'param' => $value['param'],
				));
			}
			$res['data']['rule']['tool2DirectiveRule'] = $tool2DirectiveRule;

			$query = "SELECT * FROM lvs_toolValid_rule LEFT JOIN lvs_item ON lvs_toolValid_rule.tool_id = lvs_item.id WHERE actor_id = $actor_id";
			$rule_list = LVSCommon::query($query);
			$toolValidRule = array();
			$toolValidRule['deviceDirective']['state'] = 1;
			$toolValidRule['deviceDirective']['stateDescription'] = "正常";
			$toolDirective = array();
			foreach ($rule_list as $key => $value) {
				array_push($toolDirective, array(
					'toolName' => $value['tool_name'],
					'state' => $value['state'],
					'stateDescription' => $item_state_list[$value['state']]
				));
			}
			$toolValidRule['deviceDirective']['toolDirective'] = $toolDirective;
			$rule_list = LVSCommon::getList(LVSCommon::$timespan, $condition)[0];
			$toolValidRule['validTimeSpan'] = $rule_list['website_timespan'];
			$toolValidRule['limitCost'] = LVSConfig::getConfig('ITEM_COST');
			$webIp = array();
			$webIp_list = LVSWebsiteIP::getWebsiteIPListByWebsiteID($website_id);
			foreach ($webIp_list as $key => $value) {
				array_push($webIp, array(
					'ip' => $value['website_ip']
				));
			}
			$toolValidRule['webIp'] = $webIp;
			$res['data']['rule']['toolValidRule'] = $toolValidRule;

			// $global_rules = LVSRule::getGlobalRule();
			// $res['data']['rule'] = array();
			// foreach ($global_rules as $key => $value) {
			// 	$rule_name = $value['ruleName'];
			// 	$rule_data = $value['ruleData'];
			// 	$res['data']['rule'][$rule_name] = json_decode($rule_data);
			// }
			// $res['data']['rule']['toolValidRule']=LVSRule::getToolValidRule($website_id,$actor_info['actor_id']);
		}else{
			$res['resultCode'] = 0;
			$res['errorMessage'] = ErrorMessage::BE_PAUSED;
		}
	} else {
		$res['resultCode'] = 0;
		$res['errorMessage'] = ErrorMessage::USER_OR_PWD_WRONG;
		SysLog::addLog ( $user_name, 'LOGIN','User' ,'' , json_encode(ErrorMessage::USER_OR_PWD_WRONG));
	}

	echo json_encode($res);
}else{
	echo '请使用POST方法进行操作';
}
?>
