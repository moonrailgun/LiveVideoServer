<?php
require ('../../include/init.inc.php');

$rule_list = LVSRule::getRule(LVSRule::$acquisition_table_name);
$website_id_list = LVSWebsite::getWebsiteIdList();

//追加操作的确认层
$confirm_html = OSAdmin::renderJsConfirm("icon-remove");

Template::assign ('osadmin_action_confirm' , $confirm_html);
Template::assign("rule_list",$rule_list);
Template::assign("website_id_list",$website_id_list);
Template::display("lvs/rule/acquisition.tpl");

?>
