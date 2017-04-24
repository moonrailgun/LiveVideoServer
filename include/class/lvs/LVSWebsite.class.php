<?php

class LVSWebsite extends LVSBase
{
    private static $table_name = 'website';
    private static $columns = array('website_id', 'website_name', 'website_short_name', 'remark');

    public static function getTableName()
    {
        return parent::$table_prefix.self::$table_name;
    }

    public static function getWebsiteList()
    {
        $db = self::__instance();
        $list = $db->select(self::getTableName(), self::$columns);

        if ($list) {
            return $list;
        }

        return array();
    }

    //生成key为网站id value为网站的所有网站数组
    public static function getWebsiteIdList(){
      $result = array();
      $website_list = self::getWebsiteList();
      foreach ($website_list as $key => $value) {
        $website_id = $value['website_id'];
        //$website_name = $value['website_name'];
        $website_name = $value['website_name']."(". $value['website_short_name'].")";
        $result[$website_id] = $website_name;
      }
      return $result;
    }

    public static function getWebsiteInfoById($website_id){
      if (!$website_id) {
  			return false;
  		}
  		$db=self::__instance();
  		$condition = array("AND" =>
  						array("website_id[=]" => $website_id,
  						)
  					);
  		$list = $db->select ( self::getTableName(), self::$columns, $condition );

  		if ($list) {
  			return $list[0];
  		}
  		return array ();
    }

    public static function getWebsiteByName($website_name){
      if (!$website_name) {
  			return false;
  		}
  		$db=self::__instance();
  		$condition = array("AND" =>
  						array("website_name[=]" => $website_name,
  						)
  					);
  		$list = $db->select ( self::getTableName(), self::$columns, $condition );

  		if ($list) {
  			return $list[0];
  		}
  		return array ();
    }

    public static function getWebsiteByShortName($website_short_name){
      if (!$website_short_name) {
  			return false;
  		}
  		$db=self::__instance();
  		$condition = array("AND" =>
  						array("website_short_name[=]" => $website_short_name,
  						)
  					);
  		$list = $db->select ( self::getTableName(), self::$columns, $condition );

  		if ($list) {
  			return $list[0];
  		}
  		return array ();
    }

    public static function addWebsite($website_data)
    {
        if (!$website_data || !is_array($website_data)) {
            return false;
        }
        $db = self::__instance();
        $id = $db->insert(self::getTableName(), $website_data);

        return $id;
    }

    public static function updateWebsite($website_id, $website_data)
    {
        if (!$website_data || !is_array($website_data)) {
            return false;
        }

        $db = self::__instance();
        $condition = array('website_id' => $website_id);

        $id = $db->update(self::getTableName(), $website_data, $condition);

        return $id;
    }

    public static function delWebsite($website_id)
    {
        if (!$website_id) {
            return false;
        }
        $db = self::__instance();
        $condition = array('website_id' => $website_id);
        $result = $db->delete(self::getTableName(), $condition);

        return $result;
    }
}
