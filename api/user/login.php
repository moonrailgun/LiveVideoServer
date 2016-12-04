<?php
require ('../../include/init.inc.php');
$userID = $password = '';
extract ($_POST, EXTR_IF_EXISTS);

if(Common::isPost()) {
	Common::setJsonHeader();

	$res['statusCode'] = 1;
	$user_info = User::checkPassword($userID, $password);
	if ($user_info) {
		if($user_info['status']==1){
			$token = User::loginDoSomething($user_info['user_id']);
			$ip = Common::getIp();
			SysLog::addLog ( $userID, 'LOGIN', 'User' ,UserSession::getUserId(),json_encode(array("IP" => $ip)));
			$res['resultCode'] = 1;
			$res['data']['user']['userID']=$user_info['user_id'];
			$res['data']['user']['userName']=$user_info['user_name'];
			$res['data']['user']['currencyCount']=$user_info['currency_count'];
			$res['data']['user']['token']=$token;
			// $res['data']['rule']=LVSRule::getGlobalRule();
			$global_rules = LVSRule::getGlobalRule();
			$res['data']['rule'] = array();
			foreach ($global_rules as $key => $value) {
				$rule_name = $value['ruleName'];
				$rule_data = $value['ruleData'];
				$res['data']['rule'][$rule_name] = json_decode($rule_data);
			}
			$res['data']['rule']['toolValidRule']['validTimeSpan']=LVSRule::getGlobalTimeSpan();
			$res['data']['rule']['toolValidRule']['deviceDirective']=LVSRule::getDeviceDirective();
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
