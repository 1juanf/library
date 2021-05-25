<?php
  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');// importante
  }
  require 'database.php';

  if (!empty($_POST['email']) && !empty($_POST['pass'])) {
    $records = $conn->prepare('SELECT * FROM user WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['pass'], $results['pass'])) {
      $_SESSION['user_id'] = $results['id'];
      $message = 'susses';
      header("Location: dashboard.php");//importante
    } else {
      $message = 'Sorry, those credentials do not match';
    }
  }
?>

<?php include("include/header.php") ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>
    <form action="index.php" method="post">
      <input type="text" name="email" placeholder="Email">
      <input type="password" name="pass" placeholder="Password">
      <button type="submit" name="login">Login</button>
    </form>
<?php include("include/footer.php") ?>
