<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="jumbotron jumbotron-flud text-center bg-dark" style="opacity:0.7; color:whitesmoke">
  <div class="container">
    <h1 class="display-4"><?php echo $data['title']; ?></h1>
    <p class="lead"><?php echo $data['description']; ?></p>
  </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>