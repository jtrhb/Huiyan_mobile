<?php
//echo "Hello World";
session_start();
require("lib.php");
require("api.php");
header("Content-Type: application/json");
select_news();
switch ($_POST['command']) {	
	case "select":
	    select($_POST['patient_name']);
		break;
		
	case "select all":
		select_patients();
		break;
		
	case "select specific patient":
		select_specific_patient($_POST['phn']);
		break;
		
	case "update specific patient":
		update_specific_patient($_POST['phn'],$_POST['name'],$_POST['sex'],$_POST['comment']);
		break;
		
	case "insert a patient":
	    insert_a_patient($_POST['phn'],$_POST['name'],$_POST['sex'],$_POST['comment']);
		break;
		
	case "insert event":
		insert_event($_POST['phn'],$_POST['eid']);
		break;
		
	case "fetch event":
		select_event($_POST['phn']);
		break;
		
	case "logout":
		logout();
		break;
}

exit();
?>