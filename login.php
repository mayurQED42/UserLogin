<?php
session_start();
if (isset($_SESSION['name'])) {
    header("Location:welcome.php");
}
else{
?>

<html>
    <body>
        <form action="" method="POST">
                Name: <input type="text" name="name" required><br>
                password: <input type="password" name="pass" required><br>
                <input type="submit">
        </form>
    </body>
    </html>

    <?php
    
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        include "myDb.php";
        include "User.php";
      
        $u=new User();
        
        $res=$u->login($_POST['name'],$_POST['pass']);
        if($res)
        {
            $_SESSION["name"] = $name;   
            header("Location:welcome.php");
        }
    }
}
    ?>
