<?php
class LVSItem extends LVSBase{
	private static $table_name = "item_log";

	private static $columns = array('actorID','actorName','playerID','playerName','toolName','toolTypeName','totalCost','totalAmount','createdDate');

	public static function getTableName() {
		return parent::$table_prefix.self::$table_name;
	}

	public static function addItem($item_data) {
		if (!$item_data || !is_array($item_data)) {
			return false;
		}

		if($item_data['createdDate'] == ""){
			date_default_timezone_set('shanghai');
			$item_data['createdDate'] = date("Y-m-d H:i:s");
		}

		$db=self::__instance();
		$id = $db->insert(self::getTableName(), $item_data);
		return $id;
	}

	public static function getAllItemLog() {
		$db = self::__instance();
		$list = $db->select( self::getTableName(),"*");

		if ($list) {
			return $list;
		}
		return array ();
	}

	public static function getItemLog($start_date, $end_date){
		$db = self::__instance();
		$condition['AND']=array(
			"createdDate[<>]" => array($start_date, $end_date)
		);

		$list = $db->select(self::getTableName(),self::$columns,$condition);
		if($list){
			return $list;
		}
		return array ();
	}
}
?>
