<?php
require ('../../include/init.inc.php');
$website_id = $website_ip = $remark = '';
extract($_POST, EXTR_IF_EXISTS);

$website_id_list = LVSWebsite::getWebsiteIdList();

if(Common::isPost()) {
  $ips = LVSWebsiteIP::getIPsByWebsiteID($website_id);
  if(in_array($website_ip, $ips)){
    //exist
    OSAdmin::alert("error",ErrorMessage::NAME_CONFLICT);
  }elseif (!$website_id || !$website_ip){
    OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
  }elseif (!Common::isIp($website_ip)){
    OSAdmin::alert('error', ErrorMessage::NOT_VALID_IP);
  }else{
    $website_ip_data = array(
      "website_id" => $website_id,
      "website_ip" => $website_ip,
      "remark" => $remark
    );
    $website_ip_id = LVSWebsiteIP::addWebsiteIP($website_ip_data);
    if($website_ip_id) {
      SysLog::addLog(UserSession::getUserName(), 'ADD', 'WebsiteIP' ,$website_ip_id, json_encode($data));
			Common::exitWithSuccess('平台IP添加成功','lvs/user/website_ip.php');
    }else{
      OSAdmin::alert("error");
    }
  }
}

Template::assign("website_id_list",$website_id_list);
Template::assign("website_ip_data",$_POST);
Template::display("lvs/user/website_ip_modify.tpl");
