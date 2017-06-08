<?php
require ('../../include/init.inc.php');

$actorID = $actorName = $playerID = $playerName = $toolName = $totalCost = $totalAmount = $sendTime = '';
extract ($_POST, EXTR_IF_EXISTS);

if (Common::isPost()) {
	Common::setJsonHeader();

	$res['statusCode'] = 1;
	if($actorID != '' && $playerID != '' && $toolName != ''){
		$item_data['actorID'] = $actorID;
		$item_data['actorName'] = $actorName;
		$item_data['playerID'] = $playerID;
		$item_data['playerName'] = $playerName;
		$item_data['toolName'] = $toolName;
		$item_data['totalCost'] = $totalCost;
		$item_data['totalAmount'] = $totalAmount;
		$item_data['createdDate'] = $sendTime;

		$id = LVSItemLog::addItem($item_data);
		if($id) {
			$res['statusCode'] = 1;
			$res['result'][0] = array(
				"result" => 1,
				"tip"=>ErrorMessage::SUCCESS
			);
		}else{
			$res['resultCode'] = 0;
			$res['statusCode'] = 0;
			$res['result'][0] = array(
				"result" => 0,
				"tip"=>ErrorMessage::ERROR
			);
		}
	}else{
		$res['resultCode'] = 0;
		$res['result'][0] = array(
			"result" => 0,
			"tip"=>ErrorMessage::NEED_PARAM
		);
		// $res['errorMessage'] = ErrorMessage::NEED_PARAM;
	}

	echo json_encode($res);
}

?>
