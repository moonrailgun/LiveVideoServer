<?php
require ('../../include/init.inc.php');
$id = $recharge_amount = $recharge_discount = '';
extract($_REQUEST, EXTR_IF_EXISTS);

if(!$id){
  OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
}else{
  $condition['AND'] = array(
    'id' => $id
  );
  $data = LVSCommon::getList(LVSCommon::$recharge_discount, $condition)[0];

  if (Common::isPost()) {
    $condition_exist['AND'] = array(
      'id[!]' => $id,
      'recharge_amount' => $recharge_amount
    );
    $exist = LVSCommon::getList(LVSCommon::$recharge_discount, $condition_exist);
    if (!$recharge_amount || !$recharge_discount) {
      OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
    }else if($exist){
      OSAdmin::alert("error",ErrorMessage::DATA_EXIST);
    }else {
      $data = array(
        'recharge_amount' => $recharge_amount,
        'recharge_discount' => $recharge_discount
      );
      $result = LVSCommon::update(LVSCommon::$recharge_discount, $data, $condition);
      if ($result>=0) {
        SysLog::addLog(UserSession::getUserName(), 'MODIFY', 'Recharge_Discount', $id, json_encode($data));
        Common::exitWithSuccess('更新完成', 'lvs/trade/recharge_discount.php');
      } else {
        OSAdmin::alert('error');
      }
    }
  }
}

Template::assign("data", $data);
Template::display("lvs/trade/recharge_discount_modify.tpl");
