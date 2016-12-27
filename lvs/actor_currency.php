<?php
require ('../include/init.inc.php');
$website_id = '';
extract($_REQUEST, EXTR_IF_EXISTS);

$website_id_list = LVSWebsite::getWebsiteIdList();
if($website_id == ''){
  $website_id = array_keys($website_id_list)[0];
}

$actor_list = LVSActor::getActorListByWebsite($website_id);

Template::assign("website_id_list",$website_id_list);
Template::assign("actor_list",$actor_list);
Template::assign("website_id",$website_id);
Template::display("lvs/actor_currency.tpl");

?>
