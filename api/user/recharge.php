<?php
require ('../../include/init.inc.php');
$userID = $sendTime = $costReal = $fetchCost = $rechargeMethod = $orderID = '';
extract ($_POST, EXTR_IF_EXISTS);

if(Common::isPost()){
  Common::setJsonHeader();

  $res['statusCode'] = 1;
  $res['resultCode'] = 1;
  $data = LVSCommon::insert(LVSCommon::$recharge_log, array(
    'order_id' => $orderID,
    'user_id' => $userID,
    'recharge_time' => $sendTime,
    'recharge_rmb' => $costReal,
    'recharge_amount' => $fetchCost,
    'recharge_method' => $rechargeMethod
  ));
  if($data){
    $res['data'][0]['result'] = 1;
    $res['data'][0]['tips'] = "充值记录添加成功";
  }else{
    $res['data'][0]['result'] = 0;
    $res['data'][0]['tips'] = "充值记录添加失败";
  }

  echo json_encode($res);
}
