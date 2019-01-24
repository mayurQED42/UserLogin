<?php
session_start();
    
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        session_destroy();
        header("Location:register.php");
    }
?>   
<html>
<body>
<form action="" method="POST">
welcome<br><br>
<input type="submit" value="LOGOUT" name="LOGOUT"><br>
</form>
</body>
</html>

