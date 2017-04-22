<?php
require ('../../include/init.inc.php');
$userID = $oldPassword = $newPassword = '';
extract ($_POST, EXTR_IF_EXISTS);

if(Common::isPost()){
  Common::setJsonHeader();

  $res['statusCode'] = 1;
  $res['resultCode'] = 1;
  $data = LVSActor::changePassword($userID, $oldPassword, $newPassword);
  if($data){
    $res['data'][0]['result'] = 1;
    $res['data'][0]['tip'] = "密码修改成功";
  }else{
    $res['data'][0]['result'] = 0;
    $res['data'][0]['tip'] = "旧密码错误";
  }

  echo json_encode($res);
}
