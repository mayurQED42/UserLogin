<html>
    <body>
        <?php
        session_start();
        include "myDb.php";
            class Wel{
                public $dbh;
                public function __construct(){
                    $name=$_POST["name"];
                    $passs=$_POST["pass"];
                    $this->dbh=new myDb();
                    try {
                        
                        $stmt=$this->dbh->dbh->prepare("SELECT pass FROM reginfo WHERE cname='$name'"); 
                        $stmt->execute();
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        //while($r=$stmt->fetch()){
                        $r=$stmt->fetch();
                        if(!strcmp($passs,$r['pass']))
                        {
                            echo "WELCOME <br>You are logged in successfully!!!";

                            
                            $_SESSION["name"] = $name;
                            
                            
                        }
                        else
                        {
                            echo "something went wrong!!!";
                        }
                    } catch (PDOException $e) {
                        print "Error!: " . $e->getMessage() . "<br/>";
                        die();
                        }
                        $dbh = null; 
                        }
        
                }
                $ob1=new Wel();
        ?>
        
    </body>
 </html>