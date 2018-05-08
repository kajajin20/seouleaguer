<?php

class FacebookModel
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
		$sql = "set session character_set_connection=utf8 ";
		$query = $this->db->prepare($sql);
		$query->execute();
		$sql = "set session character_set_results=utf8 ";
		$query = $this->db->prepare($sql);
		$query->execute();
		$sql = "set session character_set_client=utf8 ";
		$query = $this->db->prepare($sql);
		$query->execute();
		$sql = "select * from user_table where id = '".$id."' and password = '".$password."' ";
		
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetch();

	}
	public function timeline_insert($name, $memo, $filename)
	{
		$sql = "set session character_set_connection=utf8 ";
		$query = $this->db->prepare($sql);
		$query->execute();
		$sql = "set session character_set_results=utf8 ";
		$query = $this->db->prepare($sql);
		$query->execute();
		$sql = "set session character_set_client=utf8 ";
		$query = $this->db->prepare($sql);
		$query->execute();
		$sql = "insert into user_timeline (name,memo,image,imagepath,regdate) values('".$name."','".$memo."','".$filename."','/public/img/',NOW() ) ";
		$query = $this->db->prepare($sql);
		$query->execute();

	}
	public function login_check($id)
	{	
		$sql = "select * from user_table where id = '".$id."' ";
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetchAll();
	}

	 
	public function insertMember($id, $name, $password, $sex)
	{
		$sql = "set session character_set_connection=utf8 ";
		$query = $this->db->prepare($sql);
		$query->execute();
		$sql = "set session character_set_results=utf8 ";
		$query = $this->db->prepare($sql);
		$query->execute();
		$sql = "set session character_set_client=utf8 ";
		$query = $this->db->prepare($sql);
		$query->execute();
		$sql = "insert into user_table (id,name,password,sex) values('".$id."','".$name."','".$password."','".$sex."') ";
		$query = $this->db->prepare($sql);
		$query->execute();

	}

}
