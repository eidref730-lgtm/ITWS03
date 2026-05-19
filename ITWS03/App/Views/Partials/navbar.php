<?php
use Framework\Session;
?>
<header class="site-header">
    <div class="container mx-auto max-w-6xl px-4">
        <div class="header-inner">
            <h1 class="brand">
                <a href="<?= url('/') ?>">
                    <span class="brand-text">Prosple</span>
                </a>
            </h1>

            <nav class="main-nav">
                <?php if (Session::has('user')) : ?>
                    <div class="user-menu flex items-center gap-4">
                        <span class="welcome-message text-white mr-4" style="color: #ffffff !important; font-weight: 500;">
                            Welcome, <?= sanitize(Session::get('user')['name']) ?>!
                        </span>
                        <form method="POST" action="<?= url('/auth/logout') ?>" class="inline-block m-0 p-0">
                            <button type="submit" class="nav-link cursor-pointer bg-transparent border-0 text-white p-0 mr-4 inline-block align-middle" style="background: none; border: none; font-size: inherit; color: white;">
                                Logout
                            </button>
                        </form>
                        <a href="<?= url('/listings/create') ?>" class="btn btn-primary nav-cta">
                            <i class="fa fa-edit"></i>
                            <span>Post a Job</span>
                        </a>
                    </div>
                <?php else : ?>
                    <a href="<?= url('/auth/login') ?>" class="nav-link">Login</a>
                    <a href="<?= url('/auth/register') ?>" class="nav-link">Register</a>
                    <a href="<?= url('/listings/create') ?>" class="btn btn-primary nav-cta">
                        <i class="fa fa-edit"></i>
                        <span>Post a Job</span>
                    </a>
                <?php endif; ?>
            </nav>
        </div>
    </div>
</header>