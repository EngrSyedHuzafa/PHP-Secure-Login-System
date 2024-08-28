<?php require_once 'configDB.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Password</title>
    <link rel="stylesheet" href="style/updatepass.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <?php
    $pass_err="";
        session_start();
        if(isset($_POST['submit'])){
            $email=$_SESSION['email'];
            $password=$_POST['password'];
            if($password==""){
                $pass_err="Enter Password";
            }else{
                $password=password_hash($password,PASSWORD_DEFAULT); 
                mysqli_select_db($conn,'registerusers');
                $sql="UPDATE users SET password='$password' where email='$email'";
                $res_u = mysqli_query($conn, $sql);
                if(!$res_u){
                    echo "error";
                } else{
                    header('location:login.php');
                }
            }
        }
    ?>

<div class="div">
        <div class="div2">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="form">
                <p class="err"><?php echo $pass_err;?></p>
                <p>Enter New Password</p>
                <div class="envelop">
                    <input type="password" name="password" class="password" placeholder="Enetr Password"><br>
                    <i class="fa-solid fa-lock lock" ></i>
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