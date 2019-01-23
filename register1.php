<html>
    <body>
        <?php
        include "myDb.php";
        class Reg{
            public $dbh;
            public function __construct()
            {
                $name=$_POST["name"];
                $email=$_POST["email"];
                $dob=$_POST["dob"];
                $passs=$_POST["password"];
                $this->dbh=new myDb();
        
                try {
                    
                    $que="INSERT INTO reginfo (cname, email, dob, pass) VALUES ('$name', '$email', '$dob', '$passs')";
                    $stmt=$this->dbh->dbh->prepare($que);
                    $stmt->execute();

                } catch (PDOException $e) {
                    print "Error!: " . $e->getMessage() . "<br/>";
                    die();
                }
                $dbh = null; 
            }
        }
        $ob=new Reg();
        ?>
        <h1>user is registered</h1><br>
        <form action="login.php" method="POST">
        <input type="submit" value="LOGIN" name="LOGIN"><br>
        </form>
    </body>
</html>
