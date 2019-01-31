<?php
require 'vendor/autoload.php';
use mayur\UserLogin\myDb;
use mayur\UserLogin\User;

$res;
$u;
?>

<html>
<head></head>
<body>
<form method="GET" action="">
id: <input type="text" name="id"><button type="submit">show</button><br>
</form>
</body>
</html>

<?php
if($_SERVER["REQUEST_METHOD"]=="GET")
{
$u=new User();
$res=$u->getinfo($_GET['id']);
if($res)
{
?>

<html>
<head></head>
<body>
<form method="POST" action="">
<h1>user info</h1>
id: <input type="text" name="id" value="<?php echo $res[0][0]?>"><br>
Name: <input type="text" name="name" value="<?php echo $res[0][1]?>"><br>
Email id: <input type="text" name="email" value="<?php echo $res[0][2]?>"><br>
DOB: <input type="text" name="dob" value="<?php echo $res[0][3]?>"><br>
Password: <input type="password" name="password" value="<?php echo $res[0][4]?>"><br>
<button type="submit">edit</button><br>
</form>    
</body>
</html>

<?php
}
}
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    
    $u1=new User();
    $res=$u1->editinfo($_POST['id'],$_POST['name'],$_POST['email'],$_POST['dob'],$_POST['password']);
   
    if($res)
    {
        echo "data is updated";
    }
    else{
        echo "data is not updated";
    }
}
?>