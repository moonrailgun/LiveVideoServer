<?php
class LVSWebsiteIP extends LVSBase{
	private static $table_name = "website_ip";
  private static $columns = array('id', 'website_id', 'website_ip', 'remark');

	public static function getTableName(){
		return parent::$table_prefix.self::$table_name;
	}

  public static function getWebsiteIPList() {
    $db = self::__instance();
    $list = $db->select(self::getTableName(), self::$columns);

    if ($list) {
      return $list;
    }
    return array();
  }

	public static function getWebsiteIPListByWebsiteID($website_id){
		$db = self::__instance();
		$condition["AND"] = array("website_id" => $website_id);
    $list = $db->select(self::getTableName(), self::$columns, $condition);

    if ($list) {
      return $list;
    }
    return array();
	}

  public static function getIPsByWebsiteID($website_id) {
    $list = self::getWebsiteIPListByWebsiteID();

    if ($list) {
      $result = array();
      foreach ($list as $key => $value) {
        array_push($result, $value["website_ip"]);
      }

      return $result;
    }
    return array();
  }

  public static function addWebsiteIP($website_ip_data) {
    if (!$website_ip_data || !is_array($website_ip_data)) {
      return false;
    }
    $db = self::__instance();
    $id = $db->insert(self::getTableName(), $website_ip_data);

    return $id;
  }
}
