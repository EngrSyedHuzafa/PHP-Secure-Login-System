<?php require_once 'configDB.php'?>
    <?php
    error_reporting(0);
    // Important Files (Please check your file path according to your folder structure)
    require '/xampp/htdocs/PHPMailer/src/PHPMailer.php';
    require '/xampp/htdocs/PHPMailer/src/SMTP.php';
    require '/xampp/htdocs/PHPMailer/src/Exception.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    session_start();
    $empty_error=null;
    $name_error=null;
    $email_error=null;
    $password_error=null;
    $_SESSION['otp'] = "";
    if(isset($_POST['submit'])){
        $name=$_POST['user_name'];
        $_SESSION['name']=$name;
        $email=$_POST['email'];
        $_SESSION['email']=$email;
        $password=$_POST['password'];
        $con_password=$_POST['con_password'];
        $number = preg_match('@[0-9]@', $password);
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);
        $name_length=strlen($name);
        if($name=="" ||$email=="" ||$password=="" ||$con_password==""){
            $empty_error='Fill out all field';
        }else if($name_length<4){
            $name_error='User name must be 4 chracter long';
        }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_error = "Invalid email format";
        }else if(strlen($password) < 8) {
	        $password_error="Password must be at least 8 characters in length.";
        }else if($password!=$con_password){
            $password_error='Password does not match';
        }else{
            mysqli_select_db($conn,'registerusers');
            $sql_u = "SELECT * FROM users WHERE username='$name'";
            $sql_e = "SELECT * FROM users WHERE email='$email'";
            $res_u = mysqli_query($conn, $sql_u);
            $res_e = mysqli_query($conn, $sql_e);
    
            if (mysqli_num_rows($res_u) > 0) {
              $name_error = "Sorry... username already taken";      
            }else if(mysqli_num_rows($res_e) > 0){
              $email_error = "Sorry... email already taken";}
            else{
                $password=password_hash($password,PASSWORD_DEFAULT); 
                $query = "INSERT INTO users (username, email, password) VALUES ('$name', '$email', '$password')";
                $results = mysqli_query($conn, $query);
                if(!$results){
                    echo '<script>alert("Soory for inconvience please try again later")</script>'; 
                }else{
                    $verification_otp = random_int(100000, 999999);
                    $otp=$verification_otp;
                    $_SESSION['otp']=$otp;
                    function sendMail($send_to, $otp, $name) {
                        $mail = new PHPMailer(true);
                        $mail->isSMTP();
                        $mail->SMTPAuth = true;
                        $mail->SMTPSecure = "tls";
                        $mail->Host = 'smtp.gmail.com';
                        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port = 587;
                    
                        // Enter your email ID
                        $mail->Username = 'From: no-reply@yourcompany.com';
                        $mail->Password = 'check on youtube';
                    
                        // Your email ID and Email Title
                        $mail->setFrom('From: no-reply@yourcompany.com', "No reply");
                    
                        $mail->addAddress($send_to);
                    
                        // You can change the subject according to your requirement!
                        $mail->Subject = "Account Activation";
                    
                        // You can change the Body Message according to your requirement!
                        $mail->Body = "Hello, {$name}\nYour account registration is successfully done! Now activate your account with OTP {$otp}.";
                        $mail->send();
                    }                 
                    $send=sendMail($email, $verification_otp, $name);
                    if($send){
                        echo"Email is not send please try again latter";
                    }else{
                        header("location:otpverify.php");
                    }
                    // $_SESSION['user_name'] = $name;
                    // header("location:otpverify.php");
                }
            }       
        }
    }
    ?>