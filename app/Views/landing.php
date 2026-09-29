<?= $this->extend('partials/header') ?>
<?php $appBase = app_base_url(); ?>
<?= $this->section('content') ?>
<section class="hero">
    <div><span class="eyebrow accent">OVERVIEW / TODAY</span><h1>Operate with<br><span class="gradient-text">clarity.</span></h1><p class="lede">A focused workspace for your customers and team accounts.</p></div>
    <div class="hero-orb" aria-hidden="true"></div>
</section>
<section class="metric-grid">
    <a class="metric-card" href="<?= esc($appBase . '/customers') ?>"><span class="metric-label">Customer accounts</span><strong>Manage</strong><span class="metric-link">Open directory →</span></a>
    <a class="metric-card" href="<?= esc($appBase . '/users') ?>"><span class="metric-label">User accounts</span><strong>Manage</strong><span class="metric-link">Open directory →</span></a>
    <div class="metric-card muted"><span class="metric-label">Workspace status</span><strong>Online</strong><span class="metric-link"><span class="status-dot"></span> All systems operational</span></div>
</section>
<?= $this->endSection() ?>
