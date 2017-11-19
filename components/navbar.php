<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">MAIN</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="comments.php">comments</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                </div>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0 btns" type="submit">Search</button>
        </form>
        <?php if(isset($_SESSION['user_name'])) : ?>
            Welcome, <?= $_SESSION['user_name']; ?>!
            <a href="logout.php"><button class="btn btn-outline-danger my-2 my-sm-0 btns" type="submit">Log out</button></a>
        <?php endif; ?>
        <?php if (!isset($_SESSION['user_name'])) : ?>
        <form class="form-inline my-2 my-lg-0" action="login_user.php" method="post">
            <input class="form-control mr-sm-2" name="email" type="text" placeholder="Login" aria-label="Search">
            <input class="form-control mr-sm-2" name="password" type="password" placeholder="******" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0 btns" type="submit">Sign in</button>
            <a href="registration.php"><button type="button" class="btn btn-outline-info">Registration</button></a>
        </form>
        <?php endif;?>
    </div>
</nav>