<?php
require ('../../include/init.inc.php');
$website_name = $website_short_name = $remark = '';
extract($_POST, EXTR_IF_EXISTS);

if(Common::isPost()){
  $exist = LVSWebsite::getWebsiteByName($website_name);
  $exist2 = LVSWebsite::getWebsiteByShortName($website_short_name);
  if($exist || $exist2){
    OSAdmin::alert("error",ErrorMessage::NAME_CONFLICT);
  } elseif (!$website_name || !$website_short_name) {
    OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
  } else{
    $website_data = array(
      "website_name" => $website_name,
      "website_short_name" => $website_short_name,
      "remark" => $remark
    );
    $website_id = LVSWebsite::addWebsite($website_data);
    if($website_id) {
      SysLog::addLog(UserSession::getUserName(), 'ADD', 'Website' ,$website_id, json_encode($website_data));
			Common::exitWithSuccess('平台添加成功','lvs/user/website.php');
    }else{
      OSAdmin::alert("error");
    }
  }
}

Template::assign("website_data",$_POST);
Template::display("lvs/user/website_modify.tpl");
