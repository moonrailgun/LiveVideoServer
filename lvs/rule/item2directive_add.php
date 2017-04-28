<?php
require ('../../include/init.inc.php');
$website_id = $tool_id = $address = $command = $param = '';
extract($_POST, EXTR_IF_EXISTS);

$website_id_list = LVSWebsite::getWebsiteIdList();
$item_id_list = LVSItem::getItemIdList();

if(Common::isPost()) {
  if(!$website_id || !$tool_id || !$address || !$command || !$param){
    OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
  }else{
    $data = array(
      'website_id' => $website_id,
      'tool_id' => $tool_id,
      'address' => $address,
      'command' => $command,
      'param' => $param,
    );

    $id = LVSCommon::insert(LVSCommon::$tool2directive, $data);
    if($id) {
      SysLog::addLog(UserSession::getUserName(), 'ADD', 'Item2Directive' ,$id, json_encode($data));
			Common::exitWithSuccess('礼物添加成功','lvs/rule/item2directive.php');
    }else{
      OSAdmin::alert("error");
    }
  }
}

Template::assign("website_id_list",$website_id_list);
Template::assign("item_id_list",$item_id_list);
Template::assign("data",$_POST);
Template::display("lvs/rule/item2directive_modify.tpl");
