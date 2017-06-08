<?php
require ('../../include/init.inc.php');

//echo '[{"playerName":"","playerID":"","toolTypeName":"","toolName":"","sendTime":"","toolPerPrice":""}]';

$actorID = $sendStartTime = $sendEndTime = '';
extract($_GET, EXTR_IF_EXISTS);

if(Common::isGet()){
	Common::setJsonHeader();

	$list = LVSStatis::statisByActorID($actorID,$sendStartTime,$sendEndTime);

	$data = array();
	foreach ($list as $key => $value) {
		$tmp = array();
		$tmp['playerID'] = $value['playerID'];
		$tmp['playerName'] = $value['playerName'];
		$tmp['toolName'] = $value['toolName'];
		$tmp['sendTime'] = $value['createdDate'];
		$tmp['toolPerPrice'] = $value['totalCost'] / $value['totalAmount'];
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
