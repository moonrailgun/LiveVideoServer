<?php
require ('../include/init.inc.php');
$website_id = $method = "";
extract($_REQUEST, EXTR_IF_EXISTS);


$website_list = LVSWebsite::getWebsiteList();

if($method == 'del' && !empty($website_id)){
  $website_info = LVSWebsite::getWebsiteInfoById($website_id);
  $result = LVSWebsite::delWebsite ( $website_id );

  if ($result>=0) {
    SysLog::addLog(UserSession::getUserName(), 'DELETE', 'Website' ,$website_id ,json_encode($website_info));
    Common::exitWithSuccess('已删除网站','lvs/website.php' );
  }else{
    OSAdmin::alert("error");
  }
}

//追加操作的确认层
$confirm_html = OSAdmin::renderJsConfirm("icon-remove");

Template::assign('website_list', $website_list);
Template::assign ('osadmin_action_confirm' , $confirm_html);
Template::display('lvs/website.tpl');

?>
