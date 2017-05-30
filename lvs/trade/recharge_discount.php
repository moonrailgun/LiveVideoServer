<?php
require ('../../include/init.inc.php');

$discount_list = LVSCommon::getList(LVSCommon::$recharge_discount);

//追加操作的确认层
$confirm_html = OSAdmin::renderJsConfirm("icon-remove,icon-repeat");

Template::assign("discount_list",$discount_list);
Template::assign("osadmin_action_confirm",$confirm_html);
Template::display("lvs/trade/recharge_discount.tpl");
