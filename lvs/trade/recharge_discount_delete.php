<?php
require ('../../include/init.inc.php');
$id = '';
extract($_REQUEST, EXTR_IF_EXISTS);

if(!$id) {
  Common::exitWithError('删除失败:'.ErrorMessage::NEED_PARAM, 'lvs/trade/recharge_discount.php');
}else{
  $condition['AND'] = array(
    'id' => $id
  );
  $data_info = LVSCommon::getList(LVSCommon::$recharge_discount, $condition)[0];
  $result = LVSCommon::delete(LVSCommon::$recharge_discount, $condition);
  if ($result>=0) {
    SysLog::addLog(UserSession::getUserName(), 'DELETE', 'Recharge_Discount' ,$id ,json_encode($data_info));
    Common::exitWithSuccess('已删除折扣信息','lvs/trade/recharge_discount.php' );
  }else{
    Common::exitWithError('删除失败', 'lvs/trade/recharge_discount.php');
  }
}
