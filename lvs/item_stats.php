<?php
require '../include/init.inc.php';

$website_id = $start_date = $end_date = '';
$actor_id = '';
$player_name = $item_name = '';
extract($_GET, EXTR_IF_EXISTS);

if($website_id != '' && $start_date!= '' && $end_date != ''){
  $show_actor_options = true;

  $actor_id_list = LVSActor::getActorIdListByWebsite($website_id);
  $tab_actor_data = LVSStatis::statisByActorWorth($website_id, $start_date, $end_date);

  if($actor_id != ''){
    $tab_item_data = LVSStatis::statisByItemName($actor_id, $start_date, $end_date);
    $tab_detail_data = LVSStatis::statisByActorID($actor_id, $start_date, $end_date);
    $tab_time_data = LVSStatis::statisByTime($actor_id, $start_date, $end_date);
  }
}
$website_id_list = LVSWebsite::getWebsiteIdList();
$item_id_list = LVSItem::getItemIdList();

Template::assign('_GET',$_GET);
Template::assign('show_actor_options',$show_actor_options);
Template::assign('actor_id_list',$actor_id_list);
Template::assign('tab_actor_data',$tab_actor_data);
Template::assign('tab_item_data',$tab_item_data);
Template::assign('tab_player_cost_data',$tab_player_cost_data);
Template::assign('tab_detail_data',$tab_detail_data);
Template::assign('tab_time_data',json_encode($tab_time_data, JSON_UNESCAPED_UNICODE));
Template::assign('website_id_list',$website_id_list);
Template::assign('item_id_list',$item_id_list);
Template::assign('actor_name',$actor_id_list[$website_id]);
Template::assign('website_name',$website_id_list[$website_id]);
Template::display('lvs/item_stats.tpl');
?>
