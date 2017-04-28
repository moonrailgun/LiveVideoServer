<?php
require ('../include/init.inc.php');
$website_id = '';
extract ($_GET, EXTR_IF_EXISTS);

if($website_id){
  echo json_encode(LVSGift::getGiftTypeIdListByWebsiteId($website_id));
}else{
  echo "[]";
}
