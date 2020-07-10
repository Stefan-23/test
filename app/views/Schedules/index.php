<?php require APPROOT . '/views/inc/header.php'; ?>

<body class='schedule'>
  <?php flash('post_message'); ?>
  <div class="row">
    <div class="col-md-6">
      <h1>Schedules</h1>
    </div>
    <div class="col-md-6">

    </div>
  </div>
  <?php foreach ($data['schedules'] as $schedule) : ?>
    <?php if($_SESSION['user_id'] == $schedule->user_id) : ?>
    <div class="card card-body mb-3">
      <h4 class="card-title"><?php echo $schedule->title; ?> </h4>
      <p class="card-text"><?php echo $schedule->body; ?></p>
      <div class="bg-light p-2 mb-3">
        <?php echo 'Written by: ' . $schedule->name; ?>
      </div>
      <a href="<?php echo URLROOT; ?>schedules/edit/<?php echo $schedule->scheduleId; ?>" class="btn btn-dark">Edit-Remove</a>
    </div>
  <?php endif; ?>
  <?php endforeach;?>
</body>


<?php require APPROOT . '/views/inc/footer.php'; ?>