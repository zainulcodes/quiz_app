<?php 
$user = $this->session->userdata('logged_in_admin');
$name = $user['name'];
?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="#" class="nav-link" data-widget="pushmenu">
            <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <span class="nav-link">Hi, <?= $name ?></span>
        </li>
    </ul>
</nav>