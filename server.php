<?php
session_start();

$username = "";
$email    = "";
$errors = array(); 

$db = mysqli_connect('localhost', 'root', '', 'registration');

if (isset($_POST['reg_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);


  if (empty($username)) { array_push($errors, "Нужно ввести имя"); }
  if (empty($email)) { array_push($errors, "Нужно ввести почту"); }
  if (empty($password_1)) { array_push($errors, "Нужно ввести пароль"); }
  if ($password_1 != $password_2) {
	array_push($errors, "Два пароля не совпадают");
  }

  $user_check_query = "SELECT * FROM info WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { 
    if ($user['username'] === $username) {
      array_push($errors, "Имя существует");
    }

    if ($user['email'] === $email) {
      array_push($errors, "Емаел существует");
    }
  }

  if (count($errors) == 0) {
  	$password = md5($password_1);

  	$query = "INSERT INTO info (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "Вы вошли";
  	header('location: index.php');
  }
}
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
    array_push($errors, "Нужно ввести имя");
  }
  if (empty($password)) {
    array_push($errors, "Нужно ввести пароль");
  }

  if (count($errors) == 0) {
    $password = md5($password);
    $query = "SELECT * FROM info WHERE username='$username' AND password='$password'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['username'] = $username;
      $_SESSION['success'] = "Вы вошли";
      header('location: index.php');
    }else {
      array_push($errors, "Не правильно ввели");
    }
  }
}

?>