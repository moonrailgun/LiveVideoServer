<?php
if(!defined('ACCESS')) {exit('Access denied.');}
class City {
  protected static function getCityData() {
    $RootDir = $_SERVER['DOCUMENT_ROOT'];
    $str = file_get_contents("$RootDir/include/config/city.json");
    return json_decode($str, true);
  }

  public static function getProvince() {
    $result = array();
    foreach (self::getCityData() as $key => $value) {
      array_push($result, $value["name"]);
    }
    return $result;
  }

  public static function getCity($province){
    foreach (self::getCityData() as $key => $value) {
      if($value["name"] == $province){
        $result = array();
        foreach ($value["city"] as $sub_key => $sub_value) {
          array_push($result, $sub_value["name"]);
        }

        return $result;
      }
    }

    return array();
  }

  public static function getArea($province, $city){
    foreach (self::getCityData() as $key => $value) {
      if($value["name"] == $province){
        foreach ($value["city"] as $sub_key => $sub_value) {
          if($sub_value["name"] == $city){
            return $sub_value["area"];
          }
        }
      }
    }
    return array();
  }
}
