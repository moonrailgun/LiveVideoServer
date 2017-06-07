<?php
require ('../../include/init.inc.php');
$userID = $startTime = $endTime = '';
extract ($_POST, EXTR_IF_EXISTS);

if(Common::isPost()){
  Common::setJsonHeader();

  $res['statusCode'] = 1;
  $condition['AND'] = array(
    'user_id' => $userID,
    'recharge_time[<>]' => array($startTime, $endTime)
  );
  $data = LVSCommon::getList(LVSCommon::$recharge_log, $condition);
  if($data){
    $res['resultCode'] = 1;
    $tmp = array();
    foreach ($data as $key => $value) {
      array_push($tmp, array(
        'time' => $value['recharge_time'],
        'amountReal' => $value['recharge_rmb'],
        'virtualMoney' => $value['recharge_amount'],
        'chargeMethod' => $value['recharge_method'],
        'chargeOrder' => $value['order_id'],
      ));
    }
    $res['data'] = $tmp;
  }else{
    $res['resultCode'] = 0;
    $res['data'] = array();
  }

  echo json_encode($res);
}
