<?php
class LVSRule extends LVSBase{
	private static $table_name = 'rule';
	private static $columns = array('ruleName','ruleData');

	public static $common_table_name = "lvs_rule_common";
	public static $cost_table_name = "lvs_rule_cost";
	public static $gather_table_name = "lvs_rule_gather";
	public static $gift2item_table_name = "lvs_rule_gift2item";
	public static $item_available_table_name = "lvs_rule_item_available";
	public static $item2directive_table_name = "lvs_rule_item2directive";

	public static function getStatusList(){
		$status_list[0] = "故障";
		$status_list[1] = "正常";
		return $status_list;
	}

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

	// public static function getRuleByName($rule_name){
	// 	$db = self::__instance();
	// 	$condition = array("ruleName[=]"=>$ruleName);
	// 	$list = $db->select(self::getTableName(),self::$columns,$condition);
	// 	if ($list) {
	// 		return $list[0];
	// 	}
	// 	return array ();
	// }

	public static function getRule($rule_table_name){
		$db = self::__instance();
		$list = $db->select($rule_table_name,'*');
		if ($list) {
			return $list;
		}
		return array ();
	}

	public static function getRuleByCondition($rule_table_name, $condition){
		if(!$condition){
			return false;
		}

		$db = self::__instance();
		$list = $db->select($rule_table_name,'*',$condition);
		if ($list) {
			return $list[0];
		}
		return array();
	}

	public static function addRule($rule_table_name, $data){
		if (!$data || !is_array($data)) {
        return false;
    }
    $db = self::__instance();
    $id = $db->insert($rule_table_name, $data);

    return $id;
	}

	public static function updateRule($rule_table_name, $condition, $data){
		if (!$condition || !$data || !is_array($data)) {
				return false;
		}

		$db = self::__instance();
		$id = $db->update($rule_table_name, $data, $condition);

		return $id;
	}

	public static function delRule($rule_table_name, $condition){
		if (!$rule_table_name || !$condition) {
				return false;
		}

		$db = self::__instance();
		$result = $db->delete($rule_table_name, $condition);

		return $result;
	}
}
?>
