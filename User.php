<?php
    spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
    });
    
    class User {
                /**
                * Helper method for user login.
                */
                public function login($name,$passs)
                {   
                    $dbh = new myDb();
                    $stmt=$dbh->dbh->prepare("SELECT pass FROM reginfo WHERE cname='$name' and active=1"); 
                    $stmt->execute();
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
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
                public function reguser($name,$email,$dob,$passs,$h)
                {
                    $p=md5($passs);
                    $dbh=new myDb();
                    $que="INSERT INTO reginfo (cname, email, dob, pass,hashh,active) VALUES ('$name', '$email', '$dob', '$p','$h',0)";
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
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
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
    }
?>