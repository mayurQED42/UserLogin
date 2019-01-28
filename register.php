<?php

session_start();
use mayur\UserLogin\myDb;
use mayur\UserLogin\User;

error_reporting(E_ALL);
ini_set('display_errors', 1);
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
            //include "myDb.php";
            //include "User.php";
            require 'vendor/autoload.php';
            $n=$_POST['name'];
           
            //hash code
            $h=md5(rand(0,1000));
            $u=new User();
            $ress=$u->reguser($_POST['name'],$_POST['email'],$_POST['dob'],$_POST['password'],$h);
            //mail veerification:sending mail
            
            $re=$u->sendmail($_POST['name'],$_POST['password'],$_POST['email'],$h);
            if($re)
            {
                echo "email has been sent.. please click on link to registered yourself.";
            }     
            else{
                echo "may some problem occured un sending mail";
            }    
        }
    }
        ?>
