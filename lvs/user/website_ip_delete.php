<?php
require ('../../include/init.inc.php');
$id = '';
extract($_REQUEST, EXTR_IF_EXISTS);

if(!$id) {
  Common::exitWithError('删除失败:'.ErrorMessage::NEED_PARAM, 'lvs/user/website_ip.php');
}else{
  $website_ip_info = LVSWebsiteIP::getWebsiteIPByID($id);
  $result = LVSWebsiteIP::deleteWebsiteIP($id);
  if ($result>=0) {
    SysLog::addLog(UserSession::getUserName(), 'DELETE', 'WebsiteIP' ,$id ,json_encode($website_ip_info));
    Common::exitWithSuccess('已删除平台IP','lvs/user/website_ip.php' );
  }else{
    Common::exitWithError('删除失败', 'lvs/user/website_ip.php');
  }
}
