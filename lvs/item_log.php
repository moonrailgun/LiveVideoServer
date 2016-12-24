<?php
require ('../include/init.inc.php');

$item_logs = LVSItem::getAllItemLog();

Template::assign("item_logs" ,$item_logs);
Template::display ( 'lvs/item_log.tpl' );
?>
