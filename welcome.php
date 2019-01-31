<?php
require 'vendor/autoload.php';
use mayur\UserLogin\myDb;
use mayur\UserLogin\User;
session_start();
    $u=new User();
    $p=md5($_GET['pass']);
    $res=$u->checkadmin($_GET['name'],$p);
    $_SESSION['role'] = "admin"; 
    
    
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
    
    if($res || $_SESSION['role'] = "admin")
    {
        
?>   
<html>
<body>
<form action="" method="POST">
<h1>Welcome Admin <h1><br>
Add User : <a href="adduser.php?actuser=admin">Register User</a><br><br>Enter Id to delete user<br>
Id: <input type="text" name="id" ><button type="submit">delete</button><br><br>
diplay user :<a href="filter.php">filter user</a><br><br>
edit user :<a href="edit.php">edit user</a><br><br>

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
<h2>welcome user <h2><br><br>
<a href="logout.php">logout</a>
</form>
</body>
</html>
<?php
}
?>