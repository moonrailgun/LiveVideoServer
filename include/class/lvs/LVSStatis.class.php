<?php
class LVSStatis extends LVSBase{
	private static $table_name = "item_log";

	public static function getTabelName(){
		return parent::$table_prefix.self::$table_name;
	}

	private static $columns = array('actorID','actorName','playerID','playerName','toolName','toolTypeName','totalCost','totalAmount','createdDate');

	public static function statisByActor($actorID,$sendStartTime,$sendEndTime){
		$db=self::__instance();
		$condition['AND']=array("actorID[=]"=>$actorID,"createdDate[<>]"=>[$sendStartTime,$sendEndTime]);
		$condition['ORDER']=" createdDate desc";
		
		$list = $db->select(self::getTabelName(),self::$columns,$condition);

		if($list){
			return $list;
		}

		return array ();
	}
}
?>