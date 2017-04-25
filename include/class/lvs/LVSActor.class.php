<?php

class LVSActor extends LVSBase
{
    private static $table_name = 'actor';
    private static $columns = array('id', 'website_id', 'group_id', 'real_name', 'sex','live_id','user_id','channel_id','address','is_invalid');

    public static function checkPassword($user_id, $actor_password){
      $md5_pwd = md5($actor_password);
      $db=self::__instance();
      $condition["AND"] = array(
        "user_id" => $user_id,
        "actor_password"=>$md5_pwd
      );

      $list = $db->select(self::getTableName(), self::$columns, $condition);
  		if ($list) {
  			return $list[0];
  		} else {
  			return false;
  		}
    }

    public static function resetPassword($actor_id){
      if(!$actor_id || !is_numeric($actor_id)){
        return false;
      }
      $db=self::__instance();

      $condition=array("id"=>$actor_id);
      $data = array(
        "actor_password"=>md5("123456")
      );

  		$id = $db->update(self::getTableName(), $data, $condition );
  		return $id;
    }

    public static function changePassword($actor_id, $old_password, $new_password){
      if(!$actor_id || !is_numeric($actor_id)){
        return false;
      }

      $db = self::__instance();

      $condition["AND"]=array(
        "id"=>$actor_id, "actor_password"=>md5($old_password)
      );
      $data = array(
        "actor_password"=>md5($new_password)
      );
      $id = $db->update(self::getTableName(), $data, $condition);
  		return $id;
    }

    public static function getTableName(){
        return parent::$table_prefix.self::$table_name;
    }

    public static function getAllActor(){
      $db = self::__instance();

      $condition = array("is_invalid" => "0");
      $list = $db->select(self::getTableName(), self::$columns, $condition);

      if ($list) {
          return $list;
      }

      return array();
    }

    public static function getActorListByWebsite($website_id){
      $db = self::__instance();

      $condition['AND'] = array(
        "is_invalid" => "0",
        "website_id" => $website_id
      );
      $list = $db->select(self::getTableName(), self::$columns, $condition);

      if ($list) {
          return $list;
      }

      return array();
    }

    public static function getActorListWithCondition($condition) {
      $db = self::__instance();
      $list = $db->select(self::getTableName(), self::$columns, $condition);

      if ($list) {
        return $list;
      }
      return array();
    }

    // $actor_nick_name = $list[$website_id][$actor_id]
    public static function getActorIdList(){
      $result = array();
      $actor_list = self::getAllActor();
      foreach ($actor_list as $key => $value) {
        $website_id = $value['website_id'];
        $actor_id = $value['id'];
        $actor_nick_name = $value['real_name'];
        $result[$website_id][$actor_id] = $actor_nick_name;
      }
      return $result;
    }

    public static function getActorIdListByWebsite($website_id){
      $result = array();
      $actor_list = self::getActorListByWebsite($website_id);
      foreach ($actor_list as $key => $value) {
        $actor_id = $value['id'];
        $actor_nick_name = $value['real_name'];
        $result[$actor_id] = $actor_nick_name;
      }
      return $result;
    }

    public static function getActorNameByGeneratedName($generated_name){
      if (!$generated_name) {
  			return false;
  		}
  		$db=self::__instance();
  		$condition = array("AND" =>
  						array("user_id[=]" => $generated_name,
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
      $update_data = array('is_invalid' => 1);
      $condition = array('id' => $actor_id);

      $id = $db->update(self::getTableName(), $update_data, $condition);

      return $id;
    }

    public static function enableActor($actor_id){
      if (empty($actor_id)) {
          return false;
      }

      $db = self::__instance();
      $update_data = array('is_invalid' => 0);
      $condition = array('id' => $actor_id);

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
      $actor_data["actor_password"] = md5("123456");
      $db = self::__instance();
      $id = $db->insert(self::getTableName(), $actor_data);

      return $id;
    }

    public static function updateActor($actor_id, $actor_data){
      if (!$actor_data || !is_array($actor_data)) {
          return false;
      }

      $db = self::__instance();
      $condition = array('id' => $actor_id);

      $id = $db->update(self::getTableName(), $actor_data, $condition);

      return $id;
    }

    //输入一个数据库列表。返回一个以ID为key的数组
    public static function rebuildActorListById($actor_list){
      $result = array();
      foreach ($actor_list as $key => $value) {
        $actor_id = $value["id"];
        $result[$actor_id] = $value;
      }
      return $result;
    }
}
