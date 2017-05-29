<?php
require ('../../include/init.inc.php');
$actor_id = $sort_by = $start_date = $end_date = $search = '';
extract($_GET, EXTR_IF_EXISTS);

$website_id_list = LVSWebsite::getWebsiteIdList();
$group_id_list = LVSGroup::getGroupIdList();

if($search == 1) {
  if(!$sort_by || !$actor_id) {
    OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
  }else {
    if(!!$actor_id) {
      $actor_info = LVSActor::getActorByID($actor_id);
      $condition['AND']['actorID'] = $actor_info['user_id'];
    }

    if(!!$start_date && !!$end_date) {
      $condition['AND']['createdDate[<>]'] = array($start_date, $end_date);
    }else{
      $sd = date("Y-m-d",mktime(0,0,0,date("m"),date("d")-6,date("Y")));
      $ed = date("Y-m-d",mktime(0,0,0,date("m"),date("d")+1,date("Y")));
      $condition['AND']['createdDate[<>]'] = array($sd, $ed);
    }

    $rank_list = LVSStatis::getItemRank($condition, $sort_by);
  }
}else{
  $rank_list = LVSStatis::getItemRank();
}

Template::assign('_GET',$_GET);
Template::assign('rank_list', $rank_list);
Template::assign('website_id_list', $website_id_list);
Template::assign('group_id_list', $group_id_list);
Template::display('lvs/statistics/actor_item_rank.tpl');
