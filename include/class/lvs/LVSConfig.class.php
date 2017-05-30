<?php
class LVSConfig extends LVSBase{
  private static $table_name = "config";
  private static $columns = array('key_name', 'key_value');

	public static function getTableName(){
		return parent::$table_prefix.self::$table_name;
	}

  public static function getConfig($name) {
    if (!$name) {
      return false;
    }

    $db = self::__instance();

    $condition['AND']['key_name'] = $name;
		$list = $db->select(self::getTableName(), self::$columns, $condition);
		if($list) {
			return $list[0]['key_value'];
		}
		return array();
  }

  public static function updateConfig($name, $value) {
    if (!$name || !$value) {
      return false;
    }
    $db = self::__instance();
    $data = array(
      'key_value' => $value
    );

    $condition['key_name'] = $name;
		$id = $db->update(self::getTableName(), $data, $condition);
		return $id;
  }
}
