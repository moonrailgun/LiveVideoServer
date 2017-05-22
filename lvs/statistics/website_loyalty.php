<?php
// TODO 假的，目前和website_loyalty内容一样
require ('../../include/init.inc.php');
$website_id = $item_id = $analysis_by = $start_date = $end_date = '';
extract($_GET, EXTR_IF_EXISTS);

$website_id_list = LVSWebsite::getWebsiteIdList();
$item_id_list = LVSItem::getItemIdList();

if(!!$website_id){
  $actorList = LVSActor::getActorListByWebsite($website_id);
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
  $list = LVSStatis::getItemLoyalty($condition, $analysis_by);
}else{
  $list = LVSStatis::getItemLoyalty($condition);
}

Template::assign('_GET', $_GET);
Template::assign('loyalty_data', $list);
Template::assign('website_id_list', $website_id_list);
Template::assign('item_id_list', $item_id_list);
Template::display('lvs/statistics/website_loyalty.tpl');
