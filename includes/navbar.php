<div class="bg-white sticky-top shadow">
  <nav class="navbar navbar-expand-lg ">
    <div class="container">
      <a class="navbar-brand text-dark fw-bold" href="index.php">
          La Nipha Hotel
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">&#x7c;&#x7c;&#x7c;</span>
      </button>
      <?php $page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); ?>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link <?= $page == "index.php"?'active':''; ?> " aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $page == "about.php"?'active':''; ?>" href="about.php">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $page == "all-rooms.php"?'active':''; ?>" href="all-rooms.php">Rooms</a>
          </li>
          <?php if(isset($_SESSION['login'])): ?>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?= $_SESSION['auth']['fname'].' '. $_SESSION['auth']['lname']; ?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="bookings.php">My Bookings</a></li>
              <li><a class="dropdown-item" href="profile.php">My Profile</a></li>
              <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
          </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="nav-link <?= $page == "login.php"?'active':''; ?>" href="login.php">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?= $page == "register.php"?'active':''; ?>" href="register.php">Register</a>
            </li>
          <?php endif; ?>

        </ul>
      </div>
    </div>
  </nav>
</div>
