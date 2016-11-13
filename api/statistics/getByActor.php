<?php
require ('../../include/init.inc.php');

$actorID = $sendStartTime = $sendEndTime = '';
extract($_GET, EXTR_IF_EXISTS);

if(Common::isGet()){
	$list = LVSStatis::statisByActor($actorID,$sendStartTime,$sendEndTime);

	//====整理数组
	$is_checking_playerID = '';
	$all_player_id_list = array();
	$res = array();
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
		$temp_array['playerName'] = LVSPlayer::getPlayerNameFromItemLogList($list,$playerID);
		$data = LVSPlayer::getPlayerCostListFromItemLogList($list,$playerID);
		$temp_array['totalCost'] = $data['totalCost'];
		$temp_array['list'] = $data['list'];
		array_push($res,$temp_array);
	}
	echo json_encode($res);
}
?>