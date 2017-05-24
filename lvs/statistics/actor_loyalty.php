<?php
require ('../../include/init.inc.php');
$website_id = $group_id = $item_id = $actor_id = $analysis_by = $start_date = $end_date = '';
extract($_GET, EXTR_IF_EXISTS);

$website_id_list = LVSWebsite::getWebsiteIdList();
$group_id_list = LVSGroup::getGroupIdList();
$item_id_list = LVSItem::getItemIdList();

if(!$actor_id) {
  // 没有选定特定主播
  if(!!$website_id){
    $actorList = LVSActor::getActorListByWebsite($website_id);
    $actorIdList = array();
    foreach ($actorList as $key => $value) {
      array_push($actorIdList, $value['user_id']);
    }
    $condition['AND']['actorID'] = $actorIdList;
  }

  if(!!$group_id){
    $actorList = LVSActor::getActorListByGroup($group_id);
    if(!!$actorIdList) {
      $tmp = array();
      foreach ($actorList as $key => $value) {
        array_push($tmp, $value['user_id']);
      }
      $actorIdList = array_intersect($actorIdList, $tmp);
    }else{
      $actorIdList = array();
      foreach ($actorList as $key => $value) {
        array_push($actorIdList, $value['user_id']);
      }
    }
    $condition['AND']['actorID'] = $actorIdList;
  }
}else {
  // 选定特定主播
  $actor = LVSActor::getActorByID($actor_id);
  $condition['AND']['actorID'] = $actor['user_id'];
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

if($analysis_by) {
  $list = LVSStatis::getItemLoyalty($condition, $analysis_by);
}else{
  $list = LVSStatis::getItemLoyalty($condition);
}

Template::assign('_GET', $_GET);
Template::assign('loyalty_data', $list);
Template::assign('website_id_list', $website_id_list);
Template::assign('group_id_list', $group_id_list);
Template::assign('item_id_list', $item_id_list);
Template::display('lvs/statistics/actor_loyalty.tpl');
