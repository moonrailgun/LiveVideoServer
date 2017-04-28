<?php
class LVSCommon extends LVSBase{
	public static $gift2senderInfo = "lvs_gift2senderInfo_rule";
	public static $tool2directive = "lvs_tool2directive_rule";

	public static function query($query){
		$db = self::__instance();
		$query = $db->query($query);
		if($query){
			$list = $query->fetchAll();
			if($list){
				return $list;
			}
		}

		return array();
	}

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

  public static function update($table_name, $data, $condition){
    if (!$data || !is_array($data) || !$condition || !is_array($condition)) {
      return false;
    }
    $db = self::__instance();
		$id = $db->update($table_name, $data, $condition);
		return $id;
  }

  public static function delete($table_name, $condition){
    if (!$table_name || !$condition) {
      return false;
    }
    $db = self::__instance();
    $result = $db->delete($table_name, $condition);
    return $result;
  }
}
