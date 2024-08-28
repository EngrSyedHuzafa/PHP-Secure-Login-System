
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/index1.css">
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body>
    <?php 
        session_start();
        if(isset($_GET['logout'])){
            session_destroy();
            unset($_SESSION['username']);
            header("location: login.php");
        }
    ?>
    <div class="nav_bar">
        <div>
            <img style="width:50px; height:50px; margin-top: 5px;" src="www.png" alt="">
        </div>
        <div>
            <ul class="listed_item">
                
                <li class="hideonmobile"><a href="#">Home</a></li>
                <li class="hideonmobile"><a href="#">About us</a></li>
                <li class="hideonmobile"><a href="#">Contact</a></li>
                <li class="hideonmobile"><a href="#">abcd</a></li>
                <li class="hideonmobile"><a href="#">efgh</a></li>
            </ul>
        </div>

        <div>
            <ul class="listed_item">
                <li><?php if(isset($_SESSION['logged_in'])  && $_SESSION['logged_in'] == true) {
                    echo '<p class="paragraph">'.$_SESSION['username']. '</p>';
                    echo'<li><form><button name="logout" class="button">Logout</button></form><li>';
                } else {
                    echo '<li><a href="login.php">Login</a></li>';
                    echo '<li><a href="registerr.php">Register</a></li>';
                }     
                ?>
                </li>
                <li class="sidebar"><span onclick="showsideBar()" class="material-symbols-outlined ">menu</span></li>
             </ul>
         
        </div>
    </div>
        <div class="listed_item2">
             <ul>   
                <li><span onclick="hidenavBar()" class="material-symbols-outlined">close</span></li>
                <li><a href="#">Home</a></li>
                <li><a href="#">About us</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">abcd</a></li>
                <li><a href="#">efgh</a></li>
            </ul>
        </div>
    <script>
        function showsideBar(){
            const sidebar=document.querySelector('.listed_item2');
            sidebar.style.display='block';
        }
        function hidenavBar(){
            const sidebar=document.querySelector('.listed_item2');
            sidebar.style.display='none';
        }
    </script>
</body>
</html>