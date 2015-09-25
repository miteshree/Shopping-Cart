<form action="board.php" method="post">
<h1 align="center"> LOGIN </h1>
<h3> Username: <input type="text" name="uname" id="uid"/><h3>
<h3> Password: <input type="password" name="passwrd" id="pass"/></h3>
<input type="submit" name="login" value="Login" />
<a href="Adduser.php" name="new"> New User</a>
</form>

<?php
 session_start();

error_reporting(E_ALL);
   ini_set('display_errors','On');

   if(isset($_POST['login'])){

 try {


  $user= $_POST['uname'];
  $pass= $_POST['passwrd'];
  $password = md5($pass);
 // $login= $_POST['login'];
  $dbname = dirname($_SERVER["SCRIPT_FILENAME"]) . "/mydb.sqlite";
  $dbh = new PDO("sqlite:$dbname");
  $dbh->beginTransaction();
  $stmt = $dbh->prepare("SELECT username  FROM users  WHERE username='$user' AND password='$password'");
  $stmt->execute();

  if($stmt->fetch()) {
   $_SESSION['uname']=$user;
  echo "Login successful";
  header('Location: http://omega.uta.edu/~mjs5548/project5/postMessage.php');
}

 else{
 echo "Login Failure";
}
}catch (PDOException $e) {
  print "Error!: " . $e->getMessage() . "<br/>";
  die();
 }
}
?>
