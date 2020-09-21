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
	$mail->Username = 'rachit@gmail.com';    //enter your email adddress             
	$mail->Password = 'xxxxxx'; // enter your email password                           
	$mail->SMTPSecure = 'tls';                            
	$mail->Port = 587;                                   
	
	$mail->setFrom('rachit@gmail.com', 'Mailer'); //enter your email here.
	$mail->addAddress($to, 'Recepient');     //email id of receiver comes here.
	
	$mail->addReplyTo('rachit@gmail.com', 'Information'); //enter your email here

	
	
	
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
