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
	public static $acquisition_table_name = "lvs_acquisition_rule";

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

	public static function getWebsiteRule($website_id){
		if(!$website_id){
			return false;
		}

		$condition = array("website_id"=>$website_id);
		$item_id_list = LVSItem::getItemIdList();
		$item_info_list = LVSItem::getItemInfoList();
		$ruleData = array();
		//acquisitionRule
		$tmp = self::getRuleByCondition(self::$gather_table_name, $condition);
		$ruleData["acquisitionRule"] = array(
			"userID" => $tmp["player_id"],
			"userName" => $tmp["player_name"],
			"giftType" => $tmp["gift_type"],
			"giftAmount" => $tmp["gift_amount"],
			"sendTime" => $tmp["send_time"],
			"actorID" => $tmp["actor_id"],
			"actorName" => $tmp["actor_name"]
		);

		// //commonRule
		// $tmp = self::getRule(self::$common_table_name);
		// $ruleData["commonRule"] = array();
		// foreach ($tmp as $key => $value) {
		// 	# code...
		// 	$arr = array(
		// 		"websiteID"=>$value["website_id"],
		// 		"timespan"=>$value["time_span"]
		// 	);
		// 	array_push($ruleData["commonRule"], $arr);
		// }

		//costControlRule
		$tmp = self::getRuleListByCondition(self::$cost_table_name, $condition);
		$ruleData["costControlRule"] = array();
		foreach ($tmp as $key => $value) {
			$item_id = $value["item_id"];
			$arr = array(
				"toolName" =>$item_id_list[$item_id],
				"toolCost"=>$value["item_cost"]
			);
			array_push($ruleData["costControlRule"], $arr);
		}

		//gift2SenderInfoRule
		$tmp = self::getRuleListByCondition(self::$gift2item_table_name, $condition);
		$ruleData["gift2SenderInfoRule"] = array();
		foreach ($tmp as $key => $value) {
			$arr = array(
				"giftType"=>$value["gift_type"],
				"giftAmount"=>$value["gift_amount"],
				"mapToolName"=>$item_id_list[$value["item_id"]]
			);
			array_push($ruleData["gift2SenderInfoRule"], $arr);
		}

		//tool2DirectiveRule
		$tmp = self::getRuleListByCondition(self::$item2directive_table_name, $condition);
		$ruleData["tool2DirectiveRule"] = array();
		foreach ($tmp as $key => $value) {
			$item_info = $item_info_list[$value["item_id"]];
			$arr = array(
				"toolName"=>$item_info["item_name"],
				"directiveName"=>$item_info["item_directive"],
				"address"=>$value["address"],
				"command"=>$value["directive"],
				"param"=>$value["param"],
			);
			array_push($ruleData["tool2DirectiveRule"], $arr);
		}

		return $ruleData;
	}

	public static function getToolValidRule($website_id, $actor_id){
		if(!$website_id || !$actor_id){
			return false;
		}
		$status_id_list = self::getStatusList();
		$item_id_list = LVSItem::getItemIdList();

		$condition = array("website_id" => $website_id);
		$tool_valid_condition["AND"] = array(
			"website_id" => $website_id,
			"actor_id" => $actor_id
		);

		//deviceDirective
		$tmp = self::getRuleListByCondition(self::$item_available_table_name, $tool_valid_condition);
		$toolValidRule["deviceDirective"]["state"] = $tmp[0]["machine_status"];
		$toolValidRule["deviceDirective"]["stateDescription"] =$status_id_list[$tmp[0]["machine_status"]];
		$toolValidRule["deviceDirective"]["toolDirective"] = array();
		foreach ($tmp as $key => $value) {
			$arr = array(
				"toolName"=>$item_id_list[$value["item_id"]],
				"state"=>$value["item_status"],
				"stateDescription"=>$status_id_list[$value["item_status"]],
			);
			array_push($toolValidRule["deviceDirective"]["toolDirective"],$arr);
		}

		//validTimeSpan
		$tmp = self::getRuleByCondition(self::$common_table_name, $condition);
		$toolValidRule["validTimeSpan"] = $tmp['time_span'];

		//webIp
		$web_ip_list = explode(",",$tmp['web_ip']);
		$toolValidRule["webIp"] = array();
		foreach ($web_ip_list as $key => $value) {
			$arr = array(
				"ip"=>$value
			);
			array_push($toolValidRule["webIp"], $arr);
		}

		return $toolValidRule;
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

	public static function getRuleListByCondition($rule_table_name, $condition){
		if(!$condition){
			return false;
		}

		$db = self::__instance();
		$list = $db->select($rule_table_name,'*',$condition);
		if ($list) {
			return $list;
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
