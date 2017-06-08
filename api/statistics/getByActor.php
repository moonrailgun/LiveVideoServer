<?php
require ('../../include/init.inc.php');

$actorID = $sendStartTime = $sendEndTime = '';
extract($_GET, EXTR_IF_EXISTS);

if(Common::isGet()){
	Common::setJsonHeader();

	$list = LVSStatis::statisByActorID($actorID,$sendStartTime,$sendEndTime);

	//====整理数组
	$all_player_id_list = array();
	$data = array();
	//获取所有给该主播送道具的玩家名单
	foreach ($list as $key => $item) {
		array_push($all_player_id_list, $item['playerID']);
	}
	$all_player_id_list = array_unique($all_player_id_list);
	//组合
	foreach ($all_player_id_list as $key => $playerID) {
		$temp_array = array();
		$temp_array['actorID'] = $actorID;
		$temp_array['actorName'] = $list[0]['actorName'];
		$temp_array['playerID'] = $playerID;
		$temp_array['playerName'] = LVSStatis::getPlayerNameFromItemLogList($list,$playerID);
		$temp_data = LVSStatis::getPlayerCostListFromItemLogList($list,$playerID);
		$temp_array['totalCost'] = $temp_data['totalCost'];
		$temp_array['list'] = $temp_data['list'];
		array_push($data, $temp_array);
	}

	$res['statusCode'] = 1;
	$res['resultCode'] = 1;
	if(count($data) == 0) {
		$res['resultCode'] = 0;
	}
	$res['data'] = $data;
	echo json_encode($res);
}
?>
