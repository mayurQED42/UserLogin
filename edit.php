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
<a href="welcome.php">back</a><br><br>
</body>
</html>

<?php
$u=new User();
$re=$u->getinfo();
if($re)
{
    echo "<table border=2>";
        echo "<tr><th>Id</th><th>name</th><th>email</th><th>dob</th><th>edit</th></tr>";
        for ( $row = 0; $row < count($re); $row++ )
        {
            echo "<tr><td>";
            for ( $column = 0; $column < 4; $column++ )
            {
                
                    echo $re[$row][$column] ;
                    echo "<td>";
                    if($column==3)
                    {
                       echo "<a href=edit1.php?id=".$re[$row][0]."&name=".$re[$row][1]."&email=".$re[$row][2]."&dob=".$re[$row][3].">edit</a>";
                       echo "<td>";
                    }
            }
            
            echo "</tr>";
        }
}    
    
?>