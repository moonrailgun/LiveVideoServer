<?php
require ('../../include/init.inc.php');
$website_id = $sort_by = $start_date = $end_date = $search = '';
extract($_GET, EXTR_IF_EXISTS);

$website_id_list = LVSWebsite::getWebsiteIdList();
$item_id_list = LVSItem::getItemIdList();

if($search == 1) {
  if(!$sort_by) {
    OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
  }else {
    if(!!$website_id) {
      $actorList = LVSActor::getActorListByWebsite($website_id);
      $actorIdList = array();
      foreach ($actorList as $key => $value) {
        array_push($actorIdList, $value['user_id']);
      }
      $condition['AND']['actorId'] = $actorIdList;
    }

    if(!!$item_id) {
      $condition['AND']['toolName'] = $item_id_list[$item_id];
    }

    if(!!$start_date && !!$end_date) {
      $condition['AND']['createdDate[<>]'] = array($start_date, $end_date);
    }else{
      $sd = date("Y-m-d",mktime(0,0,0,date("m"),date("d")-6,date("Y")));
      $ed = date("Y-m-d",mktime(0,0,0,date("m"),date("d")+1,date("Y")));
      $condition['AND']['createdDate[<>]'] = array($sd, $ed);
    }

    $rank_list = LVSStatis::getActorRank($condition, $sort_by);
  }
}else{
  $rank_list = LVSStatis::getActorRank();
}

Template::assign('_GET',$_GET);
Template::assign('rank_list', $rank_list);
Template::assign('website_id_list', $website_id_list);
Template::assign('item_id_list', $item_id_list);
Template::display('lvs/statistics/actor_rank.tpl');
