<?php

class LVSTrade extends LVSBase
{
    private static $table_name = 'trade_log';
    private static $columns = array('trade_id', 'trade_out_no', 'trade_subject', 'trade_total_fee', 'trade_body', 'trade_ispay', 'trade_data');

    public static function getTableName()
    {
        return parent::$table_prefix.self::$table_name;
    }

    public static function createNewTradeLog($trade_data)
    {
        $blank_trade_data = array();
        $blank_trade_data['trade_out_no'] = $trade_data['out_trade_no'];
        $blank_trade_data['trade_subject'] = $trade_data['subject'];
        $blank_trade_data['trade_total_fee'] = $trade_data['total_fee'];
        $blank_trade_data['trade_body'] = $trade_data['body'];
        $blank_trade_data['trade_ispay'] = 0;

        date_default_timezone_set('shanghai');
        $blank_trade_data['trade_data'] = date('Y-m-d H:i:s');

        return $blank_trade_data;
    }

    public static function addTradeLog($trade_data)
    {
        if (!$trade_data || !is_array($trade_data)) {
            return false;
        }

        $trade_data = self::createNewTradeLog($trade_data);

        $db = self::__instance();
        $id = $db->insert(self::getTableName(), $trade_data);
        return $id;
    }

    public static function setTradeCompleted($trade_id)
    {
        if (!$trade_id || !is_numeric($trade_id)) {
            return false;
        }
        $db = self::__instance();
        $condition = array('trade_id' => $trade_id);

        $id = $db->update(self::getTableName(), array('trade_ispay'=>1), $condition);
        return $id;
    }
}
