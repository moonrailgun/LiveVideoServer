<?php
require ('../../include/init.inc.php');

$actor_list = LVSActor::getAllActor();
$website_id_list = LVSWebsite::getWebsiteIdList();
$group_id_list = LVSGroup::getGroupIdList();

//追加操作的确认层
$confirm_html = OSAdmin::renderJsConfirm("icon-remove,icon-repeat");

Template::assign("website_id_list",$website_id_list);
Template::assign("group_id_list",$group_id_list);
Template::assign("actor_list",$actor_list);
Template::assign("osadmin_action_confirm",$confirm_html);
Template::display("lvs/user/actor.tpl");
