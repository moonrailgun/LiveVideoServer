<?php
require ('../../include/init.inc.php');

$actorID = $sendStartTime = $sendEndTime = '';
extract($_GET, EXTR_IF_EXISTS);

if(Common::isGet()){
	Common::setJsonHeader();

	$list = LVSStatis::statisByActorID($actorID,$sendStartTime,$sendEndTime);

	//====整理数组
	$all_tool_name_list = array();
	$res = array();
	//获取所有给该主播送道具的玩家名单
	foreach ($list as $key => $item) {
		array_push($all_tool_name_list, $item['toolName']);
	}
	$all_tool_name_list = array_unique($all_tool_name_list);
	//组合
	foreach ($all_tool_name_list as $key => $toolName) {
		$temp_array = array();
		$temp_array['actorID'] = $actorID;
		$temp_array['actorName'] = $list[0]['actorName'];
		$temp_array['toolName'] = $toolName;
		$temp_array['playerName'] = LVSStatis::getToolTypeNameFromItemLogList($list,$toolName);
		$data = LVSStatis::getToolCostDataListFromItemLogList($list,$toolName);
		$temp_array['totalCost'] = $data['totalCost'];
		$temp_array['totalAmount'] = $data['totalAmount'];
		$temp_array['list'] = $data['list'];
		array_push($res,$temp_array);
	}
	echo json_encode($res);
}
?>
