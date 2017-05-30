<?php
require ('../../include/init.inc.php');
extract($_GET, EXTR_IF_EXISTS);

$data = LVSConfig::getConfig('ITEM_COST');

Template::assign("data", $data);
Template::assign("_GET", $_GET);
Template::display("lvs/trade/item_cost.tpl");
