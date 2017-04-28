<?php
require ('../../include/init.inc.php');
$id = $website_id = $gift_type = $gift_amount = $map_tool_name = $tool_cost = '';
extract($_REQUEST, EXTR_IF_EXISTS);

$website_id_list = LVSWebsite::getWebsiteIdList();
$item_id_list = LVSItem::getItemIdList();
if($website_id){
  $gift_type_id_list = LVSGift::getGiftTypeIdListByWebsiteId($website_id);
}else{
  reset($website_id_list);
  $gift_type_id_list = LVSGift::getGiftTypeIdListByWebsiteId(key($website_id_list));
}

if(!$id){
  OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
}else {
  $condition['AND'] = array('id' => $id);
  $list = LVSCommon::getList(LVSCommon::$gift2senderInfo, $condition);
  $data = $list[0];

  if(Common::isPost()){
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
      $result = LVSCommon::update(LVSCommon::$gift2senderInfo, $gift2item_data, $condition);
      if ($result>=0) {
        SysLog::addLog(UserSession::getUserName(), 'MODIFY', 'Gift2Item', $id, json_encode($gift2item_data));
        Common::exitWithSuccess('更新完成', 'lvs/rule/gift2item.php');
      } else {
        OSAdmin::alert('error');
      }
    }
  }
}

Template::assign("website_id_list",$website_id_list);
Template::assign("item_id_list",$item_id_list);
Template::assign("gift_type_id_list",$gift_type_id_list);
Template::assign("data",$data);
Template::display("lvs/rule/gift2item_modify.tpl");
