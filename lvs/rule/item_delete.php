<?php
require ('../../include/init.inc.php');
$id = '';
extract($_REQUEST, EXTR_IF_EXISTS);

if(!$id){
  Common::exitWithError('删除失败:'.ErrorMessage::NEED_PARAM, 'lvs/rule/item.php');
}else{
  $gift_data = LVSItem::getItemInfoById($id);
  $result = LVSItem::delItem($id);
  if($result>=0){
    SysLog::addLog(UserSession::getUserName(), 'DELETE', 'Gift' ,$gift_id ,json_encode($gift_data));
    Common::exitWithSuccess('已删除道具','lvs/rule/item.php' );
  }else{
    Common::exitWithError('删除失败', 'lvs/rule/item.php');
  }
}
