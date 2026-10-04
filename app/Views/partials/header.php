<?php
$path = trim(uri_string(), '/');
$active = $active ?? ($path === '' ? 'dashboard' : (str_starts_with($path, 'customers') ? 'customers' : (str_starts_with($path, 'users') ? 'users' : (str_starts_with($path, 'about') ? 'about' : 'dashboard'))));
$pageTitle = $pageTitle ?? ucfirst($active);
$appBase = app_base_url();
$loggedIn = (bool) session()->get('isLoggedIn');
$loggedName = session()->get('full_name') ?: 'Guest';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($pageTitle) ?> · POS Console</title>
    <link rel="stylesheet" href="<?= esc($appBase . '/css/app.css') ?>">
</head>
<body>
<div class="app-shell">
    <aside class="sidebar">
        <a class="brand" href="<?= site_url('/') ?>"><span class="brand-mark">✦</span><span>POS<br><small>CONSOLE</small></span></a>
        <nav class="side-nav" aria-label="Main navigation">
        <a href="<?= esc($appBase . '/') ?>" class="<?= ($active ?? '') === 'dashboard' ? 'active' : '' ?>"><span>▦</span> Dashboard</a>
            <a href="<?= esc($appBase . '/customers') ?>" class="<?= ($active ?? '') === 'customers' ? 'active' : '' ?>"><span>♙</span> Customers</a>
            <a href="<?= esc($appBase . '/users') ?>" class="<?= ($active ?? '') === 'users' ? 'active' : '' ?>"><span>♧</span> User accounts</a>
            <a href="<?= esc($appBase . '/about') ?>" class="<?= ($active ?? '') === 'about' ? 'active' : '' ?>"><span>⚙</span> About</a>
        </nav>
        <div class="sidebar-footer"><span class="status-dot"></span> System online</div>
    </aside>
    <main class="main-content">
        <header class="topbar"><span class="eyebrow">POINT OF SALE / <?= esc(strtoupper($pageTitle)) ?></span><?php if ($loggedIn): ?><span class="user-chip"><span class="avatar avatar-small"><?= esc(strtoupper(substr($loggedName, 0, 2))) ?></span> <?= esc($loggedName) ?> · <a class="logout-link" href="<?= esc($appBase . '/logout') ?>">Log out</a></span><?php else: ?><a class="button ghost login-link" href="<?= esc($appBase . '/login') ?>">Log in</a><?php endif; ?></header>
        <?php if (session()->getFlashdata('message')): ?><div class="flash success"><?= esc(session()->getFlashdata('message')) ?></div><?php endif; ?>
        <?= $this->renderSection('content') ?>
    </main>
</div>
</body>
</html>
