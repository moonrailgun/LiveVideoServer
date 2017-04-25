<?php
require ('../include/init.inc.php');
$level = $province = $city = '';
extract ($_GET, EXTR_IF_EXISTS);

if($level == 1){
  echo json_encode(City::getProvince());
}else if ($level == 2 && !!$province){
  echo json_encode(City::getCity($province));
}else if ($level == 3 && !!$province && !!$city){
  echo json_encode(City::getArea($province, $city));
}
