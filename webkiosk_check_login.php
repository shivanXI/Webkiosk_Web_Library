<?php
require_once 'curl.php';

function webkiosk_check_login($inst,$enroll,$pass,$dob)
{
$curl = new Curl;
$url = "https://webkiosk.jiit.ac.in/CommonFiles/UserActionn.jsp";
$data = array(
'txtInst' => 'txtInst',
'InstCode'=>''.$inst,
'txtuType' => 'Member Type',
'UserType' => 'S',
'txtCode'=>'Enrollment No',  
'MemberCode' => ''.$enroll,
'DOB'=>'DOB',
'DATE1'=> ''.$dob,
'txtPin'=>'Password/Pin',
'Password'=> ''.$pass  
);	
$response = $curl->post($url, $data);
$result = $response->body;
$check = "PersonalFiles/ShowAlertMessageSTUD.jsp";
	if (strpos($result,$check) !== false) {
	    return 1;
	}
	elseif($check == NULL)
	{
		return 2; // webkiosk is down
	}	
	else
	{
		return 0; // everything else including invalid enroll and password
	}
	
} 

?>