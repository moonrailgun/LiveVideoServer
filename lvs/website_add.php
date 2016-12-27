<?php
require ('../include/init.inc.php');
$website_name = $website_short_name = $website_desc = '';
extract($_POST, EXTR_IF_EXISTS);

if(Common::isPost()){
  $exist = LVSWebsite::getWebsiteByName($website_name);
  $short_name_exist = LVSWebsite::getWebsiteByShortName($website_short_name);
  if($exist){
    OSAdmin::alert("error",ErrorMessage::WEBSITE_NAME_CONFLICT);
  }else if($short_name_exist){
    OSAdmin::alert("error",ErrorMessage::WEBSITE_SHORT_NAME_CONFLICT);
  }else{
    $website_data = array(
      "website_name" => $website_name,
      "website_short_name" => $website_short_name,
      "website_desc" => $website_desc
    );
    $website_id = LVSWebsite::addWebsite($website_data);

    if ($website_id) {
			SysLog::addLog ( UserSession::getUserName(), 'ADD', 'Website' ,$website_id, json_encode($website_data) );
			Common::exitWithSuccess ('网站添加成功','lvs/website.php');
		}else{
			OSAdmin::alert("error");
		}
  }
}

Template::assign("_POST",$_POST);
Template::display("lvs/website_add.tpl");
?>
