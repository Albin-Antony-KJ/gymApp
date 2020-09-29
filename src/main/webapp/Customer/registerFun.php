<?php
	session_start();
	ini_set('max_execution_time', 1000);
	include "../../config.php";
	include "../../classes/common.php";
	if(Common::ModelControllerFileExist('Fitness'))
	{
		$obj = new FitnessController();
	}

	$name		= $_POST['name'];
	$gender		= $_POST['gender'];
	$phone		= $_POST['phone'];
	$email		= $_POST['email'];
	$address	= $_POST['address'];
	$height		= $_POST['height'];
	$weight 	= $_POST['weight'];
	$prevInj	= $_POST['prevInjury'];
	$medHis 	= $_POST['medHistory'];
	
	$duration			= $_POST['duration'];
	$sessionNo			= $_POST['days'];
	$sessionDetails		= $_POST['sessionDetails'];
	

	$custid=$obj->addCustomerPersonal($name,$gender,$phone,$email,$address,$height,$weight,$prevInj,$medHis,$duration,$sessionNo);

	$daysArray	= array();
	$daySessionArray	= array();
	foreach($sessionDetails as $item) {
	    $day			= explode ("~", $item)[0];
	    $session		= explode ("~", $item)[1];
	    $start_time		= explode ("~", $item)[2];
	    $fields='cust_id,day,session,session_timing';
		$values=array($custid,$day,$session,$start_time);
	    $result=$obj->addCustomerSession($values, $fields);
	    $daysArray[]	= $day;
	    $daySessionArray[$day]	= $start_time; 
	}


	$effectiveDate	= date('Y-m-d');
	$lastDate		= date('Y-m-d', strtotime("+".$duration." months", strtotime($effectiveDate)));

	do {
		//Convert the date string into a unix timestamp.
		$unixTimestamp = strtotime($effectiveDate);
		//Get the day of the week using PHP's date function.
		$dayOfWeek = date("l", $unixTimestamp);

		if (in_array($dayOfWeek, $daysArray)) {
			
			$sql	= "INSERT INTO tbl_schedule_details (sch_date, cust_id, session_timing) VALUES ('".$effectiveDate."',".$custid.",".$daySessionArray[$day].")";
			$obj->commonExecuteQuery($sql);
		}
		$effectiveDate = date('Y-m-d', strtotime($effectiveDate. ' + 1 days'));
	} while ($effectiveDate <= $lastDate);

	header('location:'.VIEW_PATH.'Customer/customerList.php?save=success');