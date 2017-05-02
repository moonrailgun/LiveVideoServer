<?php
require ('../../include/init.inc.php');
$id = $website_id = $website_timespan = '';
extract($_REQUEST, EXTR_IF_EXISTS);

$website_id_list = LVSWebsite::getWebsiteIdList();

if(!$id) {
  OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
}else{
  $condition['AND'] = array(
    'id' => $id
  );
  $data = LVSCommon::getList(LVSCommon::$timespan, $condition)[0];

  if(Common::isPost()) {
    if(!$website_id || !$website_timespan) {
      OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
    }else{
      $data = array(
        'website_id' => $website_id,
        'website_timespan' => $website_timespan,
      );
      $result = LVSCommon::update(LVSCommon::$timespan, $data, $condition);
      if($result >= 0){
        SysLog::addLog(UserSession::getUserName(), 'MODIFY', 'Timespan' ,$id, json_encode($data));
  			Common::exitWithSuccess('采数规则添加成功','lvs/rule/timespan.php');
      }else {
        OSAdmin::alert('error');
      }
    }
  }
}

Template::assign("website_id_list",$website_id_list);
Template::assign("data",$data);
Template::display("lvs/rule/timespan_modify.tpl");
