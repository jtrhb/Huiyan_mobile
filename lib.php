<?php
//to test the connectibility of mysql database
/*
$connect=mysql_connect("localhost","jtrhb","19880911") or die("Unable to Connect");
        mysql_select_db("MedFlowSheet") or die("Could not open the db");
        $showtablequery="SHOW TABLES FROM MedFlowSheet";
        $query_result=mysql_query($showtablequery);
        while($showtablerow = mysql_fetch_array($query_result))
        {
        echo $showtablerow[0]." ";
        } 
*/
//setup db connection
$link = mysqli_connect("localhost","root","root");
mysqli_select_db($link, "dedecmsv57gbk");

//executes a given sql query with the params and returns an array as result
function query() {
	global $link;
	$debug = false;
	
	//get the sql query
	$args = func_get_args();
	$sql = array_shift($args);

	//secure the input
	for ($i=0;$i<count($args);$i++) {
		$args[$i] = urldecode($args[$i]);
		$args[$i] = mysqli_real_escape_string($link, $args[$i]);
	}
	
	//build the final query
	$sql = vsprintf($sql, $args);
	
	if ($debug) print $sql;
	
	//execute and fetch the results
	$result = mysqli_query($link, $sql);
	if (mysqli_errno($link)==0 && $result) {
		
		$rows = array();

		if ($result!==true)
		while ($d = mysqli_fetch_assoc($result)) {
			array_push($rows,$d);
		}
		else {
			array_push($rows,"TRUE");
		}
		
		//return json
		return array('result'=>$rows);
		
	} else {
	
		//error
		return array('error'=>'Database error');
	}
}


?>