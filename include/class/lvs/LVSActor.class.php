<?php

class LVSActor extends LVSBase
{
    private static $table_name = 'actor';
    private static $columns = array('actor_id', 'actor_nick_name', 'actor_website', 'actor_generated_name', 'actor_phone','actor_real_name','actor_currency','actor_is_actived');

    public static function getTableName()
    {
        return parent::$table_prefix.self::$table_name;
    }

    public static function getAllActor(){
      $db = self::__instance();

      $condition = array("actor_is_actived" => "1");
      $list = $db->select(self::getTableName(), self::$columns, $condition);

      if ($list) {
          return $list;
      }

      return array();
    }

    public static function getActorListByWebsite($website_id){
      $db = self::__instance();

      $condition['AND'] = array(
        "actor_is_actived" => "1",
        "actor_website" => $website_id
      );
      $list = $db->select(self::getTableName(), "*", $condition);

      if ($list) {
          return $list;
      }

      return array();
    }

    public static function getActorNameByGeneratedName($generated_name){
      if (!$generated_name) {
  			return false;
  		}
  		$db=self::__instance();
  		$condition = array("AND" =>
  						array("actor_generated_name[=]" => $generated_name,
  						)
  					);
  		$list = $db->select ( self::getTableName(), self::$columns, $condition );

  		if ($list) {
  			return $list[0];
  		}
  		return array ();
    }

    public static function unableActor($actor_id){
      if (empty($actor_id)) {
          return false;
      }

      $db = self::__instance();
      $update_data = array('actor_is_actived' => 0);
      $condition = array('actor_id' => $actor_id);

      $id = $db->update(self::getTableName(), $update_data, $condition);

      return $id;
    }

    public static function enableActor($actor_id){
      if (empty($actor_id)) {
          return false;
      }

      $db = self::__instance();
      $update_data = array('actor_is_actived' => 1);
      $condition = array('actor_id' => $actor_id);

      $id = $db->update(self::getTableName(), $update_data, $condition);

      return $id;
    }

    public static function getActorInfoById($actor_id){
      if (empty($actor_id)) {
          return false;
      }

      $db = self::__instance();
      $condition = array('actor_id' => $actor_id);

      $list = $db->select(self::getTableName(), self::$columns, $condition);
      if($list){
        return $list[0];
      }

      return array();
    }

    public static function addActor($actor_data){
      if (!$actor_data || !is_array($actor_data)) {
          return false;
      }
      $db = self::__instance();
      $id = $db->insert(self::getTableName(), $actor_data);

      return $id;
    }

    public static function updateActor($actor_id, $actor_data){
      if (!$actor_data || !is_array($actor_data)) {
          return false;
      }

      $db = self::__instance();
      $condition = array('actor_id' => $actor_id);

      $id = $db->update(self::getTableName(), $actor_data, $condition);

      return $id;
    }

    //输入一个数据库列表。返回一个以ID为key的数组
    public static function rebuildActorListById($actor_list){
      $result = array();
      foreach ($actor_list as $key => $value) {
        $actor_id = $value["actor_id"];
        $result[$actor_id] = $value;
      }
      return $result;
    }
}
