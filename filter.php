<?php
require 'vendor/autoload.php';
use mayur\UserLogin\myDb;
use mayur\UserLogin\User;
    //echo "here we gonna filter users";
//     error_reporting(E_ALL);
// ini_set('display_errors', 1);

?>

<html>
<head></head>
<body>
<form action="" method="POST">
<a href="welcome.php">back</a><br><br>
select filter operator:<br>
<input type="radio" name="myrole" value="all"> all<br>
<input type="radio" name="myrole" value="admin"> admin<br>
<input type="radio" name="myrole" value="newbie"> newbie<br>
<input type="radio" name="myrole" value="mentor"> mentor<br>
<input type="submit" value="display" name="display"><br>
</form>
</body>
</html>

<?php
    
    if($_SERVER["REQUEST_METHOD"]=="POST" && $_POST['myrole']!="all")
    {
        $my1page=$_GET['my1page'];
        if($my1page=="" || $my1page=="1")
        {
            $_SESSION['my1page1']=0;
        }
        else
        {
            $_SESSION['my1page1']=($my1page*20)-20;
        }
        $u=new User();
        $count=$u->getrowsmyrole($_POST['myrole']);
        $pageCount=ceil($count/20);
        for($b1=1;$b1<=$pageCount;$b1++)
        {
            ?><a href="filter.php?my1page=<?php echo $b1; ?>"><?php echo $b1." ";?></a><?php
        }
        showdata($_POST['myrole']);
        
    }
    else{
        $mypage=$_GET['mypage'];
        if($mypage=="" || $mypage=="1")
        {
            $_SESSION['mypage1']=0;
        }
        else
        {
            $_SESSION['mypage1']=($mypage*20)-20;
        }
        $u=new User();
        $count=$u->getrows();
        $pageCount=ceil($count/20);
        for($b=1;$b<=$pageCount;$b++)
        {
            ?><a href="filter.php?mypage=<?php echo $b; ?>"><?php echo $b." ";?></a><?php
        }
        showdata("all");
    }
    function showdata($mrole)
    {
        
        $u=new User();
        
        $re=$u->myfilter($mrole);
        echo "<table border=2>";
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