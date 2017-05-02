<?php
require ('../../include/init.inc.php');
$id = $website_id = $tool_id = $address = $command = $param = '';
extract($_REQUEST, EXTR_IF_EXISTS);

$website_id_list = LVSWebsite::getWebsiteIdList();
$item_id_list = LVSItem::getItemIdList();

if(!$id) {
  OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
}else{
  $condition['AND'] = array(
    'id' => $id
  );
  $data = LVSCommon::getList(LVSCommon::$tool2directive, $condition)[0];

  if(Common::isPost()) {
    if(!$website_id || !$tool_id || !$address || !$command || !$param) {
      OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
    }else{
      $data = array(
        'website_id' => $website_id,
        'tool_id' => $tool_id,
        'address' => $address,
        'command' => $command,
        'param' => $param,
      );
      $result = LVSCommon::update(LVSCommon::$tool2directive, $data, $condition);
      if($result >= 0){
        SysLog::addLog(UserSession::getUserName(), 'MODIFY', 'Item2Directive' ,$id, json_encode($data));
  			Common::exitWithSuccess('礼物添加成功','lvs/rule/item2directive.php');
      }else {
        OSAdmin::alert('error');
      }
    }
  }
}

Template::assign("website_id_list",$website_id_list);
Template::assign("item_id_list",$item_id_list);
Template::assign("data",$data);
Template::display("lvs/rule/item2directive_modify.tpl");
