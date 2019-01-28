 <?php
 use mayur\UserLogin\myDb;
 use mayur\UserLogin\User;
 require 'vendor/autoload.php';
    //include "myDb.php";
    //include "User.php";

    $u=new User();
 
    $res=$u->activate($_GET['email'],$_GET['hash']);
    if($res)
    {
 ?>
    <html>
        <body>
            <h1>user account is active</h1><br>
            <form action="login.php" method="POST">
            <input type="submit" value="LOGIN" name="LOGIN"><br>
            </form>
        </body>
    </html>
<?php
 }
 else{
        echo "something goes wrong";
 }
 ?>