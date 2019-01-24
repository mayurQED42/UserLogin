<?php
function __autoload($class)
{
    include_once($class.".php");
}
error_reporting(E_ALL);
ini_set('display_errors', 1);
class User{
    public function login($name,$passs)
    {
        $dbh=new myDb();
        $stmt=$dbh->dbh->prepare("SELECT pass FROM reginfo WHERE cname='$name'"); 
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        //while($r=$stmt->fetch()){
        $r=$stmt->fetch();
        if(!strcmp($passs,$r['pass']))
        {
            
            return true;
        }
        else
        {
            return false;
           
        }
    }
    public function reguser($name,$email,$dob,$passs)
    {
        $dbh=new myDb();
        $que="INSERT INTO reginfo (cname, email, dob, pass) VALUES ('$name', '$email', '$dob', '$passs')";
        $stmt=$dbh->dbh->prepare($que);
        $val=$stmt->execute();
        return $val;
    }
}
?>