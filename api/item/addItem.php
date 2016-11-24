<?php
require ('../../include/init.inc.php');

$actorID = $actorName = $playerID = $playerName = $toolName = $toolTypeName = $totalCost = $totalAmount = '';
extract ($_POST, EXTR_IF_EXISTS);

if (Common::isPost()) {
	$res['statusCode'] = 1;
	if($actorID != '' && $playerID != '' && $toolName != ''){
		$item_data['actorID'] = $actorID;
		$item_data['actorName'] = $actorName;
		$item_data['playerID'] = $playerID;
		$item_data['playerName'] = $playerName;
		$item_data['toolName'] = $toolName;
		$item_data['toolTypeName'] = $toolTypeName;
		$item_data['totalCost'] = $totalCost;
		$item_data['totalAmount'] = $totalAmount;

		$id = LVSItem::addItem($item_data);
		if($id) {
			$res['resultCode'] = 1;
			$res['id'] = $id;
		}else{
			$res['resultCode'] = 0;
			$res['errorMessage'] = ErrorMessage::ERROR;
		}
	}else{
		$res['resultCode'] = 0;
		$res['errorMessage'] = ErrorMessage::NEED_PARAM;
	}

	echo json_encode($res);
}

?>
