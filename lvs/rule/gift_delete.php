<?php
require ('../../include/init.inc.php');
$gift_id = '';
extract($_REQUEST, EXTR_IF_EXISTS);

if(!$gift_id){
  Common::exitWithError('删除失败:'.ErrorMessage::NEED_PARAM, 'lvs/rule/gift.php');
}else{
  $gift_data = LVSGift::getGiftByID($gift_id);
  $result = LVSGift::deleteGift($gift_id);
  if($result>=0){
    SysLog::addLog(UserSession::getUserName(), 'DELETE', 'Gift' ,$gift_id ,json_encode($gift_data));
    Common::exitWithSuccess('已删除礼物项','lvs/rule/gift.php' );
  }else{
    Common::exitWithError('删除失败', 'lvs/rule/gift.php');
  }
}
