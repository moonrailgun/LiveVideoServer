<?php
require '../include/init.inc.php';

$website_id = $start_date = $end_date = '';
$actor_id = '';
extract($_GET, EXTR_IF_EXISTS);

$tab_actor_data = LVSStatis::statisByActorWorth($website_id, $start_date, $end_date);


$website_id_list = LVSWebsite::getWebsiteIdList();

Template::assign('_GET',$_GET);
Template::assign('tab_actor_data',$tab_actor_data);
Template::assign('website_id_list',$website_id_list);
Template::display('lvs/item_stats.tpl');
?>
