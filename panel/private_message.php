<?php
require ('../include/init.inc.php');
$message_type = $start_date = $end_date = '';
extract ( $_GET, EXTR_IF_EXISTS );

if(!!$message_type) {
  $condition['AND']['message_type'] = $message_type;
}

if(!!$start_date && !!$end_date) {
  $condition['AND']['createdAt[<>]'] = array($start_date, $end_date);
}

$list = PrivateMessage::getUserMessage($condition);
$message_type_list = PrivateMessage::getMessageType();

Template::assign("message_type_list" ,$message_type_list);
Template::assign("_GET" ,$_GET);
Template::assign("list" ,$list);
Template::display('panel/private_message.tpl');
