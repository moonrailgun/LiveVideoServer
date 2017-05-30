<?php
require ('../../include/init.inc.php');
$item_cost_value = '';
extract($_REQUEST, EXTR_IF_EXISTS);

if(!$item_cost_value){
  Common::exitWithError('修改失败:'.ErrorMessage::NEED_PARAM, 'lvs/trade/item_cost.php');
}else{
  $result = LVSConfig::updateConfig('ITEM_COST', $item_cost_value);
  if($result>=0){
    SysLog::addLog(UserSession::getUserName(), 'MODIFY', 'Item_Cost' ,$result ,json_encode($item_cost_value));
    Common::exitWithSuccess('已修改道具消费设置','lvs/trade/item_cost.php' );
  }else{
    Common::exitWithError('修改失败', 'lvs/trade/item_cost.php');
  }
}
