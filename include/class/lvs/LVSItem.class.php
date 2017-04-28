<?php
class LVSItem extends LVSBase{
	private static $table_name = "item";
	private static $columns = array('id','tool_type_id','tool_name','tool_direct','queue_flag');

	public static function getTableName(){
		return parent::$table_prefix.self::$table_name;
	}

	public static function getQueueFlagList() {
		return array(
			0 => '正常',
			1 => '队列头-等待',
			2 => '队列头-并行',
		);
	}

  public static function getAllItem(){
    $db = self::__instance();

		$list = $db->select(self::getTableName(),self::$columns);
		if($list){
			return $list;
		}
		return array ();
  }

	public static function getItemIdList(){
		$result = array();
		$item_list = self::getAllItem();
		foreach ($item_list as $key => $value) {
			$item_id = $value['id'];
			$item_name = $value['tool_name'];
			$result[$item_id] = $item_name;
		}
		return $result;
	}

  // public static function getItemIdList(){
  //   $list = self::getAllItem();
  //   $res = array();
  //   foreach ($list as $key => $value) {
  //     $item_id = $value['item_id'];
  //     $item_name = $value['item_name'];
  //     $res[$item_id] = $item_name;
  //   }
  //   return $res;
  // }

	// public static function getItemInfoList(){
  //   $list = self::getAllItem();
  //   $res = array();
  //   foreach ($list as $key => $value) {
  //     $item_id = $value['item_id'];
  //     // $item_name = $value['item_name'];
  //     $res[$item_id] = $value;
  //   }
  //   return $res;
  // }

	public static function getItemByGroupID($group_id){
		$db = self::__instance();
    $condition['AND']['tool_type_id'] = $group_id;

		$list = $db->select(self::getTableName(),self::$columns,$condition);
		if($list){
			return $list;
		}
		return array ();
	}

  public static function getItemInfoById($id) {
    $db = self::__instance();
    $condition['AND']['id'] = $id;

		$list = $db->select(self::getTableName(),self::$columns,$condition);
		if($list){
			return $list[0];
		}
		return array ();
  }

  public static function getItemByName($item_name){
    $db = self::__instance();
    $condition['AND']['tool_name'] = $item_name;

		$list = $db->select(self::getTableName(),self::$columns,$condition);
		if($list){
			return $list[0];
		}
		return array ();
  }

  public static function addItem($item_data){
    if (!$item_data || !is_array($item_data)) {
      return false;
    }
    $db = self::__instance();
    $id = $db->insert(self::getTableName(), $item_data);

    return $id;
  }

  public static function updateItem($item_id, $item_data)
  {
      if (!$item_data || !is_array($item_data)) {
          return false;
      }

      $db = self::__instance();
      $condition = array('id' => $item_id);

      $id = $db->update(self::getTableName(), $item_data, $condition);

      return $id;
  }

  public static function delItem($item_id)
  {
      if (!$item_id) {
          return false;
      }
      $db = self::__instance();
      $condition = array('id' => $item_id);
      $result = $db->delete(self::getTableName(), $condition);

      return $result;
  }
}
?>
