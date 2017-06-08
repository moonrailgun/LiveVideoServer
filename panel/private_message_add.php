<?php
require ('../include/init.inc.php');
$message_type = $message_to = $message_content = '';
extract($_POST, EXTR_IF_EXISTS);

if(Common::isPost()) {
  if(!$message_type || !$message_content) {
    OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
  }else {
    $data = array(
      'message_type' => $message_type,
      'message_content' => $message_content
    );
    if($message_type == 'user') {
      $data['message_to'] = $message_to;
    }

    $id = PrivateMessage::createMessage($data);
    if($id) {
      SysLog::addLog(UserSession::getUserName(), 'ADD', 'PM' ,$id, json_encode($data));
			Common::exitWithSuccess ('消息发送成功','panel/private_message.php');
    }else{
      OSAdmin::alert("error");
    }
  }
}

$message_type_list = PrivateMessage::getMessageType();

$user_info_list = User::getAllUsers();
$user_list = array();
foreach ($user_info_list as $key => $value) {
  array_push($user_list, $value['user_name']);
}

Template::assign("message_type_list" ,$message_type_list);
Template::assign("user_list" ,$user_list);
Template::assign("_POST" ,$_POST);
Template::display('panel/private_message_add.tpl');
