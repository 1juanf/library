<?php

  include('../database.php');

  $query = "SELECT * from books";
  $result = mysqli_query($connection, $query);
  if(!$result) {
    die('Query Failed'. mysqli_error($connection));
  }

  $json = array();
  while($row = mysqli_fetch_array($result)) {
    $json[] = array(
      'title' => $row['title'],
      'description' => $row['description'],
      'id' => $row['id'],
      'author'=>$row['author']
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
?>
