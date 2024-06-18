<?php
	require_once("config.php") ;

	function connectdb(){
		global $dbserver, $dbuser, $dbpass, $dbname;
		if($conn = mysqli_connect($dbserver, $dbuser, $dbpass, $dbname))
			return $conn;
		die("Kết nối không thành công");
		return;
	}

	function getAll($table, $limit = 10, $start = 0){
		$sql = "select * from $table order by id desc limit $start,$limit";
		$conn = connectdb();
		$rs = mysqli_query($conn, $sql);
		if(mysqli_num_rows($rs)>0)
			return $rs->fetch_all(MYSQLI_ASSOC);
		return null;
	}

	function getById($table, $id){
		$sql = "select * from $table where id = $id";
		$conn = connectdb();
		$rs = mysqli_query($conn, $sql);
		if(mysqli_num_rows($rs)>0)
			return mysqli_fetch_array($rs);
		return null;
	}

	function insert($table, $data){
		$fields = implode(',',array_keys($data));
		$values = implode("','",$data);
		$values= "'".$values;
		$values.="'";		
		$sql = "insert into {$table}({$fields}) values({$values})";
		return mysqli_query(connectdb(),$sql);
	}
	function update($table, $data){
		$sql = "update $table set ";
		$id = $data["id"];
		foreach($data as $field => $value){
			$sql.=" $field = '$value',";
		}
		$sql[strlen($sql)-1] =" ";
		$sql.=" where id = $id";
		return mysqli_query(connectdb(),$sql);
	}

	function delete($table, $id){
		$sql = "delete from $table where id = $id";
		return mysqli_query(connectdb(),$sql);
	}

	function exe_query($sql){
		return mysqli_query(connectdb(),$sql)->fetch_all(MYSQLI_ASSOC);
	}

 ?>