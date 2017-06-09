<?php
require ('../../include/init.inc.php');
$actor_id = $balance = '';
extract($_GET, EXTR_IF_EXISTS);

if(!$actor_id || !$balance) {
  Common::exitWithError('修改失败:'.ErrorMessage::NEED_PARAM, 'lvs/trade/balance.php');
}else{
  $result = LVSActor::updateActor($actor_id, array(
    'currency_count' => $balance
  ));
  if($result>=0){
    SysLog::addLog(UserSession::getUserName(), 'MODIFY', 'Actor' ,$result ,json_encode($balance));
    Common::exitWithSuccess('已修改账户余额','lvs/trade/balance.php' );
  }else{
    Common::exitWithError('修改失败', 'lvs/trade/balance.php');
  }
}
