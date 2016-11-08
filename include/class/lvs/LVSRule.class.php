<?php
class LVSRule extends LVSBase{
	private static $table_name = 'rule';

	public static function getTabelName(){
		return parent::$table_prefix.self::$table_name;
	}

	public static function getGlobalTimeSpan(){
		return 2;
	}

	public static function getGlobalRule(){
		$rule['tool2DirectiveRule']=json_decode('[{"toolName":"头套","directiveName":"tt1 start"}]');

		$rule['controllerDirectiveRule']=json_decode('{"format":"","directiveName":"","description":""}');

		$rule['acquisitionRule']=json_decode('{"userid":"userid","username":"username","giftType":"giftType","giftAmount":"giftAmount","sendTime":"sendTime","actorID":"anchorID","actorName":"actorName"}');

		$rule['gift2senderInfoRule']=json_decode('[{"giftType":"鲜花","giftAmount":"510","mapToolName":"头套1"}]');

		$rule['costControlRule']=json_decode('[{"toolName":"头套1","toolCost":100}]');

		return $rule;
	}

	public static function getDeviceDirective(){
		$data = json_decode('{"deviceID":"sn1001","state":1,"stateDecription":"正常","toolDirective":[{"toolName":"头套1","state":1,"stateDecription":"正常"}]}');
		return $data;
	}
}
?>