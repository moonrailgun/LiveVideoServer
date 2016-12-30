<?php
class LVSStatis extends LVSBase{
	private static $table_name = "item_log";

	public static function getTableName(){
		return parent::$table_prefix.self::$table_name;
	}

	private static $columns = array('actorID','actorName','playerID','playerName','toolName','toolTypeName','totalCost','totalAmount','createdDate');

	//根据时间与主播ID获取统计信息
	public static function statisByActorID($actorID,$sendStartTime,$sendEndTime){
		$db=self::__instance();
		$condition['AND']=array("actorID[=]"=>$actorID,"createdDate[<>]" => array($sendStartTime , $sendEndTime));
		$condition['ORDER']=" createdDate desc";

		$list = $db->select(self::getTableName(),self::$columns,$condition);

		if($list){
			return $list;
		}

		return array ();
	}

	//getByActor
	public static function getPlayerNameFromItemLogList($list,$playerID){
		foreach ($list as $key => $value) {
			if($value['playerID']==$playerID){
				return $value['playerName'];
			}
		}
		return '';
	}

	//getByActor
	public static function getPlayerCostListFromItemLogList($list,$playerID){
		$tmp_list = array();
		$totalCost = 0;
		foreach ($list as $key => $value) {
			if($value['playerID'] == $playerID){
				$totalCost += $value['totalCost'];

				$tmp['toolName'] = $value['toolName'];
				$tmp['toolTypeName'] = $value['toolTypeName'];
				$tmp['totalCost'] = $value['totalCost'];
				$tmp['totalAmount'] = $value['totalAmount'];
				array_push($tmp_list, $tmp);
			}
		}
		$res['totalCost'] = $totalCost;
		$res['list'] = $tmp_list;
		return $res;
	}

	//getByTool
	public static function getToolTypeNameFromItemLogList($list,$toolName){
		foreach ($list as $key => $value) {
			if($value['toolName']==$toolName){
				return $value['toolTypeName'];
			}
		}
		return '';
	}

	//getByTool
	public static function getToolCostDataListFromItemLogList($list,$toolName){
		$tmp_list = array();
		$totalCost = 0;
		$totalAmount = 0;
		foreach ($list as $key => $value) {
			if($value['toolName'] == $toolName){
				$totalCost += $value['totalCost'];
				$totalAmount += $value['totalAmount'];

				$tmp['playerID'] = $value['playerID'];
				$tmp['playerName'] = $value['playerName'];
				$tmp['totalCost'] = $value['totalCost'];
				array_push($tmp_list, $tmp);
			}
		}
		$res['totalCost'] = $totalCost;
		$res['totalAmount'] = $totalAmount;
		$res['list'] = $tmp_list;
		return $res;
	}

	//statis
	public static function statisByActorIDAndItemData($actorID,$sendStartTime,$sendEndTime,$toolName,$playerID){
		$db=self::__instance();
		$condition['AND']=array("actorID[=]"=>$actorID,"createdDate[<>]" => array($sendStartTime , $sendEndTime),"toolName[=]"=>$toolName,"playerID[=]"=>$playerID);
		$condition['ORDER']=" createdDate desc";

		$list = $db->select(self::getTableName(),self::$columns,$condition);

		if($list){
			return $list;
		}

		return array ();
	}

	//根据主播总价值进行统计
	public static function statisByActorWorth($website_id, $start_date, $end_date) {
		$item_log_list = LVSItemLog::getItemLog($start_date, $end_date);
		if(!$item_log_list){
			return false;
		}

		$actor_list = LVSActor::getActorListByWebsite($website_id);
		$actor_list = LVSActor::rebuildActorListById($actor_list);

		$temp_list = array();//用于装载排序前的统计结果(即数据合并结果)
		foreach ($item_log_list as $key => $value) {
			$item_actor_id = $value['actorID'];

			//如果结果中已有该主播数据。数据相加。否则创建
			if(!array_key_exists($item_actor_id, $temp_list)){
				$actor_name = $actor_list[$item_actor_id]['actor_nick_name'];
				$temp_list[$item_actor_id]['actor_nick_name'] = $actor_name;
				$temp_list[$item_actor_id]['actor_cost'] = 0;
				$temp_list[$item_actor_id]['actor_cost_amount'] = 0;
			}
			$temp_list[$item_actor_id]['actor_cost'] += $value['totalCost'];
			$temp_list[$item_actor_id]['actor_cost_amount'] += $value['totalAmount'];
		}

		$result_list = Common::multiArraySort($temp_list, 'actor_cost', SORT_DESC);
		if($result_list){
			return $result_list;
		}else{
			return false;
		}
	}

	//根据道具发送次数进行统计
	public static function statisByItemName($actor_id, $start_date, $end_date){
		$item_log_list = LVSItemLog::getItemLog($start_date, $end_date, $actor_id);
		if(!$item_log_list){
			return false;
		}

		$temp_list = array();//用于装载排序前的统计结果(即数据合并结果)
		foreach ($item_log_list as $key => $value) {
			$item_name = $value['toolName'];

			//如果结果中已有该主播数据。数据相加。否则创建
			if(!array_key_exists($item_name, $temp_list)){
				$temp_list[$item_name]['item_name'] = $item_name;
				$temp_list[$item_name]['item_cost'] = 0;
				$temp_list[$item_name]['item_cost_amount'] = 0;
			}
			$temp_list[$item_name]['item_cost'] += $value['totalCost'];
			$temp_list[$item_name]['item_cost_amount'] += $value['totalAmount'];
		}

		$result_list = Common::multiArraySort($temp_list, 'item_cost', SORT_DESC);
		if($result_list){
			return $result_list;
		}else{
			return false;
		}
	}

	//按天给出道具消费
	public static function statisByTime($actor_id, $start_date, $end_date){
		$item_log_list = LVSItemLog::getItemLog($start_date, $end_date, $actor_id);

		//循环出每一天
		$start_stamp = strtotime($start_date);
		$end_stamp = strtotime($end_date);
		$date_list = array();
		for ($day = $start_stamp; $day <= $end_stamp; $day += 24 * 3600) {
    	$date = date("Y-m-d", $day);
			array_push($date_list, $date);
		}

		$result_list = array();
		//创建空数组
		foreach ($date_list as $key => $value) {
			$result_list[$value]['total_cost'] = 0;
		}

		//填充数据
		foreach ($item_log_list as $key => $value) {
			$log_date_time = $value['createdDate'];
			$time_stamp = strtotime($log_date_time);
			$log_date = date('Y-m-d', $time_stamp);
			if(array_key_exists($log_date, $result_list)){
				$item_name = $value['toolName'];
				$item_cost = $value['totalCost'];
				if(!array_key_exists($item_name, $result_list[$log_date])){
					$result_list[$log_date][$item_name] = 0;
				}
				$result_list[$log_date][$item_name] += $item_cost;
				$result_list[$log_date]['total_cost'] += $item_cost;
			}
		}
		// var_dump(json_encode($result_list,JSON_UNESCAPED_UNICODE));

		return $result_list;
	}
}
?>
