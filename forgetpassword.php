<?php require_once 'configDB.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/forgetpass.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <?php
    session_start();
        error_reporting(0);
        // Important Files (Please check your file path according to your folder structure)
        require '/xampp/htdocs/PHPMailer/src/PHPMailer.php';
        require '/xampp/htdocs/PHPMailer/src/SMTP.php';
        require '/xampp/htdocs/PHPMailer/src/Exception.php';
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        if(isset($_POST['submit'])){          
            $email=$_POST['email']; 
            $_SESSION['email']=$email; 
            if($email==""){
                $email_err="Enter Email";
            }else{
                mysqli_select_db($conn,'registerusers');
                $sql_e = "SELECT * FROM users WHERE email='$email'";
                $res_u = mysqli_query($conn, $sql_e);
                
                if (mysqli_num_rows($res_u) > 0) {
                    echo "hello";
                    $verification_otp = random_int(100000, 999999);
                    $otp=$verification_otp;
                    $_SESSION['otp']=$otp;
                    function sendMail($send_to, $otp ) {
                        $mail = new PHPMailer(true);
                        $mail->isSMTP();
                        $mail->SMTPAuth = true;
                        $mail->SMTPSecure = "tls";
                        $mail->Host = 'smtp.gmail.com';
                        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port = 587;
                    
                        // Enter your email ID
                        $mail->Username = 'From: no-reply@yourcompany.com';
                        $mail->Password = 'generate password(see on youtube)';
                    
                        // Your email ID and Email Title
                        $mail->setFrom('From: no-reply@yourcompany.com', "NO reply");
                    
                        $mail->addAddress($send_to);
                    
                        // You can change the subject according to your requirement!
                        $mail->Subject = "Account Activation";
                    
                        // You can change the Body Message according to your requirement!
                        $mail->Body = "\n Please use this code to proceed with updating your password {$otp}.";
                        $mail->send();
                    }                 
                    $send=sendMail($email, $verification_otp);
                   header("location:forgototp.php");
                }else{
                    $email_error="Email does not exist";
                }

            }


        }
    ?>
    <div class="div">
        <div class="div2">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="form">
                <p class="err"><?php echo $email_err;?></p>
                <p class="err"><?php echo $email_error;?></p>
                <p>Enter your email</p>
                <div class="envelop">
                    <input type="email" name="email" class="mail" placeholder="Enetr Email"><br>
                    <i class="fa-solid fa-envelope lock_icon"></i>
                </div>
                <button name="submit">
                    <span>Submit</span>
                    <svg viewBox="-5 -5 110 110" preserveAspectRatio="none" aria-hidden="true">
                        <path d="M0,0 C0,0 100,0 100,0 C100,0 100,100 100,100 C100,100 0,100 0,100 C0,100 0,0 0,0"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>


</body>
</html>