<?php
class LVSRule extends LVSBase{
	private static $table_name = 'rule';
	private static $columns = array('ruleName','ruleData');

	public static function getTableName(){
		return parent::$table_prefix.self::$table_name;
	}

	public static function getGlobalTimeSpan(){
		return 2;
	}

	public static function getGlobalRule(){
		$db = self::__instance();
		$list = $db->select(self::getTableName(),self::$columns);
		if ($list) {
			return $list;
		}
		return array ();
	}

	public static function updateGlobalRule($update_data){
		if(!$update_data){
			return false;
		}
		$db = self::__instance();
		foreach ($update_data as $ruleName => $ruleData) {
			$data = array("ruleData"=>$ruleData);
			$condition = array("ruleName[=]"=>$ruleName);
			$id = $db->update(self::getTableName(),$data, $condition);
			if($id<0){
				return false;
			}
		}
		return true;
	}

	public static function getDeviceDirective(){
		$data = json_decode('{"deviceID":"sn1001","state":1,"stateDescription":"正常","toolDirective":[{"toolName":"头套1","state":1,"stateDescription":"正常"}]}');
		return $data;
	}

	public static function getRuleByName($rule_name){
		$db = self::__instance();
		$condition = array("ruleName[=]"=>$ruleName);
		$list = $db->select(self::getTableName(),self::$columns,$condition);
		if ($list) {
			return $list[0];
		}
		return array ();
	}

	public static function getAcquisitionRule(){
		return self::getRuleByName("acquisitionRule");
	}

	public static function getControllerDirectiveRule(){
		return self::getRuleByName("controllerDirectiveRule");
	}

	public static function getCostControlRule(){
		return self::getRuleByName("costControlRule");
	}

	public static function getGift2SenderInfoRule(){
		return self::getRuleByName("gift2SenderInfoRule");
	}

	public static function getTool2DirectiveRule(){
		return self::getRuleByName("tool2DirectiveRule");
	}

	public static function getCommonRule(){
		return self::getRuleByName("commonRule");
	}
}
?>
