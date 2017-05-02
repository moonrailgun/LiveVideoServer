<?php
require ('../../include/init.inc.php');
$id = '';
extract($_REQUEST, EXTR_IF_EXISTS);

if(!$id){
  Common::exitWithError('删除失败:'.ErrorMessage::NEED_PARAM, 'lvs/rule/item2directive.php');
}else{
  $condition['AND'] = array(
    'id' => $id
  );
  $data = LVSCommon::getList(LVSCommon::$tool2directive, $condition)[0];
  $result = LVSCommon::delete(LVSCommon::$tool2directive, $condition);
  if($result>=0){
    SysLog::addLog(UserSession::getUserName(), 'DELETE', 'Item2Directive', $id, json_encode($data));
    Common::exitWithSuccess('已删除规则','lvs/rule/item2directive.php' );
  }else{
    Common::exitWithError('删除失败', 'lvs/rule/item2directive.php');
  }
}
