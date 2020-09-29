<?php
	session_start();
	ini_set('max_execution_time', 1000);
	include "../../config.php";
	include "../../classes/common.php";
	if(Common::ModelControllerFileExist('Fitness'))
	{
		$obj = new FitnessController();
	}

	$duration			= $_POST['duration'];
	$session			= $_POST['days'];
	$sessionDetails		= $_POST['sessionDetails'];
	

	foreach($sessionDetails as $item) {
	    $custid 		= 1;
	    $day			= explode ("~", $item)[0];
	    $session		= explode ("~", $item)[1];
	    $start_time		= explode ("~", $item)[2];
	    $fields='cust_id,day,session,start_time';
		$values=array($custid,$day,$session,$start_time);
	    //echo $fields;
	    //print_r($values);
	    echo $result=$obj->addCustomerSession($values, $fields);
	}