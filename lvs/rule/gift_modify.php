<?php
require ('../../include/init.inc.php');
$gift_id = $website_id = $gift_type = '';
extract($_REQUEST, EXTR_IF_EXISTS);

$website_id_list = LVSWebsite::getWebsiteIdList();

if(!$gift_id){
  OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
}else {
  $gift_data = LVSGift::getGiftByID($gift_id);

  if(Common::isPost()){
    if(!$website_id || !$gift_type){
      OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
    }else{
      $gift_data = array(
        'website_id' => $website_id,
        'gift_type' => $gift_type
      );
      $result = LVSGift::updateGift($gift_id, $gift_data);
      if ($result>=0) {
        SysLog::addLog(UserSession::getUserName(), 'MODIFY', 'Gift', $gift_id, json_encode($gift_data));
        Common::exitWithSuccess('更新完成', 'lvs/rule/gift.php');
      } else {
        OSAdmin::alert('error');
      }
    }
  }
}

Template::assign("website_id_list",$website_id_list);
Template::assign("gift_data",$gift_data);
Template::display("lvs/rule/gift_modify.tpl");
