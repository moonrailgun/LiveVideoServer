<?php
class LVSItemGroup extends LVSBase{
  private static $table_name = 'item_group';
  private static $columns = array('id', 'group_name');

  public static function getTableName(){
    return parent::$table_prefix.self::$table_name;
  }

  public static function getAllList() {
    $db = self::__instance();

		$list = $db->select(self::getTableName(),self::$columns);
		if($list){
			return $list;
		}
		return array();
  }

  //生成key为道具组别id value为道具组别名的所有工会数组
  public static function getGroupIdList(){
    $result = array();
    $group_list = self::getAllList();
    foreach ($group_list as $key => $value) {
      $group_id = $value['id'];
      $group_name = $value['group_name'];
      $result[$group_id] = $group_name;
    }
    return $result;
  }

  public static function getGroupByID($group_id) {
    if (!$group_id) {
      return false;
    }

    $db = self::__instance();
    $condition = array(
      "AND" => array("id[=]" => $group_id)
    );
		$list = $db->select(self::getTableName(),self::$columns,$condition);
		if($list) {
			return $list[0];
		}
		return array();
  }

  public static function getGroupByName($group_name) {
    if (!$group_name) {
      return false;
    }

    $db = self::__instance();

    $condition = array(
      "AND" => array("group_name[=]" => $group_name)
    );
		$list = $db->select(self::getTableName(),self::$columns,$condition);
		if($list) {
			return $list[0];
		}
		return array();
  }

  public static function addGroup($group_data) {
    if (!$group_data || !is_array($group_data)) {
      return false;
    }
    $db = self::__instance();
    $id = $db->insert(self::getTableName(), $group_data);

    return $id;
  }
  public static function updateGroup($group_id, $group_data) {
    if (!$group_data || !is_array($group_data)) {
      return false;
    }
    $db = self::__instance();
    $condition = array('id' => $group_id);
    $id = $db->update(self::getTableName(), $group_data, $condition);

    return $id;
  }

  public static function deleteGroup($group_id) {
    if (!$group_id) {
        return false;
    }
    $db = self::__instance();
    $condition = array('id' => $group_id);
    $result = $db->delete(self::getTableName(), $condition);

    return $result;
  }
}
