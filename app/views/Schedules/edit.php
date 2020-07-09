<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>schedules/" class="btn btn-dark"><i class="fa fa-backward"></i> Back</a>
<div class="card card-body bg-light mt-5">
    <h2>Edit-Remove Schedule</h2>
    <form action="<?php echo URLROOT; ?>schedules/delete/<?php echo $data['id']; ?>" method="POST">
    <button id="delete" type="submit"  class="close" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
  </form>
    <form action="<?php echo URLROOT; ?> schedules/edit/<?php echo $data['id']; ?>" method="POST">
        <div class="form-group">
            <label for="title"> Title: </label>
            <input type="text" name="title" class="form-control form control-lg <?php echo (!empty($data['err_title'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['url']; ?>">
            <span class="invalid-feedback"> <?php echo $data['err_title']; ?> </span>
        </div>
        <div class="form-group">
            <label for="body">Body: </label>
            <textarea name="body" class="form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['body']; ?></textarea>
            <span class="invalid-feedback"><?php echo $data['body_err']; ?></span>
        </div>
        
        <input type="submit" class="btn btn-success" value="Edit">
    </form>
</div>






<?php require APPROOT . '/views/inc/footer.php'; ?>