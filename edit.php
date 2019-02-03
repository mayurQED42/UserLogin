<?php
session_start();
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

        $page=$_GET['page'];
        if($page=="" || $page=="1")
        {
            $_SESSION['page1']=0;
        }
        else
        {
            $_SESSION['page1']=($page*20)-20;
        }
        
        $u=new User();
        $count=$u->getrows();
        //echo $count;exit();

        $pageCount=ceil($count/20);
        for($b=1;$b<=$pageCount;$b++)
        {
            ?><a href="edit.php?page=<?php echo $b; ?>"><?php echo $b." ";?></a><?php
        }
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