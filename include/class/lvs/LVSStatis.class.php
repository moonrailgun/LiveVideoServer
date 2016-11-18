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
		
		$list = $db->select(self::getTabelName(),self::$columns,$condition);

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
}
?>