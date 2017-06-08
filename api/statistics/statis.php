<?php
require ('../../include/init.inc.php');

$actorID = $sendStartTime = $sendEndTime = $toolName = $playerID = '';
extract($_GET, EXTR_IF_EXISTS);

if(Common::isGet()){
	Common::setJsonHeader();

	$list = LVSStatis::statisByActorIDAndItemData($actorID,$sendStartTime,$sendEndTime,$toolName,$playerID);

	$data = array();
	foreach ($list as $key => $value) {
		$tmp = array();
		$tmp['time'] = $value['createdDate'];
		$tmp['toolCost'] = $value['totalCost'];
		$tmp['toolUserAmount'] = $value['totalAmount'];
		$data[$key] = $tmp;
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
