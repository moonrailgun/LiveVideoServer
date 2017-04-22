<?php
require ('../../include/init.inc.php');
$userID = $startTime = $endTime = '';
extract ($_POST, EXTR_IF_EXISTS);

if(Common::isPost()){
  Common::setJsonHeader();

  $res['statusCode'] = 1;

  $data = LVSItemLog::getItemLog($startTime, $endTime, $userID);
  if($data){
    $res['resultCode'] = 1;
    foreach ($data as $key => $value) {
      # code...
      $res['data'][$key]['time'] = $value['createdDate'];
      $res['data'][$key]['costAmount'] = $value['totalCost'];
      $res['data'][$key]['toolName'] = $value['toolName'];
    }
  }else{
    $res['resultCode'] = 0;
  }

  echo json_encode($res);
}
