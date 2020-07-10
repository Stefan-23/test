<nav class="navbar navbar-expand-md navbar-dark  mb-3">
  <a class="navbar-brand" href="<?php echo URLROOT ?>"><?php echo APPNAME; ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo URLROOT ?>schedules/calendar">Calendar</a>
      </li>
      <?php if (isset($_SESSION['user_id'])) :  ?>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT ?>schedules/index">Schedules</a>
        </li>
      <?php endif; ?>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo URLROOT ?>pages/motivation">Motivation</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <?php if (isset($_SESSION['user_id'])) :  ?>

        <li class="nav-item">
          <a class="nav-link"> <?php echo $_SESSION['user_name'] ?> </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT ?>users/logout">Logout</a>
        </li>

      <?php else : ?>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT ?>users/register">Register</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT ?>users/login">Login</a>
        </li>
      <?php endif; ?>
    </ul>

  </div>
</nav>