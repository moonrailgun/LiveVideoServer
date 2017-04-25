<?php
require ('../../include/init.inc.php');
$id = $website_id = $website_ip = $remark = '';
extract($_REQUEST, EXTR_IF_EXISTS);

$website_id_list = LVSWebsite::getWebsiteIdList();

if(!$id){
  OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
}else{
  $website_ip_data = LVSWebsiteIP::getWebsiteIPByID($id);
  $ips = LVSWebsiteIP::getIPsByWebsiteID($website_id);

  if (Common::isPost()) {
    if(in_array($website_ip, $ips)){
      //exist
      OSAdmin::alert("error",ErrorMessage::NAME_CONFLICT);
    }elseif (!$website_id || !$website_ip){
      OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
    }elseif (!Common::isIp($website_ip)){
      OSAdmin::alert('error', ErrorMessage::NOT_VALID_IP);
    }else {
      $website_ip_data = array(
        "website_id" => $website_id,
        "website_ip" => $website_ip,
        "remark" => $remark
      );
      $result = LVSWebsiteIP::updateWebsiteIP($id, $website_ip_data);
      if ($result>=0) {
        SysLog::addLog(UserSession::getUserName(), 'MODIFY', 'WebsiteIP', $id, json_encode($website_ip_data));
        Common::exitWithSuccess('更新完成', 'lvs/user/website_ip.php');
      } else {
        OSAdmin::alert('error');
      }
    }
  }
}

Template::assign("website_id_list",$website_id_list);
Template::assign("website_ip_data",$website_ip_data);
Template::display("lvs/user/website_ip_modify.tpl");
