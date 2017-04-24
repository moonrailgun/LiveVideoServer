<?php
require ('../../include/init.inc.php');
$website_id = $website_name = $website_short_name = $remark = '';
extract($_REQUEST, EXTR_IF_EXISTS);

if(!$website_id){
  OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
}else{
  $website_data = LVSWebsite::getWebsiteByID($website_id);

  if (Common::isPost()) {
    if (!$website_name) {
      OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
    }else {
      $website_data = array(
        'website_name' => $website_name,
        'website_short_name' => $website_short_name,
        'remark' => $remark
      );
      $result = LVSWebsite::updateWebsite($website_id, $website_data);
      if ($result >= 0) {
        SysLog::addLog(UserSession::getUserName(), 'MODIFY', 'Website', $website_id, json_encode($website_data));
        Common::exitWithSuccess('更新完成', 'lvs/user/website.php');
      } else {
        OSAdmin::alert('error');
      }
    }
  }
}

Template::assign("website_data",$website_data);
Template::display("lvs/user/website_modify.tpl");
