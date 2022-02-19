<?php
include "./includes/class-autoload.inc.php";
require_once("./templates/header.php");
?>
<div class="text-center">
  <button class="my-5 btn btn-primary" data-toggle="modal" data-target="#addPostModal">Craete Post</button>
</div>

<!-- Modal -->
<div class="modal fade" id="addPostModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- form input -->
        <form method="POST" action="post.process.php">
          <div class="form-group">
            <label>Title: </label>
            <input class="form-control" name="post-title" type="text" required>
          </div>
          <div class="form-group">
            <label>Content: </label>
            <textarea class="form-control" name="post-content" required></textarea>
          </div>
          <div class="form-group">
            <label>Author: </label>
            <input class="form-control" name="post-author" type="text" required>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="submit" class="btn btn-primary">Add post</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php if (isset($_SESSION['message'])) : ?>
  <div class="alert alert-<?= $_SESSION['message_type']; ?>" role="alert">
    <?= $_SESSION['message'] ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php
  session_unset();
endif;
?>
<div class="row">
  <?php $posts = new Posts();
  if ($posts->getPost()) {
    foreach ($posts->getPost() as $post) : ?>
      <div class="col-md-6 mt-4">
        <div class="card">
          <div class="card-body">
            <h5 class='card-title'> <?= $post['title'] ?> </h5>
            <p class='card-text'> <?= $post['body'] ?></p>
            <h6 class='card-subtitle text-muted text-right'>Author: <?= $post['author'] ?> </h6>
            <a href='editForm.php?id=<?= $post['id'] ?>' class='btn btn-warning'>Edit</a>
            <a href='post.process.php?send=del&id=<?= $post['id'] ?>' class='btn btn-danger'>Delete</a>
          </div>
        </div>
      </div>
  <?php endforeach;
  } else {
    echo "<p class='mt-5 mx-auto'>Post is empty...</p>";
  }
  ?>
</div>

<?php require_once("./templates/footer.php"); ?>