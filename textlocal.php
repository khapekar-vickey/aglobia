<?php

$otp = rand(100000, 999999);
                $message = "Your One Time Password is " . $otp;
                $headers = "From: info@icarefurnishers.com" . "\r\n";

                //===============================Send Email
                //---------------Mail send to Admin
                //$admin_email = get_option('admin_email');
                $subject = "Mobile Number verify otp";
                $adbody = '<p>Hello,<br/><br/>'.$message.'<br/><br/>
                Regards,<br>icarefurnishers Team</p>';
                mail( 'dk6504@gmail.com',$subject,$adbody,$headers); 
                //========================================End
                
	// Authorisation details.
	$username = "info@icarefurnishers.com";
	$hash = "e8320ca87aef8c2475d2d940d88f4854c13962600f962e3104fc1cf443b23c10";
	$apiKey = urlencode('1Zilr7YwMkg-6IeKWxhi1ldsGmf8MAdPZvW4G4o0Lc');

	// Config variables. Consult http://api.textlocal.in/docs for more info.
	$test = 0;

	// Data for text message. This is the text message data.
	$sender = "ICRFUR"; // This is who the message appears to be from.
	$numbers = "919270876504"; // A single number or a comma-seperated list of numbers
	$message = "This is a test message from the PHP API script.";
	// 612 chars or less
	// A single number or a comma-seperated list of numbers
	$message = $message;
	$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
	$ch = curl_init('http://api.textlocal.in/send/');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch); // This is the result from the API
	
	curl_close($ch);
	print_r($result);
?>