<?php
class myDb{
    public $dbh;
    function __construct()
    {
        try{
            //created connection object
            $user = "root";
            $pass = "root";
            $this->dbh = new PDO('mysql:host=localhost;dbname=LoginPage', $user, $pass);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e){
            print "Error!: " . $e->getMessage() . "";
            die();
        }
        return $this->dbh;
    }
}
?>