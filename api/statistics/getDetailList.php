<?php
require ('../../include/init.inc.php');

//echo '[{"playerName":"","playerID":"","toolTypeName":"","toolName":"","sendTime":"","toolPerPrice":""}]';

$actorID = $sendStartTime = $sendEndTime = '';
extract($_GET, EXTR_IF_EXISTS);

if(Common::isGet()){
	Common::setJsonHeader();

	$list = LVSStatis::statisByActorID($actorID,$sendStartTime,$sendEndTime);

	$res = array();
	foreach ($list as $key => $value) {
		$tmp = array();
		$tmp['playerID'] = $value['playerID'];
		$tmp['playerName'] = $value['playerName'];
		$tmp['toolTypeName'] = $value['toolTypeName'];
		$tmp['toolName'] = $value['toolName'];
		$tmp['sendTime'] = $value['createdDate'];
		$tmp['toolPerPrice'] = $value['totalCost'] / $value['totalAmount'];
		$res[$key] = $tmp;
	}
	echo json_encode($res);
}
?>
