<?php
session_start();
$con=mysqli_connect('localhost','root','','otps');

 $email=$_POST['email'];
$id=rand(1,1000);
 $sql = "insert into user (id,email,otp) values ('$id','$email','')";
 $res1=mysqli_query($con, $sql);
$res=mysqli_query($con,"select * from user where email='$email'");
$count=mysqli_num_rows($res);
if($count>0){
	 $otp=rand(11111,99999);
	mysqli_query($con,"update user set otp='$otp' where email='$email'");
	$html="Your otp verification code is ".$otp;
	
	$_SESSION['EMAIL']=$email;
	smtp_mailer($email,'OTP Verification',$html);
	echo "yes";
}else{
	echo "not_exist";
}

function smtp_mailer($to,$subject, $msg){


	require 'PHPMailer-5.2-stable/PHPMailerAutoload.php';
	
	$mail = new PHPMailer;
	
	$mail->isSMTP();                                    
	$mail->Host = 'smtp.gmail.com';  
	$mail->SMTPAuth = true;                               
	$mail->Username = 'nikhilgupta8822@gmail.com';                 
	$mail->Password = 'Randy500$';                           
	$mail->SMTPSecure = 'tls';                            
	$mail->Port = 587;                                   
	
	$mail->setFrom('nikhilgupta8822@gmail.com', 'Mailer');
	$mail->addAddress($to, 'Recepient');     
	
	$mail->addReplyTo('nikhilgupta8822@gmail.com', 'Information');

	
	
	
	$mail->isHTML(true);                                
	
	$mail->Subject = $subject;
	$mail->Body    = $msg;
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	
	if(!$mail->send()) {
		return 0;
	} else {
		return 1;
	}
}
?>