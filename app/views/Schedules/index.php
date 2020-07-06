<?php require APPROOT . '/views/inc/header.php';?>
<body class='schedule'>
<?php flash('post_message');?>
<div class="row">
    <div class="col-md-6">
      <h1>Do something</h1>
    </div>
    <div class="col-md-6">
      <a href="<?php echo URLROOT; ?>schedules/add" class="btn btn-primary pull-right">
        <i class="fa fa-pencil"></i> Add Schedule
      </a>
    </div>
</div>


<?php foreach($data['schedules'] as $schedule): ?>
  
  <div class="card card-body mb-3"> 
    <h4 class="card-title"><?php echo $schedule->title; ?> </h4>
    <p class="card-text"><?php echo $schedule->body; ?></p>
    <div class="bg-light p-2 mb-3">
      <?php echo 'Written by:' . $schedule->name . ' at ' .  $schedule->scheduleCreated;?>
    </div>
      <a href="<?php echo URLROOT; ?>schedules/show/<?php echo $schedule->scheduleId; ?>" class="btn btn-dark">More</a>
    </div>

<?php endforeach ?>
</body>


<?php require APPROOT . '/views/inc/footer.php';?>