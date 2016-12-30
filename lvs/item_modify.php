<?php

require '../include/init.inc.php';

$item_id = $item_name = $item_directive = '';
extract($_REQUEST, EXTR_IF_EXISTS);

if ($item_id == '') {
  OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
}else{
  if (Common::isGet()) {
    $item_info = LVSItem::getItemInfoById($item_id);
  } elseif (Common::isPost()) {
    if ($item_name == ''||$item_directive == '') {
        OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
    }
    $item_data = array(
      'item_name' => $item_name,
      'item_directive' => $item_directive
    );
    $result = LVSItem::updateItem($item_id, $item_data);
    if ($result >= 0) {
        SysLog::addLog(UserSession::getUserName(), 'MODIFY', 'Item', $user_id, json_encode($item_data));
        Common::exitWithSuccess('更新完成', 'lvs/item.php');
    } else {
        OSAdmin::alert('error');
    }
  }
}

Template::assign('item_info', $item_info);
Template::display('lvs/item_modify.tpl');
