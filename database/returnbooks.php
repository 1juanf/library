<?php

include('database.php');

if(isset($_POST['id'])) {
  $id = $_POST['id'];
  $sql = "UPDATE FROM books SET enable_book=0 WHERE id = $id;";
  $result = mysqli_query($connection, $sql);

  if (!$result) {
    die('Query Failed.');
  }
  echo "Task Deleted Successfully";
}

?>
