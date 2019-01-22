<html>
<?php
session_start();

if (isset($_SESSION['name'])) {
    
    header("Location:welcome.php");
}
else{
?>
    <body>
        <form action="welcome.php" method="POST">
                Name: <input type="text" name="name" required><br>
                password: <input type="password" name="pass" required><br>
                <input type="submit">
        </form>
    </body>
    <?php
    }
    ?>
</html>
