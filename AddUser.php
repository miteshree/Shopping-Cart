<?php
  error_reporting(E_ALL);
   ini_set('display_errors','On');
   if(!isset($_POST['submit'])){
      echo '<form  method="post">';
      echo '<h2> USER REGISTRATION FORM </h2><br/>';
      echo 'Username:<input type="text" name="uname"/><br/>';
      echo 'Password:<input type="password" name="pass"/><br/>';
      echo 'FullName:<input type="text" name="Fullname"/><br/>';
      echo 'Email: <input type="text" name="email"/></br>';
      echo '<input type="submit" name="submit" value="Submit">';
      echo '</form>';
   }
    else{
         try{
      $dbname = dirname($_SERVER["SCRIPT_FILENAME"]) . "/mydb.sqlite";
      // echo $dbname;

     $dbh = new PDO("sqlite:$dbname");
     $dbh->beginTransaction();
     $uname = $_POST['uname'];
     echo $uname;
     $pass1 = $_POST['pass'];
     $pas=md5($pass1);

     echo $pass;
     $fullname = $_POST['Fullname'];
     // echo $fullname;
     $email = $_POST['email'];
    // echo $email;
     if(isset($_POST['submit'])){
     $dbh->exec("INSERT INTO users(username,password,fullname,email) VALUES('$uname','$pas', '$fullname',' $email')");
     echo " Added successfully";
      header("Location: board.php");
}
  $dbh->commit();
  $stmt = $dbh->prepare('select * from users');
        $stmt->execute();
        print "<pre>";

        while ($row = $stmt->fetch()) {
      print_r($row);
 }
          print "</pre>";



  }catch(PDOException $e) {
      print "Error!: " . $e->getMessage() . "<br/>";
  die();
}

}
<?php
