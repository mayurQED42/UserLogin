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
                    Role:<input type="radio" name="myrole" value="admin"> admin<br>
                        <input type="radio" name="myrole" value="newbie"> newbie<br>
                        <input type="radio" name="myrole" value="mentor"> mentor<br> 
                    <input type="submit" value="register" name="register"><br>
                    <h1>if you are already registered</h1><a href="login.php">LOGIN</a><br>
            </div>
            </div>
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
            $ress=$u->reguser($_POST['name'],$_POST['email'],$_POST['dob'],$_POST['password'],$h,$_POST['myrole']);
            //mail veerification:sending mail
            $re=$u->sendmail($_POST['name'],$_POST['password'],$_POST['email'],$h);
            
        }
    }
        ?>
