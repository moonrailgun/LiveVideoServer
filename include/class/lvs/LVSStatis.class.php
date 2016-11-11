<?php
class LVSStatis extends LVSBase{
	private static $table_name = "statis";

	public static function getTabelName(){
		return parent::$table_prefix.self::$table_name;
	}

	private static $columns = array('actorID','actorName','playerID','playerName','toolName','toolTypeName','totalCost','totalAmount','createdDate');
}
?>