<?php

class LVSActor extends LVSBase
{
    private static $table_name = 'actor';
    private static $columns = array('actor_id', 'actor_nick_name', 'actor_website', 'actor_generated_name', 'actor_phone','actor_real_name','actor_is_actived');

    public static function getTableName()
    {
        return parent::$table_prefix.self::$table_name;
    }

    public static function getAllActor(){
      $db = self::__instance();

      $condition = array('actor_is_actived' => "1");
      $list = $db->select(self::getTableName(), self::$columns, $condition);

      if ($list) {
          return $list;
      }

      return array();
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

    public static function getActorInfoById(){
      if (empty($actor_id)) {
          return false;
      }

      $db = self::__instance();
      $condition = array('actor_id' => $actor_id);

      $id = $db->select(self::getTableName(), self::$columns, $condition);

      return $id;
    }
}
