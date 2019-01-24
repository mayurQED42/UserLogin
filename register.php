<?php
session_start();
if (isset($_SESSION['name'])) {
   header("Location:welcome.php");
}
else{
?>

<html>
    <style>
        .page{
            background-color: bisque;
            
        }
        .info{
            background-color: aqua;
            margin:5%;
            color:black;
            
        }
    </style>
    <body>
        <form action="" method="POST">
            <div class="page">
            <center font size="10">Register User</center>
            <div class="info">
                    Name: <input type="text" name="name" ><br>
                    Email id: <input type="text" name="email" ><br>
                    DOB: <input type="text" name="dob" ><br>
                    Password: <input type="password" name="password"><br>
                    <input type="submit" value="register" name="register"><br>
                    
            </div>
            </div>
        </form>
        <form action="login.php" method="GET">
        <h1>if you are already registered</h1><br>
        <button type="submit" formaction="./login.php">LOGIN</button>
        </form>
        </body>
</html>
        
        <?php
        
        if($_SERVER["REQUEST_METHOD"]=="POST")
        {
            include "myDb.php";
            include "User.php";
            $u=new User();
            $ress=$u->reguser($_POST['name'],$_POST['email'],$_POST['dob'],$_POST['password']);
            if($ress)
            {
                header("Location:register1.php");
            }
            else{
                echo "not registered";
            }
        }
    }
        ?>
