<?php
require ('../../include/init.inc.php');
$website_id = $website_timespan = '';
extract($_POST, EXTR_IF_EXISTS);

$website_id_list = LVSWebsite::getWebsiteIdList();

if(Common::isPost()) {
  if(!$website_id || !$website_timespan){
    OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
  }elseif (LVSCommon::getList(LVSCommon::$timespan, array('website_id' => $website_id))[0]) {
    OSAdmin::alert("error",ErrorMessage::NAME_CONFLICT);
  }else{
    $data = array(
      'website_id' => $website_id,
      'website_timespan' => $website_timespan,
    );

    $id = LVSCommon::insert(LVSCommon::$timespan, $data);
    if($id) {
      SysLog::addLog(UserSession::getUserName(), 'ADD', 'Timespan' ,$id, json_encode($data));
			Common::exitWithSuccess('采数规则添加成功','lvs/rule/timespan.php');
    }else{
      OSAdmin::alert("error");
    }
  }
}

Template::assign("website_id_list",$website_id_list);
Template::assign("data",$_POST);
Template::display("lvs/rule/timespan_modify.tpl");
