<?php
require ('../include/init.inc.php');
$website_id = $group_id = '';
extract ($_GET, EXTR_IF_EXISTS);


Common::setJsonHeader();
if($website_id && $group_id){
  $condition['AND'] = array(
    'website_id' => $website_id,
    'group_id' => $group_id
  );
  echo json_encode(LVSActor::getActorListWithCondition($condition));
}else{
  echo "[]";
}
