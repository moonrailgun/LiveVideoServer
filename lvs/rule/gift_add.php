<?php
require ('../../include/init.inc.php');
$website_id = $gift_type = '';
extract($_POST, EXTR_IF_EXISTS);

$website_id_list = LVSWebsite::getWebsiteIdList();

if(Common::isPost()) {
  if(!$website_id || !$gift_type){
    OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
  }else{
    $gift_data = array(
      'website_id' => $website_id,
      'gift_type' => $gift_type
    );

    $gift_id = LVSGift::addGift($gift_data);
    if($gift_id) {
      SysLog::addLog(UserSession::getUserName(), 'ADD', 'Gift' ,$gift_id, json_encode($gift_data));
			Common::exitWithSuccess('主播添加成功','lvs/rule/gift.php');
    }else{
      OSAdmin::alert("error");
    }
  }
}

Template::assign("website_id_list",$website_id_list);
Template::assign("gift_data",$_POST);
Template::display("lvs/rule/gift_modify.tpl");
