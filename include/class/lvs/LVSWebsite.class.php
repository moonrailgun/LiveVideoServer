<?php

class LVSWebsite extends LVSBase
{
    private static $table_name = 'website';
    private static $columns = array('website_id', 'website_name', 'website_short_name', 'website_desc');

    public static function getTableName()
    {
        return parent::$table_prefix.self::$table_name;
    }

    public static function getWebsiteList()
    {
        $db = self::__instance();
        $list = $db->select(self::getTableName(), $columns);

        if ($list) {
            return $list;
        }

        return array();
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
