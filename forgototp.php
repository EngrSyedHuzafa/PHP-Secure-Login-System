<?php require_once 'configDB.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP</title>
    <link rel="stylesheet" href="style/otp.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <?php 
        session_start();
        $email=$_SESSION['email'];
    ?>
    <?php
    $otp_error="";
    $otp_err="";
        if(isset($_POST['submit'])){
            $otpcheck=$_POST['otp'];
            if($otpcheck==""){
                $otp_err="Enter OTP";
            }else{
                if($_SESSION['otp']==$otpcheck){
                    header("location:updatepass.php");
                  }else{
                    $otp_error="OTP is not correct";
                  }
            }
        }
    ?>
    <div class="div">
        <div class="div2">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="form">
                <p class="err"><?php echo $otp_err;?></p>
                <p class="err"><?php echo $otp_error;?></p>
                <p>You will receive an OTP at your email address <b><?php echo $_SESSION['email'];?></p>
                <div class="envelop">
                    <input type="text" name="otp" class="otp" placeholder="Enetr OTP"><br>
                    <i class="fa fa-key key" aria-hidden="true"></i>
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