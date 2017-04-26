<?php
class LVSGift extends LVSBase{
	private static $table_name = "gift";

	public static function getTableName(){
		return parent::$table_prefix.self::$table_name;
	}

	private static $columns = array('id','website_id','gift_type');

  public static function getAllGift(){
    $db = self::__instance();

		$list = $db->select(self::getTableName(),self::$columns);
		if($list){
			return $list;
		}
		return array ();
  }

  public static function getGiftByID($gift_id){
    $db = self::__instance();

    $condition['AND']['id'] = $gift_id;
		$list = $db->select(self::getTableName(),self::$columns,$condition);
		if($list){
			return $list[0];
		}
		return array ();
  }

  public static function getGiftBywebsiteID($website_id){
    $db = self::__instance();

    $condition['AND']['website_id'] = $website_id;
		$list = $db->select(self::getTableName(),self::$columns,$condition);
		if($list){
			return $list;
		}
		return array ();
  }

  public static function addGift($gift_data) {
    if (!$gift_data || !is_array($gift_data)) {
      return false;
    }
    $db = self::__instance();
    $id = $db->insert(self::getTableName(), $gift_data);

    return $id;
  }

  public static function updateGift($gift_id, $gift_data){
    if (!$gift_data || !is_array($gift_data)) {
      return false;
    }
    $db = self::__instance();

    $condition['id'] = $gift_id;
		$id = $db->update(self::getTableName(), $gift_data, $condition);
		return $id;
  }

  public static function deleteGift($gift_id){
    if (!$gift_id) {
      return false;
    }
    $db = self::__instance();
    $condition = array('id' => $gift_id);
    $result = $db->delete(self::getTableName(), $condition);

    return $result;
  }
}
