<?php
function __autoload($class)
{
    include_once($class.".php");
}

class User {
    /**
     * Helper method for user login.
     */
    public function login($name,$passs)
    {   
        $dbh = new myDb();
        $stmt=$dbh->dbh->prepare("SELECT pass FROM reginfo WHERE cname='$name'"); 
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
    public function reguser($name,$email,$dob,$passs)
    {
        $p=md5($passs);
        $dbh=new myDb();
        $que="INSERT INTO reginfo (cname, email, dob, pass) VALUES ('$name', '$email', '$dob', '$p')";
        $stmt=$dbh->dbh->prepare($que);
        $val=$stmt->execute();
        return $val;
    }
}
?>