<?php
require ('../../include/init.inc.php');
$recharge_amount = $recharge_discount = '';
extract($_POST, EXTR_IF_EXISTS);

if(Common::isPost()){
  $condition['AND'] = array(
    'recharge_amount' => $recharge_amount
  );
  $exist = LVSCommon::getList(LVSCommon::$recharge_discount, $condition);
  if($exist){
    OSAdmin::alert("error",ErrorMessage::DATA_EXIST);
  } elseif (!$recharge_amount) {
    OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
  } else{
    $data = array(
      "recharge_amount" => $recharge_amount,
      "recharge_discount" => $recharge_discount
    );
    $data_id = LVSCommon::insert(LVSCommon::$recharge_discount, $data);
    if($data_id) {
      SysLog::addLog(UserSession::getUserName(), 'ADD', 'Recharge_Discount' ,$data_id, json_encode($data));
			Common::exitWithSuccess ('折扣信息添加成功','lvs/trade/recharge_discount.php');
    }else{
      OSAdmin::alert("error");
    }
  }
}

Template::assign("data",$_POST);
Template::display("lvs/trade/recharge_discount_modify.tpl");
