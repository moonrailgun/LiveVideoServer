<?php
require ('../include/init.inc.php');
$item_name = $item_directive = '';
extract($_POST, EXTR_IF_EXISTS);

if(Common::isPost()){
  $exist = LVSItem::getItemByName($website_name);
  if($exist){
    OSAdmin::alert("error",ErrorMessage::NAME_CONFLICT);
  }else{
    $item_data = array(
      "item_name" => $item_name,
      "item_directive" => $item_directive
    );
    $item_id = LVSItem::addItem($item_data);

    if ($item_id) {
			SysLog::addLog ( UserSession::getUserName(), 'ADD', 'Item' ,$item_id, json_encode($item_data) );
			Common::exitWithSuccess ('道具添加成功','lvs/item.php');
		}else{
			OSAdmin::alert("error");
		}
  }
}

Template::assign("_POST",$_POST);
Template::display("lvs/item_add.tpl");
?>
