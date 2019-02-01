<?php
namespace mayur\UserLogin;
use mayur\UserLogin\myDb;
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require 'vendor/autoload.php';
    // spl_autoload_register(function ($class_name) {
    // include $class_name . '.php';
    // });
    
    class User {
                /**
                * Helper method for user login.
                */
                public function login($name,$passs)
                {   
                    $dbh = new myDb();
                    $stmt=$dbh->dbh->prepare("SELECT pass FROM reginfo WHERE cname='$name' and active=1"); 
                    $stmt->execute();
                    //$stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $r=$stmt->fetch();
                    $p=md5($passs);
                    if(!strcmp($p,$r['pass']))
                    {
                        return true;
                    }
                    else
                    {
                        return false;  
                    }
                }

                /**
                *Helper method for user registration 
                */
                public function reguser($name,$email,$dob,$passs,$h,$acti,$ro)
                {
                    $p=md5($passs);
                    $dbh=new myDb();
                    $que="INSERT INTO reginfo (cname, email, dob, pass,hashh,active,role) VALUES ('$name', '$email', '$dob', '$p','$h','$acti','$ro')";
                    $stmt=$dbh->dbh->prepare($que);
                    $val=$stmt->execute();
                    return $val;
                }

                /**
                *Helper method for activating user account 
                */
                public function activate($email,$hash)
                {   
                    $dbh = new myDb();
                    $stmt=$dbh->dbh->prepare("UPDATE reginfo SET active=1 WHERE email='$email' AND hashh='$hash'"); 
                    $stmt->execute();
                    //$stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $r=$stmt->execute();
                    if($r)
                    {
                        return true;
                    }
                    else
                    {
                        return false;  
                    }
                }

                /**
                *Helper method for sending mail 
                */
                public function sendmail($name,$pass,$email,$h)
                {
                    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
                    try {
                        //Server settings
                        //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
                        $mail->isSMTP();                                      // Set mailer to use SMTP
                        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                        $mail->SMTPAuth = true;                               // Enable SMTP authentication
                        $mail->Username = 'alshayakapoor@gmail.com';                 // SMTP username
                        $mail->Password = 'Vrushali@123';                           // SMTP password
                        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                        $mail->Port = 587;                                    // TCP port to connect to

                        //Recipients
                        $mail->setFrom('trupti.diwani@qed42.com', 'Mailer');
                        $mail->addAddress($email, $name);     // Add a recipient
                        $mail->addAddress('ellen@example.com');               // Name is optional
                        $mail->addReplyTo('info@example.com', 'Information');
    

                        //Content
                        $mail->isHTML(true);                                  // Set email format to HTML
                        $mail->Subject = 'Signup | Verification';
                        $mail->Body    = "we are registering you..<br>
                        your name=".$name." and pass=".$pass."<br>
                        please click on link to activate account:<br>
                        http://localhost:8888/Login/UserLogin/register1.php?email=".$email."&hash=".$h."
                        ";
                        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
   
                        $mail->send();
                        echo 'email has been sent.. hello please click on link to registered yourself.';
                    } 
                    catch (Exception $e)
                    {
                        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                    }
                }

                /**
                * Helper method for checking admin.
                */
                public function checkadmin($name,$passs)
                {   
                    $dbh = new myDb();
                    $stmt=$dbh->dbh->prepare("SELECT Id FROM reginfo WHERE cname='$name' and pass='$passs' and role='admin'"); 
                    $stmt->execute();
                    //$stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $r=$stmt->fetch();
                    if($r)
                    {
                        return true;
                    }
                    else
                    {
                        return false;  
                    }
                }

                /**
                * Helper method for delete user.
                */
                public function deleteuser($id)
                {
                    $dbh = new myDb();
                    if($id==1)
                    {
                        return false;
                    }
                    else{
                    $stmt=$dbh->dbh->prepare("DELETE FROM reginfo WHERE id='$id'"); 
                    $stmt->execute();
                    //$stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $r=$stmt->fetch();
                    if($r)
                    {
                        return true;
                    }
                    else
                    {
                        return false;  
                    } 
                }
                }
            
                /**
                * Helper method for filter user.
                */
                public function myfilter($role)
                {   
                    $stmt;
                    $dbh = new myDb();
                    if($role=="all")
                    {
                        $stmt=$dbh->dbh->prepare("SELECT * FROM reginfo");
                    }
                    else{
                        $stmt=$dbh->dbh->prepare("SELECT * FROM reginfo WHERE role='$role'"); 
                    }
                        $stmt->execute();
                    //$stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $r=$stmt->fetchAll();
                    if($r)
                    {
                        return $r;
                    }
                    else{
                        return false;
                    }
                }

                /**
                * Helper method for get user info.
                */
                public function getinfo()
                {   
                   
                    $dbh = new myDb();
                    
                    $stmt=$dbh->dbh->prepare("SELECT Id,cname,email,dob FROM reginfo"); 
                
                    $stmt->execute();
                    //$stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $r=$stmt->fetchAll();
                    if($r)
                    {
                        return $r;
                    }
                    else{
                        return false;
                    }
                }

                /**
                * Helper method for edit user info.
                */
                public function editinfo($id,$name,$email,$dob)
                {   
                      
                    $dbh = new myDb();
                    //$stmt=$dbh->dbh->prepare("UPDATE reginfo SET active=1 WHERE email='$email' AND hashh='$hash'");
                    $stmt=$dbh->dbh->prepare("UPDATE reginfo SET cname='$name',email='$email',dob='$dob' WHERE Id = '$id'"); 
                
                    $r=$stmt->execute();
                    if($r)
                    {
                        return true;
                    }
                    else{
                        return false;
                    }
                }

    }
?>