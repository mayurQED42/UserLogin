<?php
require 'vendor/autoload.php';
use mayur\UserLogin\myDb;
use mayur\UserLogin\User;


error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
if (isset($_SESSION['name'])) {
    header("Location:welcome.php");
}
else{
?>

<html>
    <body>
        <form action="" method="POST">
                Name: <input type="text" name="name" value="<?php if(isset($_COOKIE["name"])) { echo $_COOKIE["name"]; } ?>" required><br>
                password: <input type="password" name="pass" value="<?php if(isset($_COOKIE["pass"])) { echo $_COOKIE["pass"]; } ?>" required><br>
                <input type="checkbox" name="remember_me" id="remember_me">
                RememberMe
                <br>
                <input type="submit">
        </form>
    </body>
    </html>

    <?php
    
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        
        //include "myDb.php";
        //include "User.php";
      
        $u=new User();
        
        $res=$u->login($_POST['name'],$_POST['pass']);
      
        if($res)
        {
           
            if($_POST["remember_me"]=='1' || $_POST["remember_me"]=='on')
            {
                $hour = time() + 3600 * 24 * 30;
                setcookie('name', $_POST['name'], $hour);
                setcookie('pass', $_POST['pass'], $hour);
            }
            // $_SESSION['name'] = $_POST['name'];   
            header("Location:welcome.php?name=".$_POST['name']."&pass=".$_POST['pass']);
        }
        else{
            echo "User is not active or may some problem occured";
        }
       
    }
}
    ?>
