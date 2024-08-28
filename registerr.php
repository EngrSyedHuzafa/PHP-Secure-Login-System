<?php require_once 'register.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style/register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
<div class="div1">
        <div class="div2">
            <div class="div2a">
                <p class="login"><b>Register</b></p>
            </div>
            <div class="div2b">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <p class="logina"><b>Register</b></p>
                    <p class="err"><?php echo $empty_error?></p>
                    <p class="err"><?php echo $name_error?></p>
                    <p class="err"><?php echo $email_error?></p>
                    <p class="err"><?php echo $password_error?></p>
                    <div class="user">
                        <input type="text" name="user_name" class="user_input" placeholder="Enter User Name" value="<?php if(isset($_POST['user_name'])){echo htmlentities($_POST['user_name']);}?>">
                        <i class="fa-solid fa-user user_icon"></i>
                        
                    </div>
                    <div class="password">
                        <input type="text" name="email" class="password_input" placeholder="Enter Email" value="<?php if(isset($_POST['email'])){echo htmlentities($_POST['email']);}?>">
                        <i class="fa-solid fa-envelope lock_icon"></i>
                    </div>   
                    <div class="password">
                        <input type="password" name="password" class="password_input" placeholder="Enter Password" value="<?php if(isset($_POST['password'])){echo htmlentities($_POST['password']);}?>">
                        <i class="fa-solid fa-lock lock_icon" ></i>
                    </div> 
                    <div class="password">
                        <input type="password" name="con_password" class="password_input" placeholder="Retype Password" value="<?php if(isset($_POST['con_password'])){echo htmlentities($_POST['con_password']);}?>">
                        <i class="fa-solid fa-lock lock_icon" ></i>
                    </div>                 
                    <button name="submit" class="button" onclick="display">Register</button>
                    <p class="register">Have an account Login here <a href="login.php"> LogIN</a></p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>