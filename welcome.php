<?php
require 'vendor/autoload.php';
use mayur\UserLogin\myDb;
use mayur\UserLogin\User;
session_start();
    $u=new User();
    $p=md5($_GET['pass']);
    $res=$u->checkadmin($_GET['name'],$p);
    
    
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $resss=$u->deleteuser($_POST['id']);
        if($resss)
        {
            echo "user is deleted";
        }
        else{
            echo "problem occured in deleting";
        }
        //echo "id=".$_POST['id']."<br>";
    }
    
    if($res)
    {
        
?>   
<html>
<body>
<form action="" method="POST">
<h1>welcome admin<h1><br>
<a href="register.php">Register User</a><br><br>enter id to delete user<br>
id: <input type="text" name="id" ><button type="submit">delete</button><br><br>

<a href="logout.php">logout</a>
</form>
</body>
</html>
<?php
    }
    else
    {
?>
<html>
<body>
<form action="" method="POST">
<h2>welcome user<h2><br><br>
<a href="logout.php">logout</a>
</form>
</body>
</html>
<?php
}
?>