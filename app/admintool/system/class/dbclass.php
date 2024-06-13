<?php
class dbclass {	
	var $CONN;			 
	function __construct($server = DB_SERVER, $username = DB_USERNAME, $password = DB_PASSWORD, $database = DB_DATABASE) {
//		echo 'dd'; exit; 
		$conn = mysqli_connect($server,$username,$password,$database);	
		if(!$conn) {	
			$this->error("Connection attempt failed");		
		}
		/*if(!mysqli_select_db($conn,$database)) {	
			$this->error("Database Selection failed");		
		}*/
		$this->CONN = $conn;
		return true;
	}
	
	function close(){
		$conn = $this->CONN ;
		$close = mysqli_close($conn);
		if(!$close){
			$this->error("Close Connection Failed");	
		}
		return true;
	}
	
	function error($text) {
		$no = mysqli_errno();
		$msg = mysqli_error();
		echo "<hr><font face=verdana size=2>";
		echo "<b>Custom Message :</b> $text<br><br>";
		echo "<b>Error Number :</b> $no<br><br>";
		echo "<b>Error Message	:</b> $msg<br><br>";
		echo "<hr></font>";
		exit;
	}
	
	function select($sql="") {
		if(empty($sql)) { return false; }
		/*if(!eregi("^select",$sql)) {	
			echo "Wrong Query<hr>$sql<p>";
			return false;		
		}*/
		if(empty($this->CONN)) { return false; }
		$conn = $this->CONN;
		$results = @mysqli_query($conn,$sql);			
		if((!$results) or empty($results)) { return false; }
		$count = 0;
		$data  = array();
		while ( $row = mysqli_fetch_array($results))	{	
			$data[$count] = $row;
			$count++;		
		}
		mysqli_free_result($results);
		return $data;
	}	
	
	function insert($sql=""){
		if(empty($sql)) { return false; }
		//if(!eregi("^insert",$sql)){	return false; }
		if(empty($this->CONN)){	return false; }
		$conn = $this->CONN;			
	    $results = mysqli_query($conn,$sql);	
		 
		 	
		if(!$results) {	
			$id = 0; 
		} else {
		
			$id = mysqli_insert_id($conn);
			
		} 
		return $id;
	}
	
	function update($sql="") {
		if(empty($sql)) { return false; }
		//if(!eregi("^update",$sql)) { return false; }
		if(empty($this->CONN)) { return false; }
		$conn = $this->CONN;
		$results = @mysqli_query($conn,$sql);			
		if(!$results) {	
			$id = 0; 
		} else {
			$id = mysqli_insert_id($conn);
		}
		return $id;
	}
	
	function db_delete($result) {
        return mysqli_query($result);
	}

	function sql_query($sql="")	{	
		if(empty($sql)) { return false; }
		if(empty($this->CONN)) { return false; }
		$conn = $this->CONN;
		$results = mysqli_query($conn,$sql) or $this->error("Something wrong in query<hr>$sql<hr>");
		if(!$results){
		   $this->error("Query went bad ! <hr>$sql<hr>");
			return false;		
		}		
		/*if(!eregi("^select",$sql)) {
			return true; 		
		} else {*/
			$count = 0;
			$data = array();
			while ($row = mysqli_fetch_array($results)) {
				$data[$count] = $row;
				$count++;
			}
			mysqli_free_result($results);
			return $data;
		 //}
	}

	function simple_query($sql)
	{
		if(empty($sql)) { return false; }
		if(empty($this->CONN)) { return false; }
		$conn = $this->CONN;
		$results = mysqli_query($conn,$sql) or $this->error("Something wrong in query<hr>$sql<hr>");
		if(!$results){
			$this->error("Query went bad ! <hr>$sql<hr>");
			return false;
		}
		// Fetch all
		return mysqli_fetch_all($results, MYSQLI_ASSOC);

 	}

    function affected($sql="")	{
		if(empty($sql)) { return false; }
	/*	if(!eregi("^select",$sql)){
		  	echo "Wrong Query<hr>$sql<p>";
			return false;
		}*/
		if(empty($this->CONN)) 	{ 	return false; 	}
		$conn = $this->CONN;
		$results = @mysqli_query($conn,$sql);
		if( (!$results) or (empty($results)) ) {	return false;	}
		$tot=0;
		$tot=mysqli_affected_rows();
		return $tot;
	}

	function table_exists($tablename) {
		$conn = $this->CONN ;
		if(empty($conn)) { return false; }
		$results = mysqli_list_tables(DB_DATABASE) or die("Could not access Table List...<hr>" . mysqli_error());
		if(!$results){ 
			$message = "Query went bad!";	
			die($message);
			return false;
		} else {
			$count = 0;
			$data = array();
			while ( $row = mysqli_fetch_array($results)) {
				if ($row[0]==$tablename) {
					return true;
					exit;
				}
			}
			mysqli_free_result($results);
			return false;
		}
	}
		
	function db_fetch_row($result) {
        return mysqli_fetch_row($result);
	}
	
	function db_free_result($result) {
        @mysqli_free_result($result);
	}
	
	function db_num_rows($result) {
       return mysqli_num_rows($result);
	}
	
	function db_num_fields($result) {
       return mysqli_num_fields($result);
	}
	
	function db_field_name($result,$n) {
       return mysqli_field_name($result,$n);
	}
	
	function db_field_type($result,$n) {
       return mysqli_field_type($result,$n);
	}
}
?>
