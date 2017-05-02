<?php
require ('../../include/init.inc.php');

$website_id_list = LVSWebsite::getWebsiteIdList();
$group_id_list = LVSGroup::getGroupIdList();

Template::assign("website_id_list",$website_id_list);
Template::assign("group_id_list",$group_id_list);
Template::display("lvs/rule/item_available.tpl");
