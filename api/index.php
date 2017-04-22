<?php
require ('../include/init.inc.php');

echo "此页面不可用";

if(Common::isPost()){
  echo 'POST http://127.0.0.1/api/user/login.php';
  echo '[application/x-www-form-urlencoded] userID=demo&password=123456';
  echo "GET http://127.0.0.1/api/statistics/getByActor.php?actorID=lf001&sendStartTime=2016-11-13 14:21:42&sendEndTime=2016-11-13 14:34:50";
  echo 'GET http://127.0.0.1/api/statistics/getByTool.php?actorID=lf001&sendStartTime=2016-11-13 14:21:42&sendEndTime=2016-11-13 14:34:50';
  echo 'GET http://127.0.0.1/api/statistics/getDetailList.php?actorID=lf001&sendStartTime=2016-11-13 14:21:42&sendEndTime=2016-11-13 14:34:50'
  echo 'GET http://127.0.0.1/api/statistics/statis.php?actorID=lf001&sendStartTime=2016-11-13 14:21:42&sendEndTime=2016-11-13 14:34:50';
  echo 'POST http://127.0.0.1/api/item/addItem.php';
  echo '[application/x-www-form-urlencoded] actorID=lf002&actorName=002&playerID=gz002&playerName=902&toolName=不造2&toolTypeName=未知类型&totalCost=30&totalAmount=3;
}
?>
