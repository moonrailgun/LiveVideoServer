<?php
require ('../../include/init.inc.php');
$id = '';
extract($_REQUEST, EXTR_IF_EXISTS);

if(!$id){
  Common::exitWithError('删除失败:'.ErrorMessage::NEED_PARAM, 'lvs/rule/gift2item.php');
}else{
  $condition['AND'] = array('id' => $id);
  $data = LVSCommon::getList(LVSCommon::$gift2senderInfo, $condition)[0];
  $result = LVSCommon::delete(LVSCommon::$gift2senderInfo, $condition);
  if($result>=0){
    SysLog::addLog(UserSession::getUserName(), 'DELETE', 'Gift2Item' ,$id ,json_encode($data));
    Common::exitWithSuccess('已删除礼物项','lvs/rule/gift2item.php' );
  }else{
    Common::exitWithError('删除失败', 'lvs/rule/gift2item.php');
  }
}
