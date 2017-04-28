<?php
require ('../../include/init.inc.php');
$website_id = $gift_type = $gift_amount = $map_tool_name = $tool_cost = '';
extract($_POST, EXTR_IF_EXISTS);

$website_id_list = LVSWebsite::getWebsiteIdList();
$item_id_list = LVSItem::getItemIdList();
if($website_id){
  $gift_type_id_list = LVSGift::getGiftTypeIdListByWebsiteId($website_id);
}else{
  reset($website_id_list);
  $gift_type_id_list = LVSGift::getGiftTypeIdListByWebsiteId(key($website_id_list));
}

if(Common::isPost()) {
  if(!$website_id || !$gift_type || !$gift_amount || !$map_tool_name || !$tool_cost){
    OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
  }else{
    $gift2item_data = array(
      'website_id' => $website_id,
      'gift_type' => $gift_type,
      'gift_amount' => $gift_amount,
      'map_tool_name' => $map_tool_name,
      'tool_cost' => $tool_cost,
    );

    $gift2item_id = LVSCommon::insert(LVSCommon::$gift2senderInfo, $gift2item_data);
    if($gift2item_id) {
      SysLog::addLog(UserSession::getUserName(), 'ADD', 'Gift2Item' ,$gift2item_id, json_encode($gift2item_data));
			Common::exitWithSuccess('礼物匹配道具规则添加成功','lvs/rule/gift2item.php');
    }else{
      OSAdmin::alert("error");
    }
  }
}

Template::assign("website_id_list",$website_id_list);
Template::assign("item_id_list",$item_id_list);
Template::assign("gift_type_id_list",$gift_type_id_list);
Template::assign("gift_data",$_POST);
Template::display("lvs/rule/gift2item_modify.tpl");
