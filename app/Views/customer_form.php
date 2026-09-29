<?= $this->extend('partials/header') ?>
<?php $appBase = app_base_url(); ?>
<?= $this->section('content') ?>
<section class="page-heading"><div><span class="eyebrow accent">DIRECTORY / CUSTOMERS</span><h1><?= esc($formTitle) ?></h1><p>Required fields are marked with an asterisk.</p></div><a class="button ghost" href="<?= esc($appBase . '/customers') ?>">Back to customers</a></section>
<?= $this->include('partials/form_errors') ?>
<form class="form-card" method="post" action="<?= esc($appBase . ($customer ? '/customers/update/' . $customer['id'] : '/customers')) ?>"><?= csrf_field() ?><label>Full name <span>*</span><input type="text" name="full_name" value="<?= esc(old('full_name', $customer['full_name'] ?? '')) ?>" required><?= $errors['full_name'] ?? '' ?></label><label>Email <span>*</span><input type="email" name="email" value="<?= esc(old('email', $customer['email'] ?? '')) ?>" required></label><label>Phone <small>optional</small><input type="text" name="phone" value="<?= esc(old('phone', $customer['phone'] ?? '')) ?>"></label><div class="form-actions"><a class="button ghost" href="<?= esc($appBase . '/customers') ?>">Cancel</a><button class="button primary" type="submit">Save customer</button></div></form>
<?= $this->endSection() ?>
