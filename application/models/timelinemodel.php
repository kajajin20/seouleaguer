<?php

class TimelineModel
{
	function __construct($db) {
		try {
			$this->db = $db;
		} catch (PDOException $e) {
			exit('데이터베이스 연결에 오류가 발생했습니다.');
		}
	}

	public function timeline_select($start_cnt, $end_cnt)
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
		$sql = "select * from user_timeline limit ".$start_cnt.", ".$end_cnt."  ";
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetchAll();


	}
	public function getQuery(&$result, $query='') {
		if(empty($query)) return false;
		$query = str_replace(array('--',';'), array('',''), $query);
		$result = array();
		if($array = $this->_mysqli->query($query)) {
			while($row = $array->fetch_assoc()) {
				$result[] = $row;
			}
			$array->free();
		}
		return count($result);
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

}
