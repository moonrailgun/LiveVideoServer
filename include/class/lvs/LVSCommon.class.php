<?php
class LVSCommon extends LVSBase{
	public static $gift2senderInfo = "lvs_gift2senderInfo_rule";

  public static function getList($table_name, $condition = null){
    $db = self::__instance();

		$list = $db->select($table_name, '*', $condition);
		if($list){
			return $list;
		}
		return array ();
  }

  public static function insert($table_name, $data) {
    if (!$data || !is_array($data)) {
      return false;
    }
    $db = self::__instance();
    $id = $db->insert($table_name, $data);
    
    return $id;
  }
  //
  // public static function updateGift($gift_id, $gift_data){
  //   if (!$gift_data || !is_array($gift_data)) {
  //     return false;
  //   }
  //   $db = self::__instance();
  //
  //   $condition['id'] = $gift_id;
	// 	$id = $db->update(self::getTableName(), $gift_data, $condition);
	// 	return $id;
  // }
  //
  // public static function deleteGift($gift_id){
  //   if (!$gift_id) {
  //     return false;
  //   }
  //   $db = self::__instance();
  //   $condition = array('id' => $gift_id);
  //   $result = $db->delete(self::getTableName(), $condition);
  //
  //   return $result;
  // }
}
