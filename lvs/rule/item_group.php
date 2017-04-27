<?php
require ('../../include/init.inc.php');

$item_group_list = LVSItemGroup::getAllList();

//追加操作的确认层
$confirm_html = OSAdmin::renderJsConfirm("icon-remove");

Template::assign('osadmin_action_confirm', $confirm_html);
Template::assign('item_group_list',$item_group_list);
Template::display('lvs/rule/item_group.tpl');
