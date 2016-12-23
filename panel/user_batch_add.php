<?php
require ('../include/init.inc.php');
$user_id_prefix = $suffix_number = $start_num = $count_num = $password = $website_name = $user_desc = '';
extract ( $_POST, EXTR_IF_EXISTS );

if (Common::isPost ()) {
  //生成组合
  $ids = User::batchAddUsers($user_id_prefix, $suffix_number,$start_num,$count_num, $password,$website_name, $user_desc);
  if($ids){
    SysLog::addLog (UserSession::getUserName(), 'ADD', 'User' ,$user_id, "批量添加:".json_encode($ids));
    Common::exitWithSuccess ('账号批量添加成功','panel/users.php');
  }else{
    OSAdmin::alert("error");
  }
}

Template::assign("_POST" ,$_POST);
Template::display ( 'panel/user_batch_add.tpl' );
?>
