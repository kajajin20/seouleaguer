<?php

class LoginModel
{
	function __construct($db) {
		try {
			$this->db = $db;
		} catch (PDOException $e) {
			exit('데이터베이스 연결에 오류가 발생했습니다.');
		}
	}
	public function getLoginId($id, $password)
	{
		$sql = "select * from user_table where id = '".$id."' and password = '".$password."' ";
		
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetch();

	}

}
