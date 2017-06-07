<?php
require ('../../include/init.inc.php');
extract ($_POST, EXTR_IF_EXISTS);

if(Common::isPost()){
  Common::setJsonHeader();

  $res['statusCode'] = 1;
  $data = LVSCommon::getList(LVSCommon::$recharge_discount);
  if($data){
    $res['resultCode'] = 1;
    $tmp = array();
    foreach ($data as $key => $value) {
      array_push($tmp, array(
        'realCost' => $value['recharge_amount'],
        'virtualCost' => $value['recharge_discount']
      ));
    }
    $res['data'] = $tmp;
  }else{
    $res['resultCode'] = 0;
    $res['data'] = array();
  }

  echo json_encode($res);
}
