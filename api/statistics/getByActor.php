<?php
$data['actorID'] = 'lf001';
$data['actorName'] = 'test';
$data['playerID'] = 'lfplayer';
$data['playerName'] = 'testplayer';
$data['totalCost'] = '100';

for($i=0;$i<2;$i++){
	$item['toolTypeName'] = '233';
	$item['toolName'] = '666';
	$item['totalCost'] = '20';
	$item['totalAmount'] = '5';
}
$data['list'][0] = $item;

echo json_encode($data);
?>