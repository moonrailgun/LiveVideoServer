<?php

require '../include/init.inc.php';

$website_id = $website_name = $website_short_name = $website_desc = '';
extract($_REQUEST, EXTR_IF_EXISTS);

if ($website_id == '') {
  OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
}

if (Common::isGet()) {
  $website_info = LVSWebsite::getWebsiteInfoById($website_id);
} elseif (Common::isPost()) {
  if ($website_name == ''||$website_short_name == ''||$website_desc == '') {
      OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
  }
  $website_data = array(
    'website_name' => $website_name,
    'website_short_name' => $website_short_name,
    'website_desc' => $website_desc,
  );
  $result = LVSWebsite::updateWebsite($website_id, $website_data);
  if ($result >= 0) {
      SysLog::addLog(UserSession::getUserName(), 'MODIFY', 'Website', $user_id, json_encode($website_data));
      Common::exitWithSuccess('更新完成', 'lvs/website.php');
  } else {
      OSAdmin::alert('error');
  }
}

Template::assign('website_info', $website_info);
Template::display('lvs/website_modify.tpl');
