 session_start();

  error_reporting(E_ALL);
   ini_set('display_errors','On');


      echo '<form method="post">';
      echo '<input type="textarea" name="message"/>';
      echo '<input type="Submit" name="post" value="Post"/>';
      echo '<input type="Submit" name="logout" value="Logout"/>';
      echo '</form>';



    try{
      $dbname = dirname($_SERVER["SCRIPT_FILENAME"]) . "/mydb.sqlite";
      // echo $dbname;

     $dbh = new PDO("sqlite:$dbname");
     $dbh->beginTransaction();
     $message = $_POST['message'];
    // echo $message;
     $id = uniqid();
    // echo $id."<br/>";
      $date = date("now");
    // echo $date;
        $user = $_SESSION['uname'];
          echo $user;
      $dbh->exec("INSERT INTO posts(id,postedby,datetime,message) VALUES('$id','$user','$date','$message')");
      echo "Inserted Successfully";

       $dbh->commit();
       $stmt = $dbh->prepare('select * from posts');
        $stmt->execute();
        //print "<pre>";

        while ($row = $stmt->fetch()) {
         echo'<table border="1"><tr><td>'. $row['postedby'].'</td>';
           echo'<td>'. $row['message'].'</td></tr></table>';
       }
          //print "</pre>";

    }catch(PDOException $e) {
      print "Error!: " . $e->getMessage() . "<br/>";
  die();
 }

?>
