<?php
class LVSPlayer{
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
}
?>