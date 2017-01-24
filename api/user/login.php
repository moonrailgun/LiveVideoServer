<?php
require ('../../include/init.inc.php');
$username = $password = '';
extract ($_POST, EXTR_IF_EXISTS);

if(Common::isPost()) {
	Common::setJsonHeader();

	$res['statusCode'] = 1;
	$actor_info = LVSActor::checkPassword($username, $password);
	if ($actor_info) {
		if($actor_info['actor_is_actived']==1){
			// $token = User::loginDoSomething($user_info['user_id']);
			// $ip = Common::getIp();
			// SysLog::addLog ( $userID, 'LOGIN_WITH_API', 'User' ,UserSession::getUserId(),json_encode(array("IP" => $ip)));
			$res['resultCode'] = 1;
			$res['data']['user']['userID']=$actor_info['actor_id'];
			$res['data']['user']['userName']=$actor_info['actor_generated_name'];
			$res['data']['user']['currencyCount']=$actor_info['actor_currency'];
			// $res['data']['user']['token']=$token;

			$websiet_id = $actor_info['actor_website'];
			//输出规则
			$res['data']['rule'] = LVSRule::getWebsiteRule($websiet_id);
			// $global_rules = LVSRule::getGlobalRule();
			// $res['data']['rule'] = array();
			// foreach ($global_rules as $key => $value) {
			// 	$rule_name = $value['ruleName'];
			// 	$rule_data = $value['ruleData'];
			// 	$res['data']['rule'][$rule_name] = json_decode($rule_data);
			// }
			$res['data']['rule']['toolValidRule']=LVSRule::getToolValidRule($websiet_id,$actor_info['actor_id']);
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
