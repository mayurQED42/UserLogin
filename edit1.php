<html>
<head></head>
<body>
<a href="edit.php">back</a><br><br>
</body>
</html>

<?php
require 'vendor/autoload.php';
use mayur\UserLogin\myDb;
use mayur\UserLogin\User;
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
if($_SERVER["REQUEST_METHOD"]=="GET")
{
?>
<html>
<head></head>
<body>
<form method="POST" action="">
<h1>user info</h1>
id: <input type="text" name="id" value="<?php echo $_GET['id']?>"><br>
Name: <input type="text" name="name" value="<?php echo $_GET['name']?>"><br>
Email id: <input type="text" name="email" value="<?php echo $_GET['email']?>"><br>
DOB: <input type="text" name="dob" value="<?php echo $_GET['dob']?>"><br>
<button type="submit">edit</button><br>
</form>    
</body>
</html>

<?php
}
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $u1=new User();
    $res=$u1->editinfo($_POST['id'],$_POST['name'],$_POST['email'],$_POST['dob']);
   
    if($res)
    {
        echo "data is updated";
    }
    else{
        echo "data is not updated";
    }

}
?>