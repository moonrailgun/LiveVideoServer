<?php
require ('../../include/init.inc.php');

$actorID = $sendStartTime = $sendEndTime = $toolName = $playerID = '';
extract($_GET, EXTR_IF_EXISTS);

if(Common::isGet()){
	Common::setJsonHeader();

	$list = LVSStatis::statisByActorIDAndItemData($actorID,$sendStartTime,$sendEndTime,$toolName,$playerID);

	$res = array();
	foreach ($list as $key => $value) {
		$tmp = array();
		$tmp['time'] = $value['createdDate'];
		$tmp['toolCost'] = $value['totalCost'];
		$tmp['toolUserAmount'] = $value['totalAmount'];
		$res[$key] = $tmp;
	}
	echo json_encode($res);
}

?>
