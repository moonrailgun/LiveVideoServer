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

	public static function getWebsiteIPByID($website_ip_id) {
		if(!$website_ip_id){
			return false;
		}
		$db = self::__instance();
		$condition["AND"] = array("id" => $website_ip_id);
    $list = $db->select(self::getTableName(), self::$columns, $condition);

    if ($list) {
      return $list[0];
    }
    return array();
	}

	// 返回数据表行
	public static function getWebsiteIPListByWebsiteID($website_id) {
		$db = self::__instance();
		$condition["AND"] = array("website_id" => $website_id);
    $list = $db->select(self::getTableName(), self::$columns, $condition);

    if ($list) {
      return $list;
    }
    return array();
	}

	// 返回ip数组
  public static function getIPsByWebsiteID($website_id) {
    $list = self::getWebsiteIPListByWebsiteID($website_id);

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

	public static function updateWebsiteIP($website_ip_id, $website_ip_data) {
		if (!$website_ip_data || !is_array($website_ip_data)) {
			return false;
		}
		$db = self::__instance();
		$condition = array('id' => $website_ip_id);
		$id = $db->update(self::getTableName(), $website_ip_data, $condition);

		return $id;
	}

	public static function deleteWebsiteIP($website_ip_id) {
		if (!$website_ip_id) {
			return false;
		}
		$db = self::__instance();
		$condition = array('id' => $website_ip_id);
		$result = $db->delete(self::getTableName(), $condition);

		return $result;
	}
}
