<?php
require ('../../include/init.inc.php');
$website_id = '';
extract($_REQUEST, EXTR_IF_EXISTS);

if(!$website_id) {
  Common::exitWithError('删除失败:'.ErrorMessage::NEED_PARAM, 'lvs/user/website.php');
}else{
  $website_info = LVSWebsite::getWebsiteByID($website_id);
  $result = LVSWebsite::delWebsite($website_id);
  if ($result>=0) {
    SysLog::addLog(UserSession::getUserName(), 'DELETE', 'Website' ,$website_id ,json_encode($website_info));
    Common::exitWithSuccess('已删除平台','lvs/user/website.php' );
  }else{
    Common::exitWithError('删除失败', 'lvs/user/website.php');
  }
}
