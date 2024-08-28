<?php require_once 'configDB.php'?>
<!-- <?php require_once 'register.php'?> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <?php
            $recaptua_error=null;
            $empty_error=null;
            $name_error=null;
            $password_error=null;
            $_SESSION['logged_in'] = "";

            
            if(isset($_POST['submit'])){
                $name=$_POST['user_name'];
                $password=$_POST['password'];
                if($name=="" ||$password==""){
                    $empty_error='Fill out all field';
                }else{
                    mysqli_select_db($conn,'registerusers');
                    $sql_u = "SELECT * FROM users WHERE username='$name'";
                    $res_u = mysqli_query($conn, $sql_u);
                    if (!(mysqli_num_rows($res_u) > 0)) {
                        $name_error = "Sorry... user does not exist";      
                    }else{
                        mysqli_select_db($conn,'registerusers');
                        $sql = "SELECT password FROM users WHERE username='$name'";
                        $result=mysqli_query($conn,$sql);             
                        $hash_password=$result->fetch_assoc()['password'];
                        if(!password_verify($password, $hash_password)){
                           $password_error="You enter a wrong password";
                        }else{
                            if(isset($_POST['g-recaptcha-response'])){
                                $scretkey='6LfOToIpAAAAAEmNXIYR-des6jRV2S0ct8XyFMVa';
                                $ip=$_SERVER['REMOTE_ADDR'];
                                $response=$_POST['g-recaptcha-response'];
                                $url="https://www.google.com/recaptcha/api/siteverify?secret=$scretkey&response=$response&remoteip=$ip";
                                $fire=file_get_contents($url);
                                $data=json_decode($fire);
                                if($data->success==true){    
                                     $_SESSION['username'] = $name;
                                    $_SESSION['logged_in'] = true;
                                    header("location:index.php");
                                }else{
                                    $recaptua_error="fill recaptua";
                                }
                        }
                    }       
                }
            }}
    ?>
    <div class="div1">
        <div class="div2">
            <div class="div2a">
                <p class="login"><b>Login</b></p>
            </div>
            <div class="div2b">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <p class="logina"><b>Log In</b></p>
                    <div id="error">
                        <p class="err"><?php echo $empty_error?></p>
                        <p class="err"><?php echo $name_error?></p>
                        <p class="err"><?php echo $password_error?></p>
                        <p class="err"><?php echo $recaptua_error?></p>
                    </div>

                    <div class="user">
                        <i class="fa-solid fa-user user_icon"></i>
                        <input type="text" name="user_name" class="user_input" placeholder="Enter User Name" value="<?php if(isset($_POST['user_name'])){echo htmlentities($_POST['user_name']);}?>">
                        
                    </div>
                    <div class="password">
                        <i class="fa-solid fa-lock lock_icon" ></i>
                        <input type="password" name="password" class="password_input" id="password" placeholder="Enter Password" value="<?php if(isset($_POST['password'])){echo htmlentities($_POST['password']);}?>">
                        <span class="password-toggle-icon eye"><i class="fas fa-eye eyee"></i></span>
                    </div>
                     
                    <div class="g-recaptcha" style="transform: scale(0.66); 
                        -webkit-transform: scale(0.66); transform-origin: 0 0;
                        -webkit-transform-origin: 0 0; margin-left: 70px; margin-bottom: -10px; text-align: center; " data-theme="light"
                        data-sitekey="6LfOToIpAAAAAIUTXURr2ZjmcT447WXIyQhSRNUm">
                    </div>   
                    <div class="forgotPass">
                        <a href="forgetpassword.php">Forget Password</a>
                    </div>
                      
                    <div class="d_button">
                        <button name="submit" class="button">log In</button>
                    </div>            
                    
                    <div class="icon">
                    <i class="fa-brands fa-facebook"></i>
                    <i class="fa-brands fa-square-instagram"></i>
                    <i class="fa-brands fa-google"></i>
                    <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div class="paragraph">
                        <p class="register">Have no account Register Here<a href="registerr.php" class="reg"> Register</a></p>
                    </div>
                   
                </form>
            </div>
        </div>
    </div>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        const passwordField = document.getElementById("password");
const togglePassword = document.querySelector(".password-toggle-icon i");

togglePassword.addEventListener("click", function () {
  if (passwordField.type === "password") {
    passwordField.type = "text";
    togglePassword.classList.remove("fa-eye");
    togglePassword.classList.add("fa-eye-slash");
  } else {
    passwordField.type = "password";
    togglePassword.classList.remove("fa-eye-slash");
    togglePassword.classList.add("fa-eye");
  }

 
});
    </script>
</body>
</html>