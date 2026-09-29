<?php $errors = session()->getFlashdata('errors') ?? []; ?>
<?php if ($errors): ?><div class="flash error"><strong>Please check the form.</strong><ul><?php foreach ($errors as $error): ?><li><?= esc($error) ?></li><?php endforeach; ?></ul></div><?php endif; ?>
