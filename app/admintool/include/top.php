<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet"> 
<style>
    .sidebar .sidebar-background::after {background:#000;opacity: 0;}
    .sidebar .sidebar-background {background-image:url(assets/img/sidebar-1.jpg) !important;}
    .sidebar .logo {background:none;}
    .card .card-header-primary .card-icon, .card .card-header-primary .card-text, .card .card-header-primary:not(.card-header-icon):not(.card-header-text), .card.bg-primary, .card.card-rotate.bg-primary .front, .card.card-rotate.bg-primary .back {
    background: linear-gradient(60deg, #5C8C73, #5C8C73);}
    .sidebar .nav li:hover > a, .sidebar .nav li .dropdown-menu a:hover, .sidebar .nav li .dropdown-menu a:focus, .sidebar .nav li.active > [data-toggle="collapse"], .sidebar[data-color="purple"] li.active > a {background-color: #5C8C73;}
    textarea.form-control {min-height: 110px;}
    .card .card-header-warning .card-icon, .card .card-header-warning .card-text, .card .card-header-warning:not(.card-header-icon):not(.card-header-text), .card.bg-warning, .card.card-rotate.bg-warning .front, .card.card-rotate.bg-warning .back, .card .card-header-primary:not(.card-header-icon):not(.card-header-text) {background: linear-gradient(60deg, #5C8C73, #5C8C73) !important;}
    .btn.btn-primary:focus, .btn.btn-primary.focus, .btn.btn-primary:hover, .btn.btn-primary {
    color: #fff;
    background-color: #5C8C73;
    border-color: #5C8C73;
}
	.text-primary {color:#05165D !important}
	.alert.alert-info {background:#000 !important}
	.dialog-ovelay {position:fixed !important}
</style>
<?php if(!isset($_SESSION['adminuser'])){?>
<script language="javascript">document.location.href='index.php';</script>
<?php }
$array=explode('?',$_SERVER['REQUEST_URI']); 
$file=basename($array[0]);
if(!in_array(str_replace('.php','',$file),$filearray)) {?>
<!--<script language="javascript">document.location.href='dashboard.php';</script>-->
<?php
}?>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
    <span class="sr-only">Toggle navigation</span>
    <span class="navbar-toggler-icon icon-bar"></span>
    <span class="navbar-toggler-icon icon-bar"></span>
    <span class="navbar-toggler-icon icon-bar"></span>
</button>
<div class="collapse navbar-collapse justify-content-end" id="navigation">
    <!--<form class="navbar-form">
        <div class="input-group no-border">
            <input type="text" value="" class="form-control" placeholder="Search...">
            <button type="submit" class="btn btn-white btn-round btn-just-icon">
                <i class="material-icons">search</i>
                <div class="ripple-container"></div>
            </button>
        </div>
    </form>-->
    <ul class="navbar-nav">
        <!--<li class="nav-item">
            <a class="nav-link" href="dashboard.php">
                <i class="material-icons">dashboard</i>
                <p>
                    <span class="d-lg-none d-md-block">Stats</span>
                </p>
            </a>
        </li>-->
        <!--<li class="nav-item dropdown">
            <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="material-icons">notifications</i>
                <span class="notification">5</span>
                <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                </p>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#">Mike John responded to your email</a>
                <a class="dropdown-item" href="#">You have 5 new tasks</a>
                <a class="dropdown-item" href="#">You're now friend with Andrew</a>
                <a class="dropdown-item" href="#">Another Notification</a>
                <a class="dropdown-item" href="#">Another One</a>
            </div>
        </li>-->
        <li class="nav-item">
            <a class="nav-link" href="logout.php">
                <!--<i class="material-icons">lock_open</i>
                <p>
                    <span class="d-lg-none d-md-block">Logout</span>
                </p>-->
                <img src="assets/img/logoutbtn.png">
            </a>
        </li>
    </ul>
</div>