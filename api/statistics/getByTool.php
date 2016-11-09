<?php
$data['actorID'] = 'lf001';
$data['actorName'] = 'test';
$data['toolTypeName'] = '233';
$data['toolName'] = '666';
$data['totalCost'] = '20';
$data['totalAmount'] = '5';

for($i=0;$i<2;$i++){
	$item['playerID'] = 'lfplayer';
	$item['playerName'] = 'testplayer';
	$item['totalCost'] = '100';
	$data['list'][$i] = $item;
}

echo json_encode($data);
?>