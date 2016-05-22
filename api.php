<?php
function errorJson($msg){
	print json_encode(array('error'=>$msg));
	exit();
}

function select($patient) {
	//echo "select patient started";
	$result = query("SELECT patient_name, drugname, start_date, discontinue_date, end_date, instructions FROM medication WHERE patient_name='%s' ORDER BY discontinue_date IS NULL DESC,end_date IS NULL DESC, start_date ASC", $patient);
	
	if(count($result['result'])>0){
		$result = (object)$result;
		print json_encode($result);
	} else {
		errorJson('No Such Patient');
	}
}

function select_patients() {
	$result = query("SELECT PHN, Name, Shift, Sex, Hpr, ActiveIssues, KnownIssues, FYI, ISO FROM demographic ORDER BY Name");
	//$result = (object)$result;
	print json_encode($result);
}

function select_specific_patient($phn) {
	$result = query("SELECT PHN, Name, Sex, Comment FROM demographic WHERE PHN='%s'",$phn);
	print json_encode($result);
}

function update_specific_patient($phn,$name,$sex,$comment) {
	$result = query("UPDATE demographic SET Name='%s', Sex='%s', Comment='%s' WHERE PHN='%s'",$name,$sex,$comment,$phn);
	print json_encode($result);
}

function select_event($phn) {
	$result = query("SELECT PHN, eventIdentifier FROM patient_events WHERE PHN='%s",$phn);
	print json_encode($result);
}

function insert_a_patient($phn,$name,$sex,$comment) {
	$result = query("INSERT INTO demographic (PHN,Name,Sex,Comment) VALUES ('%s','%s','%s','%s')",$phn,$name,$sex,$comment);
	print json_encode($result);
}

function insert_event($phn,$eid) {
	$result = query("INSERT INTO patient_events (PHN,eventIdentifier) VALUES ('%s','%s')",$phn,$eid);
	print json_encode($result);
}

function logout() {
	$_SESSION = array();
	session_destroy();
}

function select_news() {
	$result = query("SELECT id, title, litpic FROM dede_archives LIMIT 0,15");
	print json_encode($result);
}

?>