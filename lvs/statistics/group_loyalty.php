<?php
require ('../../include/init.inc.php');
$group_id = $item_id = $analysis_by = $start_date = $end_date = '';
extract($_GET, EXTR_IF_EXISTS);

$group_id_list = LVSGroup::getGroupIdList();
$item_id_list = LVSItem::getItemIdList();

if(!!$group_id){
  $actorList = LVSActor::getActorListByGroup($group_id);
  $actorIdList = array();
  foreach ($actorList as $key => $value) {
    array_push($actorIdList, $value['user_id']);
  }
  $condition['AND']['actorId'] = $actorIdList;
}
if(!!$item_id){
  $condition['AND']['toolName'] = $item_id_list[$item_id];
}
if(!!$start_date && !!$end_date){
  $condition['AND']['createdDate[<>]'] = array($start_date, $end_date);
}else{
  $sd = date("Y-m-d",mktime(0,0,0,date("m"),date("d")-6,date("Y")));
  $ed = date("Y-m-d",mktime(0,0,0,date("m"),date("d")+1,date("Y")));
  $condition['AND']['createdDate[<>]'] = array($sd, $ed);
}

if($analysis_by){
  $list = LVSStatis::getGroupLoyalty($condition, $analysis_by);
}else{
  $list = LVSStatis::getGroupLoyalty($condition);
}

Template::assign('_GET', $_GET);
Template::assign('loyalty_data', $list);
Template::assign('group_id_list', $group_id_list);
Template::assign('item_id_list', $item_id_list);
Template::display('lvs/statistics/group_loyalty.tpl');
