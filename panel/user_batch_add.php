<?php
require ('../include/init.inc.php');
$user_id_prefix = $suffix_number = $start_num = $count_num = $password = $website_name = $user_desc = '';
extract ( $_POST, EXTR_IF_EXISTS );

if (Common::isPost ()) {
  //生成组合
  User::batchAddUsers($user_id_prefix, $suffix_number,$start_num,$count_num, $password,$website_name, $user_desc);
}

?>
