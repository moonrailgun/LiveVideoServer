<?php
require ('../../include/init.inc.php');
$website_id = $sort_by = $start_date = $end_date = $search = '';
extract($_GET, EXTR_IF_EXISTS);

if($search == 1) {
  if(!$website_id || !$sort_by || !$start_date || !$end_date) {
    OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
  }else{
    // TODO
    $condition['AND'] = array(
      // 'website_id' => $website_id, TODO: 道具记录中的平台id如何获得
      'createdDate[<>]' => [$start_date, $end_date]
    );
    $rank_list = LVSStatis::getItemRank($condition, $sort_by);
  }
}else{
  $rank_list = LVSStatis::getItemRank();
}

$website_id_list = LVSWebsite::getWebsiteIdList();

Template::assign('_GET',$_GET);
Template::assign('rank_list', $rank_list);
Template::assign('website_id_list', $website_id_list);
Template::display('lvs/statistics/item_rank.tpl');
