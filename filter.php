<?php
require 'vendor/autoload.php';
use mayur\UserLogin\myDb;
use mayur\UserLogin\User;
    //echo "here we gonna filter users";
    error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<html>
<head></head>
<body>
<form action="" method="POST">
select filter operator:<br>
<input type="radio" name="myrole" value="admin"> admin<br>
<input type="radio" name="myrole" value="newbie"> newbie<br>
<input type="radio" name="myrole" value="mentor"> mentor<br>
<input type="radio" name="myrole" value="all"> display all<br>
<input type="submit" value="display" name="display"><br>
</form>
</body>
</html>

<?php
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $u=new User();
        $re=$u->myfilter($_POST['myrole']);
        echo "<table border=1>";
        echo "<tr><th>Id</th><th>name</th><th>email</th><th>dob</th><th>pass</th><th>hash</th><th>active</th><th>role</th></tr>";
        for ( $row = 0; $row < count($re); $row++ )
        {
            echo "<tr><td>";
            for ( $column = 0; $column < 8; $column++ )
            {
                echo $re[$row][$column] ;
                echo "<td>";
            }
            echo "</tr>";
        }
    }
?>