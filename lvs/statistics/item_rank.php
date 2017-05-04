<?php
require ('../../include/init.inc.php');
$website_id = $sort_by = $start_date = $end_date = $search = '';
extract($_GET, EXTR_IF_EXISTS);

if($search == 1) {
  if(!!$website_id && !!$sort_by && !!$start_date && !!$end_date) {
    OSAdmin::alert('error', ErrorMessage::NEED_PARAM);
  }else{
    // TODO
  }
}else{
  // TODO
}


$website_id_list = LVSWebsite::getWebsiteIdList();

Template::assign('_GET',$_GET);
Template::assign('website_id_list', $website_id_list);
Template::display('lvs/statistics/item_rank.tpl');
