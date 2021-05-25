<?php
  require 'database.php';

  $message='';

  if(!empty($_POST['email'])&&!empty($_POST['pass'])&&!empty($_POST['username'])){
    $sql= "INSERT INTO user (email, pass, name) VALUES (:email, :pass, :username)";
    $stmt= $conn->Prepare($sql);
    $stmt->bindParam(':email',$_POST['email']);
    $password=password_hash($_POST['pass'],PASSWORD_BCRYPT);
    $stmt->bindParam(':pass',$password);
    $stmt->bindParam(':username',$_POST['username']);

    if ($stmt->execute()) {
      $message = "Susses create new user";
      header('Location: login.php');
    }else{

      $message = "Fail create user";
    }
  }
 ?>
    <?php include("include/header.php") ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>SignUp</h1>

    <form action="signup.php" method="post">
      <input type="text" name="email" placeholder="Email">
      <input type="text" name="username" placeholder="User">
      <input type="password" name="pass" placeholder="Password">
      <!-- <input type="password" name="pass1" placeholder="Confirm Password"> -->
      <button type="submit" name="signup">Signup</button>
    </form>
    <samp>or<a href="login.php">login</a></samp>

    <?php include("include/footer.php") ?>
