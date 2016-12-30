<?php
require '../include/init.inc.php';
$item_id = $method = "";
extract($_REQUEST, EXTR_IF_EXISTS);

if($method == 'del' && !empty($item_id)){
  $item_info = LVSItem::getItemInfoById($item_id);
  $result = LVSItem::delItem ( $item_id );

  if ($result>=0) {
    SysLog::addLog(UserSession::getUserName(), 'DELETE', 'Item' ,$item_id ,json_encode($item_info));
    Common::exitWithSuccess('已删除道具','lvs/item.php' );
  }else{
    OSAdmin::alert("error");
  }
}

$item_list = LVSItem::getAllItem();
//追加操作的确认层
$confirm_html = OSAdmin::renderJsConfirm("icon-remove");

Template::assign('item_list', $item_list);
Template::assign ('osadmin_action_confirm' , $confirm_html);
Template::display('lvs/item.tpl');
?>
