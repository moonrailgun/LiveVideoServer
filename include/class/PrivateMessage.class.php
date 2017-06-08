<?php
if(!defined('ACCESS')) {exit('Access denied.');}
class PrivateMessage extends Base {
  // 表名
	private static $table_name = 'message';
	// 查询字段
	private static $columns = array('id', 'message_type', 'message_content', 'message_sender', 'message_to', 'createdAt');

  public static function getTableName() {
		return parent::$table_prefix.self::$table_name;
	}

	public static function getMessageType() {
		return array(
			'system' => '系统消息',
			'user' => '用户消息'
		);
	}

  public static function getUserMessage($condition = null) {
		$db=self::__instance();

    $user_name = UserSession::getUserName();
    if(!$condition) {
      $condition['OR'] = array(
        'AND' => array(
          'message_type' => 'user',
          'message_to' => $user_name
        ),
        'message_type' => 'system'
      );
    }
		$condition['ORDER'] = 'createdAt DESC';

    $list = $db->select(self::getTableName(), self::$columns, $condition);
		if ($list) {
			return $list;
		}
		return array ();
	}

	public static function createMessage($data) {
		if(!$data || !is_array($data)){
			return false;
		}

		if(!isset($data['createdAt'])) {
			$dt = new DateTime();
			$data['createdAt'] = $dt->format('Y-m-d H:i:s');
		}

		if(!isset($data['message_sender'])) {
			$data['message_sender'] = UserSession::getUserName();
		}

		$db = self::__instance();
    $id = $db->insert(self::getTableName(), $data);

    return $id;
	}
}
