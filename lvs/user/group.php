<?php
require ('../../include/init.inc.php');

$method = '';
extract($_REQUEST, EXTR_IF_EXISTS);

$group_list = LVSGroup::getAllList();

//追加操作的确认层
$confirm_html = OSAdmin::renderJsConfirm("icon-remove,icon-repeat");

Template::assign("group_list",$group_list);
Template::assign("osadmin_action_confirm",$confirm_html);
Template::display("lvs/user/group.tpl");
