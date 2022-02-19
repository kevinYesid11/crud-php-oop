<?php
include "./includes/class-autoload.inc.php";

$posts = new Posts();

if (isset($_POST['submit'])) {
  $title = $_POST['post-title'];
  $body = $_POST['post-content'];
  $author = $_POST['post-author'];

  $posts->addPost($title, $body, $author);

  $_SESSION['message'] = 'tarea guardada exitosamente';
  $_SESSION['message_type'] = 'success';

  header("location: index.php");
} else if ($_GET['send'] === 'del') {
  $id = $_GET['id'];
  $posts->delPost($id);

  $_SESSION['message'] = "tarea eliminada correctamente";
  $_SESSION['message_type'] = "danger";

  header("location: index.php");
} else if ($_GET['send'] === 'update') {
  $id = $_GET['id'];

  $title = $_POST['post-title'];
  $body = $_POST['post-content'];
  $author = $_POST['post-author'];

  $posts->updatePost($id, $title, $body, $author);

  $_SESSION['message'] = "actualizacion exitosa";
  $_SESSION['message_type'] = "info";

  header("location: index.php");
}
