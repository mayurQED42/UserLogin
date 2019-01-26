<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require 'vendor/autoload.php';

session_start();
if (isset($_SESSION['name'])) {
   header("Location:welcome.php");
}
else{
?>

<html>
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
        <form action="" method="POST">
            <div class="page">
            <center font size="10">Register User</center>
            <div class="info">
                    Name: <input type="text" name="name" ><br>
                    Email id: <input type="text" name="email" ><br>
                    DOB: <input type="text" name="dob" ><br>
                    Password: <input type="password" name="password"><br>
                    <input type="submit" value="register" name="register"><br>
                    
            </div>
            </div>
        </form>
        <form action="login.php" method="GET">
        <h1>if you are already registered</h1><br>
        <button type="submit" formaction="./login.php">LOGIN</button>
        </form>
        </body>
</html>
        
        <?php
        
        if($_SERVER["REQUEST_METHOD"]=="POST")
        {
            include "myDb.php";
            include "User.php";
            $n=$_POST['name'];
           
            //hash code
            $h=md5(rand(0,1000));
            //mail veerification:sending mail
            $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
            try {
                //Server settings
                $mail->SMTPDebug = 2;                                 // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'alshayakapoor@gmail.com';                 // SMTP username
                $mail->Password = 'Vrushali@123';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                    // TCP port to connect to

                //Recipients
                $mail->setFrom('trupti.diwani@qed42.com', 'Mailer');
                $mail->addAddress($_POST['email'], $_POST['name']);     // Add a recipient
                $mail->addAddress('ellen@example.com');               // Name is optional
                $mail->addReplyTo('info@example.com', 'Information');
    

                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Signup | Verification';
                $mail->Body    = "we are registering you..
                your name=".$_POST['name']." and pass=".$_POST['password']."
                please click on link to activate account:
                http://localhost:8888/Login/UserLogin/register1.php?email=".$_POST['email']."&hash=".$h."
                ";
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
   
                $mail->send();
                echo 'email has been sent.. please click on link to registered yourself.';
                } catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                }

        
             $u=new User();
             $ress=$u->reguser($_POST['name'],$_POST['email'],$_POST['dob'],$_POST['password'],$h);
             
        }
    }
        ?>
