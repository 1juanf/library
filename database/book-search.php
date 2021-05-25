<?php
  include('../database.php');

  $search=$_POST['search'];

  if(!empty($search)){
    $sql = "SELECT * FROM books WHERE name LIKE '$search%'";
    $result = mysqli_query($connection, $sql);

    if(!$result) {
      die('Query Error' . mysqli_error($connection));
    }
    $json = array();
    while($row = mysqli_fetch_array($result)) {
      $json[] = array(
        'id' => $row['id'],
        'title' => $row['title'],
        'author' =>$row['author'],
        'description' => $row['description']
      );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
  }

 ?>
