<?php
require 'vendor/autoload.php';
use db\db_settings;
$settingsObj = new db_settings();
$mode = $settingsObj->getNavMode();
switch ($mode){
    case 0:
        $style = "<nav class=\"navbar navbar-expand-lg navbar-light bg-light\" id=\"navigation\">";
        break;
    case 1:
        $style = "<nav class=\"navbar navbar-expand-lg  navbar-dark bg-dark\" id=\"navigation\">";
        break;
    case 2:
        $style = "<nav class=\"navbar navbar-expand-lg  navbar-dark bg-primary\" id=\"navigation\">";
        break;
    case 3:
        $style = "<nav class=\"navbar navbar-expand-lg   navbar-light\" id=\"navigation\" style=\"background-color: #e3f2fd;\">";
        break;
}
?>
<?=$style;?>
    <a class="navbar-brand" href="index.php">MAIN</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">


                <div class="dropdown">
                    <a id="dLabel" role="button" data-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle" data-target="#" href="">
                        News <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                        <li><a href="category.php?id=1&name=Politic&start=0" class="list-group-item list-group-item-action">Politic</a></li>
                        <li><a href="category.php?id=2&name=Analitic&start=0" class="list-group-item list-group-item-action">Analitic</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-submenu">
                            <a tabindex="-1" href="#" class="list-group-item list-group-item-action">The other categories</a>
                            <ul class="dropdown-menu">
                                <li><a tabindex="-1" href="category.php?id=3&name=Economic&start=0" class="list-group-item list-group-item-action">Economic</a></li>
                                <li class="dropdown-submenu">
                                    <a href="#" class="list-group-item list-group-item-action">Even More..</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#" class="list-group-item list-group-item-action">Empty</a></li>
                                        <li><a href="#" class="list-group-item list-group-item-action">Empty</a></li>
                                    </ul>
                                </li>
                                <li><a href="category.php?id=4&name=Science&start=0" class="list-group-item list-group-item-action">Science</a></li>
                                <li><a href="category.php?id=5&name=Sport&start=0" class="list-group-item list-group-item-action">Sport</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>



        <form class="form-inline search-form" action="news_by_tag.php" method="get">
            <input class="form-control mr-sm-2 search-input" list="some" type="search" name="tagname" placeholder="Search" aria-label="Search">
           <datalist id="some"><option class="option-empty"></option></datalist>
            <button class="btn btn-outline-success search-button btns" type="submit">Search</button>
        </form>
        <?php if(isset($_SESSION['user_name'])) : ?>
            Welcome, <?= $_SESSION['user_name']; ?>!
            <a href="logout.php"><button class="btn btn-outline-danger my-2 my-sm-0 btns" type="submit">Log out</button></a>
        <?php endif; ?>
        <?php if (!isset($_SESSION['user_name'])) : ?>
        <form class="form-inline my-2 my-lg-0 login-form" action="login_user.php" method="post">
            <input class="form-control mr-sm-2" name="email" type="text" placeholder="Login" aria-label="Search">
            <input class="form-control mr-sm-2" name="password" type="password" placeholder="******" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0 btns" type="submit">Sign in</button>
            <a href="registration.php"><button type="button" class="btn btn-outline-info">Registration</button></a>
        </form>
        <?php endif;?>
    </div>
</nav>