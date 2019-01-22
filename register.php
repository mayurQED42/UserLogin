<html>
<?php
session_start();

if (isset($_SESSION['name'])) {
  
    header("Location:welcome.php");
}
else{
?>

    <style>
        .page{
            background-color: bisque;
            
        }
        .info{
            background-color: aqua;
            margin:5%;
            color:black;
            
        }
    </style>
    <body>
        <form action="register1.php" method="POST">
            <div class="page">
            <center font size="10">Register User</center>
            <div class="info">
                    Name: <input type="text" name="name" ><br>
                    Email id: <input type="text" name="email" ><br>
                    DOB: <input type="text" name="dob" ><br>
                    Password: <input type="password" name="password"><br>
                    <input type="submit" value="register" name="register"><br>
                    <h1>if you are already registered</h1><br>
                    <button type="submit" formaction="./login.php">LOGIN</button>
            </div>
            </div>
        </form>
        <?php
        }
        ?>
    </body>
</html>