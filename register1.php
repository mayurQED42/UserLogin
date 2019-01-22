<html>
    <body>
        <?php
        class Reg{
            public function __construct()
            {
                $name=$_POST["name"];
                $email=$_POST["email"];
                $dob=$_POST["dob"];
                $passs=$_POST["password"];
        
                try {
                    $user = "root";
                    $pass = "root";
                    $dbh = new PDO('mysql:host=localhost;dbname=LoginPage', $user, $pass);
                    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $que="INSERT INTO reginfo (cname, email, dob, pass) VALUES ('$name', '$email', '$dob', '$passs')";
                    $stmt=$dbh->prepare($que);
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
