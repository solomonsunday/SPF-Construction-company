<?php
//define variables and set to empty values.
$name_error = $email_error = $phone_error = $subject_error = "";
$email = $name = $phone = $subject = $message = $success = "";

//form is submitted with post method
if($_SERVER['REQUEST_METHOD'] == "POST"){
	if(empty($_POST["name"])) {
		$name_error = "Name is required";
		
	}else {
		$name = test_input($_POST["name"]);
		//check if name only contains letters and white spaces.
		if (!preg_match("/^[a-zA-Z ]*$/",$name)){
			$name_error = "Only letters and White space allowed";
		}
	}
	
    if(empty($_POST["email"])){
		$email_error = "Email is required";
		
	}else {
		$email = test_input($_POST["email"]);
		//check if email address is well-formed
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$email_error = "Invalid email Format";
		}
	}
	
	if(empty($_POST["phone"])){
		$phone_error = "Numbers are required";
		
	}else {
		$phone = test_input($_POST["phone"]);
		//check if name only contains letters and white spaces.
		if (!preg_match("/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i",$phone)){
			$phone_error = "Invalid phone number";
		}
	}
	
	if (empty($_POST["message"])) {
		$message = "";
		
	} else {
		$message = test_input($_POST["message"]);
	}

if (empty($_POST["subject"])) {
		$subject_error = "Subject Required";
		
	} else {
		$subject = test_input($_POST["subject"]);
	}
	
	if ($name_error == '' and $email_error == '' and $phone_error == '' ){
		$message_body = '';
		unset($_POST['submit']);
		foreach ($_POST as $key => $value){
			$message_body .= "$key: $value\n";
		}
		
		$to = 'info@spfconstruct.com,  schinoyerem007@gmail.com';
		$headers="From: ".$email."\n".$name;
		$subject= $subject;
    	$message="Phone No: ".$phone."\n"
		."wrote the following: "."\n".$message;
     	
		if (mail($to, $headers, $subject, $message)){
			$success = "Message sent, thank you for contacting us!";
			$name = $email = $phone = $subject = $message = '';
		}
	}
  }

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
	
}

?>